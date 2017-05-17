<!doctype html>

<?php

include 'php_functions.php';

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {

    //Creating global SESSION variables for username and password for textbox diplay
    $_SESSION['usernamefield'] = $_POST['username'];
    $_SESSION['passwordfield'] = $_POST['password'];


    $login = validateLogin($_POST['username'], $_POST['password']);

    if ($login[0] == "" && $login[1] == "") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = mysqlConnect();

    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
    if (!mysqli_num_rows($result) == 0) {
        $_SESSION['username'] = $row['username'];
       // echo ("Welcome " . $_SESSION['username']);
	    $user = $row['user_type'];

        switch($user) {
            case "A":
                header("Location: admin_home.php");
                break;
            case "S":
                header("Location: student_home.php");
                break;
            case "F":
                header("Location: faculty_home.php");
                break;
            case "F";
                header("Location: research_home.php");
                break;
        }
    }

    else {
        //echo ("invalid username or password");
		$errMsg = "invalid username or password";
    }

    mysqli_close($conn);

}

    else {
        //Updating Errors
        $errorUsername = $login[0];
        $errorPassword = $login[1];
        
        //Updating CSS for Errors
        $error_username_css = $login[2];
        $error_password_css = $login[3];
     }

}

?>



<html>
	<head>
		<title>BJS Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
		<script type="text/javascript" src="js/functions.js"> </script>
	</head>

	<body>
		<nav class="w3-bar">
			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="#">Home</a>
  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="schedule.php">Master Schedule</a>
  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="catalog.php">Master Catalog</a>
			<button onclick="location.href='login.php'" class="w3-bar-item w3-button w3-right w3-blue-grey">Login</button>
		</nav>
        <div class="w3-blue-grey w3-container" >
            <div class="w3-padding-64 w3-center">
                <h1>BJK Registration System</h1>
                <div class="w3-container"><img src="img/logo.png" class="w3-margin" alt="logo" style="width: 50%" ></div>
            </div>
        </div>
        <div class="w3-center w3-white w3-padding-xlarge">
            <h3 style="color: #607d8b;">Mission Statement</h3>
            <p style="color: #607d8b;">This Registration System is designed and implemented as a web-based system for Gupta University. It is all-inclusive, with content generated and delivered to its four users: Students, Faculty, Administrator, and Research Office user. The GUI enables users to access the services of the Office of the Registrar securely. The design allows for sharing common services across all users in a single integrated system to maintain data integrity.</p>

            <p style="color: #607d8b;">The application has four modules, with features specific to each user group. Student are be able register for classes, view their class schedule, and view their transcript. Teachers can sign up for classes, take student attendance, and record grades. Research officers can collect statistical data for the school without compromising other user's information, and Administrators have full access to the whole system to maintain and modify when necessary.</p>
        </div>
    </body>
</html>
