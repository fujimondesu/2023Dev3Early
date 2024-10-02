<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
// $_SESSION['test'] = $_POST['room_name'];

// メールアドレスとパスワードが入力されているか
if(empty($_POST['room_name']) || $_POST['room_name'] == "") {
    $_SESSION['error'] = "スレッド名が入力されていません。";
    header('Location: new_thread.php');
}else{
    $thread = $dbmng->threadRegist($_POST['genre_id'],$_POST['room_name'],$_POST['detail']);
    
    // テスト用
    // $thread = $dbmng->threadRegist($_SESSION['genre_id'],$_SESSION['room_name'],$_SESSION['detail']);
    // $_SESSION['test'] = $thread;
    
    // ホーム画面かチャット画面に戻る
    if($_SESSION['page'] == "home.php") {
        header('Location: home.php');
    }else{
        header('Location: chat.php');
    }
}
?>