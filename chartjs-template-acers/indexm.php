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
				<li><a class="homered" href="../aloginwel.php">HOME</a></li>
				<!-- <li><a class="homeblack" href="addemp.php">Add Employee</a></li> -->
				<li><a class="homeblack" href="../viewemp.php">Employees</a></li>
				<li><a class="homeblack" href="../viewman.php">Managers</a></li>
				<li><a class="homeblack" href="../chartjs-template-acers/indexm.php">Analytics</a></li>
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
    <!-- Start of KPI DIVs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php include 'kpi1.php'; ?> 
    <?php include 'kpi2.php'; ?>
    <?php include 'kpi3.php'; ?>
    <?php include 'kpi4.php'; ?>
    <!-- End of KPI DIVs -->
  </body>
</html>