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
                
       
        if(isset($_POST['PlanName']) && $_POST['PlanName'] != ""){
            $PlanName = "='".$_POST['PlanName']."' ";
        }else{
            $PlanName = "<> ' ' ";
        }
        if(isset($_POST['Coverage']) && $_POST['Coverage'] != ""){
            $Coverage = "='".$_POST['Coverage']."' ";
        }else{
            $Coverage = "<> ' ' ";
        }
        if(isset($_POST['Department']) && $_POST['Department'] != ""){
            $Department = "='".$_POST['Department']."' ";
        }else{
            $Department = "<> ' ' ";
        }
        if(isset($_POST['EffectiveDate']) && $_POST['EffectiveDate'] != ""){
            $EffectiveDate = ">'".$_POST['EffectiveDate']."' ";
        }else{
            $EffectiveDate = "<> ' ' ";
        }
        if(isset($_POST['ExpiryDate']) && $_POST['ExpiryDate'] != ""){
            $ExpiryDate = "<'".$_POST['ExpiryDate']."' ";
        }else{
            $ExpiryDate = "<> ' ' ";
        }
        

        
        $Where  = "WHERE  IP.Plan_Name  $PlanName  
                        AND  IP.Coverage_Details  $Coverage
                        AND  D.Department_Name  $Department 
                        AND  IP.Effective_Date $EffectiveDate 
                        AND  IP.Expiry_Date_  $ExpiryDate 
                        ";

        //  $Where  = "WHERE  IP.Plan_Name  $PlanName 
        //             AND  Coverage $Coverage
        //             AND  D.Department_Name  $Department ";
        
    }
   
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Department-Wise Insurance Plan Analysis</title>
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
   <div id="Search_AV" class="Search_AV3">
        <form action="" method="post" id="SearchInsurance" style="display: flex;">
    

        <select name="Department" >
            <option value=""> Department</option>  <?php  
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $query = mysqli_query($conn, "SELECT Department_Name FROM Department;  ");
                while ($row = mysqli_fetch_array($query)) { ?> 
            <option value="<?=$row["Department_Name"] ?>" <?php if(isset($_POST['Department']) && $_POST['Department'] ==$row["Department_Name"] ){echo "selected";} ?>   > <?php echo $row["Department_Name"];?></option>
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
        
        <select name="Coverage" >
            <option value=""> Coverage</option>  <?php  
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $query = mysqli_query($conn, "SELECT DISTINCT Coverage_Details FROM InsurancePlan;  ");
                while ($row = mysqli_fetch_array($query)) { ?> 
            <option value="<?=$row["Coverage_Details"] ?>" <?php if(isset($_POST['Coverage']) && $_POST['Coverage'] ==$row["Coverage_Details"] ){echo "selected";} ?>   > <?php echo $row["Coverage_Details"];?></option>
        <?php  }?>
        </select>
        <input type="date" id="birthday" name="EffectiveDate" value=<?php if(isset($_POST['EffectiveDate']) && $_POST['EffectiveDate'] !=" " ){echo $_POST['EffectiveDate'];} ?> >

        <input type="date" id="birthday" name="ExpiryDate" value=<?php if(isset($_POST['ExpiryDate']) && $_POST['ExpiryDate'] !=" " ){echo $_POST['ExpiryDate'];} ?>>

        

       

        <button type="submit"  name="Search" Value="Search">Search</button>
        <button type="submit" class="Clear"  name="Clear" Value="Clear">Clear</button>
        </form>

        </div>

   <p id="aggregateHeader"> Department-Wise Insurance Plan Analysis</p>
  <table  width="1200" border="0" align="center" cellpadding="5" cellspacing="5" class="Table"  id="ADV3">
  <tr>
     <td class="bold"> Department Name    </td>
      <td class="bold">   Plan Name  </td>
      <td class="bold">  Coverage  </td>
      <td class="bold">  Effective Date  </td>
      <td class="bold">  Expiry Date  </td>
      <td class="bold">  Number of Employees    </td>
      <td class="bold">  Average Age    </td>
      <td class="bold">  Number of Males    </td>
      <td class="bold"> Numberof Females   </td>
      <td class="bold"> Total Insurance Cost  </td>
      <td class="bold"> Average Premium </td>
      <td class="bold"> Projected Next Year Cost </td>



   </tr>
  <?php 
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		
    $query = mysqli_query($conn, "SELECT
    D.Department_Name,
    IP.Plan_Name,
    IP.Coverage_Details AS Coverage,
    IP.Effective_Date,
    IP.Expiry_Date_,
    COUNT(DISTINCT E.Staff_ID) AS Number_of_Employees,
    ROUND(AVG(YEAR(CURRENT_DATE) - YEAR(E.DoB)), 0) AS Average_Age,
    SUM(CASE WHEN E.Gender = 'Male' THEN 1 ELSE 0 END) AS Number_of_Males,
    SUM(CASE WHEN E.Gender = 'Female' THEN 1 ELSE 0 END) AS Number_of_Females,
    SUM(IP.Premium_Amount) AS Total_Insurance_Cost,
    ROUND(AVG(IP.Premium_Amount),2) AS Average_Premium,
    (SELECT AVG(IP2.Premium_Amount) 
     FROM InsurancePlan IP2 
     WHERE IP2.Insurance_Plan_ID = IP.Insurance_Plan_ID
       AND IP2.Effective_Date BETWEEN DATE_SUB(CURRENT_DATE, INTERVAL 3 YEAR) AND CURRENT_DATE) AS Historical_Average_Premium,
    SUM(IP.Premium_Amount)  AS Projected_Next_Year_Cost -- Projecting a 5% increase
FROM
    Department D
JOIN
    Employee E ON D.Department_ID = E.Department_ID
JOIN
    Buys B ON E.Staff_ID = B.Staff_ID
JOIN
    InsurancePlan IP ON B.InsurancePlan_ID = IP.Insurance_Plan_ID
    $Where
GROUP BY
    D.Department_Name, IP.Plan_Name
ORDER BY
    D.Department_Name, Total_Insurance_Cost DESC;
       ");

		while ($row = mysqli_fetch_array($query)) {
?> 
   

   <tr>
      <td>  <?php echo $row["Department_Name"];  ?> </td>
      <td>  <?php echo $row["Plan_Name"];  ?> </td>
      <td>  <?php echo $row["Coverage"];  ?> </td>
      <td>  <?php echo $row["Effective_Date"];  ?> </td>
      <td>  <?php echo $row["Expiry_Date_"];  ?> </td>
      <td>  <?php echo $row["Number_of_Employees"];  ?> </td>
      <td>  <?php echo $row["Average_Age"];  ?> </td>
      <td>  <?php echo $row["Number_of_Males"];  ?> </td>
      <td>  <?php echo $row["Number_of_Females"];  ?> </td>
      <td>  <?php echo $row["Total_Insurance_Cost"];  ?> </td>
      <td>  <?php echo $row["Average_Premium"];  ?> </td>
      <td>  <?php echo $row["Projected_Next_Year_Cost"];  ?> </td>
     

   </tr>



<?php           }     ?> 
    </table>



      </div>
  </div>
</div>
<?php  renderFooter();  ?>
</body>


<?php
