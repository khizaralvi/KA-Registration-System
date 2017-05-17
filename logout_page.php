<?php
header("refresh:3; url=index.php");
?>

<html>
	<head>
		<title>BJS Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	</head>

	<body>
        <div class="w3-container" >
            <div class="w3-padding-64 w3-center">
                <h3>You have successfully logged out</h3>
                <!--<i class="material-icons w3-spin w3-xxxlarge">refresh</i>-->
                <i class="fa fa-spinner fa-3x w3-spin" aria-hidden="true"></i>
                <h5>Redirecting to <a href = "index.php">Homepage</a></h5>
            </div>
        </div>
    </body>
</html>
