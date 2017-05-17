<?php
include '../header_footer.php';
header('Refresh: 3;url=search_dept.php');

include '../php_functions.php';
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
  header("Location: ../logout_page.php");
}
htmlheader_root('w3-white');
?>

        <?php

           $conn = mysqlConnect();

            if (isset($_POST['id'])){
                $dept_id = $_POST['id'];
            }

            if (isset($_POST['dept'])){
                $dept_name = $_POST['dept'];
            }

            if (isset($_POST['school'])){
                $school_id = $_POST['school'];
            }

            if (isset($_POST['chair'])){
                $chair_id = $_POST['chair'];
            }

            $sql = "UPDATE department
                    SET dept_name = '$dept_name', chair_id = $chair_id, school_id = $school_id
                    WHERE dept_id = $dept_id;";

            if (mysqli_query($conn, $sql)) {
                echo "<h1 style='margin-left:15px'>The department was updated successfully</h1>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);

            //redirectPageCountDown()
        ?>

        <script type="text/javascript">
            (function () {
                var timeLeft = 3,
                    cinterval;

                var timeDec = function (){
                    timeLeft--;
                    document.getElementById('countdown').innerHTML = timeLeft;
                    if(timeLeft === 0){
                        clearInterval(cinterval);
                    }
                };

                cinterval = setInterval(timeDec, 1000);
            })();

        </script>
        <br><p><b>Redirecting in <span id="countdown">3</span></b></p>


</div>

<?php
htmlfooter();
?>
