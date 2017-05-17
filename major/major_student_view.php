<?php
include '../header_footer.php';
include '../php_functions.php';

session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
    header("Location: ../index.php");
}
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: ../logout_page.php");
}

$major_id = $_SESSION['major_id'];
$major_name = $_SESSION['major_name'];

	$conn = mysqlConnect();
	$sql1 = "SELECT student_major.major_id, student_major.student_id, user.first_name, user.last_name, user.date_of_birth, user.email, user.tel_num, user.username
    FROM student_major INNER JOIN student ON student_major.student_id = student.student_id INNER JOIN user ON user.user_id = student.student_id 
    WHERE student_major.major_id = $major_id";
    $sql2= "SELECT COUNT(major_id) FROM student_major WHERE major_id = $major_id";

	if ($result = mysqli_query($conn, $sql1)) {
      if (!mysqli_num_rows($result) == 0) {
		$resultTable = "<br> <div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = '?' method = 'post'>
                               <thead>
                                <tr class='w3-grey'>
                                    <th> Status </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Date Of Birth </th>
                                    <th> Email </th>
                                    <th> Number  </th>
                                    <th> Username </th>
                                </tr>
                                </thead>";
          while ($row = mysqli_fetch_array($result)) {
                    $first_name = $row[2];
                    $last_name = $row[3];
                    $dob = $row[4];
                    $email = $row[5];
                    $number = $row[6];
                    $username = $row[7];      
								$resultTable .= "<tr>
					            <td> <span class='w3-tag w3-teal w3-round'>Assigned</span> </td>  
                                <td>$first_name</td>
                                <td>$last_name</td>
                                <td>$dob</td>
                                <td>$email</td>
                                <td>$number</td>
                                <td>$username</td>
                                </tr>";
                }
         }
         else {
             $resultTable = "";
         }
	}
	else {
		echo "Failed " . mysqli_error($conn);
	}

    if ($result = mysqli_query($conn, $sql2)) {
		while ($row = mysqli_fetch_array($result)) {
            $student_major_count = $row[0];
        }
	}
	else {
		echo "Failed " . mysqli_error($conn);
	}
	mysqli_close($conn);

htmlheader_root('w3-white');
?>

<br>
    <div class = "w3-container">
	<h2 class = " w3-text-dark-grey"> <?php echo isset($_SESSION['major_name']) ? $_SESSION['major_name'] : ''?> </h2>
    <h3> Students Enrolled In Major</h3>
  </div>

<div class = "w3-container w3-card-4 w3-light-grey" style="max-width:210px">
    <h4> <strong> Total Students: <?php echo $student_major_count ?> </strong> </h4> 
  </div>

    <?php echo $resultTable ?>



 <?php

	 //echo isset($resultTable) ? $resultTable : ''
	 echo isset($_SESSION['message']) ? $_SESSION['message'] : '';
	 echo isset($_SESSION['table']) ? $_SESSION['table'] : '';

?>

 <?php

?>
   
	</div>

<?php
htmlfooter();
unset($_SESSION['message']);
unset($_SESSION['table']);
?>
