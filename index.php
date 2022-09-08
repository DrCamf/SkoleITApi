<?php 

include_once 'Controller/AbsenseController.php';
include_once 'Controller/LoginController.php';
include_once 'Controller/EducationController.php';
include_once 'Controller/FagController.php';
include_once 'Controller/MessageController.php';
include_once 'Controller/SkemaController.php';
include_once 'Controller/StudentController.php';
include_once 'Controller/TeacherController.php';


header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//Getting what gateway to use
$pass = "";
$item = "";
//$id = "";
// Getting id and if the is an item that too
if ($_GET) {
    $pass = $_GET['pass'];
    $item = $_GET['item'];
    $id = $_GET['id'];

    //Getting what method is requested it could be get, post, put or delete
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    switch($pass) {

        case 'underviser':
            $controller = new TeacherController($requestMethod, $id);
            break;

        case 'elev':
            $controller = new StudentController($requestMethod, $item ,$id);
            break;

        case 'login':
            $controller = new LoginController($requestMethod, $id);
            break;

        case 'studie':
            $controller = new EducationController($requestMethod, $id);
            break;

        case 'fag':
            $controller = new FagController($requestMethod, $id);
            break;

        case 'besked':
            $controller = new MessageController($requestMethod,$id);
            break;
        
        case 'skema':
            $controller = new SkemaController($requestMethod,$id);
            break;
        
        default:
            $controller = new LoginController($requestMethod, $id);
            break;
    }
    $controller->processRequest();

} else {
    echo "NOOOOOO";
}

   
      
    
   

?>

