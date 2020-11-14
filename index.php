<?php
require_once 'vendor/loader.php';
const DIR = __DIR__;
define('REQUEST_URI', $_SERVER['REQUEST_URI']);



$rootPath = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', __DIR__));
$arrayQuery = explode('/', str_replace(REQUEST_URI, '',$rootPath . '/'));
$pureQuery = (str_replace($rootPath, '', $arrayQuery));

define('ROUTE', $arrayQuery);
mydebugger(ROUTE);

$filePath = ROUTE[0];

mydebugger($filePath);

if (!$filePath) {
    $filePath = 'controller/mainpage.php';
} else {
    $filePath = 'controller/' . ROUTE[0] . '.php';

    if (!file_exists($filePath)) {
        $filePath = 'controller/404.php';
    }
}
require_once $filePath;

mydebugger($filePath);