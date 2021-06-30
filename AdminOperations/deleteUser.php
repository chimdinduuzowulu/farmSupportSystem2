<?php
    include "../connect.php";

$FID=isset($_GET['FID']) ? intval($_GET['FID']) : null;
$user=isset($_GET['user']) ? strval($_GET['user']) : null;
$localgovId=$stateid=0;

if($user=="Client"){

$sql2=$conn->query("DELETE FROM clientsTb WHERE Client_Id='$FID'");
if($sql2){
header("location: adminDashboard.php");
}
}
else{
$f=intval($FID);
$localgovId=$stateid=0;
$sql= $conn->query("DELETE FROM farmersTb WHERE Farmer_Id=$f");
// get ustateID BEFORE DELETELING STATE
$q=$conn->query("SELECT * FROM Ustate WHERE Farmer_Id=$FID");
if($q){
while($row=$q->fetch_assoc())
{
$stateid=$row["State_Id"];
}
}
// then delete state
$sql3=$conn->query("DELETE FROM Ustate WHERE Farmer_Id=$FID");

// get local govt id before deleting it
$ql=$conn->query("SELECT * FROM localGovt WHERE State_Id=$stateid");
if($ql){
while($row=$ql->fetch_assoc())
{
$localgovId=$row["LocalGov_Id"];
}
}

$sql5=$conn->query("DELETE FROM localGovt WHERE State_Id=$stateid");


$sql4=$conn->query("DELETE FROM town WHERE LocalGov_Id=$localgovId");

$sql6=$conn->query("DELETE FROM productTable WHERE Farmer_Id=$FID");
if($sql && $sql5 && $sql4 && $sql6 && $sql3){
echo "<script style='color:green;font-size:21px;'>User Deleted Successfully.</script>";
header("location: adminDashboard.php");

}
else{
echo "<script>alert('unable to delete user)";

}

}
?>