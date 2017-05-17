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
  header("Location: index.php");
}

htmlheader('w3-white');
?>

    <div class = "w3-container">
    <h2> Account Confirmation </h2>
    </div>

<?php

if (isset($_SESSION['first_namec']) && isset($_SESSION['last_namec']) && isset($_SESSION['date_of_birthc']) && isset($_SESSION['emailc']) && isset($_SESSION['numberc'])) {
    $firstname = $_SESSION['first_namec'];
    $lastname = $_SESSION['last_namec'];
    $dob = $_SESSION['date_of_birthc'];
    $email = $_SESSION['emailc'];
    $number = $_SESSION['numberc'];
    $user_category = ucfirst($_SESSION['user_category']);

    echo "<div class='w3-container w3-pale-green w3-center'>
                                <h3>Success</h3>
                                <p>$user_category account created successfully.</p>
                                </div> <br>";

    $table =  "<div class='w3-container'>
    <table class='w3-table-all w3-bordered w3-centered'>
    <tr>
      <td><b>First Name</b></td>
      <td>$firstname</td>
    </tr>
    <tr>
      <td><b>Last Name</b></td>
      <td>$lastname</td>
    </tr>
    <tr>
      <td><b>Date Of Birth</b></td>
      <td>$dob</td>
    </tr>
    <tr>
      <td><b>Email</b></td>
      <td>$email</td>
    </tr>
       <tr>
      <td><b>Phone Number</b></td>
      <td>$number</td>
    </tr>";

  if (isset($_SESSION['statusc'])) {
    $status = $_SESSION['statusc'];
    $table .= "<tr>
      <td><b>Status</b></td>
      <td>$status</td>
    </tr>";
  }
  $table .= "</table></div>";

  echo $table;

}

?>

</div>


<?php
 htmlfooter();
 unset($_SESSION['first_namec']);
 unset($_SESSION['last_namec']);
 unset($_SESSION['date_of_birthc']);
 unset($_SESSION['emailc']);
 unset($_SESSION['numberc']);
 unset($_SESSION['statusc']);
?>
