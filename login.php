<?php session_start(); /* Starts the session */
		if ( isset($_SESSION['id'])){
			header("Location:Home.php");
			die();
		}
		if (isset($_POST['Message'])){
			$msg= $_POST['Message'];
		}
	if (isset($_POST["Username"])){
		$servername = "localhost";
		$username = "skulkuloglu1";
		$password = "skulkuloglu1";
		$dbname = "skulkuloglu1";

		$conn = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
		$flag = false;
		$query = mysqli_query($conn, "SELECT * FROM Login WHERE User_name='".$_POST["Username"]."'");
			while ($row = mysqli_fetch_array($query)) {
					$flag  = true;
				  $pwd = "{$row['User_password']}";
					$email = "{$row['User_email']}";
					$id = "{$row['id']}";
					

				


				  // Verify the hash against the password entered
				  $verify = password_verify( $_POST["Password"],$pwd );

				  // Print the result depending if they match
				  if ($verify) {
					$msg = "Login successfully!";
					$_SESSION["id"] = $id;
					$_SESSION["user"] = $row["User_name"];
					$_SESSION["Type"] = $row["Account_type"];
					if ($_SESSION["Type"] == "Staff"){
						$_SESSION['Staff_ID'] = $row["employee_id"];;
					}
					$_SESSION["email"] = $email;
					$_SESSION["registered"] = "on";
					if ( $_POST["Username"] == "admin"){
						$_SESSION["admin"] = 1;
					}

						header("Location:login.php");
						die();
				  } else {
					$msg = "Password incorrect!";
				  }
			}		
			if ($flag == false){
			$msg = "No User found please Register first!";
			}
		}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link href="style.css" type="text/css" rel="stylesheet">
	<link rel="icon"        type="image/png"        href="logo.png">
	 <script type="text/javascript" src="login.js">  </script>


</head>
<body>
<?php

    require ('common.php');

	print_nav();

?> 

  <div id="main_body">
	<div id ='logdiv'>
		<form action="" method="post" name="Login_Form" id= "log_form">
		<table width="400" border="0" align="center" cellpadding="5" cellspacing="5" class="RegTable">
			<tr>
				<td colspan="2" align="center" valign="top" id ="msg"> <?php if(isset($msg)){echo $msg;}?></td>
			</tr>
			<tr>
				<td colspan="2" align="left" valign="top"><h2>Login</h2></td>
			</tr>
			<tr>
				<td align="right" valign="top">Username</td>
			<td><input name="Username" type="text" class="Input"  value="<?php if(isset($_POST["Username"])){echo $_POST["Username"];}?>"></td>
			</tr>
			<tr>
				<td align="right">Password</td>
				<td><input name="Password" type="password" class="Input" ></td>
			</tr>
			<tr>
				<td colspan="2"> <input name="Submit" type="submit" value="Login" class="Button">
				</td>
			</tr>
		</table>
		</form>
		<p class="subNote">Do not have an account <a href = register.php >click to register</a> </p>

	</div>
</div>

</body>
</html>