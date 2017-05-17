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

$sql2 = "SELECT CONCAT(period.start_time,'-',period.end_time) from period";
$time = "";
if ($result = mysqli_query($conn, $sql2)) {
    while ($row = mysqli_fetch_array($result)) {
        $time .= "<option value = '$row[0]'> $row[0] </option>";
    }
}
else {
    echo "failed " . mysqli_error($conn);
}

mysqli_close($conn);

?>


    <div id = "errorMsg" class = "w3-container">
      <p></p>
    </div>

    <h4 class="w3-container"> Advanced Section Search </h4>

        <form class="w3-container" id = "searchForm" action = "view_sections.php" method = "post" style="max-width:450px" onsubmit = "validateSearch(this.id);">
    <div class="w3-section">
    <input class = "w3-input w3-round signup w3-padding-medium" type = "number" placeholder="Search by Course Number" id = "course.course_category" name = "coursexcourse_category">
    <br>
    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Search by Course Title" id = "coursexcourse_name" name = "coursexcourse_name">
    <br>
    <input class = "w3-input w3-round signup w3-padding-medium" type = "number" min="3" max="4" placeholder="Search by Credits" id = "course.credits" name = "coursexcredits">
    <br>
    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Search by Faculty Last Name" id = "user.last_name" name = "userxlast_name">
        <br>
        <select id = "day.day" name="dayxday">
        <option value = "" hidden disabled selected value> -- Search By Days -- </option>
        <option value="Monday/Wednesday">Monday/Wednesday</option>
        <option value="Tuesday/Thursday">Tuesday/Thursday</option>
        </select>
        <br> <br>
        <select id = "department.dept_id" name="departmentxdept_id">
        <option value = "" hidden disabled selected value> -- Search By Department -- </option>
        <?php echo $departments ?>
        </select>
        <br> <br>
        <select id = "time" name="time">
        <option value = "" hidden disabled selected value> -- Search By Time -- </option>
        <?php echo $time ?>
        </select>
        <br>
        <button class="w3-btn w3-blue-grey w3-section" type="submit" name = "advanced_search" id = "advanced_search">Search</button>
    </div>
    </form>

   <!-- <form class="w3-container" action = "?" method = "post" id = "degreeForm2">
        <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "advanced" value = "Advanced Search">
    </form> -->


<?php
htmlfooter();
?>
