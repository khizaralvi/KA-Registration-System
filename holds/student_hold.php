<?php
include '../header_footer.php';
include "../php_functions.php";
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

if (isset($_GET['sname'])) {
    $_SESSION['stuName'] = $_GET['sname'];
}

if (isset($_GET['id'])) {
    $_SESSION['stuID'] = $_GET['id'];
}

if (isset($_POST['addholdbutton'])) {
    $holdID = $_POST['hold'];

    $conn = mysqlConnect();
    $sql = "INSERT INTO student_hold (hold_id, student_id) VALUES ($holdID, ".$_SESSION['stuID'].")";
    if (mysqli_query($conn, $sql)) {
        //header('location: add_degree.php');
        $_SESSION['message'] = "<div class='w3-container w3-pale-green' id='messageAlert'>
                                <h3>Success</h3>
                                <p>Hold Created Successfully.</p>
                                </div>";
       header("Location: student_hold.php");
       exit();
    }
    else {
        $message = "<div class='w3-container w3-red' id='messageAlert'>
                                <h3>Failed</h3>
                                 <p>Could Not Create Degree</p>
                                </div>" . mysqli_error($conn);
    }
   // $_SESSION['message'] = $message;
    mysqli_close($conn);
}

if (isset($_POST['delholdbutton'])) {
    $holdid = $_POST['hold_id'];

    $conn = mysqlConnect();
    $sql = "DELETE FROM student_hold
            WHERE hold_id=$holdid
            AND student_id=".$_SESSION['stuID'].";";

    if (mysqli_query($conn, $sql)) {
        //header('location: add_degree.php');
        $_SESSION['message'] = "<div class='w3-container w3-pale-green' id='messageAlert'>
                                <h3>Success</h3>
                                <p>Hold Successfully Deleted.</p>
                                </div>";
       header("Location: student_hold.php");
       exit();
    }
    else {
        $message = "<div class='w3-container w3-red' id='messageAlert' >
                                <h3>Failed</h3>
                                 <p>Could Not Delete the Hold</p>
                                </div>" . mysqli_error($conn);
    }
   // $_SESSION['message'] = $message;
    mysqli_close($conn);
}

function getAllStuHoldsSelect(){
    $conn = connectToHost();
//CHANGE HOLDS
    $sql  = "SELECT h.hold_id, h.hold_name
             FROM hold h
             LEFT JOIN
                (SELECT hold_id, student_id
                 FROM student_hold
                 WHERE student_id = ".$_SESSION['stuID'].") sh
             ON h.hold_id = sh.hold_id
             WHERE sh.hold_id IS NULL
             ORDER BY h.hold_name;";

    $result = runSQL($conn,$sql);

    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["hold_id"]. "'>" .$row["hold_name"]. "</option>";
        }
    } else {
        echo "<option value='NULL' disabled>-- No holds to apply --</option>";
    }

    $conn->close();
}

function getAllStuHoldsRadioBut(){
    $conn = connectToHost();

    $sql  = "SELECT * FROM hold h
             INNER JOIN student_hold sh ON h.hold_id = sh.hold_id
             WHERE sh.student_id = ".$_SESSION['stuID'].";";

    $result = runSQL($conn,$sql);

    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='radio' name='hold_id' value=" .$row["hold_id"]. "></td><td>" .$row["hold_name"]. "</td><td>" .$row["hold_desc"]. "</td></tr>";
        }
    }else{
        echo "<tr><td></td><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
    }

    $conn->close();
}
htmlheader_root('w3-white');
?>

        <div class="w3-container">
            <h1>View/Apply/Remove Student Holds</h1>
            <h2><?php echo "Student Name: " .$_SESSION['stuName'];
                echo "<br> Student ID: " .$_SESSION['stuID']; ?>
            </h2>
            <br>
            <h3>Apply hold to student:</h3>

            <form class="w3-container" id="addHoldForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <label class="w3-label w3-white">Select a hold to apply:</label>
                <select class="w3-select w3-border" name="hold">
                    <?php getAllStuHoldsSelect(); ?>
                </select>
                <div>
                    <input class="w3-btn w3-green" type="submit" name="addholdbutton" value="Add Hold" onclick="return confirm('Are you sure you want to add this hold to the student account?')" />
                </div>
            </form>
        </div>

        <div class="w3-container" >
            <h3><b>Current Holds</b></h3>
            <p>To delete a hold, select one and click the "Delete Hold" button.</p>
                 <form class="w3-container" id="delHoldForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                    <div class="w3-section">
                        <table class="w3-table-all w3-margin-top" id="myTable">
                            <tr>
                                <th style="width:10%;">Select Hold</th>
                                <th style="width:30%;">Hold Name</th>
                                <th style="width:60%;">Hold Description</th>
                            </tr>
                            <?php getAllStuHoldsRadioBut(); ?>
                        </table>
                    </div>
                    <div>
                        <input class="w3-btn w3-red" type="submit" name="delholdbutton" value="Delete Hold" onclick="return confirm('Are you sure you want to delete this hold from the student account?')" />
                    </div>
                </form>
        </div>
</div>

<?php
htmlfooter();
?>