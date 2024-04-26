<?php  session_start();
?>
<html>
<head>
<meta charset="utf-8">
<title>Common PHP</title>
<link href="style.css" type="text/css" rel="stylesheet">


</head>
<body>

<?php 
function print_nav(){
	
 echo "<header><nav>";
	echo "<div id='container' > ";
	echo "<div class='logo' >		<a href='Home.php' ><img src='images/logo.png' alt='Logo' height='100' > </a></div>";
	echo " <div id='pageTitle'> <h1 ><a href='Home.php' >  HealthConnect </a> </h1> </div></div>";
	echo "<div class='menu'>";
	echo "<ul> <li>	<a href='Home.php' >Home</a></li>";

	if ($_SESSION["Type"] == "admin"){

	echo "<li>	<a href='Employee.php' >Employee</a></li>";
	echo "<li>	<a href='Insurance.php' >Insurance</a></li>";
	echo "<li>	<a href='Department.php' >Department</a></li>";
	echo "<li>	<a href='Provider.php' >Provider</a></li>";
	echo "<li>	<a href='Advance.php' >Advance</a></li>";

	}elseif ($_SESSION["Type"] == "Staff"){
		echo "<li>	<a href='Employee_Profile.php' > My Profile </a></li>";
		echo "<li>	<a href='Insurance.php' >Insurance</a></li>";
		echo "<li>	<a href='Provider.php' >Provider</a></li>";
		echo "<li>	<a href='Department.php' >Department</a></li>";


	}elseif ($_SESSION["Type"] == "Insurance_Company"){
		echo "<li>	<a href='Insurance.php' >Insurance</a></li>";

	}elseif ($_SESSION["Type"] == "Provider"){
		echo "<li>	<a href='Provider.php' >Provider</a></li>";

	}elseif ($_SESSION["Type"] == "Department"){
		echo "<li>	<a href='Department.php' >Department</a></li>";

	}

	


	
	
	
	if ( !isset($_SESSION['id'])){
		echo "<li>	<a href='login.php' >Log In</a></li>";
		echo "<li>	<a href='register.php' >Register</a></li>";
		}
	if ( isset($_SESSION['id'])){

?>
		<li id="drp-log" style=" text-align:center;">
			<div class="dropdown">
				<?php	echo "<span  style='width:120px; text-align:center;' >".$_SESSION['user']."</span>";?>
					<div class="dropdown-content" >
					<a href='logout.php'style='color:red;' >Log out</a>
					</div>
				</div></li>
	<?php 
				}
			echo " </ul></div></nav> ";
			echo "</header><div id ='fixed_bg'></div>";

}

function renderFooter() {
    echo '<footer>
            <h2>Join HealthConnect Today</h2>
            <p>Experience a new era of healthcare management that prioritizes efficiency, transparency, and cost-saving without compromising on quality care.</p>
        </footer>';
}


?>


</body>
</html>
