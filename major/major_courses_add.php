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

if (isset($_SESSION['dept_id'])) {
    $dept_id = $_SESSION['dept_id'];
}

if (isset($_SESSION['major_id'])) {
    $major_id = $_SESSION['major_id'];
    //echo $major_id;
}


$conn = mysqlConnect();
$sql = "SELECT course.course_id, course.course_name, course.course_category, course.course_description, course.credits, department.dept_name, major_courses.major_id FROM course 
INNER JOIN department ON course.dept_id = department.dept_id 
LEFT OUTER JOIN major_courses ON course.course_id = major_courses.course_id AND major_courses.major_id = $major_id
WHERE course.dept_id = $dept_id";
$courses= "";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
           if ($row[6] == $major_id) {
             $input = "";
             $status = "<span class='w3-tag w3-teal w3-round'>Added</span>";
          }
          else {
            $input = "<input class='w3-btn w3-blue-grey w3-section' type = 'submit' name = 'submit' value = 'Add to Major'>";
            $status = "";
        }
        $courses .= "<div class='w3-container'>
          <h4 class='w3-opacity w3-grey w3-padding-small'><b>$row[1]</b></h4>
          $status
          <p class='w3-text-dark-grey'>$row[4] credit hours </p>
          <p class='w3-text-dark-grey'>$row[5] Department </p>
          <p class='w3-text-dark-grey'>$row[3]</p>
          <form action = '?' method = 'post'>
          <input type = 'hidden' name = 'course_name' value = '$row[1]'>
          <input type = 'hidden' name = 'course_id' value = $row[0]> 
          $input
          </form>
          <hr>
        </div>";
    }
}
else {
    echo "failed " . mysqli_error($conn);
}



mysqli_close($conn);


if (isset($_POST['submit']) && isset($_POST['course_id']) && isset($_POST['course_name'])) {
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];

    $conn = mysqlConnect();
    $sql = "INSERT INTO major_courses (major_id, course_id) VALUES ($major_id, $course_id)";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] =  "<div class='w3-container w3-pale-green'>
                <h3>Success</h3>
                <p>$course_name assigned to major successfully.</p>
            </div>";
        header('location: major_courses_add.php');
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




      <!--  <div class="w3-container">
          <h5 class="w3-opacity"><b>Systems Design</b></h5>
          <p class="w3-text-dark-grey">4 credit hours </p>
          <p class="w3-text-dark-grey">Mathematics and Computer Sciences Department </p>
          <p class="w3-text-dark-grey">Students will learn and implement all system requirements to produce a completely finished product.</p>
          <form action = "?" method = "post">
          <input type = "hidden" name = "course_id" value = ""> 
          <input class="w3-btn w3-blue-grey w3-section" type = "submit" value = "Add to Major"> 
          </form>
          <hr>
        </div> -->
    

	</div>

<?php
htmlfooter();
unset($_SESSION['message']);
?>
