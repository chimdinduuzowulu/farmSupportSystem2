<?php
include "connect.php";

if (!$conn) {
  // die();
}
$ql1 = "CREATE TABLE IF NOT EXISTS farmersTb (
Farmer_Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
uploadCount int(255) DEFAULT 0 NOT NULL,
FName VARCHAR (30) NOT NULL,
LName VARCHAR (30) NOT NULL,
Email VARCHAR (30) NOT NULL UNIQUE,
phone VARCHAR (30) NOT NULL,
`profileImage` varchar(255) COLLATE utf8_unicode_ci,
passW VARCHAR (30) NOT NULL,
confirmPassW VARCHAR (30) NOT NULL,
TotalDeleted int(255) DEFAULT 0 NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
// ....clients table
$ql2 = "CREATE TABLE IF NOT EXISTS clientsTb (
Client_Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
FName VARCHAR (30) NOT NULL,
LName VARCHAR (30) NOT NULL,
Email VARCHAR (30) NOT NULL UNIQUE,
phone VARCHAR (30) NOT NULL,
passW VARCHAR (30) NOT NULL,
confirmPassW VARCHAR (30) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
// all system users state
$ql3 = "CREATE TABLE IF NOT EXISTS Ustate (
State_Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
stateName VARCHAR (30) NOT NULL,
Farmer_Id INT(6) UNSIGNED NOT NULL,
FOREIGN KEY (Farmer_Id) REFERENCES farmersTb(Farmer_Id)
)";
// all system users localgovt
$ql4 = "CREATE TABLE IF NOT EXISTS localGovt (
LocalGov_Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
localGovtName VARCHAR (30) NOT NULL,
State_Id INT(6) UNSIGNED NOT NULL,
FOREIGN KEY (State_Id) REFERENCES Ustate(State_Id)

)";
// all system users town
$ql5 = "CREATE TABLE IF NOT EXISTS town (
Town_Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
townName VARCHAR (30) NOT NULL,
LocalGov_Id INT(6) UNSIGNED NOT NULL,
FOREIGN KEY (LocalGov_Id) REFERENCES localGovt(LocalGov_Id)
)";
$ql6="CREATE TABLE IF NOT EXISTS `productTable` (
 `Product_Id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 searchValue INT(255) UNSIGNED DEFAULT 0,
  viewValue INT(255) UNSIGNED DEFAULT 0,
--  `Email` varchar(30) NOT NULL,
 `productTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `productDescription` varchar(355) COLLATE utf8_unicode_ci NOT NULL,
 `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `imageNumCount` int(11) NOT NULL,
 `Farmer_Id` INT(6) UNSIGNED NOT NULL,
 `uploaded_on` datetime NOT NULL,
 `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
FOREIGN KEY (Farmer_Id) REFERENCES farmersTb(Farmer_Id)
)";

$ql7 = "CREATE TABLE IF NOT EXISTS AdminTable(
Admin_Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
MessageNotice  INT(6)  UNSIGNED DEFAULT 0, 
`profileImage` varchar(255) COLLATE utf8_unicode_ci,
AdminUserName VARCHAR (30) DEFAULT 'AdminName',
AdminPassword VARCHAR (30) DEFAULT 'Admin123'
)";
// checking if the admin table and values already exit

if(mysqli_query($conn, $ql1)===TRUE && mysqli_query($conn, $ql2)===TRUE && mysqli_query($conn, $ql3)===TRUE && mysqli_query($conn, $ql4)===TRUE && mysqli_query($conn, $ql5)===TRUE && mysqli_query($conn, $ql6)===TRUE && mysqli_query($conn, $ql7)===TRUE ){
    $qry=$conn->query("SELECT * FROM AdminTable WHERE Admin_Id=1");
if($qry->num_rows > 0){
 echo "";
}
else{
$qry2 = $conn->query("INSERT INTO AdminTable (AdminUserName,AdminPassword) VALUES('AdminName','Admin123')");
          if($qry2->num_rows > 0 ){echo "";}
}
// testing if the admin values already exist..
       }

else{
echo  " ".mysqli_error($conn);
} 

$serverName = "localhost";
$userName = "root";
$password = "";
$database="FarmSupportSystem";
$conn=mysqli_connect($serverName, $userName, $password,$database);


