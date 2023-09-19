
<?php
session_start();
require_once('../process/dbh.php'); // Make sure this file includes your database connection ($conn).
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
$managerID = $_SESSION['manID'] = $id;
//echo "$managerID";

// Fetch employees and their ranks using JOIN
// $sql = "SELECT * FROM `employee` e
//         JOIN `rank` r ON e.id = r.eid";
$sql = "SELECT * FROM `employee`";
$result = mysqli_query($conn, $sql);

if (!empty($id)) {
    $managerSql = "SELECT * FROM `employee` WHERE id = '$id'";
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
	<title>View Employee |  Managers Panel </title>
	<link rel="stylesheet" type="text/css" href="../stylescss/employee_view_style.css">
</head>
<body>
	<header>
		<nav>
			<h1>Kinyanjui Farm.</h1>
			<ul id="navli">
				<li><a class="homeblack" href="managerHome.php?id=<?php echo $id?>"">HOME</a></li>
                <li><a class="homeblack" href="managerEmployee.php?id=<?php echo $id?>"">Add Employee</a></li>
                <li><a class="homered" href="managerViewEmployee.php?id=<?php echo $id?>"">View Employee</a></li>
                <li><a class="homeblack" href="managerFarmSection.php?id=<?php echo $id?>"">Farm Section</a></li>
                <li><a class="homeblack" href="managerTaskStatus.php?id=<?php echo $id?>"">Task Status</a></li>
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

				<th align = "center">Emp. ID</th>
				<th align = "center">Picture</th>
				<th align = "center">Name</th>
				<th align = "center">ID-Number</th>
				<th align = "center">Birthday</th>
				<th align = "center">Gender</th>
				<th align = "center">Contact</th>
				<th align = "center">Address</th>
				<th align = "center">Department</th>
				<th align = "center">Status</th>
				<!-- <th align = "center">Harvested (KSH)</th> -->
				
				
				<th align = "center">Options</th>
			</tr>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['id']."</td>";
					echo "<td><img src='../process/".$employee['pic']."' height = 60px width = 60px></td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['national_id']."</td>";
					echo "<td>".$employee['birthday']."</td>";
					echo "<td>".$employee['gender']."</td>";
					echo "<td>".$employee['contact']."</td>";
					echo "<td>".$employee['address']."</td>";
					echo "<td>".$employee['dept']."</td>";
					echo "<td>".$employee['status']."</td>";
					// echo "<td>".$employee['points']."</td>";

					// echo "<td><a href=\"editEmployee.php?id=$employee[id]\">Edit</a> | <a href=\"deleteEmployee.php?id=$employee[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

					echo "<td><a href=\"editEmployee.php?id=$employee[id]\">EDIT</a></td>";

				}


			?>

		</table>
		
	
</body>
</html>

