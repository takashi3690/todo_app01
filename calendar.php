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
            body {
                background-color: #eaf6fd;
            }

            tbody {
                background-color: #fff;
            }

            table.calender_column {
                width: 100%;
            }

            .calendar-month {
                background-color: #f5fce8;
            }

            table.calender_column td {
                padding: 5px;
                border: 1px solid #CCC;
            }

            /* 日曜日 */
            table.calender_column tr.week0 {
                background-color: #ffefef;
                color: #FF0000;
            }

            /* 土曜日 */
            table.calender_column tr.week6 {
                background-color: #ededff;
                color: #0000FF;
            }

            /* 今日 */
            table.calender_column tr.today {
                background-color: #fbffa3;
                font-weight: bold;
            }

            table.calender_column td:first-child {
                width: 20%;
                text-align: center;
            }

            table.calender_column td:last-child {
                width: 80%;
                color: #111111;
            }

            .prev_button {
                padding: 10px 20px;
                margin: 5px;
                background-color: #add8e6;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                font-size: 5px;
                line-height: 1.5;
            }

            .now_button {
                padding: 10px 20px;
                margin: 5px;
                background-color: #add8e6;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                font-size: 5px;
                line-height: 1.5;
            }

            .next_button {
                padding: 10px 20px;
                margin: 5px;
                background-color: #add8e6;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                font-size: 5px;
                line-height: 1.5;
            }

            button:hover {
                background-color: #4d94ff;
            }

            a {
                text-decoration: none;
                /* リンクの下線を削除 */
                color: inherit;
                /* 色を親要素の色に合わせる */
            }
        </style>
    </head>
    <body>
        <h1>カレンダー</h1>
        <p><a href="todo.php">戻る</a></p>
        <div style="text-align: center;">
            <a href="?year=<?php echo $prevYear; ?>&month=<?php echo $prevMonth; ?>">
                <button class="prev_button"><?php echo $prevMonth; ?>月</button>
            </a>
            <a href="?year=<?php echo date('Y'); ?>&month=<?php echo date('m'); ?>">
                <button class="now_button"><?php echo date('m'); ?>月</button>
            </a>
            <a href="?year=<?php echo $nextYear; ?>&month=<?php echo $nextMonth; ?>">
                <button class="next_button"><?php echo $nextMonth; ?>月</button>
            </a>
        </div>
        <table class="calender_column">
            <tr>
                <th colspan="2" class="calendar-month"><?php echo "{$year}年 {$monthNames[(int)$month]}"; ?></th>
            </tr> <?php
        // もし aryCalendar が存在し、内容があれば表示
        if (isset($aryCalendar) && is_array($aryCalendar) && !empty($aryCalendar)) {
            foreach ($aryCalendar as $value) {
                if ($value['day'] != date('j')  && ($value['week'] !== null)) {
                    echo '<tr class="week' . $value['week'] . '">';
                } else {
                    echo '<tr class="today">';
                }
                echo '<td>' . $value['day'] . ' (' . $aryWeek[$value['week']] . ')</td>';
                echo '<td>' . (isset($value['text']) ? htmlspecialchars($value['text'], ENT_QUOTES, 'UTF-8') : '') . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="2">カレンダー情報がありません。</td></tr>';
        }
        ?>
        </table>
    </body>
</html>
