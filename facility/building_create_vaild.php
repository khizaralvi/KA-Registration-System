<?php
    include("../php_functions.php");
    include("../header_footer.php");
    session_start();
    htmlheader();
    //make form goes here
    //confirmAction("testing", "../admin_home.php");
    addBuilding($_POST["building_name"]);
    htmlfooter();
?>
