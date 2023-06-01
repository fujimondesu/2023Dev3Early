<?php
class DBManager
{
    private function dbConnect()
    {
        $dsn = 'mysql:host=mysql207.phy.lolipop.lan;dbname=LAA1418438-gamingsite;charset=utf8';
        $user = 'LAA1418438';
        $password = 'gahaha182';
        $pdo = new PDO($dsn, $user, $password);

        return $pdo;
    }

    //商品テーブルから商品名を取得
    public function getDeviceNames()
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT device_name FROM device_information";
        // $sql = "SELECT device_name, default_price, evaluation_value FROM device_information";

        $ps = $pdo->query($sql);
        $ps->execute();

        $result = $ps->fetchAll();
        return $result;
    }

    // 商品テーブルから参考価格を取得
    public function getDevicePrices()
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT default_price, sale_price FROM device_information";

        $ps = $pdo->query($sql);
        $ps->execute();

        $result = $ps->fetchAll();
        return $result;
    }

    // 商品テーブルから評価値を取得
    public function getDeviceEvaluationValue()
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT evaluation_value FROM device_information";

        $ps = $pdo->query($sql);
        $ps->execute();

        $result = $ps->fetchAll();
        return $result;
    }

    //商品テーブルから評価数を取得
    public function getDeviceEvaluationNumber()
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT number_of_evaluation FROM device_information";

        $ps = $pdo->query($sql);
        $ps->execute();

        $result = $ps->fetchAll();
        return $result;
    }

    //ログイン時にユーザーを探す
    public function userSearch($mail, $pass)
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT user_id FROM user WHERE e_mail = ? AND password = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $mail, PDO::PARAM_STR);
        $ps->bindValue(2, $pass, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    //商品idから商品の情報を取得
    public function deviceSearch($id)
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM device_information WHERE device_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $id, PDO::PARAM_INT);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    //商品の情報を全て取得
    public function deviceSearchAll()
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM device_information";
        $ps = $pdo->prepare($sql);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    //ユーザーidからカートidを探す
    public function cartSearch($user_id)
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT cart_id FROM cart WHERE user_id = ? AND buy_date = '0000-00-00'";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $user_id, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    //商品idから商品の数量を取得
    public function cartDeviceSearch($cart_id)
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT device_id ,quantity FROM cart_details WHERE cart_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $cart_id, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    //商品idから商品の数量を取得
    public function deviceQuantitySearch($device_id, $cart_id)
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT quantity FROM cart_details WHERE device_id = ? AND cart_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $device_id, PDO::PARAM_INT);
        $ps->bindValue(2, $cart_id, PDO::PARAM_STR);
        $ps->execute();
        $ans = $ps->fetchAll();
        $result = 0;
        foreach ($ans as $row) {
            $result = $row['quantity'];
        }
        return $result;
    }

    //カートの商品の数量を増やす
    public function devicePuls($device_id, $cart_id)
    {
        $pdo = $this->dbConnect();
        $sql = "UPDATE cart_details SET quantity = quantity + 1 WHERE device_id = ? AND cart_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $device_id, PDO::PARAM_INT);
        $ps->bindValue(2, $cart_id, PDO::PARAM_STR);
        $ps->execute();
        // $result = $ps->fetchAll();
        // return $result;
    }

    //カートの商品のデータを挿入する
    public function deviceInsert($device_id, $cart_id)
    {
        // $cart_id = "'" . $cart_id . "'";
        $pdo = $this->dbConnect();
        //INSERT INTO cart_details (cart_id, device_id, quantity) VALUES ('0000007',1,1);
        $sql = "INSERT INTO cart_details (cart_id, device_id, quantity) VALUES (?,?,1)";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $cart_id, PDO::PARAM_STR);
        $ps->bindValue(2, $device_id, PDO::PARAM_INT);
        $ps->execute();
        // $result = $ps->fetchAll();
        // return $result;
    }

    //カートの商品の数量を減らす
    public function deviceMinus($device_id, $cart_id)
    {
        $pdo = $this->dbConnect();
        $quantity = $this->deviceQuantitySearch($device_id, $cart_id);
        if ($quantity > 1) {
            $sql = "UPDATE cart_details SET quantity = quantity - 1 WHERE device_id = ? AND cart_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $device_id, PDO::PARAM_INT);
            $ps->bindValue(2, $cart_id, PDO::PARAM_STR);
            $ps->execute();
            // $result = $ps->fetchAll();
        } else {
            $sql = "DELETE FROM cart_details WHERE device_id = ? AND cart_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $device_id, PDO::PARAM_INT);
            $ps->bindValue(2, $cart_id, PDO::PARAM_STR);
            $ps->execute();
            // $result = $ps->fetchAll();
        }
        // return $result;
    }

    //購入日を上書きする
    public function dateUpdate($user_id, $cart_id)
    {
        $pdo = $this->dbConnect();
        $sql = "UPDATE cart SET buy_date = CURDATE() WHERE user_id = ? AND cart_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $user_id, PDO::PARAM_STR);
        $ps->bindValue(2, $cart_id, PDO::PARAM_STR);
        $ps->execute();
        // $result = $ps->fetchAll();
        // return $result;
    }

    //cart_idの最大値を取得
    public function cartIdMaxSelect()
    {
        $pdo = $this->dbConnect();
        // SELECT MAX(CAST(`cart_id` AS SIGNED)) FROM cart;
        $sql = "SELECT MAX(CAST(`cart_id` AS SIGNED)) FROM cart";
        $ps = $pdo->query($sql);
        $ps->execute();
        $ans = $ps->fetchAll();
        $result = 0;
        foreach ($ans as $row) {
            $result = $row['MAX(CAST(`cart_id` AS SIGNED))'];
        }
        return $result;
    }

    //cartに新しいcart_idを挿入する
    public function cartIdInsert($user_id, $cart_id)
    {
        $pdo = $this->dbConnect();
        $sql = "INSERT INTO cart (cart_id, user_id, buy_date) VALUES (?,?,'0000-00-00')";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $cart_id, PDO::PARAM_STR);
        $ps->bindValue(2, $user_id, PDO::PARAM_STR);
        $ps->execute();
        // $result = $ps->fetchAll();
        // return $result;
    }

    //カートidからカートの中身を取得
    public function cartGetDevice($cart_id)
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT device_id FROM cart_details WHERE cart_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $cart_id, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    //テスト用
    public function test()
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT default_price FROM device_information WHERE device_id = 1";
        $ps = $pdo->query($sql);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }


    // public function getUserTblByName($getid,$getpass){
    //     $result = "";
    //     $pdo = $this->dbConnect();
    //     $sql = "SELECT username FROM user_tbl WHERE id = ? AND pass = ?";

    //     $ps = $pdo->prepare($sql);
    //     $ps->bindValue(1, $getid ,PDO::PARAM_INT);
    //     $ps->bindValue(2, $getpass ,PDO::PARAM_STR);
    //     $ps->execute();

    //     $search = $ps->fetch();
    //     if(!(empty($search))){
    //         $result = "ようこそ！". $search['username']."さん";
    //     }else{
    //         $result = "ログインに失敗しました";
    //     }
    //     return $result;
    // }

    // public function getPlace($getplace){
    //     $result = "";
    //     $pdo = $this->dbConnect();
    //     $sql = "SELECT username , address FROM user_tbl WHERE address LIKE ?";

    //     $ps = $pdo->prepare($sql);
    //     $ps->bindValue(1, '%'.$getplace.'%' ,PDO::PARAM_STR);
    //     $ps->execute();

    //     $search = $ps->fetchAll();
    //     if(!(empty($search))){
    //         $result = $search;
    //     }else{
    //         $result = null;
    //     }
    //     return $result;
    // }

    // public function writeTweet($getTweet){
    //     $pdo = $this->dbConnect();
    //     $sql = "INSERT INTO tweet_tbl (tweet_data , user_id , tweet) VALUES (CURDATE() , 1 , ?)";

    //     $ps = $pdo->prepare($sql);
    //     $ps->bindValue(1, $getTweet ,PDO::PARAM_STR);
    //     $ps->execute();
    // }

    // public function getAllTweet(){
    //     $pdo = $this->dbConnect();
    //     $sql = "SELECT * FROM tweet_tbl";

    //     $ps = $pdo->query($sql);
    //     $ps->execute();

    //     $result = $ps->fetchAll();
    //     return $result;
    // }

}
