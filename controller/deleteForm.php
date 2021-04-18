<?php
require_once 'vendor/loader.php';
$createForm = \vendor\classes\Form::deleteForm(ROUTE[1]);

//echo 'Сработал action';
header("HTTP/1.1. 301 Moved Permanently");
$string = "Location: $_SERVER[HTTP_REFERER]";
header("$string");