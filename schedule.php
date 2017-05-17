<!-- In PHP check cookies id not there redirect to main page or display not logged in -->
<!--
<html>
	<head>
		<title>BJS Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
        <script src="js/css.js" type="text/javascript"></script>
	</head>

	<body>
        <nav class="w3-bar">
            <?php
//                if (!isset($_SESSION['usertype'])) {
//                    echo "<a class='w3-bar-item w3-button w3-hover-blue-grey' href='index.php'>Home</a>";
//                }
//                else{
//                    if ($_SESSION['usertype'] == "A") {
//                        echo "<a class='w3-bar-item w3-button w3-hover-blue-grey' href='admin_home.php'>Home</a>";
//                    }
//                    if ($_SESSION['usertype'] == "S") {
//                        echo "<a class='w3-bar-item w3-button w3-hover-blue-grey' href='student_home.php'>Home</a>";
//                    }
//                    if ($_SESSION['usertype'] == "F") {
//                        echo "<a class='w3-bar-item w3-button w3-hover-blue-grey' href='faculty_home.php'>Home</a>";
//                    }
//                    if ($_SESSION['usertype'] == "R") {
//                        echo "<a class='w3-bar-item w3-button w3-hover-blue-grey' href='research_home.php'>Home</a>";
//                    }
//                }
            ?>

  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="#">Master Schedule</a>
  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="catalog.php">Master Catalog</a>
  			<a class="w3-bar-item w3-button w3-right w3-blue-grey w3-right" href="login.php">Login</a>
		</nav>
-->

<?php
    include("php_functions.php");
    include("header_footer.php");
    session_start();
    htmlheader();
    masterSchedule();
    htmlfooter();
?>
