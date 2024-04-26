<?php session_start(); /* Starts the session */

    

$servername = "localhost";
$username = "skulkuloglu1";
$password = "skulkuloglu1";
$dbname = "skulkuloglu1";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

  

?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Home</title>
    <link href="style.css" type="text/css" rel="stylesheet">
<link rel="icon"        type="image/png"        href="logo.png">
  </head>
  <body >
<?php

    require ('common.php');

	print_nav();

?>

<div id="main_page">
  <div id="main_body">
   <div id="home_page">
     <a href="Advance1.php">
       <div id="adv_box">
            <p>  Insurance Optimization Engine</p> 
        </div> 
      </a>
      <a href="Advance2.php">
       <div id="adv_box">
            <p>  Nearby Healthcare Providers and Insurance Plans</p> 
        </div> 
      </a>
      <a href="Advance3.php">
       <div id="adv_box">
            <p> Department-Wise Insurance Plan Analysis</p> 
        </div> 
      </a>
       
      </div>
  </div>
</div>
<?php  renderFooter();  ?>
</body>


<?php
