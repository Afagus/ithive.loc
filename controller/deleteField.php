<?php
require_once 'vendor/loader.php';

$database = \database\singleConnect::getInstance();
$sql = 'DELETE FROM form.table_form_building
WHERE id = ' . ROUTE[1];
$tableTypes = $database->query($sql);
header("HTTP/1.1. 301 Moved Permanently");
$string = "Location: $_SERVER[HTTP_REFERER]";
header("$string");