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
	 
	//  $result1 = mysqli_query($conn, $sql4);
	//  $section = mysqli_fetch_array($result1);
	//  $empName = ($section['firstName']);

	$sql = "SELECT * FROM farm_section_assigned";
	// $sql1 = "SELECT `pname`, `duedate` FROM `project` WHERE eid = $id and status = 'Due'";

	// $sql2 = "Select * From section, section_leave Where section.id = $id and section_leave.id = $id order by section_leave.token";

	// $sql3 = "SELECT * FROM `salary` WHERE id = $id";

//echo "$sql";
$result = mysqli_query($conn, $sql);
// $result1 = mysqli_query($conn, $sql1);
// $result2 = mysqli_query($conn, $sql2);
// $result3 = mysqli_query($conn, $sql3);
// $result4 = mysqli_query($conn, $sql4);

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
			    <li><a class="homeblack" href="managerHome.php?id=<?php echo $id?>"">HOME</a></li>
                <!-- <li><a class="homeblack" href="managersection.php?id=<?php echo $id?>"">Add section</a></li>
                <li><a class="homeblack" href="managerViewsection.php?id=<?php echo $id?>"">View section</a></li> -->
                <li><a class="homeblack" href="managerFarmSection.php?id=<?php echo $id?>"">Create Section</a></li>
                <li><a class="homeblack" href="managerTaskStatus.php?id=<?php echo $id?>"">Assign Section</a></li>
                <li><a class="homered" href="managerViewFarmSections.php?id=<?php echo $id?>"">View Sections</a></li> 
                <!-- <li><a class="homeblack" href="managerSalaryTable.php?id=<?php echo $id?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="managersectionLeave.php?id=<?php echo $id?>"">section Leave</a></li>
                <li><a class="homeblack" href="managersectionApplyLeave.php?id=<?php echo $id?>"">Apply Leave</a></li> -->
				<li><a class="homeblack" href="managerlogin.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
	<div>
		<!-- <h2>Welcome <?php echo "$empName"; ?> </h2> -->

		    	<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Employee Sections Assigned </h2>
    	<table>

			<tr bgcolor="#000">
				<th align = "center">uniqueID.</th>
				<th align = "center">Section Name</th>
				<th align = "center">Employee Name</th>
				<th align = "center">Options</th>
				

			</tr>

			

			<?php
				$seq = 1;
				while ($section = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					// echo "<td>".$id."</td>";
					echo "<td>".$section['id']."</td>";
					
					echo "<td>".$section['section_assigned']."</td>";
					
					echo "<td>".$section['empName']."</td>";
                    echo "<td><a href=\"harvestedByEmployee.php?id=$section[id]\">Harvested</a> | <a href=\"deleteSectionAssigned.php?id=$section[id]\" onClick=\"return confirm('Are you sure you want to delete this section?')\">Delete</a></td>";
					// // Multiply $section['points'] by 8 and display the result
					// $pointsMultiplied = $section['points'] * 8;
					// echo "<td>" . $pointsMultiplied . "</td>";
					// echo "<td><a href=\"sectionPayment.php?id=$section[id]\">Pay</a></td>";
					
					$seq+=1;
				}


			?>

		</table>
   
    	   
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