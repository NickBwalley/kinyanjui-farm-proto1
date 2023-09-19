<?php 
require_once('../process/dbh.php');

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if (!empty($id)) {
    $managerSql = "SELECT * FROM `manager` WHERE id = '$id'";
    $managerResult = mysqli_query($conn, $managerSql);

    if (!$managerResult) {
        die("Error fetching manager: " . mysqli_error($conn));
    }

    $manager = mysqli_fetch_array($managerResult);
    // $empName = $manager['firstName'];
}
?>

<html>
<head>
	<title>Apply Leave | Managers Panel </title>
	<link rel="stylesheet" type="text/css" href="../stylescss/employee_apply_leave.css">
</head>
<body bgcolor="#F0FFFF">
	
	<header>
		<nav>
			<h1>Kinyanjui Farm.</h1>
			<ul id="navli">
            <li><a class="homeblack" href="managerHome.php?id=<?php echo $id?>"">HOME</a></li>
                <li><a class="homeblack" href="managerEmployee.php?id=<?php echo $id?>"">Add Employee</a></li>
                <li><a class="homeblack" href="managerViewEmployee.php?id=<?php echo $id?>"">View Employee</a></li>
                <li><a class="homeblack" href="managerFarmSection.php?id=<?php echo $id?>"">Farm Section</a></li>
                <li><a class="homeblack" href="managerTaskStatus.php?id=<?php echo $id?>"">Task Status</a></li>
                <li><a class="homeblack" href="managerSalaryTable.php?id=<?php echo $id?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="managerEmployeeLeave.php?id=<?php echo $id?>"">Employee Leave</a></li>
                <li><a class="homered" href="managerEmployeeApplyLeave.php?id=<?php echo $id?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="managerlogin.html">Log Out</a></li>

			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Apply Leave Form</h2>
                    <form action="process/employeeApplyLeaveProcess.php?id=<?php echo $id?>" method="POST">


                        <div class="input-group">
                            
                            <select name="empname">
                                <option value="">---Select Employee Name for Leave Request---</option>
                                <?php
                                require_once('process/dbh.php');
                                $sql = "SELECT firstName, lastName FROM employee";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) { 
                                        echo "<option value='" . $row['firstName'] . " " . $row['lastName'] . "'>" . $row['firstName'] . " " . $row['lastName'] . "</option>";
                                    }
                                }
                                ?>
                            </select>

                        </div>

                    

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Reason" name="reason">
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                            	<p>Start Date</p>
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="start" name="start">
                                   
                                </div>
                            </div>
                            <div class="col-2">
                            	<p>End Date</p>
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="end" name="end">
                                   
                                </div>
                            </div>
                        </div>
                        



                        <div class="p-t-20">
<<<<<<< HEAD
                            <button class="btn btn--radius btn--green" type="submit" name="apply">Submit</button>
=======
                            <button class="btn btn--radius btn--green" type="submit" name="apply">Apply</button>
>>>>>>> 2bf190e7d93a55911507d454a928a9f3bd14af89
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>