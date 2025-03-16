<?php
require_once __DIR__ . '/Models/edit.php';

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>更新画面</title>
    </head>
    <body> <?php
        foreach ($dataList as $data):
                ?> <p>「<?php echo htmlspecialchars($data['todo']); ?>」の編集画面</p>
        <form id="decision" action="edit.php" method="post">
            <textarea class="form" name="newdata" rows="3" cols="20" wrap="hard"><?php echo htmlspecialchars($data['todo']); ?></textarea>
            <input class="update-btn submit-btn" type="submit" value="更新" />
            <input type="hidden" name="decision" value="<?php echo $update; ?>" />
        </form> <?php
        endforeach;
    ?>
    </body>
</html>
</body>
</html>
