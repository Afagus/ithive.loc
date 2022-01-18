<?php

use vendor\classes\PostProcessor;

require_once 'vendor/loader.php';
require_once 'content/header.php';
require_once 'content/footer.php';


mydebugger($_POST);
if (key_exists('saveHandler', $_POST)) {
//    $data = [
//        'formID' => ROUTE[1],
//        'postprocessor_type' => $_POST['postprocessor'],
//        'preferences' => 'some data',
////        'titleHandler' => $_POST['titleHandler'] ?? ''
////    ];
//    $lastHandler = \vendor\classes\PostProcessor::createHandler($data);
//    echo 'I`m in pp';

}

$typeHandler = $_POST['postprocessor'];
$formId = ROUTE[1];


$className = "\\vendor\classes\\" . $typeHandler;
$className::generateFormHandler($formId,$typeHandler);


