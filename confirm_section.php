<?php
    include("php_functions.php");
    include("header_footer.php");
    session_start();
    htmlheader();
    addSection($_POST['course'],$_POST['room'],$_POST['semester'],$_POST['timeslot']);
    htmlfooter();
?>
