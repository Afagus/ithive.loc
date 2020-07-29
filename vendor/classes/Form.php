<?php


namespace vendor\classes;

use vendor\classes;


require_once 'database/Data.php';

class Form
{
    public $form;
    public $arrayOfFields = [];

    public function __construct($form)
    {
        $this->form = $form;
        $this->createArraysOfFields($this->form);
    }


    /**
     * @param $form
     * Создаем массив из объектов полей
     */
    public function createArraysOfFields($form)
    {
        foreach ($form as $element) {
            $className = "\\vendor\classes\\" . $element['type'];
            $this->arrayOfFields[] = new $className($element);
        }
    }

    public function viewForm()
    {
        ?>
        <h2>Заполните форму для отправки сообщения</h2>
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
                        <input type="submit" value="Отправить сообщение">
                    </td>

                </tr>
            </table>
        </form>

        <?php
    }


}