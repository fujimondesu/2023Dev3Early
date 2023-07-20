<?php
session_start();
$_SESSION['error'] = "";
$_SESSION['page'] = "chat.php";
// (念のため)初回、セッションに「user_id」が無ければ、「0000000」で上書きし、ゲストモードにする
if (empty($_SESSION['user_id'])) {
  $_SESSION['user_id'] = "0000000";
}
if (!empty($_POST['room_id'])) {
  $_SESSION['room_id'] = $_POST['room_id'];
}
require_once './DBManager.php';
$dbmng = new DBManager();
// スレッド一覧取得
$getThreads = $dbmng->getThreadList($_SESSION['genre_id']);
// スレッド名取得
$roomName = $dbmng->getRoomName($_SESSION['room_id']);
// ユーザー名取得
$userName = $dbmng->userNameGet($_SESSION['user_id']);
// 選択したスレッドのチャット一覧取得
$chats = $dbmng->getChatList($_SESSION['room_id']);
// 「room_id」を数字に変換
$viewFlgPhp;
$threadIds;
$threadNames;
$chatIds;
$chatNames;
$chatTimes;
$chatText;
$i = 0;
foreach ($getThreads as $row) {
  $threadIds[$i] = $row['room_id'];
  $threadNames[$i] = $row['room_name'];
  $i++;
}

if (!empty($chats)) {
  $viewFlgPhp = true;
} else {
  $viewFlgPhp = false;
}

// テスト用
// var_dump($_SESSION['room_id']);
// var_dump($chats);
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

<body class="text-center back-color">
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
          echo '<a href="./usr_inf.php" class="header-R-child-on">user</a>';
          echo '<a href="./logout.php" class="header-R-child-on">logout</a>';
        }
        ?>

      </div>
    </div>
  </div>


  <div class="container-fluid">
    <div class="row" style="height: 94vh;">
      <div class="col-sm-3 col-xs-12 space-color" style="padding:0;">

        <!-- ジャンル一覧 -->
        <div class="d-flex flex-column align-items-stretch bg-white">
          <div class="name-color" style="height: 50px; display: flex; justify-content: space-between;">
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
            $id = '';
            $name = '';
            for ($i = 0; $i < count($threadNames); $i++) {
              $chk = '';
              // ジャンルを選んでいたか
              if ($threadIds[$i] == $_SESSION['room_id']) {
                $chk = 'checked';
              }
              $id = $threadIds[$i];
              $name = $threadNames[$i];

              echo '<div class="genres">';
              echo '<input type="radio"' . $chk . ' name="genreButtons" id="' . $id . '" value="' . $id . '" onclick="isClicked(event,this,\'' . $id . '\')">';
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
      <div class="col-sm-9 col-xs-12" style="height:81vh; padding:0;">

        <!-- 選んだスレッドの名前を表示 -->
        <div style="background-color:white; height: 50px; display: grid;place-items: center; font-size:20px;">
          <div>
            <?php
            echo $roomName;
            ?>
          </div>
        </div>

        <!-- 話題一覧 -->
        <div class="viewScroll" id="thread">

          <!-- ここにスレッドが入る -->

        </div>

        <!-- コメント入力部分 -->
        <form action="./login_chk.php" method="post" style="height:60px; display: flex; justify-content: space-between;">
          <div style="width: 80%; height:100%; margin-left:5%;">
            <textarea id="chat" name="chat" cols="70" rows="1" style="width: 100%; height:100%; font-size: 30px; border: 2px solid #666; border-radius: 10px; "></textarea>
          </div>
          <div style="width: 120px; margin-right: 8%; margin-left:3%; border-radius: 10px; background-color:#52A9FA; position: relative;">
            <input style="width:100%; height:100%; background: transparent; border-color: transparent transparent transparent transparent; position: absolute; left:0px; z-index: 1000;" type="submit" value="">
            <svg xmlns="http://www.w3.org/2000/svg" width="45px" height="45px" fill="white" class="bi bi-send-fill" viewBox="0 0 16 16" style="position: absolute; left:35px;margin-top:8px;">
              <path fill-rule="evenodd" d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89.471-1.178-1.178.471L5.93 9.363l.338.215a.5.5 0 0 1 .154.154l.215.338 7.494-7.494Z" />
            </svg>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script>
    // 最初に画面を表示したときにスレッドを描画する処理
    first_output();

    // ニ回目にスレッドを描画する処理
    function isClicked(e, obj, num) {
      // 選択したジャンルの「room_id」を「POST」でこの画面に送信
      sendPost("", "room_id", num);

      console.log("a");
      <?php
      if ($viewFlgPhp == true) {
        echo "output(\"" . $_SESSION['room_id'] . "\");";
      }
      ?>
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
      <?php
      if ($viewFlgPhp == true) {
        echo "output(\"" . $_SESSION['room_id'] . "\");";
      }
      ?>
    }

    // スレッドを描画する処理（numは最初の描画に必要）
    function output(num) {
      <?php
      if ($viewFlgPhp == true) {
        // 「room_id」からチャット一覧を取得
        // データベースから対応するスレッド一覧を取得し、json形式に変換
        $i = 0;
        foreach ($chats as $row) {
          $chatIds[$i] = $row['msg_id'];
          $chatNames[$i] = $row['user_name'];
          $chatTimes[$i] = $row["DATE_FORMAT(sent_time, '%Y年%m月%d日 %k:%i')"];
          $chatText[$i] = $row['chat_main'];
          $i++;
        }
        $js_chatIds = json_encode($chatIds);
        $js_chatNames = json_encode($chatNames);
        $js_chatTimes = json_encode($chatTimes);
        $js_chatText = json_encode($chatText);
      }
      ?>;
      // 配列をphp→jsに代入
      let arr_chatIds<?php if ($viewFlgPhp == true) {
                        echo " = " . $js_chatIds;
                      } ?>;
      let arr_chatNames<?php if ($viewFlgPhp == true) {
                          echo " = " . $js_chatNames;
                        } ?>;
      let arr_chatTimes<?php if ($viewFlgPhp == true) {
                          echo " = " . $js_chatTimes;
                        } ?>;
      let arr_chatText<?php if ($viewFlgPhp == true) {
                        echo " = " . $js_chatText;
                      } ?>;
      // 選択された要素のcssを変える
      document.getElementById(num).classList.add("genre-active");
      // スレッドを挿入するタグの「id」を取得
      let thread_element = document.getElementById('thread');
      // スレッド一覧を画面から削除する
      while (thread_element.lastChild) {
        thread_element.removeChild(thread_element.lastChild);
      }
      // ジャンル数を取得
      let len = arr_chatNames.length;
      for (let i = 0; i < len; i++) {
        // 新しいhtml要素を作成
        let new_section = document.createElement('section');
        let new_article = document.createElement('article');
        let new_div = document.createElement('div');
        let new_h2 = document.createElement('h2');
        let new_time = document.createElement('time');
        let new_p = document.createElement('p');
        new_div.classList.add("info");
        new_time.classList.add("transp");
        new_h2.classList.add("transp");
        new_p.classList.add("transp");
        new_h2.style.fontSize = "30px";
        // 中身を追加
        new_h2.textContent = arr_chatNames[i];
        new_p.textContent = arr_chatText[i];
        new_time.textContent = arr_chatTimes[i];
        // htmlに追加
        thread_element.appendChild(new_section);
        new_section.appendChild(new_article);
        new_article.appendChild(new_div);
        new_article.appendChild(new_p);
        new_div.appendChild(new_h2);
        new_div.appendChild(new_time);
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>