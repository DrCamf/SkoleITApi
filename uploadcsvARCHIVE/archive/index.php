<?php
$File = 'userscsv.csv';


$row = 1;
if (($handle = fopen($File, "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
    for ($c=0; $c < $num; $c++) {
        echo $data[$c] . "<br />\n";
    }
  }
  fclose($handle);
}


/*$arrResult  = array();
$handle     = fopen($File, "r");
if(empty($handle) === false) {
    while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
         $arrResult[] = $data;
    }
    fclose($handle);
}
print_r($arrResult);
*/
/*
$row = 0;
$headers = [];
//$filepath = "input.csv";
if (($handle = fopen($File, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if (++$row == 1) {
          $headers = array_flip($data); // Get the column names from the header.
          continue;
        } else {
          $col1 = $data[$headers['username']]; // Read row by the column name.
          $col2 = $data[$headers['password']];
          print "Row $row: $col1, $col2\n";
        }
    }
    fclose($handle);
}*/

?>
