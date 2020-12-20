<?php
function DBTableInfo()
{
    $database = \database\singleConnect::getInstance();
    $sqlChecked = 'SELECT * FROM form.table_form_building
        WHERE form_ID = ' . ROUTE[1];
    $sqlTypesOfFields = 'SELECT * FROM form.table_types_of_fields';
    $sqlTypesOfValidation = 'SELECT * FROM form.type_of_validation';
    $sqlTableField = 'SELECT * FROM form.table_form_building
        WHERE id = ' . ROUTE[1];

    $tableInfo['tableTypes'] = $database->query($sqlChecked);
    $tableInfo['typeOfFields'] = $database->query($sqlTypesOfFields);
    $tableInfo['typeOfValidations'] = $database->query($sqlTypesOfValidation);
    $tableInfo['tableField'] = $database->query($sqlTableField);

    return $tableInfo;

}