<?php session_start(); /* Starts the session */

if(isset($_GET['Staff_ID'])){
	$_SESSION['Staff_ID'] = $_GET['Staff_ID'];
	$Staff_ID = $_SESSION['Staff_ID'];
	// unset($_POST);
	}elseif(isset($_POST['Staff_ID'])){
      $Staff_ID = $_POST['Staff_ID'];
      // unset($_POST);
   }elseif (isset($_SESSION['Staff_ID'] )){
    $Staff_ID = $_SESSION['Staff_ID'];

   }

   if (isset($_SESSION["Type"]) &&  $_SESSION["Type"] == "Staff" &&  $_SESSION["Staff_ID"] == Null && $_POST['Save']!="Create"  ){
    header("Location:Edit_Employee.php");
    die();
  
  }

$servername = "localhost";
$username = "skulkuloglu1";
$password = "skulkuloglu1";
$dbname = "skulkuloglu1";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

   print_r($_POST);

   if (isset($_POST['Save']) && $_POST['Save']=="Create"){
    
        $sql = "
        INSERT INTO Employee SET
          First_Name = '".$_POST["First_Name"]."' ,
          Last_Name =  '".$_POST["Last_Name"]."',
          DoB = '".$_POST["Date_of_Birth"]."',
          Gender = '".$_POST["Gender"]."', 
          Position = '".$_POST["Position"]."', 
          InsurancePlan_ID = ".$_POST["Insurance_Plan_ID"].",
          Department_ID = ".$_POST["Department_ID"]."
        ";
  
  
          if ($conn->query($sql) === TRUE) {
            $msg =  "Successfully!";
          }else{
            $msg = "Error registering";
          }

          $sql = "
          UPDATE Login SET 
          employee_id = (SELECT MAX(Staff_id) FROM Employee)
            Where id = ".$_SESSION['id']."
          ";
          if ($conn->query($sql) === TRUE) {
            $msg =  "Successfully!";
          }else{
            $msg = "Error registering";
          }
        
        
          $conn = mysqli_connect($servername, $username, $password, $dbname);
            
          $query = mysqli_query($conn, "SELECT MAX(Staff_ID) as new_Staff_ID  FROM Employee");

          while ($row = mysqli_fetch_array($query)) {
            $Staff_ID = $row['new_Staff_ID'];
            $_SESSION['Staff_ID'] = $Staff_ID;
          }


          

    }elseif (isset($_POST['Save'])){
    
        $sql = "
        UPDATE Employee SET
          First_Name = '".$_POST["First_Name"]."' ,
          Last_Name =  '".$_POST["Last_Name"]."',
          DoB = '".$_POST["Date_of_Birth"]."',
          Gender = '".$_POST["Gender"]."', 
          Position = '".$_POST["Position"]."', 
          InsurancePlan_ID = ".$_POST["Insurance_Plan_ID"].",
          Department_ID = ".$_POST["Department_ID"]."
        WHERE Staff_ID=".$Staff_ID."
        ";
  
  
          if ($conn->query($sql) === TRUE) {
            $msg =  "Successfully!";
          }else{
            $msg = "Error registering";
  
          }
    }elseif (isset($_POST['Delete'])){

      
      $sql = "
      DELETE FROM Employee 
      WHERE Staff_ID=".$Staff_ID."
      ";


        if ($conn->query($sql) === TRUE) {
          $msg =  "Successfully!";
        }else{
          $msg = "Error registering";
        }
        
        if($_SESSION['Type'] == "admin"){
          header("Location:Employee.php");
          die();  
        }elseif($_SESSION['Type'] == "Staff"){
          header("Location:logout.php");
          die();  
        }


    
    }else{
      $msg =  " Error .";
      $name_error = true;
    
    }
  

?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Employee Profile</title>
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


	$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$query = mysqli_query($conn, "SELECT * FROM Employee Where Staff_ID =".$Staff_ID."");

		while ($row = mysqli_fetch_array($query)) {
      $InsurancePlan_ID =  $row['InsurancePlan_ID'];
      $Department_ID = $row['Department_ID'];
      $Staff_ID = $row['Staff_ID'];
    
    ?> 
    <h1 class="PageTitle">  <?php echo $row['First_Name']; ?>'s Information</h1>
    <table  width="600" border="0" align="center" cellpadding="5" cellspacing="5" class="Table"  id="DetailTable">
   
    <tr>
       <td class="bold">Staff ID</td>  
       <td>   <?php echo $row['Staff_ID']; ?>  </td>
    </tr>   
    <tr>
       <td class="bold" >First Name</td>  
       <td>   <?php echo $row['First_Name']; ?>  </td>
    </tr>   
    <tr>
       <td class="bold" >Last Name</td>  
       <td>   <?php echo $row['Last_Name']; ?>  </td>
    </tr>  
    <tr>
       <td class="bold" >Date of Birth</td>  
       <td>   <?php echo $row['DoB']; ?>  </td>
    </tr> 
    <tr>
       <td class="bold" >Gender</td>  
       <td>   <?php echo $row['Gender']; ?>  </td>
    </tr>
    <tr>
       <td class="bold" >Position</td>  
       <td>   <?php echo $row['Position'];}?>  </td>
    </tr>
    <?php
  $query = mysqli_query($conn, "SELECT * FROM Department Where Department_ID =".$Department_ID."");

  while ($row = mysqli_fetch_array($query)) {
    ?>
    <tr>
       <td class="bold" >Department Name</td>  
       <td>   <?php echo $row['Department_Name'];}?>  </td>
    </tr>  



    </table>

    <?php
  $query = mysqli_query($conn, "SELECT * FROM InsurancePlan Where Insurance_Plan_ID =".$InsurancePlan_ID."");

  while ($row = mysqli_fetch_array($query)) {
  
    ?>
    <h2 class="PageTitle"> Insurance Plan Information</h2>
    <table  width="600" border="0" align="center" cellpadding="5" cellspacing="5" class="Table"  id="InsuranceDetails">


    <tr>
       <td class="bold">Plan Name</td>  
       <td>   <?php echo $row['Plan_Name']; ?>  </td>
    </tr> 
    <tr>
       <td class="bold">Coverage Details</td>  
       <td>   <?php echo $row['Coverage_Details']; ?>  </td>
    </tr> 
    <tr>
       <td class="bold">Premium Amount</td>  
       <td>   <?php echo $row['Premium_Amount']; ?>  </td>
    </tr> 
    <tr>
       <td class="bold">Effective Date</td>  
       <td>   <?php echo $row['Effective_Date']; ?>  </td>
    </tr> 
    <tr>
       <td class="bold">Expiry_Date_</td>  
       <td>   <?php echo $row['Expiry_Date_']; }?>  </td>
    </tr> 

  </table>
   <form action="Edit_Employee.php" method="post">
         <input style="display:none"  type="text" value="<?php print $Staff_ID; ?>"  name="Staff_ID" >
       <input align="center"  name="Submit" type="submit" value="Edit Personal Information" class="Button" id="NewEmloyee">
   </form>
    
  </div>
</div>
</body>

