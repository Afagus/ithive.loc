<?php
$postprocessorType = $_POST['type-of-handler'];
$formID = ROUTE[1];

$titleHandler = $_POST['titleHandler'];
$preferences = json_encode($_POST, JSON_HEX_APOS);


$database = \database\singleConnect::getInstance();
$sql = "INSERT INTO postprocessing
(postprocessor_type, form, preferences, title)
VALUES (" .
    '\'' . $postprocessorType . '\'' . ', ' .
    '\'' . $formID . '\'' . ', ' .
    '\'' . $preferences . '\'' . ',' .
    '\'' . $titleHandler . '\'' .
    ")";


$sqlFields = $database->query($sql);
$lastID = $database->getLastId();
$getRequestFromDB = 'SELECT * 
                FROM table_form_building
                WHERE id = ' . $lastID;

$sqlGet = $database->query($getRequestFromDB);


$new_url = $_SERVER['HTTP_ORIGIN'] . '/' . BASE . "/construct/" . ROUTE[1];
header('Location: ' . $new_url);
exit;
