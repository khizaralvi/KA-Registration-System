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
$sql = "Select dept_id, dept_name from department";
$departments = "";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $departments .= "<option value = '$row[0]'> $row[1] </option>";
    }
}

else {
    echo "failed " . mysqli_error($conn);
}

mysqli_close($conn);
  if (isset($_POST['submit']) && isset($_POST['departments'])) {
       $_SESSION['dept_id'] = $_POST['departments'];
       header('location: section_selection.php');
   }  
   if (isset($_POST['advanced'])) {
    header("location: advanced_search.php");
}

htmlheader_root('w3-white');

?>

    <div id = "errorMsg" class = "w3-container">
      <p></p>
    </div>

        <form class="w3-container" action = "?" method = "post" id = "degreeForm">
    <div class="w3-section">
    <label style="font-size:130%;"> Search Courses By Department </label> <br>
        <select id = "departments" name="departments">
        <option value = "" hidden disabled selected value> -- select an option -- </option>
        <?php echo $departments ?>
        </select> <br>
        <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" id = "submit" value = "Submit" onclick = "validateCheckbox();">
        <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "advanced" value = "Advanced Search">
    </div>
    </form>


<script>
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
htmlfooter();
?>
