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

    public function send()
    {
        $fields = $this->preferences;
        mydebugger($fields);

        $mail = new PHPMailer;
        $mail->isSMTP();                   // Отправка через SMTP
        $mail->Host = 'smtp.gmail.com';  // Адрес SMTP сервера
        $mail->SMTPAuth = true;          // Enable SMTP authentication
        $mail->Username = 'afagus.inv@gmail.com';       // ваше имя пользователя
        $mail->Password = 'G#inv2987103834!';    // ваш пароль
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

        $mail->setFrom('afagus.inv@gmail.com', $this->form->currentValue[$fields['NAME']]);    // от кого
        $mail->addAddress('afagus.13@gmail.com'); // кому

        $mail->Subject = $this->form->currentValue[$fields['SUBJECT']];
        $mail->msgHTML("<html><body>
                " . $this->form->currentValue[$fields['NAME']] . "
                </body></html>");

        $mail->send();

    }


}
