<?php
require_once __DIR__ . '/Models/carendar.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カレンダー</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>カレンダー</h1>
<table>
    <thead>
        <tr>
        <?php foreach($weeks as $week) : ?>
            <th><?php echo $week ?></th>
        <?php endforeach ?>
        </tr>
    </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
        </tbody>
</table>
</body>
</html>
