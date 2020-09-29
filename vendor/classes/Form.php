<?php


namespace vendor\classes;

use vendor\classes;

require_once 'database/Data.php';


class Form
{
    public static $counter;

    public $form;
    public $nameOfForm;
    public $arrayOfFields = [];


    public function __construct($form, $nameOfForm = '')
    {
        $this->form = $form;
        $this->nameOfForm = $nameOfForm;
        $this->createArraysOfFields($this->form);
        $this->validatorOfForm();
        $this->compileMessage();
        $this->sendToDB();

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
        if ($this->validatorOfForm()) {
            $allMess = '';
            foreach ($this->arrayOfFields as $field) {
                $allMess .= $field->createMessage();
            }
            $allMess .= '______________________________________________________' . "\n";

            $fp = fopen($this->nameOfForm . '.txt', 'a');
            fwrite($fp, $allMess);
            fclose($fp);

        }


    }

    public function sendToDB()
    {
        if ($this->validatorOfForm()) {
            $link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die('Error of database');
            mysqli_set_charset($link, "utf8");
            $names = '';
            $val = '';
            foreach ($this->arrayOfFields as $arrayOfField) {
                $names .= '`' . $arrayOfField->getName() . '`' . ', ';
                $val .= '`' . $arrayOfField->getValue() . '`' . ', ';
            }
            $names = mb_substr($names, 0, -2);
            $val = mb_substr($val, 0, -2);

            $sql = "INSERT INTO customers ($names)
                VALUES ($val)";
            echo $sql;
            $res = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
            mysqli_close($link);
        }
    }
}
