<?php


$postprocessorType = $_POST['type-of-handler'];

$titleHandler = $_POST['titleHandler'];
$preferences = json_encode($_POST, JSON_HEX_APOS);
$quote = '\'';



$database = \database\singleConnect::getInstance();
$sql = "UPDATE postprocessing
SET postprocessor_type = $quote$postprocessorType$quote, 
            preferences = $quote$preferences$quote,
                    title = $quote$titleHandler$quote
WHERE id = ". ROUTE[1];


$sqlFields = $database->query($sql);


$getRequestFromDB = 'SELECT *
               FROM postprocessing
              WHERE id = ' . ROUTE[1];

$sqlGet = $database->query($getRequestFromDB);

$new_url = $_SERVER['HTTP_ORIGIN'] . '/' . BASE . "/construct/" . $sqlGet[0]['form'];
header('Location: ' . $new_url);
exit;