<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
$user = $dbmng->chatRegist($_SESSION['user_id'],$_SESSION['room_id'],$_POST['chat']);

header('Location: chat.php');
?>