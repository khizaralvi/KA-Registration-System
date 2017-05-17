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

if (isset($_POST['assign_major'])) {
	$student_id = $_POST['assign_major'];

	$conn = mysqlConnect();
	$sql1 = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = $student_id";
	if ($result = mysqli_query($conn, $sql1)) {
		while ($row = mysqli_fetch_array($result)) {
			        $student_name = $row[0] . ' ' . $row[1];
					$first_name = $row [0];
					$last_name = $row[1];
					$dob = $row[2];
					$email = $row[3];
					$number = $row[4];
					$username = $row[5];
		}
	}
	else {
		echo "failed " . mysqli_error($conn);
	}

	$sql2 = "INSERT INTO student_major (major_id, student_id) VALUES ($major_id, $student_id)";
	if (mysqli_query($conn, $sql2)) {
		$_SESSION['table'] = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = '?' method = 'post'>
                               <thead>
                                <tr class='w3-grey'>
                                    <th> Assign Major </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Date Of Birth </th>
                                    <th> Email </th>
                                    <th> Number  </th>
                                    <th> Username </th>
                                </tr>
                                </thead>
								<tr>
					            <td> <span class='w3-tag w3-teal w3-round'>Assigned</span> </td>  
                                <td>$first_name</td>
                                <td>$last_name</td>
                                <td>$dob</td>
                                <td>$email</td>
                                <td>$number</td>
                                <td>$username</td>
                                </tr> <br>";
		$_SESSION['message'] = "<div class='w3-container w3-pale-green'>
                				<h3>Success</h3>
               					<p>$major_name assigned to $student_name</p>
            					</div>";
		header('location: major_student.php');
		exit();
	}
	else {
		echo "Couldn't assign major " . mysqli_error($conn);
	}
	mysqli_close($conn);
}

if (isset($_POST['remove_major'])) {
	$student_id = $_POST['remove_major'];

	$conn = mysqlConnect();
	$sql1 = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = $student_id";
	if ($result = mysqli_query($conn, $sql1)) {
		while ($row = mysqli_fetch_array($result)) {
			        $student_name = $row[0] . ' ' . $row[1];
					$first_name = $row [0];
					$last_name = $row[1];
					$dob = $row[2];
					$email = $row[3];
					$number = $row[4];
					$username = $row[5];
		}
	}
	else {
		echo "failed " . mysqli_error($conn);
	}

	$sql2 = "DELETE FROM student_major WHERE major_id = $major_id AND student_id = $student_id";
	if (mysqli_query($conn, $sql2)) {
		$_SESSION['table'] = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = '?' method = 'post'>
                               <thead>
                                <tr class='w3-grey'>
                                    <th> Assign Major </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Date Of Birth </th>
                                    <th> Email </th>
                                    <th> Number  </th>
                                    <th> Username </th>
                                </tr>
                                </thead>
								<tr>
					            <td> <span class='w3-tag w3-red w3-round'>Removed</span> </td>  
                                <td>$first_name</td>
                                <td>$last_name</td>
                                <td>$dob</td>
                                <td>$email</td>
                                <td>$number</td>
                                <td>$username</td>
                                </tr> <br>";
		$_SESSION['message'] = "<div class='w3-container w3-pale-green'>
                				<h3>Success</h3>
               					<p>$major_name withdrawn from $student_name</p>
            					</div>";
		header('location: major_student.php');
		exit();
	}
	else {
		echo "Couldn't assign major " . mysqli_error($conn);
	}
	mysqli_close($conn);
}

htmlheader_root('w3-white');

?>

<br>
    <div class = "w3-container">
	   <h2 class = " w3-text-dark-grey"> <?php echo isset($_SESSION['major_name']) ? $_SESSION['major_name'] : ''?> </h2>
    </div>
        <h4 style = "margin-left:15px"> Search Student Account To Assign Major</h4>
        <div class="w3-container">
             <form action = "?" method = "post">
                <input class = "w3-round login w3-padding-medium" type = "number" placeholder="Search By Student ID" id = "search_user_ID" name = "search_user_ID">
                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By First Name" id = "search_first_name" name = "search_first_name">
                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By Last Name" id = "search_last_name" name = "search_last_name"> <br />
                <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Search User">
            </form>
        </div>
 <?php

	 //echo isset($resultTable) ? $resultTable : ''
	 echo isset($_SESSION['message']) ? $_SESSION['message'] : '';
	 echo isset($_SESSION['table']) ? $_SESSION['table'] : '';

?>

 <?php
	if (isset($_POST['submit'])) {
		$user_id = $_POST['search_user_ID'];
		$first_name = trim($_POST['search_first_name']);
		$last_name = trim($_POST['search_last_name']);
		$searchFields = array();
		if ($user_id !== "") {
			$searchFields['user_id'] = $_POST['search_user_ID'];
		}

		if ($first_name !== "") {
			$searchFields['first_name'] = $_POST['search_first_name'];
		}

		if ($last_name !== "") {
			$searchFields['last_name'] = $_POST['search_last_name'];
		}
		if ($first_name !== "" && $last_name !== "") {
			$searchFields['full_name'] = $first_name . ' ' . $last_name;
		}

		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, 
							username, student_major.major_id 
							FROM user 
							LEFT OUTER JOIN student_major ON user.user_id = student_major.student_id AND student_major.major_id = $major_id 
							WHERE user.user_id = '$value' AND user_type = 'S'";
					break;

				case 'first_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, 
							username, student_major.major_id 
							FROM user 
							LEFT OUTER JOIN student_major ON user.user_id = student_major.student_id AND student_major.major_id = $major_id 
							WHERE user.first_name = '$value' AND user_type = 'S'";
					break;

				case 'last_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, 
							username, student_major.major_id 
							FROM user 
							LEFT OUTER JOIN student_major ON user.user_id = student_major.student_id AND student_major.major_id = $major_id 
							WHERE user.last_name = '$value' AND user_type = 'S'";
					break;
				case 'full_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, 
							username, student_major.major_id 
							FROM user 
							LEFT OUTER JOIN student_major ON user.user_id = student_major.student_id AND student_major.major_id = $major_id 
							WHERE CONCAT(first_name,' ',last_name) ='$value' AND user_type = 'S'";
				}
			}
		}
	

	// }
	if (isset($searchFields['user_id']) && isset($searchFields['first_name'])) {
		echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Can't combine Student_ID With First or Last Name</p>
                        </div>";
	}
	else if (isset($searchFields['user_id']) && isset($searchFields['last_name'])) {
		echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Can't combine Student_ID With First or Last Name</p>
                        </div>";
	}

	//if (sizeof($searchFields) == 1) {
	else {
		$conn = mysqlConnect();
		$result = mysqli_query($conn, $sql);
		if (!mysqli_num_rows($result) == 0) {

				$resultTable = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = '?' method = 'post'>
                               <thead>
                                <tr class='w3-grey'>
                                    <th> Assign Major </th>
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
					//$sql2 = "SELECT * from student_major WHERE major_id = $major_id AND student_id = $row[0]";
					//$result2 = mysqli_query($conn, $sql2);
						if ($row[7] == $major_id) {
						//$input = "<span class='w3-tag w3-teal w3-round'>Assigned</span>";
						$input = "<button class='w3-btn w3-ripple w3-khaki w3-round w3-padding-small' name = 'remove_major' value = $row[0]>Remove</button>";
						
    				}
					else {
						$input = "<button class='w3-btn w3-ripple w3-khaki w3-round w3-padding-small' name = 'assign_major' value = $row[0]>Assign</button>";
					}
					$resultTable.= "<tr>
					            <td>$input</td>  
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                <td>$row[6]</td>
                                </tr>";
				}
				$resultTable.= "</table></form></div>";
				echo ($resultTable);
			
		}
		else {
			echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Account Doesn't Exist</p>
                        </div>";
		}

		mysqli_close($conn);
	}
	/**else
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
	}**/

}


?>
   
	</div>

<?php
htmlfooter();
unset($_SESSION['message']);
unset($_SESSION['table']);
?>
