<?php


function htmlheader($color = NULL){

if (isset($_SESSION['usertype'])){

    if ($_SESSION['usertype'] == 'A') {
        $home = "admin_home.php";
    }
    else if ($_SESSION['usertype'] == 'S') {
        $home = "student_home.php";
    }
    else if ($_SESSION['usertype'] == 'F') {
        $home = "faculty_home.php";
    }
    else if ($_SESSION['usertype'] == 'R') {
        $home = "research_home.php";
    }
}
else {
    $home = "index.php";
}

if ($color == NULL) {
    $body_color = 'w3-blue-grey';
}
else {
    $body_color = $color;
}


    echo "<!doctype html>
            <html>
                <head>
                    <title>BJK Registration</title>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='https://www.w3schools.com/lib/w3.css'>
    <link rel='stylesheet' href='css/styles.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-signal.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-2017.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script type='text/javascript' src='js/functions.js'> </script>
    <script src='js/css.js' type='text/javascript'></script>
                </head>";
    
    echo "</span><body class=$body_color>
        <!-- Sidebar start (Large Screens) -->
<div class='w3-sidebar w3-bar-block w3-dark-grey w3-card-2 w3-animate-left w3-hide-small w3-mobile' style='display:none' id='mySidebar'>
<div class='w3-container w3-white'>
    <h4><i class='fa fa-user-circle' aria-hidden='true'></i> <b>";echo $_SESSION['username']; 
    echo "</b></h4> 
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
<div class='w3-sidebar w3-bar-block w3-dark-grey w3-card-2 w3-animate-left w3-hide-large w3-small w3-mobile' style='display:none' id='mySidebar2'>
<div class = 'w3-row'> 
 <div class='w3-half w3-white w3-container'>
    <h4><i class='fa fa-user-circle' aria-hidden='true'></i> <b>"; echo $_SESSION['username']; 
    echo "</b></h4>  
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
    <button class='w3-button w3-teal w3-round' style='width:30%'><i class='fa fa-user fa-1x' aria-hidden='true'></i> <b> "; echo $_SESSION['firstname']; 
    echo "</b>
      <i class='fa fa-caret-down'></i>
    </button>
    <div class='w3-dropdown-content w3-bar-block'>
      <a href='personal_info.php' class='w3-bar-item w3-button'>Account</a>
    </div>
  </div> 
</div>
<!-- Sidebar end (Small Screens)-->


    <!-- Navbar start (small screens) -->
<div class='w3-hide-medium w3-opacity w3-hover-opacity-off w3-hide-large' id='myNavbar'>
  <div class='w3-bar w3-black w3-center w3-hover-opacity-off w3-small'>
  <button class='w3-bar-item w3-button w3-dark-grey w3-hover-grey'  onclick='w3_open()' style = 'width:25%'><b> <i class='fa fa-bars fa-2x' aria-hidden='true'></i> </b> </button> 
    <a href='$home' class='w3-bar-item w3-button w3-hover-blue-grey' style = 'width:25%' >Home</a>
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
            <a class='w3-bar-item w3-button w3-hover-blue-grey w3-mobile' href='$home'>Home</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey w3-mobile' href='schedule.php'>Master Schedule</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey w3-mobile' href='catalog.php'>Master Catalog</a>
        <form action = '?' method = 'post'>
        <button type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-round w3-right'> 
          <i class='fa fa-sign-out fa-1x' aria-hidden='true'></i> Sign Out </button>
        </form>";


        if (isset($_SESSION['usertype'])){
            echo "<div class='w3-dropdown-click w3-right'>";
            echo "<button class='w3-button' onclick='open_dropdown()'><i class='fa fa-user fa-1x'></i> ";
            echo $_SESSION['firstname'];
            echo " <i class='fa fa-caret-down'></i> </button>";
            echo "<div class='w3-dropdown-content w3-bar-block w3-border' style='position:absolute; z-index: 2;' id = 'dropdown'>
                <a href='personal_info.php' class='w3-bar-item w3-button'>Account</a>
                <a href='#' class='w3-bar-item w3-button'>Academics</a>
                </div></div>";
        }



    echo "</nav>
    <!-- Navbar end (large screens) -->
";

}


function htmlheader_root($color = NULL){
        if ($_SESSION['usertype'] == 'A') {
  $home = "../admin_home.php";
}
else if ($_SESSION['usertype'] == 'S') {
  $home = "../student_home.php";
}
else if ($_SESSION['usertype'] == 'F') {
  $home = "../faculty_home.php";
}
else if ($_SESSION['usertype'] == 'R') {
  $home = "../research_home.php";
}

if ($color == NULL) {
    $body_color = 'w3-blue-grey';
}
else {
    $body_color = $color;
}
    echo "<!doctype html>
            <html>
                <head>
                    <title>BJK Registration</title>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='https://www.w3schools.com/lib/w3.css'>
    <link rel='stylesheet' href='../css/styles.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-signal.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-2017.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script type='text/javascript' src='../js/functions.js'> </script>
    <script src='../js/css.js' type='text/javascript'></script>
                </head>";
    
    echo "</span><body class=$body_color>
        <!-- Sidebar start (Large Screens) -->
<div class='w3-sidebar w3-bar-block w3-dark-grey w3-card-2 w3-animate-left w3-hide-small w3-mobile' style='display:none' id='mySidebar'>
<div class='w3-container w3-white'>
    <h4><i class='fa fa-user-circle' aria-hidden='true'></i> <b>";echo $_SESSION['username']; 
    echo "</b></h4> 
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
<div class='w3-sidebar w3-bar-block w3-dark-grey w3-card-2 w3-animate-left w3-hide-large w3-small w3-mobile' style='display:none' id='mySidebar2'>
<div class = 'w3-row'> 
 <div class='w3-half w3-white w3-container'>
    <h4><i class='fa fa-user-circle' aria-hidden='true'></i> <b>"; echo $_SESSION['username']; 
    echo "</b></h4>  
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
    <button class='w3-button w3-teal w3-round' style='width:30%'><i class='fa fa-user fa-1x' aria-hidden='true'></i> <b>";echo $_SESSION['firstname']; 
    echo "</b>
      <i class='fa fa-caret-down'></i>
    </button>
    <div class='w3-dropdown-content w3-bar-block'>
      <a href='../personal_info.php' class='w3-bar-item w3-button'>Account</a>
    </div>
  </div> 
</div>
<!-- Sidebar end (Small Screens)-->


    <!-- Navbar start (small screens) -->
<div class='w3-hide-medium w3-opacity w3-hover-opacity-off w3-hide-large' id='myNavbar'>
  <div class='w3-bar w3-black w3-center w3-hover-opacity-off w3-small'>
  <button class='w3-bar-item w3-button w3-dark-grey w3-hover-grey'  onclick='w3_open()' style = 'width:25%'><b> <i class='fa fa-bars fa-2x' aria-hidden='true'></i> </b> </button> 
    <a href='$home' class='w3-bar-item w3-button w3-hover-blue-grey' style = 'width:25%' >Home</a>
    <a href='../schedule.php' class='w3-bar-item w3-button w3-hover-blue-grey' style = 'width:25%'>Master Schedule</a>
    <a href='../catalog.php' class='w3-bar-item w3-button w3-hover-blue-grey' style = 'width:25%'>Master Catalog</a>
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
            <a class='w3-bar-item w3-button w3-hover-blue-grey w3-mobile' href='$home'>Home</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey w3-mobile' href='../schedule.php'>Master Schedule</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey w3-mobile' href='../catalog.php'>Master Catalog</a>
        <form action = '?' method = 'post'>
        <button type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-round w3-right'> 
          <i class='fa fa-sign-out fa-1x' aria-hidden='true'></i> Sign Out </button>
        </form>
        <div class='w3-dropdown-click w3-right'>
            <button class='w3-button' onclick='open_dropdown()'><i class='fa fa-user fa-1x'></i> ";
            echo $_SESSION['firstname'];
            echo " <i class='fa fa-caret-down'></i> </button>
            <div class='w3-dropdown-content w3-bar-block w3-border' style='position:absolute; z-index: 2;' id = 'dropdown'>
                <a href='../personal_info.php' class='w3-bar-item w3-button'>Account</a>
                <a href='#' class='w3-bar-item w3-button'>Academics</a>
            </div>
         </div>
    </nav>
    <!-- Navbar end (large screens) -->
";

}


function htmlfooter(){
Echo "
<script>
function w3_open() {
  document.getElementById('main').style.marginLeft = '18%';
  document.getElementById('mySidebar').style.width = '18%';
  document.getElementById('mySidebar').style.display = 'block';
  document.getElementById('mySidebar2').style.width = '15%';
  document.getElementById('mySidebar2').style.display = 'block';
}
function w3_close() {
  document.getElementById('main').style.marginLeft = '0%';
  document.getElementById('mySidebar').style.display = 'none';
  document.getElementById('mySidebar2').style.display = 'none';
}

function open_dropdown() {
    var x = document.getElementById('dropdown');
    if (x.className.indexOf('w3-show') == -1) {
        x.className += ' w3-show';
    } else { 
        x.className = x.className.replace(' w3-show', '');
    }
}
</script>
</body>
</html>";
}


?>
