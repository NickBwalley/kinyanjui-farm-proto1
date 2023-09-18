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
    //AutoIncrement values of the data from url

    //getting id of the data from url
    $empName = $_POST['empname'];
    //echo $id;
    $reason = $_POST['reason'];

    $start = $_POST['start'];
    //echo "$reason";
    $end = $_POST['end'];

    $sql = "INSERT INTO `employee_leave`(`token`, `empName`, `start`, `end`, `reason`, `status`) VALUES ('','$empName', '$start','$end','$reason','Pending')";

    $result = mysqli_query($conn, $sql);
    if($result){
        //redirecting to the display page (index.php in our case)
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Farm section successfully created...')
        window.location.href='../managerEmployeeLeave.php?id=" . $userID . "';
        </SCRIPT>");
        // header("Location: ../managerEmployeeLeave.php?id=$userID");
        
    }



}
?>

