<?php session_start(); /* Starts the session */

if(isset($_GET['Staff_ID'])){
	$_SESSION['Staff_ID'] = $_GET['Staff_ID'];
	$Staff_ID = $_SESSION['Staff_ID'];
	// unset($_POST);
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
    if (isset($_POST["Clear"]) && $_POST["Clear"] == "Clear"){
        $_POST = array();
      }
          if(isset($_POST['Search'])){
            $ZIP = $_POST['ZIP'];
                if(isset($_POST['MaxDistance']) && $_POST['MaxDistance'] != ""){
                    $MaxDistance = $_POST['MaxDistance'];
                }else{
                    $MaxDistance = 99000;
                }
                if(isset($_POST['PremiumAmount']) && $_POST['PremiumAmount'] != ""){
                    $PremiumAmount = $_POST['PremiumAmount'];
                }else{
                    $PremiumAmount =2000;
                }
                if(isset($_POST['PlanName']) && $_POST['PlanName'] != ""){
                    $PlanName = "='".$_POST['PlanName']."' ";
                }else{
                    $PlanName = "<> ' ' ";
                }
                if(isset($_POST['CompanyName']) && $_POST['CompanyName'] != ""){
                    $CompanyName = "='".$_POST['CompanyName']."' ";
                }else{
                    $CompanyName = "<> ' ' ";
                }
                if(isset($_POST['Coverage']) && $_POST['Coverage'] != ""){
                    $Coverage = "='".$_POST['Coverage']."' ";
                }else{
                    $Coverage = "<> ' ' ";
                }
                if(isset($_POST['Provider']) && $_POST['Provider'] != ""){
                    $Provider = "='".$_POST['Provider']."' ";
                }else{
                    $Provider = "<> ' ' ";
                }
                if(isset($_POST['ProviderType']) && $_POST['ProviderType'] != ""){
                    $ProviderType = "='".$_POST['ProviderType']."' ";
                }else{
                    $ProviderType = "<> ' ' ";
                }
            $Where  = "WHERE IP.Premium_Amount <  $PremiumAmount
                            AND  IP.Plan_Name  $PlanName 
                            AND   IC.Ins_Company_Name  $CompanyName 
                            AND  IP.Coverage_Details $Coverage
                            AND  P.Provider_Name  $Provider
                            AND  P.Provider_Type $ProviderType ";
                
    }
   
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Nearby Healthcare Providers and Insurance Plans</title>
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
   <div id="home_page">
   <div id="Search_AV">
        <form action="" method="post" id="SearchInsurance" style="display: flex;">
        <select name="ZIP" required>
            <option value=""> Zipcode</option>  <?php  
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $query = mysqli_query($conn, "SELECT zip_code FROM zip_codes ORDER BY  zip_code ;  ");
                while ($row = mysqli_fetch_array($query)) { ?> 
            <option value="<?=$row["zip_code"] ?>"  <?php if(isset($_POST['ZIP']) && $_POST['ZIP'] ==$row["zip_code"] ){echo "selected";} ?>   > <?php echo $row["zip_code"];?></option>
        <?php  }?>
        </select>

        <select name="Provider" >
            <option value=""> Provider</option>  <?php  
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $query = mysqli_query($conn, "SELECT Provider_Name FROM Providers;  ");
                while ($row = mysqli_fetch_array($query)) { ?> 
            <option value="<?=$row["Provider_Name"] ?>" <?php if(isset($_POST['Provider']) && $_POST['Provider'] ==$row["Provider_Name"] ){echo "selected";} ?>   > <?php echo $row["Provider_Name"];?></option>
        <?php  }?>
        </select>
        <select name="ProviderType" >
            <option value=""> Provider</option>  <?php  
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $query = mysqli_query($conn, "SELECT DISTINCT Provider_Type FROM Providers;  ");
                while ($row = mysqli_fetch_array($query)) { ?> 
            <option value="<?=$row["Provider_Type"] ?>" <?php if(isset($_POST['ProviderType']) && $_POST['ProviderType'] ==$row["Provider_Type"] ){echo "selected";} ?>  > <?php echo $row["Provider_Type"];?></option>
        <?php  }?>
        </select>
            
        <select name="PlanName">
            <option value=""> Plan Name</option>  <?php  
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $query = mysqli_query($conn, "SELECT Plan_Name FROM InsurancePlan;  ");
                while ($row = mysqli_fetch_array($query)) { ?> 
            <option value="<?=$row["Plan_Name"] ?>" <?php if(isset($_POST['PlanName']) && $_POST['PlanName'] ==$row["Plan_Name"] ){echo "selected";} ?> > <?php echo $row["Plan_Name"];?></option>
        <?php  }?>
        </select>
        <select name="CompanyName" >
            <option value=""> Company Name</option>  <?php  
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $query = mysqli_query($conn, "SELECT Ins_Company_Name FROM InsuranceCompany;  ");
                while ($row = mysqli_fetch_array($query)) { ?> 
            <option value="<?=$row["Ins_Company_Name"] ?>" <?php if(isset($_POST['CompanyName']) && $_POST['CompanyName'] ==$row["Ins_Company_Name"] ){echo "selected";} ?>  > <?php echo $row["Ins_Company_Name"];?></option>
        <?php  }?>
        </select>
        <select name="Coverage" >
            <option value=""> Coverage</option>  <?php  
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $query = mysqli_query($conn, "SELECT DISTINCT Coverage_Details FROM InsurancePlan;  ");
                while ($row = mysqli_fetch_array($query)) { ?> 
            <option value="<?=$row["Coverage_Details"] ?>" <?php if(isset($_POST['Coverage']) && $_POST['Coverage'] ==$row["Coverage_Details"] ){echo "selected";} ?>   > <?php echo $row["Coverage_Details"];?></option>
        <?php  }?>
        </select>
        
        <input type="number" id="PremiumAmount" name="PremiumAmount"  placeholder="Premium Amount"  value=<?php if(isset($_POST['PremiumAmount']) && $_POST['PremiumAmount'] !=" " ){echo $_POST['PremiumAmount'];} ?>  >
        <input type="number" id="MaxDistance" name="MaxDistance"  placeholder="MaxDistance"  value=<?php if(isset($_POST['MaxDistance']) && $_POST['MaxDistance'] !=" " ){echo $_POST['MaxDistance'];} ?>  >

       

        <button type="submit"  name="Search" Value="Search">Search</button>
        <button type="submit" class="Clear"  name="Clear" Value="Clear">Clear</button>
        </form>

        </div>

   <p id="aggregateHeader"> Nearby Healthcare Providers and Insurance Plans</p>
  <table  width="1200" border="0" align="center" cellpadding="5" cellspacing="5" class="Table"  id="ADV2">
  <tr>
     <td class="bold"> Provider    </td>
      <td class="bold">  ProviderType </td>
      <td class="bold">   Plan Name  </td>
      <td class="bold">  Company Name   </td>
      <td class="bold">  Coverage    </td>
      <td class="bold"> Premium Amount    </td>
      <td class="bold"> Zip Code   </td>
      <td class="bold"> City  </td>
      <td class="bold"> State   </td>
      <td class="bold"> Distance (miles)    </td>
      


   </tr>
  <?php 
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$query = mysqli_query($conn, "
        SELECT
    P.Provider_Name,
    P.Provider_Type,
    IP.Plan_Name AS InsurancePlan,
    IC.Ins_Company_Name AS InsuranceCompany,
    IP.Coverage_Details,
    IP.Premium_Amount,
    PA.Zipcode AS ProviderZipCode,
    PA.City AS ProviderCity,
    PA.State AS ProviderState,
    ZC1.latitude AS ProviderLatitude,
    ZC1.longitude AS ProviderLongitude,
    ZC2.latitude AS UserLatitude,
    ZC2.longitude AS UserLongitude,
    ROUND(3959 * 2 * ASIN(SQRT(
        POWER(SIN((RADIANS(ZC1.latitude) - RADIANS(ZC2.latitude)) / 2), 2) +
        COS(RADIANS(ZC2.latitude)) * COS(RADIANS(ZC1.latitude)) *
        POWER(SIN((RADIANS(ZC1.longitude) - RADIANS(ZC2.longitude)) / 2), 2)
    )), 2) AS Distance_miles
FROM
    Providers P
JOIN
    Providers_Address PA ON P.Address_ID = PA.Address_ID
JOIN
    zip_codes ZC1 ON PA.Zipcode = ZC1.zip_code
JOIN
    Accepts A ON P.Provider_ID = A.Provider_ID
JOIN
    InsurancePlan IP ON A.InsurancePlan_ID = IP.Insurance_Plan_ID
JOIN
    Designs D ON IP.Insurance_Plan_ID = D.InsurancePlan_ID
JOIN
    InsuranceCompany IC ON D.Ins_Company_Name = IC.Ins_Company_Name
JOIN
    zip_codes ZC2 ON ZC2.zip_code = '$ZIP'
     $Where
    ORDER BY
    Distance_miles;
       ");

		while ($row = mysqli_fetch_array($query)) {
            if($MaxDistance > $row["Distance_miles"]){
?> 
   

   <tr>
      <td>  <?php echo $row["Provider_Name"];  ?> </td>
      <td>  <?php echo $row["Provider_Type"];  ?> </td>
      <td>  <?php echo $row["InsurancePlan"];  ?> </td>
      <td>  <?php echo $row["InsuranceCompany"];  ?> </td>
      <td>  <?php echo $row["Coverage_Details"];  ?> </td>
      <td>  <?php echo $row["Premium_Amount"];  ?> </td>
      <td>  <?php echo $row["ProviderZipCode"];  ?> </td>
      <td>  <?php echo $row["ProviderCity"];  ?> </td>
      <td>  <?php echo $row["ProviderState"];  ?> </td>
      <td>  <?php echo $row["Distance_miles"];  ?> </td>
     

   </tr>



<?php           } }     ?> 
    </table>



      </div>
  </div>
</div>
<?php  renderFooter();  ?>
</body>


<?php
