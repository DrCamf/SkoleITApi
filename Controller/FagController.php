
<?php
//fag controller 

include_once 'ControllerFunctions.php';
include_once 'gateways/FagGateway.php';
include_once 'database/DatabaseConnector.php';

class FagController {

    private $db;

    private $requestMethod;

    private $id;
    private $item;

    private $fagGateway;

    public function __construct( $requestMethod, $item, $id)
    {

        $db = new DatabaseConnector();

        $this->requestMethod = $requestMethod;

        $this->id = $id;
        $this->item = $item;

        $this->fagGateway = new FagGateway($db->getConnection());
    }

    public function processRequest()
    {
        

        switch ($this->requestMethod) 
        {
            case 'POST':
                $response = $this->createFagDataFromRequest();
                break;

            case 'GET':
                if($this->item == 'one') {
                    $response = $this->getFagData($this->id);
                } else {
                    $response = $this->getAllFagData();
                }


                
                break;

                
        }

        header($response['status_code_header']);

        if ($response['body']) 
        {
            echo $response['body'];
        }

    }

    private function createFagDataFromRequest()
    {

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (! $this->validateEvent($input1)) {

            return $this->unprocessableEntityResponse();

        }

        $this->fagGateway->insert($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';

        $response['body'] = null;

        return $response;

    }

    private function getFagData($id) 
    {
        $result = $this->fagGateway->find($id);

        if (! $result) {

            return $this->notFoundResponse();

        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

    private function getAllFagData() 
    {
        $result = $this->fagGateway->findAll();

        if (! $result) {

            return $this->notFoundResponse();

        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

   
}

?>