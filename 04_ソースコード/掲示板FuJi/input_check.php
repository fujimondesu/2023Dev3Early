<?php
session_start();

// $_SESSION['page']      ==  どのページから来たか
// $_SESSION['user_name'] ==  ユーザー名
// $_SESSION['pass']      ==  パスワード（新規登録）
// $_SESSION['mail']      ==  メールアドレス（新規登録）
// $_SESSION['user_id']   ==  ユーザーid
// $_SESSION['genre_id']  ==  ジャンルid
// $_SESSION['room_id']   ==  スレッド（話題）id
// $_SESSION['error']     ==  エラー文（複数の場合は,でくっつける予定）
// $_SESSION['chat']      ==  チャット文

// メールアドレスとパスワードが入力されているか
if(empty($_POST['mail']) || empty($_POST['pass'])) {
    $_SESSION['error'] = "メールアドレスまたはパスワードが入力されていません。";
    header('Location: login.php');
}else{
    // エラー文を消去
    $_SESSION['error'] = "";
    header('Location: u_exist.php');
}
?>