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

   function print_table($h1,$h2,$h3,$sql1,$r1,$r2,$r3){

      ?>
      <table  width="800" border="0" align="center" cellpadding="5" cellspacing="5" class="Table"  id="aggregate">
     <tr>
         <td class="bold">  <?php echo $h1; ?>   </td>
         <td class="bold"> <?php echo $h2; ?>    </td>
         <?php if($h3 != "") {?>
              <td class="bold"> <?php echo $h3; ?>    </td>
         <?php } ?>
   
      </tr>
     <?php 
      global $conn;
         
         $query = mysqli_query($conn, $sql1);

         while ($row = mysqli_fetch_array($query)) {
   ?> 
      <tr>
         <td>  <?php echo $row[$r1];  ?> </td>
         <td>  <?php echo $row[$r2];  ?> </td>
         <?php if($r3 != "" && $r3 != "Gender_Percentage") {?>
            <td>  <?php echo $row[$r3];  ?> </td>
            <?php } elseif ($r3 == "Gender_Percentage") { ?>
               <td>  <?php echo $row[$r3]."%";  ?> </td>
               <?php }?>
      </tr>
   
   <?php            }      ?> 
       </table>
   <?php
   }
   ?>

?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Home</title>
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
<?php
if(!isset($_SESSION['Type']) ||$_SESSION['Type'] =="Staff" ){
?>
<div id="Intro">

<h1>Welcome to HealthConnect</h1>
        <p>Your Comprehensive Healthcare Management Platform</p>
        <br>
    </header>
    
    <section>
        <p>At HealthConnect, we bridge the gap between businesses, healthcare providers, and insurance agencies to create a seamless and cost-effective healthcare management experience. We understand that navigating the intricacies of health insurance plans, provider networks, and employee benefits can be complex. Our platform is designed to simplify this process for human resource departments, allowing for efficient tracking and management of employee healthcare benefits.</p>
    </section>
    
    <section id="empowering-departments">
        <h2>Empowering Departments</h2>
        <ul>
            <li><span class="bold">Customized Management:</span>
            With HealthConnect, department heads can view and manage their team's healthcare plans and associated costs, ensuring that each member has the coverage they need.</li>
            
            <li><span class="bold">Insightful Analytics:</span>
            Track healthcare utilization and cost trends within your department, enabling informed decisions about plan offerings and budget allocations.</li>
</ul>
    </section>
    
    <section id="supporting-employees">
        <h2>Supporting Employees</h2>
        <ul>
            <li><span class="bold">Simplified Choices:</span>
            Employees can easily review their insurance plans, understand coverage details, and access healthcare providers within their network.</li>
            
            <li><span class="bold">Personalized Care:</span>
            Through HealthConnect, employees are empowered with the tools to manage their health effectively, from selecting the right insurance plan to accessing the right healthcare provider.</li>
</ul>
    </section>
    
    <section id="connecting-providers-insurers">
        <h2>Connecting Providers and Insurers</h2>
        <ul>
            <li><span class="bold">Effortless Coordination</span>
            Our platform facilitates a smooth interaction between healthcare providers and insurance companies, streamlining the claims process and enhancing service delivery.</li>
            
            <li><span class="bold">Tailored Offerings</span>
            Insurers can design and adjust their health plans based on real-time data, offering competitive and relevant options to clients.</li>
</ul>
    </section>
    
</div
<?php
}
if ($_SESSION["Type"] == "admin"){
?>
   <p id="aggregateHeader"> Departmet Employee Relation</p>
  <table  width="800" border="0" align="center" cellpadding="5" cellspacing="5" class="Table"  id="aggregate">
  <tr>
      <td class="bold">  Department ID    </td>
      <td class="bold">  Department Name   </td>
      <td class="bold">  Number of Employee   </td>

   </tr>
  <?php 
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$query = mysqli_query($conn, "SELECT Department.Department_ID, Department_Name, COUNT(*) AS Employee_Count FROM Employee JOIN Department ON Employee.Department_ID = Department.Department_ID GROUP BY Department_ID;      ");

		while ($row = mysqli_fetch_array($query)) {
?> 
   

   <tr>
      <td>  <?php echo $row["Department_ID"];  ?> </td>
      <td>  <?php echo $row["Department_Name"];  ?> </td>
      <td>  <?php echo $row["Employee_Count"];  ?> </td>

   </tr>



<?php            }      ?> 
    </table>


    <p id="aggregateHeader"> Insurance Plan Average Amounts </p>
         <?php
         print_table("Insurance Plan ID","Plan Name","Average Premium($)","SELECT Insurance_Plan_ID, Plan_Name, ROUND(AVG(Premium_Amount), 2) AS Average_Premium FROM InsurancePlan GROUP BY Insurance_Plan_ID;","Insurance_Plan_ID", "Plan_Name","Average_Premium");
         ?>
   
   <p id="aggregateHeader">  Total Claims per Insurance Company</p>
         <?php
         print_table("Company Name",
         "Total Claims",
         "",
         "SELECT Ins_Company_Name, COUNT(*) AS Total_Claims FROM Claims GROUP BY Ins_Company_Name; ",
         "Ins_Company_Name",
          "Total_Claims",
          "");
         ?>

      <p id="aggregateHeader"> Insurance Company Number of Plans Offered </p>
            <?php
            print_table("Company Name",
            "Number of Plans Offered",
            "",
            "SELECT Ins_Company_Name, COUNT(DISTINCT Insurance_Plan_ID) AS Plans_Offered
            FROM Designs
            JOIN InsurancePlan ON Designs.InsurancePlan_ID = InsurancePlan.Insurance_Plan_ID
            GROUP BY Ins_Company_Name; ",
            "Ins_Company_Name",
            "Plans_Offered",
            "");
            ?>

      <p id="aggregateHeader"> Number of Providers per Insurance Plan </p>
                  <?php
                  print_table("Insurance Plan Name",
                  "Number of Providers",
                  "",
                  "SELECT InsurancePlan.Plan_Name, COUNT(DISTINCT Provider_ID) AS Providers_Count
                  FROM Accepts
                  JOIN InsurancePlan ON Accepts.InsurancePlan_ID = InsurancePlan.Insurance_Plan_ID
                  GROUP BY InsurancePlan.Insurance_Plan_ID;",
                  "Plan_Name",
                  "Providers_Count",
                  "");
                  ?>

         <p id="aggregateHeader"> Deparments Gender Percentage</p>
                  <?php
                  print_table("Department Name",
                  "Gender",
                  "Gender Percentage",
                  "SELECT 
                  d.Department_Name, 
                  e.Gender, 
                  ROUND((COUNT(*) * 100.0 / total.Total_Count), 2) AS Gender_Percentage
              FROM 
                  Employee e
              JOIN 
                  Department d ON e.Department_ID = d.Department_ID
              JOIN 
                  (SELECT Department_ID, COUNT(*) AS Total_Count 
                   FROM Employee 
                   GROUP BY Department_ID) AS total
              ON 
                  d.Department_ID = total.Department_ID
              GROUP BY 
                  d.Department_Name, e.Gender, total.Total_Count;",
                  "Department_Name",
                  "Gender",
                  "Gender_Percentage");
                  ?>

         <p id="aggregateHeader"> Insurance Plan Subscription by Department</p>
                  <?php
                  print_table("Insurance Plan ID",
                  "Plan Name",
                  "Number of Distince Departments",
                  "SELECT 
                  InsurancePlan.Insurance_Plan_ID, 
                  InsurancePlan.Plan_Name, 
                  COUNT(DISTINCT Employee.Department_ID) AS Departments_Subscribed
              FROM 
                  Employee
              JOIN 
                  Buys ON Employee.Staff_ID = Buys.Staff_ID
              JOIN 
                  InsurancePlan ON Buys.InsurancePlan_ID = InsurancePlan.Insurance_Plan_ID
              GROUP BY 
                  InsurancePlan.Insurance_Plan_ID, InsurancePlan.Plan_Name;",
                  "Insurance_Plan_ID",
                  "Plan_Name",
                  "Departments_Subscribed");
                  ?>



<p id="aggregateHeader"> Average Age of Employees in Each Department</p>
                  <?php
                  print_table("Department ID",
                  "Department Name",
                  "Average Age",
                  "SELECT 
                  Department.Department_ID, 
                  Department.Department_Name, 
                  ROUND(AVG(DATEDIFF(CURRENT_DATE, Employee.DoB)/365),2) AS Average_Age
              FROM 
                  Employee
              JOIN 
                  Department ON Employee.Department_ID = Department.Department_ID
              GROUP BY 
                  Department.Department_ID, Department.Department_Name;",
                  "Department_ID",
                  "Department_Name",
                  "Average_Age");
                  ?>
    <p id="aggregateHeader">  Insurance Enrollment Analysis Function</p>
  <table  width="800" border="0" align="center" cellpadding="5" cellspacing="5" class="Table"  id="aggregate">
  <tr>
      <td class="bold">  Plan Name    </td>
      <td class="bold">  Department Name   </td>
      <td class="bold">  Number Of Enrollees  </td>
      <td class="bold">  Avg Male   </td>
      <td class="bold">  Avg Female   </td>

   </tr>
  <?php 
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$query = mysqli_query($conn, "SELECT InsurancePlan.Plan_Name, Department.Department_Name AS DepartmentName, COUNT(*) AS NumberOfEnrollees,
                 AVG(CASE WHEN Employee.Gender = 'Male' THEN 1 ELSE 0 END) AS AvgMale,
                AVG(CASE WHEN Employee.Gender = 'Female' THEN 1 ELSE 0 END) AS AvgFemale
        FROM Employee
        JOIN Buys ON Employee.Staff_ID = Buys.Staff_ID
        JOIN InsurancePlan ON Buys.InsurancePlan_ID = InsurancePlan.Insurance_Plan_ID
        JOIN Department ON Employee.Department_ID = Department.Department_ID
        GROUP BY InsurancePlan.Plan_Name, Department.Department_Name; ");

		while ($row = mysqli_fetch_array($query)) {
?> 
   

   <tr>
        <td>  <?php echo $row["Plan_Name"];  ?> </td>
        <td>  <?php echo $row["DepartmentName"];  ?> </td>
        <td>  <?php echo $row["NumberOfEnrollees"];  ?> </td>
        <td>  <?php echo $row["AvgMale"];  ?> </td>
        <td>  <?php echo $row["AvgFemale"];  ?> </td>

   </tr>



<?php           }      ?> 
    </table>


    
   <p id="aggregateHeader"> Attention on Insurance Renewals</p>
</p>
  <table  width="800" border="0" align="center" cellpadding="5" cellspacing="5" class="Table"  id="aggregate">
  <tr>
      <td class="bold">  First Name    </td>
      <td class="bold">   Last Name   </td>
      <td class="bold">   Plan Name   </td>
      <td class="bold">   Expiry Date   </td>

   </tr>
  <?php 
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$query = mysqli_query($conn, "SELECT Employee.First_Name, Employee.Last_Name, InsurancePlan.Plan_Name, InsurancePlan.Expiry_Date_
        FROM Employee
        JOIN Buys ON Employee.Staff_ID = Buys.Staff_ID
        JOIN InsurancePlan ON Buys.InsurancePlan_ID = InsurancePlan.Insurance_Plan_ID
        WHERE InsurancePlan.Expiry_Date_ BETWEEN CURRENT_DATE AND DATE_ADD(CURRENT_DATE, INTERVAL 30 DAY);");

		while ($row = mysqli_fetch_array($query)) {
?> 
   

   <tr>
      <td>  <?php echo $row["First_Name"];  ?> </td>
      <td>  <?php echo $row["Last_Name"];  ?> </td>
      <td>  <?php echo $row["Plan_Name"];  ?> </td>
      <td>  <?php echo $row["Expiry_Date_"];  ?> </td>

   </tr>



<?php           }      ?> 
    </table>




<?php }?>

      </div>
  </div>
</div>
<?php  renderFooter();  ?>
</body>


<?php
