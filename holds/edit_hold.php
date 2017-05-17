<?php
include "../php_functions.php";
session_start();
//
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

<html>
	<head>
		<title>BJS Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
        <script src="../js/css.js" type="text/javascript"></script>
        <script src="../js/functions.js" type="text/javascript"></script>
	</head>

	<body>
        <nav class="w3-bar">
			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="../admin_home.php">Home</a>
  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="../schedule.php">Master Schedule</a>
  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="../catalog.php">Master Catalog</a>
  			<a class="w3-bar-item w3-button w3-right w3-red w3-right" href="../signout.php">Sign Out</a>
		</nav>

         <?php


        $conn = connectToHost();

        $hold_id = $_GET['id'];
        $sql = "SELECT *
                FROM hold
                WHERE hold_id = ".$hold_id;

        $result = runSQL($conn,$sql);

        if($result){
            $row = $result->fetch_assoc();
            echo "
                <h1>Edit Hold</h1>
                <form class='w3-container' action = 'hold_update_validate.php' method = 'post'>
                <input type='hidden' name='id' value='" .$row['hold_id']. "'>

                <h3>Hold Name: </h3>
                <input class='w3-input' type='text' name='name' value='".$row['hold_name']."'>

                <h3>Hold Description: </h3>
                <input class='w3-input' type='text' name='desc' value='".$row['hold_desc']."'>

                <button class='w3-btn w3-green' type='submit'>Update</button>
                <a class='w3-btn w3-green' href='view_add_delete_hold.php'>cancel</a>
                </div>
                </form>";
        }else{
            echo "Failed:". mysqli_error($conn);
        }

        $conn->close();
    ?>

    </body>
</html>
