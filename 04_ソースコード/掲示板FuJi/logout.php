<?php
session_start();
$_SESSION['user_id'] = "0000000";
$_SESSION['user_name'] = "gest";
$_SESSION['mail'] = "gest@gmail.com";
?>
<!doctype html>
<!-- ログアウト完了画面 -->
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FuJi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <div class="container-fluid" style="padding-left: 0">
    <!-- ヘッダー -->
  <div class="container-fluid" style="padding-left: 0">
    <div class="row header-style">
      <div class="col-9 header-L">
        <img src="./img/logo.png" width="auto" height="100%" alt="logo" />
      </div>
      <div class="col-3 header-R-parent">
        <a href="./home.php" class="header-R-child-on">home</a>
        <div class="header-R-child-off">user</div>
        <a href="./login.php" class="header-R-child-on">login</a>
      </div>
    </div>
  </div>


  <body class="text-center back-color">
    <h1 class="board title-color" style="font-family: cursive;">掲示板FuJi</h1>
    <div class="container text-center">
        <div class="row justify-content-center">
            <form class="border rounded bg-white col-md-4 p-3">
                <h3>ログアウトしました。</h3>
                <p>会話に参加するにはログインが必要です。</p>
                <p>ログインしますか?</p>
                <a href="./login.php"><button type="button" class="btn btn-primary rounded-pill my-4 px-5">ログインする</button></a>                
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>