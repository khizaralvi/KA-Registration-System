<?php
include '../header_footer.php';
include("../php_functions.php");
    session_start();
    //
    if (!isset($_SESSION['username'])) {
        header("Location: ../index.php");
    }
    else{
        if ($_SESSION['usertype'] != "A") {
            header("Location: ../index.php");
        }
    }
    if (isset($_POST['signout'])) {
      session_unset();
      session_destroy();
      header("Location: ../logout_page.php");
    }

    htmlheader_root('w3-white');
?>


        <div class="w3-panel w3-left w3-white" >
            <form class="w3-container" action = "dept_validate.php" method = "post">
                <h1>Add New Department</h1>
                <br>
                <label class="w3-label w3-white"><b>Department Name</b></label>
                <input class="w3-input" type="text" name="dept">
                <br>
                <label class="w3-label w3-white"><b>Department Chair</b></label>
                <select class="w3-select w3-border" name="chair">
                    <?php getAllFacultyNotMemb(); ?>
                </select>
                <br><br>
                <label class="w3-label w3-white"><b>School (required)</b></label>
                <select class="w3-select w3-border" name="school">
                    <?php getAllSchools(); ?>
                </select>
                <div>
                    <button class="w3-btn w3-green" type="submit">Create</button>
                </div>
            </form>
        </div>
</div>

<?php
htmlfooter();
?>