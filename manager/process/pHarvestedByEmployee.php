<?php
session_start();
require_once ('dbh.php');
$id = (isset($_GET['id']) ? $_GET['id'] : '');
// $pname = $_POST['pname'];
// $subdate = $_POST['duedate'];
if(isset($_POST['update'])){
    $id = $_POST['uid'];
    $amtHarvested = $_POST['amtHarvested'];
    $sql = "UPDATE `rank` SET points='$amtHarvested' WHERE eid=$id";
    if ($conn->query($sql) === TRUE) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Employee ID does not exist')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
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

// $sql1 = "INSERT INTO `salary`(`id`, `base`, `bonus`, `total`) VALUES ('$id' , '$amtHarvested')";

$result = mysqli_query($conn, $sql);


if(($result) == 1){
    
    header("Location: ../managerHome.php?id=$userID");
}

else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Failed to Assign')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}




?>