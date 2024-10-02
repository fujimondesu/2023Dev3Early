<?php
session_start();
$_SESSION['input_mail'] = $_POST['mail'];
$_SESSION['input_pass'] = $_POST['pass'];

// メールアドレスとパスワードが入力されているか
if(empty($_SESSION['input_mail']) || empty($_SESSION['input_pass'])) {
    $_SESSION['error'] = "メールアドレスまたはパスワードが入力されていません。";
    header('Location:login.php');
}else{
    // エラー文を消去
    $_SESSION['error'] = "";
    header('Location:usr_exist.php');
}
?>