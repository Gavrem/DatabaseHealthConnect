
<script>
	function goToLogin( ) {
		const formProp = document.createElement('form');
		formProp.method = 'post';
		formProp.action = 'login.php';
		const hiddenField = document.createElement('input');
		hiddenField.setAttribute("style", "display:none;");
		hiddenField.type = 'text';
		hiddenField.name = 'Message';
		hiddenField.value = "Successfully Registered!";
		formProp.appendChild(hiddenField);
		document.body.appendChild(formProp);
		formProp.submit();
}
	</script>
<?php
session_start(); /* Starts the session */
		if ( isset($_SESSION['id'])){
			header("Location:Home.php");
			die();
		}

$servername = "localhost";
$username = "skulkuloglu1";
$password = "skulkuloglu1";
$dbname = "skulkuloglu1";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	
	if(isset($_POST["Username"])){
				$query = mysqli_query($conn, "SELECT * FROM Login WHERE User_name='".$_POST["Username"]."'");
				$flag  = false;
				while ($row = mysqli_fetch_array($query)) {
					if($row['User_name'] == $_POST["Username"]){
						$flag = true;
					}

				}
	if ($flag == false){

		//var_dump($_POST);
				 // Plaintext password entered by the user
		  $plaintext_password = $_POST["Password"];
		  
		  // The hashed password retrieved from database
			$hash = password_hash($plaintext_password,PASSWORD_DEFAULT);
		  
		  // Verify the hash against the password entered
		  $verify = password_verify($plaintext_password, $hash);
		  
		  // Print the result depending if they match
		  if ($verify) {
			  echo 'Password Verified!';
		  } else {
			  echo 'Incorrect Password!';
		  }
		$sql = "
		INSERT INTO Login 
		(User_first_name, User_last_name, User_name,Account_type, User_email, User_phone_number, User_password)
 

		VALUES
		  ('".$_POST["User_first_name"]."','".$_POST["User_last_name"]."','".$_POST["Username"]."', '".$_POST["Account_type"]."','".$_POST["Email"]."','".$_POST["User_phone_number"]."', '".$hash."' )

		";


		if ($conn->query($sql) === TRUE) {
			$msg =  "Successfully registered!";
		}else{
			$msg = "Error registering";

		}
		$conn->close();
		echo "<script>goToLogin();</script>";
		//header("Location:login.php");
		die();
		}else{
			$msg =  "This Username is taken, please select another username.";
			$name_error = true;
			
		}
	}
?> 


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
    <link href="style.css" type="text/css" rel="stylesheet">
	<link rel="icon"        type="image/png"        href="logo.png">
	<script type="text/javascript" src="register.js">  </script>


</head>
<body>
<?php

    require ('common.php');

	print_nav();

?> 

<div id ="main_body">
	<div id ="logdiv">
		<form action="" method="post" name="Register" id="regFrom"  onsubmit="return chekcRegister()">
			  <table  width="400" border="0" align="center" cellpadding="5" cellspacing="5" class="RegTable">
				
				<tr>
				  <td colspan="2" align="center" valign="top" id ="msg">  <?php if(isset($msg)){echo $msg;}?></td>
				</tr>
				<tr>
					<td colspan="2" align="left" valign="top"><h2>Register</h2></td>
				</tr>
				<tr>
					  <td align="left" valign="top" id="user_name_label">Account Type</td>
					  <td><select class="Input" name="Account_type">  
						  <option value="Staff" selected>Staff</option>  
							<option value="Insurance_Company">Insurance Company</option>  
							<option value="Provider">Provider</option>  
							<option value="Department">Department</option>  						
							</select> 
					 </td>
				</tr>
				<tr>
					  <td align="left" valign="top" id="user_name_label">Username</td>
					  <td><input name="Username" type="text" class="Input" minlength="2" maxlength="15" value="<?php if(isset($_POST["Username"])){echo $_POST["Username"];}?>">  </td>
				</tr>
				<tr>
					  <td align="left" valign="top" id="UserFirstName">First Name</td>
					  <td><input name="User_first_name" type="text" class="Input" minlength="1" maxlength="15" value="<?php if(isset($_POST["User_first_name"])){echo $_POST["User_first_name"];}?>">  </td>
				</tr>
				<tr>
					  <td align="left" valign="top" id="UserLastName">Last Name</td>
					  <td><input name="User_last_name" type="text" class="Input" minlength="1"  maxlength="15"value="<?php if(isset($_POST["User_last_name"])){echo $_POST["User_last_name"];}?>">  </td>
				</tr>
				<tr>
					  <td align="left" valign="top"  id="regEmail">Email Address</td>
					  <td><input name="Email" type="text" class="Input"   value="<?php if(isset($_POST["Email"])){echo $_POST["Email"];}?>"> </td>
				</tr>
				<tr>
					  <td align="left" valign="top"  id="UserPhone">Phone Number</td>
					  <td><input name="User_phone_number" type="text"  class="Input" minlength="10" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(isset($_POST["User_phone_number"])){echo $_POST["User_phone_number"];}?>"> </td>
				</tr>
					 			
				<tr>
				  <td align="left"  id="passwordOne">Password</td>
				  <td><input name="Password" type="password" class="Input" minlength="4"  value="<?php if(isset($_POST["Password"])){echo $_POST["Password"];}?>">  </td>
				</tr>
				<tr>
				  <td align="left" id="passwordTwo">Confirm Password</td>
				  <td><input name="CPassword" type="password" class="Input" minlength="4" value="<?php if(isset($_POST["CPassword"])){echo $_POST["CPassword"];}?>">  </td>
				</tr>
				<tr>
				  <td align="center"  colspan="2">	  <input align="center"  name="Submit" type="submit" value="Register" class="Button">
				  </td>
				</tr>
			  </table>
		</form>
		<p class="subNote">Have an account <a href = login.php >click to login</a> </p>
				

	</div>
</div>
<?php 	if ($name_error== true){

			echo '<script type="text/javascript">',
					'document.getElementById("regName").style.color = "red";',
				 '</script>'
			;
			}
?>
</body>
</html>