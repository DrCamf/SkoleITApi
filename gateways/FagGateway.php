<?php
/* StudentGateway
class LoginGateway 
{

    private $db = null;

   

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insert(Array $input)
    {
       
        $statement = "        
        INSERT INTO sensorData (`s_data`, `sensordate`, `sensor_id`, type_id) 
        VALUES(:s_data, :sensordate, :sensorid, :typeid); ";

        try {

            $statement = $this->db->prepare($statement);
          
            $statement->execute(array(
                's_data' => $input['s_data'],
                'typeid'=>$input['typeid'],
                'sensordate'  => $input['sensordate'],
                'sensorid' => $input['sensorid'] 
            ));

            return $statement->rowCount();

        } catch (\PDOException $e) 
        {
            exit($e->getMessage());
        }    
    }

    public function find($id){
       
        $statement ="SELECT `username`, `password` FROM `sdelogin` WHERE username = :username"; //:id;
      

        try {

            $statement = $this->db->prepare($statement);
            $statement->bindParam('username',  $id);
            $statement->execute();

            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e)
        {
            exit($e->getMessage());
        }    
    }

    









}*/



?>