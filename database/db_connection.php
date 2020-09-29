<?php
/**
 * TODO Function of connection to database
 */
const DB_HOST = 'localhost';
const DB_LOGIN = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'form';

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die('Error of database');
mysqli_set_charset($link, "utf8");
$sql = 'SELECT * FROM table_form_building 
    JOIN table_types_of_fields ttof on ttof.id_types = table_form_building.type
    JOIN type_of_validation tov on tov.id_validation = table_form_building.validation';
$res = mysqli_query($link, $sql);
$form= mysqli_fetch_all($res, MYSQLI_ASSOC);
mysqli_close($link);


