<?php
    include("../php_functions.php");
    include("../header_footer.php");
    session_start();
    htmlheader_root();
?>



<div class="w3-panel">
    <form method="post" action="attendance.php">
        <input type="date" id="date2" name="date">
        <script>
    var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear();
if(dd<10){
    dd='0'+dd;
}
if(mm<10){
    mm='0'+mm;
}
//var today = dd+'-'+mm+'-'+yyyy;
            var today = yyyy+'-'+mm+'-'+dd;
    document.getElementById('date2').value = today;
</script>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Attendance</th>
            </tr>
            <?php
                if(isset($_POST["date"])){
                    getClass($_POST["date"],$_GET["crn"]);
                }else{
                    getClass(date_default_timezone_get(),$_GET["crn"]);
                }
            ?>
        </table>
        <button>Submit</button>
    </form>
</div>

<?php
    htmlfooter();
?>
