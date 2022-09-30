<?php
 //StudentGateway
class StudentGateway 
{

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insert(Array $input)
    {
       /*AddStudentInfo(IN fName varchar(128), IN sName varchar(128), IN Phonen1 int, IN Phonen2 int, 
        IN sEmail varchar(128), IN pEmail varchar(128), In pic varchar(128), IN postid int, IN instid int, 
        IN birth DATE, IN adr varchar(128))*/
        $statement = "CALL AddStudentInfo(:firstname, :sirname, :phonenbr1, :phonenbr2, :semail, :pemail, :birth, :adress, :image, :postid, :insti );";

        try {

            $statement = $this->db->prepare($statement);
          
            $statement->execute(array(
                'firstname' => $input['firstname'],
                'sirname'=>$input['sirname'],
                'phonenbr1' => $input['phone1'],
                'phonenbr2' => $input['phone2'], 
                'semail'  => $input['schoolemail'],
                'pemail' => $input['privateemail'], 
                'birth'  => $input['birthdate'],
                'adress' => $input['adress'], 
                'image'  => $input['image'],
                'postid' => $input['postid'], 
                'instid' => $input['instid']
            ));

            return $statement->rowCount();

        } catch (\PDOException $e) 
        {
            exit($e->getMessage());
        }    
    }

    public function findStudentInfoShort($id){
            
        $statement ="CALL GetStudentInfoShort(:username);"; 
      
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
    
    public function findStudentInfoLong($id){

        $statement ="CALL GetStudentInfoLong(:username);"; 
      
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

    public function findStudentCard($id){
       
        $statement ="CALL GetStudentCard(:useridname)"; 
      
        try {

            $statement = $this->db->prepare($statement);
            $statement->bindParam('useridname',  $id);
            $statement->execute();

            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            
            return $result;
        } 
        catch (\PDOException $e)
        {
            exit($e->getMessage());
        } 
    }


    public function findStudentGrades($id){
       
        $statement ="CALL GetStudentGrades(:useridname)"; 
      
        try {

            $statement = $this->db->prepare($statement);
            $statement->bindParam('useridname',  $id);
            $statement->execute();

            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
              
            return $result;
        } 
        catch (\PDOException $e)
        {
            exit($e->getMessage());
        } 
    }
    public function findStudentByClass($id){
       
        $statement ="CALL GetUserByClass(:id)"; 
      
        try {

            $statement = $this->db->prepare($statement);
            $statement->bindParam('id',  $id);
            $statement->execute();

            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
          
            return $result;
        } 
        catch (\PDOException $e)
        {
            exit($e->getMessage());
        } 
    }

    public function findAll()
    {
        $statement ="SELECT id, firstName, sirName FROM Users";
      

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