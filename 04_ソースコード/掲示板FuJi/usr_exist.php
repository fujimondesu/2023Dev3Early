<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
// 存在チェック
$user = $dbmng->userExist($_POST['mail'],$_POST['pass']);

if($user == "error"){
    // エラーが出れば「ログイン画面」に戻る
    $_SESSION['error'] = "メールアドレスかパスワードが間違っています。";
    header('Location: login.php');
}else{
    // セッションに「ユーザーid」を格納
    $_SESSION['user_id'] = $user;
    $_SESSION['mail'] = $_POST['mail'];
    $_SESSION['pass'] = $_POST['pass'];
    
    // 前のページに戻る
    header('Location: home.php');
}
?>