<?php
session_start();
if (isset($_POST['create'])) {
    require_once('dbh.php');

    $sectionname = $_POST['secname'];
    $peoplenumber = $_POST['maxnum'];



    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }else{
        $sql = "INSERT INTO `farm_section`(`id`, `section_name`, `max_people`) VALUES ('','$sectionname','$peoplenumber')";
        $result = mysqli_query($conn, $sql);
    }

    if ($conn->query($sql) === TRUE) {
        // Redirect to a different page upon successful insertion
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Farm section successfully created...')
        window.location.href='..//eloginwel.php?id=" . $id . "';
        </SCRIPT>");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
