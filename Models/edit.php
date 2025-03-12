<?php
declare(strict_types=1);
require_once(dirname(__FILE__) . '/DB.php');

if(isset($_POST['update'])) {
    //更新するデータをIDをもとに表示する
    $update = $_POST['update'];
    try {
        $db = new DB();//データベース接続
        $pdo = $db->getpdo();//インスタンス作成

        $sql = ('SELECT items FROM sample_items WHERE id=:id');//SQLを作成
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id PDO::PRAM_INT);//登録するデータをセット
        $stmt->execute();//SQL実行

    } catch (PDOException $e) {
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
    }
}
