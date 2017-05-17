<?php
include 'header_footer.php';
include 'php_functions.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
}



$conn = mysqlConnect();
$username = $_SESSION['username'];
$sql = "Select first_name, last_name, date_of_birth, email, tel_num, password from user WHERE username = '$username'";
if ($result = mysqli_query($conn, $sql)) {
  while ($row = mysqli_fetch_array($result)) {
    $firstname = $row['first_name'];
    $lastname = $row['last_name'];
    $fullname = $firstname . ' ' . $lastname;
    $dob = $row['date_of_birth'];
    $email = $row['email'];
    $number = $row['tel_num'];
    $password = $row['password'];
  }
}
else {
  $message = "<br> <div class='w3-container w3-red'>
              <p>Couldn't connect to database.</p>
              </div>";
}
mysqli_close($conn);
$passlength = strlen($password);


if (isset($_POST['changeInfo'])) {
  $conn = mysqlConnect();
  $updatedFirstname = $_POST['first_name'];
  $updatedLastname = $_POST['last_name'];
  $updatedDob = date("Y-m-d", strtotime($_POST['date_of_birth'])); 
  $updatedNumber = $_POST['number'];
  $sql = "UPDATE user SET first_name = '$updatedFirstname', last_name = '$updatedLastname', date_of_birth = '$updatedDob',
  tel_num = '$updatedNumber' WHERE username = '$username'";
  if (mysqli_query($conn, $sql)) {
    $_SESSION['message'] = "<br> <div class='w3-container w3-pale-green'>
              <p>Information Updated Successfully</p>
              </div>";
    header("location: personal_info.php");
    exit();
}
else {
  $message = "<br> <div class='w3-container w3-red'>
              <p>Couldn't Update Information</p>
              </div>";
}
mysqli_close($conn);
}

if (isset($_POST['changePassword'])) {
  $conn = mysqlConnect();
  $updatedPass = $_POST['password'];
  $sql = "UPDATE user SET password = '$updatedPass' WHERE username = '$username'";
  if (mysqli_query($conn, $sql)) {
    header("personal_info.php");
    $message = "<br> <div class='w3-container w3-pale-green'>
              <p>Password Updated Successfully</p>
              </div>";
    
}
else {
  $message = "<br> <div class='w3-container w3-red'>
              <p>Couldn't Change Password</p>
              </div>";
}
mysqli_close($conn);
}

htmlheader('w3-white');


?>





   <div class = "w3-container w3-mobile">
    <h3> Your Account </h3> 
   
   <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>
   <?php echo isset($message) ? $message : ''?>

    <ul class="w3-ul">
  <li><h3>Personal Info</h3></li> 
  <li> <?php echo $fullname?> </li>
  <li><?php echo $dob?></li>
  <li><?php echo $number?></li>
  <li><button class="w3-button w3-blue-grey" onclick="document.getElementById('id01').style.display='block'">Update</button> </li>
</ul>
    <ul class="w3-ul">
    <li><h3>Email</h3></li>
  <li><?php echo $email?></li>
</ul>
    <ul class="w3-ul">
    <li><h3>Password</h3></li>
  <li><?php echo str_repeat("*", $passlength)?></li>
  <li><button class="w3-button w3-blue-grey" onclick="document.getElementById('id02').style.display='block'">Change</button> </li>
</ul>
    </div>



  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:450px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <div class="w3-center"><br>
        <h3> Update Personal Information</h3>
      </div>
      <hr>
        <div class="w3-section">
        <form class="w3-container" id = "changeInfo" method = "post" action="?" onSubmit = "validate();">
          <label><b>First Name</b></label>
          <input class="w3-input signup <?php echo $_SESSION['usertype'] != 'A' ? 'w3-light-grey' : '' ?>" type="text" placeholder="Enter First Name" id = "first_name" name = "first_name" onchange = "validateFirstName(this.value);" value = "<?php echo $firstname ?>" <?php echo isset($error_firstname_css) ? 'style="'. $error_firstname_css .'"' : '' ?>
          <?php echo $_SESSION['usertype'] != 'A' ? 'readonly' : '' ?>>
          <span class = "errormsg" id="errorFirstName" style = "font-size:90%; color: #CD2627"> <?php echo isset($errorFirstName) ? $errorFirstName : '' ?></span> <br> 
          <label><b>Last Name</b></label>
          <input class="w3-input signup <?php echo $_SESSION['usertype'] != 'A' ? 'w3-light-grey' : '' ?>" type="text" placeholder="Enter Last Name" id = "last_name" name = "last_name" onchange = "validateLastName(this.value);" value = "<?php echo $lastname ?>" <?php echo isset($error_lastname_css) ? 'style="'. $error_lastname_css .'"' : '' ?>
          <?php echo $_SESSION['usertype'] != 'A' ? 'readonly' : '' ?>>
          <span class = "errormsg" id="errorLastName" style = "font-size:90%; color: #CD2627"> <?php echo isset($errorLastName) ? $errorLastName : '' ?></span> <br>
          <label><b>Date Of Birth</b></label>
          <input class="w3-input signup <?php echo $_SESSION['usertype'] != 'A' ? 'w3-light-grey' : '' ?>" type="date" placeholder="Enter dob" id = "date_of_birth" name = "date_of_birth" value = "<?php echo $dob ?>" <?php echo isset($error_dob_css) ? 'style="'. $error_dob_css .'"' : ''?>
          <?php echo $_SESSION['usertype'] != 'A' ? 'readonly' : '' ?>>
          <span class = "errormsg" id="errorDateOfBirth" style = "font-size:90%; color: #CD2627"> <?php echo isset($errorDateOfBirth) ? $errorDateOfBirth : ''?></span> <br> 
          <label><b>Phone Number</b></label>
          <input class="w3-input signup" type="text" placeholder="Enter Phone Number" id = "number" name = "number" onchange = "validateNumber(this.value);" value = "<?php echo $number ?>" <?php echo isset($error_number_css) ? 'style="'. $error_number_css .'"' : ''?>>
          <span class = "errormsg" id="errorNumber" style = "color: #CD2627"> <?php echo isset($errorNumber) ? $errorNumber : ''?> </span> 
          <!--<button class="w3-button w3-block w3-blue-grey w3-section w3-padding" type="submit">Save Changes</button>-->
        </div>
      <div class="w3-center w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-grey">Cancel</button>
        <input type="submit" class="w3-margin-left w3-button w3-green" id = "submit1" name = "changeInfo" value = "Save Changes">
      </div>
 </form>
    </div>
  </div>
</div>


  <div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:450px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <div class="w3-center"><br>
        <h3> Change Password</h3>
      </div>
      <hr>
        <div class="w3-section">
        <form class="w3-container" id = "changePassword" method = "post" action="?" onSubmit = "validatePass();">
          <input class="w3-input pass" type="password" placeholder="Enter Current Password" id = "oldPassword" name="oldPassword" onchange = "validatePasswordAjax(this.value);">
          <span class = "errormsg" id="oldPasswordError" style = "font-size:90%; color: #CD2627"></span> <br> 
          <input class="w3-input pass" type="password" placeholder="Enter New Password" id = "password" name="password" onchange = "validatePassword(this.value);">
          <span class = "errormsg" id="passwordError" style = "font-size:90%; color: #CD2627"></span> <br> 
          <input class="w3-input pass" type="password" placeholder="Confirm New Password" id = "confirmPassword" name="confirmPassword" onchange = "validatePasswordMatch(this.value);">
          <span class = "errormsg" id="confirmPasswordError" style = "font-size:90%; color: #CD2627"></span> 
          <!--<button class="w3-button w3-block w3-blue-grey w3-section w3-padding" type="submit">Save Changes</button>-->
        </div>
      <div class="w3-center w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id02').style.display='none'" type="button" class="w3-button w3-grey">Cancel</button>
        <input type="submit" class="w3-margin-left w3-button w3-green" id = "submit2" name = "changePassword" value = "Save Changes">
      </div>
 </form>
    </div>
  </div>
</div>


      <script>
 function validatePass() {
    var inputs = document.getElementsByClassName('pass');
    for (i = 0; i < inputs.length; i++) {         
            if (inputs[i].name == "password") {
               validatePassword(inputs[i].value);
            }
            if (inputs[i].name == "confirmPassword") {
                validatePasswordMatch(inputs[i].value);
            }
            if (inputs[i].name == "oldPassword") {
                validatePasswordAjax(inputs[i].value);
            }
        }
 }
</script>

<?php
htmlfooter();
unset($_SESSION['message']);
?>
