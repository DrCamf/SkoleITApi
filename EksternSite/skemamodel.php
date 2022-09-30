<?php




class Skema 
{

    private $db = null;

   

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function studentsByclass($class) {
        $statement ="
        SELECT Users.id, Users.firstName, Users.sirName from Users 
        INNER JOIN StudentClasses ON StudentClasses.student_id = Users.id 
        INNER JOIN Classes ON StudentClasses.classes_id = Classes.id 
        WHERE Classes.name = :class;"; //:id;

        try {
    
            $statement =  $this->db->prepare($statement);
            $statement->bindParam('class', $class);
            $statement->execute();
    
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            
            $count = $statement->columnCount();

            if($count > 0) {
                return $result;
            }
            
        } catch (\PDOException $e)
        {
            exit($e->getMessage());
        } 
    }

    public function Getclasses() {
        $statement ="SELECT Classes.name FROM Classes;"; //:id;

        try {
    
            $statement =  $this->db->prepare($statement);
            
            $statement->execute();
    
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            
            $count = $statement->columnCount();

            if($count > 0) {
                return $result;
            }
            
        } catch (\PDOException $e)
        {
            exit($e->getMessage());
        } 
    }

    public function GetFag() {
        $statement ="SELECT id, name FROM Fag";
        
        try{
            $statement =  $this->db->prepare($statement);
            
            $statement->execute();
    
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            
            $count = $statement->columnCount();

            if($count > 0) {
                return $result;
            }
        }
        catch (\PDOException $e)
        {
            exit($e->getMessage());
        } 
    }
}

?>