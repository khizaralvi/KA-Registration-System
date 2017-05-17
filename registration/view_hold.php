<?php
include '../header_footer.php';
include '../php_functions.php';
session_start();
//
if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "S") {
    header("Location: ../index.php");
}
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: ../logout_page.php");
}

htmlheader_root('w3-white');

    $holds = array();
    $sqlCheckHolds = "SELECT student_hold.hold_id, hold.hold_name, student_hold.student_id
                      FROM student_hold
                      INNER JOIN hold ON student_hold.hold_id = hold.hold_id WHERE student_id = " . $_SESSION['userid'];

    $conn = mysqlConnect();
    if ($result = mysqli_query($conn, $sqlCheckHolds)) {
        if (!mysqli_num_rows($result) == 0) {
            while ($row = mysqli_fetch_array($result)) {
                $holds [] = $row[1];
            }

          $holds = implode(', ', $holds);
          $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                    <h4>Unable to Register</h4>
                    <p> <i class='fa fa-exclamation-triangle' aria-hidden='true'></i> <b>You have the following hold/holds against your account:</b> $holds </p>
                    </div>";
          header("location: view_sections.php");
          exit();
        }
        else {
            $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                    <p> <b>You have no holds against your account</b> </p>
                    </div>";
        }
    }

    else {
    echo "failed " . mysqli_error($conn);
}
mysqli_close($conn);

?>

<br>

<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>

</div>

<?php
htmlfooter();

unset($_SESSION['message']);
?>


