<?php
require_once 'vendor/loader.php';
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('DIR', __DIR__);
define('REQUEST_URI', $_SERVER['REQUEST_URI']);


require_once 'router/router.php';
//require_once 'content/article.php';
//require_once 'content/aside.php';
//require_once 'content/footer.php';

