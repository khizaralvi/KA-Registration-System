<?php
include 'header_footer.php';
session_start();
//
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
else{
    if ($_SESSION['usertype'] != "A") {
        header("Location: index.php");
    }
}
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
}
htmlheader('w3-white');
//search query using username as condition to get the rows for account_type;
?>
    <div>
        <?php include("php_functions.php"); makeEditCourseForm($_GET['id']);?>
    </div>

</div>

<?php
htmlfooter();
?>


