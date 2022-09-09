<?php

class LoginGateway 
{

    private $db = null;

   

    public function __construct($db)
    {
        $this->db = $db;
    }


    private function getStudid($studname) 
    {
        $statement = "CALL GetUsersId(:studname);";

        try{
            $statement = $this->db->prepare($keystatement);
            $statement->execute(array(
                'studname'  => $input['username']
            ));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) 
        {
            exit($e->getMessage());
        }
     
    }

    private function getloginid()
    {
        $statement = "CALL GetLastLoginId()";
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

    public function insert(Array $input)
    {
       
        $statement = "CALL CreateLogin(:username, :password)";     
        $newstatement = "CALL AddStudentToLogin(:loginid , studid )";
        

        try {

            $statement = $this->db->prepare($statement);
           
            $hashed_password = password_hash($input['password'], PASSWORD_DEFAULT);
            $statement->execute(array(
                'username'  => $input['username'],
                'password' => $hashed_password 
            ));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            // se på return 
           
            //return $statement->rowCount();
            
           
            $studid = getStudid($input['username']);
            $loginid = getloginid();

            $newstatement = $this->db->prepare($newstatement);
            $newstatement->execute(array(
                'loginid'  => $loginid,
                'studid' => $studid
            ));
            if($newstatement->rowCount() > 0){
                return true;
            }


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

    









}



?>