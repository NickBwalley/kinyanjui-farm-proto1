<?php
session_start();
require_once ('process/dbh.php');
$sql = "SELECT * from `project` order by subdate desc";

//echo "$sql";
$result = mysqli_query($conn, $sql);

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if (!empty($id)) {
    $employeeSql = "SELECT * FROM `employee` WHERE id = '$id'";
    $managerResult = mysqli_query($conn, $employeeSql);

    if (!$managerResult) {
        die("Error fetching employee: " . mysqli_error($conn));
    }

    $employee = mysqli_fetch_array($managerResult);
    // $empName = $employee['firstName'];
}
?>



<html>
<head>
	<title>Project Status |  Admin Panel | Kinyanjui Farm</title>
	<link rel="stylesheet" type="text/css" href="styleview.css">
</head>
<body>
	<header>
		<nav>
			<h1>Kinyanjui Farm.</h1>
			<ul id="navli">
				<li><a class="homeblack" href="aloginwel.php?id=<?php echo $id?>"">HOME</a></li>
                <li><a class="homeblack" href="addemp.php?id=<?php echo $id?>"">Add Employee</a></li>
                <li><a class="homeblack" href="viewemp.php?id=<?php echo $id?>"">View Employee</a></li>
                <li><a class="homeblack" href="assign.php?id=<?php echo $id?>"">Assign Project</a></li>
                <li><a class="homered" href="assignproject.php?id=<?php echo $id?>">Project Status</a></li>
                <li><a class="homeblack" href="salaryemp.php?id=<?php echo $id?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="empleave.php?id=<?php echo $id?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="applyleave.php?id=<?php echo $id?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="logout.php">Log Out</a></li>
			</ul>
		</nav>
	</header>
	
	<div class="divider"></div>

		<table>
			<tr>

				<th align = "center">Project ID</th>
				<th align = "center">Emp. ID</th>
				<th align = "center">Project Name</th>
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
					echo "<td><a href=\"mark.php?id=$employee[eid]&pid=$employee[pid]\">Harvested</a>"; 

				}


			?>

		</table>
		
	
</body>
</html>