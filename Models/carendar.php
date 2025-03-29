<?php

declare(strict_types=1);
require_once(dirname(__FILE__) . '/DB.php');

//タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

//表示させる年月を設定 ↓これは現在の年月
$currentDate = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
$year = $currentDate->format('Y');
$month = $currentDate->format('m');
$end_month = $currentDate->format('t'); //月末日取得

//来月と先月の年月を取得
$nextMonthDate = new DateTime('first day of next month', new DateTimeZone('Asia/Tokyo'));
$prevMonthDate = new DateTime('first day of last month', new DateTimeZone('Asia/Tokyo'));

//来月と先月の設定
$nextYear = $nextMonthDate->format('Y');
$nextMonth = $nextMonthDate->format('m');
$end_nextmonth = $nextMonthDate->format('t');

$prevYear = $prevMonthDate->format('Y');
$prevMonth = $prevMonthDate->format('m');
$end_prevMonth = $prevMonthDate->format('t');


//スケジュール設定 日付をキーに
$arySchedule = [];
$aryScheduleNext = [];
$arySchedulePrev = [];



try {
    $db = new DB();
    $pdo = $db->getPDO();
    //現在の月の情報
    $stmt = $pdo->prepare(
        'SELECT * FROM sample_item WHERE (
        (YEAR(tododate) = :year AND MONTH(tododate) = :month) OR
        (YEAR(tododate) = :nextYear AND MONTH(tododate) = :nextMonth) OR
        (YEAR(tododate) = :prevYear AND MONTH(tododate) = :prevMonth)
        ) ORDER BY tododate DESC');
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->bindParam(':month', $month, PDO::PARAM_INT);
    $stmt->bindParam(':nextYear', $nextYear, PDO::PARAM_INT);
    $stmt->bindParam(':nextMonth', $nextMonth, PDO::PARAM_INT);
    $stmt->bindParam(':prevYear', $prevYear, PDO::PARAM_INT);
    $stmt->bindParam(':prevMonth', $prevMonth, PDO::PARAM_INT);
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
