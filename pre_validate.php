<?php
session_start();
//
include('php_functions.php');
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
else{
    if ($_SESSION['usertype'] != "A") {
        header("Location: index.php");
    }
}
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: index.php");
}

//search query using username as condition to get the rows for account_type;
?>
<!doctype html>
<html>
	<head>
		<title>BJK Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
	</head>

	<body class="w3-blue-grey">
        <nav class="w3-bar w3-white">
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="admin_home.php">Home</a>
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="schedule.php">Master Schedule</a>
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="catalog.php">Master Catalog</a>
            <!-- Clear cookie and redirect to main page -->
            <form action = "?" method = "post">
                <input type = "submit" name = "signout" class="w3-bar-item w3-button w3-right w3-red" value = "Sign Out">
            </form>
        </nav>

        <div>
            <?php
                addPrereq($_POST['master_id'],$_POST['pre_req_id']);
            ?>
        </div>

    </body>
</html>
