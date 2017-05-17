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
        <h1 style="text-align:center">Add New Course</h1>
        <div class="w3-panel w3-center" >
            <form class="w3-container" action = "course_validate.php" method = "post">
            <label class="w3-label w3-white"><b>Department</b></label>
<!--            <input class="w3-input" type="number" name="dept">-->
            <select class="w3-select w3-border" name="dept" required>
                <?php include("php_functions.php"); getAllDepartments(); ?>
            </select><br><br>
            <label class="w3-label w3-white"><b>Course Name</b></label>
            <input class="w3-input" type="text" name="course" required>
            <br>
            <label class="w3-label w3-white"><b>Course Code</b></label>
            <input class="w3-input" type="text" name="category">
            <br>
            <label class="w3-label w3-white"><b>Course Description</b></label>
            <textarea class="w3-input" type="text" name="desc"></textarea>
            <br>
            <label class="w3-label w3-white"><b>Credit Amount</b></label>
            <input class="w3-input" type="number" max="4" min="2" name="credits" required>
            <div>
                <button class="w3-btn w3-green" type="submit" onclick="validateEmptyFields();">Create</button>
            </div>
            </form>
        </div>
    </div>

<?php
htmlfooter();
?>
