<?php
$stringSelect = explode( PHP_EOL,$_POST['infoForSelect']);
$stringSelect = implode(',' , $stringSelect);

preg_match_all("#([^,\s]+):([^,\s]+)#s",$stringSelect,$out);
$outSelect = array_combine($out[1],$out[2]) ;
$outSelect = json_encode($outSelect, JSON_FORCE_OBJECT);

$database = \database\singleConnect::getInstance();
$sql = "INSERT INTO table_form_building
(form_ID, name, type_ID, placeholder, value, validation_ID, labelForLetter, options, title)
VALUES (" .
            ROUTE[1] . ', '.
            '\''. $_POST['nameField']. '\''.', ' .
            '\''. $_POST['typeField']. '\''.', ' .
            '\''. $_POST['placeholderField']. '\''.', ' .
            '\'\''.', ' .
            '\''. $_POST['validationField']. '\''.', ' .
            '\''. $_POST['labelForLetterField']. '\''.', ' .
            '\''. $outSelect . '\''.', ' .
            '\''. $_POST['placeholderField']. '\''.
             ")";
$sqlFields = $database->query($sql);
$lastID = $database->getLastId();
$getRequestFromDB = 'SELECT * 
                FROM table_form_building
                WHERE id = ' . $lastID;

$sqlGet = $database->query($getRequestFromDB);
echo json_encode($sqlGet);
