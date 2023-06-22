<?php
session_start();
?>
<!-- チャット画面 -->
<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FuJi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div style="width: 100%; height: 1000px;">

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

    <!-- 　-->
    <div style="display: flex; width: 100%; height: 50px;">
      <div style="background-color: aqua; width: 20%; height: 100%; line-height: 50px;">
        ユーザー名
        <a href="./new_topic.html"><i class="bi bi-plus"></i></a>
      </div>
      <div style="width: 80%; height: 100%; text-align: center;">雑談</div>
    </div>
    <div style="display: flex; width: 100%; height: 80%;">
      <div style="flex-flow: column;">
        <div class="topic" style="width: 100%;">
          <p>掲示板FuJiの使い方1</p>
        </div>
        <div class="topic" style="width: 100%;">
          <p>掲示板FuJiの使い方2</p>
        </div>
      </div>
      <!-- コンテンツ　-->
      <div style="background-color: chartreuse; width: 80%; height: 100%;">コンテンツ</div>
    </div>
    <!-- フッター -->
    <div style="display: flex; width: 100%; height: 10%;">
      <div style="background-color: pink; width: 100%; height: 100%;">フッター</div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>