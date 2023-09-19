<?php
//including the database connection file
session_start();
require_once ('dbh.php');

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

if (isset($_POST['apply'])) {

    // empname 
    $empname = $_POST['empname'];
    //echo $id;
    $reason = $_POST['reason'];

    $start = $_POST['start'];
    //echo "$reason";
    $end = $_POST['end'];

    $sql = "INSERT INTO `employee_leave`(`id`,`empName`, `start`, `end`, `reason`, `status`) VALUES ('','$empname','$start','$end','$reason','Pending')";

    $result = mysqli_query($conn, $sql);

    //redirecting to the display page (index.php in our case)
    header("Location: ../managerEmployeeLeave.php?id=$userID");
}
?>

