<?php
$id = (isset($_GET['id']) ? $_GET['id'] : '');
	$managerID = $_SESSION['manID'] = $id;
	$_SESSION['manID'] = $id;
	// echo "$managerID";
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
				<li><a class="homered" href="../eloginwel.php?id=<?php echo $id?>"">HOME</a></li>
				<li><a class="homeblack" href="../elogin.html">Log Out</a></li>
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