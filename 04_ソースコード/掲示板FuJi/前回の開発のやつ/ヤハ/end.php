<?php
session_start();
// var_dump($_SESSION['devices']);
if (count($_SESSION['devices']) != 0) {
    unset($_SESSION['devices']);
    require_once './DBManager.php';
    $dbmng = new DBManager();
    $dbmng->dateUpdate($_SESSION['user_id'], $_SESSION['cart_id']);
    $cart_id = $dbmng->cartIdMaxSelect();
    // echo "<p>" . $cart_id . "</p>";
    $cart_id++;
    // echo "<p>" . $cart_id . "</p>";
    $cart_id_str = str_pad($cart_id, 7, 0, STR_PAD_LEFT);
    // echo "<p>" . $cart_id_str . "</p>";
    $dbmng->cartIdInsert($_SESSION['user_id'], $cart_id_str);
    $_SESSION['cart_id'] = $cart_id_str;
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>カート完了試作</title>
    <style>
    </style>
    <script type="text/javascript">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>

    <nav class="navbar navbar-expand navbar-dark" style="background: #232f3e;" aria-label="2 番目のナビゲーション バーの例">
        <div class="container-fluid">
            <a class="nav-link" href="./itiran.php">
                <img src="./img/rogo.png" width="80" height="30" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="ナビゲーションを切り替える">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarsExample02">
                <ul class="navbar-nav">
                    <a class="nav-link" href="./logout.php">
                        ログアウト
                    </a>
                </ul>
                <form role="search">
                    <a class="nav-link" href="./ka-to.php">
                        <img src="./img/カート.png" width="80" height="30" class="img-fluid"></a>
                </form>
            </div>
        </div>
    </nav>

    <div class="end">
        <div class="text">
            <h1>ありがとうございます<br>
                注文を確定しました</h1>
        </div>
        <div class="btn">
            <button class="btn btn-warning btn-lg text-dark" type="button" onclick="location.href='itiran.php'">次へ</button>
        </div>
    </div>