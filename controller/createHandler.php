<?php

use vendor\classes\PostProcessor;

require_once 'vendor/loader.php';
require_once 'content/header.php';
require_once 'content/footer.php';

if (key_exists('saveHandler', $_POST)) {
    $data = [
        'formID' => ROUTE[1],
        'postprocessor_type' => $_POST['postprocessor'],
        'preferences' => 'some data',
        'titleHandler' => $_POST['titleHandler'] ?? ''
    ];
    $lastHandler = \vendor\classes\PostProcessor::createHandler($data);
    echo 'I`m in pp';

}

$typeHandler = $_POST['postprocessor'];
$formId = ROUTE[1];
$handlersFields = [

    'preferences' => [
        'NAME' => 'name',
        'EMAIL' => 'email',
        'PHONE' => 'phone',
        'MESSAGE' => 'message',
        'SUBJECT' => 'subject',
        'TITLE' => 'title'

    ],
    'typeHandler' => $typeHandler
];

$className = "\\vendor\classes\\" . $typeHandler;
$newHandler = new $className($formId, $handlersFields);

PostProcessor::generateFormHandler(ROUTE[1], $handlersFields);


