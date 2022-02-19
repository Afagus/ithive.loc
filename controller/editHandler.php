<?php

use vendor\classes\PostProcessor;

require_once 'vendor/loader.php';
require_once 'content/header.php';
require_once 'content/footer.php';


$database = \database\singleConnect::getInstance();
$sql = "SELECT *
FROM postprocessing
 WHERE id = ". ROUTE[1] ;
$sqlGet = $database->query($sql);

$formId = $sqlGet[0]['form'];

$typeHandler = $sqlGet[0]['postprocessor_type'];
$data = json_decode($sqlGet[0]['preferences'],true);

$handlerID = $sqlGet[0]['id'];

$className = "\\vendor\classes\\" . $typeHandler;
$className::generateFormHandler($formId, $handlerID, $typeHandler, $data);
