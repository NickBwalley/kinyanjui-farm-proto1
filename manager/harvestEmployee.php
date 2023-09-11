<!-- NO Session  -->
<?php
session_start();
require_once('process/dbh.php');

$id = isset($_GET['id']) ? $_GET['id'] : '';
$pid = isset($_GET['pid']) ? $_GET['pid'] : '';
$sql = "SELECT pid, project.eid, pname, duedate, subdate, mark, points, firstName, lastName, base, bonus, total 
        FROM project 
        JOIN rank ON project.eid = rank.eid 
        JOIN employee ON project.eid = employee.id 
        JOIN salary ON project.eid = salary.id 
        WHERE project.eid = '$id' AND project.pid = '$pid'";

$result = mysqli_query($conn, $sql);
// Check if the session variable 'userID' is set
if (isset($_SESSION['manID'])) {
    // Access the userID from the session
    $userID = $_SESSION['manID'];

    // Now you can use $userID in your code
    echo "User ID: $userID";
} else {
    // Handle the case where the session variable is not set
    echo "User ID not found in session.";
}

if (isset($_POST['update'])) {
    $eid = mysqli_real_escape_string($conn, $_POST['eid']);
    $pid = mysqli_real_escape_string($conn, $_POST['pid']);
    $mark = mysqli_real_escape_string($conn, $_POST['mark']);
    
    // Calculate updated values
    $points = mysqli_real_escape_string($conn, $_POST['points']);
    $bonus = mysqli_real_escape_string($conn, $_POST['bonus']);
    $base = mysqli_real_escape_string($conn, $_POST['base']);
    $total = mysqli_real_escape_string($conn, $_POST['total']);
    $upPoint = $points + $mark;
    $upBonus = $bonus + $mark;
    $upSalary = $base + ($upBonus * $base) / 100;

    // Update records
    mysqli_query($conn, "UPDATE project SET mark='$mark' WHERE eid=$eid AND pid = $pid");
    mysqli_query($conn, "UPDATE rank SET points='$upPoint' WHERE eid=$eid");
    mysqli_query($conn, "UPDATE salary SET bonus='$upBonus', total='$upSalary' WHERE id=$eid");

    header("Location: managerHome.php?id=$userID");
}



$id = isset($_GET['id']) ? $_GET['id'] : '';
$pid = isset($_GET['pid']) ? $_GET['pid'] : '';
$sql1 = "SELECT pid, project.eid, project.pname, project.duedate, project.subdate, project.mark, rank.points, employee.firstName, employee.lastName, salary.base, salary.bonus, salary.total 
         FROM project 
         JOIN rank ON project.eid = rank.eid 
         JOIN employee ON project.eid = employee.id 
         JOIN salary ON project.eid = salary.id 
         WHERE project.eid = $id AND project.pid = $pid";

$result1 = mysqli_query($conn, $sql1);
if ($result1) {
    $res = mysqli_fetch_assoc($result1);
    $pname = $res['pname'];
    $duedate = $res['duedate'];
    $subdate = $res['subdate'];
    $firstName = $res['firstName'];
    $lastName = $res['lastName'];
    $mark = $res['mark'];
    $points = $res['points'];
    $base = $res['base'];
    $bonus = $res['bonus'];
    $total = $res['total'];
}

$mid = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if (!empty($mid)) {
    $managerSql = "SELECT * FROM `manager` WHERE id = '$mid'";
    $managerResult = mysqli_query($conn, $managerSql);

    if (!$managerResult) {
        die("Error fetching manager: " . mysqli_error($conn));
    }

    $manager = mysqli_fetch_array($managerResult);
    // $empName = $manager['firstName'];
}
?>


<!-- Your HTML and CSS code follows here -->

<html>
<head>
  <title>Specific Task | Kinyanjui Farm.</title>
  <!-- Icons font CSS-->
    <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- ../vendor CSS-->
    <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css/main.css" rel="stylesheet" media="all">
</head>
<body>
  <header>
    <nav>
      <h1>Kinyanjui Farm.</h1>
      <ul id="navli">
<<<<<<< HEAD:manager/harvestEmployee.php
      <li><a class="homeblack" href="managerHome.php?id=<?php echo $mid?>"">HOME</a></li>
                <li><a class="homeblack" href="managerEmployee.php?id=<?php echo $mid?>"">Add Employee</a></li>
                <li><a class="homeblack" href="managerViewEmployee.php?id=<?php echo $mid?>"">View Employee</a></li>
                <li><a class="homeblack" href="mangerFarmSection.php?id=<?php echo $mid?>"">Farm Section</a></li>
                <li><a class="homered" href="managerTaskStatus.php?id=<?php echo $mid?>"">Task Status</a></li>
                <li><a class="homeblack" href="managerSalaryTable.php?id=<?php echo $mid?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="managerEmployeeLeave.php?id=<?php echo $mid?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="managerEmployeeApplyLeave.php?id=<?php echo $mid?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="managerlogin.html">Log Out</a></li>
=======
        <li><a class="homeblack" href="eloginwel.php?id=<?php echo $id?>"">HOME</a></li>
                <li><a class="homeblack" href="maddemp.php?id=<?php echo $id?>"">Add Employee</a></li>
                <li><a class="homeblack" href="mviewemployee.php?id=<?php echo $id?>"">View Employee</a></li>
                <li><a class="homeblack" href="massign.php?id=<?php echo $id?>"">Assign Project</a></li>
                <li><a class="homered" href="massignproject.php?id=<?php echo $id?>"">Project Status</a></li>
                <li><a class="homeblack" href="msalaryemp.php?id=<?php echo $id?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="mempleave.php?id=<?php echo $id?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="mapplyleave.php?id=<?php echo $id?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="elogin.html">Log Out</a></li>
>>>>>>> 0f90779d6a636a8dbe9206718632ab5ef39fdc19:mark.php
      </ul>
    </nav>
  </header>
  
  <div class="divider"></div>
  

    <!-- <form id = "registration" action="edit.php" method="POST"> -->
  <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Harvested</h2>
                    <form id = "registration" action="harvestEmployee.php" method="POST">



                        <div class="input-group">
                          <p>Task Details</p>
                            <input class="input--style-1" type="text"  name="pname" value="<?php echo $pname;?>" readonly>
                        </div>
                       
                        
                        <div class="input-group">
                          <p>Employee Name</p>
                            <input class="input--style-1" type="text" name="firstName" value="<?php echo $firstName;?> <?php echo $lastName;?>" readonly>
                        </div>

                       
                        <div class="input-group">
                          <input class="input--style-1" type="hidden" name="duedate" value="<?php echo $duedate;?>" readonly>
                          <input class="input--style-1" type="hidden"  name="subdate" value="<?php echo $subdate;?>" readonly>
                          <p>Kgs Harvested</p>
                            <input class="input--style-1" type="text"  name="mark" value="<?php echo $mark;?>">
                        </div>

                       
                        <input type="hidden" name="eid" id="textField" value="<?php echo $id;?>" required="required">
                        <input type="hidden" name="pid" id="textField" value="<?php echo $pid;?>" required="required">
                         <input type="hidden" name="points" id="textField" value="<?php echo $points;?>" required="required">
                        <input type="hidden" name="base" id="textField" value="<?php echo $base;?>" required="required">
                        <input type="hidden" name="bonus" id="textField" value="<?php echo $bonus;?>" required="required">
                        <input type="hidden" name="total" id="textField" value="<?php echo $total;?>" required="required">
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" name="update">Submit</button>
                        </div>
                        
                    </form>
                    <br>
                    
                </div>
            </div>
        </div>
    </div>


</body>
</html>