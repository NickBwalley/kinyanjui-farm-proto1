<?php

require_once ('dbh.php');

$pname = $_POST['pname'];
$eid = $_POST['eid'];
$subdate = $_POST['duedate'];

// Check if the eid exists in the employee table
$sql_check_eid = "SELECT * FROM employee WHERE id = $eid";
$result_check_eid = mysqli_query($conn, $sql_check_eid);

if (mysqli_num_rows($result_check_eid) == 0) {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Employee ID does not exist')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}

$sql = "INSERT INTO `project`(`eid`, `pname`, `duedate` , `status`) VALUES ('$eid' , '$pname' , '$subdate' , 'Due')";

$result = mysqli_query($conn, $sql);


if(($result) == 1){
    
    
    header("Location: ..//assignproject.php");
}

else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Failed to Assign')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}




?>