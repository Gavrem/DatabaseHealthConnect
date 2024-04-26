<?php
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
SELECT
    e.Staff_ID,
    e.First_Name,
    e.Last_Name,
    e.DoB,
    e.Gender,
    e.Position,
    d.Department_Name,
    d.Department_Head,
    ip.Plan_Name,
    ip.Coverage_Details,
    ip.Premium_Amount
FROM
    Employee e
LEFT JOIN
    Department d ON e.Department_ID = d.Department_ID
LEFT JOIN
	InsurancePlan ip ON e.InsurancePlan_ID = ip.Insurance_Plan_ID;


// SELECT
//     ip.Insurance_Plan_ID,
//     ic.Ins_Company_Name,
//     p.Provider_ID,
//     p.Provider_Name 
// FROM
//     Designs d
// JOIN
// 	InsurancePlan ip ON d.InsurancePlan_ID = ip.Insurance_Plan_ID
// JOIN
//     InsuranceCompany ic ON d.Ins_Company_Name = ic.Ins_Company_Name  
// JOIN
//     Accepts a ON ip.Insurance_Plan_ID = a.InsurancePlan_ID
// JOIN
//     Providers p ON a.Provider_ID = p.Provider_ID;



// insert into Department (Department_Name, Department_Head)
// values
// ('Human Resource', 'John Smith'),('Marketing', 'Emily Johnson'), 
// ('IT', 'Michael Brown'),('Finance', 'Sarah Wilson'), ('Operations', 'David Roberts'), ('Economics', 'Samuel Smart'),('Computer Science', 'Timothy Weah'),( 'Geography', 'Agnus Gun'),('Sociology', 'Andrew Barnes'), ('Music', 'Aliyah Essien');

// INSERT INTO Employee (Staff_ID, First_Name,Last_Name,DoB,Gender,Position, InsurancePlan_ID,Department_ID)
// values
// (2020, 'Bob', 'Johnson', '1985-10-20', 'Male', 'Marketing Manager', 2, 2),
// (3035, 'Sarah', 'Brown', '1995-02-28', 'Female', 'IT Specialist', 1, 3),
// (4042, 'Jack', 'Wilson', '1988-12-10', 'Male', 'Financial Analyst', 2, 4), 
// (5051, 'Emily', 'Roberts', '1987-09-18', 'Female', 'Operations Coordinator', 1, 5),
// (9102, 'Jack', 'Vaughn', '1984-07-20', 'Male', 'Associate Professor', 4, 9),
// (1110, 'Mark', 'Wilson', '1985-03-15', 'Male', 'Manager', 1, 1),
// (2110, 'Emily', 'Cooper', '1990-06-20', 'Female', 'Sales Associate', 2, 5),
// (3310, 'Sam', 'Thompson', '1988-11-10', 'Male', 'HR Specialist', 3, 3),
// (1510, 'Alex', 'King', '1992-02-18', 'Male', 'Accountant', 5, 1);

// (1011, 'Alice', 'Smith', '1990-05-15', 'Female', 'Senior Manager', 1, 1);

// INSERT INTO InsuranceCompany (Ins_Company_Name,Contact_Email,Contact_Phone)
// values
// ('United Health Group', 'contact@uhc.com', '1-800-328-5979'),
// ('Kaiser Permanente', 'iinfo@kp.org', '1-800-464-4000'),
// ('Humana', 'customerrelations@humana.com', '456-789-0123'),
// ('StateFarm', 'info@statefarm.com', '866-855-1212'),
// ('Allstate', 'info@allstate.com', '555-5678'),
// ('Cigna', 'customercare@cigna.com', '1-800-997-1654'),
// ('GEICO', 'info@geico.com', '1-800-861-8380'),
// ('Progressive', 'info@progressive.com', '1-888-671-4405'),
// ('Health Care Service Corporation', 'customercare@hcsc.com', '1-800-654-7385'), 
// ('Aetna', 'memberservices@aetna.com', '1-800-872-3862');


// ALTER TABLE Accepts MODIFY Provider_Name VARCHAR(50) NOT NULL,


// Offers(Department ID,  Insurance Plan ID)
//  INSERT INTO Offers (Department_ID,InsurancePlan_ID) values
// (1, 8),
// (2, 3) ,
// (3, 6) ,
// (4, 5) ,
// (5, 2),
// (6, 9),
// (7, 10), 
// (8, 7) ,
// (9, 4) ,
// (10, 1);


// $sql = "CREATE TABLE Offers (
// 	Department_ID INT(6) UNSIGNED,
// 	InsurancePlan_ID INT(6) NOT NULL);
	// " 

//  INSERT INTO Contracts (Department_ID,Ins_Company_Name) values
// (1,'Allstate') ,
// (2, 'Cigna') ,
// (3, 'Aetna'),
// (4, 'Cigna') ,
// (5, 'United Health Group'),
// (6, 'GEICO'),
// (7, 'Cigna') ,
// (8,' Kaiser Permanente') ,
// (9, 'Aetna') ,
// (10,'Progressive');

// $sql = "CREATE TABLE Contracts (
// 	Department_ID INT(6) UNSIGNED,
// 	Ins_Company_Name VARCHAR(40) NOT NULL);

// 	" 

// INSERT INTO Claims (Ins_Company_Name,Provider_ID) values
// ('United Health Group', 3) ,
// ('Cigna', 2) ,
// ('Kaiser Permanente', 6) ,
// ('Cigna', 4) ,
// ('GEICO', 3),
// ('Allstate',9),
// ('Cigna', 1) ,
// ('Aetna', 3) ,
// ('Aetna', 7) ,
// ('Progressive', 7);

// $sql = "CREATE TABLE Claims (
// 	Ins_Company_Name VARCHAR(40) NOT NULL,
// 	Provider_ID  INT(6) UNSIGNED);
// 	 )"; 



// INSERT INTO Accepts (InsurancePlan_ID,Provider_ID) values
// (1, 8) ,
// (6, 2) ,
// (5, 6) ,
// (2, 5) ,
// (1, 5),
// (9, 9),
// (10, 1) ,
// (2, 5) ,
// (3, 3) ,
// (10, 1);


// Accepts(Insurance Plan ID,  Provider ID   )
// $sql = "CREATE TABLE Accepts (
// 	InsurancePlan_ID INT(6) NOT NULL,
// 	Provider_ID  INT(6) UNSIGNED);
// 	 )"; 


//  INSERT INTO Designs (InsurancePlan_ID,Ins_Company_Name) values
// (5, 'United Health Group'),
// (2, 'Cigna') ,
// (5, 'Kaiser Permanente') ,
// (4, 'Cigna') ,
// (1, 'GEICO'),
// (9, 'GEICO'),
// (1, 'Cigna') ,
// (10, 'Aetna') ,
// (3, 'Aetna') ,
// (5, 'Progressive');


// $sql = "CREATE TABLE Designs (
// 	InsurancePlan_ID INT(6) NOT NULL,
// 	Ins_Company_Name VARCHAR(40) NOT NULL);
// 	 )"; 

//  INSERT INTO Buys (Staff_ID,InsurancePlan_ID) values
//  (1011, 8) ,
//  (2020, 2) ,
//  (3035, 6) ,
//  (4042, 5) ,
//  (5051, 5),
//  (9102, 9),
//  (1110, 1) ,
//  (2110, 5) ,
//  (3310, 3) ,
//  (1510, 1);
 

// $sql = "CREATE TABLE Buys (
//  	Staff_ID INT(6) UNSIGNED,
// 	InsurancePlan_ID INT(6) NOT NULL);
// 	 )"; 

// INSERT INTO Customer (Staff_ID,Ins_Company_Name) values
// (1011, 'United Health Group') ,
// (2020, 'Cigna') ,
// (3035,'Kaiser Permanente') ,
// (4042, 'Cigna') ,
// (5051, 'GEICO'),
// (9102, 'GEICO'),
// (1110, 'Cigna') ,
// (2110, 'Aetna') ,
// (3310, 'Aetna') ,
// (1510, 'Progressive');


// $sql = "CREATE TABLE Customer (
//  	Staff_ID INT(6) UNSIGNED,
// 	Ins_Company_Name VARCHAR(40) NOT NULL);
// 	 )"; 

// INSERT INTO Employs (Staff_ID,Department_ID) values
// (1011, 1),
// (2020, 2),
// (3035, 3),
// (4042, 4), 
// (5051, 5),
// (9102, 9),
// (1110, 1),
// (2110, 5),
// (3310, 3),
// (1510, 1);


// $sql = "CREATE TABLE Employs (
//  	Staff_ID INT(6) UNSIGNED,
//  	Department_ID INT(6) UNSIGNED);
// 	 )"; 

// INSERT INTO Providers_Address (Address_ID,Street,City,State,Zipcode) values
// (1,'1364 Clifton Rd NE', 'Atlanta', 'GA', 30322),
// (2, '1186 Concord Rd SE', 'Smyrna', 'GA', 30080),
// (3, '2000 South Park Pl SE', 'Atlanta', 'GA', 30339),
// (4, '1000 Johnson Ferry Rd NE', 'Atlanta', 'GA', 30342),
// (5, '1120 15th St', 'Augusta', 'GA', 30912),
// (6, '80 Jesse Hill Jr Dr SE', 'Atlanta', 'GA', 30303),
// (7, '1405 Clifton Rd NE', 'Atlanta', 'GA', 30322),
// (8, '777 Hemlock St', 'Macon', 'GA', 31201),
// (9,'743 Spring St NE', 'Gainesville', 'GA', 30501),
// (10, '2501 N Patterson St','Valdosta', 'GA', 31602);


// $sql = "CREATE TABLE Providers_Address (
// 	Address_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	Street VARCHAR(100) NOT NULL ,
// 	City VARCHAR(50) NOT NULL ,
// 	State VARCHAR(20) NOT NULL ,
// 	Zipcode INT(6)UNSIGNED );
// 	 )"; 

// INSERT INTO Providers (Provider_ID,Provider_Type,Provider_Name,Address_ID,Phone_Number,Email,InsurancePlan_ID) values
// (1, 'Hospital', 'Emory Healthcare', 1, '404-778-7777', 'info@emoryhealthcare.org', 5),
// (2, 'Urgent care', 'Piedmont Healthcare', 2, '404-352-2020', 'info@piedmont.org', 1),
// (3, 'Clinic', 'Wellstar Health System', 3,'770-956-3355' ,'contactus@wellstar.org', 3),
// (4, 'Hospital', 'Northside Hospital', 4, '404-851-8000', 'info@northside.com', 5),
// (5, 'Clinic', 'Augusta University Health', 5,'706-721-0211', 'info@augusta.edu', 8),
// (6, 'Hospital', 'Grady Health System', 6, '404-616-1000', 'info@gradyhealth.org', 4),
// (7, 'Hospital', "Children's Healthcare of Atlanta", 7, '404-785-6000', 'info@choa.org', 9),
// (8, 'Clinic', 'Navicent Health', 8, '478-633-1000' ,'info@navicenthealth.org', 3),
// (9, 'Hospital', 'Northeast Georgia Health System', 9, '770-219-9000', 'info@nghs.com', 5),
// (10, 'Hospital', 'South Georgia Medical Center', 10,'229-333-1000', 'info@sgmc.org', 3);

// $sql = "CREATE TABLE Providers (
// 	Provider_ID  INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	Provider_Type VARCHAR(100) NOT NULL,
// 	Provider_Name VARCHAR(30) NOT NULL,
// 	Address_ID TEXT NOT NULL,
// 	Phone_Number VARCHAR(15) NOT NULL, 
// 	Email VARCHAR(40) NOT NULL,
// 	InsurancePlan_ID INT(6) NOT NULL
// 	 )"; 

// INSERT INTO InsurancePlan (Insurance_Plan_ID,Plan_Name,Coverage_Details,Premium_Amount,Effective_Date,Expiry_Date_)
// values
// (1, 'Health Maintenance Or'GA'nization', 'Family plan', '$100', '2024-01-01', '2025-01-01'),
// (2, 'Preferred Provider Or'GA'nization', 'Individual plan', '$200', '2024-03-01', '2025-03-01'),
// (3, 'Point of Service', 'Disability plan', '$300', '2023-11-01', '2024-11-01'),
// (4, 'Exclusive Provider Or'GA'nization', 'Family Plan', '$120', '2023-07-20', '2024-07-19'),
// (5, 'High Deductible Health Plan', 'Dental Plan', '$105', '2023-12-28', '2024-12-27'),
// (6, 'Catastrophic Health Insurance', 'Individual Plan', '$150', '2023-06-03', '2024-06-02'),
// (7, 'Medicaid', 'Family Plan', '$55', '2023-08-22', '2024-08-21'),
// (8, 'Medicare', 'Individual Plan', '$45', '2024-02-17', '2025-02-16'),
// (9, 'Short-Term Health Insurance','Individual Plan', '$100', '2023-09-15', '2024-09-14'),
// (10, 'Employer-Sponsored','Family plan', '$100', '2024-01-20', '2025-01-19');

// $sql = "CREATE TABLE InsurancePlan (
// 	Insurance_Plan_ID  INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	Plan_Name VARCHAR(100) NOT NULL,
// 	Coverage_Details VARCHAR(30) NOT NULL,
// 	Premium_Amount VARCHAR(10) NOT NULL,
// 	Effective_Date Date, 
// 	Expiry_Date_ Date
// 	 )"; 

// $sql = "CREATE TABLE InsuranceCompany (
// 	Ins_Company_Name VARCHAR(40) NOT NULL,
// 	Contact_Email VARCHAR(30) NOT NULL,
// 	Contact_Phone VARCHAR(11) NOT NULL
// 	 )"; 
// $sql = "CREATE TABLE Employee (
// 	Staff_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	First_Name VARCHAR(20) NOT NULL,
// 	Last_Name VARCHAR(20) NOT NULL,
// 	DoB Date,
// 	Gender VARCHAR(10) NOT NULL,
// 	Position VARCHAR(20) NOT NULL,
// 	InsurancePlan_ID INT(6),
// 	Department_ID INT(6)
// 	 )"; 

// $sql = "CREATE TABLE Department (
// 	Department_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	Department_Name VARCHAR(40) NOT NULL,
// 	Department_Head VARCHAR(20) NOT NULL
// 	 )"; 

// $sql = "CREATE TABLE Department (
// 	Department_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	Department_Name VARCHAR(40) NOT NULL,
// 	Department_Head VARCHAR(20) NOT NULL
// 	 )"; 
//$sql = "CREATE TABLE albums (artist VARCHAR(20), name VARCHAR(50),
 //genre VARCHAR(20), rdate INT(4))";

//  $sql = "CREATE TABLE DislikedGenres (
// 	DislikedGenres_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	User_id INT(6) NOT NULL,
// 	Genre_id INT(6) NOT NULL
// 		 )"; 

//  $sql = "CREATE TABLE DislikedActors (
// 	DislikedActors_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	User_id INT(6) NOT NULL,
// 	Actor_id INT(6) NOT NULL
// 		 )"; 

//  $sql = "CREATE TABLE WatchA'GA'inList (
// 	WatchA'GA'in_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	User_id INT(6) NOT NULL,
// 	Movie_id INT(6) NOT NULL
// 		 )"; 

  
//  $sql = "CREATE TABLE MovieActor (
// 	MA_link INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	Movie_id INT(6) NOT NULL,
// 	Actor_id INT(6) NOT NULL
// 		 )"; 


//  $sql = "CREATE TABLE ACTORS (
// 	Actor_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	Actor_name VARCHAR(25) NOT NULL,
// 	Actor_image VARCHAR(20) NOT NULL
// 		 )"; 

 
//  $sql = "CREATE TABLE MovieGenre (
// 	MG_link INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	Movie_id INT(6) NOT NULL,
// 	Genre_id INT(6) NOT NULL
// 		 )"; 


//   $sql = "INSERT INTO  GENRES (	Genre_name ) VALUES ('Drama'),('Thriller'),('Comedy'),('Fantasy'),('Romance'),('Science'),('Adventure'),('Sports'),('Action'), ('Western'),('Horror'),('Musical'),('Mystery');"; 


//  $sql = "CREATE TABLE GENRES (
// 	Genre_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	Genre_name VARCHAR(20) NOT NULL
// 		 )"; 

//  $sql = "CREATE TABLE MOVIES (
// 	 Movie_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	 Movie_poster VARCHAR(20) NOT NULL,
// 	 Movie_name VARCHAR(40) NOT NULL,
// 	 Movie_year YEAR NOT NULL,
// 	 Movie_summary TEXT
// 	 	 )"; 

// $sql = "CREATE TABLE Login (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//  User_first_name VARCHAR(20) NOT NULL,
//  User_last_name VARCHAR(20) NOT NULL,
//  User_name VARCHAR(20) NOT NULL,
//  Account_type VARCHAR(20) NOT NULL,
//  User_email  VARCHAR(40) NOT NULL,
//  User_phone_number  INT(11) NOT NULL,
//  User_password  VARCHAR(255) NOT NULL
//  )"; 

// $sql = "CREATE TABLE LOGINS (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// user_name VARCHAR(20) NOT NULL,
// email  VARCHAR(40) NOT NULL,
// password  VARCHAR(255) NOT NULL,
// buyer BOOLEAN,
// seller BOOLEAN,
// admin BOOLEAN
// )"; 
// ALTER TABLE Employee MODIFY Position VARCHAR(30) NOT NULL;

// ALTER TABLE InsuranceCompany MODIFY Contact_Phone VARCHAR(15) NOT NULL;

/* 	$sql = "ALTER TABLE Employee
		MODIFY Position VARCHAR(30) NOT NULL";   */

//$sql = "UPDATE LOGINS
	//		SET liked = 15 ";
			
// $sql = "DELETE FROM LOGINS; "; 

//$sql = "drop tables PROPERTIES;";
/*  
  $sql = "CREATE TABLE PROPERTIES (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id INT(6),
img VARCHAR(20) NOT NULL,
floor VARCHAR(20) NOT NULL,
floor_sqt VARCHAR(20) NOT NULL,
price VARCHAR(30) NOT NULL,
location VARCHAR(100) NOT NULL,
age INT(3) NOT NULL,
bedrooms INT(3) NOT NULL,
facilities  VARCHAR(20) NOT NULL,
'GA'rden  VARCHAR(20) NOT NULL,
parking  VARCHAR(20) NOT NULL,
nearby_facilities  VARCHAR(100) NOT NULL,
main_roads  VARCHAR(100) NOT NULL,
tax  VARCHAR(20) NOT NULL
)";  */
	
if ($conn->query($sql) === TRUE) {
	echo "Table USERS created succesfully";
}else{
	echo "Error creating tables:" . $conn->error;

}
$conn->close();

?>

