<?php
include_once 'database/DatabaseConnector.php';
include 'accesscontroll.php';
$db = new DatabaseConnector();
$accessControl = new AccessControll($db->getConnection());









if(!isset($_SERVER ['PHP_AUTH_USER'])) {
    header("WWW_Authenticate: Basic realm=\"Private Area\"");
    header("HTTP/1.0 401 Unauthorized");
    print "Sorry, you have no credentials";
    exit;
} else {
    $allow = new LoginReturn();
    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];
    $allow = $accessControl->find($username, $password);
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
    //$responseBody = "{userid : '" . $allow . "' }";
    
     

    if($allow != null ) {
        
        header("HTTP/1.1 200 OK");
        $response['body'] = json_encode($allow);
        echo $response['body'];
        
        
    } else {
        header("WWW_Authenticate: Basic realm=\"Private Area\"");
        header("HTTP/1.0 401 Unauthorized");
        print "Sorry, you need proper credentials";
        exit;
    }
}

?>