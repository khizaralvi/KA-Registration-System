<?php
include 'header_footer.php';
include 'php_functions.php';

session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
    header("Location: index.php");
}

if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
}

if (isset($_GET['crn'])) {
$crn = $_GET['crn'];
$_SESSION['crn_grade'] = $_GET['crn'];
}


$conn = mysqlConnect();
$sql = "SELECT DISTINCT(section.semester_id), semester.sem_name from enrollment
        INNER JOIN section ON enrollment.crn = section.crn
        INNER JOIN semester ON section.semester_id = semester.semester_id
        WHERE enrollment.student_id = " . $_SESSION['account'] .
        " ORDER BY section.semester_id DESC";

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
$conn = mysqlConnect();
$sql = "SELECT enrollment.student_id, enrollment.crn, enrollment.enroll_date, course.course_name, course.credits, CONCAT(building.building_name,' ',room.room_num),
            day.day, CONCAT(period.start_time,'-',period.end_time), 
            CONCAT(MONTH(semester.sem_start_date),'/',DAY(semester.sem_start_date), '-', MONTH(semester.sem_end_date),'/',DAY(semester.sem_end_date)),
            semester.sem_name, IFNULL(CONCAT(user.first_name, ' ' , user.last_name), 'N/A'), transcript.crn, teaching.faculty_id, semester.semester_id FROM enrollment
            INNER JOIN section ON enrollment.crn = section.crn
            INNER JOIN room ON section.room_id = room.room_id
            INNER JOIN building ON room.building_id = building.building_id
            INNER JOIN course ON section.course_id = course.course_id
            INNER JOIN timeslot ON section.timeslot_id = timeslot.timeslot_id
            INNER JOIN day ON timeslot.day_id = day.day_id
            INNER JOIN period ON timeslot.period_id = period.period_id
            INNER JOIN semester ON section.semester_id = semester.semester_id
            LEFT OUTER JOIN teaching ON section.crn = teaching.crn
            LEFT OUTER JOIN user ON teaching.faculty_id = user.user_id
            LEFT OUTER JOIN transcript on enrollment.crn = transcript.crn
            WHERE enrollment.student_id = " . $_SESSION['account'] .
            " AND semester.semester_id = (SELECT MAX(semester.semester_id) FROM semester INNER JOIN section ON section.semester_id = semester.semester_id INNER JOIN
              enrollment ON enrollment.crn = section.crn)";


if ($result = mysqli_query($conn, $sql)) {

    $grades .= "<form class = 'w3-container' action = '?' method = 'post' id = 'gradeForm'>
    <div class='w3-section'>
        <select id = 'semester' name='semester'>
        $semesters
        </select>
        </div>
    </form>
    <div class='w3-container w3-card-8 w3-white w3-twothird' id = 'grades'>
            <div class='w3-col l4 s4 w3-left'>
                <h5 class='w3-grey'><b>CRN</b></h5>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                <h5 class='w3-grey'><b>Title</b></h5>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                <h5 class='w3-grey'><b>Grade</b></h5>
            </div>";

    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {

            if ($row[1] == $row[11]) {
                $input = "<p class = 'w3-text-dark-grey'> <span class='w3-tag w3-teal w3-round'>Assigned</span> </p>";
            }
           // <button class='w3-btn w3-ripple w3-deep-orange w3-round w3-padding-small' type = 'submit' name = 'drop_course' value = $row[1]>Drop</button>
            else {
                $input = "<p class = 'w3-text-dark-grey'> <form action = '?' method = 'post'> 
                <input type = 'text' name = 'grade' style = 'max-width: 80px'> 
                <input class = 'w3-btn w3-blue-grey w3-round w3-padding-small' type = 'submit' name = 'assign_grade' value = 'Assign'> 
                <input type = 'hidden' name = 'faculty' value = $row[12]>
                <input type = 'hidden' name = 'crn' value = $row[1]>
                <input type = 'hidden' name = 'sem_id' value = $row[13]></form> </p>";
            }
        $grades .= "<div class='w3-row'>
            <div class='w3-col l4 s4 w3-left'>
                <p class='w3-text-dark-grey'>$row[1]</p>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                <p class='w3-text-dark-grey'>$row[3]</p>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                $input
                </p>
            </div>
         </div>";
   }
}
$grades .= "</div>";
}
else {
	echo "Failed " . mysqli_error($conn);
}

}
else {
     $grades = "<div class='w3-container w3-pale-red'>
                    <p> <b>The student is not enrolled in any semester</b> </p>
                    </div>";
}


if (isset($_POST['assign_grade'])) {
    $account = $_SESSION['account']; 
    $crn = $_POST['crn'];
    $grade = $_POST['grade'];
    $sem_id = $_POST['sem_id'];

    if (!empty($_POST['faculty'])) {
        $faculty_id = $_POST['faculty'];
    }
    else {
        $faculty_id = 'NULL';
    }


    echo $account, $crn, $grade, $sem_id, $faculty_id;

   
        $conn = mySqlConnect();
        $sql = "INSERT INTO transcript (student_id, crn, grade, semester_id, faculty_id) VALUES($account, $crn, '$grade', $sem_id, $faculty_id)";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "<div class='w3-container w3-pale-green'>
                <h3>Success</h3>
                <p>Grade assigned successfully</p>
                </div>";
            header('location: account_assign_grades.php');
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
    <h4> Assign Student Grade </h4>
    </div>


    <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '' ?>
    <?php echo isset($grades) ? $grades : '' ?>

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
        xmlhttp.open("GET","ajax_requests.php?account_grades_semester="+semester.value,true);
        xmlhttp.send();
    });
}
 </script>

<?php
htmlfooter();
unset($_SESSION['message']);
?>
