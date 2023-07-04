<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();

// ログインしているか
if($_SESSION['user_id'] == "0000000"){
    header('Location: login.html');
}else{
    header('Location: comment_reg.php');
}
?>