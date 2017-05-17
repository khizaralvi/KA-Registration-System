<?php
include '../header_footer.php';
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
  header("Location: ../index.php");
}

htmlheader_root();
?>
    <!-- Cards start -->
    <div class="w3-row-padding w3-margin-top w3-margin-top" style = "color:black">
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="search_advisor.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-user-plus fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Assign Student to Advisor</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="search_student.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-user-plus fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Assign Advisor to Student</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
    </div>
    <!-- End of Icon buttons -->
</div>

<!--Footer for large screens-->
<footer class="w3-container w3-row w3-black w3-opacity-min w3-hover-opacity-off w3-padding-16 w3-medium w3-hide-small footer">
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
