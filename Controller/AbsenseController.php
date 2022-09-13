
<?php
//absense controller 
include_once 'ControllerFunctions.php';
include_once 'gateways/AbsenseGateway.php';
include_once 'database/DatabaseConnector.php';

class AbsenseController {

    private $db;

    private $requestMethod;

    private $id;

    private $absenseGateway;

    public function __construct( $requestMethod, $id)
    {

        $db = new DatabaseConnector();

        $this->requestMethod = $requestMethod;

        $this->id = $id;

        $this->absenseGateway = new AbsenseGateway($db->getConnection());
    }

    public function processRequest()
    {
        

        switch ($this->requestMethod) 
        {
            case 'POST':
                $response = $this->createAbsenseDataFromRequest();
                break;

            case 'GET':
                $response = $this->getAbsenseData($this->id);
                break;
        }

        header($response['status_code_header']);

        if ($response['body']) 
        {
            echo $response['body'];
        }

    }

    private function createAbsenseDataFromRequest()
    {

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (! $this->validateEvent($input1)) {

            return $this->unprocessableEntityResponse();

        }

        $this->absenseGateway->insert($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';

        $response['body'] = null;

        return $response;

    }

    private function getAbsenseData($id) 
    {
        $result = $this->absenseGateway->find($id);

        if (! $result) {

            return $this->notFoundResponse();

        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

    

}

?>