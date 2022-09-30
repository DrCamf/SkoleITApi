<?php
$strSql = "";
$strSqls = "";
for($i = 145; $i <= 165; $i++) {
    $strSql .= "INSERT INTO `TeacherHours`(`skema_id`, `teacher_id`) VALUES (" . $i . ", 1 );";
}
for($i = 166; $i <= 176; $i++) {
    $strSql .= "INSERT INTO `TeacherHours`(`skema_id`, `teacher_id`) VALUES (" . $i . ", 2 );";
}
echo $strSql . "<br><br>";

for($i = 145; $i <= 176; $i++){
    for($j = 45; $j <= 71; $j++) {
        $strSqls .= "INSERT INTO `SkemaUser`(`skema_id`, `student_id`) VALUES ( ". $i . ", " . $j .  ");";
    }
}
echo $strSqls . "<br><br>";
?>