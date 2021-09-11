<?php


namespace vendor\classes;

use database\singleConnect;

abstract class PostProcessor
{
    public $name;
    public $emailReceiver;
    public $subject;
    public $message;
    public $emailSender;
    public $totalInfo;

    public function __construct($getInfoFromUser)
    {
        $this->name = $getInfoFromUser['name'];
        $this->subject = $getInfoFromUser['subject'];
        $this->message = $getInfoFromUser['message'];
        $this->emailReceiver = $getInfoFromUser['emailReceiver'];
        $this->emailSender = $getInfoFromUser['email'];
        $this->totalInfo = $getInfoFromUser;

    }

    public function test($getInfoFromUser)
    {
        print_r($getInfoFromUser);
    }

    public function sendTypePostProcessorToDB($data)
    {
        $database = \database\singleConnect::getInstance();
        $sql = "INSERT INTO receiver (receiver_type)
        VALUES ('$data')";

        $database->query($sql);

        return $database->getLastId();
    }

    static public function getListOfReceivers()
    {
        $database = singleConnect::getInstance();
        $sql = "Select receiver_type 
        from receiver";
        return $database->query($sql);

    }


}