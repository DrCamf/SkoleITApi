
<?php
//Message controller 

include_once 'ControllerFunctions.php';
include_once 'gateways/MessageGateway.php';
include_once 'database/DatabaseConnector.php';

class MessageController {

    private $db;

    private $requestMethod;

    private $id;

    private $messageGateway;

    public function __construct( $requestMethod, $id)
    {

        $db = new DatabaseConnector();

        $this->requestMethod = $requestMethod;

        $this->id = $id;

        $this->messageGateway = new MessageGateway($db->getConnection());
    }

    public function processRequest()
    {
        

        switch ($this->requestMethod) 
        {
            case 'POST':
                $response = $this->createMessageDataFromRequest();
                break;

            case 'GET':
                $response = $this->getMessageData($this->id);
                break;
        }

        header($response['status_code_header']);

        if ($response['body']) 
        {
            echo $response['body'];
        }

    }

    private function createMessageDataFromRequest()
    {

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (! $this->validateEvent($input1)) {

            return $this->unprocessableEntityResponse();

        }

        $this->messageGateway->insert($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';

        $response['body'] = null;

        return $response;

    }

    private function getMessageData($id) 
    {
        $result = $this->messageGateway->find($id);

        if (! $result) {

            return $this->notFoundResponse();

        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        
        return $response;
    }

    

}

?>