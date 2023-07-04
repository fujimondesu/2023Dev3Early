<!-- テスト用 -->
<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
$userInfo = $dbmng->userInfoGet($_SESSION['user_id']);

$mail,$pass,$name;

foreach ($userInfo as $row) {
  $mail = $row['mail_address'];
  $pass = $row['password'];
  $name = $row['user_name'];
}
?>


<!-- ユーザー情報 -->
<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FuJi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body class="text-center">
    <!-- ヘッダー -->
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
          }else{
            echo '<a href="./logout.php" class="header-R-child-on">logout</a>';
          }
          ?>
        </div>
    </div>
  </div>
  
    <!-- 戻るボタン -->
    <div style="width: 80px;">
      <a href="#" class="btn-back">＜戻る</a>
    </div>

    <!-- 掲示板FuJi -->
    <h1 class="board">掲示板FuJi</h1>
  
    <!-- フォーム -->
    <div class="container-fluid">
      <div class="row justify-content-center">
        <form action="./input_chk.php" method="post" class="border rounded bg-white col-lg-4 col-md-6 col-10 p-3">
          <h2 class="mt-3 mb-5" >ユーザー情報</h2>
          <div class="mb-3">メールアドレス : <?php echo $mail;?></div>
          <div class="mb-3">パスワード : <?php echo $pass;?></div>
          <div class="mb-3"> ユーザー名 : <?php echo $name;?></div>
          <div>
          <a href="./usr_inf_chg.php"><button type="button" class="btn btn-primary rounded-pill my-4 px-5">ユーザー情報の変更</button></a>
          </div>
          <div>
          <a href="./home.php"><button type="button" class="btn btn-primary rounded-pill my-4 px-5">ホーム画面へ</button></a>
          </div>
        </form>
      </div>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>