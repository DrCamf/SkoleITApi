

<?php
include_once 'dbconn.php';
$con = getdb();

 if(isset($_POST["Import"])){
    $filename=$_FILES["file"]["tmp_name"];    
     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            $hashed_password = password_hash($getData[1], PASSWORD_DEFAULT);
             $sql = "INSERT into sdelogin `(`username`, `password`)  
                   values ('".$getData[0]."','".$hashed_password."')";
                   $result = mysqli_query($con, $sql);
        if(!isset($result))
        {
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"index.php\"
              </script>";    
        }
        else {
            echo "<script type=\"text/javascript\">
            alert(\"CSV File has been successfully Imported.\");
            window.location = \"index.php\"
          </script>";
        }
           }
      
           fclose($file);  
     }
  }  
  if(isset($_POST["Export"])){
     
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=data.csv');  
    $output = fopen("php://output", "w");  
    fputcsv($output, array('username', 'password'));  
    $query = "SELECT * from sdelogin ORDER BY username DESC";  
    $result = mysqli_query($con, $query);  
    while($row = mysqli_fetch_assoc($result))  
    {  
         fputcsv($output, $row);  
    }  
    fclose($output);  
}   

  
 ?>