<?php

include_once 'database/DatabaseConnector.php';
include_once 'models/StudentModel.php';
include_once 'gateways/StudentGateway.php';
include_once 'models/SkemaModel.php';
include_once 'gateways/SkemaGateway.php';



class SkemaInsert{
   
    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insert($sqlstr)
    {
       
        $statement = "        
        //INSERT INTO `Skema`(`fag_id`, `location_id`, `start`, `ending`) VALUES (:fagid, :locationdid,' :start',' :ending');
         ";

        try {

            $statement = $this->db->prepare($sqlstr);
          
            $statement->execute(array(
                
            ));
           
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            //return $result;

        } catch (\PDOException $e) 
        {
            exit($e->getMessage());
        }    
    }

    public function getLast() {
        $statement = "        
        SELECT MAX(id) AS id FROM `Skema` LIMIT 1;
         ";

         try {

            $statement = $this->db->prepare($statement);
          
            $statement->execute(array(
                
            ));
           
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result["id"];

        } catch (\PDOException $e) 
        {
            exit($e->getMessage());
        }    
    }
}



if($_POST) {

    $db = new DatabaseConnector();

    $url = "https://svt.elthoro.dk/?pass=skema";

    $class = $_POST["class"];
    
    $studentGateway = new StudentGateway($db->getConnection());

    $skemaInsert = new SkemaInsert($db->getConnection());

    $responseStudent = $studentGateway->findStudentByClass($class);

    $retStudent = array();
    foreach($responseStudent as $resp) 
    {
        //$fag = (object)array();
        $student = new StudentModel();
        $student->id = $resp["id"];
        $student->firstName = $resp["firstName"];
        $student->sirName = $resp["sirName"];
        array_push( $retStudent, $student );  
    }

    $retStudentid= array();
    foreach($retStudent as $student){
       array_push( $retStudentid,  $student->id  );
    }

    $fag = array($_POST["fagm"], $_POST["fagt"], $_POST["fago"], $_POST["fagto"], $_POST["fagf"]);
    $room = array($_POST["roomm"], $_POST["roomt"], $_POST["roomo"], $_POST["roomto"], $_POST["roomf"]);
    $teacher = array($_POST["teacherm"],$_POST["teachert"],$_POST["teachero"],$_POST["teacherto"],$_POST["teacherf"]);
   
    $mandagstart = array();
    $mandagslut = array();
    $tirdagsstart = array();
    $tirdagsslut = array();
    $onsdagsstart = array();
    $onsdagsslut = array();
    $torsdagsstart = array();
    $torsdagsslut = array();
    $fredagsstart = array();
    $fredagsslut = array();

    $teacher1 = 0;
    $teacher2 = 0;

 
    // Monday
    if (isset( $_POST["Mandag_first"])){ $date = $_POST["Mandag_810"]; array_push( $mandagstart, $date );  $date = $_POST["Mandag855"];  array_push( $mandagslut, $date );  }
    if (isset($_POST["Mandag_second"])){ $date = $_POST["Mandag_855"]; array_push( $mandagstart, $date );  $date = $_POST["Mandag940"];  array_push( $mandagslut, $date );}
    if (isset($_POST["Mandag_third"])){$date = $_POST["Mandag_10"]; array_push( $mandagstart, $date );  $date = $_POST["Mandag1045"] ; array_push( $mandagslut, $date ); }
    if (isset($_POST["Mandag_fourth"])){$date = $_POST["Mandag_1045"]; array_push( $mandagstart, $date );  $date = $_POST["Mandag1130"] ; array_push( $mandagslut, $date ); }
    if (isset($_POST["Mandag_fifth"])){$date = $_POST["Mandag_12"] ;array_push( $mandagstart, $date );  $date = $_POST["Mandag1245"] ; array_push( $mandagslut, $date ); }
    if (isset($_POST["Mandag_sixth"])){$date = $_POST["Mandag_1245"]; array_push( $mandagstart, $date );  $date = $_POST["Mandag1330"] ; array_push( $mandagslut, $date ); }
    if (isset($_POST["Mandag_seventh"])){$date = $_POST["Mandag_1345"] ;array_push( $mandagstart, $date );  $date = $_POST["Mandag1430"] ; array_push( $mandagslut, $date ); }
    if (isset($_POST["Mandag_eigthth"])){ $date = $_POST["Mandag_1430"]; array_push( $mandagstart, $date );  $date = $_POST["Mandag1515"];  array_push( $mandagslut, $date );}

    // Tuesday
    if (isset($_POST["Tirsdag_first"])){ $date = $_POST["Tirsdag_810"]; array_push( $tirdagsstart, $date );  $date = $_POST["Tirsdag855"] ; array_push( $tirdagsslut, $date );  }
    if (isset($_POST["Tirsdag_second"])){ $date = $_POST["Tirsdag_855"]; array_push( $tirdagsstart, $date );  $date = $_POST["Tirsdag940"] ; array_push( $tirdagsslut, $date );}
    if (isset($_POST["Tirsdag_third"])){$date = $_POST["Tirsdag_10"]; array_push( $tirdagsstart, $date );  $date = $_POST["Tirsdag1045"] ; array_push( $tirdagsslut, $date ); }
    if (isset($_POST["Tirsdag_fourth"])){$date = $_POST["Tirsdag_1045"]; array_push( $tirdagsstart, $date );  $date = $_POST["Tirsdag1130"] ; array_push( $tirdagsslut, $date ); }
    if (isset($_POST["Tirsdag_fifth"])){$date = $_POST["Tirsdag_12"]; array_push( $tirdagsstart, $date );  $date = $_POST["Tirsdag1245"] ; array_push( $tirdagsslut, $date ); }
    if (isset($_POST["Tirsdag_sixth"])){$date = $_POST["Tirsdag_1245"]; array_push( $tirdagsstart, $date );  $date = $_POST["Tirsdag1330"] ; array_push( $tirdagsslut, $date ); }
    if (isset($_POST["Tirsdag_seventh"])){$date = $_POST["Tirsdag_1345"]; array_push( $tirdagsstart, $date );  $date = $_POST["Tirsdag1430"] ; array_push( $tirdagsslut, $date ); }
    if (isset($_POST["Tirsdag_eigthth"])){ $date = $_POST["Tirsdag_1430"]; array_push( $tirdagsstart, $date );  $date = $_POST["Tirsdag1515"] ; array_push( $tirdagsslut, $date );}

    // Wednesday
    if (isset($_POST["Onsdag_first"])){ $date = $_POST["Onsdag_810"]; array_push( $onsdagsstart, $date );  $date = $_POST["Onsdag855"] ; array_push( $onsdagsslut, $date );  }
    if (isset($_POST["Onsdag_second"])){ $date = $_POST["Onsdag_855"]; array_push( $onsdagsstart, $date );  $date = $_POST["Onsdag940"] ; array_push( $onsdagsslut, $date );}
    if (isset($_POST["Onsdag_third"])){$date = $_POST["Onsdag_10"]; array_push( $onsdagsstart, $date );  $date = $_POST["Onsdag1045"] ; array_push( $onsdagsslut, $date ); }
    if (isset($_POST["Onsdag_fourth"])){$date = $_POST["Onsdag_1045"]; array_push( $onsdagsstart, $date );  $date = $_POST["Onsdag1130"] ; array_push( $onsdagsslut, $date ); }
    if (isset($_POST["Onsdag_fifth"])){$date = $_POST["Onsdag_12"]; array_push( $onsdagsstart, $date );  $date = $_POST["Onsdag1245"] ; array_push( $onsdagsslut, $date ); }
    if (isset($_POST["Onsdag_sixth"])){$date = $_POST["Onsdag_1245"]; array_push( $onsdagsstart, $date );  $date = $_POST["Onsdag1330"] ; array_push( $onsdagsslut, $date ); }
    if (isset($_POST["Onsdag_seventh"])){$date = $_POST["Onsdag_1345"]; array_push( $onsdagsstart, $date );  $date = $_POST["Onsdag1430"] ; array_push( $onsdagsslut, $date ); }
    if (isset($_POST["Onsdag_eigthth"])){ $date = $_POST["Onsdag_1430"]; array_push( $onsdagsstart, $date );  $date = $_POST["Onsdag1515"] ; array_push( $onsdagsslut, $date );}

    // Thursday
    if (isset($_POST["Torsdag_first"])){ $date = $_POST["Torsdag_810"]; array_push( $torsdagsstart, $date );  $date = $_POST["Torsdag855"] ; array_push( $torsdagsslut, $date );  }
    if (isset($_POST["Torsdag_second"])){ $date = $_POST["Torsdag_855"]; array_push( $torsdagsstart, $date );  $date = $_POST["Torsdag940"] ; array_push( $torsdagsslut, $date );}
    if (isset($_POST["Torsdag_third"])){$date = $_POST["Torsdag_10"]; array_push( $torsdagsstart, $date );  $date = $_POST["Torsdag1045"] ; array_push( $torsdagsslut, $date ); }
    if (isset($_POST["Torsdag_fourth"])){$date = $_POST["Torsdag_1045"]; array_push( $torsdagsstart, $date );  $date = $_POST["Torsdag1130"] ; array_push( $torsdagsslut, $date ); }
    if (isset($_POST["Torsdag_fifth"])){$date = $_POST["Torsdag_12"]; array_push( $torsdagsstart, $date );  $date = $_POST["Torsdag1245"] ; array_push( $torsdagsslut, $date ); }
    if (isset($_POST["Torsdag_sixth"])){$date = $_POST["Torsdag_1245"]; array_push( $torsdagsstart, $date );  $date = $_POST["Torsdag1330"] ; array_push( $torsdagsslut, $date ); }
    if (isset($_POST["Torsdag_seventh"])){$date = $_POST["Torsdag_1345"]; array_push( $torsdagsstart, $date );  $date = $_POST["Torsdag1430"] ; array_push( $torsdagsslut, $date ); }
    if (isset($_POST["Torsdag_eigthth"])){ $date = $_POST["Torsdag_1430"]; array_push( $torsdagsstart, $date );  $date = $_POST["Torsdag1515"] ; array_push( $torsdagsslut, $date );}

    // Friday
    if (isset($_POST["Fredag_first"])){ $date = $_POST["Fredag_810"]; array_push( $fredagsstart, $date );  $date = $_POST["Fredag855"] ; array_push( $fredagsslut, $date );  }
    if (isset($_POST["Fredag_second"])){ $date = $_POST["Fredag_855"]; array_push( $fredagsstart, $date );  $date = $_POST["Fredag940"] ; array_push( $fredagsslut, $date );}
    if (isset($_POST["Fredag_third"])){$date = $_POST["Fredag_10"]; array_push( $fredagsstart, $date );  $date = $_POST["Fredag1045"] ; array_push( $fredagsslut, $date ); }
    if (isset($_POST["Fredag_fourth"])){$date = $_POST["Fredag_1045"]; array_push( $fredagsstart, $date );  $date = $_POST["Fredag1130"] ; array_push( $fredagsslut, $date ); }
    if (isset($_POST["Fredag_fifth"])){$date = $_POST["Fredag_12"]; array_push( $fredagsstart, $date );  $date = $_POST["Fredag1245"] ; array_push( $fredagsslut, $date ); }
    if (isset($_POST["Fredag_sixth"])){$date = $_POST["Fredag_1245"]; array_push( $fredagsstart, $date );  $date = $_POST["Fredag1330"] ; array_push( $fredagsslut, $date ); }
    if (isset($_POST["Fredag_seventh"])){$date = $_POST["Fredag_1345"]; array_push( $fredagsstart, $date );  $date = $_POST["Fredag1430"] ; array_push( $fredagsslut, $date ); }
    if (isset($_POST["Fredag_eigthth"])){ $date = $_POST["Fredag_1430"]; array_push( $fredagsstart, $date );  $date = $_POST["Fredag1515"] ; array_push( $fredagsslut, $date );}
    $responseArr = array(); 
    $strSql = "";
    $idFirst = $skemaInsert->getLast();
     echo "<br><br>";
    echo "id 1 = ";
    print_r($idFirst);
    echo "<br><br>";
    sleep(3);
    if (!empty($mandagstart)) {
        $mandagarr = array(); 
  
        for($i = 0; $i <= count($mandagstart)-1; $i++) 
        {
            $strSql .= "INSERT INTO `Skema`(`fag_id`, `location_id`, `start`, `ending`) VALUES (" . $fag[0]  . ", " .  $room[0]  . ", '" .  $mandagstart[$i] . "', '" .  $mandagslut[$i] . "');  <br>";
             //SELECT MAX(id) FROM `Skema` LIMIT 1; ";
            
            //$fag = (object)array();
            /*$Skema = new SkemaModel();
            $Skema->fagid = $fag[0];
            $Skema->locationid = $room[0];
            $Skema->start = "'". $mandagstart[$i] . "'";
            $Skema->ending = "'" . $mandagslut[$i] . "'";*/
        }       
        $teacher1 = $teacher[0];
        echo "<br>Teacher: " . $teacher[0] . " <br>";
        echo "man " . count($mandagstart) . "<br>";
       
               
    } 
    if (!empty($tirdagsstart)) {
        for($i = 0; $i <= count($tirdagsstart)-1; $i++) 
        {
            $strSql .= "INSERT INTO `Skema`(`fag_id`, `location_id`, `start`, `ending`) VALUES (" . $fag[1]  . ", " .  $room[1]  . ", '" .  $tirdagsstart[$i] . "', '" .  $tirdagsslut[$i] . "'); <br>";
             //SELECT MAX(id) FROM `Skema` LIMIT 1; ";
            
             
            //$fag = (object)array();
            /*$Skema = new SkemaModel();
            $Skema->fagid = $fag[0];
            $Skema->locationid = $room[0];
            $Skema->start = "'". $mandagstart[$i] . "'";
            $Skema->ending = "'" . $mandagslut[$i] . "'";*/
        }
        echo "<br>Teacher: " . $teacher[1] . " <br>";
        echo "tir" . count($tirdagsstart) . "<br>";   
        if ($teacher1 != $teacher[1]) {
            $teacher2 = $teacher[1];
        } 
       
       
    }
    if (!empty($onsdagsstart)) {
       for($i = 0; $i <= count($onsdagsstart)-1; $i++) 
        {
            $strSql .= "INSERT INTO `Skema`(`fag_id`, `location_id`, `start`, `ending`) VALUES (" . $fag[2]  . ", " .  $room[2]  . ", '" .  $onsdagsstart[$i] . "', '" .  $onsdagsslut[$i] . "');  <br>";
             //SELECT MAX(id) FROM `Skema` LIMIT 1; ";
           
             
            //$fag = (object)array();
            /*$Skema = new SkemaModel();
            $Skema->fagid = $fag[0];
            $Skema->locationid = $room[0];
            $Skema->start = "'". $mandagstart[$i] . "'";
            $Skema->ending = "'" . $mandagslut[$i] . "'";*/
        }
        echo "<br>Teacher: " . $teacher[2] . " <br>";
        echo "ons" . count($onsdagsstart) ."<br>";   
        if ($teacher1 != $teacher[2]) {
            $teacher2 = $teacher[2];
        } 
        
    } 
    if (!empty($torsdagsstart)) {
        for($i = 0; $i <= count($torsdagsstart)-1; $i++) 
        {
            $strSql .= "INSERT INTO `Skema`(`fag_id`, `location_id`, `start`, `ending`) VALUES (" . $fag[3]  . ", " .  $room[3]  . ", '" .  $torsdagsstart[$i] . "', '" .  $torsdagsslut[$i] . "');  <br>";
            // SELECT MAX(id) FROM `Skema` LIMIT 1; ";
           
            //$fag = (object)array();
            /*$Skema = new SkemaModel();
            $Skema->fagid = $fag[0];
            $Skema->locationid = $room[0];
            $Skema->start = "'". $mandagstart[$i] . "'";
            $Skema->ending = "'" . $mandagslut[$i] . "'";*/
        }
        echo "<br> Teacher: " . $teacher[3] . " <br>";
        echo "tor" . count($torsdagsstart) ."<br>";   
        if ($teacher1 != $teacher[3]) {
            $teacher2 = $teacher[3];
        } 
       
    } 
    if (!empty($fredagsstart)) {
        for($i = 0; $i <= count($fredagsstart)-1; $i++) 
        {
            $strSql .= "INSERT INTO `Skema`(`fag_id`, `location_id`, `start`, `ending`) VALUES (" . $fag[4]  . ", " .  $room[4]  . ", '" .  $fredagsstart[$i] . "', '" .  $fredagsslut[$i] . "');  <br>";
            // SELECT MAX(id) FROM `Skema` LIMIT 1; ";
           
            
            //$fag = (object)array();
            /*$Skema = new SkemaModel();
            $Skema->fagid = $fag[0];
            $Skema->locationid = $room[0];
            $Skema->start = "'". $mandagstart[$i] . "'";
            $Skema->ending = "'" . $mandagslut[$i] . "'";*/
        }
        echo "<br>Teacher: " . $teacher[4] . " <br>";
        echo "fre" . count($fredagsstart) ."<br>";   
        if ($teacher1 != $teacher[4]) {
            $teacher2 = $teacher[4];
        } 
       // echo  "SELECT MAX(id) FROM `Skema` LIMIT 1; " . $strSql . " SELECT MAX(id) FROM `Skema` LIMIT 1; ";
        
    }
    
    //$skemaInsert->insert($strSql);
    print_r($strSql);
    
    $idLast = $skemaInsert->getLast();
    echo "<br><br>";
    echo "<br> id 2 = ";
    print_r($idLast);

   print_r($retStudentid);
    /*for($i = $_POST[$idFirst]; $i <= $_POST[$idLast]; $i++){
        for($j = $_POST[$retStudentid[0]]; $j <= $_POST[end($retStudentid)]; $j++) {
            $strSqls .= "INSERT INTO `SkemaUser`(`skema_id`, `student_id`) VALUES ( ". $i . ", " . $j .  ");";
        }
    }*/
    // echo $strSqls;

    echo "<br> hdhdhdhdh";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<br><br><h2>Student</h2>

<table>

<?php
        
?>





</table>
<form action="" method="post">


</form>
</body>
</html>