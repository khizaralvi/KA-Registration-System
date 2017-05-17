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
            <?php
                if (!isset($_SESSION['usertype'])) {
                    echo "<a class='w3-bar-item w3-button w3-hover-blue-grey' href='index.php'>Home</a>";
                }
                else{
                    if ($_SESSION['usertype'] == "A") {
                        echo "<a class='w3-bar-item w3-button w3-hover-blue-grey' href='admin_home.php'>Home</a>";
                    }
                    if ($_SESSION['usertype'] == "S") {
                        echo "<a class='w3-bar-item w3-button w3-hover-blue-grey' href='student_home.php'>Home</a>";
                    }
                    if ($_SESSION['usertype'] == "F") {
                        echo "<a class='w3-bar-item w3-button w3-hover-blue-grey' href='faculty_home.php'>Home</a>";
                    }
                    if ($_SESSION['usertype'] == "R") {
                        echo "<a class='w3-bar-item w3-button w3-hover-blue-grey' href='research_home.php'>Home</a>";
                    }
                }
            ?>

  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="../schedule.php">Master Schedule</a>
  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="../catalog.php">Master Catalog</a>
  			<a class="w3-bar-item w3-button w3-right w3-blue-grey w3-right" href="../login.php">Login</a>
		</nav>

        <div class="w3-container">
            <h2>Student Advisors</h2>
            <br />

            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:15%;">Advisor name</th>
                    <th style="width:15%;">Advisor Telephone</th>
                    <th style="width:20%;">Advisor Email</th>
                </tr>
        <?php
            include '../php_functions.php';
            // Create connection
            $conn = mysqlConnect();

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            //load page here
            $sql = "SELECT DISTINCT CONCAT(u.last_name, ', ', u.first_name) AS full_name, u.tel_num, u.email
                    FROM user u
                    INNER JOIN student_advisor sa on u.user_id = sa.faculty_id;";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["full_name"]. "</td><td>" .$row["tel_num"]. "</td><td>" .$row["email"]. "</td></tr>";
                }
            } else {
                $conn->close();
                die("</table></div></body></html>");
            }
            $conn->close();
            die("</table></div></body></html>");
        ?>
