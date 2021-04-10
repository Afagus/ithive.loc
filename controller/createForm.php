<?php
require_once 'vendor/loader.php';

$createForm = \vendor\classes\Form::createForm($_POST['name']);
echo json_encode($createForm);

