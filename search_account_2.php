<?php
include 'php_functions.php';

session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
    header("Location: index.php");
}
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
}
?>

<!-- In PHP check cookies id not there redirect to main page or display not logged in -->
<!doctype html>
<html>
	<head>
		<title>BJK Registration</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">

	</head>

<div class="w3-container">
    <span> Signed in as <?php
echo $_SESSION['username'] ?> </span>
</div>

	<body>
        <nav class="w3-bar w3-white">
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="admin_home.php">Home</a>
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="schedule.php">Master Schedule</a>
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="catalog.php">Master Catalog</a>
        <!-- Clear cookie and redirect to main page -->
        <form action = "?" method = "post">                 <input type = "submit" name = "signout" class="w3-bar-item w3-button w3-right w3-red" value = "Sign Out">             </form>
        <div class="w3-dropdown-hover w3-right">
            <button class="w3-button"><?php
echo $_SESSION['firstname']; ?></button>
            <div class="w3-dropdown-content w3-bar-block w3-border">
                <a href="personal_info.php" class="w3-bar-item w3-button">Account</a>
                <a href="#" class="w3-bar-item w3-button">Link 2</a>
                <a href="#" class="w3-bar-item w3-button">Link 3</a>
            </div>
         </div>
    </nav>

    <div class = "w3-container">
    <h2> Search <?php
echo ucfirst($_SESSION['user_category']) ?> Account </h2>
    </div>



    <?php
?>

    <?php

if (isset($_SESSION['user_category']) && $_SESSION['user_category'] == "administrator") {
?>
            <div class="w3-container">
                             <form action = "?" method = "post">
                                <input class = "w3-round login w3-padding-medium" type = "number" placeholder="Search By User ID" id = "search_user_ID" name = "search_user_ID">
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By First Name" id = "search_first_name" name = "search_first_name">  
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By Last Name" id = "search_last_name" name = "search_last_name"> <br />
                                <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Search User">
                            </form>
                            <?php
	                        echo isset($errorMsg) ? $errorMsg : '';
                            ?>
                            </div>
 <?php
	if (isset($_POST['submit'])) {
		$user_id = $_POST['search_user_ID'];
		$first_name = $_POST['search_first_name'];
		$last_name = $_POST['search_last_name'];
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

		searchAccount($searchFields, 'admin');
	}
}
else
if (isset($_SESSION['user_category']) && $_SESSION['user_category'] == "research") {
?>
            <div class="w3-container">
                             <form action = "?" method = "post">
                                <input class = "w3-round login w3-padding-medium" type = "number" placeholder="Search By User ID" id = "search_user_ID" name = "search_user_ID">
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By First Name" id = "search_first_name" name = "search_first_name">  
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By Last Name" id = "search_last_name" name = "search_last_name"> <br />
                                <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Search User">
                            </form>
                            <?php
	                        echo isset($errorMsg) ? $errorMsg : '';
                            ?>
                            </div>
 <?php
	if (isset($_POST['submit'])) {
		$user_id = $_POST['search_user_ID'];
		$first_name = $_POST['search_first_name'];
		$last_name = $_POST['search_last_name'];
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

		searchAccount($searchFields, 'research');
	}
}
else
if (isset($_SESSION['user_category']) && $_SESSION['user_category'] == "student") {
?>
            <div class="w3-container">
                             <form action = "?" method = "post">
                                <input class = "w3-round login w3-padding-medium" type = "number" placeholder="Search By Student ID" id = "search_user_ID" name = "search_user_ID">
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By First Name" id = "search_first_name" name = "search_first_name">  
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By Last Name" id = "search_last_name" name = "search_last_name"> <br />
                                <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Search User">
                            </form>
                            <?php

	// echo isset($resultTable) ? $resultTable : '';

?>
                            </div>
 <?php
	if (isset($_POST['submit'])) {
		$user_id = $_POST['search_user_ID'];
		$first_name = $_POST['search_first_name'];
		$last_name = $_POST['search_last_name'];
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

		searchAccount($searchFields, "student");
	}
}
else
if (isset($_SESSION['user_category']) && $_SESSION['user_category'] == "faculty") {
?>
            <div class="w3-container">
                             <form action = "?" method = "post">
                                <input class = "w3-round login w3-padding-medium" type = "number" placeholder="Search By Faculty ID" id = "search_user_ID" name = "search_user_ID">
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By First Name" id = "search_first_name" name = "search_first_name">  
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By Last Name" id = "search_last_name" name = "search_last_name"> <br />
                                <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Search User">
                            </form>
                            <?php

	// echo isset($resultTable) ? $resultTable : '';

?>
                            </div>
 <?php
	if (isset($_POST['submit'])) {
		$user_id = $_POST['search_user_ID'];
		$first_name = $_POST['search_first_name'];
		$last_name = $_POST['search_last_name'];
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

		searchAccount($searchFields, "faculty");
	}
}

?>
   
	</body>
</html>
