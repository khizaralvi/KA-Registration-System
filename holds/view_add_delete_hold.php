<?php
include '../header_footer.php';
include "../php_functions.php";
session_start();
//
if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
    header("Location: ../index.php");
}

if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: ../logout_page.php");
}

if (isset($_POST['addholdbutton'])) {
    $holdName = $_POST['hold_name'];
    $holdDesc = $_POST['hold_desc'];

    $conn = mysqlConnect();
    $sql = "INSERT INTO hold (hold_name, hold_desc) VALUES ('$holdName', '$holdDesc')";
    if (mysqli_query($conn, $sql)) {
        //header('location: add_degree.php');
        $_SESSION['message'] = "<div class='w3-container w3-pale-green' id='messageAlert'>
                                <h3>Success</h3>
                                <p>Hold Created Successfully.</p>
                                </div>";
       header("Location: view_add_delete_hold.php");
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
    $sql = "DELETE FROM hold WHERE hold_id=$holdid;";
    if (mysqli_query($conn, $sql)) {
        //header('location: add_degree.php');
        $_SESSION['message'] = "<div class='w3-container w3-pale-green' id='messageAlert'>
                                <h3>Success</h3>
                                <p>Hold Successfully Deleted.</p>
                                </div>";
       header("Location: view_add_delete_hold.php");
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

function getAllHoldsRadioBut(){
    $conn = connectToHost();

    $sql  = "SELECT * FROM hold;";

    $result = runSQL($conn,$sql);

    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='radio' name='hold_id' value=" .$row["hold_id"]. "></td><td><a href='edit_hold.php?id=".$row["hold_id"]."&hname=".$row["hold_name"]."'>" .$row["hold_name"]. "</td><td>" .$row["hold_desc"]. "</td></tr>";
        }
    }else{
        echo "<tr><td></td><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
    }

    $conn->close();
}

htmlheader_root('w3-white');
?>

        <br>
        <div id = "errorMsg" class = "w3-container">
          <p></p>
        </div>

        <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '';
            unset($_SESSION['message'])
        ?>
        <?php echo isset($message) ? $message : ''?>

        <div class="w3-container">
            <h1>View/Add/Delete Hold</h1>
            <h2>Add Hold</h2>
            <p>Enter the details of a new hold type in the input fields below, then click the "Add Hold" button:</p>

            <form class="w3-container" id="addHoldForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <div class="w3-section">
                    <label ><b>Hold Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" id = "hold_name" name = "hold_name" maxlength="100"> <br>

                    <label><b>Hold Description</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" id = "hold_desc" name = "hold_desc" maxlength="255"> <br>

                    <input class="w3-btn w3-green w3-section" type="submit" name = "addholdbutton" value = "Add Hold" onclick="validateEmptyFields();">
                </div>
                <h2>Delete or View Hold</h2>
                <p>To EDIT a hold, click on the hold's name.</p>
                <p>To DELETE a hold, select one and click the "Delete Hold" button.</p>
                <form class="w3-container" id="delHoldForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                    <div class="w3-section">
                         <table class="w3-table-all w3-margin-top" id="myTable">
                            <tr>
                                <th style="width:10%;">Select Hold</th>
                                <th style="width:30%;">Hold Name</th>
                                <th style="width:60%;">Hold Description</th>
                            </tr>
                            <?php getAllHoldsRadioBut(); ?>
                        </table>
                    </div>
                    <div>
                        <input class="w3-btn w3-red" type="submit" name="delholdbutton" value="Delete Hold" onclick="return confirm('Are you sure you want to delete this hold?')" />
                    </div>
                </form>
            </form>
        </div>

<?php
htmlfooter();
?>
