<?php 



include_once 'skemamodel.php';
include_once 'models/fagmodel.php';
include_once 'models/LokaleModel.php';
include_once 'models/TeacherModel.php';
include_once 'models/ClassesModel.php';



// get api call for location, fag, teacher, classes

// Urls
$urlroom = 'https://svt.elthoro.dk/?pass=room';
$urlfag = 'https://svt.elthoro.dk/?pass=fag';
$urlteacher = 'https://svt.elthoro.dk/?pass=underviser';
$urlclass = 'https://svt.elthoro.dk/?pass=class';


// Get Fag
$response =  ReceiveFromUrl($urlfag);
$responseFag = json_decode($response, true);

// Get location
$response =  ReceiveFromUrl($urlroom);
$responseLocal = json_decode($response, true);

// Get Teacher
$response =  ReceiveFromUrl($urlteacher);
$responseTeacher = json_decode($response, true);

// Get Classes
$response =  ReceiveFromUrl($urlclass);
$responseClass = json_decode($response, true);

// Class Array
$retClasses = array();
foreach($responseClass as $resp) 
{
    //$fag = (object)array();
    $class = new ClassesModel();
    $class->id = $resp["id"];
    $class->name = $resp["name"];
    array_push( $retClasses, $class );  
}  

// Fag Array
$retFag = array();
foreach($responseFag as $resp) 
{
    //$fag = (object)array();
    $fag = new FagModel();
    $fag->id = $resp["id"];
    $fag->name = $resp["name"];
    array_push( $retFag, $fag );  
}

// Room Array
$retRoom = array();
foreach($responseLocal as $resp) 
{
    //$fag = (object)array();
    $room = new LokaleModel();
    $room->id = $resp["id"];
    $room->name = $resp["name"];
    array_push( $retRoom, $room );  
}

// Teacher Array
$retTeacher = array();
foreach($responseTeacher as $resp) 
{
    //$fag = (object)array();
    $room = new TeacherModel();
    $room->id = $resp["id"];
    $room->firstName = $resp["firstName"];
    array_push( $retTeacher, $room );  
}

function ReceiveFromUrl($url) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache"
        ),
      ));
      
      $response = curl_exec($curl);
      $err = curl_error($curl);
      return $response;
      curl_close($curl);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teststyles.css">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
            
        $(document).ready(function(){
            $(".checkmf").click(function(){
                $("Mandag_first").prop("checked", true);
            });
            $(".checktf").click(function(){
                $("#Tirsdag_first").prop("checked", true);
            });
            $(".checkof").click(function(){
                $("#Onsdag_first").prop("checked", true);
            });
            $(".checktof").click(function(){
                $("#Torsdag_first").prop("checked", true);
            });
            $(".checkff").click(function(){
                $("#Fredag_first").prop("checked", true);
            });
        });
        </script>
</head>
<body>
    <h2>SKEMA LÆGNING</h2>


<form action="classes.php" method="post">
<label for="week">Choose a week in Rest of 2022:</label>

<input type="week" name="week" id="camp-week" min="2022-W38" max="2023-W26" required onchange="printdate()">

<table border="1">
<tr>
    <td>FAG</td>
    <td><select name="fagm" id="fagm">   
    
    <?php
    // Fag dropdown for monday to friday
    foreach($retFag as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->name .'</option>';
    }
    ?>
    </select> </td>
    <td><select name="fagt" id="fagt">   
    <?php
    foreach($retFag as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->name .'</option>';
    }
    ?>
    </select></td>
    <td><select name="fago" id="fago">   
    <?php
    foreach($retFag as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->name .'</option>';
    }
    ?>   
    </select></td>
    <td><select name="fagto" id="fagto">   
    <?php
    foreach($retFag as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->name .'</option>';
    }
    ?>
    </select></td>
    <td><select name="fagf" id="fagf">   
    <?php
    foreach($retFag as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->name .'</option>';
    }
    ?>
     
    </select></td>
</tr>
<tr>
    <td>Lokale/ Lærer</td>
    <td><select name="roomm" id="roomm">   
    
    <?php
    // location dropdown for monday to friday
    foreach($retRoom as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->name .'</option>';
    }
    ?>
    </select> 
    <select name="teacherm" id="teacherm">   
    
    <?php
    foreach($retTeacher as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->firstName .'</option>';
    }
    ?>
    </select>
</td>
    <td><select name="roomt" id="roomt">   
    <?php
    foreach($retRoom as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->name .'</option>';
    }
    ?>
    </select>
    <select name="teachert" id="teachert">   
    <?php
    foreach($retTeacher as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->firstName .'</option>';
    }
    ?>
    </select>


</td>
    <td><select name="roomo" id="roomo">   
    <?php
    foreach($retRoom as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->name .'</option>';
    }
    ?>   
    </select>
    <select name="teachero" id="teachero">   
    <?php
    foreach($retTeacher as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->firstName .'</option>';
    }
    ?>   
    </select>

</td>
    <td><select name="roomto" id="roomto">   
    <?php
    foreach($retRoom as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->name .'</option>';
    }
    ?>
    </select>
    <select name="teacherto" id="teacherto">   
    <?php
    foreach($retTeacher as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->firstName .'</option>';
    }
    ?>
    </select>

</td>
    <td><select name="roomf" id="roomf">   
    <?php
    foreach($retRoom as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->name .'</option>';
    }
    ?>
     
    </select>
    <select name="teacherf" id="teacherf">   
    <?php
    foreach($retTeacher as $fag){
        echo '<option value="' .$fag->id .'">'. $fag->firstName .'</option>';
    }
    ?>
     
    </select>
     
<div></div>

</td>
</tr>
<tr> <!-- Date Times -->
    <td>Time</td>
    <td>Mandag <span id="mandag" ></span></td>
    <td>Tirsdag <span id="tirsdag"></span></td>
    <td>Onsdag <span id="onsdag"></span></td>
    <td>Torsdag <span id="torsdag"></span></td>
    <td>Fredag <span id="fredag"></span></td>
</tr>
<tr>
    <td>8.10 -8.55</td>
    
    <td><div class="checkmf"><input type="checkbox"  name="Mandag_first" id="Mandag_first" value="1"><input type="hidden" name="Mandag_810" id="Mandag_810" value=""><input type="hidden" name="Mandag855" id="Mandag855" value=""></div></td>
    <td><div  class="checktf"><input type="checkbox"   name="Tirsdag_first" id="Tirsdag_first" value="1"><input type="hidden" name="Tirsdag_810" id="Tirsdag_810"  value=""><input type="hidden" name="Tirsdag855" id="Tirsdag855"  value=""></div></td>
    <td><div  class="checkof"><input type="checkbox"   name="Onsdag_first" id="Onsdag_first" value="1"><input type="hidden" name="Onsdag_810" id="Onsdag_810" ><input type="hidden" name="Onsdag855" id="Onsdag855" > </div></td>
    <td><div class="checktof"><input type="checkbox"   name="Torsdag_first" id="Torsdag_first" value="1"><input type="hidden" name="Torsdag_810" id="Torsdag_810" ><input type="hidden" name="Torsdag855" id="Torsdag855" > </div></td>
    <td><div  class="checkff"><input type="checkbox"   name="Fredag_first" id="Fredag_first" value="1" ><input type="hidden" name="Fredag_810" id="Fredag_810" ><input type="hidden" name="Fredag855" id="Fredag855" > </div></td>
</tr>
<tr>
    <td>8.55 -9.40</td>
    <td><div><input type="checkbox" name="Mandag_second" id="Mandag_second" ><input type="hidden" name="Mandag_855" id="Mandag_855" ><input type="hidden" name="Mandag940" id="Mandag940" ></div></td>
    <td><div><input type="checkbox" name="Tirsdag_second" id="Tirsdag_second" ><input type="hidden" name="Tirsdag_855" id="Tirsdag_855" ><input type="hidden" name="Tirsdag940" id="Tirsdag940"> </div></td>
    <td><div><input type="checkbox" name="Onsdag_second" id="Onsdag_second" ><input type="hidden" name="Onsdag_855" id="Onsdag_855" ><input type="hidden" name="Onsdag940" id="Onsdag940"></div></td>
    <td><div><input type="checkbox" name="Torsdag_second" id="Torsdag_second" ><input type="hidden" name="Torsdag_855" id="Torsdag_855" ><input type="hidden" name="Torsdag940" id="Torsdag940"></div></td>
    <td><div><input type="checkbox" name="Fredag_second" id="Fredag_second"><input type="hidden" name="Fredag_855" id="Fredag_855" ><input type="hidden" name="Fredag940" id="Fredag940" ></div></td>
</tr>
<tr>
    <td>10.00 -10.45</td>
    <td><div><input type="checkbox" name="Mandag_third" id="Mandag_third"><input type="hidden" name="Mandag_10" id="Mandag_10"><input type="hidden" name="Mandag1045" id="Mandag1045" ></div></td>
    <td><div><input type="checkbox" name="Tirsdag_third" id="Tirsdag_third"><input type="hidden" name="Tirsdag_10" id="Tirsdag_10"><input type="hidden" name="Tirsdag1045" id="Tirsdag1045" ></div></td>
    <td><div><input type="checkbox" name="Onsdag_third" id="Onsdag_third"><input type="hidden" name="Onsdag_10" id="Onsdag_10"><input type="hidden" name="Onsdag1045" id="Onsdag1045" ></div></td>
    <td><div><input type="checkbox" name="Torsdag_third" id="Torsdag_third"><input type="hidden" name="Torsdag_10" id="Torsdag_10"><input type="hidden" name="Torsdag1045" id="Torsdag1045" ></div></td>
    <td><div><input type="checkbox" name="Fredag_third" id="Fredag_third"><input type="hidden" name="Fredag_10" id="Fredag_10"><input type="hidden" name="Fredag1045" id="Fredag1045" ></div></td>
</tr>
<tr>
    <td>10.45 -11.30</td>
    <td><div><input type="checkbox" name="Mandag_fourth" id="Mandag_fourth"><input type="hidden" name="Mandag_1045" id="Mandag_1045"><input type="hidden" name="Mandag1130" id="Mandag1130" ></div></td>
    <td><div><input type="checkbox" name="Tirsdag_fourth" id="Tirsdag_fourth"><input type="hidden" name="Tirsdag_1045" id="Tirsdag_1045"><input type="hidden" name="Tirsdag1130" id="Tirsdag1130" ></div></td>
    <td><div><input type="checkbox" name="Onsdag_fourth" id="Onsdag_fourth"><input type="hidden" name="Onsdag_1045" id="Onsdag_1045"><input type="hidden" name="Onsdag1130" id="Onsdag1130" ></div></td>
    <td><div><input type="checkbox" name="Torsdag_fourth" id="Torsdag_fourth"><input type="hidden" name="Torsdag_1045" id="Torsdag_1045"><input type="hidden" name="Torsdag1130" id="Torsdag1130" ></div></td>
    <td><div><input type="checkbox" name="Fredag_fourth" id="Fredag_fourth"><input type="hidden" name="Fredag_1045" id="Fredag_1045"><input type="hidden" name="Fredag1130" id="Fredag1130" ></div></td>
</tr>
<tr>
    <td>12.00 -12.45</td>
    <td><div><input type="checkbox" name="Mandag_fifth" id="Mandag_fifth"><input type="hidden" name="Mandag_12" id="Mandag_12"><input type="hidden" name="Mandag1245" id="Mandag1245" ></div></td>
    <td><div><input type="checkbox" name="Tirsdag_fifth" id="Tirsdag_fifth"><input type="hidden" name="Tirsdag_12" id="Tirsdag_12"><input type="hidden" name="Tirsdag1245" id="Tirsdag1245" ></div></td>
    <td><div><input type="checkbox" name="Onsdag_fifth" id="Onsdag_fifth"><input type="hidden" name="Onsdag_12" id="Onsdag_12"><input type="hidden" name="Onsdag1245" id="Onsdag1245" ></div></td>
    <td><div><input type="checkbox" name="Torsdag_fifth" id="Torsdag_fifth"><input type="hidden" name="Torsdag_12" id="Torsdag_12"><input type="hidden" name="Torsdag1245" id="Torsdag1245" ></div></td>
    <td><div><input type="checkbox" name="Fredag_fifth" id="Fredag_fifth"><input type="hidden" name="Fredag_12" id="Fredag_12"><input type="hidden" name="Fredag1245" id="Fredag1245" ></div></td>
</tr>
<tr>
    <td>12.45 -13.30</td>
    <td><div><input type="checkbox" name="Mandag_sixth" id="Mandag_sixth"><input type="hidden" name="Mandag_1245" id="Mandag_1245"><input type="hidden" name="Mandag1330" id="Mandag1330" > </div></td>
    <td><div><input type="checkbox" name="Tirsdag_sixth" id="Tirsdag_sixth"><input type="hidden" name="Tirsdag_1245" id="Tirsdag_1245"><input type="hidden" name="Tirsdag1330" id="Tirsdag1330" > </div></td>
    <td><div><input type="checkbox" name="Onsdag_sixth" id="Onsdag_sixth"><input type="hidden" name="Onsdag_1245" id="Onsdag_1245"><input type="hidden" name="Onsdag1330" id="Onsdag1330" > </div></td>
    <td><div><input type="checkbox" name="Torsdag_sixth" id="Torsdag_sixth"><input type="hidden" name="Torsdag_1245" id="Torsdag_1245"><input type="hidden" name="Torsdag1330" id="Torsdag1330" > </div></td>
    <td><div><input type="checkbox" name="Fredag_sixth" id="Fredag_sixth"><input type="hidden" name="Fredag_1245" id="Fredag_1245"><input type="hidden" name="Fredag1330" id="Fredag1330" > </div></td>
</tr>
<tr>
    <td>13.45 -14.30</td>
    <td><div><input type="checkbox" name="Mandag_seventh" id="Mandag_seventh"><input type="hidden" name="Mandag_1345" id="Mandag_1345"><input type="hidden" name="Mandag1430" id="Mandag1430" >  </div></td>
    <td><div><input type="checkbox" name="Tirsdag_seventh" id="Tirsdag_seventh"><input type="hidden" name="Tirsdag_1345" id="Tirsdag_1345"><input type="hidden" name="Tirsdag1430" id="Tirsdag1430" ></div></td>
    <td><div><input type="checkbox" name="Onsdag_seventh" id="Onsdag_seventh"><input type="hidden" name="Onsdag_1345" id="Onsdag_1345"><input type="hidden" name="Onsdag1430" id="Onsdag1430" ></div></td>
    <td><div><input type="checkbox" name="Torsdag_seventh" id="Torsdag_seventh"><input type="hidden" name="Torsdag_1345" id="Torsdag_1345"><input type="hidden" name="Torsdag1430" id="Torsdag1430" ></div></td>
    <td><div><input type="checkbox" name="Fredag_seventh" id="Fredag_seventh"><input type="hidden" name="Fredag_1345" id="Fredag_1345"><input type="hidden" name="Fredag1430" id="Fredag1430" ></div></td>
</tr>
<tr>
    <td>14.30 -15.15</td>
    <td><div><input type="checkbox" name="Mandag_eigthth" id="Mandag_eigthth"><input type="hidden" name="Mandag_1430" id="Mandag_1430"><input type="hidden" name="Mandag1515" id="Mandag1515" > </div></td>
    <td><div><input type="checkbox" name="Tirsdag_eigthth" id="Tirsdag_eigthth"><input type="hidden" name="Tirsdag_1430" id="Tirsdag_1430"><input type="hidden" name="Tirsdag1515" id="Tirsdag1515" ></div></td>
    <td><div><input type="checkbox" name="Onsdag_eigthth" id="Onsdag_eigthth"><input type="hidden" name="Onsdag_1430" id="Onsdag_1430"><input type="hidden" name="Onsdag1515" id="Onsdag1515" ></div></td>
    <td><div><input type="checkbox" name="Torsdag_eigthth" id="Torsdag_eigthth"><input type="hidden" name="Torsdag_1430" id="Torsdag_1430"><input type="hidden" name="Torsdag1515" id="Torsdag1515" ></div></td>
    <td><div><input type="checkbox" name="Fredag_eigthth" id="Fredag_eigthth"><input type="hidden" name="Fredag_1430" id="Fredag_1430"><input type="hidden" name="Fredag1515" id="Fredag1515" ></div></td>
</tr>
</table>
<br>
<label for="class" te> Classes: 
<select name="class" id="class">   
    
    <?php
    foreach($retClasses as $class){
        echo '<option value="' .$class->id .'">'. $class->name .'</option>';
    }
    ?>
</select> 
</label>




<br><br><br><br>
<input type="submit" value="ADD">
</form>



<script>

    function checkDimps(id) {
        var inputs = document. querySelectorAll('.check1');
    }

       function getDateOfISOWeek(w, y) {
            var simple = new Date(y, 0, 1 + (w - 1) * 7);
            var dow = simple.getDay();
            var ISOweekStart = simple;
            if (dow <= 4)
                ISOweekStart.setDate(simple.getDate() - simple.getDay() + 1);
            else
                ISOweekStart.setDate(simple.getDate() + 8 - simple.getDay());
            return ISOweekStart;
        }

        const getZeroBasedIsoWeekDay = date => (date.getDay() + 6) % 7
        const getIsoWeekDay = date => getZeroBasedIsoWeekDay(date) + 1

        function weekDateToDate(year, week, weekDay) {
            const zeroBasedWeek = week - 1
            const zeroBasedWeekDay = weekDay - 1
            let days = (zeroBasedWeek * 7) + zeroBasedWeekDay

            // Dates start at 2017-01-01 and not 2017-01-00
            days += 1

            const firstDayOfYear = new Date(year, 0, 1)
            const firstIsoWeekDay = getIsoWeekDay(firstDayOfYear)
            const zeroBasedFirstIsoWeekDay = getZeroBasedIsoWeekDay(firstDayOfYear)

            // If year begins with W52 or W53
            if (firstIsoWeekDay > 4) days += 8 - firstIsoWeekDay
            // Else begins with W01
            else days -= zeroBasedFirstIsoWeekDay

            return new Date(year, 0, days)
        }




        function dateFormat(inputDate, format) {
            //parse the input date
            const date = new Date(inputDate);

            //extract the parts of the date
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();    

            //replace the month
            format = format.replace("MM", month.toString().padStart(2,"0"));        

            //replace the year
            if (format.indexOf("yyyy") > -1) {
                format = format.replace("yyyy", year.toString());
            } else if (format.indexOf("yy") > -1) {
                format = format.replace("yy", year.toString().substr(2,2));
            }

            //replace the day
            format = format.replace("dd", day.toString().padStart(2,"0"));

            return format;
        }
        
        

        function printdate(){
            const elem = document.getElementById("camp-week");
            //var dat = getDateOfWeek(elem, '2022');
            var y = document.getElementById("year");
            var mandag = document.getElementById("mandag");
            var tirsdag = document.getElementById("tirsdag");
            var onsdag = document.getElementById("onsdag");
            var torsdag = document.getElementById("torsdag");
            var fredag = document.getElementById("fredag");
            var mandag1 = document.getElementById("Mandag_ser");
            var mandag1a = document.getElementById("Mandag855");

           
            //var w = document.getElementById("weeke");
            //var dat = getDateOfWeek(elem, '2022');
            //s.innerHTML = elem.value;
            //y.innerHTML = elem.value.substring( elem.value.length -2);
           //var dag = getDateOfISOWeek(elem.value.substring( elem.value.length -2), 2022)
           var dat = dateFormat(getDateOfISOWeek(elem.value.substring( elem.value.length -2), 2022), 'dd-MM');
           var tuesdat = dateFormat(weekDateToDate(2022, elem.value.substring( elem.value.length -2), 2) , 'dd-MM');
           var wendat = dateFormat(weekDateToDate(2022, elem.value.substring( elem.value.length -2), 3) , 'dd-MM');
           var thudat = dateFormat(weekDateToDate(2022, elem.value.substring( elem.value.length -2), 4) , 'dd-MM');
           var fridat = dateFormat(weekDateToDate(2022, elem.value.substring( elem.value.length -2), 5) , 'dd-MM');
           
           //var day = new Date(dag);
           //var tomorrow = day.add(1).day();
           mandag.innerHTML = dat;
           tirsdag.innerHTML = tuesdat;
           onsdag.innerHTML = wendat;
           torsdag.innerHTML = thudat;
           fredag.innerHTML = fridat;
           
          /* mandag1a.value = moon;
           mandag1a.innerHTML = dateFormat(weekDateToDate(2022, elem.value.substring( elem.value.length -2), 5) , 'YYYY-mm-dd') . ' 00:08:55';
           mandag1a.value = moon;*/

            var mandag1 = document.getElementById("Mandag_ser");
            var monday =  dateFormat(weekDateToDate(elem.value.substring( 0,4), elem.value.substring( elem.value.length -2), 1), 'yyyy-MM-dd');
            var tuesday =  dateFormat(weekDateToDate(elem.value.substring( 0,4), elem.value.substring( elem.value.length -2), 2), 'yyyy-MM-dd');
            var wendesday =   dateFormat(weekDateToDate(elem.value.substring( 0,4), elem.value.substring( elem.value.length -2), 3), 'yyyy-MM-dd');
            var thursday =  dateFormat(weekDateToDate(elem.value.substring( 0,4), elem.value.substring( elem.value.length -2), 4), 'yyyy-MM-dd');
            var friday =  dateFormat(weekDateToDate(elem.value.substring( 0,4), elem.value.substring( elem.value.length -2), 5), 'yyyy-MM-dd');
            
            
            //document.getElementById("Mandager").value = "der";

            let text810 = " 08:10:00";
            let text855 = " 08:55:00";
            let text940 = " 09:40:00";
            let tex10 = " 10:00:00";
            let tex1045 = " 10:45:00";
            let tex1130 = " 11:30:00";
            let tex12 = " 12:00:00";
            let tex1245 = " 12:45:00";
            let tex1330 = " 13:30:00";
            let tex1345 = " 13:45:00";
            let tex1430 = " 14:30:00";
            let tex1515 = " 15:15:00";

            var resultmandag = monday.concat(text810);
            var resulttirsdag = tuesday.concat(text810);
            var resultonsdag = wendesday.concat(text810); 
            var resulttorsdag = thursday.concat(text810);
            var resultfredag = friday.concat(text810);

            document.getElementById("Mandag_810").value = resultmandag;
            document.getElementById("Tirsdag_810").value = resulttirsdag;
            document.getElementById("Onsdag_810").value = resultonsdag;
            document.getElementById("Torsdag_810").value = resulttorsdag;
            document.getElementById("Fredag_810").value = resultfredag;

            resultmandag = monday.concat(text855);
            resulttirsdag = tuesday.concat(text855);
            resultonsdag = wendesday.concat(text855); 
            resulttorsdag = thursday.concat(text855);
            resultfredag = friday.concat(text855);

            document.getElementById("Mandag855").value = resultmandag;
            document.getElementById("Mandag_855").value = resultmandag;
            document.getElementById("Tirsdag855").value = resulttirsdag;
            document.getElementById("Tirsdag_855").value = resulttirsdag;
            document.getElementById("Onsdag855").value = resultonsdag;
            document.getElementById("Onsdag_855").value = resultonsdag;
            document.getElementById("Torsdag855").value = resulttorsdag;
            document.getElementById("Torsdag_855").value = resulttorsdag;
            document.getElementById("Fredag855").value = resultfredag;
            document.getElementById("Fredag_855").value = resultfredag;

            resultmandag = monday.concat(text940);
            resulttirsdag = tuesday.concat(text940);
            resultonsdag = wendesday.concat(text940); 
            resulttorsdag = thursday.concat(text940);
            resultfredag = friday.concat(text940);

            document.getElementById("Mandag940").value = resultmandag;
            document.getElementById("Tirsdag940").value = resulttirsdag;
            document.getElementById("Onsdag940").value = resultonsdag;
            document.getElementById("Torsdag940").value = resulttorsdag;
            document.getElementById("Fredag940").value = resultfredag;
     
            resultmandag = monday.concat(tex10);
            resulttirsdag = tuesday.concat(tex10);
            resultonsdag = wendesday.concat(tex10); 
            resulttorsdag = thursday.concat(tex10);
            resultfredag = friday.concat(tex10);
  
            document.getElementById("Mandag_10").value = resultmandag;
            document.getElementById("Tirsdag_10").value = resulttirsdag;
            document.getElementById("Onsdag_10").value = resultonsdag;
            document.getElementById("Torsdag_10").value = resulttorsdag;
            document.getElementById("Fredag_10").value = resultfredag;
      
            resultmandag = monday.concat(tex1045);
            resulttirsdag = tuesday.concat(tex1045);
            resultonsdag = wendesday.concat(tex1045); 
            resulttorsdag = thursday.concat(tex1045);
            resultfredag = friday.concat(tex1045);

            document.getElementById("Mandag1045").value = resultmandag;
            document.getElementById("Mandag_1045").value = resultmandag;
            document.getElementById("Tirsdag1045").value = resulttirsdag;
            document.getElementById("Tirsdag_1045").value = resulttirsdag;
            document.getElementById("Onsdag1045").value = resultonsdag;
            document.getElementById("Onsdag_1045").value = resultonsdag;
            document.getElementById("Torsdag1045").value = resulttorsdag;
            document.getElementById("Torsdag_1045").value = resulttorsdag;
            document.getElementById("Fredag1045").value = resultfredag;
            document.getElementById("Fredag_1045").value = resultfredag;
            
            resultmandag = monday.concat(tex1130);
            resulttirsdag = tuesday.concat(tex1130);
            resultonsdag = wendesday.concat(tex1130); 
            resulttorsdag = thursday.concat(tex1130);
            resultfredag = friday.concat(tex1130);

            document.getElementById("Mandag1130").value = resultmandag;
            document.getElementById("Tirsdag1130").value = resulttirsdag;
            document.getElementById("Onsdag1130").value = resultonsdag;
            document.getElementById("Torsdag1130").value = resulttorsdag;
            document.getElementById("Fredag1130").value = resultfredag;

            resultmandag = monday.concat(tex12);
            resulttirsdag = tuesday.concat(tex12);
            resultonsdag = wendesday.concat(tex12); 
            resulttorsdag = thursday.concat(tex12);
            resultfredag = friday.concat(tex12);

            document.getElementById("Mandag_12").value = resultmandag;
            document.getElementById("Tirsdag_12").value = resulttirsdag;
            document.getElementById("Onsdag_12").value = resultonsdag;
            document.getElementById("Torsdag_12").value = resulttorsdag;
            document.getElementById("Fredag_12").value = resultfredag;

            resultmandag = monday.concat(tex1245);
            resulttirsdag = tuesday.concat(tex1245);
            resultonsdag = wendesday.concat(tex1245); 
            resulttorsdag = thursday.concat(tex1245);
            resultfredag = friday.concat(tex1245);

            document.getElementById("Mandag1245").value = resultmandag;
            document.getElementById("Mandag_1245").value = resultmandag;
            document.getElementById("Tirsdag1245").value = resulttirsdag;
            document.getElementById("Tirsdag_1245").value = resulttirsdag;
            document.getElementById("Onsdag1245").value = resultonsdag;
            document.getElementById("Onsdag_1245").value = resultonsdag;
            document.getElementById("Torsdag1245").value = resulttorsdag;
            document.getElementById("Torsdag_1245").value = resulttorsdag;
            document.getElementById("Fredag1245").value = resultfredag;
            document.getElementById("Fredag_1245").value = resultfredag;
           
            resultmandag = monday.concat(tex1330);
            resulttirsdag = tuesday.concat(tex1330);
            resultonsdag = wendesday.concat(tex1330); 
            resulttorsdag = thursday.concat(tex1330);
            resultfredag = friday.concat(tex1330);

            document.getElementById("Mandag1330").value = resultmandag;
            document.getElementById("Tirsdag1330").value = resulttirsdag;
            document.getElementById("Onsdag1330").value = resultonsdag;
            document.getElementById("Torsdag1330").value = resulttorsdag;
            document.getElementById("Fredag1330").value = resultfredag;

            resultmandag = monday.concat(tex1345);
            resulttirsdag = tuesday.concat(tex1345);
            resultonsdag = wendesday.concat(tex1345); 
            resulttorsdag = thursday.concat(tex1345);
            resultfredag = friday.concat(tex1345);

            document.getElementById("Mandag_1345").value = resultmandag;
            document.getElementById("Tirsdag_1345").value = resulttirsdag;
            document.getElementById("Onsdag_1345").value = resultonsdag;
            document.getElementById("Torsdag_1345").value = resulttorsdag;
            document.getElementById("Fredag_1345").value = resultfredag;

            resultmandag = monday.concat(tex1430);
            resulttirsdag = tuesday.concat(tex1430);
            resultonsdag = wendesday.concat(tex1430); 
            resulttorsdag = thursday.concat(tex1430);
            resultfredag = friday.concat(tex1430);

            document.getElementById("Mandag1430").value = resultmandag;
            document.getElementById("Mandag_1430").value = resultmandag;
            document.getElementById("Tirsdag1430").value = resulttirsdag;
            document.getElementById("Tirsdag_1430").value = resulttirsdag;
            document.getElementById("Onsdag1430").value = resultonsdag;
            document.getElementById("Onsdag_1430").value = resultonsdag;
            document.getElementById("Torsdag1430").value = resulttorsdag;
            document.getElementById("Torsdag_1430").value = resulttorsdag;
            document.getElementById("Fredag1430").value = resultfredag;
            document.getElementById("Fredag_1430").value = resultfredag;

            resultmandag = monday.concat(tex1515);
            resulttirsdag = tuesday.concat(tex1515);
            resultonsdag = wendesday.concat(tex1515); 
            resulttorsdag = thursday.concat(tex1515);
            resultfredag = friday.concat(tex1515);

            document.getElementById("Mandag1515").value = resultmandag;
            document.getElementById("Tirsdag1515").value = resulttirsdag;
            document.getElementById("Onsdag1515").value = resultonsdag;
            document.getElementById("Torsdag1515").value = resulttorsdag;
            document.getElementById("Fredag1515").value = resultfredag;
        }

        
      </script>
</body>
</html>





   

   














    







