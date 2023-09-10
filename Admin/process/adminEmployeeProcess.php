<!-- NO Sessions -->
<?php 
session_start();
require_once('dbh.php');



$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

$adminID = $_SESSION['admID'] = $id;
//echo "$adminID";

if (!empty($id)) {
    $adminSql = "SELECT * FROM `alogin` WHERE id = '$id'";
    $adminResult = mysqli_query($conn, $adminSql);

    if (!$adminResult) {
        die("Error fetching admin: " . mysqli_error($conn));
    }

    $admin = mysqli_fetch_array($adminResult);
    // $empName = $admin['firstName'];
}
?>
<?php

require_once ('dbh.php');

$firstname = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$gender = $_POST['gender'];

$dept = $_POST['dept'];

$primarySal = 8;
$salary = $_POST['salary'] = $primarySal;
$birthday =$_POST['birthday'];
//echo "$birthday";
$files = $_FILES['file'];
$filename = $files['name'];
$filrerror = $files['error'];
$filetemp = $files['tmp_name'];
$fileext = explode('.', $filename);
$filecheck = strtolower(end($fileext));
$fileextstored = array('png' , 'jpg' , 'jpeg');

if(in_array($filecheck, $fileextstored)){

    $destinationfile = 'images/'.$filename;
    move_uploaded_file($filetemp, $destinationfile);

    $sql = "INSERT INTO `employee`(`id`, `firstName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`, `address`, `dept`, `pic`) VALUES ('','$firstname','$lastName','$email','1234','$birthday','$gender','$contact','$address','$dept','$destinationfile')";

$result = mysqli_query($conn, $sql);

$last_id = $conn->insert_id;

$sqlS = "INSERT INTO `salary`(`id`, `base`, `bonus`, `total`) VALUES ('$last_id','$salary',0,'$salary')";
$salaryQ = mysqli_query($conn, $sqlS);
$rank = mysqli_query($conn, "INSERT INTO `rank`(`eid`) VALUES ('$last_id')");

if(($result) == 1){
    
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Registered')
    window.location.href='./adminHome.php?id=" . $id . "';
    </SCRIPT>");
    //header("Location: ..//adminHome.php");
}

else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Failed to Registere')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}

}

else{

    $sql = "INSERT INTO `employee`(`id`, `firstName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`,  `address`, `dept`, `pic`) VALUES ('','$firstname','$lastName','$email','1234','$birthday','$gender','$contact','$address','$dept','images/no.jpg')";

$result = mysqli_query($conn, $sql);

$last_id = $conn->insert_id;

$sqlS = "INSERT INTO `salary`(`id`, `base`, `bonus`, `total`) VALUES ('$last_id','$salary',0,'$salary')";
$salaryQ = mysqli_query($conn, $sqlS);
$rank = mysqli_query($conn, "INSERT INTO `rank`(`eid`) VALUES ('$last_id')");

if(($result) == 1){
    
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Registered')
    window.location.href='../adminHome.php?id=" . $id . "';
    </SCRIPT>");
    //header("Location: ..//adminHome.php");
}

// else{
//     echo ("<SCRIPT LANGUAGE='JavaScript'>
//     window.alert('Failed to Registere')
//     window.location.href='javascript:history.go(-1)';
//     </SCRIPT>");
// }
}






?>