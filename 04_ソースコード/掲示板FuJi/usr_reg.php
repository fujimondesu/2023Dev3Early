<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
$user = $dbmng->userRegist($_SESSION ['name'],$_SESSION ['mail'],$_SESSION ['pass']);

header('Location:s_up_com.html');
?>