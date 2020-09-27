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
    <?php require_once 'content/header.php';?>

</header>
<article>


    <?php require_once 'content/article.php';?>

</article>
<aside>
    <?php require_once 'content/aside.php';?>
</aside>
<footer>
    <?php require_once 'content/footer.php';?>
</footer>



<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'form';

$link= mysqli_connect($host, $user, $password, $db_name);
$query = "SELECT * FROM table_form_building WHERE id_form > 0";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
mydebugger($data);


?>

</body>
</html>