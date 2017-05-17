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


$conn = mysqlConnect();
$sql = "Select semester_id, sem_name from semester";
$semesters = "";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $semesters .= "<option value = '$row[0]'> $row[1] </option>";
    }
}
else {
    echo "failed " . mysqli_error($conn);
}
mysqli_close($conn);

 if (isset($_POST['submit']) && isset($_POST['semesters'])) {
       $_SESSION['semester_id'] = $_POST['semesters'];
       header('location: lookup_course_category.php');
   }

htmlheader_root('w3-white')
?>

    <div id = "errorMsg" class = "w3-container">
      <p></p>
    </div>

        <form class="w3-container" action = "?" method = "post" id = "degreeForm" onsubmit = "validateCheckbox();">
    <div class="w3-section">
    <label style="font-size:130%;"> Search By Term </label> <br>
        <select id = "semesters" name="semesters">
        <option value = "" hidden disabled selected value> -- select an option -- </option>
        <?php echo $semesters ?>
        </select> <br>
        <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Submit">
    </div>
    </form>


 <script>
    function validateCheckbox() {
    var errorMsg = document.getElementById('errorMsg');
       element = document.getElementById("semesters");
        if (element.value == "") {
            element.style.border = "2px groove #CD2627";
            errorMsg.classList.add('w3-red');
            errorMsg.innerHTML = "Please select an option";
            event.preventDefault();
        }
    }
    </script>

<?php 
  htmlfooter();
?>
