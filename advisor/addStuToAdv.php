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

if (isset($_GET['aname'])) {
    $_SESSION['advName'] = $_GET['aname'];
}

if (isset($_GET['id'])) {
    $_SESSION['facID'] = $_GET['id'];
}
htmlheader_root('w3-white');
?>


        <div class="w3-container">
            <h1>Assign Students to Advisor</h1>
            <h2><?php echo $_SESSION['advName']; ?></h2>
            <p>Select Students to advise:</p>
        </div>
        <div>
            <form class="w3-container" id="addMemForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                    <input class="w3-input w3-border w3-padding" style="width:45%;" type="text" placeholder="Search for student name.." id="myInput" onkeyup="filter_table_2nd_col()">
                    <div>
                        <input class="w3-btn w3-green" type="submit" name="addbutton" value="Add Student" />
                    </div>
                <div class="w3-container" style="float:left; width:50%">
                    <table class="w3-table-all w3-margin-top" id="myTable">
                        <tr>
                            <th style="width:25%;">Select Student</th>
                            <th style="width:25%;">Student Name</th>
                            <th style="width:25%;">Student Type</th>
                            <th style="width:25%;">Student ID</th>
                        </tr>
                        <?php getAllStuNoAdvisorCheckbox(); ?>
                    </table>
                </div>

            <?php

                if (isset($_POST['addbutton'])) {
                    $myaddbutton = trim($_POST['addbutton']);
                } else {
                    $myaddbutton = '';
                }

                if ($myaddbutton == 'Add Student') {

                    if (isset($_POST['student'])) {
                        $student = trim($_POST['student']);
                    } else {
                        $student = '';
                    }

                    $stuText = '';

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

                    //$rtninfo = insertMember($member,$_SESSION['deptID']);
                    $rtninfo = insertStuAdvArray($stuText);

                    if ($rtninfo == "NotAdded") {
                        print "<p style='color: red'>Member Not Added</p>";
                    } else {
                        //$sMember = getFLnameByID($_POST['member']);
                        print $rtninfo;
                        print "<p style='color: green'>Member has been Added!";
                    }
                }

            ?>
            <div class="w3-container" style="float:right; width:50%">
                <table class="w3-table-all w3-margin-top" id="myTable">
                    <tr>
                        <th colspan="2"><h3><b>Current Students</b></h3></th>
                    </tr>
                    <tr>
                        <th style="width:50%;">Student Name</th>
                        <th style="width:50%;">Student ID</th>
                    </tr>
                    <?php getStuByAdvisorTable($_SESSION['facID']) ?>
                </table>
            </div>
                </form>
        </div>
</div>

<?php
htmlfooter();
?>
