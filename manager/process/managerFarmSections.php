<?php 
session_start();
require_once('../process/dbh.php');

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if (!empty($id)) {
    $managerSql = "SELECT * FROM `manager` WHERE id = '$id'";
    $managerResult = mysqli_query($conn, $managerSql);

    if (!$managerResult) {
        die("Error fetching manager: " . mysqli_error($conn));
    }

    $manager = mysqli_fetch_array($managerResult);
    // $empName = $manager['firstName'];
}

// Check if the session variable 'userID' is set
if (isset($_SESSION['manID'])) {
    // Access the userID from the session
    $userID = $_SESSION['manID'];

    // Now you can use $userID in your code
    // echo "User ID: $userID";
} else {
    // Handle the case where the session variable is not set
    echo "User ID not found in session.";
}
?>

<?php
if (isset($_POST['create'])) {

    $sectionname = $_POST['secname'];
    $peoplenumber = $_POST['maxnum'];



    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }else{
    $sql = "INSERT INTO `farm_section`(`id`, `section_name`, `max_people`) VALUES ('','$sectionname','$peoplenumber')";
        $result = mysqli_query($conn, $sql);
    // Redirect to a different page upon successful insertion
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Farm section successfully created...')
        window.location.href='../managerViewFarmSections.php?id=" . $userID . "';
        </SCRIPT>");
    }

    // if ($conn->query($sql) === TRUE) {
        
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }

    // Close the database connection
    $conn->close();
}
?>
