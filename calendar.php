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
            .calendar-wrap {
                margin: 0 auto;
                max-width: 1110px;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 40px;
            }

            <blade media|%20(max-width%3A%20767.98px)%20%7B%0D>.calendar-wrap {
                display: flex;
                flex-direction: column;
            }
            }

            .calendar {
                width: 100%;
                border-collapse: collapse;
            }

            .calendar th,
            .calendar td {
                border: 1px solid #000;
                text-align: center;
                padding: 10px;
                font-size: 14px;
                font-weight: bold;
            }

            .calendar th {
                padding: 6px 10px;
            }

            .calendar td {}

            <blade media|%20(max-width%3A%20767.98px)%20%7B%0D>.calendar th,
            .calendar td {
                padding: 6px;
                font-size: 12px;
            }

            .calendar th {
                padding: 3px 6px;
            }
            }

            .calendar .sun {
                color: #e17f7e;
                background-color: #f8e4e2;
            }

            .calendar .sat {
                color: #7ab6f3;
                background-color: #e7f6fd;
            }

            .calendar .mute {
                color: #aaa;
            }

            .calendar .today {
                background-color: #7d7d7d;
            }

            .calendar .off {
                background-color: #fadcdb;
            }
        </style>
    </head>
    <body>
        <h1>カレンダー</h1>
        <div class="calendar-wrap">
            <table class="calendar">
                <thead>
                    <tr>
                        <th class="sun">Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th class="sat">Sat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="mute">29</td>
                        <td class="mute">30</td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td class="off">7</td>
                        <td>8</td>
                        <td>9</td>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td class="today">13</td>
                        <td class="off">14</td>
                        <td>15</td>
                        <td>16</td>
                        <td>17</td>
                        <td>18</td>
                        <td>19</td>
                    </tr>
                    <tr>
                        <td>20</td>
                        <td class="off">21</td>
                        <td>22</td>
                        <td>23</td>
                        <td>24</td>
                        <td>25</td>
                        <td>26</td>
                    </tr>
                    <tr>
                        <td>27</td>
                        <td class="off">28</td>
                        <td>29</td>
                        <td>30</td>
                        <td>31</td>
                        <td class="mute">1</td>
                        <td class="mute">2</td>
                    </tr>
                </tbody>
            </table>
            <table class="calendar">
                <thead>
                    <tr>
                        <th class="sun">Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th class="sat">Sat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="mute">27</td>
                        <td class="mute">28</td>
                        <td class="mute">29</td>
                        <td class="mute">30</td>
                        <td class="mute">31</td>
                        <td>1</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class="off">4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                    </tr>
                    <tr>
                        <td class="today">10</td>
                        <td class="off">11</td>
                        <td>12</td>
                        <td>13</td>
                        <td>14</td>
                        <td>15</td>
                        <td>16</td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td class="off">18</td>
                        <td>19</td>
                        <td>20</td>
                        <td>21</td>
                        <td>22</td>
                        <td>23</td>
                    </tr>
                    <tr>
                        <td>24</td>
                        <td class="off">25</td>
                        <td>26</td>
                        <td>27</td>
                        <td>28</td>
                        <td>29</td>
                        <td>30</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
