<?php

use vendor\classes\PostProcessor;

require_once 'vendor/loader.php';
require_once 'content/header.php';
require_once 'content/footer.php';

$typeHandler = $_POST['postprocessor'];
$formId = ROUTE[1];


$className = "\\vendor\classes\\" . $typeHandler;
$className::generateFormHandler($formId,$typeHandler);


