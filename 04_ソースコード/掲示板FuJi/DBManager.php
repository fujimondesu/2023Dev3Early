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
    
    // ユーザー名取得
    public function userNameGet($uId) {
        $pdo = $this->dbConnect();
        $sql = "SELECT user_name FROM user WHERE user_id = ?";
        
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $uId, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        // $resultが二次元配列になってるから[0][0]を付けてる
        return $result[0][0];
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
        return $maxId;
        // $result = $ps->fetchAll();
        // return $result;
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
        $sql = "SELECT room_id, room_name, detail FROM chat_room WHERE genre_id = ?";
        
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $gId, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }
    
    // 選択したスレッドのチャット一覧取得(ユーザー名、チャット本文、時間)
    public function getChatList($rId) {
        $pdo = $this->dbConnect();
        $sql = "SELECT user.user_name, chat_msg.msg_id, chat_msg.chat_main, 
        DATE_FORMAT(sent_time, '%Y年%m月%d日 %k:%i') FROM chat_msg 
        INNER JOIN user ON  chat_msg.user_id = user.user_id 
        WHERE room_id = ?";

        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $rId, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result;
    }

    // 選択したチャットの名前を取得
    public function getRoomName($rId) {
        $pdo = $this->dbConnect();
        $sql = "SELECT room_name FROM chat_room WHERE room_id = ?";
        
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $rId, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll();
        return $result[0][0];
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
        $replace = (int)$num;
        return $replace;
    }
    
    // 数字を0埋めして文字(7桁)に変換
    public function numToStr($num) {
        $replace = sprintf('%07d', $num);
        return $replace;
    }
}
?>