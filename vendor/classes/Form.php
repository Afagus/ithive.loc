<?php


namespace vendor\classes;

use database\singleConnect;
use vendor\classes;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


require_once 'database/Data.php';

class Form
{
    public $lastMessageID = null;
    private $form;
    private $formId;
    public $arrayOfFields = [];
    public $findMessageID;
    public $formName;
    public $currentValue = [];

    private function __construct($form, $formId, $findMessageID = 0)
    {
        
        $this->formName = $form[0]['nameOfForm']??'Форма пустая, для создания добавьте хоть одно поле';
        $this->findMessageID = $findMessageID;
        $this->form = $form;
        $this->formId = $formId;
        $this->createFieldsCollection($this->form);
        $this->formValidator();
        $this->toStartSending();


    }

    /**
     * Запись имени формы в базу данных
     **/
    static public function createForm($name)
    {
        $database = \database\singleConnect::getInstance();
        $sql = 'INSERT INTO main_form (nameOfForm)
        VALUES (\'' . $name . '\')';

        $database->query($sql);

        return $database->getLastId();
    }


    /**
     * Удаление формы по указанному ID
     */
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
    static public function getFormsCollection()
    {
        $database = \database\singleConnect::getInstance();
        $sql = 'SELECT * FROM main_form ';
        return $database->query($sql);
    }

    /**
     * Создание формы по полям полученным из базы данных, возвращает объект формы
     */
    static public function getSingleForm($formId)
    {
        $database = \database\singleConnect::getInstance();
        $sql = 'SELECT *, table_form_building.id as id FROM table_form_building 
    JOIN table_types_of_fields ttof on ttof.id_types = table_form_building.type_ID
    JOIN type_of_validation tov on tov.id_validation = table_form_building.validation_ID 
    JOIN main_form mf on table_form_building.form_ID = mf.id
    WHERE form_ID = ' . $formId;
        $form = $database->query($sql);

        return new self($form, $formId);
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
        $formId = $form[0]['form_ID'];

        return new self($form, $formId, $messageID);
    }

    /**
     * @param $form
     * Создаем массив из объектов полей
     */
    public function createFieldsCollection($form)
    {
        foreach ($form as $element) {
            $className = "\\vendor\classes\\" . $element['type'];

            if (!empty($_POST) && $_POST['nameOfForm'] == $this->formId) {
                $element['value'] = isset($_POST[$element['name']]) ? $_POST[$element['name']] : '';
            }
            $this->arrayOfFields[] = new $className($element);
        }
    }

    /**
     * Валидатор формы, который в случае наличия ошибок в полях, считает их,
     * и возвращает булевое значение
     */

    public function formValidator()
    {
        if (!empty($_POST) && $_POST['nameOfForm'] == $this->formId) {
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
                if (!empty($_POST) && ($_POST['nameOfForm'] == $this->formId) && !$this->formValidator()) {
                    echo '<span class="warning">' . 'Форма не отправлена, проверьте правильность заполнения полей' . '<br>' . '</span>';
                } else {


                    echo 'Заполните форму для отправки сообщения' . '<br/>';

                    echo '<span class="form_name">' . 'Имя формы: ' . $this->formName . '</span>';


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
                            <input type="hidden" name="nameOfForm" value="<?= $this->formId ?>">
                            <input type="submit" value="Отправить данные формы">
                        </td>
                    </tr>
                    <tr>

                    </tr>
                </table>
            </form>
            <?php
        } else {
            $this->getJSValidator();
        }
    }


    public function getJSValidator()
    {
        $setOfErrors = ['errors' => []];
        foreach ($this->arrayOfFields as $field) {

            $setOfErrors['errors']["idFieldForValidation_" . $field->id] = $field->message;

        }
        $setOfErrors['messID'] = $this->lastMessageID ?: '';
        $setOfErrors['timeMessCreation'] = $this->getTimeMessCreation($this->lastMessageID);
        echo json_encode($setOfErrors);

    }

    public function getTimeMessCreation($id)
    {
        if ($id != null) {
            $database = \database\singleConnect::getInstance();
            $sql = 'SELECT date FROM client_full_message 
            WHERE id =' . $id;
            return $database->query($sql);
        } else {
            return 0;
        }


    }

    public function getValuesFromUser()
    {

        foreach ($this->arrayOfFields as $field) {
            $this->currentValue[$field->getName()] = $field->getValue();
        }


        return $this->currentValue;
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
        $fp = fopen($this->formId . '.txt', 'a');
        fwrite($fp, $allMess);
        fclose($fp);

    }

    public function sendMethod()
    {

        foreach (PostProcessor::createArrayObject($this) as $pprocessor) {

            $pprocessor->send();

        }
    }


    public function toStartSending()
    {
        if ($this->formValidator()) {
            $myMess = $this->compileMessage();
            $this->sendToFile($myMess);
            $this->sendChoice($myMess);
            $this->getValuesFromUser();
            $this->sendMethod();


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
     */
    public function sendMessage($message)
    {
        $link = \database\singleConnect::getInstance();
        $sql = "INSERT INTO client_full_message (form_ID, message)
                VALUES ($this->formId, '$message')";
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

    static public function getMessageFromDB($route)
    {
        $database = \database\singleConnect::getInstance();
        $sql = 'SELECT *
                FROM client_full_message
                WHERE form_ID = ' . $route;
        return $database->query($sql);
    }

    /*
     * todo Сделать метод который возвращает ID Месседжа
     * */
    public function getFormID()
    {
        return $this->formId;
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

    static public function getFieldsCollection($currentRoute)
    {
        $link = singleConnect::getInstance();
        $sql = "SELECT *
        FROM table_form_building
        WHERE form_ID = " . $currentRoute;
        return $link->query($sql);

    }

    public function getNameFieldById($id)
    {
        $value = null;
        foreach ($this->arrayOfFields as $field) {
            if ($field->id == $id) {
                $value = $field->value;
                break;
            }
        }
        return $value;

    }
}
