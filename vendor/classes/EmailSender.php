<?php

namespace vendor\classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'phpmailer/src/Exception.php';
require_once 'phpmailer/src/PHPMailer.php';
require_once 'phpmailer/src/POP3.php';
require_once 'phpmailer/src/SMTP.php';

class emailSender extends PostProcessor
{
    const handlersFields = [

        'preferences' => [
            'NAME' => '',
            'SUBJECT' => '',
            'MESSAGE' => '',
            'EMAIL' =>'',
        ]

    ];

    public function send()
    {
        $fields = $this->preferences;


        $mail = new PHPMailer;
        $mail->isSMTP();                   // Отправка через SMTP
        $mail->Host = 'smtp.gmail.com';  // Адрес SMTP сервера
        $mail->SMTPAuth = true;          // Enable SMTP authentication
        $mail->Username = 'afagus.inv@gmail.com';       // ваше имя пользователя //TODO: заменить на адрес введенный при создании хендлера
        $mail->Password = 'G#inv2987103834!';    // ваш пароль ////TODO: заменить на адрес введенный при создании хендлера
        $mail->SMTPSecure = 'ssl';         // шифрование ssl
        $mail->Port = 465;               // порт подключения
        $mail->CharSet = 'UTF-8';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom($this->form->getNameFieldById($fields['EMAIL'], $this->form->getNameFieldById($fields['NAME'])));    // от кого

        $mail->addAddress('afagus.13@gmail.com'); // кому
//TODO: Сделать возможной отправку на несколько адресов, возможно загнать всб функцию в цикл, с подставлением адресов
        $mail->Subject = $this->form->getNameFieldById($fields['SUBJECT']);
        $mail->msgHTML("<html><body>
                " . $this->form->getNameFieldById($fields['MESSAGE']) . "
                </body></html>");

        $mail->send();
    }

    static public function generateFormHandler($itemId, $typeHandler, $currentRoute)
    {
        $preferences = static::handlersFields['preferences'];

        ?>
        <form action="/<?= BASE ?>/saveHandler/<?= $itemId ?>" method="post">
            <table style="border: 1px solid black">
                <tr>
                    <td>Enter a name of Handler</td>
                    <td>
                        <input type="text" name="titleHandler">
                    </td>
                </tr>
                <tr>
                    <td><label for="type-of-handler">Type of Handler</label></td>
                    <td><input style="Border: none; outline: none; color: red" name="type-of-handler"
                               id="type-of-handler" value="<?= $typeHandler ?>"></td>
                </tr>
                <tr>
                    <td>
                        Enter Username for SMTP
                    </td>
                    <td>
                        <input type="text" name="smtp-User">
                    </td>
                </tr>
                <tr>
                    <td>
                        Enter password for SMTP
                    </td>
                    <td>
                        <input type="password" name="smtp-password">
                    </td>
                </tr>
                <?php foreach ($preferences as $key => $field): ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td> <?php self::viewListFields($key, $currentRoute); ?></td>
                    </tr>
                <?php endforeach; ?>


            </table>
            <input type="submit" name="saveHandler" value="Save">

        </form>
        <br>
        <form action="../construct/<?= $itemId ?>" method="post">
            <input type="submit" name="backToForm" value="Back">
        </form>
        <?php
    }

}