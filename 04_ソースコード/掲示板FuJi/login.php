<?php
session_start();
?>
<!-- ログイン画面 -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FuJi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
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
        <div class="header-R-child-off">logout</div>
      </div>
    </div>
  </div>

  <!-- 戻るボタン -->
  <!-- <div style="width: 80px;">
    <a href="

    <?php
    // 現在は「login.php」に設定している。本番は設定を消す
    $_SESSION['page'] = "login.php";
    echo $_SESSION['page'];
    ?>
        
    " class="btn-back">＜戻る</a>
    
  </div> -->

  <!-- 掲示板FuJi -->
  <h1 class="board">掲示板FuJi</h1>

  <!-- フォーム -->
  <div class="container-fluid">
    <div class="row justify-content-center">
      <form action="./usr_exist.php" method="post" class="border rounded bg-white col-lg-4 col-md-6 col-10 p-3">
        <h2 class="mt-3">ログインして会話に参加しましょう!</h2>

        <!-- エラー表示 -->
        <?php
        if ($_SESSION['error'] != "") {
          echo '<div class="error">';
          echo $_SESSION['error'];
          echo '</div>';
        }
        ?>

        <div class="mt-3 mb-3">
          <input type="text" class="form-control rounded-pill w-75 m-auto" name="mail" placeholder="メールアドレス" />
        </div>
        <div class="mb-3">
          <input type="text" class="form-control rounded-pill w-75 m-auto" name="pass" placeholder="パスワード" />
        </div>
        <div>
          <input type="submit" class="btn btn-primary rounded-pill my-4 px-5" value="ログイン" />
        </div>
        <div>
          <a href="./p_chg_usr_chk.html">
            <button type="button" class="btn btn-link">
              パスワードを忘れた方はこちら
            </button>
          </a>
        </div>
        <div>
          <a href="./s_up.php">
            <button type="button" class="btn btn-link">新規登録</button>
          </a>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>