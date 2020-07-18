<?php


namespace nik\vendor\classes;


use nik\vendor\classes\fields;

class Form
{

    public function createAllForm()
    {
        ?>
        <h2>Заполните форму для отправки сообщения</h2>
        <form action="" method="post">
            <table>
                <tr>
                    <td>

                        Убрать эту писанину см. TODO
                        <p><b>Как по вашему мнению расшифровывается аббревиатура &quot;ОС&quot;?</b></p>
                        <p><?php $field = new Text();
                            echo $field->render()?><Br>
                            <input type="radio" name="answer" value="a2">Операционная система<Br>
                            <input type="radio" name="answer" value="a3">Большой полосатый мух</p>
                        <p><input type="submit"></p>
                        <?php
                        /**
                         * TODO тут будут поля которые будут тянуться из массива полей и  выстраиваться форичем
                         */
                        ?>
                    </td>
                </tr>
            </table>
        </form>

        <?php
    }


}