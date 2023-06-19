<?php
session_start();
// セッション内の不要な「user_id」をリセット...?
unset($_SESSION['user_id']);
require_once './DBManager.php';
$dbmng = new DBManager();
// 存在チェック
$user = $dbmng->userSearch($_POST['mail'],$_POST['pas']);
// $_SESSION['array'] = $searchArray;


// どのページから来たのかの情報が必要


if($user==null){
    // 存在しなければ「ログイン画面」に戻る
    header('Location: login.php');
}else{
    // セッションにユーザーidを格納
    foreach($user as $row){
        $_SESSION['user_id'] = $row['user_id'];
    }
    
    

    // $_SESSION['user_id'] = $user;
    // 前のページに戻る
    header('Location: ./itiran.php');
}
?>