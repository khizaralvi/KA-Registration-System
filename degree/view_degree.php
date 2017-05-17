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
$sql = "SELECT degree_id, degree_name, degree_short, degree_type FROM degree";
if ($result = mysqli_query($conn, $sql)) {
				$resultTable = "<div class='w3-container' id='degree_table'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = 'degree_info.php' method = 'get'>
                               <thead>
                                <tr class='w3-light-grey'>
                                    <th> Degree Name </th>
                                    <th> Degree Short </th>
                                    <th> Degree Type </th>
                                </tr>
                                </thead>
                                ";
				while ($row = mysqli_fetch_array($result)) {
					$resultTable.= "<tr>
                                <td><a href = 'degree_info.php?degree=$row[0]'> $row[1] </a></td>
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

htmlheader_root('w3-white');

?>

    <form class="w3-container" action = "?" method = "post" id = "degreeForm">
        <div class="w3-section">
            <h1>View Degree</h1>
            <label style="font-size:120%;"> Search By Degree Type </label>
            <select id = "degree_type" name="degree_type">
                <option value="All">All</option>
                <option value="Associate">Associate</option>
                <option value="Bachelor">Bachelor</option>
                <option value="Master">Master</option>
                <option value="Doctorate">Doctorate</option>
            </select>
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
    var degree_type = document.getElementById('degree_type');

    degree_type.addEventListener('change', function() {
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById("degree_table").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","../ajax_requests.php?degree="+degree_type.value,true);
        xmlhttp.send();
    });

    }
 </script>

</div>

<?php
htmlfooter();
?>