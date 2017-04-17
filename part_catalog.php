<!--Authors: Briana Arrington, Dyla Gunn, Ningxin Shi
    Date: 4/16/17
    Class: 710 Spec & Design -->



<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="FacultyStyle.css">
<style>
    
body {//background-color:lightgrey;}
h1   {color:blue;
      text-align:center;}
p    {color:green;}  
    
 
    
        
ul {
	list-style-type: none;
	margin: 0;
	overflow: hidden;
	background-color: #373EC1;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

/* Change the link color to #111 (black) on hover */
li a:hover {
    background-color: #B8B7B7;
}       
    </style>

<body>

<center><img src="aaf.png" alt="AA&F logo" style="width:304px;height:228px;"></center>
<h1 style="color:#D10000;"><center>Part Catalog</center></h1>

        
    <ul>
        <li><a href="homepage.php">Homepage</a></li>
        <li><a href="mission_statement.php">Mission Statement</a></li>
        <li><a href="lookup_contract.php">Look Up A Contract</a></li>
         <li><a href="part_catalog.php">Part Catalog</a></li>
        <li><a href="request_meeting.php">Request Meeting</a></li>
        
    
    
    
 </head>       </ul>
</body>
</head>


<?php

// Start the session, this needs to be on every page
session_start();

$FirstName ='';
$Lastname = '';
$Sport = '';
if(isset($_POST["FirstName"])){
$FirstName = $_POST["FirstName"];}
if(isset($_POST["Lastname"])){
$Lastname = $_POST["Lastname"];}

//?





if(isset($_GET["FirstName"])){
$FirstName = $_GET["FirstName"];}
if(isset($_GET["Lastname"])){
$Lastname = $_GET["Lastname"];}

//?
if(isset($_GET["Sport"])){
$Sport = $_GET["Sport"];}




//input of the users first and last name to retrieve the students information from the database		
echo '<form action="Retrieve.php" method = "post"><center><legend><b>Search Part Catalog:</b></legend></center><br>
					<center>First Name:<input type="text" name="FirstName" value="' . $FirstName . '"></center>
					<center>Last Name:<input type="text" name="Lastname" value="' . $Lastname . '"></center><br> <center>Or By </center><br><br> 	<center>State:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="State" value="' . $Sport . '"></center><br>
					<center><input type="submit"></center></form>';
					



					
$servername = "localhost";
$username = "root";
$password = "root";

$dbname = "Login_Database";

$timestamp = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if($FirstName != '' && $Lastname != ''){
$studentUsername = $FirstName[0] . $Lastname[0] . $Lastname[1] . $Lastname[2];
$sql = "SELECT * FROM Login WHERE Username = '$studentUsername'";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$timestamp = $row["datetime"];
	}
}
}

$dbname = "Student_Database";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//

$sql = "SELECT * FROM Student WHERE FirstName = '$FirstName' AND Lastname = '$Lastname'" ;
$result = $conn->query($sql);

//sport
if(isset($_POST["Sport"]) && !empty($_POST["Sport"])){
$Sport = $_POST["Sport"];
$sql = "SELECT * FROM Student WHERE Sport = '$Sport'" ;
$result = $conn->query($sql);
}


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo '<form action="Faculty_update_action_page.php" method="post" />
		<center><legend>Student Last Login: '.$timestamp.'</legend></center>
        <center><legend>To update a students profile enter their information here:</legend></center>
        <center>First Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="FirstName" value = "'.$row["FirstName"].'"></center>
		<center><input type="text" name="oldFirstName" value = "'.$row["FirstName"].'" hidden></center>
        <center>Lastname:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="Lastname" value = "'.$row["Lastname"].'"></center>
        <center>Banner ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="BannerID" value = "'.$row["BannerID"].'"></center>
        <center>Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="Address" value = "'.$row["Address"].'"></center>
        <center>Phone Number:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="PhoneNumber" value = "'.$row["PhoneNumber"].'"></center>
        <center>GPA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="GPA" value = "'.$row["GPA"].'"></center>
        <center>Total Credits:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="TotalCredits" value = "'.$row["TotalCredits"].'"></center>
		<center>Sport:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="Sport" value = "'.$row["Sport"].'"></center>
        <center>Account Balance:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="AccountBalance" value = "'.$row["AccountBalance"].'"></center>
		<center>Emergency Contact:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="EmergencyContact" value = "'.$row["EmergencyContact"].'"></center>
		<center>Emergency Contact Number:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="EmergencyContactNumber" value = "'.$row["EmergencyContactNumber"].'"></center><br>
	
		<!-- Submit Button -->
        <center><input type="Submit" value="Submit"></center>
		</form>';
		
		
	}
}else {
    //echo "0 results";
}
$conn->close();

//echo $_SESSION["datetime"]; 

?>
