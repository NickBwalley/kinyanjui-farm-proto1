<?php
// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!-- SESSION DESTROY AND CLEAR CACHE... -->


<?php 
	session_start();
	require_once ('../process/dbh.php');
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	$managerID = $_SESSION['manID'] = $id;
	// echo "$managerID";
	 $sql4 = "SELECT * FROM `manager` where id = '$id'";
	 
	 $result1 = mysqli_query($conn, $sql4);
	 $employeen = mysqli_fetch_array($result1);
	//  $empName = ($employeen['firstName']);

	$sql = "SELECT id, firstName, lastName,  total_kgs_harvested FROM employee, employee_salary WHERE employee_salary.eid = employee.id order by employee_salary.total_kgs_harvested desc";
	$sql1 = "SELECT `pname`, `duedate` FROM `project` WHERE eid = $id and status = 'Due'";
	
	$sql2 = "Select * From employee, employee_leave Where employee.id = $id and employee_leave.id = $id order by employee_leave.id";

	$sql3 = "SELECT * FROM `employee_salary_base` WHERE id = $id";
	$sql5 = "SELECT * FROM employee_paid";
	$sql6 = "SELECT * FROM employee_leave";
	$sql7 = "SELECT * FROM farm_section_assigned";
	$sql8 = "SELECT * FROM farm_section";
	
//echo "$sql";
$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);
$result4 = mysqli_query($conn, $sql4);
$result5 = mysqli_query($conn, $sql5);
$result6 = mysqli_query($conn, $sql6);
$result7 = mysqli_query($conn, $sql7);
$result8 = mysqli_query($conn, $sql8);

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
	<title>Managers Panel | Kinyanjui Farm.</title>
	<link rel="stylesheet" type="text/css" href="../stylescss/manager_login_style.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat" rel="stylesheet">
</head>
<body>
	
	<header>
		<nav>
			<h1>Kinyanjui Farm.</h1>
			<ul id="navli">
			    <li><a class="homered" href="managerHome.php?id=<?php echo $id?>"">HOME</a></li>
                <li><a class="homeblack" href="managerEmployee.php?id=<?php echo $id?>"">Employees</a></li>
				<li><a class="homeblack" href="../Analytics/managerAnalytics.php?id=<?php echo $id?>"">Analytics</a></li>
				<li><a class="homeblack" href="managerlogin.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
	<div>
		<!-- <h2>Welcome <?php echo "$empName"; ?> </h2> -->

		    	<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Employee Dashboard - Highlights </h2>
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
					
					echo "<td>".$employee['total_kgs_harvested']."</td>";

					// Multiply $employee['total_kgs_harvested'] by 8 and display the result
					$total_kgs_harvestedMultiplied = $employee['total_kgs_harvested'] * 8;
					echo "<td>" . $total_kgs_harvestedMultiplied . "</td>";
					echo "<td><a href=\"employeePayment.php?id=$employee[id]\">Pay</a></td>";
					
					$seq+=1;
				}


			?>

		</table>


	
	<!-- <div class="divider"></div> -->
	<div id="divimg">
	<div>
		<!-- <h2>Welcome <?php echo "$empName"; ?> </h2> -->

		    	<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Employees Paid - Latest </h2>
    	<table>

			<tr bgcolor="#000">
				<!-- <th align = "center">Seq.</th> -->
				<th align = "center">Emp.ID</th>
				<th align = "center">Emp Name</th>
				<th align = "center">Total KGS Harvested</th>
				<th align = "center">Amount Paid</th>
				<th align = "center">Date</th>

				

			</tr>

			

			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result5)) {
					echo "<tr>";
					
					echo "<td>".$employee['id']."</td>";
					
					echo "<td>".$employee['empName']."</td>";
					
					echo "<td>".$employee['total_kgs_harvested']."</td>";

					echo "<td>".$employee['amt_paid']."</td>";

					echo "<td>".$employee['date']."</td>";

					
				}


			?>

		</table>
   
	</div>

	<div id="divimg">
	<div>
		<!-- <h2>Welcome <?php echo "$empName"; ?> </h2> -->

		    	<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Employees Leave </h2>
    	<table>

			<tr bgcolor="#000">
				<!-- <th align = "center">Seq.</th> -->
				<th align = "center">Emp.ID</th>
				<th align = "center">Emp Name</th>
				<th align = "center">Start Date</th>
				<th align = "center">End Date</th>
				<th align = "center">Reason</th>
				<th align = "center">Status</th>

				

			</tr>

			

			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result6)) {
					echo "<tr>";
					
					echo "<td>".$employee['id']."</td>";
					
					echo "<td>".$employee['empName']."</td>";
					
					echo "<td>".$employee['start']."</td>";

					echo "<td>".$employee['end']."</td>";

					echo "<td>".$employee['reason']."</td>";

					echo "<td>".$employee['status']."</td>";

					
				}


			?>

		</table>
   
	</div>

	<div id="divimg">
	<div>
		<!-- <h2>Welcome <?php echo "$empName"; ?> </h2> -->

		    	<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;"> Farm Section Assigned - Employees </h2>
    	<table>

			<tr bgcolor="#000">
				<!-- <th align = "center">Seq.</th> -->
				<th align = "center">Emp.ID</th>
				<th align = "center">Section Assigned</th>
				<th align = "center">EmpName</th>

			</tr>

			

			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result7)) {
					echo "<tr>";
					
					echo "<td>".$employee['id']."</td>";
					
					echo "<td>".$employee['section_assigned']."</td>";
					
					echo "<td>".$employee['empName']."</td>";

					
				}


			?>

		</table>
   
	</div>

	<!-- <div class="divider"></div> -->
	<div id="divimg">
	<div>
		<!-- <h2>Welcome <?php echo "$empName"; ?> </h2> -->

		    	<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Farm Sections </h2>
    	<table>

			<tr bgcolor="#000">
				<!-- <th align = "center">Seq.</th> -->
				<th align = "center">Section ID</th>
				<th align = "center">Section Name</th>
				<th align = "center">Maximum People per Section</th>

				

			</tr>

			

			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result8)) {
					echo "<tr>";
					
					echo "<td>".$employee['id']."</td>";
					
					echo "<td>".$employee['section_name']."</td>";
					
					echo "<td>".$employee['max_people']."</td>";

					
				}


			?>

		</table>
   
	</div>


   
    	<!-- <h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Due Projects</h2>
    	

    	<table>

			<tr>
				<th align = "center">Task Details</th>
				<th align = "center">Due Date</th>
				
			</tr>

			

			<?php
				while ($employee1 = mysqli_fetch_assoc($result1)) {
					echo "<tr>";
					
					echo "<td>".$employee1['pname']."</td>";
					
					echo "<td>".$employee1['duedate']."</td>";

				}


			?>

		</table>



		<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Salary Status</h2>
    	

    	<table>

			<tr>
				
				<th align = "center">Base Salary</th>
				<th align = "center">Bonus</th>
				<th align = "center">Total Salary</th>
				
			</tr>

			

			<?php
				while ($employee = mysqli_fetch_assoc($result3)) {
					

					echo "<tr>";
					
					
					echo "<td>".$employee['base']."</td>";
					echo "<td>".$employee['bonus']." %</td>";
					echo "<td>".$employee['total']."</td>";
					
				}


				


			?>

		</table>










		<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Leave Status</h2>
    	

    	<table>

			<tr>
				
				<th align = "center">Start Date</th>
				<th align = "center">End Date</th>
				<th align = "center">Total Days</th>
				<th align = "center">Reason</th>
				<th align = "center">Status</th>
			</tr>

			

			<?php
				while ($employee = mysqli_fetch_assoc($result2)) {
					$date1 = new DateTime($employee['start']);
					$date2 = new DateTime($employee['end']);
					$interval = $date1->diff($date2);
					$interval = $date1->diff($date2);

					echo "<tr>";
					
					
					echo "<td>".$employee['start']."</td>";
					echo "<td>".$employee['end']."</td>";
					echo "<td>".$interval->days."</td>";
					echo "<td>".$employee['reason']."</td>";
					echo "<td>".$employee['status']."</td>";
					
				}


				


			?> -->

		<!-- </table> -->




   
<br>
<br>
<br>
<br>
<br>







	</div>


		</h2>


		
		
	</div>
</body>
</html>