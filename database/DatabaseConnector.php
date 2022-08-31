<?php
class DatabaseConnector {

    private $dbConnection = null;

    function __construct()
    {
        
        $host = "localhost";  
/* Server
        //$username = "admin";  
        $dbusername = "clvsnhfo_sdeAdmin";
    
        $dbpassword = "sde130ErOk";  
    
            //$database = "serverroom";   
        $database = "clvsnhfo_svendetryoutdb";
            $message = "";  
*/
            $database = "svendetryout";
            $message = "";  
            $dbusername = "root";
            $dbpassword = ""; 
    
        try {
    
            $this->dbConnection = new \PDO(
    
                "mysql:host=$host;charset=utf8mb4;dbname=$database",
    
                $dbusername,
    
                $dbpassword
            );
           
    
        } catch (\PDOException $e) {
    
            exit($e->getMessage());
        }
    

    }

    function getConnection()
    {
        
        return $this->dbConnection;

    }

}
?>