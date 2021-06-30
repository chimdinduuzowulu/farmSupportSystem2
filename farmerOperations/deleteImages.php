<?php
include "../connect.php";
session_start();
$uploadCoutDecrement=$DeletedItemsCount=0;
$ProductDesc=isset($_GET['Decs']) ? strval($_GET['Decs']) : null;
$Title=isset($_GET['Title']) ? strval($_GET['Title']) : null;
$imageName=isset($_GET['imageName']) ? strval($_GET['imageName']) : null;
$farmerId=isset($_GET['farmerId']) ? intval($_GET['farmerId']) : null;
if(!empty($ProductDesc) && !empty($Title) && !empty($farmerId) && !empty($imageName)){
if(!$conn){die("connection Error").mysqli_erro();}


else {
$sql=$conn->query("DELETE FROM `productTable` WHERE 
Farmer_Id='$farmerId' AND productTitle='$Title'  AND productDescription='$ProductDesc' AND image_name='$imageName'
");

if($sql){
header("location: ../dashboard.php");
}



}

}


else{
echo "<script>alert('could not delete image');</script>";
header("location: ../dashboard.php");
}
?>