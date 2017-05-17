<?php
include '../header_footer.php';
include '../php_functions.php';
session_start();
//
if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
    header("Location: ../index.php");
}
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: ../logout_page.php");
}

htmlheader_root()();

//makeEditSectionForm($room,$semester,$timeslot);
makeEditSectionForm($_GET["room"],$_GET["semester"],$_GET["time"]);

htmlfooter();
?>
