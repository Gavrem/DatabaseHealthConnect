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
    <title>Department</title>
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
  <?php if ($_SESSION["Type"] == "admin" || $_SESSION["Type"] == "Staff"){ ?>
  <table  width="800" border="0" align="center" cellpadding="5" cellspacing="5" class="Table"  id="DepartmentTable">
    <tr>
      <td class="bold" >Department ID</td>
      <td class="bold" >Department Name</td>
      <td class="bold" >Department Head</td>
  </tr>  
  <?php 
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$query = mysqli_query($conn, "SELECT * FROM Department ");

		while ($row = mysqli_fetch_array($query)) {
      $Staff_ID  = $row['Staff_ID']; 
    ?>    


    <tr>
        <td>   <?php echo $row['Department_ID']; ?> </a> </td>
        <td>  <?php echo $row['Department_Name']; ?> </td>
        <td>  <?php echo $row['Department_Head']; }?> </td>

      </tr>  

  </table>

			<?php } ?>
  </div>
</div>
</body>

