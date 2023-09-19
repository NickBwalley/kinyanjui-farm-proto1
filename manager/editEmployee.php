<?php
session_start();
require_once('process/dbh.php'); // Ensure this file includes your database connection ($conn).

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

// Fetch employee information by ID if provided
if (!empty($id)) {
    $employeeSql = "SELECT * FROM `employee` WHERE id = '$id'";
    $employeeResult = mysqli_query($conn, $employeeSql);

    if (!$employeeResult) {
        die("Error fetching employee: " . mysqli_error($conn));
    }

    $manager = mysqli_fetch_array($employeeResult);
}

// Check if the session variable 'manID' is set
if (isset($_SESSION['manID'])) {
    $userID = $_SESSION['manID'];
} else {
    echo "User ID not found in session.";
}

// Update employee information if the form is submitted
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
    $national_id = mysqli_real_escape_string($conn, $_POST['national_id']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $updateQuery = "UPDATE `employee` SET `firstName`='$firstname', `lastName`='$lastname', `national_id`='$national_id', `birthday`='$birthday', `gender`='$gender', `contact`='$contact', `address`='$address', `dept`='$dept', `status`='$status' WHERE id='$id'";
    
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Successfully Updated Employee')
        </SCRIPT>");
        header("Location: managerViewEmployee.php?id=$userID");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch employee information again after updating
$sql = "SELECT * FROM `employee` WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($res = mysqli_fetch_assoc($result)) {
        $firstname = $res['firstName'];
        $lastname = $res['lastName'];
        $national_id = $res['national_id'];
        $contact = $res['contact'];
        $address = $res['address'];
        $gender = $res['gender'];
        $birthday = $res['birthday'];
        $dept = $res['dept'];
        $status = $res['status'];
    }
}
?>

<html>
<head>
    <title>Edit Employee | Manager Panel</title>
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
                <li><a class="homered" href="managerViewEmployee.php?id=<?php echo $userID?>"">View Employee</a></li>
                <li><a class="homeblack" href="managerFarmSection.php?id=<?php echo $userID?>"">Farm Section</a></li>
                <li><a class="homeblack" href="managerTaskStatus.php?id=<?php echo $userID?>"">Task Status</a></li>
                <li><a class="homeblack" href="managerSalaryTable.php?id=<?php echo $userID?>"">Salary Table</a></li> 
                <li><a class="homeblack" href="managerEmployeeLeave.php?id=<?php echo $userID?>"">Employee Leave</a></li>
                <li><a class="homeblack" href="managerEmployeeApplyLeave.php?id=<?php echo $userID?>"">Apply Leave</a></li>
				<li><a class="homeblack" href="managerlogin.html">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <div class="divider"></div>

    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Update Employee Info</h2>
                    <form id="registration" action="editEmployee.php?id=<?php echo $userID?>" method="POST">

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" name="firstName" value="<?php echo $firstname;?>" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" name="lastName" value="<?php echo $lastname;?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" name="national_id" value="<?php echo $national_id;?>" required>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="date" name="birthday" value="<?php echo $birthday;?>" required>
                                </div>
                            </div>
                            
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" name="gender" value="<?php echo $gender;?>" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <input class="input--style-1" type="number" name="contact" value="<?php echo $contact;?>" required>
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" name="address" value="<?php echo $address;?>" required>
                            <input class="input--style-1" type="hidden" name="dept" value="<?php echo $dept;?>">
                        </div>

                        <div class="input-group">
                            <select name="status" class="input--style-1">
                                <option value="active" <?php if ($status == "active") echo "selected"; ?>>Active</option>
                                <option value="not_active" <?php if ($status == "not_active") echo "selected"; ?>>Not Active</option>
                            </select>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id;?>" required><br><br>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" name="update">Submit</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
