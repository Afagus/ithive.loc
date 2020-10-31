<?php
require_once 'vendor/classes/Form.php';

if (!$_GET) {
    ?>
    <h1>Вас приветствует панель Администратора</h1>

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
        <li><a href="/ithive.loc/index.php?showForm=<?= $value['id'] ?>">Ссылка на
                форму <?= $value['nameOfForm'] ?> </a></li>
        <?php
    }
    echo '</ul>';
}
/**
 * TODO check & kill the Notice
 **/
if (@$_GET['showForm']) {

    $formOutput = \vendor\classes\Form::getSingleForm($_GET['showForm']);
    $formOutput->viewForm();

    $database = \database\singleConnect::getInstance();
    $sql = 'SELECT * 
                FROM client_full_message
                WHERE form_ID = ' . $_GET['showForm'];
    $formFromQuery = $database->query($sql);


    echo '<ul>';
    foreach ($formFromQuery as $value) {
        ?>
        <li><a href="/ithive.loc/index.php?showMessage=<?= $value['id'] ?>">Ссылка на
                сообщение <?= $value['id'] ?> от <?= $value['date'] ?> </a></li>
        <?php
        if (@$_GET['showMessage']) {
            echo 'hello';
    }
    }
    echo '</ul>';

//    if (@$_GET['showMessage']) {
//echo 'hello';
////        $qq = \vendor\classes\Form::getFromDB($_GET['showMessage'], $_GET['showForm']);
////        $qq->viewForm();
//    }
}





// $qq = \vendor\classes\Form::getFromDB(2, 1);
// $qq->viewForm();


//$formOutput =\vendor\classes\Form::getSingleForm(1);
//$formOutput->viewForm();













