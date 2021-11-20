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



    public function __construct($getForm, $getPostProc)
    {
        $this->name = $getForm->currentValue['name'];
        $this->email = $getForm->currentValue['email'];
        $this->subject = $getForm->currentValue['subject'];
        $this->message = $getForm->currentValue['message'];

    }


    public function send(){

        $mail = new PHPMailer;
        $mail->isSMTP();                   // Отправка через SMTP
        $mail->Host = 'smtp.gmail.com';  // Адрес SMTP сервера
        $mail->SMTPAuth = true;          // Enable SMTP authentication
        $mail->Username = 'afagus.dev@gmail.com';       // ваше имя пользователя
        $mail->Password = 'Gg#2987103834!';    // ваш пароль
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

        $mail->setFrom('afagus.dev@gmail.com', $this->name);    // от кого
        $mail->addAddress('afagus.13@gmail.com'); // кому

        $mail->Subject = $this->subject;
        $mail->msgHTML("<html><body>
                ".$this->message."
                </body></html>");

        $mail->send();

    }

}