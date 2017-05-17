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

$conn = mysqlConnect();
$sql1 = "Select dept_id, dept_name from department";
$sql2 = "Select degree_id, degree_name from degree";
$departments = "";
$degrees = "";
if ($result = mysqli_query($conn, $sql1)) {
    while ($row = mysqli_fetch_array($result)) {
        $departments .= "<option value = $row[0]> $row[1] </option>";
    }
}
else {
    echo "failed " . mysqli_error();
}
if ($result = mysqli_query($conn, $sql2)) {
    while ($row = mysqli_fetch_array($result)) {
        $degrees .= "<option value = $row[0]> $row[1] </option>";
    }
}
else {
    echo "failed " . mysqli_error();
}
mysqli_close($conn);


$conn = mysqlConnect();
$sql = "SELECT major.major_id, major.major_name, IFNULL(department.dept_name, 'N/A'), IFNULL(degree.degree_name, 'N/A') FROM major 
LEFT OUTER JOIN department ON major.dept_id = department.dept_id LEFT OUTER JOIN degree ON major.degree_id = degree.degree_id";
if ($result = mysqli_query($conn, $sql)) {
				$resultTable = "<div class='w3-container' id='major_table'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = 'degree_info.php' method = 'get'>
                               <thead>
                                <tr class='w3-light-grey'>
                                    <th> Major Name </th>
                                    <th> Department </th>
                                    <th> Degree </th>
                                </tr>
                                </thead>
                                ";
				while ($row = mysqli_fetch_array($result)) {
					$resultTable.= "<tr>
                                <td><a href = 'major_info.php?major=$row[0]'> $row[1] </a></td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                </tr>";
				}
                $resultTable .= "</form></table></div>";
       }
       else {
           $resultTable = "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Couldn't connect to the server</p>
                        </div>";
       }
mysqli_close($conn);

htmlheader_root('w3-white');
?>


    <h1 style="margin-left:15px">View Majors</h1>
        <form class="w3-container" action = "?" method = "post" id = "degreeForm">
    <div class="w3-section">
    <label style="font-size:120%;"> Search By Department </label>
        <select id = "department" name="department">
        <option value="All">All</option>
        <?php echo $departments?>
        </select>

      <!--  <label style="font-size:130%;"> Search By Degree </label>
        <select id = "degree" name="degree">
        <option value="All">All</option>
        
        </select>-->
    </div>
    </form>

   <?php echo isset($resultTable) ? $resultTable : ''?>

<script>
    window.onload = function() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    var degree = document.getElementById('degree');
    var department = document.getElementById('department');

    department.addEventListener('change', function() {
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById("major_table").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","../ajax_requests.php?department="+department.value,true);
        xmlhttp.send();
    });

    /**degree.addEventListener('change', function() {
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById("major_table").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","../ajax_requests.php?major_degree="+degree.value,true);
        xmlhttp.send();
    });**/

     

    }
 </script>

</div>

<?php
htmlfooter();
?>
