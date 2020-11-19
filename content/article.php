<?php
require_once 'vendor/loader.php';

$rootFolder = str_replace(DOCUMENT_ROOT, '', str_replace('\\', '/', DIR));

$temp = rtrim(ltrim(REQUEST_URI, '/'), '/');
$arrayQuery = str_replace($rootFolder, '', $temp);
$arrayQuery = substr($arrayQuery, 1);
$arrayQuery = explode('/', $arrayQuery);
define('ROUTE', $arrayQuery);
$filePath = ROUTE[0];

if (!$filePath) {
    $filePath = 'controller/mainpage.php';
} else {
    $filePath = 'controller/' . ROUTE[0] . '.php';
    if (!file_exists($filePath)) {
        $filePath = 'controller/404.php';
    }
}
require_once $filePath;

?>

<form action="construct" method="post">
    <input type="submit" value="construct" name="constructorForm">
</form>