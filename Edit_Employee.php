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
  print_r($_POST);
  if (isset($_POST['Staff_ID'])){
    $Staff_ID = $_POST['Staff_ID'];
  }else if (isset($_SESSION['Staff_ID'])){
    $Staff_ID = $_SESSION['Staff_ID'];


  }
  // if (isset($_POST['Save'])){
  //   print $_POST['First_Name'];
  

   
  //     $sql = "
  //     UPDATE Employee SET
  //       First_Name = '".$_POST["First_Name"]."' ,
  //       Last_Name =  '".$_POST["Last_Name"]."',
  //       DoB = '".$_POST["Date_of_Birth"]."',
  //       Gender = '".$_POST["Gender"]."', 
  //       Position = '".$_POST["Position"]."', 
  //       InsurancePlan_ID = ".$_POST["Insurance_Plan_ID"].",
  //       Department_ID = ".$_POST["Department_ID"]."
  //     WHERE Staff_ID=".$Staff_ID."
  //     ";


  //       if ($conn->query($sql) === TRUE) {
  //         $msg =  "Successfully!";
  //       }else{
  //         $msg = "Error registering";

  //       }
  //       $conn->close();
  // }else{
  //   $msg =  "This Error happen on creating new employee.";
  //   $name_error = true;
  
  // }

?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Edit Personal Info</title>
    <link href="style.css" type="text/css" rel="stylesheet">
<link rel="icon"        type="image/png"        href="logo.png">
<style>
   
</style>
  </head>



  <body >
<?php

    require ('common.php');

	print_nav();

?>

<div id="main_page">
  <div id="main_body">
  <h2>Edit My Profile</h2>


  <?php
     if ( $_SESSION["Staff_ID"] != Null ){
    
  $query = mysqli_query($conn, "SELECT * FROM Employee Where Staff_ID =".$Staff_ID."");

  while ($row = mysqli_fetch_array($query)) {
    $InsurancePlan_ID =  $row['InsurancePlan_ID'];
    $Department_ID = $row['Department_ID'];
    $Staff_ID = $row['Staff_ID'];
    
  
  ?>
<form action="Employee_Profile.php" method="post" id="NewEmpForm">
    <table>
        <tr>
            <td><label for="firstName">First Name:</label></td>
            <td><input type="text" id="firstName" name="First_Name" value="<?php echo $row['First_Name']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="lastName">Last Name:</label></td>
            <td><input type="text" id="lastName" name="Last_Name"  value="<?php echo $row['Last_Name']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="dob">Date of Birth:</label></td>
            <td><input type="date" id="dob" name="Date_of_Birth"   value="<?php echo $row['DoB']; ?>"  required></td>
        </tr>
        <tr>
            <td><label for="gender">Gender:</label></td>
            <td>
                <select id="gender" name="Gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male" <?php if ($row['Gender']=="Male") {print "selected";}?> >Male</option>
                    <option value="Female" <?php if ($row['Gender']=="Female") {print "selected";}?>>Female</option>
                    <option value="Other" <?php if ($row['Gender']=="Other") {print "selected";}?>>Other</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="position">Position:</label></td>
            <td><input type="text" id="position" name="Position"  value="<?php echo $row['Position']; ?>" required></td>
        </tr>
        <tr>
        <td><label for="insurancePlanID">Insurance Plan:</label></td>
            <td>
                <select id="insurancePlanID" name="Insurance_Plan_ID" required>
                    <option value="">Select Plan</option>
                    <!-- Generate numbers from 1 to 10 for selection -->
                    <option value="1"  <?php if ($row['InsurancePlan_ID']=="1") {print "selected";}?> >Health Maintenance Organization	</option>
                    <option value="2"  <?php if ($row['InsurancePlan_ID']=="2") {print "selected";}?>>Preferred Provider Organization	</option>
                    <option value="3"  <?php if ($row['InsurancePlan_ID']=="3") {print "selected";}?>>Point of Service	</option>
                    <option value="4"  <?php if ($row['InsurancePlan_ID']=="4") {print "selected";}?>>Exclusive Provider Organization	</option>
                    <option value="5" <?php if ($row['InsurancePlan_ID']=="5") {print "selected";}?> >High Deductible Health Plan	</option>
                    <option value="6"  <?php if ($row['InsurancePlan_ID']=="6") {print "selected";}?>>Catastrophic Health Insurance	</option>
                    <option value="7"  <?php if ($row['InsurancePlan_ID']=="7") {print "selected";}?>>Medicaid </option>
                    <option value="8"  <?php if ($row['InsurancePlan_ID']=="8") {print "selected";}?>>Medicare</option>
                    <option value="9"  <?php if ($row['InsurancePlan_ID']=="9") {print "selected";}?>>Short-Term Health Insurance	</option>
                    <option value="10"  <?php if ($row['InsurancePlan_ID']=="10") {print "selected";}?>>Employer-Sponsored	</option>
                </select>
            </td>
        </tr>
        <tr>
        <td><label for="departmentID">Department:</label></td>
            <td>
                <select id="departmentID" name="Department_ID" required>
                    <option value="">Select Department ID</option>
                    <!-- Generate numbers from 1 to 10 for selection -->
                    <option value="1"  <?php if ($row['Department_ID']=="1") {print "selected";}?>>Human Resource</option>
                    <option value="2"  <?php if ($row['Department_ID']=="2") {print "selected";}?>>Marketing	</option>
                    <option value="3"  <?php if ($row['Department_ID']=="3") {print "selected";}?>>IT	</option>
                    <option value="4"  <?php if ($row['Department_ID']=="4") {print "selected";}?>>Finance</option>
                    <option value="5"  <?php if ($row['Department_ID']=="5") {print "selected";}?>>Operations	</option>
                    <option value="6"  <?php if ($row['Department_ID']=="6") {print "selected";}?>>Economics</option>
                    <option value="7"  <?php if ($row['Department_ID']=="7") {print "selected";}?>>Computer Science	</option>
                    <option value="8"  <?php if ($row['Department_ID']=="8") {print "selected";}?>>Geography</option>
                    <option value="9"  <?php if ($row['Department_ID']=="9") {print "selected";}?>>Sociology</option>
                    <option value="10"  <?php if ($row['Department_ID']=="10") {print "selected";}?>>Music</option>
                </select>
            </td>
        </tr>
        <tr  style="display:none">
          <td  style="display:none" colspan="2">
                  <input type="text" style="display:none"  name="Staff_ID"   value="<?php echo $_POST['Staff_ID'];?>"  required>
        </tr>   
          <tr>
            <td style="text-align:center" colspan="1">
               <button  type="submit" class="button" value="Submit" name="Save" >Save</button>
            </td>
            <td style="text-align:center" colspan="1">
               <button type="submit" style="background:red" class="button" name="Delete" value="Delete"> Delete </button>

            </td>
        </tr>
    </table>

    <?php }?>

    
</form>


    <?php }else{?>

      <form action="Employee_Profile.php" method="post" id="NewEmpForm">
    <table>
        <tr>
            <td><label for="firstName">First Name:</label></td>
            <td><input type="text" id="firstName" name="First_Name"  required></td>
        </tr>
        <tr>
            <td><label for="lastName">Last Name:</label></td>
            <td><input type="text" id="lastName" name="Last_Name"  required></td>
        </tr>
        <tr>
            <td><label for="dob">Date of Birth:</label></td>
            <td><input type="date" id="dob" name="Date_of_Birth"   required></td>
        </tr>
        <tr>
            <td><label for="gender">Gender:</label></td>
            <td>
                <select id="gender" name="Gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male"  >Male</option>
                    <option value="Female" >Female</option>
                    <option value="Other" >Other</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="position">Position:</label></td>
            <td><input type="text" id="position" name="Position"   required></td>
        </tr>
        <tr>
        <td><label for="insurancePlanID">Insurance Plan:</label></td>
            <td>
                <select id="insurancePlanID" name="Insurance_Plan_ID" required>
                    <option value="">Select Plan</option>
                    <!-- Generate numbers from 1 to 10 for selection -->
                    <option value="1"   >Health Maintenance Organization	</option>
                    <option value="2" >Preferred Provider Organization	</option>
                    <option value="3" >Point of Service	</option>
                    <option value="4"  >Exclusive Provider Organization	</option>
                    <option value="5"  >High Deductible Health Plan	</option>
                    <option value="6"  >Catastrophic Health Insurance	</option>
                    <option value="7"  >Medicaid </option>
                    <option value="8" >Medicare</option>
                    <option value="9" >Short-Term Health Insurance	</option>
                    <option value="10" >Employer-Sponsored	</option>
                </select>
            </td>
        </tr>
        <tr>
        <td><label for="departmentID">Department:</label></td>
            <td>
                <select id="departmentID" name="Department_ID" required>
                    <option value="">Select Department ID</option>
                    <!-- Generate numbers from 1 to 10 for selection -->
                    <option value="1"  >Human Resource</option>
                    <option value="2"  >Marketing	</option>
                    <option value="3"  >IT	</option>
                    <option value="4"  >Finance</option>
                    <option value="5"  >Operations	</option>
                    <option value="6"  >Economics</option>
                    <option value="7" >Computer Science	</option>
                    <option value="8"  >Geography</option>
                    <option value="9" >Sociology</option>
                    <option value="10"  >Music</option>
                </select>
            </td>
        </tr>

          <tr>
            <td style="text-align:center" colspan="1">
               <button  type="submit" class="button" value="Create" name="Save" >Save</button>
            </td>
            
        </tr>
    </table>


    
</form>
      
			
      <?php } ?>
  </div>
</div>
</body>

