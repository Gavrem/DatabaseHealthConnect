

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
    <link href="style.css" type="text/css" rel="stylesheet">
<link rel="icon"        type="image/png"        href="logo.png">
	 <script type="text/javascript" src="login.js">  </script>


</head>
<body>
<?php

    require ('common.php');

	print_nav();

?> 
<div id ="main_body">
	<div id ="logdiv" style="width:1000px; font-size:10pt;">
		<form action="" method="post" name="Register" id="log_form"  onsubmit="return checkCompleteness();">
			  <table  width="1000" border="0" align="center" cellpadding="5" cellspacing="5" class="Table">
				
							<tr>
				<th>ID</th>
			  <th>First</th>
			  <th>Last</th>
			  <th>UserName</th>
			  <th>Email</th>
			  <th>Phone</th>
			  <th>image</th>
			<th>Password</th>
	
			</tr>

			<?php
			$servername = "localhost";
			$username = "skulkuloglu1";
			$password = "skulkuloglu1";
			$dbname = "skulkuloglu1";

			$conn = mysqli_connect($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 

			$query = mysqli_query($conn, "SELECT * FROM USERS");

			while ($row = mysqli_fetch_array($query)) {

			  echo
			   "<tr>    <td> {$row['id']} </td>
			   <td> {$row['User_first_name']} </td>
				 <td>   {$row['User_last_name']} </td>
			   <td>  {$row['User_name']} </td>
			   <td>  {$row['User_email']} </td>
			   <td>  {$row['User_phone_number']} </td>
			   <td>  {$row['User_image']} </td>
			    <td>  {$row['User_password']} </td>

				</tr>
				\n";
			}


			?>
			  </table>
	</div>
</div>

</body>
</html>