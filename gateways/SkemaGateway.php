<?php
 //SKemaGateway
class SkemaGateway 
{

    private $db = null;

   

    public function __construct($db)
    {
        $this->db = $db;
    }

   /* public function insert(Array $input)
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
    }*/

    public function findDay($id){
        date_default_timezone_set('Europe/Copenhagen');
        $date = date('Y-m-d', time());
        $statement ="CALL GetSkemaDay(:dato, :id )"; //:id;

        try {

            $statement = $this->db->prepare($statement);
            $statement->bindParam('dato',  $date);
            $statement->bindParam('id',  $id);
            $statement->execute();

            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e)
        {
            exit($e->getMessage());
        }    
    }

    









}



?>