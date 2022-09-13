<?php

class TeacherGateway 
{

    private $db = null;

   

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insert(Array $input)
    {
       
        $statement = "";

        try {

            $statement = $this->db->prepare($statement);
          
            $statement->execute(array(
                's_data' => $input['s_data']
            ));

            return $statement->rowCount();

        } catch (\PDOException $e) 
        {
            exit($e->getMessage());
        }    
    }

    public function find($id){
       
        $statement =""; //:id;
    
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

}



?>