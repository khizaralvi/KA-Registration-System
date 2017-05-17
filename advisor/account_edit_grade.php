<?php
include '../header_footer.php';
include '../php_functions.php';

session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "F") {
    header("Location: ../index.php");
}

if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: ../logout_page.php");
}

if (isset($_GET['crn'])) {
$crn = $_GET['crn'];
$_SESSION['crn_grade'] = $_GET['crn'];

$conn = mysqlConnect();
$sql = "SELECT transcript.crn, course.course_name, transcript.semester_id, semester.sem_name, transcript.grade, course.credits,
              transcript.grade, course.course_category, CONCAT(user.first_name, ' ' , user.last_name)
              FROM transcript
              INNER JOIN section ON transcript.crn = section.crn
              INNER JOIN course ON section.course_id = course.course_id
              INNER JOIN semester ON transcript.semester_id = semester.semester_id
              INNER JOIN user ON transcript.student_id = user.user_id
              WHERE transcript.crn = $crn
              AND transcript.student_id = " . $_SESSION['account'];

if($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
                    $course_name = $row[1];
                    $grade = $row[4];
                    $semester = $row[3];
                    $name = $row[8];
}
$_SESSION['name'] = $name;

}
else {
    echo "failed " . mysqli_error($conn);
}

}

if (isset($_POST['update_grade'])) {

    $course_name = $_POST['name'];
    $grade = $_POST['grade'];

        $conn = mySqlConnect();
        $sqlUpdate = "UPDATE transcript SET grade = '$grade' WHERE crn = " . $_SESSION['crn_grade'] . " AND student_id = " . $_SESSION['account'];
        if (mysqli_query($conn, $sqlUpdate)) {
            $_SESSION['message'] = "<div class='w3-container w3-pale-green'>
                <h3>Success</h3>
                <p>Grade successfully updated for ".  $_SESSION['name']. "</p>
            </div>";
            header('location: account_edit_grade.php?crn='.$_SESSION['crn_grade']);
            exit();
        }
        else {
            echo "<div class='w3-container w3-red'>
                <p>Could not update user's grade.</p>
            </div>";
            echo mysqli_error($conn);
        }


}

htmlheader('w3-white');

?>

<br>
    <div class = "w3-container">
    <h4> Change Student Grade </h4>
    </div>

    <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>



    <form class="w3-container" action = "?" method = "post" id = "gradeForm" style="max-width:550px">
        <div class="w3-section">

            <label ><b>Student</b></label><br>
            <input class = "w3-input w3-border w3-light-grey w3-round signup w3-padding-medium" type = "text" id = "name" name = "name" <?php echo isset($name) ? 'value="'. $name .'"' : '' ?>  readonly> <br>

            <label ><b>Course Name</b></label><br>
            <input class = "w3-input w3-border w3-light-grey w3-round signup w3-padding-medium" type = "text" id = "course_name" name = "course_name" <?php echo isset($course_name) ? 'value="'. $course_name .'"' : '' ?>
            readonly>
            <br>

            <label><b>Semester</b></label><br>
            <input class = "w3-input w3-border w3-light-grey w3-round signup w3-padding-medium" type = "text" id = "semester" name = "semester" <?php echo isset($semester) ? 'value="'. $semester .'"' : '' ?>
            readonly>
            <br>

            <label><b>Grade</b></label><br>
            <input class = "w3-input w3-border w3-round signup w3-padding-medium" type = "text" id = "grade" name = "grade" <?php echo isset($grade) ? 'value="'. $grade .'"' : '' ?>>

            <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "update_grade" value = "Update Grade" onclick = "return confirm('Are you sure you want to update the user's grade?');">

        </div>
    </form>

<?php
htmlfooter();
unset($_SESSION['message']);
?>
