<?php
include '../header_footer.php';
include '../php_functions.php';

session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
    header("Location: index.php");
}

if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
}

htmlheader_root('w3-white');
?>


    <div class = "w3-container">
    <h2> Edit Degree </h2>
    </div>


<?php
if (isset($_GET['degree'])) {
$_SESSION['degree_id'] = $_GET['degree'];
$degree_id = $_SESSION['degree_id'];
$conn = mysqlConnect();
$sql = "SELECT degree_name, degree_short, degree_type FROM degree WHERE degree_id = $degree_id";

if($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
                    $degreeName = $row[0];
                    $degreeShort= $row[1];
                    $degreeType = $row[2];
}

}
else {
    //die('Invalid query: ' . mysql_error());
    echo "<div class = 'w3-container'>
                <span style = 'font-size:130%; color: #CD2627'> Invalid Query </span>
                </div>";
}

}


if (isset($_POST['update']) && isset($_POST['degree_name']) && isset($_POST['degree_short']) && isset($_POST['degree_type'])) {
    $degree_id = $_SESSION['degree_id'];
    $degreeName = $_POST['degree_name'];
    $degreeShort = $_POST['degree_short'];
    $degreeType = $_POST['degree_type'];

        $conn = mySqlConnect();
        $sqlUpdate = "UPDATE degree SET degree_name = '$degreeName', degree_short = '$degreeShort', degree_type = '$degreeType' WHERE degree_id = $degree_id";
        if (mysqli_query($conn, $sqlUpdate)) {
            echo "<div class='w3-container w3-pale-green'>
                <h3>Success</h3>
                <p>Degree updated successfully.</p>
            </div>";
        }
        else {
            echo "<div class='w3-container w3-red'>
                <p>Could not update degree.</p>
            </div>";
            echo mysqli_error($conn);
        }

}

if (isset($_POST['delete'])) {
    $degree_id = $_SESSION['degree_id'];
    $conn = mySqlConnect();
    $sqlDelete = "DELETE FROM degree WHERE degree_id = $degree_id";
    if (mysqli_query($conn, $sqlDelete)) {
        echo "<div class='w3-container w3-yellow'>
            <h3>Success</h3>
            <p>Degree deleted successfully.</p>
        </div>";
    }
    else {
        echo "<div class='w3-container w3-red'>
            <p>Could not delete degree.</p>
        </div>";
        echo mysqli_error($conn);
    }


}


?>

    <div id = "errorMsg" class = "w3-container">
      <p></p>
    </div>

    <form class="w3-container" action = "?" method = "post" id = "degreeForm" onsubmit = "validateEmptyFields();" style="max-width:550px">
        <div class="w3-section">

            <label ><b>Degree Name</b></label><br>
            <input class = "w3-input w3-round signup w3-padding-medium" type = "text" id = "degree_name" name = "degree_name" maxlength="255" value = "<?php echo isset($degreeName) ? $degreeName : ''?>"> <br>

            <label><b>Degree Short</b></label><br>
            <input class = "w3-input w3-round signup w3-padding-medium" type = "text" id = "degree_short" name = "degree_short" maxlength="10" value = "<?php echo isset($degreeShort) ? $degreeShort : ''?>"> <br>

            <label><b>Degree Type</b></label><br>
            <input class = "w3-input w3-round signup w3-padding-medium" type = "text" id = "degree_type" name = "degree_type" maxlength="50" value = "<?php echo isset($degreeType) ? $degreeType : ''?>">

            <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "update" value = "Update Degree" onclick = "return confirm('Are you sure you want to update the degree?');">
            <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "delete" value = "Delete Degree" onclick = "return confirm('Are you sure you want to delete the degree?');">

        </div>
    </form>

</div>

<?php
htmlfooter();
unset($_SESSION['message']);
?>
