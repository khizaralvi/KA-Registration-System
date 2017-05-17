<?php
include '../header_footer.php';
include '../php_functions.php';
session_start();
ob_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "S") {
    header("Location: ../index.php");
}

if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: ../logout_page.php");
}

htmlheader_root('w3-white');

$userid = $_SESSION['userid'];
$conn = mysqlConnect();

if(isset($_SESSION['dept_id'])) {
$sql = "SELECT dept_name FROM department WHERE dept_id =" . $_SESSION['dept_id'];
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $department = $row[0];

    }
}
else {
    echo "failed " . mysqli_error($conn);
  }
}

if (isset($_POST['submit_all'])) {
    $_SESSION['sql'] = "SELECT section.crn, course.course_name, course.credits, CONCAT(building.building_name,' ',room.room_num),
            day.day, CONCAT(period.start_time,'-',period.end_time), 
            CONCAT(MONTH(semester.sem_start_date),'/',DAY(semester.sem_start_date), '-', MONTH(semester.sem_end_date),'/',DAY(semester.sem_end_date)),
            semester.sem_name, department.dept_name, section.course_id, timeslot.timeslot_id, enrollment.crn, IFNULL(CONCAT(MAX(user.first_name), ' ' , MAX(user.last_name)), 'N/A'),
            SUBSTRING(course.course_category, 4), SUBSTRING(course.course_category, 1, 2), room.capacity, COUNT(e2.crn) as enrolled, (room.capacity - COUNT(e2.crn)) as remaining
            FROM section
            INNER JOIN course ON section.course_id = course.course_id
            INNER JOIN department ON course.dept_id = department.dept_id
            INNER JOIN room ON section.room_id = room.room_id
            INNER JOIN building ON room.building_id = building.building_id
            INNER JOIN timeslot ON section.timeslot_id = timeslot.timeslot_id
            INNER JOIN day ON timeslot.day_id = day.day_id
            INNER JOIN period ON timeslot.period_id = period.period_id
            INNER JOIN semester ON section.semester_id = semester.semester_id
            LEFT OUTER JOIN teaching ON section.crn = teaching.crn
            LEFT OUTER JOIN user ON teaching.faculty_id = user.user_id
            LEFT OUTER JOIN enrollment ON section.crn = enrollment.crn AND enrollment.student_id = $userid
            LEFT OUTER JOIN enrollment e2 ON section.crn = e2.crn
            WHERE department.dept_id =" . $_SESSION['dept_id'] . " AND section.semester_id =" . $_SESSION['semester_id'] .
            " GROUP BY section.crn";
}

else if (isset($_POST['submit'])) {
    $_SESSION['sql'] = "SELECT section.crn, course.course_name, course.credits, CONCAT(building.building_name,' ',room.room_num),
            day.day, CONCAT(period.start_time,'-',period.end_time), 
            CONCAT(MONTH(semester.sem_start_date),'/',DAY(semester.sem_start_date), '-', MONTH(semester.sem_end_date),'/',DAY(semester.sem_end_date)),
            semester.sem_name, department.dept_name, section.course_id, timeslot.timeslot_id, enrollment.crn, IFNULL(CONCAT(MAX(user.first_name), ' ' , MAX(user.last_name)), 'N/A'),
            SUBSTRING(course.course_category, 4), SUBSTRING(course.course_category, 1, 2), room.capacity, COUNT(e2.crn) as enrolled, (room.capacity - COUNT(e2.crn)) as remaining
            FROM section
            INNER JOIN course ON section.course_id = course.course_id
            INNER JOIN department ON course.dept_id = department.dept_id
            INNER JOIN room ON section.room_id = room.room_id
            INNER JOIN building ON room.building_id = building.building_id
            INNER JOIN timeslot ON section.timeslot_id = timeslot.timeslot_id
            INNER JOIN day ON timeslot.day_id = day.day_id
            INNER JOIN period ON timeslot.period_id = period.period_id
            INNER JOIN semester ON section.semester_id = semester.semester_id
            LEFT OUTER JOIN teaching ON section.crn = teaching.crn
            LEFT OUTER JOIN user ON teaching.faculty_id = user.user_id
            LEFT OUTER JOIN enrollment ON section.crn = enrollment.crn AND enrollment.student_id = $userid
            LEFT OUTER JOIN enrollment e2 ON section.crn = e2.crn
            WHERE department.dept_id =" . $_SESSION['dept_id'] . " AND section.semester_id =" . $_SESSION['semester_id']
            . " AND section.course_id =" . $_POST['course_id'] .
            " GROUP BY section.crn";
}


if (isset($_POST['advanced_search'])) {
    $department = "";
    $fields = array('coursexcourse_name', 'coursexcredits', 'userxlast_name', 'dayxday', 'departmentxdept_id');
    $conditions = array();
    foreach($fields as $field) {
        if (isset($_POST[$field]) && $_POST[$field] !== '') {
            $conditions[] = "$field LIKE '%" . $_POST[$field] . "%'";
        }
    }

    if (isset($_POST['coursexcourse_category']) && $_POST['coursexcourse_category'] !== '') {
        $conditions[] = "SUBSTRING(coursexcourse_category, 4) = " . $_POST['coursexcourse_category'];
    }

    if (isset($_POST['time']) && $_POST['time'] !== '') {
        $conditions[] = "CONCAT(period.start_time,'-',period.end_time) = '" . $_POST['time'] . "'";

    }

    $_SESSION['sql'] = "SELECT section.crn, course.course_name, course.credits, CONCAT(building.building_name,' ',room.room_num),
            day.day, CONCAT(period.start_time,'-',period.end_time), 
            CONCAT(MONTH(semester.sem_start_date),'/',DAY(semester.sem_start_date), '-', MONTH(semester.sem_end_date),'/',DAY(semester.sem_end_date)),
            semester.sem_name, department.dept_name, section.course_id, timeslot.timeslot_id, enrollment.crn, IFNULL(CONCAT(MAX(user.first_name), ' ' , MAX(user.last_name)), 'N/A'),
            SUBSTRING(course.course_category, 4), SUBSTRING(course.course_category, 1, 2), room.capacity, COUNT(e2.crn) as enrolled, (room.capacity - COUNT(e2.crn)) as remaining
            FROM section
            INNER JOIN course ON section.course_id = course.course_id
            INNER JOIN department ON course.dept_id = department.dept_id
            INNER JOIN room ON section.room_id = room.room_id
            INNER JOIN building ON room.building_id = building.building_id
            INNER JOIN timeslot ON section.timeslot_id = timeslot.timeslot_id
            INNER JOIN day ON timeslot.day_id = day.day_id
            INNER JOIN period ON timeslot.period_id = period.period_id
            INNER JOIN semester ON section.semester_id = semester.semester_id
            LEFT OUTER JOIN teaching ON section.crn = teaching.crn
            LEFT OUTER JOIN user ON teaching.faculty_id = user.user_id
            LEFT OUTER JOIN enrollment ON section.crn = enrollment.crn AND enrollment.student_id = $userid 
            LEFT OUTER JOIN enrollment e2 ON section.crn = e2.crn ";

    if(count($conditions) > 0) {
       $conditions = str_replace('x', '.', $conditions);
        $_SESSION['sql'].= "WHERE " . implode (' AND ', $conditions); 
    }

    $_SESSION['sql'].= " AND section.semester_id =" . $_SESSION['semester_id'] . " GROUP BY section.crn";
}



$sql = $_SESSION['sql'];
if ($result = mysqli_query($conn, $sql)) {
    		if (!mysqli_num_rows($result) == 0) {
				$resultTable = "<div class='w3-container w3-responsive'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = '?' method = 'post'>
                               <thead>
                               <tr class='w3-grey'>
                                    <th> Select </th>
                                    <th> Subject </th>
                                    <th> Course </th>
                                    <th> Title </th>
                                    <th> Credits </th>
                                    <th> Days </th>
                                    <th> Time </th>
                                    <th> Cap </th>
                                    <th> Act </th>
                                    <th> Rem </th>
                                    <th> Instructor </th>
                                    <th> Date </th>
                                    <th> Building & Room </th>
                                    <th> Semester </th>
                                </tr>
                                </thead>
                                ";
				while ($row = mysqli_fetch_array($result)) {

                    //<td><input type = 'checkbox' name = 'checkbox[]' value = $row[0]> <a href = 'account_info.php?account=$row[0]'> $row[0] </a></td>
					//$sql2 = "SELECT * from student_major WHERE major_id = $major_id AND student_id = $row[0]";
					//$result2 = mysqli_query($conn, $sql2);
                    if ($row[0] == $row[11]) {
                        $input = "<span class='w3-tag w3-teal w3-round'>Registered</span>";
                    }

                    else if (!$row[0] == $row[11] && $row[17] == 0) {
                        $input = "<span class='w3-tag w3-2017-grenadine w3-round'>Full</span>";
                    }

                    else {
                        $input = "<input type = 'checkbox' name = 'crn[]' value = $row[0]>";
                    }

					$resultTable.= "<tr>
					            <td>$input</td>
                                <td>$row[14]</td>
                                <td>$row[13]</td>
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                <td>$row[15]</td>
                                <td>$row[16]</td>
                                <td>$row[17]</td>
                                <td>$row[12]</td>
                                <td>$row[6]</td>
                                <td>$row[3]</td>
                                <td>$row[7]</td>
                                </tr>";
				}

				$resultTable.= "</table>
                                <input class='w3-btn w3-blue-grey w3-section' type = 'submit' name = 'register' value = 'Register'>
                                </form></div>";
				//echo ($resultTable);	
		}

        else {
            $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                                        <p> <b>No classes were found that meet your search criteria<b> </p>
                                        </div>";
        }
}

else {
    echo "failed " . mysqli_error($conn);
}

mysqli_close($conn);

if (isset($_POST['register']) && isset($_POST['crn'])) {
    $conn = mysqlConnect();

    /*************  Hold Validation  **************/
    $holds = array();
    $sqlCheckHolds = "SELECT student_hold.hold_id, hold.hold_name, student_hold.student_id FROM student_hold 
                      INNER JOIN hold ON student_hold.hold_id = hold.hold_id WHERE student_id = $userid";

    if ($result = mysqli_query($conn, $sqlCheckHolds)) {
        if (!mysqli_num_rows($result) == 0) {
            while ($row = mysqli_fetch_array($result)) {
                $holds [] = $row[1];
            }

          $holds = implode(', ', $holds);
          $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                    <h4>Unable to Register</h4>
                    <p> <b>You have the following hold/holds against your account:</b> $holds </p>
                    </div>";
          header("location: view_sections.php");
          exit();
        }
    }

    else {
    echo "failed " . mysqli_error($conn);
}

    /*************  Prerequisites Validation  **************/
    $prereqs = array();
    foreach ($_POST['crn'] as $crn) {
            /**$sqlCheckPrereq = "SELECT section.crn, section.course_id, c2.course_name, prerequisites.prereq_id, c1.course_name as prereq_course_name, transcript_test.course_id as transcript_course_id, transcript_test.grade FROM section 
                            INNER JOIN prerequisites ON section.course_id = prerequisites.course_id
                            INNER JOIN course AS c1 ON prerequisites.prereq_id = c1.course_id 
                            INNER JOIN course AS c2 ON section.course_id = c2.course_id 
                            LEFT OUTER JOIN transcript_test ON prerequisites.prereq_id = transcript_test.course_id AND transcript_test.student_id = $userid
                            WHERE section.crn = $crn";**/

               $sqlCheckPrereq = "SELECT section.crn, section.course_id, c2.course_name, prerequisites.prereq_id, 
                                  c1.course_name as prereq_course_name, transcript.student_id, transcript.crn as transcript_crn, s3.course_id, transcript.grade FROM section
                                  INNER JOIN prerequisites ON section.course_id = prerequisites.course_id
                                  INNER JOIN course AS c1 ON prerequisites.prereq_id = c1.course_id 
                                  INNER JOIN course AS c2 ON section.course_id = c2.course_id
                                  LEFT OUTER JOIN section as s2 ON prerequisites.prereq_id = s2.course_id 
                                  LEFT OUTER JOIN transcript ON s2.crn = transcript.crn AND transcript.student_id = $userid
                                  LEFT OUTER JOIN section as s3 ON transcript.crn = s3.crn 
                                  WHERE section.crn = $crn";

            if ($result = mysqli_query($conn, $sqlCheckPrereq)) {
                while ($row = mysqli_fetch_array($result)) {
                    if (!$row[3] == $row[7]) {
                    $prereqs[$row[2]][] = $row[4];
                    }
                }
            }
    }

    if (sizeof($prereqs) > 0) {
        //print_r($prereqs[3][0]);
       // print_r($prereqs[3][1]);
       // print_r($prereqs);

        $message = "<div class='w3-container w3-pale-red'>
                    <h4>Unable to Register</h4>";
        foreach($prereqs as $key => $value) {
            $values = array();
            $message.= "<p> <b>Unfulfilled prerequisites for $key: </b> ";
            foreach($value as $key => $value) {
                $values [] = $value;
            }
         $values = implode(', ', $values);
         $message.= "$values </p>";
       }
        $message.= "</div>";
    }

    else {
        $registerCredits = 0;
        $timeslots = array();
        foreach ($_POST['crn'] as $crn) {

                /*************  Timeslot Validation  **************/
               $sqlValidateTimeSlot1 = "SELECT enrollment.student_id, enrollment.crn, section.crn, section.timeslot_id
                                        FROM section
                                        INNER JOIN enrollment ON section.crn = enrollment.crn
                                        WHERE enrollment.student_id = $userid AND section.semester_id =" . $_SESSION['semester_id'];

               $sqlValidateTimeSlot2 = "select timeslot_id from section where section.crn = $crn AND section.semester_id =" . $_SESSION['semester_id'];                         


                if ($result1 = mysqli_query($conn, $sqlValidateTimeSlot1)) {
                        while ($row1 = mysqli_fetch_array($result1)) {
                            $result2 = mysqli_query($conn, $sqlValidateTimeSlot2);
                                while ($row2 = mysqli_fetch_array($result2)) {
                                    //$timeslots[] = $row2[0];
                                    if ($row2[0] == $row1[3]) {
                                        $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                                        <h4>Unable to Register</h4>
                                        <p> <b> Time conflict with current schedule </b> </p>
                                        </div>";
                                        header("location: view_sections.php");
                                        exit();
                                    }
                                }
                     }      

              }

              else {
                   echo "failed " . mysqli_error($conn);
               }
               if ($result = mysqli_query($conn, $sqlValidateTimeSlot2)) {
                   while ($row = mysqli_fetch_array($result)) {
                       $timeslots[] = $row[0];
                   }
               }


                 /*************  Credit Validation  **************/
                $sqlValidateCredits = "SELECT SUM(course.credits) as current_credits, 
                                                 (SELECT SUM(course.credits) FROM section 
							                     INNER JOIN course ON section.course_id = course.course_id 
                                                 WHERE section.crn = $crn) as course_credits
                                       FROM enrollment
                                       INNER JOIN section ON enrollment.crn = section.crn
                                       INNER JOIN course on section.course_id = course.course_id
                                       WHERE section.semester_id=" . $_SESSION['semester_id'] . 
                                       " AND enrollment.student_id = $userid";      

                    if ($result = mysqli_query($conn, $sqlValidateCredits)) {
                    while ($row = mysqli_fetch_array($result)) {
                    $currentCredits = $row[0];
                    $registerCredits += $row[1];
                }
              }

              else {
                   echo "failed " . mysqli_error($conn);
               }
        }

         if (count(array_unique($timeslots)) < count($timeslots)) {
                $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                                        <h4>Unable to Register</h4>
                                        <p> <b> Please choose unique timeslots for sections </b> </p>
                                        </div>";
                                        header("location: view_sections.php");
                                        exit();
         }

        $totalCredits = $currentCredits + $registerCredits;
        if ($totalCredits > 16) {
            $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                    <h4>Unable to Register</h4>
                    <p> <b>Maximum credit amount exceeded: </b> </p>
                    <p> Current registered credits: $currentCredits | Max credits allowed: 16 </p>
                    </div>";
          header("location: view_sections.php");
          exit();
        }

            /*************  Registration (if all validations above pass) **************/
            $courses = array();
            $confirmation = "<div class='w3-container w3-pale-green'>
                             <h4>Registration Successful</h4>";
            foreach ($_POST['crn'] as $crn) {
                    $sqlGetCourseName = "SELECT course.course_name FROM section 
                                         INNER JOIN course ON section.course_id = course.course_id 
                                         WHERE section.crn = $crn";

                    if ($result = mysqli_query($conn, $sqlGetCourseName)) {
                        while ($row = mysqli_fetch_array($result)) {
                            $courses[] = $row[0];
                        }
                    } 
                    $sqlRegister = "INSERT INTO enrollment(student_id, crn, enroll_date) VALUES ($userid, $crn, CURRENT_DATE)";
                    if (!mysqli_query($conn, $sqlRegister)) {
                        echo "failed " . mysqli_error($conn);
                        exit();
                    }
            }

            foreach($courses as $course) {
                $confirmation.= "<p> <b> Successfully registered for $course </b> </p> ";
          }
            $confirmation.= "</div>";
            $_SESSION['message'] = $confirmation;
            header("location: view_sections.php");
            exit(); 
 }

 mysqli_close($conn); 
}

else if (isset($_POST['register']) && !isset($_POST['crn'])) {
    $message = "<div class='w3-container w3-red'>
                    <h4>Please select one of the sections to register</h4>
                    </div>";
}


?>

    <h2 class = "w3-container w3-text-dark-grey"> <?php echo isset($department) ? $department : ''?> </h2>
    <h3 class = "w3-container w3-text-dark-grey"> Register For Classes </h3>

    <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>

    <?php echo isset($message) ? $message : ''?>

    <br>

    <?php echo isset($resultTable) ? $resultTable : ''?>
    

    <div id = "errorMsg" class = "w3-container">
      <p></p>
    </div>

	</body>
</html>



<?php
htmlfooter();
unset($_SESSION['message']);
?>
