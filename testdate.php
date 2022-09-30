<?php
/*$dates = [];
$end      = new DateTimeImmutable('Monday');
$start    = $end->modify('+1 month');

$interval = new DateInterval('P1W');
$period   = new DatePeriod($start, $interval, $end);*/
//$date = new DateTime('Monday'); $date->setISODate('2022', '38');
//echo $date->format('Y-m-d');

//echo idate('W', mktime(0, 0, 0, 12, 28, 2022));
/*

foreach ($period as $date) {
    $friday = $date->modify('Friday');
    $dates[] = sprintf('%s ', $date->format('W'), PHP_EOL);
}
$dates = array_reverse($dates);
foreach ($dates  as $week) {
    echo $week;
}*/

/*
145-165 1
166-176 2
*/
if($_POST) {
    $strSql = "";
    $strSqls = "";
    for($i = $_POST["t1from"]; $I <= $_POST["t1to"]; $i++) {
        $strSql .= "INSERT INTO `TeacherHours`(`skema_id`, `teacher_id`) VALUES (" . $i . ", " . $_POST['teacher'] . " );";
    }
    for($i = $_POST["t2from"]; $i <= $_POST["t2to"]; $i++) {
        $strSql .= "INSERT INTO `TeacherHours`(`skema_id`, `teacher_id`) VALUES (" . $i . ", " . $_POST['teacher2'] . " );";
    }

    for($i = $_POST["from"]; $i <= $_POST["to"]; $i++){
        for($j = $_POST["studentfrom"]; $j <= $_POST["studentto"]; $j++) {
            $strSqls .= "INSERT INTO `SkemaUser`(`skema_id`, `student_id`) VALUES ( ". $i . ", " . $j .  ");";
        }
    }

}



//145-176 45-71




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teststyles.css">
    <title>Document</title>
</head>
<body>


<form action="todata.php" method="post">
<input type="hidden" value="test" name="f" />
<input type="submit" />
</form>


<h2>Forbindelser</h2>
<form action="" method="post">
<label for="t1from">Fagid fra</label>
<input type="number" name="t1from" id=""><br><br>
<label for="t1to">Fagid til</label>
<input type="number" name="t1to" id=""><br><br>
<label for="teacher">Teacher 1</label>
<input type="number" name="teacher" id=""><br><br>
<label for="t2from">Fagid fra</label>
<input type="number" name="t2from" id=""><br><br>
<label for="t2to">Fagid til</label>
<input type="number" name="t2to" id=""><br><br>
<label for="teacher2">Teacher 2</label>
<input type="number" name="teacher2" id=""><br><br>
<label for="from">Fagid fra</label>
<input type="number" name="from" id=""><br><br>
<label for="to">Fagid til</label>
<input type="number" name="to" id=""><br><br>
<label for="studentfrom">Student Fra</label>
<input type="number" name="studentfrom" id=""><br><br>
<label for="studentto">Student Til</label>
<input type="number" name="studentto" id=""><br><br>
<input type="submit" value="Send">
</form>
</body>
</html>