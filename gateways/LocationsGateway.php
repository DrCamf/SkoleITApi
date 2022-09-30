<?php

class LocationsGateway {
   

    private $db = null;

   

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insert(Array $input)
    {
       
        $statement = "INSERT INTO `Locations`(`name`) VALUES (:lname) ";

        try {

            $statement = $this->db->prepare($statement);
          
            $statement->execute(array(
                'lname' => $input['name']
            ));
            $last_id = $statement->lastInsertId();
            
            return  $last_id;

        } catch (\PDOException $e) 
        {
            exit($e->getMessage());
        }    
    }

    public function find($id){
       
        $statement ="";
      

        try {

            $statement = $this->db->prepare($statement);
            $statement->bindParam('username',  $id);
            $statement->execute();

            $result = $statement->fetch(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e)
        {
            exit($e->getMessage());
        }    
    }

    public function findAll()
    {
        $statement ="SELECT id, name FROM Locations";
      

        try {

            $statement = $this->db->prepare($statement);
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