<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/POP3.php';
require 'phpmailer/src/SMTP.php';

function sendmail($name, $email, $subject, $message){

        $mail = new PHPMailer;
        $mail->isSMTP();                   // Отправка через SMTP
        $mail->Host = 'smtp.gmail.com';  // Адрес SMTP сервера
        $mail->SMTPAuth = true;          // Enable SMTP authentication
        $mail->Username = 'afagus.13@gmail.com';       // ваше имя пользователя
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

        $mail->setFrom('afagus.13@gmail.com', $name);    // от кого
        $mail->addAddress('nikolaj.agro@gmail.com'); // кому

        $mail->Subject = $subject;
        $mail->msgHTML("<html><body>
                ".$message."
                </body></html>");

        $mail->send();


}