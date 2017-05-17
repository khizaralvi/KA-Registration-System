<?php
    include("../php_functions.php");
    include("../header_footer.php");
    session_start();
    htmlheader();
    teachingForm($_GET["timeslot"],$_GET["crn"]);
    htmlfooter();
?>
