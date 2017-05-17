<?php
include '../header_footer.php';
header('Refresh: 3;url=create_dept.php');

include '../php_functions.php';
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
//search query using username as condition to get the rows for account_type;
htmlheader_root('w3-white');
?>

    <?php

       $conn = mysqlConnect();


        if (isset($_POST['dept'])){
            $dept_name = $_POST['dept'];
        }

        if (isset($_POST['school'])){
            $school_id = $_POST['school'];
        }

        if (isset($_POST['chair'])){
            $cSql = ", chair_id";
            $chair_id = $_POST['chair'];

            $sql  = "INSERT INTO department (dept_name,chair_id, school_id) ";
            $sql .= "VALUES ('$dept_name',$chair_id,$school_id);";
            $sql .= "SET @dept_id = LAST_INSERT_ID();";
            $sql .= "INSERT INTO faculty_department VALUES ($chair_id,@dept_id)";

        } else {
            $sql = "INSERT INTO department (dept_name,school_id) VALUES ('$dept_name',$school_id);";
        }

        mysqli_autocommit($conn, FALSE);
        //mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
        if(mysqli_multi_query($conn, $sql)) {
            while (mysqli_more_results($conn) && mysqli_next_result($conn)) {
                mysqli_store_result($conn);
            }
               if (!mysqli_error($conn)) {
            mysqli_commit($conn);
            $message = "New record created successfully";
        } else {
            mysqli_rollback($conn);
            $message = "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Transaction rolled back</p>
                        </div>" . mysqli_error($conn);
        }

        } else {
            $message = "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Could not create user</p>
                        </div>" . mysqli_error($conn);
        }

        mysqli_close($conn);

        echo isset($message) ? $message : '';

        redirectPageCountDown()

    ?>

</div>

<?php
htmlfooter();
?>