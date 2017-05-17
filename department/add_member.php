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

if (isset($_GET['dname'])) {
    $_SESSION['deptName'] = $_GET['dname'];
}

if (isset($_GET['id'])) {
    $_SESSION['deptID'] = $_GET['id'];
}
 htmlheader_root('w3-white');
?>
<!-- In PHP check cookies id not there redirect to main page or display not logged in -->

        <div class="w3-container">
            <h1><?php echo $_SESSION['deptName']; ?></h1>
            <h3>Add Department Members</h3>

            <form class="w3-container" id="addMemForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <label class="w3-label w3-white">Select faculty members to add:</label>
                <div class="w3-container">
                    <table class="w3-table-all w3-margin-top" id="myTable">
                        <tr>
                            <th style="width:10%;">Select Member</th>
                            <th style="width:30%;">Member Name</th>
                            <th style="width:30%;">Member Telephone</th>
                            <th style="width:30%;">Member Email</th>
                        </tr>
                        <?php getAllFacultyNotMembCheckbox(); ?>
                    </table>
                    <input class="w3-btn w3-green" type="submit" name="addbutton" value="Add Member" />
                </div>
            </form>
        </div>
        <?php

            if (isset($_POST['addbutton'])) {
                $myaddbutton = trim($_POST['addbutton']);
            } else {
                $myaddbutton = '';
            }

            if ($myaddbutton == 'Add Member') {

                if (isset($_POST['member'])) {
                    $member = trim($_POST['member']);
                } else {
                    $member = '';
                }

                $memText = '';

                if(!empty($_POST['memberlist'])) {
                    $memDeptID = $_SESSION['deptID'];
                    $memListLength = count($_POST['memberlist']);
                    $count = 0;

                    foreach($_POST['memberlist'] as $mem_id) {
                        $memText .= "($mem_id,$memDeptID)";
                        $count++;

                        if($count<$memListLength){ $memText .= ","; }
                    }
                }

                //$rtninfo = insertMember($member,$_SESSION['deptID']);
                $rtninfo = insertMemberArray($memText);

                if ($rtninfo == "NotAdded") {
                    print "<p style='color: red'>Member Not Added</p>";
                } else {
                    //$sMember = getFLnameByID($_POST['member']);
                    print $rtninfo;
                    print "<p style='color: green'>Member has been Added!";
                }
            }

        ?>
        <div class="w3-container">
            <h3>Current Department Members:</h3>
            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:33%;">Member Name</th>
                    <th style="width:33%;">Member Telephone</th>
                    <th style="width:33%;">Member Email</th>
                </tr>
                <?php getAllFacultyMembTable($_SESSION['deptID']) ?>
            </table>
        </div>

</div>

<?php
htmlfooter();
?>