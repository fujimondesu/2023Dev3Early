<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
// チャット文章をデータベースに登録
$user = $dbmng->chatRegist($_SESSION['user_id'],$_SESSION['room_id'],$_SESSION['chat']);

header('Location: chat.php');
?>