<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>更新完了画面</title>
</head>

<body>
    <?php
    print("<p>データを更新しました。TODOリストに戻ります。</p>");
    header("refresh:3;url=todo.php");

    ?>
</body>

</html>
