<?php
    include("../php_functions.php");
    include("../header_footer.php");
    session_start();
    htmlheader_root();
//    editSection($crn, $room, $semester,$timeslot);
    editSection($_POST["crn"], $_POST["room"], $_POST["semester"],$_POST["timeslot"]);
    htmlfooter();
?>
