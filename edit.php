<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>更新画面</title>
    </head>
    <body>
    <?php
    // $dataListが空でない場合にforeachを実行
    if (!empty($dataList)) {
        foreach ($dataList as $data):
            if (isset($update) && $data['id'] == $update):  // 更新するデータのIDと一致する場合
                ?>
                <p>「<?php echo htmlspecialchars($data['todo']); ?>」の編集画面</p>
                <form id="decision" action="Models/edit.php" method="post">
                    <textarea class="form" name="newdata" rows="3" cols="20" wrap="hard"><?php echo htmlspecialchars($data['todo']); ?></textarea>
                    <input class="update-btn submit-btn" type="submit" value="更新" />
                    <input type="hidden" name="decision" value="<?php echo $data['id']; ?>" />
                </form>
                <?php
            endif;
        endforeach;
    } else {
        echo "データがありません。";
    }
    ?>
</body>
</html>
    </body>
</html>
