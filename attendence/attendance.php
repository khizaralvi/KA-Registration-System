<?php
    include("../php_functions.php");
    include("../header_footer.php");
    session_start();
    htmlheader();
    if(isset($_POST)){
//        foreach($_POST["student"] as $inputName => $inputValue){
//            updateAttendance($inputValue,$_POST["crn"],$_POST["date"],$_POST["attendance"]);
//        }
        for($i = 0; $i < count($_POST["student"]);++$i){
            updateAttendance($_POST["student"][$i],$_POST["crn"],$_POST["date"],$_POST["attendance"][$i]);
        }
    }

//    updateAttendance($_POST["student"],$_POST["crn"],$_POST["date"],$_POST["attendance"]);
    htmlfooter();
?>
