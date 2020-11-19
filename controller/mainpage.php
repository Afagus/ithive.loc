<?php
require_once 'vendor/loader.php';
?>

 <h1>Выберите форму</h1>

    <?php
    $database = \database\singleConnect::getInstance();
    $sql = 'SELECT * FROM main_form ';
    $formFromQuery = $database->query($sql);

    /**
     * Выводим список форм, которые находятся в базе данных в таблице main_form
     */
    echo '<ul>';
    foreach ($formFromQuery as $value) {
        ?>
        <li><a href="/ithive.loc/showForm/<?= $value['id'] ?>">Ссылка на
                форму <?= $value['nameOfForm'] ?> </a></li>
        <?php
    }
    echo '</ul>';
?>

