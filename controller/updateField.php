<?php
$stringSelect = explode( PHP_EOL,$_POST['infoForSelect']);
$stringSelect = implode(',' , $stringSelect);

preg_match_all("#([^,\s]+):([^,\s]+)#s",$stringSelect,$out);
$outSelect = array_combine($out[1],$out[2]) ;
$outSelect = json_encode($outSelect, JSON_FORCE_OBJECT);

$database = \database\singleConnect::getInstance();
$sql = "UPDATE table_form_building 
SET name = ".'\''. $_POST['nameField']. '\''." ,
    type_ID = ".'\''. $_POST['typeField']. '\''." ,
    placeholder = ".'\''. $_POST['placeholderField']. '\''.",
    validation_ID = ".'\''. $_POST['validationField']. '\''.",
    labelForLetter = ".'\''. $_POST['labelForLetterField']. '\''."






WHERE id = " . ROUTE[1];

$sqlFields = $database->query($sql);


$sql2= 'SELECT name, id
                FROM table_form_building
                WHERE id = ' . ROUTE[1];

$lastName = $database->query($sql2);

echo json_encode($lastName);
