<?php
require_once __DIR__ . '/Models/carendar.php';
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>カレンダー</title>
        <style>
            table.calender_column{
    width: 100%;
}

table.calender_column td{
    padding: 5px;
    border: 1px solid #CCC;
}

/* 日曜日 */
table.calender_column tr.week0{
    background-color: #ffefef;
    color: #FF0000;
}

/* 土曜日 */
table.calender_column tr.week6{
    background-color: #ededff;
    color: #0000FF;
}

/* 今日 */
table.calender_column tr.today{
    background-color: #fbffa3;
    font-weight: bold;
}

table.calender_column td:first-child{
    width: 20%;
    text-align: center;
}

table.calender_column td:last-child{
    width: 80%;
    color: #111111;
}
        </style>
    </head>
    <body>
        <h1>カレンダー</h1>
        <p><a href="todo.php">戻る</a></p>
        <table class="calender_column"> <?php foreach($aryCalendar as $value){ ?> <?php if($value['day'] != date('j')){ ?> <tr class="week<?php echo $value['week'] ?>"> <?php }else{ ?>
            <tr class="today"> <?php } ?> <td> <?php echo $value['day'] ?>(<?php echo $aryWeek[$value['week']] ?>) </td>
                <td> <?php echo $value['text'] ?> </td>
            </tr> <?php } ?>
        </table>
    </body>
</html>
