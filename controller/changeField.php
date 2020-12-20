<?php
require_once 'vendor/changeField.php';
require_once 'vendor/DBTableInfo.php';

$tableTypes = DBTableInfo();

updateField ($tableTypes['typeOfFields'], $tableTypes['typeOfValidations'], $tableTypes['tableField']);