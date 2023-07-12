<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();

// パスワード未入力チェック
if(empty($_POST['pass'])) {
    $_SESSION['error'] = "パスワードが入力されていません。";
    header('Location: p_chg_input.html');
}else{
    header('Location: p_chg_chk.html');
}

?>