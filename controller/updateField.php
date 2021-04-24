<?php

$database = \database\singleConnect::getInstance();
$sql = "UPDATE table_form_building 
SET name = ".'\''. $_POST['nameField']. '\''."
WHERE id = " . ROUTE[1];

$sqlFields = $database->query($sql);


$sql2= 'SELECT name 
                FROM table_form_building
                WHERE id = ' . ROUTE[1];

$lastName = $database->query($sql2);

echo json_encode($lastName[0]['name']);
