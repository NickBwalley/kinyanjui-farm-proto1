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

?>



<html>
<head>
	<title>Salary Table | Kinyanjui Farm</title>
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
                <li><a class="homeblack" href="assignproject.php?id=<?php echo $id?>"">Project Status</a></li>
                <li><a class="homered" href="salaryemp.php?id=<?php echo $id?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="empleave.php?id=<?php echo $id?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="applyleave.php?id=<?php echo $id?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="logout.php">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
		
	</div>
	
	<table>
			<tr>
				<th align = "center">Emp. ID</th>
				<th align = "center">Name</th>
				
				
				<th align = "center">Base Salary</th>
				<th align = "center">Bonus</th>
				<th align = "center">TotalSalary</th>
				
				
			</tr>
			
			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['id']."</td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['base']."</td>";
					echo "<td>".$employee['bonus']." %</td>";
					echo "<td>".$employee['total']."</td>";
					
					

				}


			?>
			
			</table>
</body>
</html>