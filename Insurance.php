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

if (isset($_POST["Clear"]) && $_POST["Clear"] == "Clear"){
  $_POST = array();
}
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Insurance</title>
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
    <?php if ($_SESSION["Type"] == "admin" || $_SESSION["Type"] == "Staff"){ ?>
  <h1 class="PageTitle"> Search Insurance  </h1>


  <div id="Search">
        <form action="" method="post" id="SearchInsurance">
                <select name="Search_Val" required>
                                  <option value="">Select Category</option>
                                  <!-- Generate numbers from 1 to 10 for selection -->
                                  <option value="InsuranceCompany" <?php if (isset($_POST['Search_Val']) && $_POST['Search_Val'] =="InsuranceCompany"  ){ print ("selected");}?> > Company Name</option>
                                  <option value="Contact_Email"  <?php if (isset($_POST['Search_Val']) && $_POST['Search_Val'] =="Contact_Email"  ){ print ("selected");}?>  >Contact Email	</option>
                                  <option value="Contact_Phone"  <?php if (isset($_POST['Search_Val']) && $_POST['Search_Val'] =="Contact_Phone"  ){ print ("selected");}?> >Contact Phone	</option>
                                  <option value="Plan_Name" <?php if (isset($_POST['Search_Val']) && $_POST['Search_Val'] =="Plan_Name"  ){ print ("selected");}?>  >Plan Name	</option>
                                  <option value="Coverage_Details" <?php if (isset($_POST['Search_Val']) && $_POST['Search_Val'] =="Coverage_Details"  ){ print ("selected");}?> >Coverage Details	</option>
                                  <option value="Premium_Amount" <?php if (isset($_POST['Search_Val']) && $_POST['Search_Val'] =="Premium_Amount"  ){ print ("selected");}?> >Premium Amount</option>
                                  <option value="Effective_Date" <?php if (isset($_POST['Search_Val']) && $_POST['Search_Val'] =="Effective_Date"  ){ print ("selected");}?> >Effective Date </option>
                                  <option value="Expiry_Date"  <?php if (isset($_POST['Search_Val']) && $_POST['Search_Val'] =="Expiry_Date"  ){ print ("selected");}?>>Expiry Date</option>
                              </select>
                <input type="text" id="Search_Text" name="Search_Text" value="<?php if (isset($_POST['Search_Text']) ){ print $_POST["Search_Text"];}?>">
                <select name="Sort" id="Sort" required>
                                  <option value="">Sort</option>
                                  <!-- Generate numbers from 1 to 10 for selection -->
                                  <option value="DESC" <?php if (isset($_POST['Sort']) && $_POST['Sort'] =="DESC"  ){ print ("selected");}?> selected > Descending</option>
                                  <option value="ASC"  <?php if (isset($_POST['Sort']) && $_POST['Sort'] =="ASC"  ){ print ("selected");}?>  > Ascending	</option>
                              </select>

        <button type="submit" class="button" name="Search" Value="Search">Search</button>
        <button type="submit" class="button Clear"  name="Clear" Value="Clear">Clear</button>

        </div>
<?php  if (isset($_POST["Search_Text"]) ){
          $Search_Text =  $_POST["Search_Text"];
          $Search_Val =  $_POST["Search_Val"];
          $Sort = $_POST["Sort"];
          $cond = "";
  ?>


  <table  width="10000" border="0" align="center" cellpadding="5" cellspacing="5" class="Table" id="SearchTable">
      <tr>
          <td class="bold" >Company Name</td>
          <td  class="bold" >Contact Email</td>
          <td class="bold" >Contact Phone</td>
          <td class="bold" >Insurance Plan ID</td>
          <td  class="bold" >Plan Name</td>
          <td class="bold" >Coverage Details</td>
          <td class="bold" >Premium Amount($)</td>
          <td class="bold" >Effective Date</td>
          <td class="bold" >Expiry Date</td>
       </tr>


<?php 
$conn = mysqli_connect($servername, $username, $password, $dbname);
  $sql =  "SELECT
  ic.Ins_Company_Name,
  ic.Contact_Email,
  ic.Contact_Phone,
  ip.Insurance_Plan_ID,
  ip.Plan_Name,
  ip.Coverage_Details,
  ip.Premium_Amount,
  ip.Effective_Date,
  ip.Expiry_Date_
FROM InsurancePlan ip
JOIN Designs d ON ip.Insurance_Plan_ID = d.InsurancePlan_ID
JOIN InsuranceCompany ic ON d.Ins_Company_Name = ic.Ins_Company_Name";


if ($Search_Val == "Plan_Name" ){
$cond = " WHERE ip.Plan_Name like '%$Search_Text%' ORDER BY ip.Plan_Name  $Sort  ";
}elseif ($Search_Val == "InsuranceCompany" ){
$cond = " WHERE   ic.Ins_Company_Name like '%$Search_Text%'  ORDER BY ic.Ins_Company_Name   $Sort  ";
}elseif( $Search_Val == "Contact_Email"){
  $cond = " WHERE    ic.Contact_Email  like '%$Search_Text%'  ORDER BY  ic.Contact_Email   $Sort  ";
}elseif( $Search_Val == "Contact_Phone"){
  $cond = " WHERE    ic.Contact_Phone  like '%$Search_Text%' ORDER BY  ic.Contact_Phone   $Sort  ";
}elseif( $Search_Val == "Coverage_Details"){
  $cond = " WHERE    ip.Coverage_Details  like '%$Search_Text%' ORDER BY   ip.Coverage_Details    $Sort  ";
}elseif( $Search_Val == "Premium_Amount"){
  $cond = " WHERE    ip.Premium_Amount  < $Search_Text ORDER BY  ip.Premium_Amount   $Sort  ";
}elseif( $Search_Val == "Effective_Date"){
  $cond = " WHERE    ip.Effective_Date  < '$Search_Text' ORDER BY   ip.Effective_Date   $Sort  ";
}elseif( $Search_Val == "Expiry_Date"){
  $cond = " WHERE    ip.Expiry_Date_  < '$Search_Text' ORDER BY   ip.Expiry_Date_   $Sort  ";
}


  $query = mysqli_query($conn,  $sql ." ". $cond);

  while ($row = mysqli_fetch_array($query)) {
  ?>    
  <tr >
        <td class="bold" >   <?php echo $row['Ins_Company_Name']; ?> </a> </td>
        <td>  <?php echo $row['Contact_Email']; ?> </td>
        <td>  <?php echo $row['Contact_Phone']; ?> </td>
        <td>   <?php echo $row['Insurance_Plan_ID']; ?> </a> </td>
        <td>  <?php echo $row['Plan_Name']; ?> </td>
        <td>  <?php echo $row['Coverage_Details']; ?> </td>
        <td>  <?php echo $row['Premium_Amount']; ?> </td>
        <td>  <?php echo $row['Effective_Date']; ?> </td>
        <td>  <?php echo $row['Expiry_Date_'];?> </td>

</tr>  

<?php }?>

</table>

<?php   
 } if (!isset($_POST["Search_Text"]) or $_POST["Search_Text"]=="" ){



?>

  <h2 class="PageTitle"> Insurance Companys </h2>

<table  width="500" border="0" align="center" cellpadding="5" cellspacing="5" class="Table" id="InsCompanyTable">
  <tr>
    <td class="bold" >Company_Name</td>
    <td  class="bold" >Contact Email</td>
    <td class="bold" >Contact Phone</td>
</tr>  
<?php 
$conn = mysqli_connect($servername, $username, $password, $dbname);
  
  $query = mysqli_query($conn, "SELECT * FROM InsuranceCompany ");

  while ($row = mysqli_fetch_array($query)) {
  ?>    


  <tr >
      <td class="bold" >   <?php echo $row['Ins_Company_Name']; ?> </a> </td>
      <td>  <?php echo $row['Contact_Email']; ?> </td>
      <td>  <?php echo $row['Contact_Phone'];} ?> </td>

    </tr>  

</table>
  <!-- /// -->



  <h2 class="PageTitle"> Insurance Plans </h2>

  <table  width="1000" border="0" align="center" cellpadding="5" cellspacing="5" class="Table" id="InsuranceTable">
    <tr>
      <td class="bold" >Insurance Plan ID</td>
      <td  class="bold" >Plan Name</td>
      <td class="bold" >Coverage Details</td>
      <td class="bold" >Premium Amount($)</td>
      <td class="bold" >Effective Date</td>
      <td class="bold" >Expiry Date</td>
  </tr>  
  <?php 
	$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$query = mysqli_query($conn, "SELECT * FROM InsurancePlan ");

		while ($row = mysqli_fetch_array($query)) {
    ?>    


    <tr >
        <td>   <?php echo $row['Insurance_Plan_ID']; ?> </a> </td>
        <td>  <?php echo $row['Plan_Name']; ?> </td>
        <td>  <?php echo $row['Coverage_Details']; ?> </td>
        <td>  <?php echo $row['Premium_Amount']; ?> </td>
        <td>  <?php echo $row['Effective_Date']; ?> </td>
        <td>  <?php echo $row['Expiry_Date_'];}?> </td>

      </tr>  

  </table>
<?php  }}?>
  </div>
</div>
</body>

