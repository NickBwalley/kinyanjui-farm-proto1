<?php

$servername = "localhost";
$dBUsername = "root";
$dbPassword = "";
$dBName = "erms";

$conn = mysqli_connect($servername, $dBUsername, $dbPassword, $dBName);

if(!$conn){
	echo "Database Connection Failed";
}

?>