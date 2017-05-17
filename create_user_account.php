<?php
include 'header_footer.php';
include 'php_functions.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
    header("Location: index.php");
}
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy(); 
  header("Location: logout_page.php");
}

?>



    


    <?php

        if (isset($_SESSION['user_category']) && $_SESSION['user_category'] == "administrator") 
        {

        if (isset($_POST['first_name']) &&
            isset($_POST['last_name']) &&
            isset($_POST['date_of_birth']) &&
            isset($_POST['email_address']) &&
            isset($_POST['password']) &&
            isset($_POST['number']) &&
            isset($_POST['submit']))

        {
            //Creating global SESSION variables for each field
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['last_name'] = $_POST['last_name'];
            $_SESSION['date_of_birth'] = $_POST['date_of_birth'];
            $_SESSION['email'] = $_POST['email_address'];
            $_SESSION['passwordfield'] = $_POST['password'];
            $_SESSION['number'] = $_POST['number'];
            
            $first_name = validateFirstName($_POST['first_name']);
            $last_name = validateLastName($_POST['last_name']);
            $dob = validateDateOfBirth(date("Y-m-d", strtotime($_POST['date_of_birth'])));
            $email_address = validateEmail($_POST['email_address']);
            $password = validatePassword($_POST['password']);
            $number = validateNumber($_POST['number']);
            
            


            if ($first_name[0] == "" && $last_name[0] == "" && $dob[0] == "" && $email_address[0] == "" && $password[0] == "" && $number[0] == "") {

                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $dob = $_POST['date_of_birth'];
                $email_address = $_POST['email_address'];
                $password = $_POST['password'];
                $number = $_POST['number'];

                $conn = mysqlConnect();

                $sql = "INSERT INTO user (first_name, last_name, date_of_birth, email, tel_num, user_type, username, password)
                        VALUES ('$first_name', '$last_name', '$dob', '$email_address', '$number', 'A', '$email_address', '$password');
                        SET @admin_id = LAST_INSERT_ID();
                        INSERT INTO administrator VALUES (@admin_id)";
                 mysqli_autocommit($conn, FALSE);
                //mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);       
                if(mysqli_multi_query($conn, $sql)) {
                  while (mysqli_more_results($conn) && mysqli_next_result($conn)) {
                         mysqli_store_result($conn);
                  }
                  if (!mysqli_error($conn)) {
                          mysqli_commit($conn);
                          $_SESSION['first_namec'] = $first_name;
                          $_SESSION['last_namec'] = $last_name;
                          $_SESSION['date_of_birthc'] = $dob;
                          $_SESSION['emailc'] = $email_address;
                          $_SESSION['numberc'] = $number;
                          header('location:account_creation_confirmation.php');            
                     }
                     else {
                         mysqli_rollback($conn);
                         $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Transaction rolled back</p>
                                </div>" . mysqli_error($conn);
                     }
                   
                }
                else {
                    $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Could not create user</p>
                                </div>" . mysqli_error($conn);
                }
                mysqli_close($conn);

            }
            else {

                //Updating Errors
                $errorFirstName = $first_name[0];
                $errorLastName = $last_name[0];
                $errorDateOfBirth = $dob[0];
                $errorEmail = $email_address[0];
                $errorPassword = $password[0];
                $errorNumber = $number[0];
                
                //Updating CSS for Errors
                $error_email_css = $email_address[1];
                $error_firstname_css = $first_name[1];
                $error_lastname_css = $last_name[1];
                $error_dob_css = $dob[1];
                $error_password_css = $password[1];
                $error_number_css = $number[1];
                
            }

        }

        htmlheader('w3-white');

        ?>
        <?php echo isset($message) ? $message : '';?>

    <div class = "w3-container">
    <h2> Create User Account </h2>
    <p> Create <?php echo ucfirst($_SESSION['user_category']) ?> Account </p>
    </div>

          <form class="w3-container" action = "?" method = "post" id = "loginForm" onSubmit = "validate();" style="max-width:450px">
        		  <div class="w3-section">
          			
                    <label><b>First Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter First Name" id = "first_name" name = "first_name" onchange = "validateFirstName(this.value);" <?php echo isset($_SESSION['first_name']) ? 'value="'. $_SESSION['first_name'] .'"' : '' ?> <?php echo isset($error_firstname_css) ? 'style="'. $error_firstname_css .'"' : '' ?>>  
                    <span class = "errormsg" id="errorFirstName" style = "color: #CD2627"> <?php echo isset($errorFirstName) ? $errorFirstName : '' ?></span> <br> <br>

                     <label><b>Last Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter Last Name" id = "last_name" name = "last_name" onchange = "validateLastName(this.value);" <?php echo isset($_SESSION['last_name']) ? 'value="'. $_SESSION['last_name'] .'"' : '' ?> <?php echo isset($error_lastname_css) ? 'style="'. $error_lastname_css .'"' : '' ?>> 
                    <span class = "errormsg" id="errorLastName" style = "color: #CD2627"> <?php echo isset($errorLastName) ? $errorLastName : '' ?></span> <br> <br>

                    <label><b>Date Of Birth</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "date" id = "date_of_birth" name = "date_of_birth" <?php echo isset($_SESSION['date_of_birth']) ? 'value="'. $_SESSION['date_of_birth'] .'"' : '' ?> <?php echo isset($error_dob_css) ? 'style="'. $error_dob_css .'"' : ''?>>  
                    <span class = "errormsg" id="errorDateOfBirth" style = "color: #CD2627"> <?php echo isset($errorDateOfBirth) ? $errorDateOfBirth : ''?></span> <br> <br>

                    <label><b>Email Address</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="username@gupta.edu" id = "email_address" name = "email_address" onchange = "validateEmail(this.value);" <?php echo isset($_SESSION['email']) ? 'value="'. $_SESSION['email'] .'"' : '' ?> <?php echo isset($error_email_css) ? 'style="'. $error_email_css .'"' : ''?>>
                    <span class = "errormsg" id="errorEmail" style = "color: #CD2627"> <?php echo isset($errorEmail) ? $errorEmail : ''?> </span> <br> <br>
                      
                    <label><b>Password (6 characters min.)</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="password" placeholder="1 each of a-z, A-Z and 0-9" id = "password" name = "password" onchange = "validatePassword(this.value);" <?php echo isset($_SESSION['passwordfield']) ? 'value="'. $_SESSION['passwordfield'] .'"' : '' ?> <?php echo isset($error_password_css) ? 'style="'. $error_password_css .'"' : ''?>>
					<span class = "errormsg" id="passwordError" style = "color: #CD2627"> <?php echo isset($errorPassword) ? $errorPassword : ''?></span> <br> <br>

                    <label><b>Telephone Number</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="text" placeholder="###-###-####" id = "number" name = "number" onchange = "validateNumber(this.value);" <?php echo isset($telnum) ? 'value="'. $telnum .'"' : (isset($_SESSION['number']) ? 'value="'. $_SESSION['number'] .'"' : '') ?> <?php echo isset($error_number_css) ? 'style="'. $error_number_css .'"' : ''?>>
					<span class = "errormsg" id="errorNumber" style = "color: #CD2627"> <?php echo isset($errorNumber) ? $errorNumber : ''?> </span> <br><br>
          			
                      <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Create User">
        		  </div>
      		    </form>
<?php
        }

      else if (isset($_SESSION['user_category']) && $_SESSION['user_category'] == "research") 
        {

            if (isset($_POST['first_name']) &&
            isset($_POST['last_name']) &&
            isset($_POST['date_of_birth']) &&
            isset($_POST['email_address']) &&
            isset($_POST['password']) &&
            isset($_POST['number']) &&
            isset($_POST['submit']))

        {
            //Creating global SESSION variables for each field
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['last_name'] = $_POST['last_name'];
            $_SESSION['date_of_birth'] = $_POST['date_of_birth'];
            $_SESSION['email'] = $_POST['email_address'];
            $_SESSION['passwordfield'] = $_POST['password'];
            $_SESSION['number'] = $_POST['number'];
            
            $first_name = validateFirstName($_POST['first_name']);
            $last_name = validateLastName($_POST['last_name']);
            $dob = validateDateOfBirth(date("Y-m-d", strtotime($_POST['date_of_birth'])));
            $email_address = validateEmail($_POST['email_address']);
            $password = validatePassword($_POST['password']);
            $number = validateNumber($_POST['number']);
            
            


            if ($first_name[0] == "" && $last_name[0] == "" && $dob[0] == "" && $email_address[0] == "" && $password[0] == "" && $number[0] == "") {

                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $dob = $_POST['date_of_birth'];
                $email_address = $_POST['email_address'];
                $password = $_POST['password'];
                $number = $_POST['number'];

                $conn = mysqlConnect();

                $sql = "INSERT INTO user (first_name, last_name, date_of_birth, email, tel_num, user_type, username, password)
                        VALUES ('$first_name', '$last_name', '$dob', '$email_address', '$number', 'R', '$email_address', '$password');
                        SET @research_id = LAST_INSERT_ID();
                        INSERT INTO research VALUES (@research_id);";
                   mysqli_autocommit($conn, FALSE);
                //mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);       
                if(mysqli_multi_query($conn, $sql)) {
                  while (mysqli_more_results($conn) && mysqli_next_result($conn)) {
                         mysqli_store_result($conn);
                  }
                  if (!mysqli_error($conn)) {
                          mysqli_commit($conn);
                          $_SESSION['first_namec'] = $first_name;
                          $_SESSION['last_namec'] = $last_name;
                          $_SESSION['date_of_birthc'] = $dob;
                          $_SESSION['emailc'] = $email_address;
                          $_SESSION['numberc'] = $number;
                          header('location:account_creation_confirmation.php');            
                     }
                     else {
                         mysqli_rollback($conn);
                         $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Transaction rolled back</p>
                                </div>" . mysqli_error($conn);
                     }
                   
                }
                else {
                    $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Could not create user.</p>
                                </div>" . mysqli_error($conn);
                }
                mysqli_close($conn);

            }
            else {

                //Updating Errors
                $errorFirstName = $first_name[0];
                $errorLastName = $last_name[0];
                $errorDateOfBirth = $dob[0];
                $errorEmail = $email_address[0];
                $errorPassword = $password[0];
                $errorNumber = $number[0];
                
                //Updating CSS for Errors
                $error_email_css = $email_address[1];
                $error_firstname_css = $first_name[1];
                $error_lastname_css = $last_name[1];
                $error_dob_css = $dob[1];
                $error_password_css = $password[1];
                $error_number_css = $number[1];
                
            }

        }

        htmlheader('w3-white');
        ?>
        <?php echo isset($message) ? $message : '';?>

        
    <div class = "w3-container">
    <h2> Create User Account </h2>
    <p> Create <?php echo ucfirst($_SESSION['user_category']) ?> Account </p>
    </div>
        
          <form class="w3-container" action = "?" method = "post" id = "loginForm" onSubmit = "validate();" style="max-width:450px">
        		  <div class="w3-section">
          			
                    <label><b>First Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter First Name" id = "first_name" name = "first_name" onchange = "validateFirstName(this.value);" <?php echo isset($_SESSION['first_name']) ? 'value="'. $_SESSION['first_name'] .'"' : '' ?> <?php echo isset($error_firstname_css) ? 'style="'. $error_firstname_css .'"' : '' ?>>  
                    <span class = "errormsg" id="errorFirstName" style = "color: #CD2627"> <?php echo isset($errorFirstName) ? $errorFirstName : '' ?></span> <br> <br>

                     <label><b>Last Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter Last Name" id = "last_name" name = "last_name" onchange = "validateLastName(this.value);" <?php echo isset($_SESSION['last_name']) ? 'value="'. $_SESSION['last_name'] .'"' : '' ?> <?php echo isset($error_lastname_css) ? 'style="'. $error_lastname_css .'"' : '' ?>> 
                    <span class = "errormsg" id="errorLastName" style = "color: #CD2627"> <?php echo isset($errorLastName) ? $errorLastName : '' ?></span> <br> <br>

                    <label><b>Date Of Birth</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "date" id = "date_of_birth" name = "date_of_birth" <?php echo isset($_SESSION['date_of_birth']) ? 'value="'. $_SESSION['date_of_birth'] .'"' : '' ?> <?php echo isset($error_dob_css) ? 'style="'. $error_dob_css .'"' : ''?>>  
                    <span class = "errormsg" id="errorDateOfBirth" style = "color: #CD2627"> <?php echo isset($errorDateOfBirth) ? $errorDateOfBirth : ''?></span> <br> <br>

                    <label><b>Email Address</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="username@gupta.edu" id = "email_address" name = "email_address" onchange = "validateEmail(this.value);" <?php echo isset($_SESSION['email']) ? 'value="'. $_SESSION['email'] .'"' : '' ?> <?php echo isset($error_email_css) ? 'style="'. $error_email_css .'"' : ''?>>
                    <span class = "errormsg" id="errorEmail" style = "color: #CD2627"> <?php echo isset($errorEmail) ? $errorEmail : ''?> </span> <br> <br>

                    <label><b>Password (6 characters min.)</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="password" placeholder="1 each of a-z, A-Z and 0-9" id = "password" name = "password" onchange = "validatePassword(this.value);" <?php echo isset($_SESSION['passwordfield']) ? 'value="'. $_SESSION['passwordfield'] .'"' : '' ?> <?php echo isset($error_password_css) ? 'style="'. $error_password_css .'"' : ''?>>
					<span class = "errormsg" id="passwordError" style = "color: #CD2627"> <?php echo isset($errorPassword) ? $errorPassword : ''?></span> <br> <br>

                    <label><b>Telephone Number</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="text" placeholder="###-###-####" id = "number" name = "number" onchange = "validateNumber(this.value);" <?php echo isset($telnum) ? 'value="'. $telnum .'"' : (isset($_SESSION['number']) ? 'value="'. $_SESSION['number'] .'"' : '') ?> <?php echo isset($error_number_css) ? 'style="'. $error_number_css .'"' : ''?>>
					<span class = "errormsg" id="errorNumber" style = "color: #CD2627"> <?php echo isset($errorNumber) ? $errorNumber : ''?> </span> <br><br>
          			
                      <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Create User">
        		  </div>
      		    </form>


     <?php
        }


   else if (isset($_SESSION['user_category']) && $_SESSION['user_category'] == "student") 
   {

            if (isset($_POST['first_name']) &&
            isset($_POST['last_name']) &&
            isset($_POST['date_of_birth']) &&
            isset($_POST['email_address']) &&
            isset($_POST['password']) &&
            isset($_POST['number']) &&
            isset($_POST['status']) &&
            isset($_POST['submit']))

        {
            //Creating global SESSION variables for each field
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['last_name'] = $_POST['last_name'];
            $_SESSION['date_of_birth'] = $_POST['date_of_birth'];
            $_SESSION['email'] = $_POST['email_address'];
            $_SESSION['passwordfield'] = $_POST['password'];
            $_SESSION['number'] = $_POST['number'];
            
            $first_name = validateFirstName($_POST['first_name']);
            $last_name = validateLastName($_POST['last_name']);
            $dob = validateDateOfBirth(date("Y-m-d", strtotime($_POST['date_of_birth'])));
            $email_address = validateEmail($_POST['email_address']);
            $password = validatePassword($_POST['password']);
            $number = validateNumber($_POST['number']);
            


            if ($first_name[0] == "" && $last_name[0] == "" && $dob[0] == "" && $email_address[0] == "" && $password[0] == "" && $number[0] == "" && isset($_POST['status'])) {

                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $dob = $_POST['date_of_birth'];
                $email_address = $_POST['email_address'];
                $password = $_POST['password'];
                $status = $_POST['status'];
                $number = $_POST['number'];

                $conn = mysqlConnect();
      
                $sql = "INSERT INTO user (first_name, last_name, date_of_birth, email, tel_num, user_type, username, password) 
                        VALUES ('$first_name', '$last_name', '$dob', '$email_address', '$number', 'S', '$email_address', '$password');
                        SET @student_id  = LAST_INSERT_ID();
                        INSERT INTO student (student_id, gpa, student_type)VALUES (@student_id, 0, '$status');";
                
                   mysqli_autocommit($conn, FALSE);
                //mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);       
                if(mysqli_multi_query($conn, $sql)) {
                  while (mysqli_more_results($conn) && mysqli_next_result($conn)) {
                         mysqli_store_result($conn);
                  }
                  if (!mysqli_error($conn)) {
                          mysqli_commit($conn);
                          $_SESSION['first_namec'] = $first_name;
                          $_SESSION['last_namec'] = $last_name;
                          $_SESSION['date_of_birthc'] = $dob;
                          $_SESSION['emailc'] = $email_address;
                          $_SESSION['numberc'] = $number;
                          $_SESSION['statusc'] = $status;

                          header('location:account_creation_confirmation.php');            
                     }
                     else {
                         mysqli_rollback($conn);
                         $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Transaction rolled back</p>
                                </div>";
                          echo mysqli_error($conn);
                     }
                   
                }
                else {
                    $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Could not create user.</p>
                                </div>" . mysqli_error($conn);
                }
                mysqli_close($conn);

            }
            else {

                //Updating Errors
                $errorFirstName = $first_name[0];
                $errorLastName = $last_name[0];
                $errorDateOfBirth = $dob[0];
                $errorEmail = $email_address[0];
                $errorPassword = $password[0];
                $errorNumber = $number[0];
                
                //Updating CSS for Errors
                $error_email_css = $email_address[1];
                $error_firstname_css = $first_name[1];
                $error_lastname_css = $last_name[1];
                $error_dob_css = $dob[1];
                $error_password_css = $password[1];
                $error_number_css = $number[1];
                
            }

        }
        htmlheader('w3-white');
  ?>
    <?php echo isset($message) ? $message : '';?>

    
    <div class = "w3-container">
    <h2> Create User Account </h2>
    <p> Create <?php echo ucfirst($_SESSION['user_category']) ?> Account </p>
    </div>

    <form class="w3-container" action = "?" method = "post" id = "loginForm" onSubmit = "validate();" style="max-width:450px">
        		  <div class="w3-section">
          			
                    <label><b>First Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter First Name" id = "first_name" name = "first_name" onchange = "validateFirstName(this.value);" <?php echo isset($_SESSION['first_name']) ? 'value="'. $_SESSION['first_name'] .'"' : '' ?> <?php echo isset($error_firstname_css) ? 'style="'. $error_firstname_css .'"' : '' ?>>  
                    <span class = "errormsg" id="errorFirstName" style = "color: #CD2627"> <?php echo isset($errorFirstName) ? $errorFirstName : '' ?></span> <br> <br>

                     <label><b>Last Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter Last Name" id = "last_name" name = "last_name" onchange = "validateLastName(this.value);" <?php echo isset($_SESSION['last_name']) ? 'value="'. $_SESSION['last_name'] .'"' : '' ?> <?php echo isset($error_lastname_css) ? 'style="'. $error_lastname_css .'"' : '' ?>> 
                    <span class = "errormsg" id="errorLastName" style = "color: #CD2627"> <?php echo isset($errorLastName) ? $errorLastName : '' ?></span> <br> <br>

                    <label><b>Date Of Birth</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "date" id = "date_of_birth" name = "date_of_birth" <?php echo isset($_SESSION['date_of_birth']) ? 'value="'. $_SESSION['date_of_birth'] .'"' : '' ?> <?php echo isset($error_dob_css) ? 'style="'. $error_dob_css .'"' : ''?>>  
                    <span class = "errormsg" id="errorDateOfBirth" style = "color: #CD2627"> <?php echo isset($errorDateOfBirth) ? $errorDateOfBirth : ''?></span> <br> <br>

                    <label><b>Email Address</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="username@gupta.edu" id = "email_address" name = "email_address" onchange = "validateEmail(this.value);" <?php echo isset($_SESSION['email']) ? 'value="'. $_SESSION['email'] .'"' : '' ?> <?php echo isset($error_email_css) ? 'style="'. $error_email_css .'"' : ''?>>
                    <span class = "errormsg" id="errorEmail" style = "color: #CD2627"> <?php echo isset($errorEmail) ? $errorEmail : ''?> </span> <br> <br>
                      
                    <label><b>Password (6 characters min.)</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="password" placeholder="1 each of a-z, A-Z and 0-9" id = "password" name = "password" onchange = "validatePassword(this.value);" <?php echo isset($_SESSION['passwordfield']) ? 'value="'. $_SESSION['passwordfield'] .'"' : '' ?> <?php echo isset($error_password_css) ? 'style="'. $error_password_css .'"' : ''?>>
					<span class = "errormsg" id="passwordError" style = "color: #CD2627"> <?php echo isset($errorPassword) ? $errorPassword : ''?></span> <br> <br>

                    <label><b>Telephone Number</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="text" placeholder="###-###-####" id = "number" name = "number" onchange = "validateNumber(this.value);" <?php echo isset($telnum) ? 'value="'. $telnum .'"' : (isset($_SESSION['number']) ? 'value="'. $_SESSION['number'] .'"' : '') ?> <?php echo isset($error_number_css) ? 'style="'. $error_number_css .'"' : ''?>>
					<span class = "errormsg" id="errorNumber" style = "color: #CD2627"> <?php echo isset($errorNumber) ? $errorNumber : ''?> </span> <br><br>
                    
                    <input class="w3-round login w3-padding-medium" type="radio" name = "status" value = "full_time" checked="checked">
                    <label><b>Full Time</b></label><br><br>

                     <input class="w3-round login w3-padding-medium" type="radio" name = "status" value = "part_time">
                    <label><b>Part Time</b></label><br> <br>
          			
                      <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Create User">
        		  </div>
      		    </form>

     <?php
        }

        else if (isset($_SESSION['user_category']) && $_SESSION['user_category'] == "faculty") 
   {
             if (
            isset($_POST['submit']))

        {
            //Creating global SESSION variables for each field
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['last_name'] = $_POST['last_name'];
            $_SESSION['date_of_birth'] = $_POST['date_of_birth'];
            $_SESSION['email'] = $_POST['email_address'];
            $_SESSION['passwordfield'] = $_POST['password'];
            $_SESSION['number'] = $_POST['number'];
            
            $first_name = validateFirstName($_POST['first_name']);
            $last_name = validateLastName($_POST['last_name']);
            $dob = validateDateOfBirth(date("Y-m-d", strtotime($_POST['date_of_birth'])));
            $email_address = validateEmail($_POST['email_address']);
            $password = validatePassword($_POST['password']);
            $number = validateNumber($_POST['number']);
            $salary = validateSalary($_POST['hourly_salary'], $_POST['yearly_salary']);

            if ($first_name[0] == "" && $last_name[0] == "" && $dob[0] == "" && $email_address[0] == "" && $password[0] == "" && $number[0] == "" && $salary[0] == "") {


                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $dob = $_POST['date_of_birth'];
                $username = $_POST['username'];
                $email_address = $_POST['email_address'];
                $password = $_POST['password'];
                $status = $_POST['status'];
                $number = $_POST['number'];
               // $salary = $_POST['salary'];

                $conn = mysqlConnect();
                if (!empty($_POST['yearly_salary'])) {
                    $salary = $_POST['yearly_salary'];
                    /**$sql = "INSERT INTO user (first_name, last_name, date_of_birth, email, tel_num, user_type, username, password) 
                        VALUES ('$first_name', '$last_name', '$dob', '$email_address', '555555', 'F', '$username', '$password');
                        INSERT INTO faculty (faculty_id, faculty_type) SELECT user_id, 'full_time' from user where user_id = LAST_INSERT_ID();
                        INSERT INTO faculty_full_time (faculty_id, yearly_salary) SELECT faculty_id, $salary from faculty where faculty_id = LAST_INSERT_ID();";**/
                    $sql = "INSERT INTO user (first_name, last_name, date_of_birth, email, tel_num, user_type, username, password) 
                        VALUES ('$first_name', '$last_name', '$dob', '$email_address', '$number', 'F', '$email_address', '$password');
                        SET @faculty_id  = LAST_INSERT_ID();
                        INSERT INTO faculty (faculty_id, faculty_type) VALUES (@faculty_id, 'full_time');
                        SET @faculty_id = LAST_INSERT_ID();
                        INSERT INTO faculty_full_time (faculty_id, yearly_salary) VALUES (@faculty_id, $salary);";
                }
                else if (!empty($_POST['hourly_salary'])) {
                    $salary = $_POST['hourly_salary'];
                    $sql = "INSERT INTO user (first_name, last_name, date_of_birth, email, tel_num, user_type, username, password) 
                        VALUES ('$first_name', '$last_name', '$dob', '$email_address', '$number', 'F', '$email_address', '$password');
                        SET @faculty_id  = LAST_INSERT_ID();
                        INSERT INTO faculty (faculty_id, faculty_type) VALUES (@faculty_id, 'part_time');
                        SET @faculty_id = LAST_INSERT_ID();
                        INSERT INTO faculty_part_time (faculty_id, hourly_rate) VALUES (@faculty_id, $salary);";
                }

                   mysqli_autocommit($conn, FALSE);
                //mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);       
                if(mysqli_multi_query($conn, $sql)) {
                  while (mysqli_more_results($conn) && mysqli_next_result($conn)) {
                         mysqli_store_result($conn);
                  }
                  if (!mysqli_error($conn)) {
                          mysqli_commit($conn);
                          $_SESSION['first_namec'] = $first_name;
                          $_SESSION['last_namec'] = $last_name;
                          $_SESSION['date_of_birthc'] = $dob;
                          $_SESSION['emailc'] = $email_address;
                          $_SESSION['numberc'] = $number;
                          $_SESSION['statusc'] = $status;
                          //$_SESSION['salaryc'] = $salary;
                          header('location:account_creation_confirmation.php');            
                     }
                     else {
                         mysqli_rollback($conn);
                         $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Transaction rolled back</p>
                                </div>" . mysqli_error($conn);
                     }
                   
                }
                else {
                    $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Could not create user.</p>
                                </div>" . mysqli_error($conn);
                }
                mysqli_close($conn);

            }
            else {

                //Updating Errors
                $errorFirstName = $first_name[0];
                $errorLastName = $last_name[0];
                $errorDateOfBirth = $dob[0];
                $errorEmail = $email_address[0];
                $errorPassword = $password[0];
                $errorSalary = $salary[0];
                $errorNumber = $number[0];
                
                //Updating CSS for Errors
                $error_email_css = $email_address[1];
                $error_firstname_css = $first_name[1];
                $error_lastname_css = $last_name[1];
                $error_dob_css = $dob[1];
                $error_password_css = $password[1];
                $error_salary_css = $salary[1];
                $error_number_css = $number[1];
                
            }

        }

        htmlheader('w3-white');        

  ?>
  <script> 
  function checkStatus() {
        var statusPartTime = document.getElementById('part_time');
        var statusFullTime = document.getElementById('full_time');

        if (statusPartTime.checked) {
            document.getElementById("yearly_salary").readOnly  = true;
            document.getElementById("yearly_salary").style.background = "#C7C7C7";
            document.getElementById("hourly_salary").readOnly  = false;
            document.getElementById("hourly_salary").style.background = "";
        }
        else if (statusFullTime.checked) {
            document.getElementById("hourly_salary").readOnly  = true;
            document.getElementById("hourly_salary").style.background = "#C7C7C7";
            document.getElementById("yearly_salary").readOnly  = false;
            document.getElementById("yearly_salary").style.background = "";
        }
  }
  </script>

  <?php echo isset($message) ? $message : '';?>

  
    <div class = "w3-container">
    <h2> Create User Account </h2>
    <p> Create <?php echo ucfirst($_SESSION['user_category']) ?> Account </p>
    </div>

    <form class="w3-container" action = "?" method = "post" id = "loginForm" onSubmit = "validate();">
        		  <div class="w3-section">
          			
                    <label><b>First Name</b></label><br>
                    <input class = "w3-round signup w3-padding-medium" type = "text" placeholder="Enter First Name" id = "first_name" name = "first_name" onchange = "validateFirstName(this.value);" <?php echo isset($_SESSION['first_name']) ? 'value="'. $_SESSION['first_name'] .'"' : '' ?> <?php echo isset($error_firstname_css) ? 'style="'. $error_firstname_css .'"' : '' ?>>  
                    <span class = "errormsg" id="errorFirstName" style = "color: #CD2627"> <?php echo isset($errorFirstName) ? $errorFirstName : '' ?></span> <br> <br>

                     <label><b>Last Name</b></label><br>
                    <input class = "w3-round signup w3-padding-medium" type = "text" placeholder="Enter Last Name" id = "last_name" name = "last_name" onchange = "validateLastName(this.value);" <?php echo isset($_SESSION['last_name']) ? 'value="'. $_SESSION['last_name'] .'"' : '' ?> <?php echo isset($error_lastname_css) ? 'style="'. $error_lastname_css .'"' : '' ?>> 
                    <span class = "errormsg" id="errorLastName" style = "color: #CD2627"> <?php echo isset($errorLastName) ? $errorLastName : '' ?></span> <br> <br>

                    <label><b>Date Of Birth</b></label><br>
                    <input class = "w3-round signup w3-padding-medium" type = "date" id = "date_of_birth" name = "date_of_birth" <?php echo isset($_SESSION['date_of_birth']) ? 'value="'. $_SESSION['date_of_birth'] .'"' : '' ?> <?php echo isset($error_dob_css) ? 'style="'. $error_dob_css .'"' : ''?>>  
                    <span class = "errormsg" id="errorDateOfBirth" style = "color: #CD2627"> <?php echo isset($errorDateOfBirth) ? $errorDateOfBirth : ''?></span> <br> <br>

                    <label><b>Email Address</b></label><br>
                    <input class = "w3-round signup w3-padding-medium" type = "text" placeholder="username@gupta.edu" id = "email_address" name = "email_address" onchange = "validateEmail(this.value);" <?php echo isset($_SESSION['email']) ? 'value="'. $_SESSION['email'] .'"' : '' ?> <?php echo isset($error_email_css) ? 'style="'. $error_email_css .'"' : ''?>>
                    <span class = "errormsg" id="errorEmail" style = "color: #CD2627"> <?php echo isset($errorEmail) ? $errorEmail : ''?> </span> <br> <br>
                      
                    <label><b>Password (6 characters min.)</b></label><br>
                    <input class="w3-round signup w3-padding-medium" type="password" placeholder="1 each of a-z, A-Z and 0-9" id = "password" name = "password" onchange = "validatePassword(this.value);" <?php echo isset($_SESSION['passwordfield']) ? 'value="'. $_SESSION['passwordfield'] .'"' : '' ?> <?php echo isset($error_password_css) ? 'style="'. $error_password_css .'"' : ''?>>
					<span class = "errormsg" id="passwordError" style = "color: #CD2627"> <?php echo isset($errorPassword) ? $errorPassword : ''?></span> <br> <br>

                    <label><b>Telephone Number</b></label><br>
                    <input class="w3-round signup w3-padding-medium" type="text" placeholder="###-###-####" id = "number" name = "number" onchange = "validateNumber(this.value);" <?php echo isset($telnum) ? 'value="'. $telnum .'"' : (isset($_SESSION['number']) ? 'value="'. $_SESSION['number'] .'"' : '') ?> <?php echo isset($error_number_css) ? 'style="'. $error_number_css .'"' : ''?>>
					<span class = "errormsg" id="errorNumber" style = "color: #CD2627"> <?php echo isset($errorNumber) ? $errorNumber : ''?> </span> <br><br>
                    
                    <input class="w3-round login w3-padding-medium" type="radio" name = "status" id = "full_time" value = "full_time" checked = "checked" onchange = "checkStatus();">
                    <label><b>Full Time</b></label><br> 

                    <input class = "w3-round signup w3-padding-medium" type = "number" placeholder="Enter Yearly Salary" id = "yearly_salary" name = "yearly_salary" <?php echo isset($_SESSION['email']) ? 'value="'. $_SESSION['email'] .'"' : '' ?> <?php echo isset($error_salary_css) ? 'style="'. $error_salary_css .'"' : ''?>>
                    <span class = "errormsg" id="errorYearlySalary" style = "color: #CD2627"> <?php echo isset($errorSalary) ? $errorSalary : ''?> </span> <br> <br>

                     <input class="w3-round login w3-padding-medium" type="radio" name = "status" id = 'part_time' value = "part_time" onchange = "checkStatus();">
                    <label><b>Part Time</b></label><br> 

                    <input class = "w3-round signup w3-padding-medium" type = "number" placeholder="Enter Hourly Rate" id = "hourly_salary" name = "hourly_salary" style = "background: #C7C7C7;" <?php echo isset($_SESSION['email']) ? 'value="'. $_SESSION['email'] .'"' : '' ?> <?php echo isset($error_salary_css) ? 'style="'. $error_salary_css .'"' : ''?>readonly>
                    <span class = "errormsg" id="errorHourlySalary" style = "color: #CD2627"> <?php echo isset($errorSalary) ? $errorSalary : ''?> </span> <br> <br>
          			
                      <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Create User">
        		  </div>
      		    </form>

     <?php
        }
   
?>

   </div>

<?php
 htmlfooter();
 unset($_SESSION['usernamefield']);
 unset($_SESSION['email']);
 unset($_SESSION['first_name']);
 unset($_SESSION['last_name']);
 unset($_SESSION['date_of_birth']);
 unset($_SESSION['passwordfield']);
 unset($_SESSION['number']);
?>
