<!-- ユーザー情報変更完了 -->
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

  <body class="text-center back-color">
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
<!--   
    戻るボタン
    <div style="width: 80px;">
      <a href="" class="btn-back">＜戻る</a> -->
      
      <!-- こんな処理 -->
      <!--      <a href=" phpの処理 " class="btn-back">＜戻る</a>      -->
    </div>
  
    <!-- 掲示板FuJi -->
    <h1 class="board title-color">掲示板FuJi</h1>
  
    <!-- フォーム -->
    <div class="container-fluid">
      <div class="row justify-content-center">
        <form action="./input_chk.php" method="post" class="border rounded bg-white col-lg-4 col-md-6 col-10 p-3">
          <h2 class="mt-3">ユーザー情報を変更しました。</h2>
          <a href="./usr_inf.php"><button type="button" class="btn btn-primary rounded-pill my-4 px-5">完了</button></a>
        </form>
      </div>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>