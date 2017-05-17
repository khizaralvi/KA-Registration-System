<?php
include '../header_footer.php';
include '../php_functions.php';
session_start();
//
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
else{
    if ($_SESSION['usertype'] != "S") {
        header("Location: ../index.php");
    }
}
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: ../logout_page.php");
}

/*Getting Semesters for Student*/
$semesters = array();
$sql = "SELECT DISTINCT(semester.sem_name), transcript.semester_id
 FROM transcript
 INNER JOIN semester ON transcript.semester_id = semester.semester_id
 WHERE transcript.student_id = " . $_SESSION['userid'] .
 " ORDER BY transcript.semester_id DESC";

 $conn = mysqlConnect();

if ($result = mysqli_query($conn, $sql)) {
    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
           $semesters[] = $row[0];
        }
   }
}
else {
	echo "Failed " . mysqli_error($conn);
}

$transcript = "";
$cumulativeEarnedCredits = 0;
$cumulativeTotalCredits = 0;
$cumulativeTotalPoints = 0;
$cumulativeGpa = 0;

if (sizeof($semesters) > 0) {
foreach ($semesters as $semester) {
    $sql =  " SELECT transcript.crn, course.course_name, transcript.semester_id, semester.sem_name, transcript.grade, course.credits,
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
              END AS quality_point, course.course_category
              FROM transcript
              INNER JOIN section ON transcript.crn = section.crn
              INNER JOIN course ON section.course_id = course.course_id
              INNER JOIN semester ON transcript.semester_id = semester.semester_id
              WHERE semester.sem_name = '$semester'
              AND transcript.student_id = " . $_SESSION['userid'];

   if ($result = mysqli_query($conn, $sql)) {
    if (!mysqli_num_rows($result) == 0) {
       $transcript .= "<div class='w3-container w3-responsive'>
            <h4 w3-opacity class='w3-blue-grey w3-padding-small'><b>$semester</b></h4>
            <div class='w3-col l2 s3 w3-left'>
                <h5 class='w3-grey'><b>Course</b></h5>
            </div>
            <div class='w3-col l2 s3 w3-left'>
                <h5 class='w3-grey'><b>Title</b></h5>
            </div>
            <div class='w3-col l2 s3 w3-left'>
                <h5 class='w3-grey'><b>Grade</b></h5>
            </div>
            <div class='w3-col l2 s3 w3-left'>
                <h5 class='w3-grey'><b>Hours</b></h5>
            </div>
            <div class='w3-col l2 s3 w3-left'>
                <h5 class='w3-grey'><b>Points</b></h5>
            </div>";

          $termEarnedCredits = 0;
          $termTotalCredits = 0;
          $termTotalPoints = 0;

        while ($row = mysqli_fetch_array($result)) {
            if ($row[4] !== 'F') {
              $termEarnedCredits+= $row[5];
            }
            $termTotalCredits += $row[5];
            $termTotalPoints += $row[6];

            $transcript .= "<div class='w3-row'>
                <div class='w3-col l2 s3 w3-left'>
                    <p class='w3-text-dark-grey'>$row[7]</p>
                </div>
                <div class='w3-col l2 s3 w3-left'>
                    <p class='w3-text-dark-grey'>$row[1]</p>
                </div>
                <div class='w3-col l2 s3 w3-left'>
                    <p class='w3-text-dark-grey'>$row[4]</p>
                </div>
                <div class='w3-col l2 s3 w3-left'>
                    <p class='w3-text-dark-grey'>$row[5].00</p>
                </div>
                <div class='w3-col l2 s3 w3-left'>
                    <p class='w3-text-dark-grey'>$row[6]</p>
                </div>
            </div>";
        }
        /***Term Calculation ***/
        $termGpa = number_format($termTotalPoints/$termTotalCredits, 2, '.', '');
        /***Cumulative Calculation ***/
        $cumulativeEarnedCredits += $termEarnedCredits;
        $cumulativeTotalCredits += $termTotalCredits;
        $cumulativeTotalPoints += $termTotalPoints;
        $cumulativeGpa = number_format($cumulativeTotalPoints/$cumulativeTotalCredits, 2, '.', '');

        $transcript .= "<div class='w3-col l1 s4 w3-right w3-margin-top'>
                        <h5 class='w3-grey'><b>GPA</b></h5>
                      </div>
                      <div class='w3-col l1 s4 w3-right w3-margin-top'>
                        <h5 class='w3-grey'><b>Points</b></h5>
                      </div>
                      <div class='w3-col l1 s4 w3-right w3-margin-top'>
                        <h5 class='w3-grey'><b>Earned Hours</b></h5>
                      </div>
                      <div class='w3-col l1 s4 w3-right w3-margin-top'>
                        <h5 class='w3-grey'><b>Attempt Hours</b></h5>
                      </div>

                    <div class='w3-row'>
                        <div class='w3-col l1 s4 w3-right'>
                            <p class='w3-text-dark-grey'>$termGpa</p>
                        </div>
                        <div class='w3-col l1 s4 w3-right'>
                            <p class='w3-text-dark-grey'>$termTotalPoints</p>
                        </div>
                        <div class='w3-col l1 s4 w3-right'>
                            <p class='w3-text-dark-grey'>$termEarnedCredits</p>
                        </div>
                        <div class='w3-col l1 s4 w3-right'>
                            <p class='w3-text-dark-grey'>$termTotalCredits</p>
                        </div>
                        <div class='w3-col l2 s4 w3-right'>
                            <h5 class='w3-text-dark-grey'><b>Term:</b></h5>
                        </div>
                  </div>

                    <div class='w3-row'>
                      <div class='w3-col l1 s4 w3-right'>
                          <p class='w3-text-dark-grey'>$cumulativeGpa</p>
                      </div>
                      <div class='w3-col l1 s4 w3-right'>
                          <p class='w3-text-dark-grey'>$cumulativeTotalPoints</p>
                      </div>
                      <div class='w3-col l1 s4 w3-right'>
                          <p class='w3-text-dark-grey'>$cumulativeEarnedCredits</p>
                      </div>
                      <div class='w3-col l1 s4 w3-right'>
                          <p class='w3-text-dark-grey'>$cumulativeTotalCredits</p>
                      </div>
                      <div class='w3-col l2 s4 w3-right'>
                          <h5 class='w3-text-dark-grey'><b>Cumulative:</b></h5>
                      </div>
                </div>
              </div>";
   }
}
  else {
    echo "Failed " . mysqli_error($conn);
  }

}
//mysqli_close($conn);
}
else {
    $transcript = "";
}

/**** For future enrolled semesters ****/
 $sql = "SELECT DISTINCT(semester.sem_name), section.semester_id from enrollment
 INNER JOIN section ON enrollment.crn = section.crn
 INNER JOIN semester ON section.semester_id = semester.semester_id
 where section.semester_id  > (SELECT max(transcript.semester_id) FROM transcript)
 AND enrollment.student_id = " . $_SESSION['userid'] .
 " ORDER BY section.semester_id";

     if ($result = mysqli_query($conn, $sql)) {
         $enrolledSemesters = array();
    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
            $enrolledSemesters[] = $row[0]; 
        }
   }
}
if (sizeof($enrolledSemesters) > 0) {
    $sql = "SELECT enrollment.crn, section.semester_id, semester.sem_name, course.course_category, course.course_name, course.credits from enrollment
            INNER JOIN section ON enrollment.crn = section.crn
            INNER JOIN course ON section.course_id = course.course_id
            INNER JOIN semester ON section.semester_id = semester.semester_id
            WHERE section.semester_id  > (SELECT max(transcript.semester_id) FROM transcript)
            AND enrollment.student_id = " . $_SESSION['userid'];

    foreach($enrolledSemesters as $semester) {
            if ($result = mysqli_query($conn, $sql)) {
            $transcript .= "<div class='w3-container w3-responsive'>
                    <h4 w3-opacity class='w3-blue-grey w3-padding-small'><b>$semester</b></h4>
                    <div class='w3-col l2 s3 w3-left'>
                        <h5 class='w3-grey'><b>Course</b></h5>
                    </div>
                    <div class='w3-col l2 s3 w3-left'>
                        <h5 class='w3-grey'><b>Title</b></h5>
                    </div>
                    <div class='w3-col l2 s3 w3-left'>
                        <h5 class='w3-grey'><b>Hours</b></h5>
                    </div>";
                while ($row = mysqli_fetch_array($result)) {
                    $transcript .= "<div class='w3-row'>
                        <div class='w3-col l2 s3 w3-left'>
                            <p class='w3-text-dark-grey'>$row[3]</p>
                        </div>
                        <div class='w3-col l2 s3 w3-left'>
                            <p class='w3-text-dark-grey'>$row[4]</p>
                        </div>
                        <div class='w3-col l2 s3 w3-left'>
                            <p class='w3-text-dark-grey'>$row[5]</p>
                        </div>
                    </div>";  
             }
        }
        else {
            echo "Failed " . mysqli_error($conn);
        }
    }
}

if ($transcript == "") {
    $transcript = "<div class='w3-container w3-pale-red'>
                    <p> <b>There is no transcript under your record</b> </p>
                    </div>";
}


htmlheader_root('w3-white');
?>

<br>

<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>

<!--<div class = 'transcript' style = 'overflow-x:scroll;'></div>-->
<?php echo isset($transcript) ? $transcript : '' ?>


<?php
htmlfooter();

unset($_SESSION['message']);
?>


