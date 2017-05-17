<?php
include '../header_footer.php';
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
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: index.php");
}

htmlheader_root('w3-white');
?>


        <div class="w3-container w3-center">
        <?php
            global $dept_id;
            global $dept_name;

            $dept_id = $_GET['id'];
            $dept_name = '';

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
            $sql = "SELECT d.dept_id, d.dept_name, u.first_name, u.last_name, u.tel_num, u.email, s.school_name
                    FROM department d
                    LEFT JOIN user u on d.chair_id = u.user_id
                    INNER JOIN school s on d.school_id = s.school_id
                    WHERE d.dept_id = ".$dept_id;

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();

                $dept_name = $row["dept_name"];
                $full_name = (empty($row["last_name"]) ? "&lt;Not Assigned&gt;" : $row["last_name"]. ", " .$row["first_name"]);

                echo "<h1>$dept_name</h1><div class='w3-panel w3-white w3-round-xlarge'><h3>Chair Person: $full_name</h3><h4>School Name: " . $row["school_name"]. "</h4></div>";
            } else {
                $conn->close();

            }
            $conn->close();
        ?>
        </div>
        <div class="w3-container w3-center">
            <table class="w3-table-all w3-margin-top w3-center" style="margin-left:auto; margin-right:auto; width:800px;" id="myTable">
                <tr colspan="3"><h2>Department Members</h2></tr>
                <tr>
                    <th style="width:33%;">Name</th>
                    <th style="width:33%;">Telephone</th>
                    <th style="width:33%;">Email</th>

                </tr>
                <?php getAllFacultyMembTable($_GET['id']); ?>
            </table>

        </div>


        <div class="w3-panel w3-center w3-margin w3-white w3-padding w3-round-xlarge">
            <?php echo "<a class='w3-btn w3-blue-gray' href='delete_dept.php?id=$dept_id' onclick='return confirm(\"Are you sure you want to apply the changes?\")'>Delete Department</a>"; ?>
            <?php echo "<a class='w3-btn w3-blue-gray' href='edit_dept.php?id=$dept_id'>Edit Department</a>"; ?>
            <?php echo "<a class='w3-btn w3-blue-gray' href='add_member.php?id=$dept_id&dname=$dept_name'>Add Department Member</a>"; ?>
            <?php echo "<a class='w3-btn w3-blue-gray' href='delete_member.php?id=$dept_id&dname=$dept_name'>Remove Department Member</a>"; ?>
<!--            <a class="w3-btn w3-blue-gray">Edit Course</a>-->
<!--            <button class="w3-btn w3-blue-gray">Archive</button> -->
        </div>

</div>

<?php
htmlfooter();
?>