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
        $sql = "INSERT INTO receiver (postprocessor_type)
        VALUES ('$data')";

        $database->query($sql);

        return $database->getLastId();
    }

    static public function getListOfReceivers()
    {
        $database = singleConnect::getInstance();
        $sql = "Select postprocessor_type 
        from receiver";
        return $database->query($sql);

    }

    /**
     *
     *Создание массива из объектов постобработчиков
     *
     **/
    public static function createArrayObject($formObject)
    {

        $database = singleConnect::getInstance();   /*соединение с базой данных*/
        $sql = "Select *                            /*запрос в базу и получение всех постпроцессоров относящихся к текущей форме*/ 
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
                    'SUBJECT' => 'subject',
                    'TITLE' => 'title'
                ]
            ];

            $className = "\\vendor\classes\\" . $element['postprocessor_type'];

            $arrayOfPProc[] = new $className($formObject, $element);
        }
        return $arrayOfPProc;
    }


    public static function createHandler($data)
    {

        $database = singleConnect::getInstance();
        $pp_data = $data['postprocessor_type'];
        $pp_form = $data['formID'];
        $pp_preferences = $data['preferences'];
        $sql = "INSERT INTO postprocessing (postprocessor_type, form, preferences)
        VALUES ('$pp_data','$pp_form', '$pp_preferences' )";

        $database->query($sql);

        return $database->getLastId();
    }
}