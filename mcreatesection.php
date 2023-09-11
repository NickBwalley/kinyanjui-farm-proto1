<?php 
session_start();
require_once('process/dbh.php');

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if (!empty($id)) {
    $managerSql = "SELECT * FROM `manager` WHERE id = '$id'";
    $managerResult = mysqli_query($conn, $managerSql);

    if (!$managerResult) {
        die("Error fetching manager: " . mysqli_error($conn));
    }

    $manager = mysqli_fetch_array($managerResult);
    // $empName = $manager['firstName'];
}

// Check if the session variable 'userID' is set
if (isset($_SESSION['manID'])) {
    // Access the userID from the session
    $userID = $_SESSION['manID'];

    // Now you can use $userID in your code
    //echo "User ID: $userID";
} else {
    // Handle the case where the session variable is not set
    echo "User ID not found in session.";
}

?>
<!DOCTYPE html>
<html>

<head>
   

    <!-- Title Page-->
    <title>Create Farm Section | Managers Panel</title>

    <link rel="stylesheet" type="text/css" href="styleemplogin.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat" rel="stylesheet">   

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <header>
        <nav>
            <h1>Kinyanjui Farm.</h1>
            <ul id="navli">
                <li><a class="homeblack" href="eloginwel.php?id=<?php echo $id?>"">HOME</a></li>
                <li><a class="homeblack" href="maddemp.php?id=<?php echo $id?>"">Add Employee</a></li>
                <li><a class="homeblack" href="mviewemployee.php?id=<?php echo $id?>"">View Employee</a></li>
                <li><a class="homered" href="mcreatesection.php?id=<?php echo $id?>"">Create Section</a></li>
                <li><a class="homeblack" href="massign.php?id=<?php echo $id?>"">Assign Section</a></li>
                <li><a class="homeblack" href="massignproject.php?id=<?php echo $id?>"">Task Status</a></li>
                <li><a class="homeblack" href="msalaryemp.php?id=<?php echo $id?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="mempleave.php?id=<?php echo $id?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="mapplyleave.php?id=<?php echo $id?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="elogin.html">Log Out</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="divider"></div>




    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    
                    <form action="process/createfarmsection.php" method="POST" enctype="multipart/form-data">
                        
                        <h2 class="title"> Create Farm Section </h2>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="What is the section name" name="secname" required="required">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="Maximum number of people to work on this section" name="maxnum" required="required">
                        </div>
                        
                        
                        



                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" name="create" onclick="createFarm()">Create Section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
				// while ($employee = mysqli_fetch_assoc($result2)) {
				// 	$date1 = new DateTime($employee['start']);
				// 	$date2 = new DateTime($employee['end']);
				// 	$interval = $date1->diff($date2);
				// 	$interval = $date1->diff($date2);

				// 	echo "<tr>";
					
					
				// 	echo "<td>".$employee['start']."</td>";
				// 	echo "<td>".$employee['end']."</td>";
				// 	echo "<td>".$interval->days."</td>";
				// 	echo "<td>".$employee['reason']."</td>";
				// 	echo "<td>".$employee['status']."</td>";
					
				// }


				


			?>

		</table>

    <script>
    function createFarm() {
        // Display a confirmation dialog
        var confirmation = confirm("Are you sure you want to create this Farm Section?");
        
        // Check the result of the confirmation dialog
        if (confirmation) {
            // If the user clicked "OK," redirect to another page
            // using JavaScript's window.location.href
            var userID = <?php echo json_encode($userID); ?>; // Assuming $userID is a PHP variable
            window.location.href = "eloginwel.php?id=" + userID;
        } else {
            // If the user clicked "Cancel," you can handle this case if needed
            alert("Section not created!.");
        }
    }
    </script>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
<!-- end document-->