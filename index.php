<?php
ini_set('error_reporting', E_ALL);
require_once 'vendor/loader.php';
$tempDOCROOT = rtrim($_SERVER['DOCUMENT_ROOT'], '/').'/';
define('DOCUMENT_ROOT', $tempDOCROOT);
const DIR = __DIR__;
define('REQUEST_URI', $_SERVER['REQUEST_URI']);


require_once 'router/router.php';

//require_once 'content/article.php';
//require_once 'content/aside.php';
//require_once 'content/footer.php';

