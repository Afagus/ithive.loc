<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
</head>
<body>
<br>

<br>
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

</body>
</html>
