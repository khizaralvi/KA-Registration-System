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

htmlheader_root('w3-white');
?>

        <div class="w3-container">
            <h2>Search Department</h2>
            <p>Search for a department in the input field.</p>

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
            $sql = "SELECT d.dept_id, d.dept_name, CONCAT(u.last_name, ', ', u.first_name) AS full_name, u.tel_num, u.email, s.school_name
                    FROM department d
                    LEFT JOIN user u on d.chair_id = u.user_id
                    INNER JOIN school s on d.school_id = s.school_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td><a href='dept_detail.php?id=".$row["dept_id"]."'>".$row["dept_name"]. "</a></td><td>" .$row["full_name"]. "</td><td>" .$row["tel_num"]. "</td><td>" .$row["email"]. "</td><td>" .$row["school_name"]. "</td></tr>";
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