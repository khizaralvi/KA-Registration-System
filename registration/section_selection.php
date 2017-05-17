<?php
include '../header_footer.php';
include '../php_functions.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "S") {
    header("Location: ../index.php");
}

if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: ../logout_page.php");
}

htmlheader_root('w3-white');


$conn = mysqlConnect();
$sql = "SELECT dept_name FROM department WHERE dept_id =" . $_SESSION['dept_id'];
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $department = $row[0];
    }
}
else {
    echo "failed " . mysqli_error($conn);
}

$sql = "SELECT course.course_id, course.course_name, course.course_description, department.dept_name FROM course INNER JOIN department 
        ON course.dept_id = department.dept_id WHERE course.dept_id =" . $_SESSION['dept_id'];
$courses = "";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $courses.= "<div class='w3-container'>
          <h4 class='w3-opacity w3-grey w3-padding-small'><b>$row[1]</b></h4>
          <p class='w3-text-dark-grey'>$row[2]</p>
          <form action = 'view_sections.php' method = 'post'>
          <input type = 'hidden' name = 'course_name' value = '$row[1]'>
          <input type = 'hidden' name = 'course_id' value = $row[0]> 
          <input class='w3-btn w3-blue-grey w3-section' type = 'submit' name = 'submit' value = 'View Sections'>
          </form>
          <hr>
        </div>";
    }
}
else {
    echo "failed " . mysqli_error($conn);
}
mysqli_close($conn);

?>

    <h2 class = "w3-container w3-text-dark-grey"> <?php echo isset($department) ? $department : ''?> </h2>

    <div class='w3-container'>

          <form action = 'view_sections.php' method = 'post'>
          <input class='w3-btn w3-teal w3-section' type = 'submit' name = 'submit_all' value = 'View All Sections'>
          </form>
        </div>
        <br>

    <?php echo $courses ?>

    <script>
   /**  window.onload = function() {
          
    var elements = document.getElementById("course_category").selectedOptions;

    for(var i = 0; i < elements.length; i++){
      elements[i].selected = false;
     }
  
    }**/
    
    function validateCheckbox() {
    var errorMsg = document.getElementById('errorMsg');
       element = document.getElementById("departments");
        if (element.value == "") {
            element.style.border = "2px groove #CD2627";
            errorMsg.classList.add('w3-red');
            errorMsg.innerHTML = "Please select an option";
            event.preventDefault();
        }
    }
    </script>

   <?php 
   if (isset($_POST['submit']) && isset($_POST['departments'])) {
       $_SESSION['dept_id'] = $_POST['departments'];
       header('location: section_selection.php');
   }
   
   ?>

<?php
htmlfooter();
?>
