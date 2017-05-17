<?php
    include("../php_functions.php");
    include("../header_footer.php");
    session_start();
    htmlheader_root();

    viewFacultyClasses(getFacultybyName($_GET["name"]));
    htmlfooter();
?>
