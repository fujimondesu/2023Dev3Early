<?php
class DBManager
{

    // DB接続のメソッド
    private function dbConnect() {
        $dsn = 'mysql:host=mysql215.phy.lolipop.lan;dbname=LAA1418480-fuji;charset=utf8';
        $user = 'LAA1418480';
        $password = 'rFaX58P7wxxAKAN';
        $pdo = new PDO($dsn, $user, $password);

        return $pdo;
    }

    //テスト用
    public function test() {
        $pdo = $this->dbConnect();
        $sql = "SELECT user_name FROM user WHERE user_id = '0000000'";
        $ps = $pdo->query($sql);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    // テスト用
    public function testDate() {
        $pdo = $this->dbConnect();
        $sql = "SELECT CURRENT_TIME";
        $ps = $pdo->query($sql);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    // --------------------------------以下処理------------------------------------

    // ユーザーが存在しているか、パスワードが正しいか（呼出）チェック
    public function userExist($mail,$pass) {
        $result = $this->existCheck($mail);

        if($result != "error") {
            $result2 = $this->passCheck($mail, $pass);
            if($result2 != "error") {
                $pdo = $this->dbConnect();
                $sql = "SELECT user_id FROM user WHERE mail_address = ?";
        
                $ps = $pdo->prepare($sql);
                $ps->bindValue(1, $mail, PDO::PARAM_STR);
                $ps->execute();
                $result1 = $ps->fetchAll();
                return $result1['user_id'];
            }
        }
        return "error";
    }
    
    // ユーザーが存在しているかチェック
    public function existCheck($mail) {
        $pdo = $this->dbConnect();
        $sql = "SELECT user_id FROM user WHERE mail_address = ?";

        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $mail, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();

        // 値が返ってきたか、ゲストモード以外か
        if($result['user_id'] != "0000000" || !empty($result['user_id'])) {
            return $result['user_id'];
        }else{
            return "error";
        }
    }

    // パスワードが正しいかチェック
    public function passCheck($mail, $pass) {
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM user WHERE mail_address = ? AND password = ?";

        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $mail, PDO::PARAM_STR);
        $ps->bindValue(2, $pass, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    // メールアドレス重複チェック(1行以上結果が返ってきたら重複している)
    public function mailDoubleCheck($mail) {
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM user WHERE mail_address = ?";

        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $mail, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }
    
    // ユーザー名重複チェック(1行以上結果が返ってきたら重複している)
    public function userDoubleCheck($name) {
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM user WHERE user_name = ?";

        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $name, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }
    
    // ユーザー情報取得
    public function userInfoGet($uId) {
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM user WHERE user_id = ?";

        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $uId, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    // ユーザーのパスワードを更新
    public function updatePass($uId, $pass) {
        $pdo = $this->dbConnect();
        $sql = "UPDATE user SET password = ? WHERE user_id = ?;";

        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $pass, PDO::PARAM_STR);
        $ps->bindValue(2, $uId, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }
    
    // userテーブルに新規登録
    public function userRegist($name, $mail, $pass) {
        $pdo = $this->dbConnect();
        // 一番最後のuser_idを取得し、+1されたuser_idを生成する
        $maxId = $this->getMaxUserId();
        $maxId = $this->strToNum($maxId);
        $maxId++;
        $maxId = $this->numToStr($maxId);

        $sql = "INSERT INTO user (user_id,user_name,mail_address,password) VALUES (?,?,?,?)";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $maxId, PDO::PARAM_STR);
        $ps->bindValue(2, $name, PDO::PARAM_STR);
        $ps->bindValue(3, $mail, PDO::PARAM_STR);
        $ps->bindValue(4, $pass, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }
    
    // 送信されたコメントをデータベースに登録
    public function chatRegist($uId, $rId, $chat) {
        $pdo = $this->dbConnect();
        // 一番最後のmsg_idを取得し、+1されたmsg_idを生成する
        $maxId = $this->getMaxMsgId();
        $maxId = $this->strToNum($maxId);
        $maxId++;
        $maxId = $this->numToStr($maxId);
        
        $sql = "INSERT INTO chat_msg (msg_id, room_id, user_id, chat_main, sent_time) VALUES (?,?,?,?,now())";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $maxId, PDO::PARAM_STR);
        $ps->bindValue(2, $rId, PDO::PARAM_STR);
        $ps->bindValue(3, $uId, PDO::PARAM_STR);
        $ps->bindValue(4, $chat, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    // 新規作成されたスレッドをデータベースに登録
    public function threadRegist($gId, $rName, $detail) {
        $pdo = $this->dbConnect();

        // 一番最後のroom_idを取得し、+1されたroom_idを生成する
        $maxId = $this->getMaxRoomId();
        $maxId = $this->strToNum($maxId);
        $maxId++;
        $maxId = $this->numToStr($maxId);
        
        $sql = "INSERT INTO chat_room (room_id, genre_id, room_name, detail) VALUES (?,?,?,?)";
        
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $maxId, PDO::PARAM_STR);
        $ps->bindValue(2, $gId, PDO::PARAM_STR);
        $ps->bindValue(3, $rName, PDO::PARAM_STR);
        $ps->bindValue(4, $detail, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }
    
    // ジャンル一覧取得
    public function getGenre() {
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM chat_genre";
        $ps = $pdo->prepare($sql);
        $ps->execute();
        $result = $ps->fetchAll();
        // 「genre_id」と「genre_name」の二次元配列
        return $result;
    }
    
    // 選択したジャンルのスレッド一覧取得
    public function getThreadList($gId) {
        $pdo = $this->dbConnect();
        $sql = "SELECT room_name, detail FROM chat_room WHERE genre_id = ?";
        
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $gId, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }
    
    // 選択したスレッドのチャット一覧取得(ユーザー名、チャット本文、時間)
    public function getChatList($rId) {
        $pdo = $this->dbConnect();
        $sql = "SELECT user.user_name, chat_msg.chat_main, 
        DATE_FORMAT(sent_time, '%Y年%m月%d日 %k:%i') FROM chat_msg 
        INNER JOIN user ON  chat_msg.user_id = user.user_id 
        WHERE room_id = ?";

        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $rId, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    // 一番最後のuser_idを取得
    public function getMaxUserId() {
        $pdo = $this->dbConnect();
        $sql = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
        $ps = $pdo->prepare($sql);
        $ps->execute();
        $result = $ps->fetchAll();
        // $resultが二次元配列になってるから[0][0]を付けてる
        return $result[0][0];
    }

    // 一番最後のmsg_idを取得
    public function getMaxMsgId() {
        $pdo = $this->dbConnect();
        $sql = "SELECT msg_id FROM chat_msg ORDER BY msg_id DESC LIMIT 1";
        $ps = $pdo->prepare($sql);
        $ps->execute();
        $result = $ps->fetchAll();
        // $resultが二次元配列になってるから[0][0]を付けてる
        return $result[0][0];
    }
    
    // 一番最後のroom_idを取得
    public function getMaxRoomId() {
        $pdo = $this->dbConnect();
        $sql = "SELECT room_id FROM chat_room ORDER BY room_id DESC LIMIT 1";
        $ps = $pdo->prepare($sql);
        $ps->execute();
        $result = $ps->fetchAll();
        // $resultが二次元配列になってるから[0][0]を付けてる
        return $result[0][0];
    }
    
    // 0埋めされた文字から数字に変換
    public function strToNum($num) {
        $replace = str_replace('0', '', $num);
        $replace = (int)$replace;
        return $replace;
    }
    
    // 数字を0埋めして文字(7桁)に変換
    public function numToStr($num) {
        $replace = sprintf('%07d', $num);
        return $replace;
    }

    // フォーマットを指定して時間を取得（分まで）
    // public function getTime() {
        //     // YYYY年MM月DD日 hh:mm
        //     $date = date('Y') . "年" . date('n') . "月" . date('j') . "日　" . date('H') . ":" . date('i');
        //     return $date;
    // }


    // --------------------------------ここまで書いた------------------------------------


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

}
?>