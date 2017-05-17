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


$user_id = $_SESSION['userid'];
$conn = mysqlConnect();
$sqlGetCredits = "SELECT sum(course.credits)
                  FROM enrollment
                  INNER JOIN section ON enrollment.crn = section.crn
                  INNER JOIN course on section.course_id = course.course_id
                  WHERE section.semester_id =". $_SESSION['semester_id']
                  . " AND enrollment.student_id = $user_id";
if ($result = mysqli_query($conn, $sqlGetCredits)) {
    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
           $total_credits = "<div class = 'w3-container w3-card-4 w3-light-grey' style='max-width:210px'>
                            <h4> <strong> Total Credits: $row[0] </strong> </h4>
                            </div>
                            <br>";
        }
   }
}
else {
	echo "Failed " . mysqli_error($conn);
}

$sql = "SELECT enrollment.student_id, enrollment.crn, enrollment.enroll_date, course.course_name, course.credits, CONCAT(building.building_name,' ',room.room_num),
            day.day, CONCAT(period.start_time,'-',period.end_time),
            CONCAT(MONTH(semester.sem_start_date),'/',DAY(semester.sem_start_date), '-', MONTH(semester.sem_end_date),'/',DAY(semester.sem_end_date)),
            semester.sem_name, IFNULL(CONCAT(MAX(user.first_name), ' ' , MAX(user.last_name)), 'N/A') FROM enrollment
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
            WHERE enrollment.student_id = $user_id AND section.semester_id =". $_SESSION['semester_id'] .
            " GROUP BY section.crn";
$schedule= "";
if ($result = mysqli_query($conn, $sql)) {
    if (!mysqli_num_rows($result) == 0) {
    while ($row = mysqli_fetch_array($result)) {
        $schedule .= "<div class='w3-container'>
          <h4 w3-opacity class='w3-blue-grey w3-padding-small'><b>$row[3]</b></h4>
          <div class='w3-row'>
            <div class='w3-col l2 s6 w3-left'>
                <p class='w3-text-dark-grey'><b>Associated Term:</b></p>
                <p class='w3-text-dark-grey'><b>CRN:</b></p>
                <p class='w3-text-dark-grey'><b>Status:</b></p>
                <p class='w3-text-dark-grey'><b>Instructor:</b></p>
                <p class='w3-text-dark-grey'><b>Credits:</b></p>
                <p class='w3-text-dark-grey'><b>Days:</b></p>
                <p class='w3-text-dark-grey'><b>Time:</b></p>
                <p class='w3-text-dark-grey'><b>Building/Room:</b></p>
                <p class='w3-text-dark-grey'><b>Date Range:</b></p>
            </div>
            <div class='w3-col l4 s6 w3-left'>
                <p>$row[9]</p>
                <p>$row[1]</p>
                <p><span class='w3-tag w3-teal w3-round'>Registered</span></p>
                <p>$row[10]</p>
                <p>$row[4].000</p>
                <p>$row[6]</p>
                <p>$row[7]</p>
                <p>$row[5]</p>
                <p>$row[8]</p>
            </div>
         </div>
          <hr>
        </div>";

    }
  }
  else {
      $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                                        <p> <b>You are not currently registered for this term<b> </p>
                                        </div>";
  }
}
else {
    echo "failed " . mysqli_error($conn);
}
mysqli_close($conn);

?>


  <h2 class="w3-text-dark-grey w3-padding-16 w3-container">Schedule</h2>

  <?php echo isset($total_credits) ? $total_credits : ''?>

  <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>

  <?php echo isset($schedule) ? $schedule: ''?>


<?php
htmlfooter();

unset($_SESSION['message']);

?>
