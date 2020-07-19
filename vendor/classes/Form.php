<?php


namespace nik\vendor\classes;

use nik\vendor\classes;


require_once 'database/Data.php';

class Form
{
    public $form;

    public function __construct($form)
    {
        $this->form = $form;
    }


    public function viewForm()
    {
        ?>
        <h2>Заполните форму для отправки сообщения</h2>
        <form action="" method="post">
            <table>
                <tr>
                    <td>
                        <p><?php
                            $output = new Text($this->form);
                            echo $output->render();
                            ?><Br>
                    </td>
                    <td>
                        <input type="submit" value="Отправить сообщение">
                    </td>
                </tr>
            </table>
        </form>

        <?php
    }


}