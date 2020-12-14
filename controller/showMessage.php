<?php
require_once 'vendor/loader.php';
require_once 'content/header.php';

$qq = \vendor\classes\Form::getFromDB(ROUTE[1]);
$qq->viewForm();