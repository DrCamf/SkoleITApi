
<?php


    $strSql = "";
    $strSqls = "";
    for($i = 198; $i <= 218; $i++) {
        $strSql .= "INSERT INTO `TeacherHours`(`skema_id`, `teacher_id`) VALUES (" . $i . ", " . 2 . " );";
    }
    for($i = 219; $i <= 229; $i++) {
        $strSql .= "INSERT INTO `TeacherHours`(`skema_id`, `teacher_id`) VALUES (" . $i . ", " . 1 . " );";
    }

    for($i = 198; $i <= 229; $i++){
        for($j = 45; $j <= 71; $j++) {
            $strSqls .= "INSERT INTO `SkemaUser`(`skema_id`, `student_id`) VALUES ( ". $i . ", " . $j .  ");";
        }
    }
echo $strSql ."<br><br>";
echo $strSqls;


?>

