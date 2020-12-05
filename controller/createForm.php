<?php
require_once 'vendor/loader.php';
require_once 'content/header.php';
$createForm = \vendor\classes\Form::createForm($_POST['name']);
header("HTTP/1.1. 301 Moved Permanently");
header("Location:/ithive.loc/construct/$createForm");

