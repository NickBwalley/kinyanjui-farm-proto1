<?php
session_start();
//including the database connection file
include("process/dbh.php");
$adminID = $_SESSION['manID'];
	echo "$managerID";

$id = (isset($_GET['id']) ? $_GET['id'] : '');
// Check if the session variable 'userID' is set
if (isset($_SESSION['admID'])) {
    // Access the userID from the session
    $admID = $_SESSION['admID'];

    // Now you can use $userID in your code
    // echo "Admin ID: $admID";
} else {
    // Handle the case where the session variable is not set
    echo "Admin ID not found in session.";
}

//deleting the row from table
$status = "suspended"; // Replace 'new_status' with the desired new value for 'status'
$id = 1; // Replace '1' with the specific ID you want to update

$result = "UPDATE manager SET status = '$status' WHERE id = $id";


//redirecting to the display page (index.php in our case)
header("Location:viewManager.php?id=$adminID");
?>