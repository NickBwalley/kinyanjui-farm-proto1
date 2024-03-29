<?php
session_start();
require_once('process/dbh.php'); // Make sure this file includes your database connection ($conn).
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
$adminID = $_SESSION['admID'] = $id;
//echo "$adminID";

// Fetch employees and their ranks using JOIN
$sql = "SELECT * FROM `employee` e
        JOIN `rank` r ON e.id = r.eid";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
   

    <!-- Title Page-->
    <title>Farm Section | Admin Panel</title>

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
                <li><a class="homeblack" href="adminHome.php?id=<?php echo $id?>"">HOME</a></li>
                <li><a class="homeblack" href="adminAddEmployee.php?id=<?php echo $id?>"">Add Employee</a></li>
                <li><a class="homeblack" href="adminViewEmployee.php?id=<?php echo $id?>"">View Employee</a></li>
                <li><a class="homered" href="adminFarmSection.php?id=<?php echo $id?>"">Farm Section</a></li>
                <li><a class="homeblack" href="adminTaskStatus.php?id=<?php echo $id?>"">Task Status</a></li>
                <li><a class="homeblack" href="adminSalaryTable.php?id=<?php echo $id?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="adminEmployeeLeave.php?id=<?php echo $id?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="adminApplyLeave.php?id=<?php echo $id?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="divider"></div>




    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Farm Section</h2>
                    <form action="process/adminFarmProcess.php" method="POST" enctype="multipart/form-data">


                        

                         <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Employee ID" name="eid" required="required">
                        </div>





                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Task Details" name="pname" required="required">
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="date" name="duedate" required="required">
                                   
                                </div>
                            </div>
                            
                        </div>
                        
                        



                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <!-- ../vendor JS-->
    <script src="../vendor/select2/select2.min.js"></script>
    <script src="../vendor/datepicker/moment.min.js"></script>
    <script src="../vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
<!-- end document-->
