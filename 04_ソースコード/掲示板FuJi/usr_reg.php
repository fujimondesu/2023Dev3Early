<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
$user = $dbmng->userRegist($_SESSION ['name'],$_SESSION ['mail'],$_SESSION ['pass']);

$_SESSION['user_id'] = "0000000";
$_SESSION['user_name'] = "gest";
$_SESSION['mail'] = "gest@gmail.com";
$_SESSION['pass'] = "";

header('Location:s_up_com.html');
?>