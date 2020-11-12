<?php
require_once 'vendor/loader.php';

$REQUEST_URI = substr($_SERVER['REQUEST_URI'], 1);
$arrayQuery = explode('/', $REQUEST_URI);
mydebugger($REQUEST_URI);
mydebugger($arrayQuery);
mydebugger($_GET);

if (!$_GET){
    require_once 'controller/mainpage.php';
}

if ($_GET) {
    $test = 'controller/' . "$arrayQuery[2]." . "php";
    if (file_exists($test)) {

        require_once $test;
    } else {
        require_once 'controller/404.php';
    }
}
