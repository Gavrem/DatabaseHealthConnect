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



    if(isset($_POST["First_Name"])){
   
      $sql = "
      INSERT INTO Employee
        (First_Name, Last_Name, DoB, Gender, Position, InsurancePlan_ID, Department_ID)
      VALUES
      ('".$_POST["First_Name"]."', '".$_POST["Last_Name"]."', '".$_POST["Date_of_Birth"]."', '".$_POST["Gender"]."', '".$_POST["Position"]."', ".$_POST["Insurance_Plan_ID"].", ".$_POST["Department_ID"].")";


        if ($conn->query($sql) === TRUE) {
          $msg =  "Successfully!";
        }else{
          $msg = "Error registering";

        }
        $conn->close();
        header("Location:Employee.php");
        die();
  }else{
    $msg =  "This Error happen on creating new employee.";
    $name_error = true;
   
  }

?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Add New Employee</title>
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
  <h2>Employee Data Entry</h2>

<form action="" method="post" id="NewEmpForm">
    <table>
        <tr>
            <td><label for="firstName">First Name:</label></td>
            <td><input type="text" id="firstName" name="First_Name" required></td>
        </tr>
        <tr>
            <td><label for="lastName">Last Name:</label></td>
            <td><input type="text" id="lastName" name="Last_Name" required></td>
        </tr>
        <tr>
            <td><label for="dob">Date of Birth:</label></td>
            <td><input type="date" id="dob" name="Date_of_Birth" required></td>
        </tr>
        <tr>
            <td><label for="gender">Gender:</label></td>
            <td>
                <select id="gender" name="Gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="position">Position:</label></td>
            <td><input type="text" id="position" name="Position" required></td>
        </tr>
        <tr>
        <td><label for="insurancePlanID">Insurance Plan:</label></td>
            <td>
                <select id="insurancePlanID" name="Insurance_Plan_ID" required>
                    <option value="">Select Plan ID</option>
                    <!-- Generate numbers from 1 to 10 for selection -->
                    <option value="1">Health Maintenance Organization	</option>
                    <option value="2">Preferred Provider Organization	</option>
                    <option value="3">Point of Service	</option>
                    <option value="4">Exclusive Provider Organization	</option>
                    <option value="5">High Deductible Health Plan	</option>
                    <option value="6">Catastrophic Health Insurance	</option>
                    <option value="7">Medicaid </option>
                    <option value="8">Medicare</option>
                    <option value="9">Short-Term Health Insurance	</option>
                    <option value="10">Employer-Sponsored	</option>
                </select>
            </td>
        </tr>
        <tr>
        <td><label for="departmentID">Department:</label></td>
            <td>
                <select id="departmentID" name="Department_ID" required>
                    <option value="">Select Department ID</option>
                    <!-- Generate numbers from 1 to 10 for selection -->
                    <option value="1">Human Resource</option>
                    <option value="2">Marketing	</option>
                    <option value="3">IT	</option>
                    <option value="4">Finance</option>
                    <option value="5">Operations	</option>
                    <option value="6">Economics</option>
                    <option value="7">Computer Science	</option>
                    <option value="8">Geography</option>
                    <option value="9">Sociology</option>
                    <option value="10">Music</option>
                </select>
            </td>
        </tr>
    </table>
    <div class="button-container">
        <button type="submit" class="button">Submit</button>
    </div>
</form>



			
  </div>
</div>
</body>

