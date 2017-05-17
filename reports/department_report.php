<?php
    include("../php_functions.php");
    include("../header_footer.php");
    session_start();
    htmlheader_root();
//    editSection($crn, $room, $semester,$timeslot);
    departmentReport();
    htmlfooter();
?>
