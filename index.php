<?php
require_once 'vendor/loader.php';

?>
<!doctype html>
<html lang="en">
<head>
    <link href="css/style.css" rel="stylesheet">
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
    <?php
    $rootFolder = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', __DIR__));

    $temp = rtrim(ltrim($_SERVER['REQUEST_URI'], '/'), '/');
    $arrayQuery = str_replace($rootFolder, '', $temp);
    $arrayQuery = substr($arrayQuery, 1);
    $arrayQuery = explode('/', $arrayQuery);
    define('ROUTE', $arrayQuery);
    $filePath = ROUTE[0];

    if (!$filePath) {
        $filePath = 'controller/mainpage.php';
    } else {
        $filePath = 'controller/' . ROUTE[0] . '.php';
        if (!file_exists($filePath)) {
            $filePath = 'controller/404.php';
        }
    }
    require_once $filePath;
    mydebugger(ROUTE);
    ?>

    <form action="construct" method="post">
        <input type="submit" value="constructer" name="constructorForm">
    </form>
</article>
</body>
</html>
