<?php

use vendor\classes\PostProcessor;

require_once 'vendor/loader.php';
require_once 'content/header.php';
require_once 'content/footer.php';


if (!key_exists('saveHandler', $_POST)) {
    $data = [
        'formID' => ROUTE[1],
        'postprocessor_type' => $_POST['postprocessor'],
        'preferences' => 'some data'
    ];
    $lastHandler = \vendor\classes\PostProcessor::createHandler($data);


}
PostProcessor::generateFormHandler(ROUTE[1]);
