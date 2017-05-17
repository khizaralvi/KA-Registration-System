<?php
session_start();

if (!isset($_SESSION['username']) && !$_SESSION['usertype'] = "A") {
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
    <span> Signed in as <?php echo $_SESSION['username']?> </span>
</div>

	<body>
        <nav class="w3-bar w3-white">
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="admin_home.php">Home</a>
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="schedule.php">Master Schedule</a>
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="catalog.php">Master Catalog</a>
        <!-- Clear cookie and redirect to main page -->
        <form action = "?" method = "post">                 <input type = "submit" name = "signout" class="w3-bar-item w3-button w3-right w3-red" value = "Sign Out">             </form>
        <div class="w3-dropdown-hover w3-right">
            <button class="w3-button"><?php echo $_SESSION['firstname']; ?></button>
            <div class="w3-dropdown-content w3-bar-block w3-border">
                <a href="personal_info.php" class="w3-bar-item w3-button">Account</a>
                <a href="#" class="w3-bar-item w3-button">Link 2</a>
                <a href="#" class="w3-bar-item w3-button">Link 3</a>
            </div>
         </div>
    </nav>

    <div class = "w3-container">
    <h2> Search User Account </h2>
    <p> Select the user account category to search </p>
    </div>

    <form class="w3-container" action = "?" method = "post" id = "loginForm">
    <div class="w3-section">
        <select name="usertype">
        <option value="administrator">Admin</option>
        <option value="student">Student</option>
        <option value="faculty">Faculty</option>
        <option value="research">Research</option>
        </select> <br>
        <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Go">
    </div>
    </form>
   
	</body>
</html>

<?php
    if(isset($_POST['usertype'])) {
        $_SESSION['user_category'] = $_POST['usertype'];
        header("Location: search_account_2.php");
    }
?>

