<?php
require_once 'vendor/createNewField.php';
require_once 'vendor/DBTableInfo.php';

$tableTypes = DBTableInfo();
mydebugger($tableTypes['tableField']);
createNewField($tableTypes['typeOfFields'], $tableTypes['typeOfValidations'], $tableTypes['tableField']);