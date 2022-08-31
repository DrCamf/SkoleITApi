<?php 

include_once 'Controller/LoginController.php';


header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//Getting what gateway to use
/*$pass = "";
$item = "";*/
//$id = "";
// Getting id and if the is an item that too
if ($_GET) {
    //$pass = $_GET['pass'];
    echo "dude";
    $id = $_GET['id'];
} else {
    echo "NOOOOOO";
}

//Getting what method is requested it could be get, post, put or delete
$requestMethod = $_SERVER["REQUEST_METHOD"];

//


   
$controller = new LoginController($requestMethod, $id);
        
    
    
    /*default:
       $controller = new UdlaanController($requestMethod, $id);
        break;*/


$controller->processRequest();

?>

