<?php

require_once ('process/dbh.php');
$sql = "SELECT employee.id,employee.firstName,employee.lastName,salary.base,salary.bonus,salary.total from employee,`salary` where employee.id=salary.id";

//echo "$sql";
$result = mysqli_query($conn, $sql);

?>
<?php 
require_once('process/dbh.php');

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if (!empty($id)) {
    $managerSql = "SELECT * FROM `manager` WHERE id = '$id'";
    $managerResult = mysqli_query($conn, $managerSql);

    if (!$managerResult) {
        die("Error fetching manager: " . mysqli_error($conn));
    }

    $manager = mysqli_fetch_array($managerResult);
    $empName = $manager['firstName'];
}
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
	            <li><a class="homeblack" href="eloginwel.php?id=<?php echo $id?>"">HOME</a></li>
                <li><a class="homeblack" href="maddemp.php?id=<?php echo $id?>"">Add Employee</a></li>
                <li><a class="homeblack" href="mviewemployee.php?id=<?php echo $id?>"">View Employee</a></li>
                <li><a class="homeblack" href="massign.php?id=<?php echo $id?>"">Assign Project</a></li>
                <li><a class="homeblack" href="massignproject.php?id=<?php echo $id?>"">Project Status</a></li>
                <li><a class="homeblack" href="msalaryemp.php?id=<?php echo $id?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="mempleave.php?id=<?php echo $id?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="mapplyleave.php?id=<?php echo $id?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="elogin.html">Log Out</a></li>
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
				<th align = "center">Price per KG</th>
				<th align = "center">KGS Harvested</th>
				<th align = "center">Amt to Pay</th>
				<th align = "center">Payments</th>
				
				
			</tr>
			
			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['id']."</td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['base']."</td>";
					echo "<td>".$employee['bonus']." </td>";
					$amtToPay = $employee['base'] * $employee['bonus'];
					echo "<td>".$amtToPay."</td>";
					echo "<td><a href=\"epayments.php?id=$employee[id]\">Pay</a></td>";
					
					

				}


			?>
			
			</table>
</body>
</html>