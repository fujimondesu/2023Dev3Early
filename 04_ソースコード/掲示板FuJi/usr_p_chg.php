<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
// 指定したユーザーのパスワードを更新
$userPass = $dbmng->updatePass($_SESSION['user_id'],$_SESSION['input_pass']);
$userName = $dbmng->updateName($_SESSION['user_id'],$_SESSION['input_user_name']);

header('Location: p_chg_com.html');

?>