<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();

// メールアドレス未入力チェック
if(empty($_POST['mail'])) {
    $_SESSION['error'] = "メールアドレスが入力されていません。";
    header('Location: p_change.html');
}

$user_id = $dbmng->existCheck($_POST['mail']);

// ユーザー存在チェック
if($user_id == "error") {
    $_SESSION['error'] = "ユーザーが存在しません。";
    header('Location: p_change_displey.html');
}else{
    // あくまで変更したいユーザー。ログインしているユーザーとは限らないため、「SESSION」ではなく「POST」を使う
    $_POST['user_id'] = $user_id;
    header('Location: p_reset.html');
}
?>