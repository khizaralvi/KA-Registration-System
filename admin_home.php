<?php
include 'header_footer.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
    header("Location: index.php");
}

if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
}

htmlheader();
?>

 <!-- Background Image -->
<div class="w3-display-container w3-center w3-wide image w3-grayscale-min">
  <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-small w3-hide-medium" style = "margin-bottom:40px">
  <h2 class = "w3-xxxlarge">BKJ Registration System</h2>
  <h2 class="w3-xxxlarge">Gupta University</h2>
 </div>
 <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-large" style = "margin-bottom:10px">
    <h2 class="w3-xxlarge w3-hide-large">BKJ Registration System</h2>
    <h2 class="w3-xxlarge w3-hide-large">Gupta University</h2>
  </div>
</div>


    <!-- Cards start -->
    <div class="w3-row-padding w3-margin-top w3-margin-top" style = "color:black">
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="account_management.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-users fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Account Management</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="course_management.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-book fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Course Management</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="department/dept_management.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-address-card fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Department Management</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="degree/degree_management.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-file-text fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Degree Management</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
    </div>
    <div class="w3-row-padding w3-margin-top w3-margin-top" style = "color:black">
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="facility/facility_home.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-building fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Facility Management</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="major/major_management.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-pencil-square-o fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Major Management</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="advisor/advisor_management.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-user-plus fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Advisor Management</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
         <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="holds/holds_management.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Holds Management</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
    </div>
    <!-- End of Icon buttons -->
</div>

    <!--Footer for large screens-->
<footer class="w3-container w3-row w3-black w3-opacity-min w3-hover-opacity-off w3-padding-16 w3-medium w3-hide-small footer" id = "footer">
  <div class='w3-quarter'>
  <h3>FOOTER</h3>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
  </div>
  <div class='w3-quarter'>
  <h3>Social Media</h3>
  <p>Facebook</a></p>
  </div>
  <div class='w3-quarter'>
  <h3>Contact Us</h3>
  <p>555-674-9999</a></p>
  </div>
  <div class='w3-quarter'>
  <h3>Address</h3>
  <p>223 Store Hill Road, Old Westbury</a></p>
  </div>
</footer>

<!--Footer for small screens-->
<footer class="w3-center w3-row w3-black w3-opacity-min w3-hover-opacity-off w3-padding-16 w3-small w3-hide-large footer_small">
  <div class='w3-quarter'>
  <h3>FOOTER</h3>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
  </div>
  <div class='w3-quarter'>
  <h3>Social Media</h3>
  <p>Facebook</a></p>
  </div>
  <div class='w3-quarter'>
  <h3>Contact Us</h3>
  <p>555-674-9999</a></p>
  </div>
  <div class='w3-quarter'>
  <h3>Address</h3>
  <p>223 Store Hill Road, Old Westbury</a></p>
  </div>
</footer>

<?php 
htmlfooter();
?>

