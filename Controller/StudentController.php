
<?php
//student controller 

include_once 'gateways/StudentGateway.php';
include_once 'database/DatabaseConnector.php';

class StudentController {

    private $db;

    private $requestMethod;

    private $id;

    private $studentGateway;
    private $item;

    public function __construct( $requestMethod,$item, $id)
    {

        $db = new DatabaseConnector();

        $this->requestMethod = $requestMethod;

        $this->id = $id;
        $this->item = $item;

        $this->studentGateway = new StudentGateway($db->getConnection());
    }

    public function processRequest($item)
    {
        

        switch ($this->requestMethod) 
        {
            case 'POST':
                $response = $this->createSensorDataFromRequest();
                break;

            case 'GET':
                switch ($this->item) {
                    case 'short':
                        $response = $this->getStudentDataShort($id);
                    break;
                    case 'card':
                        $response = $this->getStudentCard($id);
                    break;
                    case 'long':
                        $response = $this->findStudentInfoLong($id);
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

    private function getStudentDataShort($id) 
    {
        $result = $this->studentGateway->findStudentInfoShort($id);

        if (! $result) {

            return $this->notFoundResponse();

        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

    private function getStudentCard($id) 
    {
        $result = $this->studentGateway->findStudentCard($id);

        if (! $result) {

            return $this->notFoundResponse();

        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

    private function unprocessableEntityResponse()
    {

        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';

        $response['body'] = json_encode([

            'error' => 'Invalid input'

        ]);

        return $response;
    }

    private function notFoundResponse()
    {

        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';

        $response['body'] = null;

        return $response;

    }

}

?>