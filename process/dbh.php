<?php

$servername = "localhost";
$dBUsername = "root";
$dbPassword = "";
$dBName = "erms2";

$conn = mysqli_connect($servername, $dBUsername, $dbPassword, $dBName);

if(!$conn){
	echo "Databese Connection Failed";
}

?>