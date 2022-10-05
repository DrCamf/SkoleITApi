
<?php
//teacher controller 
include_once 'ControllerFunctions.php';
include_once 'gateways/TeacherGateway.php';
include_once 'database/DatabaseConnector.php';

class TeacherController {

    private $db;

    private $requestMethod;

    private $id;
    private $item;

    private $teacherGateway;

    public function __construct( $requestMethod, $item, $id)
    {

        $db = new DatabaseConnector();

        $this->requestMethod = $requestMethod;

        $this->id = $id;
        $this->item = $item;

        $this->teacherGateway = new TeacherGateway($db->getConnection());
    }

    public function processRequest()
    {
        

        switch ($this->requestMethod) 
        {
            case 'POST':
                $response = $this->createTeacherInputFromRequest();
                break;

            case 'GET':
                if($this->item == 'one') {
                $response = $this->getTeacherData($this->id);
                } else {
                    $response = $this->getAllTeachers();
                }
                break;
        }

        header($response['status_code_header']);

        if ($response['body']) 
        {
            echo $response['body'];
        }

    }

    private function createTeacherInputFromRequest()
    {

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (! $this->validateEvent($input1)) 
        {
            return $this->unprocessableEntityResponse();
        }

        $this->teacherGateway->insert($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';

        $response['body'] = null;

        return $response;

    }

    private function getTeacherData($id) 
    {
        $result = $this->teacherGateway->find($id);

        if (! $result) 
        {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }


    private function getAllTeachers() {
        $result = $this->teacherGateway->findAll();

        if (! $result) 
        {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

    

}

?>