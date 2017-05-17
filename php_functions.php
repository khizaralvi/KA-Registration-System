

<?php
//include 'D:\wamp64\www\test\mysql.php';

/***********Database**********/

// These credentials are for a local database server. Change it before testing on your local machine.

function mysqlConnect()
{


	//$host = 'localhost';
	//$database = 'bkj_registration';
	//$user = 'bkj';
	//$password = '985268';

 $host = 'localhost';
 $database = 'id763455_registration_system';
 $user = 'id763455_gdengineers';
 $password = 'cs5910';


	$conn = mysqli_connect($host, $user, $password, $database);
	if (mysqli_connect_errno()) {
		die("Connection failed: " . mysqli_connect_error());
	}

	return $conn;
}

/***********Login**********/

function validateLogin($username, $password)
{
	if ($username == "") {
		$errorUsername = "Please enter your username PHP";
		$error_username_css = "border:2px groove #CD2627";
	}
	else {
		$errorUsername = "";
		$error_username_css = "";
	}

	if ($password == "") {
		$errorPassword = "Please enter your password PHP";
		$error_password_css = "border:2px groove #CD2627";
	}
	else {
		$errorPassword = "";
		$error_password_css = "";
	}

	return array(
		$errorUsername,
		$errorPassword,
		$error_username_css,
		$error_password_css
	);
}

/***********Account Creation**********/

function validateFirstName($firstname)
{
	if ($firstname == "") {
		$errorFirstName = "Please enter your first name PHP";
		$error_firstname_css = "border:2px groove #CD2627";
	}
	else {
		$errorFirstName = "";
		$error_firstname_css = "";
	}

	return array(
		$errorFirstName,
		$error_firstname_css
	);
}

function validateLastName($lastname)
{
	if ($lastname == "") {
		$errorLastName = "Please enter your last name PHP";
		$error_lastname_css = "border:2px groove #CD2627";
	}
	else {
		$errorLastName = "";
		$error_lastname_css = "";
	}

	return array(
		$errorLastName,
		$error_lastname_css
	);
}

function validateDateOfBirth($dateOfBirth)
{
	$currentDate = date("Y-m-d");
	if (empty($dateOfBirth)) {
		$errorDateOfBirth = "Please enter dob";
	}
	else
	if ($dateOfBirth > $currentDate) {
		$errorDateOfBirth = "Date of birth cannot be in future";
		$error_dob_css = "border:2px groove #CD2627";
	}
	else {
		$errorDateOfBirth = "";
		$error_dob_css = "";
	}

	return array(
		$errorDateOfBirth,
		$error_dob_css
	);
}

function validateUsername($username)
{
	if ($username == "") {
		$errorUsername = "Please choose a username PHP";
		$error_username_css = "border:2px groove #CD2627";
	}
	else
	if (strlen($username) >= 1 && strlen($username) < 5) {
		$errorUsername = "Username must be atleast 5 characters long PHP";
		$error_username_css = "border:2px groove #CD2627";
	}
	else
	if (preg_match("/[^a-zA_Z0-9_-]/", $username)) {
		$errorUsername = "Only a-z, A-Z, 0-9, - and _ allowed in username PHP";
		$error_username_css = "border:2px groove #CD2627";
	}
	else {
		$errorUsername = "";
		$error_username_css = "";
	}

	return array(
		$errorUsername,
		$error_username_css
	);
}

function validateEmail($email)
{

	if ($email == "") {
		$errorEmail = "Please enter your email PHP";
		$error_email_css = "border:2px groove #CD2627";
	}
	else
	if (!preg_match("/\S+@\S+\.\S+/", $email)) {
		$errorEmail = "The Email Address is invalid PHP";
		$error_email_css = "border:2px groove #CD2627";
	}
	else 
	if ($email !== "") {
		$conn = mysqlConnect();
		$sql = "Select email FROM user where email = '$email'";
		if ($result = mysqli_query($conn, $sql)) {
			if (mysqli_num_rows($result) > 0) {
				$errorEmail = "The Email Address is already taken";
				$error_email_css = "border:2px groove #CD2627";
		  }
		   else {
				$errorEmail = "";
				$error_email_css = "";
			}
	    }
	}

	return array(
		$errorEmail,
		$error_email_css
	);
}

function validatePassword($password)
{
	if ($password == "") {
		$errorPassword = "Please enter password PHP";
		$error_password_css = "border:2px groove #CD2627";
	}
	else
	if (strlen($password) > 1 && strlen($password) < 6) {
		$errorPassword = "Password must be atleast 6 characters long";
		$error_password_css = "border:2px groove #CD2627";
	}
	else
	if (!preg_match("/[a-z]/", $password) || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
		$errorPassword = "Pasword require 1 each of a-z, A-Z and 0-9";
		$error_password_css = "border:2px groove #CD2627";
	}
	else {
		$errorPassword = "";
		$error_password_css = "";
	}

	return array(
		$errorPassword,
		$error_password_css
	);
}

function validateNumber($number)
{
	if ($number == "") {
		$errorNumber = "Please enter number PHP";
		$error_number_css = "border:2px groove #CD2627";
	}
	else
	if (!preg_match("/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/", $number)) {
		$errorNumber = "The Phone Number is invalid PHP";
		$error_number_css = "border:2px groove #CD2627";
	}
	else {
		$errorNumber = "";
		$error_number_css = "";
	}

	return array(
		$errorNumber,
		$error_number_css
	);
}


function validateSalary($salaryPartTime, $salaryFullTime)
{
	if ($salaryPartTime == "" && $salaryFullTime == "") {
		$errorsalary = "Please enter salary PHP";
		$error_salary_css = "border:2px groove #CD2627";
	}
	else if ($salaryPartTime !== "" && $salaryFullTime !== ""){
		$errorsalary = "Only one field required for salary";
		$error_salary_css = "";
	}
	else {
		$errorsalary = "";
		$error_salary_css = "";
	}

	return array(
		$errorsalary,
		$error_salary_css
	);
}

/***********Account Management**********/

function searchAccount2($searchFields, $user_type = '')
{
	global $errorMsg;

	// foreach($searchFields as $key => $value) {

	if ($user_type == '') {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value'";
					break;

				case 'first_name':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value'";
					break;

				case 'last_name':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value'";
					break;
				}
			}
		}
	}
	else
	if ($user_type == "student") {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value' AND user_type = 'S'";
					break;

				case 'first_name':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value' AND user_type = 'S'";
					break;

				case 'last_name':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value' AND user_type = 'S'";
					break;
				}
			}
		}
	}
	else
	if ($user_type == "faculty") {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value' AND user_type = 'F'";
					break;

				case 'first_name':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value' AND user_type = 'F'";
					break;

				case 'last_name':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value' AND user_type = 'F'";
					break;
				}
			}
		}
	}

	// }

	if (sizeof($searchFields) == 1) {
		$conn = mysqlConnect();
		$result = mysqli_query($conn, $sql);
		if (!mysqli_num_rows($result) == 0) {
			$resultTable = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <thead>
                                <tr class='w3-light-grey'>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Date Of Birth </th>
                                    <th> Email </th>
                                    <th> Number  </th>
                                    <th> Username </th>
                                </tr>
                                </thead>
                                ";
			while ($row = mysqli_fetch_array($result)) {
				$resultTable.= "<tr>
                                <td>$row[0]</td>
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                </tr>";
			}

			$resultTable.= "</table></div>";
			echo ($resultTable);
		}
		else {
			echo ("Account doesn't exist");
		}

		mysqli_close($conn);
	}
	else
	if (sizeof($searchFields) > 1) {
		echo "<div class = 'w3-container'>
                <span style = 'font-size:130%; color: #CD2627'> Search can be performed by one field only </span>
                </div>";
	}
	else
	if (sizeof($searchFields) == 0) {
		echo "<div class = 'w3-container'>
                <span style = 'font-size:130%; color: #CD2627'> Please fill in one of the fields for search </span>
                </div>";
	}
}

function searchAccount($searchFields, $user_type = NULL, $operation = NULL)
{
	// foreach($searchFields as $key => $value) {

	if ($user_type == NULL) {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value'";
					break;

				case 'first_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value'";
					break;

				case 'last_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value'";
					break;
				}
			}
		}
	}
	else
	if ($user_type == "admin") {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value' AND user_type = 'A'";
					break;

				case 'first_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value' AND user_type = 'A'";
					break;

				case 'last_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value' AND user_type = 'A'";
					break;
				}
			}
		}
	}
	else
	if ($user_type == "research") {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value' AND user_type = 'R'";
					break;

				case 'first_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value' AND user_type = 'R'";
					break;

				case 'last_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value' AND user_type = 'R'";
					break;
				}
			}
		}
	}
	else
	if ($user_type == "student") {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value' AND user_type = 'S'";
					break;

				case 'first_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value' AND user_type = 'S'";
					break;

				case 'last_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value' AND user_type = 'S'";
					break;
				}
			}
		}
	}
	else
	if ($user_type == "faculty") {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value' AND user_type = 'F'";
					break;

				case 'first_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value' AND user_type = 'F'";
					break;

				case 'last_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value' AND user_type = 'F'";
					break;
				}
			}
		}
	}

	// }

	if (sizeof($searchFields) == 1) {
		$conn = mysqlConnect();
		$result = mysqli_query($conn, $sql);
		if (!mysqli_num_rows($result) == 0) {
			if ($operation == NULL) {
				$resultTable = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <thead>
                                <tr class='w3-light-grey'>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Date Of Birth </th>
                                    <th> Email </th>
                                    <th> Number  </th>
                                    <th> Username </th>
                                </tr>
                                </thead>
                                ";
				while ($row = mysqli_fetch_array($result)) {
					$resultTable.= "<tr>
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                <td>$row[6]</td>
                                </tr>";
				}

				$resultTable.= "</table></div>";
				echo ($resultTable);
			}
			else
			if ($operation == 'delete') {
				$resultTable = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = 'account_info.php' method = 'get'>
                               <thead>
                                <tr class='w3-light-grey'>
                                    <th> User_ID </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Date Of Birth </th>
                                    <th> Email </th>
                                    <th> Number  </th>
                                    <th> Username </th>
                                </tr>
                                </thead>
                                ";
				while ($row = mysqli_fetch_array($result)) {
                    //<td><input type = 'checkbox' name = 'checkbox[]' value = $row[0]> <a href = 'account_info.php?account=$row[0]'> $row[0] </a></td>
					$resultTable.= "<tr>  
                                <td><a href = 'account_info.php?account=$row[0]'> $row[0] </a></td>
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                <td>$row[6]</td>
                                </tr>";
				}
				//$resultTable.= "</table><input class='w3-btn w3-blue-grey w3-section' type='submit' name = 'Delete' value = 'Delete User'></form></div>";
				echo ($resultTable);
			}
		}
		else {
			echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Account doesn't exist</p>
                        </div>";
		}

		mysqli_close($conn);
	}
	else
	if (sizeof($searchFields) > 1) {
		 echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Search can be performed by one field only</p>
                        </div>";
	}
	else
	if (sizeof($searchFields) == 0) {
		echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Please fill in one of the fields for search</p>
                        </div>";
	}
    
}

function deleteAccount()
{
	$deleteFields = array();
	foreach($_GET['checkbox'] as $id) {
		$deleteFields[] = $id;
		if (sizeof($deleteFields) == 1) {
			$sqlDelete = "DELETE FROM user WHERE user_id = $id";
		}
		else
		if (sizeof($deleteFields) > 1) {
			$deleteFields = implode(',', $deleteFields);
			$sqlDelete = "DELETE FROM user WHERE user_id IN ($deleteFields)";
		}
	}

	if (sizeof($deleteFields) >= 1) {
		$conn = mysqlConnect();
		$result = mysqli_query($conn, $sqlDelete);
		if (mysqli_query($conn, $sqlDelete)) {
			$message = "<div class='w3-container w3-pale-green'>
                        <h3>Success</h3>
                        <p>User deleted successfully.</p>
                        </div>";
		}
		else {
			$message = "<div class='w3-container w3-pale-green'>
                         <h3>Failure</h3>
                        <p>Delete operation failed.</p>
                        </div>";
		}

		mysqli_close($conn);
	}
   return $message;
}
// ------------------ BENS FUNCTIONS------------------------------------
function connectToHost(){
    $host = 'localhost';
    $database = 'id763455_registration_system';
    $user = 'id763455_gdengineers';
    $password = 'cs5910';

    // Create connection
    $conn = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	return $conn;
}

function runSQL($conn, $sql){
    $result = $conn->query($sql);
    return $result;
}

function addPrereq($id, $preid){
    $conn = connectToHost();
    $sql = "insert into prerequisites (course_id, prereq_id) values ($id,$preid)";
    $result = runSQL($conn,$sql);

    if($result){
        echo "Prerequisite added for course id '$id' ";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function makeEditCourseForm($course_id){
    $conn = connectToHost();
    $sql = "select * from course where course_id = $course_id";
    $result = runSQL($conn,$sql);


    if($result){
        $row = $result->fetch_assoc();
        echo "<h1 style='margin-left:15px'>Edit Course</h1>
            <form class='w3-container' action = 'edit_validation.php' method = 'post'>
            <label class='w3-label w3-white'><b>Department</b></label>
            <select class='w3-select w3-border' name='dept' required>";
            getAllDepartments();
        echo "</select><br><br>
            <label class='w3-label w3-white'><b>Course Name</b></label>
            <input class='w3-input' type='text' name='name' value='".$row['course_name']."' required>
            <br>
            <label class='w3-label w3-white'><b>Course Category</b></label>
            <input class='w3-input' type='text' name='category' value='".$row['course_category']."'>
            <br>
            <label class='w3-label w3-white'><b>Course Description</b></label>
            <textarea class='w3-input' type='text' name='desc'>".$row['course_description']."</textarea>
            <br>
            <label class='w3-label w3-white'><b>Credit Amount</b></label>
            <input class='w3-input' type='number' max='4' min='2' name='credits' value='".$row['credits']." required'>
            <input value=".$_GET["id"]." name='course' type='hidden'>
            <div>
                <button class='w3-btn w3-green' onclick ='return confirmAcion();' >Update</button>
                <a class='w3-btn w3-green' href='admin_home.php'>cancel</a>
            </div>
            </form>";
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function makeEditSectionForm($room,$semester,$timeslot){
    echo "<div class='w3-panel'>";
    echo "<form class='w3-container' action = 'confirm_section_edit.php' method = 'post'>
            <label class='w3-label w3-blue-grey'>Room</label>
            <select class='w3-select w3-border' name='room' required>";
            getAllRooms($room);
    echo  " </select>
            <label class='w3-label w3-blue-grey'>Semester</label>
            <select class='w3-select w3-border' name='semester' required>";
            getAllSemesters($semester);
    echo  " </select>
            <label class='w3-label w3-blue-grey'>TimeSlot</label>
            <select class='w3-select w3-border' name='timeslot' required>";
            getAllTimeslots($timeslot);
    echo  " </select>
            <input value='".$_GET['crn']."' name='crn' type='hidden'>
            <div>
                <button class='w3-btn w3-green' onclick ='return confirmAcion();'>Create</button>
                <a class='w3-btn w3-green' href='admin_home.php'>cancel</a>
            </div>
          </form>";

}

function editSection($crn, $room, $semester,$timeslot){
//    $conn = connectToHost();
//    $sql = "update course set dept_id = $department, course_name = '$name', course_category = '$catagory', course_description = '$desc', credits = $cred where course_id = $course";
//    if(runSQL($conn, $sql)){
//        echo "course updated";
//    }else{
//        echo "Failed:". mysqli_error($conn);
//    }
//    $conn->close();
    $conn = connectToHost();
    //$sql = "insert into section(course_id, room_id, semester_id ,timeslot_id ) values ($course, $room, '$semester',$timeslot)";
    $sql = "update section set room_id = $room, semester_id = $semester, timeslot_id = $timeslot where crn = $crn";
    $sql_valid = "select * from section where room_id = $room and timeslot_id = $timeslot";
    $result = runSQL($conn, $sql_valid);
    if($result->num_rows == 0){
        if(runSQL($conn, $sql)){
            echo "Section updated";
        }else{
            echo "Failed:". mysqli_error($conn);
        }
    }else{
         echo "Scheduling Conflict please try again";
    }
    $conn->close();
}

function editCourse($course,$name, $catagory ,$desc,$cred, $department){
    $conn = connectToHost();
    $sql = "update course set dept_id = $department, course_name = '$name', course_category = '$catagory', course_description = '$desc', credits = $cred where course_id = $course";
    if(runSQL($conn, $sql)){
        echo "course updated";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function addBuilding($buildingName){
    $conn = connectToHost();
    $sql = "insert into building (building_name) values ('$buildingName') ";

    if(runSQL($conn, $sql)){
        echo "Building created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function addRoom($buildingId, $roomNum, $roomtype, $capacity){
    $conn = connectToHost();
    $sql = "insert into room(building_id, room_num, room_type, capacity) values ($buildingId, '$roomNum', '$roomtype', $capacity)";

    if(runSQL($conn, $sql)){
        echo "Room created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function addSemester($name, $year, $start, $end){
    $conn = connectToHost();
    $sql = "insert into semester(sem_name, sem_year, sem_start_date, sem_end_date) values ($name, $year, $start, $end)";
    if(runSQL($conn, $sql)){
        echo "Semester created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function addPeriod($start, $end){
    $conn = connectToHost();
    $sql = "insert into period(start_time, end_time) values ($start, $end)";
    if(runSQL($conn, $sql)){
        echo "Period created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function addDay($day){
    $conn = connectToHost();
    $sql = "insert into day(day) values ($day)";
    if(runSQL($conn, $sql)){
        echo "Day created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function addTimeslot($day, $period){
    $conn = connectToHost();
    $sql = "insert into timeslot(day_id, period_id) values ($day, $period)";
    if(runSQL($conn, $sql)){
        echo "Timeslot created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

/**function htmlheader(){
    session_start();

    if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
        header("Location: index.php");
    }

    if (isset($_POST['signout'])) {
        session_unset();
        session_destroy();
        header("Location: logout_page.php");
    }

    echo "<!doctype html>
            <html>
                <head>
                    <title>BJK Registration</title>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
		            <link rel='stylesheet' href='https://www.w3schools.com/lib/w3.css'>
                    <script src='js/functions.js' type='text/javascript'></script>
                </head>

    <span> Signed in as ";
    echo $_SESSION['username'];
    echo "</span><body class='w3-blue-grey'>
        <nav class='w3-bar w3-white'><a class='w3-bar-item w3-button w3-hover-blue-grey' href='admin_home.php'>Home</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey' href='schedule.php'>Master Schedule</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey' href='catalog.php'>Master Catalog</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey' href='dept_viewAllpub.php'>Departments</a>
        <form action = '?' method = 'post'>
            <input type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-right w3-red' value = 'Sign Out'>
        </form>
		<div class='w3-dropdown-hover w3-right'>
            <button class='w3-button'>";
			 echo $_SESSION['firstname'];
			echo "</button>
            <div class='w3-dropdown-content w3-bar-block w3-border'>
                <a href='personal_info.php' class='w3-bar-item w3-button'>Account</a>
                <a href='#' class='w3-bar-item w3-button'>Link 2</a>
                <a href='#' class='w3-bar-item w3-button'>Link 3</a>
            </div>
         </div>
    </nav>";
}**/

function htmllayer($level){
    session_start();

    if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
        header("Location: ../index.php");
    }

    if (isset($_POST['signout'])) {
        session_unset();
        session_destroy();
        header("Location: ../logout_page.php");
    }

    echo "<!doctype html>
            <html>
                <head>
                    <title>BJK Registration</title>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
		            <link rel='stylesheet' href='https://www.w3schools.com/lib/w3.css'>
                    <script src='../js/functions.js' type='text/javascript'></script>
                    <script src='../js/css.js' type='text/javascript'></script>
                </head>

    <span> Signed in as ";
    echo $_SESSION['username'];
    echo "</span><body class='w3-blue-grey'>
        <nav class='w3-bar w3-white'><a class='w3-bar-item w3-button w3-hover-blue-grey' href='../admin_home.php'>Home</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey' href='../schedule.php'>Master Schedule</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey' href='../catalog.php'>Master Catalog</a>
        <form action = '?' method = 'post'>
            <input type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-right w3-red' value = 'Sign Out'>
        </form>
    </nav>";
}

/**function htmlfooter(){
    echo "</body></html>";
}**/

function makeBuildingForm(){

    echo "<div class='w3-panel'>";
    echo "<form class='w3-container' action = 'building_create_vaild.php' method = 'post'>
            <label class='w3-label w3-blue-grey'>Building Name</label>
            <input class='w3-input' type='text' name='building_name'>

            <div>
                <button class='w3-btn w3-green' onclick ='return confirmAcion();'>Create</button>
                <a class='w3-btn w3-green' href='../admin_home.php'>cancel</a>
            </div>
          </form>";
    echo "</div>";


}

function makeRoomForm(){

    echo "<div class='w3-panel'>";
    echo "<form class='w3-container' action = 'room_vaild.php' method = 'post'>

            <label class='w3-label w3-blue-grey'>Building Name</label>
            <select class='w3-input' name='building'>";
            getAllBuildings();
    echo   "</select>
            <label class='w3-label w3-blue-grey'>Room Number</label>
            <input class='w3-input' type='text' name='room_number'>
            <label class='w3-label w3-blue-grey'>Room Type</label>
            <select class='w3-input' id='rooms' onchange='setTextField(this)'>
                <option value='0'>Computer Lab</option>
                <option value='1'>Smart Classroom</option>
            </select>
            <input id='room_type2' type = 'hidden' name = 'room_type' value = '' />
            <script type='text/javascript'>
                function setTextField(ddl) {
                    document.getElementById('room_type2').value = ddl.options[ddl.selectedIndex].text;
                }
            </script>
            <label class='w3-label w3-blue-grey'>Room Capacity</label>
            <input class='w3-input' type='number' name='cap'>
            <div>
                <button class='w3-btn w3-green' onclick ='return confirmAcion();'>Create</button>
                <a class='w3-btn w3-green' href='../admin_home.php'>cancel</a>
            </div>
          </form>";
    echo "</div>";


}

function addSection($course, $room ,$semester,$timeslot){
    $conn = connectToHost();
    $sql = "insert into section(course_id, room_id, semester_id ,timeslot_id ) values ($course, $room, '$semester',$timeslot)";
    $sql_valid = "select * from section where room_id = $room and timeslot_id = $timeslot";
    $result = runSQL($conn, $sql_valid);
    if($result->num_rows == 0){
        if(runSQL($conn, $sql)){
            echo "Section created";
        }else{
            echo "Failed:". mysqli_error($conn);
        }
    }else{
         echo "Scheduling Conflict please try again";
    }
    $conn->close();
}

function addFaculty($faculty, $crn){
    $conn = connectToHost();
    $sql = "insert into teaching(faculty_id, crn) values ($faculty, $crn)";
    $sql_valid = "select * from teaching left join section on teaching.crn = section.crn where faculty_id = $faculty";
    $result = runSQL($conn, $sql_valid);
    if($result->num_rows == 0){
        if(runSQL($conn, $sql)){
            echo "Faculty has been assigned";
        }else{
            echo "Failed:". mysqli_error($conn);
        }
    }else{
         echo "Scheduling Conflict please try again";
    }
    $conn->close();
}


function deleteSection($crn){
    $conn = connectToHost();
    $sql = "DELETE FROM section WHERE crn = $crn";
    if(runSQL($conn, $sql)){
        echo "Section delete";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function archiveCourse($course_id){
    $conn = connectToHost();
    $sql = "update course set is_archived = 1 where course_id = $course_id";
    if(runSQL($conn, $sql)){
        echo "course archived";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function restoreCourse($course_id){
    $conn = connectToHost();
    $sql = "update course set is_archived = 0 where course_id = $course_id";
    if(runSQL($conn, $sql)){
        echo "course archived";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

//--------------------------------------------------
function confirmAction($text, $redirect){
    echo "<script>
            var conf = confirm('$text');
            if(!conf){
                window.location.href= \"$redirect\";
                window.stop();
            }
        </script>";
}

//--------------------------------------------------
function addHold($name, $desc){
    $conn = connectToHost();
    $sql = "insert into hold(hold_name, hold_desc) values ($name, $desc)";
    if(runSQL($conn, $sql)){
        echo "Hold created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function editHold($hold_id,$name, $desc){
    $conn = connectToHost();
    $sql = "update hold set hold_name = $name,hold_desc = $desc where hold_id = $hold_id";
    if(runSQL($conn, $sql)){
        echo "Hold updated";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function deleteHold($hold_id){
    $conn = connectToHost();
    $sql = "DELETE FROM hold WHERE hold_id = $hold_id";
    if(runSQL($conn, $sql)){
        echo "Hold delete";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function viewStudentHold($student_id){
    $conn = connectToHost();
    $sql = "select hold.hold_name, hold.hold_desc
            from student_hold
            inner join hold on hold.hold_id = student_hold.hold_id
            where student_hold.student_id = $student_hold";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo $row["hold_name"]." ".$row["hold_desc"];
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}
function teachingForm($timeslot,$crn){
        echo "<div class='w3-panel'>";
    echo "<form class='w3-container' action = 'teaching_valid.php' method = 'post'>
            <label class='w3-label w3-blue-grey'>Facilty</label>
            <select class='w3-select w3-border' name='faculty' required>";
            getAvaliableFaculty($timeslot);
    echo  " </select>
            <input value='$crn' name='crn' type='hidden'>
            <div>
                <button class='w3-btn w3-green' onclick ='return confirmAcion();'>Create</button>
                <a class='w3-btn w3-green' href='../admin_home.php'>cancel</a>
            </div>
          </form>";
    echo "</div>";
}

function getAvaliableFaculty($timeslot){
    $conn = connectToHost();
    $sql  = "SELECT faculty.faculty_id, CONCAT(last_name, ', ', first_name) AS full_name
	         FROM faculty
                INNER JOIN user ON faculty.faculty_id = user.user_id
                left join teaching on teaching.faculty_id = faculty.faculty_id
                left join section on section.crn = teaching.crn
             where section.timeslot_id != $timeslot or section.crn is null";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["faculty_id"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function applyHold($hold, $student){
    $conn = connectToHost();
    $sql = "insert into student_hold(student_id, hold_id) values ($hold, $student)";
    if(runSQL($conn, $sql)){
        echo "Hold Applied";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function removeStudentHold($student_id, $hold_id){
    $conn = connectToHost();
    $sql = "DELETE FROM student_hold WHERE hold_id = $hold_id and student_id = $student_id";
    if(runSQL($conn, $sql)){
        echo "Hold Deleted from student account";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function viewSections(){
    $conn = connectToHost();
    $sql = "SELECT
                section.crn,
                course.course_name,
                CASE
                	when user.first_name is null then 'TBA'
               	 	else user.first_name
                End as 'first_name'
                ,
                CASE
                	when user.last_name is null then ''
               	 	else user.last_name
                End as 'last_name',
                building.building_name,
                room.room_num,
                room.capacity,
                semester.sem_name,
                day.day,
                period.start_time,
                period.end_time

            FROM section
            left join teaching on teaching.crn = section.crn
            left join course on section.course_id = course.course_id
            left join user on user.user_id = teaching.faculty_id
            left join room on room.room_id = section.room_id
            left join building on room.building_id = building.building_id
            left join semester on semester.semester_id = section.semester_id
            left join timeslot on timeslot.timeslot_id = section.timeslot_id
            left join day on timeslot.day_id = day.day_id
            left join period on timeslot.period_id = period.period_id
            GROUP by section.crn
            ";
    $result = runSQL($conn, $sql);
    if ($result->num_rows >= 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["crn"]. "</td><td>" . $row["course_name"]. "</td><td>" . $row["first_name"]." ". $row["last_name"]."</td><td>" . $row["building_name"]." ". $row["room_num"]. "</td><td>". $row["capacity"]. "</td><td>". $row["sem_name"]. "</td><td>". $row["day"]. "</td><td>". $row["start_time"]. "</td><td>". $row["end_time"]. "</td></tr>";
        }
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function viewAdminSections(){
    $conn = connectToHost();
    $sql = "SELECT
                section.crn,
                course.course_name,
                CASE
                	when user.first_name is null then 'TBA'
               	 	else user.first_name
                End as 'first_name'
                ,
                CASE
                	when user.last_name is null then ''
               	 	else user.last_name
                End as 'last_name',
                building.building_name,
                room.room_num,
                room.capacity,
                semester.sem_name,
                day.day,
                period.start_time,
                period.end_time,
                section.timeslot_id,
                semester.semester_id,
                room.room_id

            FROM section
            left join teaching on teaching.crn = section.crn
            left join course on section.course_id = course.course_id
            left join user on user.user_id = teaching.faculty_id
            left join room on room.room_id = section.room_id
            left join building on room.building_id = building.building_id
            left join semester on semester.semester_id = section.semester_id
            left join timeslot on timeslot.timeslot_id = section.timeslot_id
            left join day on timeslot.day_id = day.day_id
            left join period on timeslot.period_id = period.period_id
            GROUP by section.crn
            ";
    $result = runSQL($conn, $sql);
    if ($result->num_rows >= 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><a href='../facility/teaching_form.php?crn=".$row["crn"]."&timeslot=".$row["timeslot_id"]."'>".$row["crn"]. "</td><td>" . $row["course_name"]. "</td><td>" . $row["first_name"]." ". $row["last_name"]."</td><td>" . $row["building_name"]." ". $row["room_num"]. "</td><td>". $row["capacity"]. "</td><td>". $row["sem_name"]. "</td><td>". $row["day"]. "</td><td>". $row["start_time"]. "</td><td>". $row["end_time"]. "</td><td><a href='../course/edit_section.php?crn=".$row["crn"]."&time=".$row["timeslot_id"]."&room=".$row["room_id"]."&semester=".$row["semester_id"]."' class='w3-button'>Edit Section</a></td><td><a href='../course/delete_section.php?crn=".$row["crn"]."' class='w3-button'>Delete Section</a></td></tr>";
        }
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function getClass($faculty, $crn){
    $conn = connectToHost();
    $sql = "select user.user_id,user.first_name,user.last_name,user.email,attendance, enrollment.student_id
    from enrollment
            inner join user on user.user_id = enrollment.student_id
                left join meeting on meeting.student_id = enrollment.student_id
            where enrollment.crn = $crn";
    $result = runSQL($conn, $sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='hidden' name='student[]' value='".$row["user_id"]."' ><input type='hidden' name='crn' value='$crn' ><a href='../advisor/account_info.php?account=".$row["student_id"]."&crn=".$_GET["crn"]."'>".$row["first_name"]."</a></td><td>".$row["last_name"]."</td><td>".$row["email"]."</td>";
            if($row["attendance"] == 0 || $row["attendance"] === null){
                echo "<td><select name='attendance[]'>
                        <option value='0' selected='selected'>Absent</option>
                        <option value='1'>Present</option>
                        <option value='2'>Late</option>
                    </select>
                    </td></tr>";
            }
            if($row["attendance"] == 1){
                echo "<td><select name='attendance[]'>
                        <option value='0'>Absent</option>
                        <option value='1'selected='selected'>Present</option>
                        <option value='2'>Late</option>
                    </select>
                    </td></tr>";
            }
           if($row["attendance"] == 2){
                echo "<td><select name='attendance[]'>
                        <option value='0'>Absent</option>
                        <option value='1'>Present</option>
                        <option value='2' selected='selected'>Late</option>
                    </select>
                    </td></tr>";
            }
        }
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function getClass2($faculty, $crn){
    $conn = connectToHost();
    $sql = "select user.user_id,user.first_name,user.last_name,user.email,attendance
    from enrollment
            inner join user on user.user_id = enrollment.student_id
                left join meeting on meeting.student_id = enrollment.student_id
            where enrollment.crn = $crn";
    $result = runSQL($conn, $sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='hidden' name='student[]' value='".$row["user_id"]."' ><input type='hidden' name='crn' value='$crn' >".$row["first_name"]."</td><td>".$row["last_name"]."</td><td>".$row["email"]."</td>";
            if($row["attendance"] == 0 || $row["attendance"] === null){
                echo "<td>Absent</td></tr>";
            }
            if($row["attendance"] == 1){
               echo "<td>Present</td></tr>";
            }
           if($row["attendance"] == 2){
                echo "<td>Late</td></tr>";;
            }
        }
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}
function getFacultybyName($name){
    $conn = connectToHost();
    $sql = "SELECT user_id
            FROM faculty
                INNER join user on user.user_id = faculty.faculty_id
                where username = $name";
    $result = runSQL($conn, $sql);
    $id = null;
    if ($result->num_rows >= 0) {
        $row = $result->fetch_assoc();
        $id = $row["user_id"];
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
    return $id;
}

function viewFacultyClasses($faculty){
    echo "<table class='w3-table-all w3-margin-top w3-text-black' id='myTable'>
                <tr>
                    <th style='width:10%;'>CRN</th>
                    <th style='width:10%;'>Course Name</th>
                    <th style='width:10%;'>Location</th>
                    <th style='width:10%;'>Days</th>
                    <th style='width:10%;'>Start Time</th>
                    <th style='width:10%;'>End Time</th>
                    <th style='width:10%;'>Attendance</th>
                </tr>";
    viewfacultySections($faculty);
    echo "</table>";

}
function viewfacultySections($faculty){
    $conn = connectToHost();
    $sql = "SELECT
                section.crn,
                course.course_name,
                CASE
                	when user.first_name is null then 'TBA'
               	 	else user.first_name
                End as 'first_name'
                ,
                CASE
                	when user.last_name is null then ''
               	 	else user.last_name
                End as 'last_name',
                building.building_name,
                room.room_num,
                room.capacity,
                semester.sem_name,
                day.day,
                period.start_time,
                period.end_time,
                section.timeslot_id

            FROM section
            left join teaching on teaching.crn = section.crn
            left join course on section.course_id = course.course_id
            left join user on user.user_id = teaching.faculty_id
            left join room on room.room_id = section.room_id
            left join building on room.building_id = building.building_id
            left join semester on semester.semester_id = section.semester_id
            left join timeslot on timeslot.timeslot_id = section.timeslot_id
            left join day on timeslot.day_id = day.day_id
            left join period on timeslot.period_id = period.period_id

            where user_id = $faculty";
    $result = runSQL($conn, $sql);
    if ($result->num_rows >= 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><a href='view_roster.php?crn=".$row["crn"]."'>".$row["crn"]. "</a></td><td>" . $row["course_name"]."</td><td>" . $row["building_name"]." ". $row["room_num"]. "</td><td>". $row["day"]. "</td><td>". $row["start_time"]. "</td><td>". $row["end_time"]. "</td><td><a href='view_form.php?crn=".$row["crn"]."' class='w3-button'>View</a></td></tr>";
        }
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}
function updateAttendance($student, $crn, $date, $attendance){
    $conn = connectToHost();
    $sql = "insert into meeting (student_id, crn, date, attendance) values ($student, $crn, $date, $attendance) on duplicate key update attendance = $attendance";
    if(runSQL($conn, $sql)){
        echo "Attendance Updated for $date";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}


function adminSchedule(){
    echo '<div class="w3-container">
            <h2>Courses</h2>
            <p>Search for a course in the input field.</p>

            <input class="w3-input w3-border w3-padding" type="text" placeholder="CRN" id="myInput" onkeyup="filter_table()">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Course Name" id="myInput1" onkeyup="filtert(1,1)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Instructor" id="myInput2" onkeyup="filtert(2,2)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Location" id="myInput3" onkeyup="filtert(3,3)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Capacity" id="myInput4" onkeyup="filtert(4,4)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Semester" id="myInput5" onkeyup="filtert(5,5)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Day" id="myInput6" onkeyup="filtert(6,6)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Start time" id="myInput7" onkeyup="filtert(7,7)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="End Time" id="myInput8" onkeyup="filtert(8,8)">
            <table class="w3-table-all w3-margin-top w3-text-black" id="myTable">
                <tr>
                    <th style="width:10%;">CRN</th>
                    <th style="width:10%;">Course Name</th>
                    <th style="width:20%;">Instructor</th>
                    <th style="width:10%;">Location</th>
                    <th style="width:10%;">Capacity</th>
                    <th style="width:10%;">Semester</th>
                    <th style="width:10%;">Day</th>
                    <th style="width:10%;">Start Time</th>
                    <th style="width:10%;">End Time</th>
                </tr>';
    viewAdminSections();
    echo "</table></div>";

}

function masterSchedule(){
    echo '<div class="w3-container">
            <h2>Master Schedule</h2>
            <p>Search for a Class Section in the input field.</p>

            <input class="w3-input w3-border w3-padding" type="text" placeholder="CRN" id="myInput" onkeyup="filter_table()">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Course Name" id="myInput1" onkeyup="filtert(1,1)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Instructor" id="myInput2" onkeyup="filtert(2,2)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Location" id="myInput3" onkeyup="filtert(3,3)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Capacity" id="myInput4" onkeyup="filtert(4,4)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Semester" id="myInput5" onkeyup="filtert(5,5)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Day" id="myInput6" onkeyup="filtert(6,6)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Start time" id="myInput7" onkeyup="filtert(7,7)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="End Time" id="myInput8" onkeyup="filtert(8,8)">
            <table class="w3-table-all w3-margin-top w3-text-black" id="myTable">
                <tr>
                    <th style="width:10%;">CRN</th>
                    <th style="width:10%;">Course Name</th>
                    <th style="width:20%;">Instructor</th>
                    <th style="width:10%;">Location</th>
                    <th style="width:10%;">Capacity</th>
                    <th style="width:10%;">Semester</th>
                    <th style="width:10%;">Day</th>
                    <th style="width:10%;">Start Time</th>
                    <th style="width:10%;">End Time</th>
                </tr>';
    viewSections();
    echo "</table></div>";

}

function    makeSection(){
    echo "<div class='w3-panel'>";
    echo "<form class='w3-container' action = 'confirm_section.php' method = 'post'>
            <label class='w3-label w3-blue-grey'>Room</label>
            <select class='w3-select w3-border' name='room' required>";
            getAllRooms();
    echo  " </select>
            <label class='w3-label w3-blue-grey'>Semester</label>
            <select class='w3-select w3-border' name='semester' required>";
            getAllSemesters();
    echo  " </select>
            <label class='w3-label w3-blue-grey'>TimeSlot</label>
            <select class='w3-select w3-border' name='timeslot' required>";
            getAllTimeslots();
    echo  " </select>
            <input value='".$_GET['id']."' name='course' type='hidden'>
            <div>
                <button class='w3-btn w3-green' onclick ='return confirmAcion();'>Create</button>
                <a class='w3-btn w3-green' href='admin_home.php'>cancel</a>
            </div>
          </form>";
    echo "</div>";
}

function getAllRooms($id = null){
    $conn = connectToHost();
    $sql = "select room.room_id, room.room_num, building.building_name from room inner join building on room.building_id = building.building_id";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            if($id != null && $id = $row["room_id"]){
                echo "<option value='".$row["room_id"]."' selected>".$row["building_name"]." ".$row["room_num"]."</option>";
            }else{
                echo "<option value='".$row["room_id"]."'>".$row["building_name"]." ".$row["room_num"]."</option>";
            }
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllBuildings($id = null){
    $conn = connectToHost();
    $sql = "select * from building";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            if($id != null && $id == $row["building_id"] ){
                echo "<option value='".$row["building_id"]."' selected>".$row["building_name"]."</option>";
            }else{
                echo "<option value='".$row["building_id"]."'>".$row["building_name"]."</option>";
            }
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllSemesters($id = null){
    $conn = connectToHost();
    $sql = "select semester_id, sem_name from semester";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            if($id == $row["semester_id"] && $id != null){
                echo "<option value='".$row["semester_id"]."' selected>".$row["sem_name"]."</option>";
            }else{
                echo "<option value='".$row["semester_id"]."'>".$row["sem_name"]."</option>";
            }
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllTimeSlots($id = null){
    $conn = connectToHost();
    $sql = "select timeslot.timeslot_id, day.day, period.start_time, period.end_time  from timeslot inner join day on timeslot.day_id = day.day_id
            inner join period on timeslot.period_id = period.period_id";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            if($id != null && $id == $row["timeslot_id"]){
                echo "<option value='".$row["timeslot_id"]."' selected>".$row["day"]." ".$row["start_time"]." - ".$row["end_time"]."</option>";
            }else{
                echo "<option value='".$row["timeslot_id"]."'>".$row["day"]." ".$row["start_time"]." - ".$row["end_time"]."</option>";
            }
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllCourses(){
    $conn = connectToHost();
    $sql = "SELECT course_id, course_name FROM course";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='".$row["course_id"]."'>".$row["course_name"]."</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}


//---------------------- JEFF FUNCTIONS ---------------------

function getAllDepartments(){
    $conn = connectToHost();
    $sql = "select dept_id, dept_name from department";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='".$row["dept_id"]."'>".$row["dept_name"]."</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllFaculty(){
    $conn = connectToHost();
    $sql  = "SELECT faculty_id, CONCAT(last_name, ', ', first_name) AS full_name ";
    $sql .= "FROM faculty INNER JOIN user ON faculty_id = user_id ";
    $sql .= "ORDER BY full_name";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["faculty_id"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllFacultySelect($chair_id){
    $conn = connectToHost();
    $sql  = "SELECT faculty_id, first_name, last_name ";
    $sql .= "FROM faculty INNER JOIN user ON faculty_id = user_id ";
    $sql .= "ORDER BY last_name, first_name";
    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            if($row["faculty_id"] == (int)$chair_id){
                echo "<option value='" .$row["faculty_id"]. "' selected>" .$row["last_name"]. ", " .$row["first_name"]. "</option>";
            } else {
                echo "<option value='" .$row["faculty_id"]. "'>" .$row["last_name"]. ", " .$row["first_name"]. "</option>";
            }
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllFacultyMemb($dept_id){
    $conn = connectToHost();

    $sql  = "SELECT fd.faculty_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name
             FROM faculty_department fd
             INNER JOIN faculty f ON fd.faculty_id = f.faculty_id
             INNER JOIN user u ON f.faculty_id = u.user_id
             WHERE fd.dept_id = $dept_id
             ORDER BY full_name;";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["faculty_id"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllFacultyMembTable($dept_id){
    $conn = connectToHost();

    $sql  = "SELECT fd.faculty_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, u.tel_num, u.email
             FROM faculty_department fd
             INNER JOIN faculty f ON fd.faculty_id = f.faculty_id
             INNER JOIN user u ON f.faculty_id = u.user_id
             WHERE fd.dept_id = $dept_id
             ORDER BY full_name;";

    $result = runSQL($conn,$sql);

    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" .$row["full_name"]. "</td><td>" .$row["tel_num"]. "</td><td>" .$row["email"]. "</td></tr>";
        }
    }else{
        echo "<tr><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
    }

    $conn->close();
}

function departmentReport(){
    $conn = connectToHost();

    $sql  = "Select DISTINCT case when department.dept_name is null then 'UnDeclared' else department.dept_name end as 'Department',count(student.student_id) as 'Students', count(student.student_id)/(select count(*) from student)* 100 as 'percent'

from student
           left join student_major on student.student_id = student_major.student_id
           left join major on major.major_id = student_major.major_id
           left join department on major.dept_id = department.dept_id

GROUP BY department.dept_id";

    $result = runSQL($conn,$sql);
    echo "
    <table>
    <thead>
            <tr class='w3-light-grey'>
                                    <th>Department</th>
                                    <th>Number Of Students</th>
                                    <th>Percent</th>
                                </tr>
                                </thead>";
    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" .$row["Department"]. "</td><td>" .$row["Students"]. "</td><td>" .$row["percent"]. "%</td></tr>";
        }
    }else{
        echo "<tr><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
    }
    echo "</table>";
    $conn->close();
}

function sectionReport(){
    $conn = connectToHost();

    $sql  = "select
	course.course_id,
	course.course_name,
	count(section.crn) as 'sections',
	count(section.crn)/ (select count(section.crn) from section) * 100+'%'  as 'percent'
from course
	LEFT join section on section.course_id = course.course_id
group by course.course_id";

    $result = runSQL($conn,$sql);
    echo "
    <table>
    <thead>
            <tr class='w3-light-grey'>
                                    <th>Course ID</th>
                                    <th>Course</th>
                                    <th>Number Of Sections</th>
                                    <th>Percentage</th>
                                </tr>
                                </thead>";
    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" .$row["course_id"]. "</td><td>" .$row["course_name"]. "</td><td>" .$row["sections"]. "</td><td>" .$row["percent"]. "%</td></tr>";
        }
    }else{
        echo "<tr><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
    }
    echo "</table>";
    $conn->close();
}




function getAllFacultyMembCheckbox($dept_id){
    $conn = connectToHost();

    $sql  = "SELECT f.faculty_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, u.tel_num, u.email
             FROM faculty f
             INNER JOIN faculty_department fd ON fd.faculty_id = f.faculty_id
             INNER JOIN user u ON f.faculty_id = u.user_id
             WHERE fd.dept_id = $dept_id
             ORDER BY full_name;";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='checkbox' name='memberlist[]' value=" .$row["faculty_id"]. "></td><td>" .$row["full_name"]. "</td><td>" .$row["tel_num"]. "</td><td>" .$row["email"]. "</td></tr>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllFacultyNotMemb(){
    $conn = connectToHost();

    $sql  = "SELECT f.faculty_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name
             FROM faculty f
             LEFT JOIN faculty_department fd ON f.faculty_id = fd.faculty_id
             INNER JOIN user u ON f.faculty_id = u.user_id
             WHERE fd.faculty_id IS NULL;";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["faculty_id"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllFacultyNotMembCheckbox(){
    $conn = connectToHost();

    $sql  = "SELECT f.faculty_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, u.tel_num, u.email
             FROM faculty f
             LEFT JOIN faculty_department fd ON f.faculty_id = fd.faculty_id
             INNER JOIN user u ON f.faculty_id = u.user_id
             WHERE fd.faculty_id IS NULL;";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='checkbox' name='memberlist[]' value=" .$row["faculty_id"]. "></td><td>" .$row["full_name"]. "</td><td>" .$row["tel_num"]. "</td><td>" .$row["email"]. "</td></tr>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllStudentsSelect(){
    $conn = connectToHost();

    $sql  = "SELECT s.student_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, s.student_type
             FROM student s
             INNER JOIN user u ON s.student_id = u.user_id
             ORDER BY full_name;";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["student_id"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllCurrentAdvisorsSelect(){
    $conn = connectToHost();
    $sql  = "SELECT DISTINCT sa.facutly_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name ";
    $sql .= "FROM user u  ";
    $sql .= "INNER JOIN student_advisor sa on u.user_id = sa.faculty_id";
    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["faculty_id"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllStudWithAdvSelect($dept_id){
    $conn = connectToHost();

    $sql  = "SELECT s.student_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, s.student_type
             FROM student s
             INNER JOIN student_advisor sa on s.student_id = sa.student_id
             INNER JOIN user u ON s.student_id = u.user_id
             ORDER BY full_name";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["student_id"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllStuNoAdvisorCheckbox(){
    $conn = connectToHost();

    $sql  = "SELECT s.student_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, s.student_type
             FROM student s
             LEFT JOIN student_advisor sa ON s.student_id = sa.student_id
             INNER JOIN user u ON s.student_id = u.user_id
             WHERE sa.student_id IS NULL;";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='checkbox' name='studentlist[]' value=" .$row["student_id"]. "></td><td>" .$row["full_name"]. "</td><td>" .$row["student_type"]. "</td><td>" .$row["student_id"]. "</td></tr>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getStuByAdvisorTable($fac_id){
    $conn = connectToHost();

    $sql  = "SELECT sa.student_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name
             FROM student_advisor sa
             INNER JOIN user u ON sa.student_id = u.user_id
             WHERE sa.faculty_id = $fac_id
             ORDER BY full_name;";

    $result = runSQL($conn,$sql);

    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" .$row["full_name"]. "</td><td>" .$row["student_id"]. "</td></tr>";
        }
    }else{
        echo "<tr><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
    }

    $conn->close();
}

function getAdviseeListTable($fac_id){
    $conn = connectToHost();

    $sql  = "SELECT sa.student_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, u.email
             FROM student_advisor sa
             INNER JOIN user u ON sa.student_id = u.user_id
             WHERE sa.faculty_id = $fac_id
             ORDER BY full_name;";

    $result = runSQL($conn,$sql);

    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><a href='account_info.php?account=".$row["student_id"]."'>" .$row["full_name"]. "</td><td>" .$row["email"]. "</td><td>" .$row["student_id"]. "</td></tr>";
        }
    }else{
        echo "<tr><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
    }

    $conn->close();
}

function getAdvisorByStuTable($stu_id){
    $conn = connectToHost();

    $sql  = "SELECT sa.faculty_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, u.tel_num, u.email
             FROM student_advisor sa
             INNER JOIN user u ON sa.faculty_id = u.user_id
             WHERE sa.student_id = $stu_id;";

    $result = runSQL($conn,$sql);

    if(!$result) {
        echo "Failed:". mysqli_error($conn);
    } else {
        if (mysqli_num_rows($result)>0){
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" .$row["full_name"]. "</td><td>" .$row["tel_num"]. "</td><td>" .$row["email"]. "</td></tr>";
            }
        } else {
            echo "<tr><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
        }
    }
/*
    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" .$row["full_name"]. "</td><td>" .$row["student_id"]. "</td></tr>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
*/

    $conn->close();
}

function getAllSchools(){
    $conn = connectToHost();
    $sql  = "SELECT school_id, school_name ";
    $sql .= "FROM school ";
    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["school_id"]. "'>" .$row["school_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllSchoolsSelect($school_id){
    $conn = connectToHost();
    $sql  = "SELECT school_id, school_name ";
    $sql .= "FROM school ";
    $sql .= "ORDER BY school_name";
    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            if($row["school_id"] == (int)$school_id){
                echo "<option value='" .$row["school_id"]. "' selected>" .$row["school_name"]. "</option>";
            } else {
                echo "<option value='" .$row["school_id"]. "'>" .$row["school_name"]. "</option>";
            }
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getFLnameByID($id){

    $conn = connectToHost();
    $sql  = "SELECT first_name, last_name
             FROM user
             WHERE user_id = $id;";

    $result = runSQL($conn,$sql);

     if(mysqli_num_rows($result) > 0){

         $row = $result->fetch_assoc();
         $flName = $row['first_name']. " " .$row['last_name'];

         return $flName;

    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function insertMember($myF_id, $myD_id) {

    $conn = connectToHost();

	$sql  = "INSERT into faculty_department (faculty_id, dept_id) ";
	$sql .= "VALUES ($myF_id, $myD_id);";

	$result = mysqli_query($conn, $sql);

	if ($result)
	{
		return '';
	} else {
		return 'NotAdded';
	}
}

function insertMemberArray($sqltext) {

    $conn = connectToHost();

	$sql  = "INSERT into faculty_department (faculty_id, dept_id) ";
	$sql .= "VALUES " .$sqltext. ";";

	$result = mysqli_query($conn, $sql);
    echo "<meta http-equiv='refresh' content='0'>";
/*	if ($result)
	{
		return '';
	} else {
		return 'NotAdded';
	}
*/
    if (!$result){
        return "Failed:". mysqli_error($conn);
    } else {
        return '';
    }
}

function deleteMember($myF_id, $myD_id) {

    $conn = connectToHost();

	$sql  = "DELETE FROM faculty_department ";
	$sql .= "WHERE faculty_id = $myF_id
             AND dept_id = $myD_id";

	$result = mysqli_query($conn, $sql);

	if ($result)
	{
		return '';
	} else {
		return 'NotDeleted';
	}
}

function deleteMemberArray($sqltext) {

    $conn = connectToHost();

	$sql  = "DELETE FROM faculty_department ";
	$sql .= "WHERE faculty_id IN (" .$sqltext. ");";

	$result = mysqli_query($conn, $sql);
    echo "<meta http-equiv='refresh' content='0'>";
/*	if ($result)
	{
		return '';
	} else {
		return 'NotAdded';
	}
*/
    if (!$result){
        return "Failed:". mysqli_error($conn);
    } else {
        return '';
    }
}

function insertStuAdvArray($sqltext) {

    $conn = connectToHost();

	$sql  = "INSERT into student_advisor (faculty_id, student_id) ";
	$sql .= "VALUES " .$sqltext. ";";

	$result = mysqli_query($conn, $sql);
    echo "<meta http-equiv='refresh' content='0'>";
/*	if ($result)
	{
		return '';
	} else {
		return 'NotAdded';
	}
*/
    if (!$result){
        return "Failed:". mysqli_error($conn);
    } else {
        return '';
    }
}

function isAssignedAdvisor($stu_id) {

    $conn = connectToHost();

    $sql  = "SELECT sa.faculty_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, u.tel_num, u.email
             FROM student_advisor sa
             INNER JOIN user u ON sa.faculty_id = u.user_id
             WHERE sa.student_id = $stu_id;";

    $result = runSQL($conn,$sql);
    $isAssigned = False;

    if(!$result) {
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result)>0) {
        $isAssigned = True;
    }

    $conn->close();
    return $isAssigned;
}

function insertStuAdv($fac_id,$stu_id,$isAssigned) {

    $conn = connectToHost();

    if($isAssigned){
        $sql  = "UPDATE student_advisor SET faculty_id=$fac_id WHERE student_id=$stu_id;";
    } else {
        $sql  = "INSERT into student_advisor (faculty_id, student_id) VALUES ($fac_id,$stu_id);";
    }

	$result = mysqli_query($conn, $sql);
    echo "<meta http-equiv='refresh' content='0'>";
/*	if ($result)
	{
		return '';
	} else {
		return 'NotAdded';
	}
*/
    if (!$result){
        return "Failed:". mysqli_error($conn);
    } else {
        return '';
    }
}

function redirectPageCountDown(){
    echo "
    <script type=\"text/javascript\">
            (function () {
                var timeLeft = 3,
                    cinterval;

                var timeDec = function (){
                    timeLeft--;
                    document.getElementById('countdown').innerHTML = timeLeft;
                    if(timeLeft === 0){
                        clearInterval(cinterval);
                    }
                };

                cinterval = setInterval(timeDec, 1000);
            })();

        </script>
        <br><p><b>Redirecting in <span id=\"countdown\">3</span></b></p>";
}
?>
