<?php
include 'php_functions.php';
session_start();
$username = $_SESSION['username'];

if (isset($_GET['pass'])){
  $pass = $_GET['pass'];
  $conn = mysqlConnect();
  $sql = "SELECT password from user WHERE BINARY password = '$pass' and username = '$username'";
  if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) == 0) {
      echo "Invalid Current Password";
    }
  }
  mysqli_close($conn);
}

if (isset($_GET['degree'])) {
  $degree_type = $_GET['degree'];
  $conn = mysqlConnect();
  if ($degree_type == 'All') {
  $sql = "SELECT degree_id, degree_name, degree_short, degree_type FROM degree";
  }
  else {
  $sql = "SELECT degree_id, degree_name, degree_short, degree_type FROM degree WHERE degree_type = '$degree_type'";
  }
  if ($result = mysqli_query($conn, $sql)) {
          $resultTable = "<table class='w3-table-all w3-hoverable'>
                                <form action = 'degree_info.php' method = 'get'>
                                <thead>
                                  <tr class='w3-light-grey'>
                                      <th> Degree Name </th>
                                      <th> Degree Short </th>
                                      <th> Degree Type </th>
                                  </tr>
                                  </thead>
                                  ";
          while ($row = mysqli_fetch_array($result)) {
            $resultTable.= "<tr>
                                  <td><a href = 'degree_info.php?degree=$row[0]'> $row[1] </a></td>
                                  <td>$row[2]</td>
                                  <td>$row[3]</td>
                                  </tr>";
          }
                  //$resultTable .= "</form></table></div>";
                // echo $resultTable;
        }
        else {
            $resultTable = "<div class='w3-container w3-red' id='degree_table'>
                          <h3>Failed</h3>
                          <p>Couldn't connect to the server</p>
                          </div>";
        }
        mysqli_close($conn);
        echo $resultTable;
}

if (isset($_GET['department'])) {
  $department = $_GET['department'];
  $conn = mysqlConnect();
  if ($department == 'All') {
  $sql = "SELECT major.major_id, major.major_name, IFNULL(department.dept_name, 'N/A'), IFNULL(degree.degree_name, 'N/A') FROM major 
LEFT OUTER JOIN department ON major.dept_id = department.dept_id LEFT OUTER JOIN degree ON major.degree_id = degree.degree_id";
  }
  else  {
  $sql = "SELECT major.major_id, major.major_name, IFNULL(department.dept_name, 'N/A'), IFNULL(degree.degree_name, 'N/A') FROM major 
LEFT OUTER JOIN department ON major.dept_id = department.dept_id LEFT OUTER JOIN degree ON major.degree_id = degree.degree_id WHERE major.dept_id = $department";
  }
  if ($result = mysqli_query($conn, $sql)) {
          $resultTable = "<table class='w3-table-all w3-hoverable'>
                               <form action = 'degree_info.php' method = 'get'>
                               <thead>
                                <tr class='w3-light-grey'>
                                    <th> Major Name </th>
                                    <th> Department </th>
                                    <th> Degree </th>
                                </tr>
                                </thead>
                                ";
          while ($row = mysqli_fetch_array($result)) {
            $resultTable.= "<tr>
                                <td><a href = 'major_info.php?major=$row[0]'> $row[1] </a></td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                </tr>";
          }
                  //$resultTable .= "</form></table></div>";
                // echo $resultTable;
        }
        else {
            $resultTable = "<div class='w3-container w3-red' id='degree_table'>
                          <h3>Failed</h3>
                          <p>Couldn't connect to the server</p>
                          </div>";
        }
        mysqli_close($conn);
        echo $resultTable;
}


if (isset($_GET['semester'])) {

  $grades = '';
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
              WHERE semester.semester_id = " . $_GET['semester'] .
              " AND transcript.student_id = " . $_SESSION['userid'];

$conn = mysqlConnect();

$termEarnedCredits = 0;
$termTotalCredits = 0;
$termTotalPoints = 0;

if ($result = mysqli_query($conn, $sql)) {
    $termEarnedCredits = 0;
    $termTotalCredits = 0;
    $termTotalPoints = 0;
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

  if ($result = mysqli_query($conn, $sql)) {
        $grades .= "<div class='w3-section w3-card-8 w3-teal' style='max-width:150px'>
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
                  <p class='w3-text-dark-grey'><span class='w3-tag w3-2017-grenadine w3-round'>$row[4]</span></p>
              </div>
          </div>";
   }
}
  $grades .= "</div>";
}
else {
	echo "Failed " . mysqli_error($conn);
}
echo $grades;
mysqli_close($conn);
}




if (isset($_GET['account_semester'])) {

  $grades = '';
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
              WHERE semester.semester_id = " . $_GET['account_semester'] .
              " AND transcript.student_id = " . $_SESSION['account'];

$conn = mysqlConnect();

$termEarnedCredits = 0;
$termTotalCredits = 0;
$termTotalPoints = 0;

if ($result = mysqli_query($conn, $sql)) {
    $termEarnedCredits = 0;
    $termTotalCredits = 0;
    $termTotalPoints = 0;
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

  if ($result = mysqli_query($conn, $sql)) {
        $grades .= "<div class='w3-section w3-card-8 w3-teal' style='max-width:150px'>
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
  $grades .= "</div>";
}
else {
	echo "Failed " . mysqli_error($conn);
}
echo $grades;
mysqli_close($conn);
}




if (isset($_GET['account_grades_semester'])) {

  $grades = '';
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
            " AND semester.semester_id = " . $_GET['account_grades_semester'];


if ($result = mysqli_query($conn, $sql)) {

    $grades .= "
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
                <input type = 'text' name = 'grade'> 
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
//$grades .= "</div>";
}
else {
	echo "Failed " . mysqli_error($conn);
}

echo $grades;
mysqli_close($conn);
}



?>
