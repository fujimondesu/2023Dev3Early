<?php
session_start();
?>

<!doctype html>
<!-- 新規登録　確認 -->
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FuJi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
  </head>
  
  <!-- ヘッダー　-->
  <div class="container-fluid" style="padding-left: 0">
    <div class="row header-style">
      <div class="col-9 header-L">
        <img src="./img/logo.png" width="auto" height="100%" alt="logo" />
      </div>
      <div class="col-3 header-R-parent">
        <a href="./home.php" class="header-R-child-on">home</a>
        <a href="./usr_inf.html" class="header-R-child-on">user</a>

        <!-- 「login」「logout」切り替え -->
        <?php
        $link = "login";
        if ($_SESSION['user_id'] == "0000000") {
          $link = "logout";
        }
        echo '<a href="' . $link . '.php" class="header-R-child-on">' . $link . '</a>';
        ?>

        <!-- <a href="./logout.php" class="header-R-child-off">logout</a> -->
      </div>
    </div>
  </div>


  <body class="text-center" style="background-color: #f596aa;">
    <h1 class="my-5" style="color: #ffffff; font-family: cursive;">掲示板FuJi</h1>
    <div class="container text-center">
        <div class="row justify-content-center">
            <form class="border rounded bg-white col-md-4 p-3">
                <h3>こちらの内容で登録しますか。</h3>
                <p></p>
                <p>メールアドレス : <?php echo $_SESSION ['mail']?></p>
                <p>パスワード: <?php echo $_SESSION['pass'];?></p>
                <p>ユーザー名: <?php echo $_SESSION['user_name'];?></p>
                <a href="./usr_reg.php"><button type="button" class="btn btn-primary rounded-pill my-4 px-5">登録する</button></a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>