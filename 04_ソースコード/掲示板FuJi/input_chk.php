<?php
session_start();

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