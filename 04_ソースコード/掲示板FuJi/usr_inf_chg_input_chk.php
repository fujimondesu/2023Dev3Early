<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();

// 変更後のユーザー名が同じか
if($_POST['name'] == $_SESSION['name']) {
    $userNameDouble = [];
}else{
    $userNameDouble = $dbmng->userDoubleCheck($_POST['name']);
}

// ユーザー名とパスワードが入力されているか
if(empty($_POST['name']) || empty($_POST['pass1']) || empty($_POST['pass2'])) {
    $_SESSION['error'] = "ユーザー名またはパスワードが入力されていません。";
    header('Location: usr_inf_chg.php');
}else if(count($userNameDouble) >= 1){
    $_SESSION['error'] = "ユーザー名が重複しています。";
    header('Location: usr_inf_chg.php');
}else if($_POST['pass1'] != $_POST['pass2']){
    $_SESSION['error'] = "パスワードが一致していません。";
    header('Location: usr_inf_chg.php');
}else{
    // エラー文を消去
    $_SESSION['error'] = "";
    $_SESSION['input_user_name'] = $_POST['name'];
    $_SESSION['input_pass'] = $_POST['pass1'];
    header('Location: usr_inf_chg_chk.php');
}
?>