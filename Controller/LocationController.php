
<?php
//fag controller 

include_once 'ControllerFunctions.php';
include_once 'gateways/LocationsGateway.php';
include_once 'database/DatabaseConnector.php';

class LocationController {

    private $db;

    private $requestMethod;

    private $id;
    private $item;

    private $locationGateway;

    public function __construct( $requestMethod, $item, $id)
    {

        $db = new DatabaseConnector();

        $this->requestMethod = $requestMethod;

        $this->id = $id;
        $this->item = $item;

        $this->locationGateway = new LocationsGateway($db->getConnection());
    }

    public function processRequest()
    {
        

        switch ($this->requestMethod) 
        {
            case 'POST':
                $response = $this->createLocationsDataFromRequest();
                break;

            case 'GET':
                if($this->item == 'one') {
                    $response = $this->getLocationsData($this->id);
                } else {
                    $response = $this->getAllLocationsData();
                }
             
                break;
                
        }

        header($response['status_code_header']);

        if ($response['body']) 
        {
            echo $response['body'];
        }

    }

    private function createLocationsDataFromRequest()
    {

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        /*if (! $this->validateEvent($input)) {

            return $this->unprocessableEntityResponse();

        }*/

        $this->locationGateway->insert($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';

        $response['body'] = null;

        return $response;

    }

    private function getLocationsData($id) 
    {
        $result = $this->locationGateway->find($id);

        if (! $result) {

            return $this->notFoundResponse();

        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

    private function getAllLocationsData() 
    {
        $result = $this->locationGateway->findAll();

        if (! $result) {

            return $this->notFoundResponse();

        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

   
}

?>