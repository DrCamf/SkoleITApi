<?php

class AccessControll 
{

    private $db = null;

   

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function find($user, $pass) {
        $statement ="SELECT `username`, `password` FROM `sdelogin` WHERE username = :username"; //:id;
      

        try {
    
            $statement =  $this->db->prepare($statement);
            $statement->bindParam('username', $user);
            $statement->execute();
    
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            ;
            $count = $statement->columnCount();
            //echo $count;
            if($count > 0) {
                
               if(password_verify($pass, $result[0]["password"])) {
                    
                    return true;
                }
                
                
            } 
            
        } catch (\PDOException $e)
        {
            exit($e->getMessage());
        } 
    }

 

}


?>