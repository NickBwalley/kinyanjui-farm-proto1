<?php
session_start();
require_once('process/dbh.php'); // Make sure this file includes your database connection ($conn).

// Fetch employees and their employee_salarys using JOIN
$sql = "SELECT * FROM `employee` e
        JOIN `employee_salary` r ON e.id = r.eid";
$result = mysqli_query($conn, $sql);

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

// if (!empty($id)) {
//     $employeeSql = "SELECT * FROM `employee` WHERE id = '$id'";
//     $employeeResult = mysqli_query($conn, $employeeSql);

//     if (!$employeeResult) {
//         die("Error fetching employee: " . mysqli_error($conn));
//     }

//     $manager = mysqli_fetch_array($employeeResult);
//     $empName = $manager['firstName'];
// }


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

$sql = "SELECT * FROM `employee` WHERE 1";

//echo "$sql";
$result = mysqli_query($conn, $sql);
if(isset($_POST['update']))
{

	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
	$national_id = mysqli_real_escape_string($conn, $_POST['national_id']);
	$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
	$contact = mysqli_real_escape_string($conn, $_POST['contact']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$dept = mysqli_real_escape_string($conn, $_POST['dept']);
	//$salary = mysqli_real_escape_string($conn, $_POST['salary']);





	// $result = mysqli_query($conn, "UPDATE `employee` SET `firstName`='$firstname',`lastName`='$lastname',`national_id`='$national_id',`password`='$national_id',`gender`='$gender',`contact`='$contact',`nid`='$nid',`salary`='$salary',`address`='$address',`dept`='$dept',`degree`='$degree' WHERE id=$id");


$result = mysqli_query($conn, "UPDATE `employee` SET `firstName`='$firstname',`lastName`='$lastname',`national_id`='$national_id',`birthday`='$birthday',`gender`='$gender',`contact`='$contact',`address`='$address',`dept`='$dept' WHERE id=$id");
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Updated Employee')
    </SCRIPT>");

    header("Location: managerViewEmployee.php?id=$userID");


	
}
?>




<?php
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	$sql = "SELECT * from `employee` WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	if($result){
	while($res = mysqli_fetch_assoc($result)){
    $mainEmpId = $res['id'];
	$firstname = $res['firstName'];
	$lastname = $res['lastName'];
	$national_id = $res['national_id'];
	$contact = $res['contact'];
	$address = $res['address'];
	$gender = $res['gender'];
	$birthday = $res['birthday'];
	$dept = $res['dept'];
	
        }
    }

    // $id = (isset($_GET['id']) ? $_GET['id'] : '');
	$sql1 = "SELECT * from `farm_section_assigned` WHERE id=$id";
	$result1 = mysqli_query($conn, $sql1);
	if($result1){
	while($res1 = mysqli_fetch_assoc($result1)){
	$id1 = $res1['id'];
	$section_assigned = $res1['section_assigned'];
    $empName = $res1['empName'];
	
        }
    }
?>

<html>
<head>
	<title>Edit Employee |  Manager Panel </title>
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
                <!-- <li><a class="homeblack" href="managersection.php?id=<?php echo $userID?>"">Add section</a></li>
                <li><a class="homeblack" href="managerViewsection.php?id=<?php echo $userID?>"">View section</a></li> -->
                <li><a class="homeblack" href="managerFarmSection.php?id=<?php echo $userID?>"">Create Section</a></li>
                <li><a class="homeblack" href="managerTaskStatus.php?id=<?php echo $userID?>"">Assign Section</a></li>
                <li><a class="homered" href="managerViewFarmSections.php?id=<?php echo $userID?>"">View Sections</a></li> 
                <!-- <li><a class="homeblack" href="managerSalaryTable.php?id=<?php echo $userID?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="managersectionLeave.php?id=<?php echo $userID?>"">section Leave</a></li>
                <li><a class="homeblack" href="managersectionApplyLeave.php?id=<?php echo $userID?>"">Apply Leave</a></li> -->
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
                    <h2 class="title">Harvested Amount (KGS)</h2>
                    <form id = "registration" action="process/pHarvestedByEmployee.php?id=<?php echo $userID?>"" method="POST">

                        <div class="input-group">
                            <input class="input--style-1" type="text"  name="section_assigned" value="<?php echo $section_assigned;?>" readonly>
                        </div>
                        
                        <div class="input-group">
                            <input class="input--style-1" type="text" name="empName" value="<?php echo $empName;?>" readonly>
                            <input class="input--style-1" type="text" name="uid" value="<?php echo $id;?>" readonly>
                        </div>

                       
                       <div class="input-group">
                            <input class="input--style-1" type="number" name="amtHarvested" value="" placeholder="KGS Harvested by [<?php echo $empName; ?>]">
                        </div>


                    
                        <button class="btn btn--radius btn--green" type="submit" name="update">Submit</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!-- Jquery JS-->
    <!-- <script src="../vendor/jquery/jquery.min.js"></script>
   
    <script src="../vendor/select2/select2.min.js"></script>
    <script src="../vendor/datepicker/moment.min.js"></script>
    <script src="../vendor/datepicker/daterangepicker.js"></script>

   
    <script src="js/global.js"></script> -->
</body>
</html>
