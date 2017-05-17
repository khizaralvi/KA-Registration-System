<?php
include '../header_footer.php';
session_start();
//
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}
else{
    if ($_SESSION['usertype'] != "A") {
        header("Location: ../index.php");
    }
}

if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: ../logout_page.php");
}

htmlheader_root('w3-white');
?>


        <div class="w3-container">
            <h2>Search Student</h2>
            <p>Search for a Student in the input field.</p>

            <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for student name.." id="myInput" onkeyup="filter_table()">
            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:33%;">Student Name</th>
                    <th style="width:33%;">Student Email</th>
                    <th style="width:33%;">Student ID</th>
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
            $sql = "SELECT s.student_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, u.email
                    FROM user u
                    INNER JOIN student s on u.user_id = s.student_id;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td><a href='addAdvToStu.php?id=".$row["student_id"]."&sname=".$row["full_name"]."'>".$row["full_name"]. "</td><td>" .$row["email"]. "</td><td>" .$row["student_id"]. "</td></tr>";
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
