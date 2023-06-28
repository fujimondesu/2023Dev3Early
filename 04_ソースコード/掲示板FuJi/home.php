<?php
session_start();
$_SESSION['error'] = "";
// session_destroy();
// 初回、セッションに「user_id」が無ければ、「0000000」で上書きし、ゲストモードにする
if (empty($_SESSION['user_id'])) {
  $_SESSION['user_id'] = "0000000";
}
require_once './DBManager.php';
$dbmng = new DBManager();
// ジャンル一覧取得
$getGenres = $dbmng->getGenre();
$userName = $dbmng->userNameGet($_SESSION['user_id']);
$userName = $userName[0][0];
$genreNames;
$genreIds;
$i = 0;
foreach ($getGenres as $row) {
  $genreIds[$i] = $row['genre_id'];
  $genreNames[$i] = $row['genre_name'];
  $i++;
}
?>
<!-- ホーム画面(最初ここ) -->
<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FuJi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./css/style.css">
  <style>
    article,
    h2,
    time,
    p {
      margin: 0;
      padding: 0;
      border: 0;
      outline: 0;
      font-size: 100%;
      vertical-align: baseline;
      background: transparent;
    }

    section {
      margin-left: 5%;
      margin-right: 5%;
      padding: 0;
      border: 0;
      outline: 0;
      font-size: 100%;
      vertical-align: baseline;
      background: transparent;
    }

    article,
    section {
      height: 200px;
      display: block;
    }

    article {
      margin-top: 20px;
      padding: 20px;
      border-radius: 10px;
      background: #fff;
    }

    article.reply {
      position: relative;
      margin-top: 15px;
      margin-left: 30px;
    }

    article.reply::before {
      position: absolute;
      top: -10px;
      left: 20px;
      display: block;
      content: "";
      border-top: none;
      border-left: 7px solid #f7f7f7;
      border-right: 7px solid #f7f7f7;
      border-bottom: 10px solid #fff;
    }

    .info {
      margin-bottom: 10px;
      text-align: left;
    }

    .info h2 {
      display: inline-block;
      margin-right: 10px;
      color: #222;
      line-height: 1.6em;
      font-size: 100%;
    }

    .info time {
      color: #999;
      line-height: 1.6em;
      font-size: 72%;
    }

    article p {
      color: #555;
      text-align: left;
      font-size: 100%;
      line-height: 1.6em;
    }

    .viewScroll {
      width: 100%;
      height: 100%;
      overflow-y: scroll;
    }

    .genres label {
      display: block;
      /* width: 150px; */
      background: white;
      color: #000;
      padding: 10px;
      /* margin: 10px; */
      box-sizing: border-box;
      text-align: center;
      text-decoration: none;
      cursor: pointer;
      border: 1px solid;
      border-color: transparent transparent rgb(188, 188, 188) transparent;
    }

    .genres input:checked+label {
      background: #D4FFFC;
      color: black;
    }

    .genres input {
      display: none;
    }
  </style>
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

        <!-- 「login」「logout」切り替え -->
        <?php
        if ($_SESSION['user_id'] == "0000000") {
          echo '<div class="header-R-child-off">user</div>';
          echo '<a href="./login.php" class="header-R-child-on">login</a>';
        } else {
          echo '<a href="./usr_inf.html" class="header-R-child-on">user</a>';
          echo '<a href="./logout.php" class="header-R-child-on">logout</a>';
        }
        ?>

        <!-- <a href="./logout.php" class="header-R-child-off">logout</a> -->
      </div>
    </div>
  </div>


  <!-- <div style="display: flex; width: 100%; height: 80%;"> -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-xs-12" style="padding:0">

        <!-- ジャンル一覧 -->
        <div class="d-flex flex-column align-items-stretch bg-white">
          <div style="background-color: aqua; height: 50px; display: flex; justify-content: center; align-items: center;">
            <?php
            // echo $userName;
            echo $userName;
            ?>
            <a href="./new_topic.html">
              <i class="bi bi-plus-lg icon-size"></i>
            </a>
          </div>

          <div class="list-group list-group-flush border-bottom scrollarea">
            <?php
            for ($i = 0; $i < count($genreNames); $i++) {
              // ニュースを選ばせた状態にするための処理
              $chk = '';
              if($i <= 0) {
                $chk = 'checked';
              }
              
              echo '<div class="genres" onclick="clickGenre(' . $genreIds[$i] . ')">';
              echo '<input type="radio"'. $chk .' name="genreButtons" id="' . $genreIds[$i] . '">';
              echo '<label for="' . $genreIds[$i] . '">';
              echo '<strong class="mb-1">' . $genreNames[$i] . '</strong>';
              echo '</label>';
              echo '</div>';
              $chk = '';
            }
            ?>
          </div>
        </div>
      </div>
      <div class="col-sm-9 col-xs-12" style="height:90vh; padding:0">

        <!-- 話題一覧 -->
        <div class="viewScroll" id="target">

          <section>
            <article>
              <div class="info">
                <h2><?php echo "ユーザー名"; ?></h2>
                <time><?php echo date('Y年m月d日 H:i', strtotime("2019-03-20 23:22:47"));  ?></time>
              </div>
              <p><?php echo "本文"; ?></p>
            </article>
          </section>
          
        </div>
      </div>
    </div>
  </div>
  <!-- </div> -->


  <script>
    // 選択された要素のcssを変える
    function clickGenre(num) {
      // classList.remove("genre-active");
      // alert("このボタンのIDは" + num + "です。");
      document.getElementById(num).classList.add("genre-active");
    }

    // let divElement = document.getElementById("target");
    // divElement.scrollTop = 1000;
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>