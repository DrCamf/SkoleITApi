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
    include_once 'database/DatabaseConnector.php';
    include_once 'Controller/LoginController.php';
    
    $db = new DatabaseConnector();
    $loginGateway = new LoginGateway($db->getConnection());
   



    

    $login = $_POST["login"];
    $password = $_POST["password"];

    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $data = ["{'username': ". $login .", 'password': " . $password . "}"];
    $result = json_encode($data);
    $input = (array) json_decode(file_get_contents($result), TRUE);
    if($loginGateway->insert($input)) {
    
        echo "Done";
        echo $html;
    
    }
    


} else {
    echo $html;
    date_default_timezone_set('Europe/Copenhagen');
    $date = date('Y-m-d', time());
    echo $date;
}








?>


