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
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: index.php");
}

htmlheader();

//search query using username as condition to get the rows for account_type;
?>


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

                echo "<h1>Course Detials: ".$row["course_name"]. "</h1><div class='w3-panel w3-white w3-round-xlarge'><h3>Course Description</h3><p>" . $row["course_description"]. "</p><h4>Credits</h4> <p>" . $row["credits"]. "</p></div><div class='w3-panel w3-white w3-round-xlarge'><h2>Prerequirements</h2><p><a href='course_detail.php?id=".$row["prereq_id"]."'>".$row["prereq"]."</a></p></div>";
            }
            $conn->close();
        ?>
        </div>

        <div class="w3-panel w3-center w3-margin w3-white w3-padding w3-round-xlarge">
            <?php echo "<a class='w3-btn w3-blue-gray' href='delete_validation.php?id=".$_GET['id']."' onclick='return confirm(\"Are you sure you want to delete this hold from the student account?\")'>Delete Course</a>"; ?>
            <?php echo "<a class='w3-btn w3-blue-gray' href='course_prereq.php?id=".$_GET['id']."'>Add Preq</a>"; ?>
            <?php echo "<a class='w3-btn w3-blue-gray' href='edit_course.php?id=".$_GET['id']."'>Edit Course</a>"; ?>
            <?php echo "<a class='w3-btn w3-blue-gray' href='add_section.php?id=".$_GET['id']."'>Add Section</a>"; ?>
            <button class="w3-btn w3-blue-gray">Archive</button>
        </div>

</div>

<?php
htmlfooter();
?>