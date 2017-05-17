<?php
    include("../php_functions.php");
    include("../header_footer.php");
    session_start();
    htmlheader();
    addRoom($_POST["building"],$_POST["room_number"],$_POST["room_type"],$_POST["cap"]);
    htmlfooter();
?>
