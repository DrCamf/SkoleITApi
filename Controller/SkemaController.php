
<?php
//skema controller 

include_once 'gateways/SkemaGateway.php';
include_once 'database/DatabaseConnector.php';

class SkemaController {

    private $db;

    private $requestMethod;

    private $id;

    private $skemaGateway;

    public function __construct( $requestMethod, $id)
    {

        $db = new DatabaseConnector();

        $this->requestMethod = $requestMethod;

        $this->id = $id;

        $this->skemaGateway = new SkemaGateway($db->getConnection());
    }

    public function processRequest()
    {
        

        switch ($this->requestMethod) 
        {
            /*case 'POST':
                $response = $this->createSensorDataFromRequest();
                break;*/

            case 'GET':
                $response = $this->getSkemaData($this->id);
                break;
        }

        header($response['status_code_header']);

        if ($response['body']) 
        {
            echo $response['body'];
        }

    }
/*
    private function createSensorDataFromRequest()
    {

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (! $this->validateEvent($input1)) {

            return $this->unprocessableEntityResponse();

        }

        $this->skemaGateway->insert($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';

        $response['body'] = null;

        return $response;

    }*/

    private function getSkemaData($id) 
    {
        $result = $this->skemaGateway->findDay($id);

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