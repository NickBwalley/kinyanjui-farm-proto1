
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



<?php 
require_once('process/dbh.php');

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if (!empty($id)) {
    $managerSql = "SELECT * FROM `manager` WHERE id = '$id'";
    $managerResult = mysqli_query($conn, $managerSql);

    if (!$managerResult) {
        die("Error fetching employee: " . mysqli_error($conn));
    }

    $manager = mysqli_fetch_array($managerResult);
    // $empName = $manager['firstName'];
}
?>




<html>
<head>
	<title>View Employee |  Admins Panel </title>
	<link rel="stylesheet" type="text/css" href="../stylescss/employee_view_style.css">
</head>
<body>
	<header>
		<nav>
			<h1>Kinyanjui Farm.</h1>
			<ul id="navli">
				<li><a class="homeblack" href="adminHome.php?id=<?php echo $id?>"">HOME</a></li>
                <li><a class="homeblack" href="adminAddEmployee.php?id=<?php echo $id?>"">Add Employee</a></li>
                <li><a class="homered" href="adminViewEmployee.php?id=<?php echo $id?>"">View Employee</a></li>
                <li><a class="homeblack" href="adminFarmSection.php?id=<?php echo $id?>"">Farm Section</a></li>
                <li><a class="homeblack" href="adminTaskStatus.php?id=<?php echo $id?>"">Task Status</a></li>
                <li><a class="homeblack" href="adminSalaryTable.php?id=<?php echo $id?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="adminEmployeeLeave.php?id=<?php echo $id?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="adminApplyLeave.php?id=<?php echo $id?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="logout.php">Log Out</a></li>
			</ul>
		</nav>
	</header>
	
	<div class="divider"></div>

		<table>
			<tr>

				<th align = "center">Emp. ID</th>
				<th align = "center">Picture</th>
				<th align = "center">Name</th>
				<th align = "center">Email</th>
				<th align = "center">Birthday</th>
				<th align = "center">Gender</th>
				<th align = "center">Contact</th>
				<th align = "center">Address</th>
				<th align = "center">Department</th>
				<th align = "center">Harvested (KSH)</th>
				
				
				<th align = "center">Options</th>
			</tr>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['id']."</td>";
					echo "<td><img src='process/".$employee['pic']."' height = 60px width = 60px></td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['email']."</td>";
					echo "<td>".$employee['birthday']."</td>";
					echo "<td>".$employee['gender']."</td>";
					echo "<td>".$employee['contact']."</td>";
					echo "<td>".$employee['address']."</td>";
					echo "<td>".$employee['dept']."</td>";
					echo "<td>".$employee['points']."</td>";

					echo "<td><a href=\"edit.php?id=$employee[id]\">Edit</a> | <a href=\"delete.php?id=$employee[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

				}


			?>

		</table>
		
	
</body>
</html>

