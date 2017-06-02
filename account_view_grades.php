<?php
include 'header_footer.php';
include 'php_functions.php';
session_start();
//

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
    header("Location: index.php");
}

if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
}

htmlheader('w3-white');

$conn = mysqlConnect();
$sql = "SELECT DISTINCT(transcript.semester_id), semester.sem_name from transcript
        INNER JOIN semester ON transcript.semester_id = semester.semester_id
        WHERE transcript.student_id = " . $_SESSION['account'] .
        " ORDER BY transcript.semester_id DESC";
$semesters = "";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $semesters .= "<option value = $row[0]> $row[1] </option>";
    }
}
else {
    echo "failed " . mysqli_error($conn);
}

$grades = '';
if ($semesters !== "" ) {
$sql = " SELECT transcript.crn, course.course_name, transcript.semester_id, semester.sem_name, transcript.grade, course.credits,
              transcript.grade, course.course_category,
               CASE transcript.grade
              WHEN 'A'  THEN 4.00 * course.credits
              WHEN 'A-' THEN 3.70 * course.credits
              WHEN 'B+' THEN 3.30 * course.credits
              WHEN 'B'  THEN 3.00 * course.credits
              WHEN 'B-' THEN 2.70 * course.credits
              WHEN 'C+' THEN 2.30 * course.credits
              WHEN 'C'  THEN 2.00 * course.credits
              WHEN 'C-' THEN 1.70 * course.credits
              WHEN 'D+' THEN 1.30 * course.credits
              WHEN 'D'  THEN 1.00 * course.credits
              WHEN 'D-' THEN 0.70 * course.credits
              WHEN 'F'  THEN 0.00 * course.credits
              END AS quality_point
              FROM transcript
              INNER JOIN section ON transcript.crn = section.crn
              INNER JOIN course ON section.course_id = course.course_id
              INNER JOIN semester ON transcript.semester_id = semester.semester_id
              WHERE semester.semester_id = (SELECT MAX(transcript.semester_id) FROM transcript WHERE transcript.student_id =" . $_SESSION['account'] . ")
              AND transcript.student_id = " . $_SESSION['account'];

$termEarnedCredits = 0;
$termTotalCredits = 0;
$termTotalPoints = 0;
$termGpa = 0;

if ($result = mysqli_query($conn, $sql)) {

    $termEarnedCredits = 0;
    $termTotalCredits = 0;
    $termTotalPoints = 0;
    if (!mysqli_num_rows($result) == 0) {
     while ($row = mysqli_fetch_array($result)) {
            if ($row[4] !== 'F') {
            $termEarnedCredits+= $row[5];
            }
            $termTotalCredits += $row[5];
            $termTotalPoints += $row[8];

            }
        /***Term Calculation ***/
        $termGpa = number_format($termTotalPoints/$termTotalCredits, 2, '.', '');
 }
}


if ($result = mysqli_query($conn, $sql)) {

    $grades .= "<form class = 'w3-container' action = '?' method = 'post' id = 'gradeForm'>
    <div class='w3-section'>
        <select id = 'semester' name='semester'>
        $semesters
        </select>
        </div>
    </form>
    <div class='w3-container w3-card-8 w3-white w3-twothird' id = 'grades'>
          <div class='w3-section w3-card-8 w3-teal' style='max-width:150px'>
                <p>Term GPA: $termGpa</p>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                <h5 class='w3-grey'><b>Course</b></h5>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                <h5 class='w3-grey'><b>Title</b></h5>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                <h5 class='w3-grey'><b>Grade</b></h5>
            </div>";

    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
        $grades .= "<div class='w3-row'>
            <div class='w3-col l4 s4 w3-left'>
                <p class='w3-text-dark-grey'>$row[7]</p>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                <p class='w3-text-dark-grey'>$row[1]</p>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                <p class='w3-text-dark-grey'><span class='w3-tag w3-2017-grenadine w3-round'>$row[4]</span> 
                <a href = 'account_edit_grade.php?crn=$row[0]'> <i class='fa fa-pencil-square-o fa-2x w3-right'></i></a> 
                </p>
            </div>
         </div>";
   }
}
//$grades .= "</div>";
}
else {
	echo "Failed " . mysqli_error($conn);
}
mysqli_close($conn);
}
else {
    $grades = "<div class='w3-container w3-pale-red'>
                    <p> <b>The student doesn't have grades for any semester yet</b> </p>
                    </div>";
}
?>

<br> 

<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>

<?php echo isset($grades) ? $grades : '' ?>

</div>

<script>
    window.onload = function() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    var grades = document.getElementById('grades');
    var semester = document.getElementById('semester');

    semester.addEventListener('change', function() {
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById('grades').innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","ajax_requests.php?account_semester="+semester.value,true);
        xmlhttp.send();
    });
}
 </script>

<?php
htmlfooter();

unset($_SESSION['message']);

?>


