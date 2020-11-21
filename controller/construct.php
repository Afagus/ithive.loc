<?php
require_once 'vendor/loader.php';
?>
    <h1>Тут будет конструктор формы</h1>
<?php

$database = \database\singleConnect::getInstance();
$sql = 'SELECT * FROM form.table_form_building
        WHERE form_ID = '. ROUTE[1];

$tableTypes = $database->query($sql);



?>
<table>
<tr><?php foreach ($tableTypes as $tableType) {?>
    <td><?= 'Тип поля '.'<b>' . $tableType['name'] . '</b>';?></td>
    <td><form action="/ithive.loc/deleteField/<?= $tableType['id']?>" method="post"> <input type="submit" name="delete" value="delete" ></form></td></tr>
    <?php }

?>
</table>


