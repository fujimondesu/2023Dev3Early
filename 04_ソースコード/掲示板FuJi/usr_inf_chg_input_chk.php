<?php
session_start();
// メールアドレスとパスワードが入力されているか
if(empty($_POST['name']) || empty($_POST['pass1']) || empty($_POST['pass2'])) {
    $_SESSION['error'] = "ユーザー名またはパスワードが入力されていません。";
    header('Location: usr_inf_chg.php');
}else if($_POST['pass1'] != $_POST['pass2']){
    $_SESSION['error'] = "パスワードが一致していません。";
    header('Location: usr_inf_chg.php');
}else{
    // エラー文を消去
    $_SESSION['error'] = "";
    header('Location: usr_inf_chg_chk.php');
}
?>