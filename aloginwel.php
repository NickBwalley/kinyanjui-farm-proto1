<?php 
session_start();
require_once('process/dbh.php');

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

$adminID = $_SESSION['admID'] = $id;
// echo "$adminID";

$sql1 = "SELECT * FROM `alogin` where id = '$id'";

$result1 = mysqli_query($conn, $sql1);

// if ($result1) {
//     // Fetch the row from the result
//     $row = mysqli_fetch_assoc($result1);

//     // Access the 'id' column from the fetched row
//     $admID = $row['id'];

//     // Now you can use $admID in your code
//     //echo "Admin ID: $admID";
// } else {
//     // Handle the case where the query failed
//     echo "Admin ID not found...";
// }
$adminID = $_SESSION['admID'] = $id;


/////////////////////////////////////////////////////////////////
$id = (isset($_GET['id']) ? $_GET['id'] : '');
require_once ('process/dbh.php');
$sql = "SELECT id, firstName, lastName,  points FROM employee, rank WHERE rank.eid = employee.id order by rank.points desc";
$result = mysqli_query($conn, $sql);
?>


<html>
<head>
	<title>Admin Panel | Kinyanjui Farm </title>
	<link rel="stylesheet" type="text/css" href="styleemplogin.css">
</head>
<body>
	
	<header>
		<nav>
			<h1>Kinyanjui Farm.</h1>
			<ul id="navli">
				<li><a class="homered" href="aloginwel.php?id=<?php echo $id ?>">HOME</a></li>
				<li><a class="homeblack" href="viewemp.php?id=<?php echo $id ?>">Employees</a></li>
				<li><a class="homeblack" href="viewman.php?id=<?php echo $id ?>">Managers</a></li>
				<li><a class="homeblack" href="./chartjs-template-acers/index.php?id=<?php echo $id ?>">Analytics</a></li>
				<li><a class="homeblack" href="alogin.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
		<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Employees Leaderboard </h2>
    	<table>

			<tr bgcolor="#000">
				<th align = "center">Seq.</th>
				<th align = "center">Emp. ID</th>
				<th align = "center">Name</th>
				<th align = "center">Points</th>
				

			</tr>

			

			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$seq."</td>";
					echo "<td>".$employee['id']."</td>";
					
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['points']."</td>";
					
					$seq+=1;
				}


			?>

		</table>

		<div class="p-t-20">
			<button class="btn btn--radius btn--green" type="submit" style="float: right; margin-right: 60px"><a href="reset.php" style="text-decoration: none; color: white"> Reset Points</button>
		</div>

		
	</div>
</body>
</html>