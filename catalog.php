<!-- In PHP check cookies id not there redirect to main page or display not logged in -->
<html>
	<head>
		<title>BJS Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
        <script src="js/css.js" type="text/javascript"></script>
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

  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="schedule.php">Master Schedule</a>
  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="#">Master Catalog</a>
  			<a class="w3-bar-item w3-button w3-right w3-blue-grey w3-right" href="login.php">Login</a>
		</nav>
        <div class="w3-container">
            <h2>Search Courses</h2>
            <p>Search for a course in the input field.</p>

            <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for course name.." id="myInput" onkeyup="filter_table()">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for course category.." id="myInput2" onkeyup="filter_short_name()">
            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:10%;">Course Name</th>
                    <th style="width:20%;">Course Code</th>
                    <th style="width:60%;">Course Description</th>
                    <th style="width:10%;">Course Credits</th>
                </tr>
        <?php
            $servername = "localhost";
            $dbname="id763455_registration_system";
            $username = "id763455_gdengineers";
            $password = "cs5910";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            //load page here
            $sql = "SELECT * FROM course ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td><a href='course_detail2.php?id=".$row["course_id"]."' >".$row["course_name"]. "</a></td><td>" . $row["course_category"]. "</td><td>" . $row["course_description"]. "</td><td>" . $row["credits"]. "</td></tr>";

                }
            } else {
                $conn->close();
                die("</table></div></body></html>");
            }
            $conn->close();
            die("</table></div></body></html>");
        ?>
