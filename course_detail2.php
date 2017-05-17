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

        <div class="w3-container w3-center">
        <?php
            $course_id = $_GET['id'];

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
            $sql = "SELECT course.* , b.course_name as 'prereq', prerequisites.prereq_id FROM course left join prerequisites on prerequisites.course_id = course.course_id left join course b on prerequisites.prereq_id = b.course_id WHERE course.course_id = $course_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();

                echo "<h1>".$row["course_name"]. "</h1><div class='w3-panel w3-white w3-round-xlarge'><h3>Course Description</h3><p>" . $row["course_description"]. "</p><h4>Credits</h4> <p>" . $row["credits"]. "</p></div><div class='w3-panel w3-white w3-round-xlarge'><h2>Prerequirements</h2><p><a href='course_detail2.php?id=".$row["prereq_id"]."'>".$row["prereq"]."</a>";
                if($result->num_rows > 1){
                    while($row = $result->fetch_assoc()){
                        echo "<br><a href='course_detail2.php?id=".$row["prereq_id"]."'>".$row["prereq"]."</a>";
                    }
                }
                echo "</p></div>";
            }
            $conn->close();
        ?>
        </div>
    </body>
</html>
