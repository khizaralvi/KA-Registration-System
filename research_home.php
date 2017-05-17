<?php
session_start();
include("header_footer.php");
//
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
else{
    if ($_SESSION['usertype'] != "R") {
        header("Location: index.php");
    }
}
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
}
htmlheader();
//search query using username as condition to get the rows for account_type;
?>


<!-- In PHP check cookies id not there redirect to main page or display not logged in -->
<!--
<!doctype html>
<html>
	<head>
		<title>BJK Registration</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">

	</head>

    <span> Signed in as <?php echo $_SESSION['username']?> </span>

	<body class="w3-blue-grey">
        <nav class="w3-bar w3-white">
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="research_home.php">Home</a>
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="schedule.php">Master Schedule</a>
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="catalog.php">Master Catalog</a>
         <!-- Clear cookie and redirect to main page
        <form action = "?" method = "post">
            <input type = "submit" name = "signout" class="w3-bar-item w3-button w3-right w3-red" value = "Sign Out">
        </form>
    </nav>
-->
<div class="w3-display-container w3-center w3-wide image w3-grayscale-min">
  <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-small w3-hide-medium" style = "margin-bottom:40px">
  <h2 class = "w3-xxxlarge">BKJ Registration System</h2>
  <h2 class="w3-xxxlarge">Gupta University</h2>
 </div>
 <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-large" style = "margin-bottom:10px">
    <h2 class="w3-xxlarge w3-hide-large">BKJ Registration System</h2>
    <h2 class="w3-xxlarge w3-hide-large">Gupta University</h2>
  </div>
</div>
    <!-- Cards start -->
    <div class="w3-row-padding w3-margin-top">
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="reports/department_report.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-bar-chart fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Department Report</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="reports/section_report.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-bar-chart fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Course Volume Report</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
    </div>
    <!-- End of Icon buttons -->
	</body>
</html>


