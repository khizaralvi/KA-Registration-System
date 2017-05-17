<?php
session_start();
    include("php_functions.php");
    include("header_footer.php");

 if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
    header("Location: index.php");
}
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
}

    htmlheader();
//make form goes here
    //editCourse($course,$name, $catagory ,$desc,$cred,$department)
    editCourse($_POST["course"],$_POST["name"],$_POST["category"],$_POST["desc"],$_POST["credits"],$_POST["dept"]);
    htmlfooter();
?>
