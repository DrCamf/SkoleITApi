<?php

class LoginGateway 
{

    private $db = null;

   

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insert(Array $input)
    {
       
        $statement = "CALL CreateLogins(:username, :password, @out_value)";     
        $newstatement = "CALL AddStudentToLogin(:loginid , studid )";

        try {

            $statement = $this->db->prepare($statement);
           
            $hashed_password = password_hash($input['password'], PASSWORD_DEFAULT);
            $statement->execute(array(
                'username'  => $input['username'],
                'password' => $hashed_password 
            ));

            // se på return 

            return $statement->rowCount();

            $newstatement = $this->db->prepare($newstatement);
            $newstatement->execute(array(
                //'loginid'  => //return from former,
                'studid' => $studid
            ));


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