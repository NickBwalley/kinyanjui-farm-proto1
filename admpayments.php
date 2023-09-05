<?php
session_start();
require_once('process/dbh.php'); // Make sure this file includes your database connection ($conn).

$id = (isset($_GET['id']) ? $_GET['id'] : '');
	// $managerID = $_SESSION['admID'] = $id;
	// echo "$managerID";

// Fetch employees and their ranks using JOIN
$sql = "SELECT * FROM `employee` e
        JOIN `rank` r ON e.id = r.eid";

$result = mysqli_query($conn, $sql);


$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if (!empty($id)) {
    $employeeSql = "SELECT * FROM `employee` WHERE id = '$id'";
    $employeeResult = mysqli_query($conn, $employeeSql);

    if (!$employeeResult) {
        die("Error fetching employee: " . mysqli_error($conn));
    }

    $manager = mysqli_fetch_array($employeeResult);
    $empName = $manager['firstName'];
}

// Check if the session variable 'admID' is set
if (isset($_SESSION['admID'])) {
    // Access the admID from the session
    $admID = $_SESSION['admID'];

    // Now you can use $admID in your code
    // echo "User ID: $admID";
} else {
    // Handle the case where the session variable is not set
    echo "User ID not found in session.";
}

if (isset($_POST['approve'])) {
    // Assuming you have a unique identifier for the person, let's call it 'id'
    $id = $_POST['id']; // Replace with your actual form field name

    // Start a transaction
    mysqli_begin_transaction($conn);

    // Update the 'salary' table
    $sql1 = "UPDATE salary SET base = 8, bonus = 0, total = 0 WHERE id = $id";
    
    // Update the 'rank' table
    $sql2 = "UPDATE rank SET points = 0 WHERE eid = $id";

    if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
        // Both updates were successful
        mysqli_commit($conn);
        echo "Record updated successfully!";
        header("Location: salaryemp.php?id=$admID");
    } else {
        // At least one update failed, roll back the transaction
        mysqli_rollback($conn);
        echo "Error updating record: " . mysqli_error($conn);
        header("Location: admpayments.php?id=$admID");
    }
}

if (isset($_POST['decline'])) {
    // Assuming you have a unique identifier for the person, let's call it 'id'
    $id = $_POST['id']; // Replace with your actual form field name

    
        // echo "Record updated successfully!";
        header("Location: salaryemp.php?id=$admID");
}

$sql = "SELECT * FROM `employee` WHERE 1";
$sql1 = "SELECT * FROM `salary` WHERE id = $id";

//echo "$sql";
$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);
if($result1){
	while($res1 = mysqli_fetch_assoc($result1)){
	$base = $res1['base'];
	$bonus = $res1['bonus'];
	$amtToBePaid = $res1['base'] * $res1['bonus'];
	
}
}
if(isset($_POST['update']))
{

	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
	$contact = mysqli_real_escape_string($conn, $_POST['contact']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$dept = mysqli_real_escape_string($conn, $_POST['dept']);
	//$salary = mysqli_real_escape_string($conn, $_POST['salary']);
	
}
?>




<?php
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	$sql = "SELECT * from `employee` WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	if($result){
	while($res = mysqli_fetch_assoc($result)){
	$firstname = $res['firstName'];
	$lastname = $res['lastName'];
	$email = $res['email'];
	$contact = $res['contact'];
	$address = $res['address'];
	$gender = $res['gender'];
	$birthday = $res['birthday'];
	$dept = $res['dept'];
	
}
}

?>


<html>
<head>
	<title>View Employee |  Admin Panel </title>
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
	

		<!-- <form id = "registration" action="edit.php" method="POST"> -->
	<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Pay <?php echo $firstname .' '. $lastname?> </h2>
                    <form id = "registration" action="admpayments.php?id=<?php echo $admID?>"" method="POST">

                        
                        <div class="input-group">
							<h2>Ksh <?php echo $amtToBePaid;?></h2>
                            <input class="input--style-1" type="hidden"  name="amt" value="<?php echo $amtToBePaid;?>">
                        </div>
                        <?php
                        // Set the timezone to Nairobi, Kenya
                        date_default_timezone_set('Africa/Nairobi');

                        // Get the current date and time
                        $currentDateTime = date('Y-m-d H:i:s');

                        // Display the current date and time
                        echo "Current Date and Time in Nairobi, Kenya: " . $currentDateTime;
                        ?>

                        <input type="hidden" name="id" id="textField" value="<?php echo $id;?>" required="required"><br><br>
                        <div class="p-t-20">
                            <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" name="approve">Approve</button>
							<button class="btn btn--radius btn--red" type="submit" name="decline">Cancel</button>

                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!-- Jquery JS-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script>
   
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

   
    <script src="js/global.js"></script> -->
</body>
</html>
