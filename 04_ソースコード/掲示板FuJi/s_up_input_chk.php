<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
$userNameDouble = $dbmng->userDoubleCheck($_POST['name']);
// ユーザー名とパスワードが入力されているか
if(empty($_POST['name']) || empty($_POST['pass']) || empty($_POST['mail'])) {
    $_SESSION['error'] = "ユーザー名、パスワード、またはメールアドレスが入力されていません。";
    header('Location: s_up.php');
}else if(count($userNameDouble) >= 1){
    $_SESSION['error'] = "ユーザー名が重複しています。";
    header('Location: s_up.php');
}else{
    // エラー文を消去
    $_SESSION['error'] = "";
    $_SESSION['input_user_name'] = $_POST['name'];
    $_SESSION['input_pass'] = $_POST['pass'];
    $_SESSION['input_mail'] = $_POST['mail'];
    header('Location: s_up_chk.php');
}
?>