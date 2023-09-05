<?php 
session_start();
require_once('../process/dbh.php');

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
$adminID = $_SESSION['admID'] = $id;
// echo "$adminID";

if (!empty($id)) {
    $managerSql = "SELECT * FROM `alogin` WHERE id = '$id'";
    $managerResult = mysqli_query($conn, $managerSql);

    if (!$managerResult) {
        die("Error fetching admin: " . mysqli_error($conn));
    }

    $manager = mysqli_fetch_array($managerResult);
    // $empName = $manager['firstName'];
}

// Debug: Check if session is set
// if (isset($_SESSION['userID'])) {
//     echo "User ID set in session: " . $_SESSION['userID'];
// } else {
//     echo "User ID not found.";
// }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KPI Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styleemplogin.css">
  </head>
  <body>
  <header>
		<nav>
			<h1>Kinyanjui Farm.</h1>
			<ul id="navli">
				<li><a class="homered" href="../aloginwel.php?id=<?php echo $id?>"">HOME</a></li>
				<!-- <li><a class="homeblack" href="addemp.php">Add Employee</a></li> -->
				<!-- <li><a class="homeblack" href="../viewemp.php">Employees</a></li>
				<li><a class="homeblack" href="../viewman.php">Managers</a></li>
				<li><a class="homeblack" href="../chartjs-template-acers/index.php">Analytics</a></li> -->
				<!-- <li><a class="homeblack" href="assign.php">Assign Project</a></li> -->
				<!-- <li><a class="homeblack" href="assignproject.php">Project Status</a></li> -->
				<!-- <li><a class="homeblack" href="salaryemp.php">Salary Table</a></li> -->
				<!-- <li><a class="homeblack" href="empleave.php">Employee Leave</a></li> -->
				<li><a class="homeblack" href="../alogin.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
  <div class="divider"></div>
    <div class="row">   
  <!-- Start of Key Metrics -->
  <?php
  function humanize_number($input){
    $input = number_format($input);
    $input_count = substr_count($input, ',');
    if($input_count != '0'){
        if($input_count == '1'){
            return substr($input, 0, -4).'K';
        } else if($input_count == '2'){
            return substr($input, 0, -8).'M';
        } else if($input_count == '3'){
            return substr($input, 0,  -12).'B';
        } else {
            return;
        }
    } else {
        return $input;
    }
  }

  function humanize_time($hours) {
  return $hours . ' hours';
}


  ?>
  <?php
  include 'dbconfig.php';

  // Create connection
  $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
 //////////// HIGHEST PROFIT MARGIN
  $sql = "SELECT MAX(year_2023_profit) AS highestProfit FROM profit_trends;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $highestProfit = $row['highestProfit'];
    }
  } else {
    echo "0 results";
  }
  ///////////////// TOTAL RESOLVED COMPLAINTS
  $sql = "SELECT SUM(complaint_resolved) AS complaintResolved FROM complaints;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $complaintResolved = $row['complaintResolved'];
    }
  } else {
    echo "0 results";
  }
  ////////////////////// TOTAL TIME FOR PROCESSING 
  $sql = "SELECT MAX(time_column) AS totalProcessingTime FROM processing;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $totalProcessingTime = $row['totalProcessingTime'];
    }
  } else {
    echo "0 results";
  }
  ///////////////////////// TOTAL TRAINED HOURS
  $sql = "SELECT SUM(training_hours) AS trainingHours FROM employeetraining;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $trainingHours = $row['trainingHours'];
    }
  } else {
    echo "0 results";
  }
  $conn->close();
  ?>
  <div class="col-md-3 my-1">
        <div class="card">
            <div class="card-body text-center">
              <strong>Highest Profit Margin</strong><hr>
              <h1>
                KES <?= humanize_number($highestProfit) ?>
              </h1>
            </div>
        </div>
  </div>
  <div class="col-md-3 my-1">
        <div class="card">
            <div class="card-body text-center">
              <strong>Total resolved Complaints</strong><hr>
              <h1>
                <?= humanize_number($complaintResolved) ?>
              </h1>
            </div>
        </div>
  </div>
  <div class="col-md-3 my-1">
        <div class="card">
            <div class="card-body text-center">
              <strong>Total Processing Time for Tea</strong><hr>
              <h1>
                <?= humanize_time($totalProcessingTime) ?>
              </h1>
            </div>
        </div>
  </div>
  <div class="col-md-3 my-1">
        <div class="card">
            <div class="card-body text-center">
              <strong>Total Time for Traning Employees</strong><hr>
              <h1>
                <?= humanize_time($trainingHours) ?>
              </h1>
            </div>
        </div>
  </div>
  <!-- End of Key Metrics -->

    <!-- Start of KPI DIVs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php include 'kpi1.php'; ?> 
    <?php include 'kpi2.php'; ?>
    <?php include 'kpi3.php'; ?>
    <?php include 'kpi4.php'; ?>
    <!-- End of KPI DIVs -->
  </body>
</html>