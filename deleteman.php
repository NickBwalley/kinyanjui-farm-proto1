<?php
session_start();
//including the database connection file
include("process/dbh.php");

$id = (isset($_GET['id']) ? $_GET['id'] : '');
// Check if the session variable 'userID' is set
if (isset($_SESSION['admID'])) {
    // Access the userID from the session
    $admID = $_SESSION['admID'];

    // Now you can use $userID in your code
    echo "Admin ID: $admID";
} else {
    // Handle the case where the session variable is not set
    echo "Admin ID not found in session.";
}

//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM manager WHERE id=$id");

//redirecting to the display page (index.php in our case)
header("Location:viewman.php?id=$id");
?>