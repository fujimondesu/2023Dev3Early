<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
$user = $dbmng->userRegist($_POST['user_name'],$_POST['mail'],$_POST['pass']);

header('Location: su_com.html');
?>