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
            <h2>Delete Department Members</h2>
            <p>Select department members to delete:</p>

            <form class="w3-container" id="delMemForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <label class="w3-label w3-blue-grey">Select department faculty member to delete:</label>
                <table class="w3-table-all w3-margin-top" id="myTable">
                        <tr>
                            <th style="width:10%;">Select Member</th>
                            <th style="width:30%;">Member Name</th>
                            <th style="width:30%;">Member Telephone</th>
                            <th style="width:30%;">Member Email</th>
                        </tr>
                    <?php getAllFacultyMembCheckbox($_SESSION['deptID']); ?>
                </table>
                <div>
                    <input class="w3-btn w3-green" type="submit" name="delbutton" value="Delete Member" />
                </div>
            </form>
        </div>
        <?php

            if (isset($_POST['delbutton'])) {
                $myaddbutton = trim($_POST['delbutton']);
            } else {
                $myaddbutton = '';
            }

            if ($myaddbutton == 'Delete Member') {

                if (isset($_POST['member'])) {
                    $member = trim($_POST['member']);
                } else {
                    $member = '';
                }

                $memText = '';

                if(!empty($_POST['memberlist'])) {
                    $memDeptID = $_SESSION['deptID'];
                    $memListLength = count($_POST['memberlist']);
                    $count = 0;

                    foreach($_POST['memberlist'] as $mem_id) {
                        $memText .= "$mem_id";
                        $count++;

                        if($count<$memListLength){ $memText .= ","; }
                    }
                }

                $rtninfo = deleteMemberArray($memText);

                if ($rtninfo == "NotDeleted") {
                    print "<p style='color: red'>Member Not Added</p>";
                } else {
//                    $sMember = getFLnameByID($_POST['member']);
                    print "<p style='color: green'>Member has been Deleted!";
                }
            }

        ?>
<!--        <div class="w3-container">
            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:33%;">Member Name</th>
                    <th style="width:33%;">Member Telephone</th>
                    <th style="width:33%;">Member Email</th>
                </tr>
                <?php getAllFacultyMembTable($_SESSION['deptID']); ?>
            </table>
        </div>  -->
    </body>
</html>
