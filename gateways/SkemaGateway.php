<?php
 //SKemaGateway
include_once 'models/SkemaModel.php';
class SkemaGateway 
{

    private $db = null;

   

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insert(SkemaModel $skema)
    {
       /*
        $statement = "        
        INSERT INTO `Skema`(`fag_id`, `location_id`, `start`, `ending`) VALUES (:fagid, :locationdid, :start, :ending);
        SELECT MAX(id) AS Mid FROM `Skema` LIMIT 1; ";

        try {

            $statement = $this->db->prepare($statement);
          
            $statement->execute(array(
                'fagid' => $skema->fagid,
                'locationid'=> $skema->locationid,
                'start'  => $skema->start,
                'ending' => $skema->ending 
            ));
           
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result;

        } catch (\PDOException $e) 
        {
            exit($e->getMessage());
        }  */
    }

    public function insertString($sqlStr)
    {
       /* try {

            $statement = $this->db->prepare($sqlStr);
          
            $statement->execute();
           
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result;

        } catch (\PDOException $e) 
        {
            exit($e->getMessage());
        }  */
    }

    public function findDay($whatday, $id){
        /*date_default_timezone_set('Europe/Copenhagen');
        $date = date('Y-m-d', time());
        $dateback = date('Y-m-d', strtotime("-1 months"));*/
        //echo $dateback;
        $statement ="CALL GetSkemaDay(:dato, :id )"; //:id;

        try {

            $statement = $this->db->prepare($statement);
            $statement->bindParam('dato',  $whatday);
            $statement->bindParam('id',  $id);
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