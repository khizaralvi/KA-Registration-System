<?php
include '../header_footer.php';
include '../php_functions.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
    header("Location: ../index.php");
}

if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: ../logout_page.php");
}


if (isset($_SESSION['major_id'])) {
    $major_id = $_SESSION['major_id'];
    //echo $major_id;
}


$conn = mysqlConnect();

$sql = "SELECT major_courses.major_id, major_courses.course_id, course.course_name, course.credits, course.course_description, department.dept_name FROM major_courses
INNER JOIN major ON major_courses.major_id = major.major_id INNER JOIN course ON major_courses.course_id = course.course_id 
INNER JOIN department ON course.dept_id = department.dept_id 
WHERE major_courses.major_id = $major_id";
$courses= "";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $courses .= "<div class='w3-container'>
          <h4 class='w3-opacity w3-grey w3-padding-small'><b>$row[2]</b></h4>
          <p class='w3-text-dark-grey'>$row[3] credit hours </p>
          <p class='w3-text-dark-grey'>$row[5] Department </p>
          <p class='w3-text-dark-grey'>$row[4]</p>
          <form action = '?' method = 'post'>
          <input type = 'hidden' name = 'course_name' value = '$row[2]'>
          <input type = 'hidden' name = 'course_id' value = $row[1]>
          <input class='w3-btn w3-blue-grey w3-section' type = 'submit' name = 'delete' value = 'Remove from Major'>
          </form>
          <hr>
        </div>";
    }
}
else {
    echo "failed " . mysqli_error($conn);
}
mysqli_close($conn);


if (isset($_POST['delete']) && isset($_POST['course_name']) && isset($_POST['course_id'])) {
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];

    $sql = "DELETE FROM major_courses WHERE major_id = $major_id AND course_id = $course_id";
    $conn = mysqlConnect();
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] =  "<div class='w3-container w3-pale-green'>
                <h3>Success</h3>
                <p>$course_name removed from major successfully.</p>
            </div>";
        header('location: view_courses.php');
        exit();
    }
    else {
        echo "failed " . mysqli_error($conn);
    }
}

htmlheader_root('w3-white');

?>


    <div id = "errorMsg" class = "w3-container">
      <p></p>
    </div>
        
        <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '' ?>
        <h2 class = "w3-container w3-text-dark-grey"> <?php echo isset($_SESSION['major_name']) ? $_SESSION['major_name'] : ''?> </h2>
        <h3 class="w3-text-dark-grey w3-padding-16 w3-container">Courses</h3>
        <?php echo $courses ?>
    

	</div>

<?php
htmlfooter();
unset($_SESSION['message']);
?>