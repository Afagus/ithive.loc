<?php


namespace vendor\classes;


abstract class PostProcessor
{
    public $name;
    public $emailReceiver;
    public $subject;
    public $message;
    public $emailSender;

    public function __construct($getInfoFromUser)
    {
        $this->name = $getInfoFromUser['name'];
        $this->subject = $getInfoFromUser['subject'];
        $this->message = $getInfoFromUser['message'];
        $this->emailReceiver = $getInfoFromUser['emailReceiver'];
        $this->emailSender = $getInfoFromUser['email'];
        $this->test($getInfoFromUser);

    }

    public function test($getInfoFromUser){
        print_r($getInfoFromUser);
    }


}