<?php
declare(strict_types=1);
require_once(dirname(__FILE__) . '/DB.php');

// データがない場合はtodoに戻る
if (!isset($_POST['update']) && !isset($_POST['newdata'])) {
    header("Location:todo.php");
    exit;
}


$dataList = [];  // 初期化

try {
    // DB接続
    $db = new DB();
    $pdo = $db->getPDO();

    // SQLクエリでデータを取得
    $sql = 'SELECT todo FROM sample_item';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    echo "行数: " . $stmt->rowCount() . "<br>";
    // 結果を$dataListに格納
    $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'データベースエラー: ' . $e->getMessage();
    $dataList = [];  // エラー時は空配列にしておく
}

// $dataList が空でないか確認してからforeachを実行
if (is_array($dataList) && count($dataList) > 0) {
    foreach ($dataList as $item) {
        echo $item['todo'] . "<br>";
    }
} else {
    echo "データがありません。";
}

if(isset($_POST['newdata'])) {
    $newdata = $_POST['newdata'];
    $decision = $_POST['decision'];

    try {
        echo nl2br($newdata);  // 入力された新しいデータを表示（改行も反映）

        $db = new DB();  // DB接続
        $stmt = $db->prepare('UPDATE sample_item SET todo=:newdata WHERE id=:id');
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
        $pdo = $db->getpdo();  // インスタンス作成

        $sql = 'SELECT todo FROM sample_item WHERE id=:id';  // SQLを作成
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $update, PDO::PARAM_INT);  // IDに基づいてデータを取得
        $stmt->execute();  // SQL実行

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            echo "現在のデータ: " . htmlspecialchars($row['todo']);
        } else {
            echo "データが見つかりませんでした";
        }

    } catch (PDOException $e) {
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
    }
}
?>
