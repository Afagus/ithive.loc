<?php


namespace vendor\classes;

use database\singleConnect;
use vendor\classes;

require_once 'database/Data.php';


class Form
{

    public static $counter;
    public $lastMessageID = null;
    private $form;
    private $nameOfForm;
    public $arrayOfFields = [];
    public $findMessageID;
    public $formID;

    private function __construct($form, $nameOfForm, $findMessageID = 0)
    {
        $this->formID = $form[0]['form_ID'];
        $this->findMessageID = $findMessageID;
        $this->form = $form;
        $this->nameOfForm = $nameOfForm;
        $this->createArraysOfFields($this->form);
        $this->validatorOfForm();
        $this->toStartSending();


    }

    /**
     * Creation of form
     **/
    static public function createForm($name)
    {
        $database = \database\singleConnect::getInstance();
        $sql = 'INSERT INTO main_form (nameOfForm)
        VALUES (\'' . $name . '\')';

        $database->query($sql);

        return $database->getLastId();
    }

    static public function deleteForm($id)
    {
        $database = \database\singleConnect::getInstance();
        $sql = "DELETE FROM main_form 
         WHERE id = " . '\'' . $id . '\'';
        $database->query($sql);

        return true;
    }

    /**
     * @return array|int
     * Getting the list of forms from DB
     */
    static public function getListOfForms()
    {
        $database = \database\singleConnect::getInstance();
        $sql = 'SELECT * FROM main_form ';
        return $database->query($sql);
    }

    /**
     * @return mixed
     */
    static public function getSingleForm($nameOfForm)
    {
        $database = \database\singleConnect::getInstance();
        $sql = 'SELECT * FROM table_form_building 
    JOIN table_types_of_fields ttof on ttof.id_types = table_form_building.type_ID
    JOIN type_of_validation tov on tov.id_validation = table_form_building.validation_ID 
    WHERE form_ID = ' . $nameOfForm;
        $form = $database->query($sql);
        return new self($form, $nameOfForm);
    }

    static public function getFromDB($messageID)
    {

        $database = \database\singleConnect::getInstance();
        $sql = 'SELECT * FROM table_form_building
        left JOIN client_full_message cfm on cfm.form_ID = table_form_building.form_ID
        left JOIN message_one_field mof on mof.field_ID = table_form_building.id and cfm.id = mof.message_ID
        left JOIN table_types_of_fields ttof on ttof.id_types = table_form_building.type_ID
        left JOIN type_of_validation tov on tov.id_validation = table_form_building.validation_ID
        WHERE cfm.id = ' . $messageID;

        $form = $database->query($sql);

        return new self($form, $form[0]['form_ID'], $messageID);
    }

    /**
     * @param $form
     * Создаем массив из объектов полей
     */
    public function createArraysOfFields($form)
    {
        foreach ($form as $element) {
            $className = "\\vendor\classes\\" . $element['type'];
            //$element['value'] = '';
            if (!empty($_POST) && $_POST['nameOfForm'] == $this->nameOfForm) {
                $element['value'] = isset($_POST[$element['name']]) ? $_POST[$element['name']] : '';
            }
            $this->arrayOfFields[] = new $className($element);
        }
    }

    /**
     * Валидатор формы, который в случае наличия ошибок в полях, считает их,
     * и возвращает булевое значение
     */

    public function validatorOfForm()
    {
        if (!empty($_POST) && $_POST['nameOfForm'] == $this->nameOfForm) {
            $errors = 0;
            foreach ($this->arrayOfFields as $field) {
                if (!$field->validate()) {
                    $errors++;
                }
            }
            return !(bool)$errors;
        }

    }

    /**
     * Выводим поля формы на экран
     * @param $value
     */
    public function viewForm($value = 0)
    {
        if (!$value) {
            ?>
            <h2><?php
                if (!empty($_POST) && ($_POST['nameOfForm'] == $this->nameOfForm) && !$this->validatorOfForm()) {
                    echo '<span class="warning">' . 'Форма не отправлена, проверьте правильность заполнения полей' . '<br>' . '</span>';
                } else {
                    echo 'Заполните форму для отправки сообщения';
                }

                ?></h2>
            <form id="formForSend" action="" method="post">
                <table>
                    <?php
                    foreach ($this->arrayOfFields as $field):?>
                        <tr <?php
                        echo "id='idFieldForValidation_$field->id'";
                        ?>>
                            <td><?php $field->render(); ?></td>
                            <td class="fieldForErrorMessage"></td>
                        </tr>
                    <?php endforeach;
                    ?>
                    <tr>
                        <td>
                            <input type="hidden" name="nameOfForm" value="<?= $this->nameOfForm ?>">
                            <input type="submit" value="Отправить данные формы">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
        } else {
            $this->getListOfErrorsForJS();
        }
    }


    public function getListOfErrorsForJS()
    {
        $setOfErrors =['errors'=>[]];
        foreach ($this->arrayOfFields as $field) {

            $setOfErrors['errors']["idFieldForValidation_" . $field->id] = $field->message;

        }
        $setOfErrors['messID'] = $this->lastMessageID;
        $setOfErrors['timeMessCreation'] = $this->getTimeMessCreation($this->lastMessageID);
        echo json_encode($setOfErrors);

    }

public function getTimeMessCreation($id){
    $database = \database\singleConnect::getInstance();
    $sql = 'SELECT date FROM client_full_message 
WHERE id =' . $id;
    return $database->query($sql);
}


    public function compileMessage()
    {
        $allMess = '';
        foreach ($this->arrayOfFields as $field) {
            $allMess .= $field->createMessage();
        }
        return $allMess .= '_______________________' . "\n";

    }

    public function sendToFile($allMess)
    {
        $fp = fopen($this->nameOfForm . '.txt', 'a');
        fwrite($fp, $allMess);
        fclose($fp);

    }

    public function toStartSending()
    {
        if ($this->validatorOfForm()) {
            $myMess = $this->compileMessage();
            $this->sendToFile($myMess);
            $this->sendChoice($myMess);
        } else {
            return false;
        }
    }

    public function sendChoice($message)
    {
        if ($this->findMessageID == 0) {
            $this->sendMessage($message);
        } else {
            $this->changeMessageInDB();
        }
    }

    /**
     * TODO: Проверить идею, вставить сюда иф и запускать или этот функционал или метод changeMessageInDB() в зависимости от того есть ли занчение или нет в $findMessageID
     */
    public function sendMessage($message)
    {
        $link = \database\singleConnect::getInstance();
        $sql = "INSERT INTO client_full_message (form_ID, message)
                VALUES ($this->nameOfForm, '$message')";
        $link->query($sql);
        $this->lastMessageID = $link->getLastId();
        $forSQL = '';
        foreach ($this->arrayOfFields as $arrayOfField) {
            $forSQL .= '(' . $this->lastMessageID . ',' . $arrayOfField->id . ',' . '\'' . $arrayOfField->getValue() . '\'' . ')' . ',';
        }
        $forSQL = mb_substr($forSQL, 0, -1);
        $sql = "INSERT INTO message_one_field (message_ID, field_ID, value)
         
        VALUES $forSQL";
        $res = $link->query($sql);

    }

    /**
     * TODO: доделать запрос, изменить обращение к столбцам. Вопрос как словить ID сообщения, и где берется findMessageID
     */
    public function changeMessageInDB()
    {
        foreach ($this->arrayOfFields as $arrayOfField) {
            $link = \database\singleConnect::getInstance();
            $sql = 'UPDATE message_one_field
                SET value = \'' . $arrayOfField->getValue() . '\'
                WHERE message_ID = ' . $this->findMessageID . ' AND field_ID = ' . $arrayOfField->field_ID;
            $link->query($sql);
            echo $this->findMessageID;
        }
    }

//TODO исправить для получения id
    static public function getMessageFromDB()
    {
        $database = \database\singleConnect::getInstance();
        $sql = 'SELECT *
                FROM client_full_message
                WHERE form_ID = ' . ROUTE[1];
        return $database->query($sql);
    }

    /*
     * todo Сделать метод который возвращает ID Месседжа
     * */
    public function getFormID()
    {
        return $this->form;
    }

    /*
     * метод для удаления сообщения
     */

    static public function deleteMessage($messageID)
    {
        $link = singleConnect::getInstance();
        $sql = "DELETE FROM client_full_message
                WHERE id = " . $messageID;
        $link->query($sql);
        return 1;
    }
}
