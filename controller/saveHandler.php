<?php

mydebugger($_POST);
$preferences = json_encode($_POST, JSON_HEX_APOS );
$postprocessorType = $_POST['type-of-handler'];
$formID = ROUTE[1];

mydebugger($preferences);
$database = \database\singleConnect::getInstance();
$sql = "INSERT INTO postprocessing
(postprocessor_type, form, preferences)
VALUES (" .
    '\''. $postprocessorType. '\''.', ' .
    '\''. $formID. '\''.', ' .
    '\''. $preferences. '\''.
    ")";

echo('
'.$sql.'
');
$sqlFields = $database->query($sql);
$lastID = $database->getLastId();
$getRequestFromDB = 'SELECT * 
                FROM table_form_building
                WHERE id = ' . $lastID;

$sqlGet = $database->query($getRequestFromDB);


$new_url = ;
header('Location: ' . $new_url);
