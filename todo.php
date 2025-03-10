<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/Models/sample_item.php';
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>todo</title>
        <script src="sample.js"></script>
        <script src="jquery-3.6.4.min.js"></script>
    </head>
    <body>
        <h1>MEMO</h1> <?php if (isset($errorMessage)):?> <p class="error"><?=$errorMessage?> </p> <?php endif;?> <p>メモの追加・更新・削除</p>
        <form id="add" action="todo.php" method="post" novalidate>
            <textarea class="form" name="data" cols="50" rows="10" id="target"></textarea>
            <input class="submit-btn add-btn" type="submit" value="追加" onclick="changeColor('target');">
        </form> <?php foreach ($messages as $column):?> <div class="group" style="margin-top: 30px;">
            <p><?php echo $column['todo'] ?></p>
            <p><?php echo $column['tododate'] ?></p>
            <div class="form">
                <!-- 削除ボタン -->
                <form id="delete" action="Models/delete.php" method="post" onclick="return confirm('削除してよろしいですか?')" novalidate>
                    <input class="update-btn" type="submit" value="削除">
                    <input type="hidden" name="id" value="<?php echo $column['id']; ?>">
                </form>
                <!-- 更新ボタン -->
                <form id='update' action='edit.php' method='post'>
                    <input class="edit-btn" type='submit' value='編集' />
                    <input type='hidden' name='update' value='<?php echo $data['id']; ?>' />
                </form>
            </div>
            <?php endforeach; ?> </div> 
    </body>
</html>
