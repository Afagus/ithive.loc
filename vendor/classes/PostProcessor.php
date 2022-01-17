<?php


namespace vendor\classes;

use database\singleConnect;

abstract class PostProcessor
{

    public $form;
    public $preferences;
    const handlersFields = '';



    public function __construct($getForm)
    {


        $this->form = $getForm;
    }

    abstract static public function generateFormHandler($itemId,$typeHandler);
    abstract public function send();



    static public function getReceivers($form)
    {
        $database = singleConnect::getInstance();
        $sql = "Select * 
        from postprocessing
        where form = ". $form;
        return $database->query($sql);

    }    static public function getListOfReceivers()
    {
        $database = singleConnect::getInstance();
        $sql = "Select postprocessor_type 
        from receiver";

        return $database->query($sql);

    }

    /**
     *
     *Создание массива из объектов постобработчиков
     * нужно переделать содав запрос из базы данных и убрать хардкод
     **/
    public static function createArrayObject($formObject): array
    {

        $database = singleConnect::getInstance();   /*соединение с базой данных*/
        $sql = "Select *                            /*запрос в базу и получение всех постпроцессоров относящихся к текущей форме*/ 
        from postprocessing
        WHERE form = " . $formObject->formID;
        $result = $database->query($sql);
        var_dump($result);

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


//    public static function createHandler($data)
//    {
//        $database = singleConnect::getInstance();
//        mydebugger($data);
//        $pp_title = $data['titleHandler'];
//        $pp_data = $data['postprocessor_type'];
//        $pp_form = $data['formID'];
//        $pp_preferences = $data['preferences'];
//        $sql = "INSERT INTO postprocessing (postprocessor_type, form, preferences)
//        VALUES ('$pp_title','$pp_data','$pp_form','$pp_preferences' )";
//
//        $database->query($sql);
//
//        return $database->getLastId();
//    }

    public static function viewListFields($key)
    {
        ?>
        <select name="<?=$key?>" id="fieldList">
            <?php foreach (\vendor\classes\Form::getListOfFields() as $field): ?>
                <option value="<?= $field['name'] ?>"><?= $field['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <?php
    }
}