<?php
require_once 'vendor/classes/Form.php';

if (!$_GET) {
    ?>
    <h1>Вас приветствует панель Администратора</h1>
    <?php
    $database = \database\singleConnect::getInstance();
    $sql = 'SELECT * FROM main_form ';
    $form = $database->query($sql);


    echo '<ul>';
    foreach ($form as $value) {
        ?>
        <li><a href="/ithive.loc/index.php?showForm=<?= $value['id'] ?>">Ссылка на форму <?= $value['nameOfForm'] ?> </a></li>
        <?php
    }
    echo '</ul>';

    if (empty($_GET['showForm'])) {
        $formOutput = \vendor\classes\Form::getSingleForm($_GET['showForm']);
        $formOutput->viewForm();
    }
} else {
    echo 'crash';
    // $qq = \vendor\classes\Form::getFromDB(2, 1);
    // $qq->viewForm();
}

//$formOutput =\vendor\classes\Form::getSingleForm(1);
//$formOutput->viewForm();













