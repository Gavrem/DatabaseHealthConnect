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
    <title>Employee</title>
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

  <?php   

  
  if (isset($_SESSION["Type"]) && $_SESSION["Type"] == "admin"){?>
      <h1>Employees </h1>
  <table  width="800" border="0" align="center" cellpadding="5" cellspacing="5" class="Table"  id="EmployeeTable">
    <tr>
      <td rowspan="2" class="bold">ID</td>
      <td rowspan="2" class="bold">First Name</td>
      <td  rowspan="2" class="bold">Last Name</td>
      <td rowspan="2" class="bold">Date of Birth</td>
      <td rowspan="2" class="bold">Gender</td>
      <td rowspan="2" class="bold">Position</td>
      <td colspan="2" class="bold">Department</td>
      <td colspan="3" class="bold">Insurance</td>

  </tr>  
  <tr>
      <td class="bold"> Department Name</td>
      <td class="bold">Department Head</td>
      <td class="bold"> Plan Name</td>
      <td class="bold"> Coverage Details</td>
      <td class="bold"> Premium Amount</td>

  </tr>  
  <?php 
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$query = mysqli_query($conn, "SELECT
    e.Staff_ID,
    e.First_Name,
    e.Last_Name,
    e.DoB,
    e.Gender,
    e.Position,
    d.Department_Name,
    d.Department_Head,
    ip.Plan_Name,
    ip.Coverage_Details,
    ip.Premium_Amount
FROM
    Employee e
LEFT JOIN
    Department d ON e.Department_ID = d.Department_ID
LEFT JOIN
	InsurancePlan ip ON e.InsurancePlan_ID = ip.Insurance_Plan_ID; ");

		while ($row = mysqli_fetch_array($query)) {
      $Staff_ID  = $row['Staff_ID']; 
    ?>    


    <tr onClick="window.open('Employee_Profile.php?Staff_ID=<?php echo $Staff_ID; ?>');" >
        <td>   <?php echo $row['Staff_ID']; ?> </a> </td>
        <td>  <?php echo $row['First_Name']; ?> </td>
        <td>  <?php echo $row['Last_Name']; ?> </td>
        <td>  <?php echo $row['DoB']; ?> </td>
        <td>  <?php echo $row['Gender']; ?> </td>
        <td>  <?php echo $row['Position']; ?> </td>
        <td>  <?php echo $row['Department_Name']; ?> </td>
        <td>  <?php echo $row['Department_Head'];?> </td>
        <td>  <?php echo $row['Plan_Name']; ?> </td>
        <td>  <?php echo $row['Coverage_Details']; ?> </td>
        <td>  <?php echo $row['Premium_Amount']; }?> </td>



      </tr>  

  </table>
  <form action="NewEmloyee.php" method="get">
    <input align="center"  name="Submit" type="submit" value="Add New Employee" class="Button" id="NewEmloyee">
</form>

			<?php }?>
  </div>
</div>
</body>

