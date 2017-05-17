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
           $total_credits = $row[0];
        }
   }
}
else {
	echo "Failed " . mysqli_error($conn);
}

$sql = "SELECT enrollment.student_id, enrollment.crn, enrollment.enroll_date, SUBSTRING(course.course_category, 4), SUBSTRING(course.course_category, 1, 2),
            course.course_name, course.credits, CONCAT(building.building_name,' ',room.room_num),
            day.day, CONCAT(period.start_time,'-',period.end_time),
            CONCAT(MONTH(semester.sem_start_date),'/',DAY(semester.sem_start_date), '-', MONTH(semester.sem_end_date),'/',DAY(semester.sem_end_date)),
            semester.sem_name, IFNULL(CONCAT(user.first_name, ' ' , user.last_name), 'N/A') FROM enrollment
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
            WHERE enrollment.student_id = $user_id AND section.semester_id =". $_SESSION['semester_id'];
$schedule= "";
if ($result = mysqli_query($conn, $sql)) {
    		if (!mysqli_num_rows($result) == 0) {
				$resultTable = "<div class='w3-container'>
                               <table class='w3-table w3-bordered'>
                               <form action = '?' method = 'post'>
                               <thead>
                                <tr class='w3-grey'>
                                    <th> Select </th>
                                    <th> CRN </th>
                                    <th> Subject </th>
                                    <th> Course </th>
                                    <th> Title </th>
                                    <th> Credits </th>
                                    <th> Semester </th>
                                </tr>
                                </thead>
                                ";
				while ($row = mysqli_fetch_array($result)) {


					$resultTable.= "<tr>
					            <td><button class='w3-btn w3-ripple w3-deep-orange w3-round w3-padding-small' type = 'submit' name = 'drop_course' value = $row[1]>Drop</button></td>
                                <td>$row[1]</td>
                                <td>$row[4]</td>
                                <td>$row[3]</td>
                                <td>$row[5]</td>
                                <td>$row[6]</td>
                                <td>$row[11]</td>
                                </tr>";
				}
				$resultTable.= "</table>
                                </form></div>";
				//echo ($resultTable);

		}
        else {
            $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                                        <p> <b>No currently registered classes<b> </p>
                                        </div>";
        }
}
else {
    echo "failed " . mysqli_error($conn);
}

if (isset($_POST['drop_course'])) {
	$crn = $_POST['drop_course'];
	$conn = mysqlConnect();
	$sql = "DELETE FROM enrollment WHERE student_id = $user_id AND crn = $crn";
	if ($result = mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "<div class='w3-container w3-pale-green'>
                				<h3>Success</h3>
               					<p>CRN $crn dropped</p>
            					</div> <br>";
		header('location: add_drop.php');
		exit();
	}
	else {
		echo "failed " . mysqli_error($conn);
	}
}
mysqli_close($conn);

htmlheader_root('w3-white')
?>


        <h2 class="w3-text-dark-grey w3-padding-16 w3-container">Drop Classes</h2>

    <div class='w3-container w3-card-4 w3-light-grey' style='max-width:240px'>
          <p> <strong> Total Credits: <?php echo isset($total_credits) ? $total_credits: '0'?></strong> </p>
          <p> <strong> Maximum Credits: 16 </strong> </p>
        </div>
        <br>

  <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>

  <?php echo isset($resultTable) ? $resultTable: ''?>


<?php
htmlfooter();
unset($_SESSION['message']);
?>
