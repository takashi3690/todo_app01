<?php

declare(strict_types=1);
require_once(dirname(__FILE__) . '/DB.php');

//タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

//表示させる年月を設定　↓これは現在の月
$year = date('Y');
$month = date('m');

//月末日を取得
$end_month = date('t', strtotime($year.$month.'01'));

//スケジュール設定 日付をキーに
$arySchedule = [];

try {
    $db = new DB();

    $pdo = $db->getPDO();
    $stmt = $pdo->prepare('SELECT * FROM sample_item WHERE YEAR(tododate) = :year AND MONTH(tododate) = :month ORDER BY tododate DESC');
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->bindParam(':month', $month, PDO::PARAM_INT);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $day = (int) date('d', strtotime($row['tododate']));
        $arySchedule[$day] = $row['todo'];
    }

} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

$aryCalendar = [];

//1日から月末日までループ
for ($i = 1; $i <= $end_month; $i++){
    $aryCalendar[$i]['day'] = $i;
    $aryCalendar[$i]['week'] = date('w', strtotime($year.$month.sprintf('%02d', $i)));
    if(isset($arySchedule[$i])){
        $aryCalendar[$i]['text'] = $arySchedule[$i];
    }else{
        $aryCalendar[$i]['text'] = '';
    }
}

$aryWeek = ['日', '月', '火', '水', '木', '金', '土'];
