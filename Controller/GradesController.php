
<?php
//absense controller 
include_once 'ControllerFunctions.php';
include_once 'gateways/GradesGateway.php';
include_once 'database/DatabaseConnector.php';

class GradesController {

    private $db;

    private $requestMethod;

    private $id;

    private $gradesController;

    public function __construct( $requestMethod, $id)
    {

        $db = new DatabaseConnector();

        $this->requestMethod = $requestMethod;

        $this->id = $id;

        $this->gradesController = new GradesController($db->getConnection());
    }

    public function processRequest()
    {
        

        switch ($this->requestMethod) 
        {
            case 'POST':
                $response = $this->createGradeDataFromRequest();
                break;

            case 'GET':
                $response = $this->getGradeData($this->id);
                break;
        }

        header($response['status_code_header']);

        if ($response['body']) 
        {
            echo $response['body'];
        }

    }

    private function createGradeDataFromRequest()
    {

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (! $this->validateEvent($input)) {

            return $this->unprocessableEntityResponse();

        }

        $this->gradesController->insert($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';

        $response['body'] = null;

        return $response;

    }

    private function getGradeData($id) 
    {
        $result = $this->gradesController->find($id);

        if (! $result) {

            return $this->notFoundResponse();

        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

    

}

?>