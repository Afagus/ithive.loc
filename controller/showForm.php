<?php
require_once 'vendor/loader.php';

$formOutput = \vendor\classes\Form::getSingleForm(ROUTE[1]);
$formOutput->viewForm();

$database = \database\singleConnect::getInstance();
$sql = 'SELECT * 
                FROM client_full_message
                WHERE form_ID = ' . ROUTE[1];
/**
 * Вывод списка сообщений из имеющихся в БД
 */
$formFromQuery = $database->query($sql);


echo '<ul>';
foreach ($formFromQuery as $value) {
    ?>
    <li><a href="/ithive.loc/showMessage/<?= $value['id'] ?>">Ссылка
            на сообщение <?= $value['id'] ?> от <?= $value['date'] ?> </a>
    </li>
    <?php
}
echo '</ul>';