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
$threadIds;
$threadNames;
$threadDetails;
$i = 0;
foreach ($getGenres as $row) {
  $genreIds[$i] = $row['genre_id'];
  $genreNames[$i] = $row['genre_name'];
  $i++;
}

// if (!empty($_POST['genre_id'])) {
//   $_SESSION['genre_id'] = $_POST['genre_id'];
//   var_dump($_SESSION['genre_id']);
// }

// テスト用
// var_dump($_POST);
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
    /* article,
    h2,
    time,
    p */
    .transp {
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

    /* button */
    .transpB {
      position: relative;
      background: transparent;
      border-color: transparent transparent transparent transparent;
      width: 100%;
      height: 30%;
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

      </div>
    </div>
  </div>


  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-xs-12"  style="padding:0; background-color: #D9D9D9;">

        <!-- ジャンル一覧 -->
        <div class="d-flex flex-column align-items-stretch bg-white">
          <div style="background-color: aqua; height: 50px; display: flex; justify-content: space-between;">
            <div style="width:80%; display: flex; justify-content: center; align-items: center; font-size:20px;">
              <?php
              echo $userName;
              ?>
            </div>
            <a href="./new_thread.php" style="width:20%;display: table;">
              <i class="bi bi-plus-lg icon-size" style="display: table-cell;vertical-align: middle;"></i>
            </a>
          </div>

          <div class="list-group list-group-flush border-bottom scrollarea">
            <?php
            $id = 0;
            $name = '';
            for ($i = 0; $i < count($genreNames); $i++) {
              $chk = '';
              // ジャンルを選んでいたか
              if (!empty($_POST['genre_id'])) {
                if ($i + 1 == $_POST['genre_id']) {
                  $chk = 'checked';
                } else if ($i + 5 == $_POST['genre_id']) {
                  $chk = 'checked';
                }
              } else if ($i <= 0) {
                $chk = 'checked';
              }
              $id = $genreIds[$i];
              $name = $genreNames[$i];

              echo '<div class="genres">';
              echo '<input type="radio"' . $chk . ' name="genreButtons" id="' . $id . '" value="' . $id . '" onclick="isClicked(event,this,' . $id . ')">';
              echo '<label for="' . $id . '">';
              echo '<strong class="mb-1" style="font-size:20px;">' . $name . '</strong>';
              echo '</label>';
              echo '</div>';
              $chk = '';
            }
            ?>
          </div>
        </div>
      </div>
      <div class="col-sm-9 col-xs-12" style="height:92vh; padding:0">

        <!-- 話題一覧 -->
        <div class="viewScroll" id="thread">

          <!-- ここにスレッドが入る -->

        </div>
      </div>
    </div>
  </div>


  <script>
    // 最初に画面を表示したときにスレッドを描画する処理
    first_output();

    // ニ回目にスレッドを描画する処理
    function isClicked(e, obj, num) {
      // onClickが2回押すのを防ぐ
      e.stopPropagation();
      // 選択したジャンルの「genre_id」を「POST」でこの画面に送信
      sendPost("", "genre_id", num);
      // sendPost("http://jolly-ohita-1184.daa.jp/FuJi/chat.php", "room_id", "0000002");

      output(num);
    }

    // スレッドからチャット画面に遷移する処理
    function goChat(str) {
      // onClickが2回押すのを防ぐ
      // e.stopPropagation();
      // 選択したジャンルの「genre_id」を「POST」でこの画面に送信
      let form = document.createElement('form');
      let request = document.createElement('input');
      form.method = 'POST';
      form.action = "http://jolly-ohita-1184.daa.jp/FuJi/chat.php";
      request.type = 'hidden';
      request.name = "room_id";
      request.value = str;
      form.appendChild(request);
      document.body.appendChild(form);
      form.submit();
      // alert(str);
    }

    // formの処理
    function sendPost(act, name, num) {
      let form = document.createElement('form');
      let request = document.createElement('input');
      form.method = 'POST';
      form.action = act;
      request.type = 'hidden';
      request.name = name;
      request.value = num;
      form.appendChild(request);
      document.body.appendChild(form);
      form.submit();
    }

    // 最初に画面を表示したときにスレッドを描画する処理
    function first_output() {
      output(
        <?php
        if (!empty($_POST['genre_id'])) {
          echo $_POST['genre_id'];
        } else {
          echo 1;
        }
        ?>
      );
    }

    // スレッドを描画する処理（numは最初の描画に必要）
    function output(num) {
      <?php
      // 「post」に値があればそれを、無ければ「１」（初期値）を使う
      if (!empty($_POST['genre_id'])) {
        $threads = $dbmng->getThreadList($_POST['genre_id']);
      } else {
        $threads = $dbmng->getThreadList("1");
      }
      // データベースから対応するスレッド一覧を取得し、json形式に変換
      $i = 0;
      foreach ($threads as $row) {
        $threadIds[$i] = $row['room_id'];
        $threadNames[$i] = $row['room_name'];
        $threadDetails[$i] = $row['detail'];
        $i++;
      }
      $js_threadIds = json_encode($threadIds);
      $js_threadNames = json_encode($threadNames);
      $js_threadDetails = json_encode($threadDetails);
      ?>
      // 配列をphp→jsに代入
      let arr_threadIds = <?php echo $js_threadIds; ?>;
      let arr_threadNames = <?php echo $js_threadNames; ?>;
      let arr_threadDetails = <?php echo $js_threadDetails; ?>;
      // 選択された要素のcssを変える
      document.getElementById(num).classList.add("genre-active");
      // スレッドを挿入するタグの「id」を取得
      let thread_element = document.getElementById('thread');
      // スレッド一覧を画面から削除する
      while (thread_element.lastChild) {
        thread_element.removeChild(thread_element.lastChild);
      }
      // ジャンル数を取得
      let len = arr_threadNames.length;
      for (let i = 0; i < len; i++) {
        // console.log("goChat(e,obj,\"" + arr_threadIds[i] + "\")");
        // 新しいhtml要素を作成
        let new_button = document.createElement('button');
        let new_section = document.createElement('section');
        let new_article = document.createElement('article');
        let new_div = document.createElement('div');
        let new_h2 = document.createElement('h2');
        let new_p = document.createElement('p');
        // new_a.href = "";
        new_button.id = arr_threadIds[i];
        new_button.onclick = function() {
          goChat(arr_threadIds[i]);
        };
        new_button.style.marginBottom = "75px";
        new_button.classList.add("transpB");
        new_div.classList.add("info");
        // new_article.classList.add("transp");
        new_h2.classList.add("transp");
        new_p.classList.add("transp");
        new_h2.style.fontSize = "30px";
        // 中身を追加
        new_h2.textContent = arr_threadNames[i];
        new_p.textContent = arr_threadDetails[i];
        // htmlに追加
        thread_element.appendChild(new_button);
        new_button.appendChild(new_section);
        new_section.appendChild(new_article);
        new_article.appendChild(new_div);
        new_article.appendChild(new_p);
        new_div.appendChild(new_h2);
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>