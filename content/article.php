<?php
require_once 'database/Data.php';

$formOutput = new \vendor\classes\Form($form);
$formOutput->viewForm();

var_dump($formOutput->arrayOfFields);







