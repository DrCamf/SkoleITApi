<?php
function getdb(){
$servername = "localhost";
$username = "clvsnhfo_sdeAdmin";
$password = "sde130ErOk";
$db = "clvsnhfo_svendetryoutdb";


try {
   
    $conn = mysqli_connect($servername, $username, $password, $db);
     //echo "Connected successfully"; 
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
?>