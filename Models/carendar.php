<?php

declare(strict_types=1);
require_once(dirname(__FILE__) . '/DB.php');

//タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

$monthNames = [
    1 => '1月', 2 => '2月', 3 => '3月', 4 => '4月', 5 => '5月', 6 => '6月',
    7 => '7月', 8 => '8月', 9 => '9月', 10 => '10月', 11 => '11月', 12 => '12月'
];

$year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
$month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');

//表示させる年月を設定 ↓これは現在の年月
$currentDate = new DateTime("{$year}-{$month}-01", new DateTimeZone('Asia/Tokyo'));
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
        $tododate = new DateTime($row['tododate'], new DateTimeZone('Asia/Tokyo'));
        $day = (int) $tododate->format('d');

        //現在の月
        if ($tododate->format('Y-m') === "{$year}-{$month}") {
            $arySchedule[$day] = $row['todo'];
        }

        //来月
        if ($tododate->format('Y-m') === "{$nextYear}-{$nextMonth}") {
            $aryScheduleNext[$day] = $row['todo'];
        }

        //先月
        if ($tododate->format('Y-m') === "{$prevYear}-{$prevMonth}") {
            $arySchedulePrev[$day] = $row['todo'];
        }
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
