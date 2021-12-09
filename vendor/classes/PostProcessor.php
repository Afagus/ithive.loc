<?php


namespace vendor\classes;

use database\singleConnect;

abstract class PostProcessor
{

    public $form;
    public $preferences;


    public function __construct($getForm, $data)
    {
        $this->preferences = $data['preferences'];
        $this->form = $getForm;
    }

    abstract public function send();


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
    /***
     * Временный код для заноса данных в базу
     */



    /**
     *
     *Конец временный код для заноса данных в базу
     *
     **/

    public static function createArrayObject($formObject)
    {

        $database = singleConnect::getInstance();
        $sql = "Select * 
        from postprocessing
        WHERE form = " . $formObject->formID;
        $result = $database->query($sql);

        $arrayOfPProc = [];
        foreach ($result as $element) {
            $element['preferences'] = [
                'fields' => [
                    'NAME' => 'name',
                    'EMAIL' => 'email',
                    'PHONE' => 'phone',
                    'MESSAGE' => 'message',
                ]
            ];

            $className = "\\vendor\classes\\" . $element['postprocessor_type'];

            $arrayOfPProc[] = new $className($formObject, $element);
        }

        return $arrayOfPProc;
    }


}