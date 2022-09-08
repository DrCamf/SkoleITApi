<?php

$html =  '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="opretuser.php" method="post">
  <br>
  <p>Login</p>
    <input type="text" name="login">
    <p>Password</p>
    <input type="password" name="password">
    <br>
    <br>
    <input type="submit" value="Opret">
  
</form>
</body>
</html>';




if($_POST) {

    $host = "localhost";  

    //$username = "admin";  
   // server
    $dbusername = "clvsnhfo_sdeAdmin";
    $dbpassword = "sde130ErOk";  
    $database = "clvsnhfo_svendetryoutdb";


/*
        //$database = "serverroom";   
        $database = "svendetryout";
        $message = "";  
        $dbusername = "root";
        $dbpassword = "";  
*/
    try {

        $conn = new \PDO(

            "mysql:host=$host;charset=utf8mb4;dbname=$database",

            $dbusername,

            $dbpassword
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";

    } catch (\PDOException $e) {

        exit($e->getMessage());
    }

    $login = $_POST["login"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $statement = "INSERT INTO `sdelogin`(`username`, `password`) VALUES (:login, :password);";

    try {

        $statement = $conn->prepare($statement);
      
        $statement->execute(array(
            'login' => $login,
            'password'=>$hashed_password               
        ));
        echo "Done";
        echo $html;

    } catch (\PDOException $e) 
    {
        exit($e->getMessage());
    }       



} else {
    echo $html;
    date_default_timezone_set('Europe/Copenhagen');
    $date = date('Y-m-d', time());
    echo $date;
}








?>


