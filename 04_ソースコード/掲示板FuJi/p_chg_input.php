<?php
session_start();
?>
<!doctype html>
<!-- パスワード変更  -->
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FuJi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body class="text-center back-color">
  <!-- ヘッダー　-->
  <div class="container-fluid" style="padding-left: 0">
    <div class="row header-style">
      <div class="col-9 header-L">
        <img src="./img/logo.png" width="auto" height="100%" alt="logo" />
      </div>
      <div class="col-3 header-R-parent">
        <a href="./home.php" class="header-R-child-on">home</a>
        <div class="header-R-child-off">user</div>
        <!-- 「login」「logout」切り替え -->
        <?php
        if ($_SESSION['user_id'] == "0000000") {
          echo '<a href="./login.php" class="header-R-child-on">login</a>';
        } else {
          echo '<a href="./logout.php" class="header-R-child-on">logout</a>';
        }
        ?>
      </div>
    </div>
  </div>

  <div class="dropdown">
  </div>
  <h1 class="my-5" style="color: #ffffff; font-family: cursive;">掲示板FuJi</h1>
  <div class="container text-center">
    <div class="row justify-content-center">

      <!-- エラー表示 -->
      <?php
      if ($_SESSION['error'] != "") {
        echo '<div class="error">';
        echo $_SESSION['error'];
        echo '</div>';
      }
      ?>

      <form action="./p_chk.php" class="border rounded bg-white col-md-4 p-3" method="post">
        <h2 class="mt-3 mb-5" style="color: #000000; font-family: cursive;">パスワード変更</h2>
        <div class="mb-3">
          <input type="text" maxlength="16" class="form-control rounded-pill w-75 m-auto" placeholder="変更パスワード" name="pass1">
        </div>
        <div class="mb-3">
          <input type="text" maxlength="16" class="form-control rounded-pill w-75 m-auto" placeholder="確認用パスワード" name="pass2">
        </div>
        <button type="submit" class="btn btn-primary rounded-pill my-4 px-5">パスワード変更</button>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


</body>

</html>