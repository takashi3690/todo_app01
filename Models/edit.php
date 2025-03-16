<?php
declare(strict_types=1);
require_once(dirname(__FILE__) . '/DB.php');

// データがない場合はtodoに戻る
if (!isset($_POST['update']) && !isset($_POST['newdata'])) {
    header("Location:todo.php");
    exit;
}

if(isset($_POST['newdata'])) {
    $newdata = $_POST['newdata'];
    $decision = $_POST['decision'];

    try {
        echo nl2br($newdata);  // 入力された新しいデータを表示（改行も反映）

        $db = new DB();  // DB接続
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('UPDATE sample_item SET todo=:newdata WHERE id=:id');
        $stmt->bindParam(':id', $decision, PDO::PARAM_INT);
        $stmt->bindParam(':newdata', $newdata, PDO::PARAM_STR);

        if ($stmt->execute()) {  // SQL実行
            header("Location:new_update.php");  // 更新成功後にリダイレクト
            exit;
        } else {
            print("<p>更新に失敗しました</p>");
        }

        $db = null;  // DB接続を閉じる

    } catch (PDOException $e) {  // エラーハンドリング
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
    }
}

if (isset($_POST['update'])) {
    $update = $_POST['update'];
    try {
        $db = new DB();  // データベース接続
        $pdo = $db->getPDO();  // インスタンス作成

        $sql = 'SELECT id, todo FROM sample_item WHERE id=:id';  // SQLを作成
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $update, PDO::PARAM_INT);  // IDに基づいてデータを取得
        $stmt->execute();  // SQL実行

        $dataList = array();
        while ($row = $stmt->fetch()) {
            array_push($dataList, ["todo" => $row['todo']]);
        }

        $db = NULL;
    } catch (PDOException $e) {
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
    }
}
?>
