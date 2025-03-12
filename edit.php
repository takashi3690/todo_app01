<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>更新画面</title>
    </head>
    <body> <?php foreach ($dataList as $data) : ?> <h1>「」の編集画面</h1>
        <form id="add" action="edit.php" method="post" novalidate>
            <textarea class="form" name="edit" id="edit_id" cols="50" rows="10"></textarea>
            <p>
                <input type="submit" value="更新">
                <input type='hidden' name='update' value='<?php echo $data['id']; ?>' />
            </p>
            <a href="todo.php">戻る</a>
        </form> <?php endforeach ?>
    </body>
</html>
