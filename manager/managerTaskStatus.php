<?php

require_once ('../process/dbh.php');
$sql = "SELECT * from `project` order by subdate desc";

//echo "$sql";
$result = mysqli_query($conn, $sql);

?>
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
	<title>Task Status |  Managers Panel</title>
	<link rel="stylesheet" type="text/css" href="../stylescss/employee_view_style.css">
</head>
<body>
	<header>
		<nav>
			<h1>Kinyanjui Farm.</h1>
			<ul id="navli">
			<li><a class="homeblack" href="managerHome.php?id=<?php echo $id?>"">HOME</a></li>
                <li><a class="homeblack" href="managerEmployee.php?id=<?php echo $id?>"">Add Employee</a></li>
                <li><a class="homeblack" href="managerViewEmployee.php?id=<?php echo $id?>"">View Employee</a></li>
                <li><a class="homeblack" href="mangerFarmSection.php?id=<?php echo $id?>"">Farm Section</a></li>
                <li><a class="homered" href="managerTaskStatus.php?id=<?php echo $id?>"">Task Status</a></li>
                <li><a class="homeblack" href="managerSalaryTable.php?id=<?php echo $id?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="managerEmployeeLeave.php?id=<?php echo $id?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="managerEmployeeApplyLeave.php?id=<?php echo $id?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="managerlogin.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	
	<div class="divider"></div>

		<table>
			<tr>

				<th align = "center">Task ID</th>
				<th align = "center">Emp. ID</th>
				<th align = "center">Task Details</th>
				<th align = "center">Due Date</th>
				<!-- <th align = "center">Submission Date</th> -->
				<th align = "center">Previous (Kgs) Harvested</th>
				<th align = "center">Status</th>
				<th align = "center">Option</th>
				
			</tr>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['pid']."</td>";
					echo "<td>".$employee['eid']."</td>";
					echo "<td>".$employee['pname']."</td>";
					echo "<td>".$employee['duedate']."</td>";
					// echo "<td>".$employee['subdate']."</td>";
					echo "<td>".$employee['mark']."</td>";
					echo "<td>".$employee['status']."</td>";
					echo "<td><a href=\"harvestEmployee.php?id=$employee[eid]&pid=$employee[pid]\">Harvested</a>"; 

				}


			?>

		</table>
		
	
</body>
</html>