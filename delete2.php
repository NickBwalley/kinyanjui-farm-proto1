<?php
session_start();
//including the database connection file
include("process/dbh.php");

// Fetch the manager's ID from the manager table
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
$managerId = null;

if (!empty($id)) {
    $managerSql = "SELECT * FROM `manager` WHERE id = '$id'";
    $managerResult = mysqli_query($conn, $managerSql);

    if (!$managerResult) {
        die("Error fetching manager: " . mysqli_error($conn));
    }

    $managerIdRow = mysqli_fetch_assoc($managerResult);
    $managerId = $managerIdRow['id'];

    // Store the manager's ID in a session variable
    $_SESSION['managerID'] = $managerId;
}

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM employee WHERE id=$id");

//redirecting to the display page (index.php in our case)
header("Location:mviewemployee.php?managerID=$managerId");
?>

