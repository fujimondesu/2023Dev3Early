<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
// 存在チェック
$user = $dbmng->userExist($_POST['mail'],$_POST['pass']);

// 1.ユーザー名とメールアドレスとパスワードが入力されているか
if(empty($_POST['user_name']) || empty($_POST['mail']) || empty($_POST['pass'])) {
    $_SESSION['error'] = "ユーザー名、メールアドレスまたはパスワードが入力されていません。";
    header('Location: s_up.php');
}

// // 2.ユーザー名が重複しているか
// $name = $dbmng->userDoubleCheck($_POST['name']);
// if(!empty($name)) {
//     $_SESSION['error'] = "ユーザー名が使用されています。";
//     header('Location: su.html');
// }

// 3.メールアドレスが重複しているか
$mail = $dbmng->mailDoubleCheck($_POST['mail']);
if(!empty($mail)) {
    $_SESSION['error'] = "メールアドレスが使用されています。";
    header('Location: s_up.php');
}


// エラー文を消去
$_SESSION['error'] = "";
header('Location: s_up_check.php');
?>