<?php
require_once 'vendor/loader.php';
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('DIR', __DIR__);
define('REQUEST_URI', $_SERVER['REQUEST_URI']);
?>
<!doctype html>
<html lang="en">
<head>
    <link href="/ithive.loc/css/style.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <header>
        <?php require_once 'content/header.php'; ?>
    </header>
    <article>
        <?php require_once 'content/article.php'; ?>
    </article>
    <aside>
        <?php require_once 'content/aside.php'; ?>
    </aside>

    <footer>
        <?php //require_once 'content/footer.php'; ?>
    </footer>

</body>
</html>