<?php
require_once 'vendor/loader.php';
require_once 'content/header.php';
mydebugger($_POST);
$createForm = \vendor\classes\Form::createForm($_POST['name']);


