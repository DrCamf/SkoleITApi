<?php

include_once 'ControllerFunctions.php';
include_once 'gateways/ClassesGateway.php';
include_once 'database/DatabaseConnector.php';

class ClassController 
{
    private $db;

    private $requestMethod;

    private $id;
    private $item;

    private $classGateway;

    public function __construct( $requestMethod, $item, $id)
    {

        $db = new DatabaseConnector();

        $this->requestMethod = $requestMethod;

        $this->id = $id;
        $this->item = $item;

        $this->classGateway = new ClassesGateway($db->getConnection());
    }

    public function processRequest()
    {
        switch ($this->requestMethod) 
        {
            case 'POST':
                $response = $this->createClassInputFromRequest();
                break;
            case 'GET':
                if($this->item == 'one') {
                $response = $this->getClassData($this->id);
                } else {
                    $response = $this->getAllClasses();
                }
                break;
        }

        header($response['status_code_header']);

        if ($response['body']) 
        {
            echo $response['body'];
        }
    }

    private function createClassInputFromRequest()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (! $this->validateEvent($input)) 
        {
            return $this->unprocessableEntityResponse();
        }

        $this->classGateway->insert($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';

        $response['body'] = null;

        return $response;
    }

    private function getClassData($id) 
    {
        $result = $this->classGateway->find($id);

        if (! $result) 
        {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }


    private function getAllClasses() 
    {
        $result = $this->classGateway->findAll();

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