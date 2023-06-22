<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
$thread = $dbmng->threadRegist($_POST['genre_id'],$_POST['room_name'],$_POST['detail']);

// ホーム画面かチャット画面に戻る
if($_SESSION['page'] == "home.php") {
    header('Location: home.php');
}else{
    header('Location: chat.php');
}
?>