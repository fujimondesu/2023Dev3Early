<?php
session_start();
require_once './DBManager.php';
$dbmng = new DBManager();
// 指定したユーザーのパスワードを更新
$user = $dbmng->updatePass($_POST['user_id'],$_POST['pass']);

header('Location: p_chg_com.html');

?>