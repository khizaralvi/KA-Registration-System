<?php
include '../header_footer.php';
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
  header("Location: ../logout_page.php");
}
htmlheader_root('w3-white');
?>

    <h1 style="margin-left:15px">Edit Depeartment</h1><br>

    <?php

        include "../php_functions.php";
        $conn = connectToHost();

        $dept_id = $_GET['id'];
        $sql = "SELECT d.dept_id, d.dept_name, d.chair_id, u.first_name, u.last_name, u.tel_num, u.email, s.school_id, s.school_name
                FROM department d
                LEFT JOIN user u on d.chair_id = u.user_id
                INNER JOIN school s on d.school_id = s.school_id
                WHERE d.dept_id = ".$dept_id;

        $result = runSQL($conn,$sql);

        if($result){
            $row = $result->fetch_assoc();
            echo "<form class='w3-container' action = 'dept_update_validate.php' method = 'post'>
                <input type='hidden' name='id' value='" .$row['dept_id']. "'>

                <label class='w3-label w3-white'><b>Department Name: </b></label>
                <input class='w3-input' type='text' name='dept' value='".$row['dept_name']."'>
                <br>
                <label class='w3-label w3-white'><b>Department Chair: </b></label>
                <select class='w3-select w3-border' name='chair'>";
                getAllFacultySelect($row['chair_id']);
            echo "</select>
                <br><br>
                <label class='w3-label w3-white'><b>Department School:</b></label>
                <select class='w3-select w3-border' name='school'>";
                getAllSchoolsSelect($row['school_id']);
            echo "</select>
                <br><br>
                <button class='w3-btn w3-green' type='submit' onclick='return confirm(\"Are you sure you want to apply the changes?\")'>Update</button>
                <a class='w3-btn w3-green' href='admin_home.php'>cancel</a>
                </div>
                </form>";
        }else{
            echo "Failed:". mysqli_error($conn);
        }

        $conn->close();
    ?>
    <div>
    </div>

</div>

<?php
htmlfooter();
?>

