<?php
require_once 'vendor/loader.php';

$qq = \vendor\classes\Form::getFromDB(ROUTE[1]);
$qq->viewForm();