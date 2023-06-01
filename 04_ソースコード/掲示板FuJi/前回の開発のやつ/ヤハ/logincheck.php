<?php
session_start();
unset($_SESSION['user_id']);
require_once './DBManager.php';
$dbmng = new DBManager();
$user = $dbmng->userSearch($_POST['mail'],$_POST['pas']);
// $_SESSION['array'] = $searchArray;

if($user==null){
    header('Location: login.php');
}else{
    foreach($user as $row){
        $_SESSION['user_id'] = $row['user_id'];
    }
    
    //ユーザーidからカートidを取得
    $cart_id = $dbmng->cartSearch($_SESSION['user_id']);
    foreach($cart_id as $row){
        $_SESSION['cart_id'] = $row['cart_id'];
    }

    //カートidからカートの中身をSESSION['device']に格納
    $device_id_arr = $dbmng->cartGetDevice($_SESSION['cart_id']);
    $devices = [];
    foreach($device_id_arr as $row){
        $devices = $row['device_id'];
    }
    $_SESSION['devices'] = $devices;

    // $_SESSION['user_id'] = $user;
    header('Location: ./itiran.php');
}
?>