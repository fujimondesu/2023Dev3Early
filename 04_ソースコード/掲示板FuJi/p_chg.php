<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
// 指定したユーザーのパスワードを更新
$userPass = $dbmng->updatePass($_SESSION['user_id_chg'],$_SESSION['input_pass']);

header('Location: p_chg_com.html');

?>