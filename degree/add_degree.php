<?php
include '../header_footer.php';
include '../php_functions.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
    header("Location: ../index.php");
}

if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: ../logout_page.php");
}



if (isset($_POST['submit'])) {
    $degreeName = $_POST['degree_name'];
    $degreeShort = $_POST['degree_short'];
    $degreeType = $_POST['degree_type'];

    $conn = mysqlConnect();
    $sql = "INSERT INTO degree (degree_name, degree_short, degree_type) VALUES ('$degreeName', '$degreeShort', '$degreeType')";
    if (mysqli_query($conn, $sql)) {
        //header('location: add_degree.php');
        $_SESSION['message'] = "<div class='w3-container w3-pale-green'>
                                <h3>Success</h3>
                                <p>Degree Created Successfully.</p>
                                </div>";
       header('location: add_degree.php');
       exit();
    }
    else {
        $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Could Not Create Degree</p>
                                </div>" . mysqli_error($conn);
    }
   // $_SESSION['message'] = $message;
    mysqli_close($conn);
}

htmlheader_root('w3-white');

?>


 <br>
    <div id = "errorMsg" class = "w3-container">
      <p></p>
    </div>

    <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>
    <?php echo isset($message) ? $message : ''?>

        <h1 style="margin-left: 15px;">Add Degree</h1>

        <form class="w3-container" action = "?" method = "post" id = "degreeForm" onsubmit = "validateEmptyFields();">
            <div class="w3-section">
                <label ><b>Degree Name</b></label><br>
                <input class = "w3-input w3-round signup w3-padding-medium" type = "text" id = "degree_name" name = "degree_name" maxlength="255"> <br>

                <label><b>Degree Short</b></label><br>
                <input class = "w3-input w3-round signup w3-padding-medium" type = "text" id = "degree_short" name = "degree_short" maxlength="10"> <br>

                <label><b>Degree Type</b></label><br>
                <input class = "w3-input w3-round signup w3-padding-medium" type = "text" id = "degree_type" name = "degree_type" maxlength="50">

                <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Submit">
            </div>
        </form>

</div>

<?php
htmlfooter();
unset($_SESSION['message']);
?>
