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

htmlheader('w3-white');
?>



    <div class = "w3-container">
    <h2> Search <?php
echo ucfirst($_SESSION['user_category']) ?> Account </h2>
    </div>



    <?php
?>

    <?php

if (isset($_SESSION['user_category']) && $_SESSION['user_category'] == "administrator") {
?>
            <div class="w3-container">
                             <form action = "?" method = "post">
                                <input class = "w3-round login w3-padding-medium" type = "number" placeholder="Search By User ID" id = "search_user_ID" name = "search_user_ID">
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By First Name" id = "search_first_name" name = "search_first_name">  
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By Last Name" id = "search_last_name" name = "search_last_name"> <br />
                                <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Search User">
								<input class="w3-btn w3-blue-grey w3-section" type="submit" name = "display" value = "Display All">
                            </form>
                            <?php
	                        echo isset($message) ? $message : '';
?>
                            </div>
 <?php
	if (isset($_POST['submit'])) {
		$user_id = $_POST['search_user_ID'];
		$first_name = $_POST['search_first_name'];
		$last_name = $_POST['search_last_name'];
		$searchFields = array();
		if ($user_id !== "") {
			$searchFields['user_id'] = $_POST['search_user_ID'];
		}

		if ($first_name !== "") {
			$searchFields['first_name'] = $_POST['search_first_name'];
		}

		if ($last_name !== "") {
			$searchFields['last_name'] = $_POST['search_last_name'];
		}

		 searchAccount($searchFields, 'admin', 'delete');
	}

	if (isset($_POST['display'])) {
		$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_type = 'A'";
		$conn = mysqlConnect();
		$result = mysqli_query($conn, $sql);
		if (!mysqli_num_rows($result) == 0) {
				$resultTable = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = 'account_info.php' method = 'get'>
                               <thead>
                                <tr class='w3-light-grey'>
                                    <th> User_ID </th>
                                    <th> First Name </th>
                                    <th> Last Name </th> 
                                    <th> Date Of Birth </th>
                                    <th> Email </th>
                                    <th> Number  </th>
                                    <th> Username </th>
                                </tr>
                                </thead>
                                ";
				while ($row = mysqli_fetch_array($result)) {
                    //<td><input type = 'checkbox' name = 'checkbox[]' value = $row[0]> <a href = 'account_info.php?account=$row[0]'> $row[0] </a></td>
					$resultTable.= "<tr>  
                                <td><a href = 'account_info.php?account=$row[0]'> $row[0] </a></td>
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                <td>$row[6]</td>
                                </tr>";
				}
				//$resultTable.= "</table><input class='w3-btn w3-blue-grey w3-section' type='submit' name = 'Delete' value = 'Delete User'></form></div>";
				echo ($resultTable);
	    }
	}

	/**if (isset($_GET['Delete']) && isset($_GET['checkbox'])) {
		$message = deleteAccount();
	}
	else
	if (isset($_GET['Delete']) && !isset($_POST['checkbox'])) {
        $message = "<div class='w3-container w3-pale-green'>
                         <h3>Failure</h3>
                        <p>Please select one of the checkboxes to delete user.</p>
                        </div>";
	}**/
}
else
if (isset($_SESSION['user_category']) && $_SESSION['user_category'] == "research") {
?>
            <div class="w3-container">
                             <form action = "?" method = "post">
                                <input class = "w3-round login w3-padding-medium" type = "number" placeholder="Search By User ID" id = "search_user_ID" name = "search_user_ID">
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By First Name" id = "search_first_name" name = "search_first_name">  
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By Last Name" id = "search_last_name" name = "search_last_name"> <br />
                                <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Search User">
                            </form>
                            <?php
	                        echo isset($message) ? $message : '';
?>
                            </div>
 <?php
	if (isset($_POST['submit'])) {
		$user_id = $_POST['search_user_ID'];
		$first_name = $_POST['search_first_name'];
		$last_name = $_POST['search_last_name'];
		$searchFields = array();
		if ($user_id !== "") {
			$searchFields['user_id'] = $_POST['search_user_ID'];
		}

		if ($first_name !== "") {
			$searchFields['first_name'] = $_POST['search_first_name'];
		}

		if ($last_name !== "") {
			$searchFields['last_name'] = $_POST['search_last_name'];
		}

		 searchAccount($searchFields, 'research', 'delete');
	}

}
else
if (isset($_SESSION['user_category']) && $_SESSION['user_category'] == "student") {
?>
            <div class="w3-container">
                             <form action = "?" method = "post">
                                <input class = "w3-round login w3-padding-medium" type = "number" placeholder="Search By Student ID" id = "search_user_ID" name = "search_user_ID">
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By First Name" id = "search_first_name" name = "search_first_name">  
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By Last Name" id = "search_last_name" name = "search_last_name"> <br />
                                <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Search User">
                            </form>
                            <?php

	// echo isset($resultTable) ? $resultTable : '';

?>
                            </div>
 <?php
	if (isset($_POST['submit'])) {
		$user_id = $_POST['search_user_ID'];
		$first_name = $_POST['search_first_name'];
		$last_name = $_POST['search_last_name'];
		$searchFields = array();
		if ($user_id !== "") {
			$searchFields['user_id'] = $_POST['search_user_ID'];
		}

		if ($first_name !== "") {
			$searchFields['first_name'] = $_POST['search_first_name'];
		}

		if ($last_name !== "") {
			$searchFields['last_name'] = $_POST['search_last_name'];
		}

		searchAccount($searchFields, "student", 'delete');
	}
}
else
if (isset($_SESSION['user_category']) && $_SESSION['user_category'] == "faculty") {
?>
            <div class="w3-container">
                             <form action = "?" method = "post">
                                <input class = "w3-round login w3-padding-medium" type = "number" placeholder="Search By Faculty ID" id = "search_user_ID" name = "search_user_ID">
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By First Name" id = "search_first_name" name = "search_first_name">  
                                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By Last Name" id = "search_last_name" name = "search_last_name"> <br />
                                <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Search User">
                            </form>
                            <?php

	// echo isset($resultTable) ? $resultTable : '';

?>
</div>

 <?php
	if (isset($_POST['submit'])) {
		$user_id = $_POST['search_user_ID'];
		$first_name = $_POST['search_first_name'];
		$last_name = $_POST['search_last_name'];
		$searchFields = array();
		if ($user_id !== "") {
			$searchFields['user_id'] = $_POST['search_user_ID'];
		}

		if ($first_name !== "") {
			$searchFields['first_name'] = $_POST['search_first_name'];
		}

		if ($last_name !== "") {
			$searchFields['last_name'] = $_POST['search_last_name'];
		}

		searchAccount($searchFields, 'faculty', 'delete');
	}
}

?>
   
</div>

<?php
htmlfooter();
?>