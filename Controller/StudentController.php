
<?php
//student controller 

include_once 'ControllerFunctions.php';
include_once 'gateways/StudentGateway.php';
include_once 'database/DatabaseConnector.php';

class StudentController {

    private $db;

    private $requestMethod;

    private $id;

    private $studentGateway;
    private $item;

    public function __construct( $requestMethod, $item, $id)
    {

        $db = new DatabaseConnector();

        $this->requestMethod = $requestMethod;

        $this->id = $id;
        $this->item = $item;

        $this->studentGateway = new StudentGateway($db->getConnection());
    }

    public function processRequest()
    {
        

        switch ($this->requestMethod) 
        {
            case 'POST':
                $response = $this->createSensorDataFromRequest();
                break;

            case 'GET':
                switch ($this->item) {
                    case 'short':
                        $response = $this->getStudentDataShort($this->id);
                    break;
                    case 'card':
                        $response = $this->getStudentCard($this->id);
                    break;
                    case 'long':
                        $response = $this->getStudentInfoLong($this->id);
                    break;
                    case 'grades':
                        $response = $this->getStudentGrades($this->id);
                    case 'class':
                        $response = $this->GetStudentByClass($this->id);
                    break;

                }
                
                break;
        }

        header($response['status_code_header']);

        if ($response['body']) 
        {
            echo $response['body'];
        }

    }

    private function createStudentDataFromRequest()
    {

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (! $this->validateEvent($input1)) {

            return $this->unprocessableEntityResponse();

        }

        $this->studentGateway->insert($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';

        $response['body'] = null;

        return $response;

    }

    private function getStudentDataShort() 
    {
        $result = $this->studentGateway->findStudentInfoShort($this->id);

       /* if (! $result) {

            return $this->notFoundResponse();

        }*/

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

    private function getStudentCard() 
    {
        $result = $this->studentGateway->findStudentCard($this->id);

        if (! $result) {

            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        
        return $response;
    }

    private function getStudentInfoLong() 
    {
        $result = $this->studentGateway->findStudentInfoLong($this->id);

        if (! $result) {

            return $this->notFoundResponse();

        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

    private function getStudentGrades() 
    {
        $result = $this->studentGateway->findStudentGrades($this->id);

        if (! $result) {

            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }
   
    private function GetStudentByClass() {
        $result = $this->studentGateway->findStudentByClass($this->id);

        if (! $result) {

            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

}

?>