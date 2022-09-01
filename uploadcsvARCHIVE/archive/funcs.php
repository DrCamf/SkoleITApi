<?php
include_once 'dbconn.php';

function get_all_records(){
    $con = getdb();
    $Sql = "SELECT * FROM sdelogin";
    $result = mysqli_query($con, $Sql);  
    if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead><tr><th>username</th>
                          <th>password</th>
                          
                        </tr></thead><tbody>";
     while($row = mysqli_fetch_assoc($result)) {
         echo "<tr><td>" . $row['username']."</td>
                   <td>" . $row['password']."</td>
                  </tr>";        
     }
    
     echo "</tbody></table></div>";
     
} else {
     echo "you have no records";
}
}

?>