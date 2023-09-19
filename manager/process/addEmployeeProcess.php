<!-- NO sessions -->
<?php
session_start();
require_once ('dbh.php');

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


$firstname = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$gender = $_POST['gender'];

$dept = $_POST['dept'];

$salary = $_POST['salary'];
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

    $sql = "INSERT INTO `employee`(`id`, `firstName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`, `address`, `dept`, `pic`) VALUES ('','$firstname','$lastName','$email','1234','$birthday','$gender','$contact','$nid','$address','$dept','$degree','$destinationfile')";

$result = mysqli_query($conn, $sql);

$last_id = $conn->insert_id;

$sqlS = "INSERT INTO `employee_salary_base`(`id`, `base`) VALUES ('$last_id','$salary')";
$salaryQ = mysqli_query($conn, $sqlS);
$rank = mysqli_query($conn, "INSERT INTO `employee_salary`(`eid`, `total_kgs_harvested`) VALUES ('$last_id', 0, 0)");


if(($result) == 1){
    
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Registered')
    window.location.href='..//adminViewEmployee.php';
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

      $sql = "INSERT INTO `employee`(`id`, `firstName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`, `address`, `dept`,`pic`) VALUES ('','$firstname','$lastName','$email','1234','$birthday','$gender','$contact','$address','$dept','images/no.jpg')";

$result = mysqli_query($conn, $sql);

$last_id = $conn->insert_id;

$sqlS = "INSERT INTO `employee_salary_base`(`id`, `base`) VALUES ('$last_id','$salary')";
$salaryQ = mysqli_query($conn, $sqlS);
$rank = mysqli_query($conn, "INSERT INTO `employee_salary`(`eid`, `total_kgs_harvested`, `total_amt_payable`) VALUES ('$last_id', 0, 0)");


if(($result) == 1){
    
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Registered Employee')
    window.location.href='../managerViewEmployee.php?id=$userID';
    </SCRIPT>");
    //header("Location: ..//adminHome.php");
}

// else{
//     echo ("<SCRIPT LANGUAGE='JavaScript'>
//     window.alert('Failed to Registered')
//     window.location.href='javascript:history.go(-1)';
//     </SCRIPT>");
// }
}






?>