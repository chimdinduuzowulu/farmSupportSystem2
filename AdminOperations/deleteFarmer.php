<?php
    include "../connect.php";

$FID=isset($_GET['FID']) ? intval($_GET['FID']) : null;
$user=isset($_GET['user']) ? strval($_GET['user']) : null;
$localgovId=$stateid=0;

echo $FID;
// $f=intval($FID);
$localgovId=$stateid=0;
$q=$conn->query("SELECT * FROM Ustate WHERE Farmer_Id=$FID");
if($q){
while($row=$q->fetch_assoc())
{
$stateid=$row["State_Id"];
}
}

$ql=$conn->query("SELECT * FROM localGovt WHERE State_Id=$stateid");
if($ql){
while($row=$ql->fetch_assoc())
{
$localgovId=$row["LocalGov_Id"];
}
}

// then deleteing from the no foreign key  ones
$sql4=$conn->query("DELETE FROM town WHERE LocalGov_Id=$localgovId");
$sql5=$conn->query("DELETE FROM localGovt WHERE State_Id=$stateid");
$sql3=$conn->query("DELETE FROM Ustate WHERE Farmer_Id=$FID");
$FDEL=$conn->query("DELETE FROM farmersTb WHERE Farmer_Id=$FID");
$sql6=$conn->query("DELETE FROM productTable WHERE Farmer_Id=$FID");
if($sql6){

echo "";}


if($FDEL && $sql4 && $sql5 && $sql3 && $sql6){

header("location: adminDashboard.php");
}
else{
echo "erro deleting users";

}



// if($sql && $sql5 && $sql4 && $sql3){
// echo "<script style='color:green;font-size:21px;'>User Deleted Successfully.</script>";


// }
// else{
// echo "<script>alert('unable to delete user)";

// }

// 
?>