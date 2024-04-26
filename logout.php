<?php session_start(); /* Starts the session */
			if ( isset($_SESSION['id'])){
			$msg = "You successfully Loged Out!";
			session_destroy(); /* Destroy started session */
			header("Location:login.php");
			die();
			}else{
				$msg = "You need to Log In before Loging Out!";
			header("Location:login.php");
			die();
			}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link href="style.css" rel="stylesheet">
<link rel="icon"        type="image/png"        href="logo.png">

</head>
<body>
<?php

    require ('common.php');

	print_nav();

?> 
<br>
<div id= "main_body">
</div>

</body>
</html>