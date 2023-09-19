<?php
session_start();
require_once ('dbh.php');
$id = (isset($_GET['id']) ? $_GET['id'] : '');
// $pname = $_POST['pname'];
// $subdate = $_POST['duedate'];

// Check if the eid exists in the employee table
// $sql1 = "SELECT * FROM employee WHERE id = $id";
// $result1 = mysqli_query($conn, $sql1);

// if (mysqli_num_rows($result) == 0) {
  
// }

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

if(isset($_POST['update'])){
    // Retrieve values from the form
    $id = $_POST['uid'];
    $amtHarvested = $_POST['amtHarvested'];
    
    // Check if the employee ID exists in the database
    $check_sql = "SELECT * FROM `employee_salary` WHERE eid = $id";
    $result = $conn->query($check_sql);
    
    if ($result->num_rows > 0) {
        // Update the record if the employee ID exists
        $update_sql = "UPDATE `employee_salary` SET total_kgs_harvested = '$amtHarvested' WHERE eid = $id";
        
        if ($conn->query($update_sql) === TRUE) {
            echo "Record updated successfully.";
            header("Location: ../managerHome.php?id=$userID");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Employee ID does not exist.";
    }
}

// $sql1 = "INSERT INTO `salary`(`id`, `base`, `bonus`, `total`) VALUES ('$id' , '$amtHarvested')";

// $result = mysqli_query($conn, $sql);


// if(($result) == 1){
    
//     header("Location: ../managerHome.php?id=$userID");
// }

// else{
//     echo ("<SCRIPT LANGUAGE='JavaScript'>
//     window.alert('Failed to Assign')
//     window.location.href='javascript:history.go(-1)';
//     </SCRIPT>");
// }




?>