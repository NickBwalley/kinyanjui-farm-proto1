<?php
session_start();
//including the database connection file
include("process/dbh.php");

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

//getting id of the data from url
$id = $_GET['id'];
// $token = $_GET['token'];
//deleting the row from table
$result = mysqli_query($conn, "UPDATE `employee_leave` SET `status`='Cancelled' WHERE `id`=$id ");

//redirecting to the display page (index.php in our case)
header("Location: managerEmployeeLeave.php?id=$userID");
?>

