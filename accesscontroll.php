<?php

class LoginReturn
{
    public int $userId;
    public ?string $username;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $fullName;
    public ?string $userImage;


    function set_name($userid, $username, $firstname, $lastname, $image) {
        $this->userId = $userid;
        $this->username = $username;
        $this->firstName = $firstname;
        $this->lastName = $lastname;
        $this->fullName = $firstname . " " . $lastname; 
        $this->userImage = $image;
      }

    function get_id() {
        return $this->userId;
    }

   
}

class AccessControll 
{

    private $db = null;

  

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function find($user, $pass) {
        $statement ="CALL GetUserAccess(:username)"; //:id;
        

        try {
    
            $statement =  $this->db->prepare($statement);
            $statement->bindParam('username', $user);
            $statement->execute();
    
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            
            $count = $statement->columnCount();
            $id = $result[0]["user_id"];
            
            $loginreturn = new LoginReturn();
            $loginreturn->set_name($id, $result[0]["username"], $result[0]["firstName"], $result[0]["sirName"], $result[0]["picture_path"]);
           

            if($count > 0) {
                
               if(password_verify($pass, $result[0]["password"])) {
                   
                    return $loginreturn;
                }
                
                
            } 
            
        } catch (\PDOException $e)
        {
            exit($e->getMessage());
        } 
    }

 

}


?>