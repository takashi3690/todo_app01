<?php

declare(strict_types=1);
require_once(dirname(__FILE__) . '/DB.php');

if (isset($_POST['id'])) {
    try {

        $id = $_POST['id'];
        $db = new DB();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('DELETE FROM sample_item WHERE id = :id');
        $stmt->execute(array(':id' => $id));
        header('Location: /practice/todo_app/todo.php');
        exit;
    } catch (Exception $e) {
        echo 'エラーが発生しました。:' . $e->getMessage();
    }
} else {
    echo '削除に失敗しました';
}
