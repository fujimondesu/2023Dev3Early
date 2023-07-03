<?php
session_start();

// テスト用
// $_SESSION['genre_id'] = "9";
// $_SESSION['room_name'] = "test create";
// $_SESSION['detail'] = "new cteate";
?>
<!doctype html>
<!-- 新規話題作成-->
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FuJi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
  </head>
  
  <body class="text-center" style="background-color: #f596aa;">
    <!-- ヘッダー -->
  <div class="container-fluid" style="padding-left: 0">
    <div class="row header-style">
      <div class="col-9 header-L">
        <img src="./img/logo.png" width="auto" height="100%" alt="logo" />
      </div>
      <div class="col-3 header-R-parent">
        <a href="./home.php" class="header-R-child-on">home</a>
        <a href="./usr_inf.php" class="header-R-child-on">user</a>
        <a href="./logout.php" class="header-R-child-on">logout</a>
      </div>
    </div>

    <!-- 戻るボタン -->
    <div style="width: 80px;">
      <a href="#" class="btn-back">＜戻る</a>
    </div>
    
    <!-- フォーム -->
    <h1 class="my-5" style="color: #ffffff; font-family: cursive;">掲示板FuJi</h1>
    <div class="container text-center">
      <div class="row justify-content-center">

        <form action="./new_thread_create.php" method="post" class="border rounded bg-white col-md-4 p-3">
          <div class="form-group">
            <label for="thread-name">スレッド名</label>
            <input type="text" name="room_name" class="form-control" id="thread-name" placeholder="スレッドの名前">
          </div>
          <div class="form-group">
            <label for="thread-
            explanation">スレッドの説明</label>
            <input type="text" name="detail"  class="form-control" id="explanation" placeholder="スレッドの説明">
          </div>
          <div class="mt-4">
            <label for="genre_id">ジャンル選択をしてください</label>
            <select name="genre_id">
              <option value="9">その他</option>
              <option value="1">ニュース</option>
              <option value="2">ゲーム</option>
              <option value="3">スポーツ</option>
              <option value="4">アニメ</option>
            </select>
            <input class="btn btn-primary rounded-pill my-4 px-5" type="submit" value="新規作成">
          </div>
        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>