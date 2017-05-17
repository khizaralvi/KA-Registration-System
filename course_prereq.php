<?php
include 'header_footer.php';
session_start();
//
include('php_functions.php');
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
  header("Location: index.php");
}
htmlheader();

//search query using username as condition to get the rows for account_type;
?>


        <div class="w3-container w3-center">
            <form action="pre_validate.php" method="post">
                <label>Prerequisite Course</label>
                <select name="pre_req_id" required>
                <?php getAllCourses(); ?>
                </select>
                <?php echo "<input name='master_id' type='hidden' value='". $_GET['id']. "'>"; ?>
                <button class="w3-button" type="submit">Add</button>
            </form>
        </div>
</div>

<?php
htmlfooter();
?>
