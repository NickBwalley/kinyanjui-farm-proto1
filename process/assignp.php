<?php
session_start();
require_once ('dbh.php');

$pname = $_POST['pname'];
$eid = $_POST['eid'];
$subdate = $_POST['duedate'];

// Check if the eid exists in the employee table
$sql_check_eid = "SELECT * FROM employee WHERE id = $eid";
$result_check_eid = mysqli_query($conn, $sql_check_eid);

if (mysqli_num_rows($result_check_eid) == 0) {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Employee ID does not exist')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
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

$sql = "INSERT INTO `project`(`eid`, `pname`, `duedate` , `status`) VALUES ('$eid' , '$pname' , '$subdate' , 'Due')";

$result = mysqli_query($conn, $sql);


if(($result) == 1){
    
    header("Location: ..//massignproject.php?id=$userID");
}

else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Failed to Assign')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}




?>