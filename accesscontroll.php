<?php

class AccessControll 
{

    private $db = null;

   

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function find($user, $pass) {
        $statement ="SELECT UsersLogins.user_id, `username`, `password` FROM `sdelogin` INNER JOIN UsersLogins ON UsersLogins.login_id = sdelogin.id WHERE sdelogin.username = :username"; //:id;
      

        try {
    
            $statement =  $this->db->prepare($statement);
            $statement->bindParam('username', $user);
            $statement->execute();
    
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            
            $count = $statement->columnCount();
            $id = $result[0]["user_id"];
            if($count > 0) {
                
               if(password_verify($pass, $result[0]["password"])) {
                    
                    return $id;
                }
                
                
            } 
            
        } catch (\PDOException $e)
        {
            exit($e->getMessage());
        } 
    }

 

}


?>