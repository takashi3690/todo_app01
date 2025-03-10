<?php

declare(strict_types=1);
require_once(dirname(__FILE__) . '/DB.php');

    $data = '';
    $err = false;
    $errorMessage = ''; // エラーメッセージを格納する変数
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['data'])) {
            // メモが空の場合、エラーメッセージを設定
            $err = true;
            $errorMessage = "メモを入力してください。";
        } else {
            // メモが入力されている場合の処理
            $todo = $_POST['data'];  // 入力されたメモ
            $date = date("Y-m-d H:i:s");  // 現在の日付と時刻
    
            try {
                // DB接続
                $db = new DB();
                $pdo = $db->getPDO();  // PDOインスタンス取得
    
                // SQL文の準備
                $stmt = $pdo->prepare('INSERT INTO sample_item(todo,tododate) VALUES (:todoValue, :tododateValue)');
                $stmt->bindValue(':todoValue', $todo, PDO::PARAM_STR);  // 入力されたメモをバインド
                $stmt->bindValue(':tododateValue', $date, PDO::PARAM_STR);  // 現在の日付と時刻をバインド
    
                // 実行
                if ($stmt->execute()) {
                    echo "<p>データを追加しました。</p>";
                } else {
                    echo "<p>SQL文実行時にエラーが発生しました。</p>";
                }
            } catch (PDOException $e) {
                header('Content-Type: text/plain; charset=UTF-8', true, 500);
                exit("<p>エラーが発生しました: " . $e->getMessage() . "</p>");
            }
        }
    }
    
    try {
        $db = new DB();

        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM sample_item ORDER BY tododate DESC');
        $stmt->execute();

        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
    }
