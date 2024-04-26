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
    <title>Providers</title>
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

  <table  width="1000" border="0" align="center" cellpadding="5" cellspacing="5" class="Table"  id="ProvidersTable">
    <tr>
      <td class="bold" >Provider ID</td>
      <td class="bold" >Provider Type</td>
      <td class="bold" >Provider Name</td>
      <td class="bold" >Phone Number</td>     
       <td class="bold" >Email</td>
      <td class="bold" >Insurance Plan ID</td>
      <td colspan="4" class="bold" >Address</td>

  </tr>  
  <?php 
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$query = mysqli_query($conn, "SELECT
    p.Provider_ID,
    p.Provider_Type,
    p.Provider_Name,
    p.Phone_Number,
    p.Email,
    p.InsurancePlan_ID,
    a.City,
    a.Street,
    a.State,
    a.Zipcode
FROM
    Providers p
JOIN
    Providers_Address a ON p.Address_ID = a.Address_ID;
 ");

		while ($row = mysqli_fetch_array($query)) {
    ?>    


    <tr>
        <td>   <?php echo $row['Provider_ID']; ?> </a> </td>
        <td>  <?php echo $row['Provider_Type']; ?> </td>
        <td>  <?php echo $row['Provider_Name']; ?> </td>
        <td>  <?php echo $row['Phone_Number']; ?> </td>
        <td>  <?php echo $row['Email']; ?> </td>
        <td>  <?php echo $row['InsurancePlan_ID']; ?> </td>
        <td>  <?php echo $row['City']; ?> </td>
        <td>  <?php echo $row['Street']; ?> </td>
        <td>  <?php echo $row['State']; ?> </td>
        <td>  <?php echo $row['Zipcode']; }?> </td>

      </tr>  

  </table>
<?php } ?>
			
  </div>
</div>
</body>

