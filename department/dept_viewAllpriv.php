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
            <h2>Departments</h2>
            <p>Search for a departmentin the input field.</p>

            <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for department name.." id="myInput" onkeyup="filter_table()">
            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:25%;">Department Name</th>
                    <th style="width:15%;">Chair Person</th>
                    <th style="width:15%;">Chair Telephone</th>
                    <th style="width:20%;">Chair Email</th>
                    <th style="width:25%;">Academic School</th>
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
            $sql = "SELECT d.dept_name, CONCAT(u.last_name, ', ', u.first_name) AS full_name, u.tel_num, u.email, s.school_name
                    FROM department d
                    LEFT JOIN user u on d.chair_id = u.user_id
                    INNER JOIN school s on d.school_id = s.school_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["dept_name"]. "</td><td>" .$row["full_name"]. "</td><td>" .$row["tel_num"]. "</td><td>" .$row["email"]. "</td><td>" .$row["school_name"]. "</td></tr>";
                }
            } else {
                $conn->close();
                die("</table></div></body></html>");
            }
            $conn->close();
            die("</table></div></body></html>");
        ?>
