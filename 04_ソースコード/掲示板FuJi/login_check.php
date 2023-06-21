<?php
session_start();

// ログインしているか
if($_SESSION['user_id'] == "0000000"){
    header('Location: login.html');
}else{
    header('Location: comment_reg.php');
}
?>