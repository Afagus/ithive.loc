<?php
mydebugger($_POST);
$_POST['nameField']='dsfdsfsdfdsfasdasdsadasdasdasdasdsa';
$database = \database\singleConnect::getInstance();
$sql = "UPDATE table_form_building
SET name = ".'\''. $_POST['nameField']. '\''."

WHERE id = " . ROUTE[1];


$sqlFields = $database->query($sql);
//header("HTTP/1.1. 301 Moved Permanently");
//$string = "Location: $_SERVER[HTTP_REFERER]";
//header("$string");