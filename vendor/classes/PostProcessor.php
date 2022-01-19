<?php


namespace vendor\classes;

use database\singleConnect;

abstract class PostProcessor
{

    public $form;
    public $preferences;
    const handlersFields = '';


    public function __construct($getForm, $preferences)
    {

        $this->preferences = json_decode($preferences['preferences'], true);
        $this->form = $getForm;
    }

    abstract static public function generateFormHandler($itemId, $typeHandler);

    abstract public function send();


    static public function deleteHandler($id)
    {
        $database = singleConnect::getInstance();
        $sqlQuery = 'DELETE 
    from postprocessing
    WHERE id = ' . $id;
        $database->query($sqlQuery);
        return $database->getLastId();

    }

    static public function getReceivers($form)
    {
        $database = singleConnect::getInstance();
        $sql = "Select * 
        from postprocessing
        where form = " . $form;
        return $database->query($sql);

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
     * нужно переделать содав запрос из базы данных и убрать хардкод
     **/
    public static function createArrayObject($formObject): array
    {


        $database = singleConnect::getInstance();   /*соединение с базой данных*/
        $sql = "Select *                            /*запрос в базу и получение всех постпроцессоров относящихся к текущей форме*/ 
        from postprocessing
        WHERE form = " . $formObject->formID;
        $result = $database->query($sql);


        $arrayOfPProc = [];
        foreach ($result as $element) {
            $className = "\\vendor\classes\\" . $element['postprocessor_type'];
            $arrayOfPProc[] = new $className($formObject, $element);

        }

        return $arrayOfPProc;
    }


    public static function viewListFields($key)
    {
        ?>
        <select name="<?= $key ?>" id="fieldList">
            <?php foreach (\vendor\classes\Form::getListOfFields() as $field): ?>
                <option value="<?= $field['name'] ?>"><?= $field['id'] ?></option>
            <?php endforeach; ?>
        </select>
        <?php
    }
}