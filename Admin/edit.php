<!-- No sessions -->
<?php
session_start();
require_once('process/dbh.php'); // Make sure this file includes your database connection ($conn).

$adminID = $_SESSION['manID'];
	

// Fetch employees and their employee_salarys using JOIN
$sql = "SELECT * FROM `employee` e
        JOIN `employee_salary` r ON e.id = r.eid";
$result = mysqli_query($conn, $sql);

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
	// $adminID = $_SESSION['manID'] = $id;
	echo "$adminID";

if (!empty($id)) {
    $employeeSql = "SELECT * FROM `manager` WHERE id = '$id'";
    $employeeResult = mysqli_query($conn, $employeeSql);

    if (!$employeeResult) {
        die("Error fetching employee: " . mysqli_error($conn));
    }

    $manager = mysqli_fetch_array($employeeResult);
    // $empName = $manager['firstName'];
}

// Check if the session variable 'userID' is set
// if (isset($_SESSION['admID'])) {
//     // Access the userID from the session
//     $admID = $_SESSION['admID'];

//     // Now you can use $userID in your code
//     echo "Admin ID: $admID";
// } else {
//     // Handle the case where the session variable is not set
//     echo "Admin ID not found in session.";
// }

$sql = "SELECT * FROM `manager` WHERE 1";

//echo "$sql";
$result = mysqli_query($conn, $sql);
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
	$nid = mysqli_real_escape_string($conn, $_POST['nid']);
	//$salary = mysqli_real_escape_string($conn, $_POST['salary']);





	// $result = mysqli_query($conn, "UPDATE `employee` SET `firstName`='$firstname',`lastName`='$lastname',`email`='$email',`password`='$email',`gender`='$gender',`contact`='$contact',`nid`='$nid',`salary`='$salary',`address`='$address',`nid`='$nid',`degree`='$degree' WHERE id=$id");


$result = mysqli_query($conn, "UPDATE `manager` SET `firstName`='$firstname',`lastName`='$lastname',`email`='$email',`birthday`='$birthday',`gender`='$gender',`contact`='$contact',`address`='$address',`nid`='$nid' WHERE id=$id");
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Updated')
    </SCRIPT>");

    header("Location: adminViewEmployee.php?id=$admID");


	
}
?>




<?php
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	$sql = "SELECT * from `manager` WHERE id=$id";
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
	$nid = $res['nid'];
	
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
				<li><a class="homeblack" href="adminHome.php?id=<?php echo $adminID?>"">HOME</a></li>
				<li><a class="homered" href="adminViewEmployee.php?id=<?php echo $adminID?>"">View Employee</a></li>
				<li><a class="homeblack" href="admin.html">Log Out</a></li>
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
                    <h2 class="title">Update Manager Info</h2>
                    <form id = "registration" action="edit.php" method="POST">

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                     <input class="input--style-1" type="text" name="firstName" value="<?php echo $firstname;?>" >
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" name="lastName" value="<?php echo $lastname;?>">
                                </div>
                            </div>
                        </div>





                        <div class="input-group">
                            <input class="input--style-1" type="email"  name="email" value="<?php echo $email;?>">
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" name="birthday" value="<?php echo $birthday;?>">
                                    <input class="input--style-1" type="hidden" name="gender" value="<?php echo $gender;?>">
                                   
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="input-group">
                            <input class="input--style-1" type="number" name="contact" value="<?php echo $contact;?>">
                        </div>

                       
                         <div class="input-group">
                            <input class="input--style-1" type="text"  name="address" value="<?php echo $address;?>">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" name="nid" value="<?php echo $nid;?>">
                        </div>

                        <input type="hidden" name="id" id="textField" value="<?php echo $id;?>" required="required"><br><br>
                        <div class="p-t-20">
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
