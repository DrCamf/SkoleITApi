<?php
include_once 'database/DatabaseConnector.php';
include 'accesscontroll.php';

if(!isset($_SERVER ['PHP_AUTH_USER'])) {
    header("WWW_Authenticate: Basic realm=\"Private Area\"");
    header("HTTP/1.0 401 Unauthorized");
    print "Sorry, you have no credentials";
    exit;
} else {
    $allow = 0;
    $db = new DatabaseConnector();
    $accessControl = new AccessControll($db->getConnection());
    

    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];
    
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $allow = $accessControl->find($username, $password);
     

    if($allow > 0 ) {
        header("HTTP/1.1 200 OK");
        
        print "You're INNNN";
        
        
    } else {
        header("WWW_Authenticate: Basic realm=\"Private Area\"");
        header("HTTP/1.0 401 Unauthorized");
        print "Sorry, you need proper credentials";
        exit;
    }
}

?>