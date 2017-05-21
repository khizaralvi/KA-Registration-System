<?php
session_start();
//
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
else{
    if ($_SESSION['usertype'] != "S") {
        header("Location: index.php");
    }
}
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
}
?>


<!doctype html>
            <html>
                <head>
                    <title>BJK Registration</title>
                    <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no'>
		<link rel='stylesheet' href='https://www.w3schools.com/lib/w3.css'>
    <link rel='stylesheet' href='css/styles.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-signal.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-2017.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script type='text/javascript' src='js/functions.js'> </script>
                </head>
    
  <body class='w3-blue-grey'>
        <!-- Sidebar start (Large Screens) -->
<div class='w3-sidebar w3-bar-block w3-dark-grey w3-card-2 w3-animate-left w3-hide-small w3-mobile' style='display:none' id='mySidebar'>
<div class='w3-container w3-white'>
    <h4><i class='fa fa-user-circle' aria-hidden='true'></i> <b><?php echo $_SESSION['username'];?></b></h4> 
  </div>
<button onclick='w3_close()' class='w3-bar-item w3-large'><i class='fa fa-times fa-1x' aria-hidden='true'></i></button> 
  <a href='dept_viewAllpub.php' class='w3-bar-item w3-button'>Departments</a> 
  <a href='#' class='w3-bar-item w3-button'>Schools</a> 
  <div class='w3-dropdown-hover'>
    <button class='w3-button'>Academics
      <i class='fa fa-caret-down'></i>
    </button>
    <div class='w3-dropdown-content w3-bar-block'>
      <a href='#' class='w3-bar-item w3-button'>Degree Programs</a>
      <a href='#' class='w3-bar-item w3-button'>Link</a>
    </div>
  </div> 
  <a href='#' class='w3-bar-item w3-button'>About</a> 
  <a href='#' class='w3-bar-item w3-button'>Contact Us</a> 
</div>
<!-- Sidebar end (Large Screens)  -->



<!-- Sidebar start (Small Screens)-->
<!--<div class='w3-sidebar w3-bar-block w3-dark-grey w3-card-2 w3-animate-left w3-hide-large w3-small w3-mobile app-menu' style='display:none' id='mySidebar2'>
<div class = 'w3-row'> 
 <div class='w3-half w3-white w3-container'>
    <h4><i class='fa fa-user-circle' aria-hidden='true'></i> <b><?php echo $_SESSION['username'];?></b></h4>  
  </div>
   <div class='w3-col s6 w3-margin-top w3-left'>
    <button onclick='w3_close()' class='w3-bar-item w3-large'><i class='fa fa-times fa-1x' aria-hidden='true'></i></button> 
  </div>
  <div class='w3-col s4 w3-margin-top w3-right'>
    <form action = '?' method = 'post'>
        <button type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-red w3-round w3-right' style='font-weight: bold'> 
          <i class='fa fa-sign-out fa-1x' aria-hidden='true'></i> Sign Out </button>
        </form> 
  </div>    
</div>
  <a href='dept_viewAllpub.php' class='w3-bar-item w3-button'><b>Departments</b></a> 
  <a href='#' class='w3-bar-item w3-button'><b>Schools</b></a> 
  <div class='w3-dropdown-hover'>
    <button class='w3-button'><b>Academics</b>
      <i class='fa fa-caret-down'></i>
    </button>
    <div class='w3-dropdown-content w3-bar-block'>
      <a href='#' class='w3-bar-item w3-button'>Degree Programs</a>
      <a href='#' class='w3-bar-item w3-button'>Link</a>
    </div>
  </div> 
  <a href='#' class='w3-bar-item w3-button'><b>About</b></a> 
  <a href='#' class='w3-bar-item w3-button'><b>Contact Us</b></a> 
  <div class='w3-dropdown-hover'>
    <button class='w3-button w3-teal w3-round' style='width:30%'><i class='fa fa-user fa-1x' aria-hidden='true'></i> <b> <?php echo $_SESSION['firstname'];?></b>
      <i class='fa fa-caret-down'></i>
    </button>
    <div class='w3-dropdown-content w3-bar-block'>
      <a href='personal_info.php' class='w3-bar-item w3-button'>Account</a>
    </div>
  </div> 
</div>-->
<!-- Sidebar start (Small Screens)-->
<div class = "menu">
<div class='w3-sidebar w3-bar-block w3-dark-grey w3-card-2 w3-small w3-hide-large app-menu' id='mySidebar2'>
  <div class = 'w3-row'> 
 <div class='w3-half w3-white w3-container'>
    <h4><i class='fa fa-user-circle' aria-hidden='true'></i> <b><?php echo $_SESSION['username'];?></b></h4>  
  </div>
   <div class='w3-col s6 w3-margin-top w3-left'>
    <button id = "close-button" class='w3-bar-item w3-large' onclick='toggleSideBarMobile()'><i class='fa fa-times fa-1x' aria-hidden='true'></i></button> 
  </div>
  <div class='w3-col s4 w3-margin-top w3-right'>
    <form action = '?' method = 'post'>
        <button type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-red w3-round w3-right' style='font-weight: bold'> 
          <i class='fa fa-sign-out fa-1x' aria-hidden='true'></i> Sign Out </button>
        </form> 
  </div>    
</div>
  <a href='dept_viewAllpub.php' class='w3-bar-item w3-button'><b>Departments</b></a> 
  <a href='#' class='w3-bar-item w3-button'><b>Schools</b></a> 
  <div class='w3-dropdown-hover'>
    <button class='w3-button'><b>Academics</b>
      <i class='fa fa-caret-down'></i>
    </button>
    <div class='w3-dropdown-content w3-bar-block'>
      <a href='#' class='w3-bar-item w3-button'>Degree Programs</a>
      <a href='#' class='w3-bar-item w3-button'>Link</a>
    </div>
  </div> 
  <a href='#' class='w3-bar-item w3-button'><b>About</b></a> 
  <a href='#' class='w3-bar-item w3-button'><b>Contact Us</b></a> 
  <div class='w3-dropdown-hover'>
    <button class='w3-button w3-teal w3-round' style='width:30%'><i class='fa fa-user fa-1x' aria-hidden='true'></i> <b> <?php echo $_SESSION['firstname'];?></b>
      <i class='fa fa-caret-down'></i>
    </button>
    <div class='w3-dropdown-content w3-bar-block'>
      <a href='personal_info.php' class='w3-bar-item w3-button'>Account</a>
    </div>
  </div>  
</div>
</div>
<!-- Sidebar end (Small Screens)-->


    <!-- Navbar start (small screens) -->
<div class='w3-hide-medium w3-opacity w3-hover-opacity-off w3-hide-large' id='myNavbar'>
  <div class='w3-bar w3-black w3-center w3-hover-opacity-off w3-small'>
  <button class='w3-bar-item w3-button w3-dark-grey w3-hover-grey' onclick='toggleSideBarMobile()' style = 'width:25%' id = "navButton"><b> <i class='fa fa-bars fa-2x' aria-hidden='true'></i> </b> </button> 
    <a href='student_home.php' class='w3-bar-item w3-button w3-hover-blue-grey' style = 'width:25%' >Home</a>
    <a href='schedule.php' class='w3-bar-item w3-button w3-hover-blue-grey' style = 'width:25%'>Master Schedule</a>
    <a href='catalog.php' class='w3-bar-item w3-button w3-hover-blue-grey' style = 'width:25%'>Master Catalog</a>
   <!-- <a href='catalog.php' class='w3-bar-item w3-button w3-hover-blue-grey' style = 'width:25%'>Academics</a>
    <a href='catalog.php' class='w3-bar-item w3-button w3-hover-blue-grey' style = 'width:25%'>Departments</a>
    <a href='catalog.php' class='w3-bar-item w3-button w3-hover-blue-grey' style = 'width:25%'>About</a>
    <a href='catalog.php' class='w3-bar-item w3-button w3-hover-blue-grey' style = 'width:25%'>Contact&nbsp;Us</a>
         <form action = '?' method = 'post'>
        <input type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-right w3-red' style = 'width:25%' value = 'Sign Out'>
        </form>-->
</div>
</div>
 <!-- Navbar end (small screens) -->


<div zclass='w3-main w3-container w3-padding-large' id='main'>

    
    <!-- Navbar start (large screens) -->
        <nav class='w3-bar w3-black w3-opacity-min w3-hover-opacity-off w3-hide-small'>
        <button class='w3-bar-item w3-button w3-dark-grey w3-hover-grey w3-hide-small w3-small' onclick='w3_open()'><i class='fa fa-bars fa-2x' aria-hidden='true'></i> </button> 
            <a class='w3-bar-item w3-button w3-hover-blue-grey w3-mobile' href='student_home.php'>Home</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey w3-mobile' href='schedule.php'>Master Schedule</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey w3-mobile' href='catalog.php'>Master Catalog</a>
        <form action = '?' method = 'post'>
        <button type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-round w3-right'> 
          <i class='fa fa-sign-out fa-1x' aria-hidden='true'></i> Sign Out </button>
        </form>
        <div class='w3-dropdown-click w3-right'>
            <button class='w3-button' onclick='open_dropdown()'><i class='fa fa-user fa-1x'></i> <?php echo $_SESSION['firstname'];?>
            <i class='fa fa-caret-down'></i> </button>
            <div class='w3-dropdown-content w3-bar-block w3-border' style='position:absolute; z-index: 2;' id = 'dropdown'>
                <a href='personal_info.php' class='w3-bar-item w3-button'>Account</a>
                <a href='#' class='w3-bar-item w3-button'>Academics</a>
            </div>
         </div>
    </nav>
    <!-- Navbar end (large screens) -->


    <!-- Background Image -->
<!--<div class="w3-display-container w3-center w3-wide image w3-grayscale-min">
  <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-small w3-hide-medium" style = "margin-bottom:40px">
  <h2 class = "w3-xxxlarge">BKJ Registration System</h2>
  <h2 class="w3-xxxlarge">Gupta University</h2>
 </div>
 <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-large" style = "margin-bottom:10px">
    <h2 class="w3-xxlarge w3-hide-large">BKJ Registration System</h2>
    <h2 class="w3-xxlarge w3-hide-large">Gupta University</h2>
  </div>
</div> -->

<!-- Header -->
  <header class="w3-container w3-center w3-padding-16 w3-white w3-hide-small">
    <h1 class="w3-xxxlarge"><b>Fortune University</b></h1>
    <h6>Welcome to <span class="w3-tag">KA Registration System</span></h6>
  </header>

<div class="w3-display-container w3-center w3-wide w3-hide-small image w3-grayscale-min">
  <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-small w3-hide-medium" style = "margin-bottom:40px">
  <!--<h2 class = "w3-xxxlarge">BKJ Registration System</h2>
  <h2 class="w3-xxxlarge">Gupta University</h2>-->
 </div>
</div>

<!-- Header -->
  <header class="w3-container w3-center w3-padding w3-white w3-hide-large">
    <h1 class="w3-xxxlarge"><b>Fortune University</b></h1>
    <h6>Welcome to <span class="w3-tag">KA Registration System</span></h6>
  </header>

<div class="w3-display-container w3-center w3-wide w3-hide-large image-small w3-grayscale-min">
 <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-large" style = "margin-bottom:10px">
  </div>
</div>


    <!-- Cards start -->
   <!-- <div class="w3-row-padding w3-margin-top w3-animate-right w3-card-4 w3-light-grey" style = "color:black"> -->
        <div class="w3-row-padding w3-margin-top w3-margin-top" style = "color:black; overflow-x: hidden"> 
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="academics/academics.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <!--<img src="img/file_icon.png"  alt="icon">-->
            <i class="fa fa-university fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Academics</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="registration/registration.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <!--<img src="img/file_icon.png"  alt="icon">-->
            <i class="fa fa-clipboard fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Registration</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->

        <a class="w3-quarter" style="text-decoration: none;" href="schedule/lookup_semester.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <i class="fa fa-calendar fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>View Schedule</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="registration/view_hold.php">
          <div class="w3-center w3-hover-blue-grey icons">
            <!--<img src="img/file_icon.png"  alt="icon">-->
            <i class="fa fa-folder fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>View Holds</h3>
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




    <script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "18%";
  document.getElementById("mySidebar").style.width = "18%";
  document.getElementById("mySidebar").style.display = "block";
 // document.getElementById("footer").style.marginLeft = "18%";
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  // document.getElementById("footer").style.marginLeft = "0%";
}

/***Function to open/close mobile sidebar ***/
function toggleSideBarMobile() {
	myMenu.classList.add("menu--animatable");	
	if(!myMenu.classList.contains("menu--visible")) {		
		myMenu.classList.add("menu--visible");
	} else {
		myMenu.classList.remove('menu--visible');		
	}	
}

function OnTransitionEnd() {
	myMenu.classList.remove("menu--animatable");
}

var myMenu = document.querySelector(".menu");
var closeButton = document.getElementById("close-button");
myMenu.addEventListener("transitionend", OnTransitionEnd, false);
//closeButton.addEventListener("click", toggleClassMenu, false);
/***Function to open/close mobile sidebar ***/


function open_dropdown() {
    var x = document.getElementById("dropdown");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
	</body>

</html>


