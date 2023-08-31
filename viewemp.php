<?php

require_once ('process/dbh.php');
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
$sql = "SELECT * from `employee` , `rank` WHERE employee.id = rank.eid";

//echo "$sql";
$result = mysqli_query($conn, $sql);

if (!empty($id)) {
    $adminSql = "SELECT * FROM `alogin` WHERE id = '$id'";
    $adminResult = mysqli_query($conn, $adminSql);

    if (!$adminResult) {
        die("Error fetching admin: " . mysqli_error($conn));
    }

    $admin = mysqli_fetch_array($adminResult);
    $admName = $admin['firstName'];
}

?>

<html>
<head>
	<title>View Employee |  Admin Panel </title>
	<link rel="stylesheet" type="text/css" href="styleview.css">
</head>
<body>
	<header>
		<nav>
			<h1>Kinyanjui Farm.</h1>
			<ul id="navli">
				<li><a class="homeblack" href="aloginwel.php">HOME</a></li>
				<li><a class="homeblack" href="addemp.php?id=<?php echo $id?>"">Add Employee</a></li>
				<li><a class="homered" href="viewemp.php?id=<?php echo $id?>"">View Employee</a></li>
				<li><a class="homeblack" href="assign.php?id=<?php echo $id?>"">Assign Project</a></li>
				<li><a class="homeblack" href="assignprojectphp?id=<?php echo $id?>"">Project Status</a></li>
				<li><a class="homeblack" href="salaryemp.php?id=<?php echo $id?>"">Salary Table</a></li>
				<li><a class="homeblack" href="empleave.php?id=<?php echo $id?>"">Employee Leave</a></li>
				<li><a class="homeblack" href="alogin.html">Log Out</a></li>
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
				<th align = "center">NID</th>
				<th align = "center">Address</th>
				<th align = "center">Department</th>
				<th align = "center">Degree</th>
				<th align = "center">Point</th>
				
				
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
					echo "<td>".$employee['nid']."</td>";
					echo "<td>".$employee['address']."</td>";
					echo "<td>".$employee['dept']."</td>";
					echo "<td>".$employee['degree']."</td>";
					echo "<td>".$employee['points']."</td>";

					echo "<td><a href=\"edit.php?id=$employee[id]\">Edit</a> | <a href=\"delete.php?id=$employee[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

				}


			?>

		</table>
		
	
</body>
</html>