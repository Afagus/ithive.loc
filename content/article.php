<?php
require_once 'database/Data.php';

$formOutput = new \vendor\classes\Form($form);
var_dump($formOutput->createArraysOfFields($form));

$obj = new \vendor\classes\TextField($form);






