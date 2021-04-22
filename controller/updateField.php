<?php

$database = \database\singleConnect::getInstance();
$sql = "UPDATE table_form_building 
SET name = ".'\''. $_POST['nameField']. '\''."
WHERE id = " . ROUTE[1];

$sqlFields = $database->query($sql);
