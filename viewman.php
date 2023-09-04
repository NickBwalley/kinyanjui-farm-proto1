<?php
session_start();
require_once ('process/dbh.php');
$sql = "SELECT * from `manager` WHERE manager.id = id";

//echo "$sql";
$result = mysqli_query($conn, $sql);
$id = (isset($_GET['id']) ? $_GET['id'] : '');
// Check if the session variable 'userID' is set
if (isset($_SESSION['admID'])) {
    // Access the userID from the session
    $admID = $_SESSION['admID'];

    // Now you can use $userID in your code
    //echo "Admin ID: $admID";
} else {
    // Handle the case where the session variable is not set
    echo "Admin ID not found in session.";
}


?>



<html>
<head>
	<title>View Employee |  Admin Panel | Kinyanjui Farm</title>
	<link rel="stylesheet" type="text/css" href="styleview.css">
</head>
<body>
	<header>
		<nav>
			<h1>Kinyanjui Farm.</h1>
			<ul id="navli">
				<li><a class="homered" href="aloginwel.php?id=<?php echo $id ?>">HOME</a></li>
				<li><a class="homeblack" href="addman.php?id=<?php echo $id ?>">Add Manager</a></li>
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
				<th align = "center">Options</th>
			</tr>

			<?php
				while ($manager = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$manager['id']."</td>";
					echo "<td><img src='process/".$manager['pic']."' height = 60px width = 60px></td>";
					echo "<td>".$manager['firstName']." ".$manager['lastName']."</td>";
					
					echo "<td>".$manager['email']."</td>";
					echo "<td>".$manager['birthday']."</td>";
					echo "<td>".$manager['gender']."</td>";
					echo "<td>".$manager['contact']."</td>";
					echo "<td>".$manager['nid']."</td>";
					echo "<td>".$manager['address']."</td>";
					echo "<td>".$manager['dept']."</td>";
					echo "<td>".$manager['degree']."</td>";
					

					echo "<td><a href=\"edit.php?id=$manager[id]\">Edit</a> | <a href=\"deleteman.php?id=$manager[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

				}


			?>

		</table>
		
	
</body>
</html>