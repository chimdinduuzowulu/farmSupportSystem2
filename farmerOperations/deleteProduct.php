<?php
include "../connect.php";
$uploadCoutDecrement=$DeletedItemsCount=0;
$ProductDesc=isset($_GET['Decs']) ? strval($_GET['Decs']) : null;
$Title=isset($_GET['Title']) ? strval($_GET['Title']) : null;
$farmerId=isset($_GET['farmerId']) ? intval($_GET['farmerId']) : null;
if(!empty($ProductDesc && $Title && $farmerId)){
if(!$conn){die("connection Error").mysqli_erro();}


else {
$sql="DELETE FROM `productTable` WHERE 
Farmer_Id='$farmerId' AND productTitle='$Title'  AND productDescription='$ProductDesc'
";
$result=mysqli_query($conn,$sql);
// if true that the product has been deleted...
if($result==TRUE){
// then get the value of the upload count and decrement it by one
$query="SELECT MAX(uploadCount) AS coundDecrease FROM farmersTb
WHERE Farmer_Id='$farmerId'";
$queryResult=mysqli_query($conn,$query);
// if true that it got the value of the upload count then decrement the value
if($queryResult==TRUE){
while ($rowResult=$queryResult->fetch_assoc()){
$uploadCoutDecrement=$rowResult["coundDecrease"];
}
$uploadCoutDecrement--;
// then after it has been decremented then update it in the database
$updateUploadCount="UPDATE farmersTb
SET uploadCount='$uploadCoutDecrement'
WHERE Farmer_Id='$farmerId'";
// then lastly check if it executed and then u move back to uploadProducts.php
$uploadCountResult=mysqli_query($conn,$updateUploadCount);
if($uploadCountResult==TRUE)
// if the uploadCount has been updated then increment the total number of deletes a farmer has done
{
$TotalDeleted="SELECT TotalDeleted AS TotalDel FROM farmersTb
WHERE Farmer_Id='$farmerId'";
$TotalDeletedResult=mysqli_query($conn,$TotalDeleted);
if ($TotalDeletedResult==TRUE)
{
while ($row=$TotalDeletedResult->fetch_assoc()){
$DeletedItemsCount=$row["TotalDel"];
}
$DeletedItemsCount++;
}

$TotalDeletedUpdate="UPDATE farmersTb 
SET TotalDeleted='$DeletedItemsCount'
WHERE Farmer_Id='$farmerId'";
$TotalDeletedUpdateResult=mysqli_query($conn,$TotalDeletedUpdate);
if($TotalDeletedUpdateResult==FALSE){ echo "";}

}



else{echo "<script>alert('There was an unexpected error')</script>";}

}



}else {echo "<script>alert('Couldnt Delete the Product.!')</script>";}




}


}

header("location: MyProducts.php");
?>