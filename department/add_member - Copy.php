<?php
include "../php_functions.php";
session_start();
//
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
else{
    if ($_SESSION['usertype'] != "A") {
        header("Location: index.php");
    }
}

if (isset($_GET['dname'])) {
    $_SESSION['deptName'] = $_GET['dname'];
}

if (isset($_GET['id'])) {
    $_SESSION['deptID'] = $_GET['id'];
}
//search query using username as condition to get the rows for account_type;
?>
<!-- In PHP check cookies id not there redirect to main page or display not logged in -->

<html>
	<head>
		<title>BJS Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
        <script src="../js/css.js" type="text/javascript"></script>
	</head>

	<body>
        <nav class="w3-bar">
			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="../admin_home.php">Home</a>
  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="../schedule.php">Master Schedule</a>
  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="../catalog.php">Master Catalog</a>
  			<a class="w3-bar-item w3-button w3-right w3-red w3-right" href="../signout.php">Sign Out</a>
		</nav>
        <div class="w3-container">
            <h1><?php echo $_SESSION['deptName']; ?></h1>
            <h2>Add Department Members</h2>
            <p>Select a department member to add:</p>

            <form class="w3-container" id="addMemForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <label class="w3-label w3-blue-grey">Select a faculty member to add:</label>
                <select class="w3-select w3-border" name="member">
                    <?php getAllFacultyNotMemb(); ?>
                </select>
                <div>
                    <input class="w3-btn w3-green" type="submit" name="addbutton" value="Add Member" />
                </div>
            </form>
        </div>
        <?php

            if (isset($_POST['addbutton'])) {
                $myaddbutton = trim($_POST['addbutton']);
            } else {
                $myaddbutton = '';
            }

            if ($myaddbutton == 'Add Member') {

                if (isset($_POST['member'])) {
                    $member = trim($_POST['member']);
                } else {
                    $member = '';
                }

                $rtninfo = insertMember($member,$_SESSION['deptID']);

                if ($rtninfo == "NotAdded") {
                    print "<p style='color: red'>Member Not Added</p>";
                } else {
                    $sMember = getFLnameByID($_POST['member']);
                    print "<p style='color: green'>$sMember has been Added!";
                }
            }

        ?>
        <div class="w3-container">
            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:33%;">Member Name</th>
                    <th style="width:33%;">Member Telephone</th>
                    <th style="width:33%;">Member Email</th>
                </tr>
                <?php getAllFacultyMembTable($_SESSION['deptID']) ?>
            </table>
        </div>
    </body>
</html>
