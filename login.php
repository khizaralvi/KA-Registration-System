<?php

include 'php_functions.php';

session_start();

//to prevent logged in user from using this page
//if (isset($_SESSION['username'])) {
  //header("Location: home.php");
//  exit;
// }

if (isset($_POST['username']) && isset($_POST['password'])) {

    //Creating global SESSION variables for username and password for textbox diplay (This prevents the user from entering field data again after failed form submission)
    $_SESSION['usernamefield'] = $_POST['username'];
    $_SESSION['passwordfield'] = $_POST['password'];

    $login = validateLogin($_POST['username'], $_POST['password']);

    if ($login[0] == "" && $login[1] == "") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = mysqlConnect();

    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if (!mysqli_num_rows($result) == 0) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['firstname'] = $row['first_name'];
        $_SESSION['userid'] = $row['user_id'];
        //echo ("Welcome " . $_SESSION['username']);
        $user = $row['user_type'];
        $_SESSION['usertype'] = $user;


        switch($user) {
            case "A":
                header("Location: admin_home.php");
                break;
            case "S":
                header("Location: student_home.php");
                break;
            case "F":
                header("Location: faculty_home.php");
                break;
            case "R";
                header("Location: research_home.php");
                break;
        }
    }
    else {
        //$errMsg = "invalid username or password";
        $message = "<div class='w3-container w3-content w3-center w3-red w3-margin-top' style='max-width:420px'>
            <p>Invalid Username or Password.</p>
        </div> <br>";
    }
    mysqli_close($conn);
}
    else {
        //Updating Errors
        $errorUsername = $login[0];
        $errorPassword = $login[1];
        
        //Updating CSS for Errors
        $error_username_css = $login[2];
        $error_password_css = $login[3];
     }
}

?>



<html>
	<head>
		<title>BJS Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="js/functions.js"> </script>
	</head>

	<body>
		<nav class="w3-bar">
			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="index.php">Home</a>
  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="schedule.php">Master Schedule</a>
  			<a class="w3-bar-item w3-button w3-hover-blue-grey" href="catalog.php">Master Catalog</a>

		</nav>

		<br> <br> <br> <br> <br> <br>
     <!-- <div class="w3-container"> -->
      	 <div class="w3-center"><br>
        	   <!--<img src="img/avatar_icon.png" alt="Avatar" style="width:10%" class="w3-circle w3-margin-top">-->
               <i class="fa fa-user-circle fa-5x" aria-hidden="true"></i>
      	 </div> 
  
                <?php echo isset($message) ? $message : ''?>                               
           
              <div class = "w3-content w3-container w3-center" style="max-width:450px">
      		    <form action = "?" method = "post" id = "loginForm"  onsubmit ="validateLogin();">
        		<!--  <div class="w3-section"> -->
          			<label><b>Username</b></label>
          			<input class="w3-input w3-round login" type="text" placeholder="Enter Username" id = "username" name = "username"  <?php echo isset($_SESSION['usernamefield']) ? 'value="'. $_SESSION['usernamefield'] .'"' : '' ?> <?php echo isset($error_username_css) ? 'style="'. $error_username_css .'"' : ''?>>
					 <span class = "errormsg" id="errorUsername" style = "color: #CD2627"> <?php echo isset($errorUsername) ? $errorUsername : ''?> </span>
          			<br> <br> 
                      <label><b>Password</b></label>
          			<input class="w3-input w3-round login" type="password" placeholder="Enter Password" id = "password" name = "password"  <?php echo isset($_SESSION['passwordfield']) ? 'value="'. $_SESSION['passwordfield'] .'"' : '' ?> <?php echo isset($error_password_css) ? 'style="'. $error_password_css .'"' : ''?>>
					   <span class = "errormsg" id="passwordError" style = "color: #CD2627"> <?php echo isset($errorPassword) ? $errorPassword : ''?></span> 
          			<input class="w3-btn-block w3-blue-grey w3-section w3-padding" type="submit" name = "submit" value = "Login">
          			<input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
        		 <!-- </div> -->
      		    </form>
            </div>
       <!-- </div> -->
      		    <div class="w3-container w3-content w3-center w3-border-top w3-padding-16 w3-light-grey" style="max-width:420px">
        		  <span class="w3-padding">Forgot <a href="#" onclick="alert('Please Contact the Help Desk: 555-674-9999');">password?</a></span>
      		    </div>

        <!-- End of Login -->
       <!-- </div> -->
    </body>
</html>

<?php
unset($_SESSION['usernamefield']);
unset($_SESSION['passwordfield']);
?>
