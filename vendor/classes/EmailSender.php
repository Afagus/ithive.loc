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
    const HANDLERSFIELDS = [
        'required_parameter' =>
            [
                [
                    'type' => 'text',
                    'name' => 'smtp-User',
                    'label' => 'Enter Username for SMTP'
                ],
                [
                    'type' => 'password',
                    'name' => 'smtp-password',
                    'label' => 'Enter password for SMTP'
                ]
            ],

        'preferences' =>
            [
                'NAME' => '',
                'SUBJECT' => '',
                'MESSAGE' => '',
                'EMAIL' => '',
                'PHONE' => '',
                'SELECT' => '',
                'CHECKBOX' => '',
                'RADIO' => ''
            ]

    ];

    public function send()
    {
        $fields = $this->preferences;
        mydebugger($fields);
        mydebugger($this->form->getNameFieldById($fields));

        exit;
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

        $mail->Subject = $this->form->getNameFieldById($fields['SUBJECT']);
        $mail->msgHTML("<html><body>
                " . $this->form->getNameFieldById($fields['MESSAGE']) . "
                </body></html>");

        $mail->send();
    }

    static public function generateFormHandler($formId, $handlerID, $typeHandler, $editData = '')
    {

        //$preferences = static::handlersFields['preferences'];

        ?>
        <form action="/<?= BASE ?>/<?= $editData ? 'updateHandler' : 'saveHandler' ?>/<?= $editData ? $handlerID: $formId ?>" method="post">
            <table style="border: 1px solid black">
                <tr>
                    <td>Enter a name of Handler</td>
                    <td>
                        <input type="text" name="titleHandler" value="<?= $editData['titleHandler'] ?? ''; ?>">
                    </td>
                <tr>
                    <td><label>Type of Handler</label></td>

                    <td><input style="Border: none; outline: none; color: red" name="type-of-handler"
                               id="type-of-handler" value="<?= $typeHandler ?>"></td>

                    <?php
                    foreach (self::HANDLERSFIELDS['required_parameter'] as $field): ?>
                <tr>
                    <td><label for="<?= $field['name'] ?>"><?= $field['label'] ?></label></td>
                    <td><input type="<?= $field['type'] ?>" name="<?= $field['name'] ?>" id="<?= $field['name'] ?>"
                               value="<?= $editData[$field['name']] ?? ''; ?>"></td>
                </tr>
                <?php endforeach;
                ?>

                <?php foreach (\vendor\classes\Form::getFieldsCollection($formId) as $field): ?>
                    <tr>
                        <td><?= $field['name']; ?></td>
                        <td><input type="checkbox" id="coding" name="checked_fields[]" value="<?= $field['id']; ?>"
                                <?php if ($editData):echo(in_array($field['id'], $editData['checked_fields']) ? 'checked' : '');endif; ?>>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </table>
            <input type="submit" name="saveHandler" value="Save">

        </form>
        <br>
        <form action="../construct/<?= $formId ?>" method="post">
            <input type="submit" name="backToForm" value="Back">
        </form>
        <?php
    }
//TODO Сделать упдейтер измененной формы
}