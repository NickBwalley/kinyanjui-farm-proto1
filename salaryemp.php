<?php
// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>


<?php 
	session_start();
	require_once ('process/dbh.php');

	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	$managerID = $_SESSION['manID'] = $id;
	$_SESSION['manID'] = $id;
	// echo "$managerID";


	 $sql4 = "SELECT * FROM `manager` where id = '$id'";
	 
	 $result1 = mysqli_query($conn, $sql4);
	 $employeen = mysqli_fetch_array($result1);
	//  $empName = ($employeen['firstName']);

	$sql = "SELECT id, firstName, lastName,  points FROM employee, rank WHERE rank.eid = employee.id order by rank.points desc";
	$sql1 = "SELECT `pname`, `duedate` FROM `project` WHERE eid = $id and status = 'Due'";

	$sql2 = "Select * From employee, employee_leave Where employee.id = $id and employee_leave.id = $id order by employee_leave.token";

	$sql3 = "SELECT * FROM `salary` WHERE id = $id";

//echo "$sql";
$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);
$result4 = mysqli_query($conn, $sql4);

// Check if the query executed successfully
// if ($result1) {
//     // Fetch the row from the result
//     $row = mysqli_fetch_assoc($result4);

//     // Access the 'id' column from the fetched row
//     $userID = $row['id'];

//     // Now you can use $userID in your code
//     echo "User ID: $userID";
// } else {
//     // Handle the case where the query failed
//     echo "user ID not found...";
// }

?>


<html>
<head>
	<title>Employee Panel | Kinyanjui Farm.</title>
	<link rel="stylesheet" type="text/css" href="styleemplogin.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat" rel="stylesheet">
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
                <li><a class="homeblack" href="salaryemp.php?id=<?php echo $id?>"">Salary Table</a></li> 
                <li><a class="homered" href="empleave.php?id=<?php echo $id?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="applyleave.php?id=<?php echo $id?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="logout.php">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
	<div>
		<!-- <h2>Welcome <?php echo "$empName"; ?> </h2> -->

		    	<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Employees Salary </h2>
    	<table>

			<tr bgcolor="#000">
				<th align = "center">Seq.</th>
				<th align = "center">Emp. ID</th>
				<th align = "center">Name</th>
				<th align = "center">Total Harvested (Kgs)</th>
				<th align = "center">Amt to Pay</th>
				<th align = "center">Payments</th>

				

			</tr>

			

			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$seq."</td>";
					echo "<td>".$employee['id']."</td>";
					
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['points']."</td>";

					// Multiply $employee['points'] by 8 and display the result
					$pointsMultiplied = $employee['points'] * 8;
					echo "<td>" . $pointsMultiplied . "</td>";
					echo "<td><a href=\"admpayments.php?id=$employee[id]\">Pay</a></td>";
					
					$seq+=1;
				}


			?>

		</table>
   
	</div>
</body>
</html>