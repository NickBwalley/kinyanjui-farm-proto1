<?php
session_start();
require_once('process/dbh.php'); // Make sure this file includes your database connection ($conn).

$id = (isset($_GET['id']) ? $_GET['id'] : '');
	$managerID = $_SESSION['manID'];
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
    // $empName = $manager['firstName'];
}

// Check if the session variable 'userID' is set
if (isset($_SESSION['manID'])) {
    // Access the userID from the session
    $userID = $_SESSION['manID'];

    // Now you can use $userID in your code
    echo "User ID: $userID";
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
        header("Location: managerSalaryTable.php?id=$userID");
    } else {
        // At least one update failed, roll back the transaction
        mysqli_rollback($conn);
        echo "Error updating record: " . mysqli_error($conn);
        header("Location: employeePayment.php?id=$userID");
    }
}

if (isset($_POST['decline'])) {
    // Assuming you have a unique identifier for the person, let's call it 'id'
            header("Location: managerHome.php?id=$userID");
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





	// $result = mysqli_query($conn, "UPDATE `employee` SET `firstName`='$firstname',`lastName`='$lastname',`email`='$email',`password`='$email',`gender`='$gender',`contact`='$contact',`nid`='$nid',`salary`='$salary',`address`='$address',`dept`='$dept',`degree`='$degree' WHERE id=$id");


// $result = mysqli_query($conn, "UPDATE `employee` SET `firstName`='$firstname',`lastName`='$lastname',`email`='$email',`birthday`='$birthday',`gender`='$gender',`contact`='$contact',`address`='$address',`dept`='$dept' WHERE id=$id");
// 	echo ("<SCRIPT LANGUAGE='JavaScript'>
//     window.alert('Succesfully Updated')
//     </SCRIPT>");

//     header("Location: managerViewEmployee.php?id=$userID");


	
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
    <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- ../vendor CSS-->
    <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css/main.css" rel="stylesheet" media="all">
</head>
<body>
	<header>
		<nav>
			<h1>Kinyanjui Farm.</h1>
			<ul id="navli">
				<li><a class="homeblack" href="managerHome.php?id=<?php echo $userID?>"">HOME</a></li>
                <li><a class="homeblack" href="managerEmployee.php?id=<?php echo $userID?>"">Add Employee</a></li>
                <li><a class="homeblack" href="managerViewEmployee.php?id=<?php echo $userID?>"">View Employee</a></li>
                <li><a class="homeblack" href="managerFarmSection.php?id=<?php echo $userID?>"">Farm Section</a></li>
                <li><a class="homeblack" href="managerTaskStatus.php?id=<?php echo $userID?>"">Task Status</a></li>
                <li><a class="homered" href="managerSalaryTable.php?id=<?php echo $userID?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="managerEmployeeLeave.php?id=<?php echo $userID?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="managerEmployeeApplyLeave.php?id=<?php echo $userID?>"">Apply Leave</a></li>
                <li><a class="homeblack" href="managerlogin.html">Log Out</a></li>
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
                    <form id = "registration" action="employeePayment.php?id=<?php echo $userID?>"" method="POST">

                        
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
                            <button class="btn btn--radius btn--green" type="submit" name="approve" onclick="confirmAction()">Approve</button>
							<button class="btn btn--radius btn--red" type="submit" name="decline" onclick="declineAction()">Cancel</button>

                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
function confirmAction() {
    // Display a confirmation dialog
    var confirmation = confirm("Are you sure you want to approve this transaction?");
    
    // Check the result of the confirmation dialog
    if (confirmation) {
        // If the user clicked "OK," perform the action here
        // For example, you can submit a form or execute any other desired action
        // Replace the following line with your specific action
        alert("Successfully approved!");
    } else {
        // If the user clicked "Cancel," you can handle this case if needed
        // For example, you can choose not to perform any action
        alert("Payment canceled.");
    }
}

function declineAction() {
    // Display a confirmation dialog
    var confirmation = confirm("Are you sure you want to decline this transaction?");
    
    // Check the result of the confirmation dialog
    if (confirmation) {
        // If the user clicked "OK," redirect to another page
        // using JavaScript's window.location.href
        var userID = <?php echo json_encode($userID); ?>; // Assuming $userID is a PHP variable
        window.location.href = "managerHome.php?id=" + userID;
    } else {
        // If the user clicked "Cancel," you can handle this case if needed
        alert("Transaction declined.");
    }
}
</script>
     <!-- Jquery JS-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script>
    
   
    <script src="../vendor/select2/select2.min.js"></script>
    <script src="../vendor/datepicker/moment.min.js"></script>
    <script src="../vendor/datepicker/daterangepicker.js"></script>

   
    <script src="js/global.js"></script> -->
</body>
</html>
