<?php

require_once 'vendor/loader.php';
require_once 'content/header.php';
require_once 'content/footer.php';



$data = [
            'formID' => ROUTE[1],
            'postprocessor_type' => $_POST['postprocessor'],
            'preferences' => 'some data'
        ];
$lastHandler = \vendor\classes\PostProcessor::createHandler($data);
