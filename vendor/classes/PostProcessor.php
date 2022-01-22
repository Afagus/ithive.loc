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

    abstract static public function generateFormHandler($itemId, $typeHandler, $currentRoute);

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

    /**
     * Получение списка постобработчиков, которые относятся к конкретной форме
     */
    static public function getReceivers($form)
    {
        $database = singleConnect::getInstance();
        $sql = "Select * 
        from postprocessing
        where form = " . $form;
        return $database->query($sql);

    }

    /**
     * Получение списка типов всех постобработчиков находящихся в базе
     * */
    static public function getRecieversList()
    {
        $database = singleConnect::getInstance();
        $sql = "Select postprocessor_type 
        from receiver";

        return $database->query($sql);

    }

    /**
     *Создание массива из объектов постобработчиков
     **/
    public static function createArrayObject($formObject): array
    {
        $idForm = $formObject->getFormId();
        $result = self::getReceivers($idForm);
        $arrayOfPProc = [];

        foreach ($result as $element) {
            $className = "\\vendor\classes\\" . $element['postprocessor_type'];
            $arrayOfPProc[] = new $className($formObject, $element);
        }
        return $arrayOfPProc;
    }


    public static function viewListFields($key, $currentRoute)
    {
        ?>
        <select name="<?= $key ?>" id="fieldList">
            <?php foreach (\vendor\classes\Form::getFieldsCollection($currentRoute) as $field): ?>
                <option value="<?= $field['id'] ?>"><?= $field['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <?php
    }
}