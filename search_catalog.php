<?php
include 'header_footer.php';
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

htmlheader('w3-white');

//search query using username as condition to get the rows for account_type;
?>
<!-- In PHP check cookies id not there redirect to main page or display not logged in -->


        <div class="w3-container">
            <h2>Courses</h2>
            <p>Search for a course in the input field.</p>
            <p>Click on a course name to view details, edit, add Prereq., add Section, archive, or delete it.</p>

            <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for course name.." id="myInput" onkeyup="filter_table()">
            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:10%;">Course Name</th>
                    <th style="width:20%;">Course Category</th>
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
                    echo "<tr><td><a href='course_detail.php?id=".$row["course_id"]."'>".$row["course_name"]. "</a></td><td>" . $row["course_category"]. "</td><td>" . $row["course_description"]. "</td><td>" . $row["credits"]. "</td></tr>";
                }
            } else {
                $conn->close();
            }
            $conn->close();
        ?>
            </table>

        </div>

     </div>

<?php
htmlfooter();
?>
