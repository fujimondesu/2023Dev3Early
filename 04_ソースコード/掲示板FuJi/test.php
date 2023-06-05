<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    require_once './DBManager.php';
    $dbmng = new DBManager();
    $test = $dbmng->test();
    $name;
    foreach ($test as $row) {
        $name = $row['user_name'];
    }

    echo '<h1>'.$name.'</h1>';

    ?>
</body>
</html>