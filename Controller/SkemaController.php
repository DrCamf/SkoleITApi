
<?php
//skema controller 

include_once 'ControllerFunctions.php';
include_once 'gateways/SkemaGateway.php';
include_once 'database/DatabaseConnector.php';

class SkemaController {

    private $db;

    private $requestMethod;

    private $id;
    private $item;

    private $skemaGateway;

    public function __construct( $requestMethod, $item, $id)
    {

        $db = new DatabaseConnector();

        $this->requestMethod = $requestMethod;

        $this->id = $id;
        $this->item = $item;

        $this->skemaGateway = new SkemaGateway($db->getConnection());
    }

    public function processRequest()
    {
        

        switch ($this->requestMethod) 
        {
            case 'POST':
                if($this->item == 'one') {
                    $response = $this->createSkemaDataFromRequest();
                    } else {
                        $response = $this->createSkemaDataFromString();
                    }
                break;
               
               

            case 'GET':
                $response = $this->getSkemaData($this->item, $this->id);
                break;
        }

        header($response['status_code_header']);

        if ($response['body']) 
        {
            echo $response['body'];
        }

    }

    private function createSkemaDataFromRequest()
    {

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (! $this->validateEvent($input)) {

            return $this->unprocessableEntityResponse();

        }

        $this->skemaGateway->insert($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';

        $response['body'] = null;

        return $response;

    }

    private function createSkemaDataFromString()
    {

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (! $this->validateEvent($input)) {

            return $this->unprocessableEntityResponse();

        }

        $this->skemaGateway->insertString($sqlStr);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';

        $response['body'] = null;

        return $response;

    }




    private function getSkemaData($item, $id) 
    {
        $result = $this->skemaGateway->findDay($item, $id);

        /*if (! $result) {

            return $this->notFoundResponse();

        }*/

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

   
}

?>