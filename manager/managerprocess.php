<?php
session_start();

require_once ('../process/dbh.php');

$email = $_POST['mailuid'];
$password = $_POST['pwd'];

$sql = "SELECT * from `manager` WHERE email = '$email' AND password = '$password'";
$sqlid = "SELECT id from `manager` WHERE email = '$email' AND password = '$password'";

$result = mysqli_query($conn, $sql);
$id = mysqli_query($conn , $sqlid);

$empid = "";
if(mysqli_num_rows($result) == 1){
	
	$manager = mysqli_fetch_array($id);
	$empid = ($manager['id']);
	

	//echo ("logged in");
	//echo ("$empid");
	
	header("Location: managerHome.php?id=$empid");
	
}


else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Invalid Email or Password')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}

?>