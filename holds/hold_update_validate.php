<?php

header('Refresh: 3;url=view_add_delete_hold.php');

include '../php_functions.php';
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
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
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

    <span> Signed in as <?php echo $_SESSION['username']?> </span>

	<body class="w3-white">
        <nav class="w3-bar w3-white">
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="../admin_home.php">Home</a>
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="../schedule.php">Master Schedule</a>
            <a class="w3-bar-item w3-button w3-hover-blue-grey" href="../catalog.php">Master Catalog</a>
        <!-- Clear cookie and redirect to main page -->
            <form action = "?" method = "post">
                <input type = "submit" name = "signout" class="w3-bar-item w3-button w3-right w3-red" value = "Sign Out">
            </form>

            <div class="w3-dropdown-hover w3-right">
                <button class="w3-button"><?php echo $_SESSION['username']; ?></button>
                <div class="w3-dropdown-content w3-bar-block w3-border">
                    <a href="#" class="w3-bar-item w3-button">Account</a>
                    <a href="#" class="w3-bar-item w3-button">Link 2</a>
                    <a href="#" class="w3-bar-item w3-button">Link 3</a>
                </div>
             </div>
        </nav>

        <?php

           $conn = mysqlConnect();

            if (isset($_POST['id'])){
                $hold_id = $_POST['id'];
            }

            if (isset($_POST['name'])){
                $hold_name = $_POST['name'];
            }

            if (isset($_POST['desc'])){
                $hold_desc = $_POST['desc'];
            }

            $sql = "UPDATE hold
                    SET hold_name = '$hold_name', hold_desc = '$hold_desc'
                    WHERE hold_id = $hold_id;";

            if (mysqli_query($conn, $sql)) {
                echo "<h3 class='w3-green'>Hold successfully updated!</h3>";
            } else {
                echo ",h3 class='w3-red'>Error: " . $sql . "</h3><br>" . mysqli_error($conn);
            }

            mysqli_close($conn);

            redirectPageCountDown()
        ?>
<!--
        <script type="text/javascript">
            (function () {
                var timeLeft = 3,
                    cinterval;

                var timeDec = function (){
                    timeLeft--;
                    document.getElementById('countdown').innerHTML = timeLeft;
                    if(timeLeft === 0){
                        clearInterval(cinterval);
                    }
                };

                cinterval = setInterval(timeDec, 1000);
            })();

        </script>
        <br><p><b>Redirecting in <span id="countdown">3</span></b></p>
    -->

	</body>
</html>
