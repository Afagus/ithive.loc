<?php


namespace vendor\classes;

use vendor\classes;

require_once 'database/Data.php';


class Form
{
    public static $counter;
    private $form;
    private $nameOfForm;
    public $arrayOfFields = [];

    private function __construct($form, $nameOfForm)
    {
        $this->form = $form;
        $this->nameOfForm = $nameOfForm;
        $this->createArraysOfFields($this->form);
        $this->validatorOfForm();
        $this->toStartSending();
    }
    /**
     * @return mixed
     */
    static public function getSingleForm($nameOfForm )
    {
        $database = \database\singleConnect::getInstance();
        $sql = 'SELECT * FROM table_form_building 
    JOIN table_types_of_fields ttof on ttof.id_types = table_form_building.type_ID
    JOIN type_of_validation tov on tov.id_validation = table_form_building.validation_ID 
    WHERE form_ID = ' . $nameOfForm;
        $form = $database->query($sql);

        return new self($form, $nameOfForm);
    }

    /**
     * @param $form
     * Создаем массив из объектов полей
     */
    public function createArraysOfFields($form)
    {
        foreach ($form as $element) {
            $className = "\\vendor\classes\\" . $element['type'];
            $element['value'] = '';
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
     */
    public function viewForm()
    {
        self::$counter++;//счетчик количества созданных форм
        ?>
        <h2><?php
            if (!empty($_POST) && ($_POST['nameOfForm'] == $this->nameOfForm) && !$this->validatorOfForm()) {
                echo '<span class="warning">' . 'Форма не отправлена, проверьте правильность заполнения полей' . '<br>' . '</span>';
            } else {
                echo 'Заполните форму для отправки сообщения';
            }
            ?></h2>
        <form action="" method="post">
            <table>
                <?php

                foreach ($this->arrayOfFields as $field) {

                    echo '<tr><td>';
                    echo $field->render();
                    echo '</td></tr>';

                }
                ?>
                <tr>
                    <td>
                        <input type="hidden" name="nameOfForm" value="<?= $this->nameOfForm ?>">
                        <input type="submit" value="Отправить данные формы № <?= self::$counter ?>">
                    </td>

                </tr>
            </table>
        </form>

        <?php
    }

    public function compileMessage()
    {
        $allMess = '';
        foreach ($this->arrayOfFields as $field) {
            $allMess .= $field->createMessage();
        }
        return $allMess .= '______________________________________________________' . "\n";

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
            $this->sendToDB($myMess);
        } else {
            return false;
        }
    }


    public function sendToDB($message)
    {
        $link = \database\singleConnect::getInstance();

        $sql = "INSERT INTO client_full_message (form_ID, message)
                VALUES ($this->nameOfForm, '$message')
                ";
        $link->query($sql);


        $messageID = $link->getLastId();
        $forSQL = '';
        foreach ($this->arrayOfFields as $arrayOfField) {
            $forSQL .= '(' . $messageID . ',' . $arrayOfField->id . ',' . '\'' . $arrayOfField->getValue() . '\'' . ')' . ',';
        }
        $forSQL = mb_substr($forSQL, 0, -1);

        $sql = "INSERT INTO message_one_field (message_ID, field_ID, value)
         
        VALUES $forSQL";

        $res = $link->query($sql);

    }

}
