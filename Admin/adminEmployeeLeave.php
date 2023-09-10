<?php
session_start();
require_once ('process/dbh.php');
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
$adminID = $_SESSION['admID'] = $id;
//echo "$adminID";

// Fetch employees and their ranks using JOIN
$sql = "SELECT * FROM `employee` e
        JOIN `rank` r ON e.id = r.eid";
$result = mysqli_query($conn, $sql);
$sql = "SELECT employee.id,employee.firstName,employee.lastName,salary.base,salary.bonus,salary.total from employee,`salary` where employee.id=salary.id";

//echo "$sql";
$result = mysqli_query($conn, $sql);

//$sql = "SELECT * from `employee_leave`";
$sql = "Select employee.id, employee.firstName, employee.lastName, employee_leave.start, employee_leave.end, employee_leave.reason, employee_leave.status, employee_leave.token From employee, employee_leave Where employee.id = employee_leave.id order by employee_leave.token";

//echo "$sql";
$result = mysqli_query($conn, $sql);

?>



<html>
<head>
	<title>Employee Leave | Admin Panel </title>
	<link rel="stylesheet" type="text/css" href="../stylescss/employee_view_style.css">
</head>
<body>
	
	<header>
		<nav>
			<h1>Kinyanjui Farm.</h1>
			<ul id="navli">
				<li><a class="homeblack" href="adminHome.php?id=<?php echo $id?>"">HOME</a></li>
                <li><a class="homeblack" href="adminAddEmployee.php?id=<?php echo $id?>"">Add Employee</a></li>
                <li><a class="homeblack" href="adminViewEmployee.php?id=<?php echo $id?>"">View Employee</a></li>
                <li><a class="homeblack" href="adminFarmSection.php?id=<?php echo $id?>"">Farm Section</a></li>
                <li><a class="homeblack" href="adminTaskStatus.php?id=<?php echo $id?>"">Task Status</a></li>
                <li><a class="homeblack" href="adminSalaryTable.php?id=<?php echo $id?>"">Salary Table</a></li> 
                <li><a class="homered" href="adminEmployeeLeave.php?id=<?php echo $id?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="adminApplyLeave.php?id=<?php echo $id?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="logout.php">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
		<table>
			<tr>
				<th>Emp. ID</th>
				<th>Token</th>
				<th>Name</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Total Days</th>
				<th>Reason</th>
				<th>Status</th>
				<th>Options</th>
			</tr>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {

				$date1 = new DateTime($employee['start']);
				$date2 = new DateTime($employee['end']);
				$interval = $date1->diff($date2);
				$interval = $date1->diff($date2);
				//echo "difference " . $interval->days . " days ";

					echo "<tr>";
					echo "<td>".$employee['id']."</td>";
					echo "<td>".$employee['token']."</td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['start']."</td>";
					echo "<td>".$employee['end']."</td>";
					echo "<td>".$interval->days."</td>";
					echo "<td>".$employee['reason']."</td>";
					echo "<td>".$employee['status']."</td>";
					echo "<td><a href=\"approve.php?id=$employee[id]&token=$employee[token]\"  onClick=\"return confirm('Are you sure you want to Approve the request?')\">Approve</a> | <a href=\"cancel.php?id=$employee[id]&token=$employee[token]\" onClick=\"return confirm('Are you sure you want to Canel the request?')\">Cancel</a></td>";

				}


			?>

		</table>
		
	</div>
</body>
</html>