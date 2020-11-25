<?php
mydebugger($_POST);
mydebugger(ROUTE[1]);
$database = \database\singleConnect::getInstance();
$sql = "INSERT INTO table_form_building
(form_ID, name, type_ID, placeholder, value, validation_ID, labelForLetter, options, title)
VALUES (" .
            ROUTE[1] . ', '.
            '\''. $_POST['nameField']. '\''.', ' .
            '\''. $_POST['typeField']. '\''.', ' .
            '\''. $_POST['placeholderField']. '\''.', ' .
            '\''. "NULL" . '\''.', ' .
            '\''. $_POST['validationField']. '\''.', ' .
            '\''. $_POST['labelForLetterField']. '\''.', ' .
            '\''. "NULL". '\''.', ' .
            '\''. "NULL". '\''.
             ")";
echo $sql;
$sqlFields = $database->query($sql);
header("HTTP/1.1. 301 Moved Permanently");
$string = "Location: $_SERVER[HTTP_REFERER]";
header("$string");