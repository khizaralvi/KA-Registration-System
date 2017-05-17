<?php
include '../header_footer.php';
include "../php_functions.php";
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

if (isset($_GET['sname'])) {
    $_SESSION['stuName'] = $_GET['sname'];
}

if (isset($_GET['id'])) {
    $_SESSION['stuID'] = $_GET['id'];
}


htmlheader_root('w3-white');
?>

        <div class="w3-container">
            <h1>Assign Advisor to Student</h1>
            <h2><?php echo $_SESSION['stuName']; ?></h2>
            <p>Assign advisor to student:</p>

            <form class="w3-container" id="addMemForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <label class="w3-label w3-blue-grey">Select an advisor:</label>
                <select class="w3-select w3-border" name="advisor">
                    <?php getAllFaculty(); ?>
                </select>
                <div>
                    <input class="w3-btn w3-green" type="submit" name="addbutton" value="Assign Advisor" />
                </div>
            </form>
        </div>
        <?php

            $isAssigned = isAssignedAdvisor($_SESSION['stuID']);

            if (isset($_POST['addbutton'])) {
                $myaddbutton = trim($_POST['addbutton']);
            } else {
                $myaddbutton = '';
            }

            if ($myaddbutton == 'Assign Advisor') {

                if (isset($_POST['advisor'])) {
                    $advisor = trim($_POST['advisor']);
                } else {
                    $advisor = '';
                }

                $advText = '';



/*
                if(!empty($_POST['studentlist'])) {
                    $advFacID = $_SESSION['facID'];
                    $stuListLength = count($_POST['studentlist']);
                    $count = 0;

                    foreach($_POST['studentlist'] as $stu_id) {
                        $stuText .= "($advFacID,$stu_id)";
                        $count++;

                        if($count<$stuListLength){ $stuText .= ","; }
                    }
                }
*/
                //$rtninfo = insertMember($member,$_SESSION['deptID']);
                $rtninfo = insertStuAdv($advisor,$_SESSION['stuID'],$isAssigned);

                if ($rtninfo == "NotAdded") {
                    print "<p style='color: red'>Member Not Added</p>";
                } else {
                    //$sMember = getFLnameByID($_POST['member']);
                    print $rtninfo;
                    print "<p style='color: green'>Member has been Added!";
                }
            }

        ?>
        <div class="w3-container" >
            <h3><b>Current Advisor:</b></h3>
            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:33%;">Advisor Name</th>
                    <th style="width:33%;">Advisor Telephone</th>
                    <th style="width:33%;">Advisor Email</th>
                </tr>
                <?php getAdvisorByStuTable($_SESSION['stuID']); ?>
            </table>
        </div>
</div>

<?php
htmlfooter();
?>
