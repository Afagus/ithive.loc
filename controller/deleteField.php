<?php
require_once 'vendor/loader.php';

$database = \database\singleConnect::getInstance();
$sql = 'DELETE FROM form.table_form_building
WHERE id = ' . ROUTE[1];
$tableTypes = $database->query($sql);
