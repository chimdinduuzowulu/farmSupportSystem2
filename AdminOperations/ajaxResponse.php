<?php
  include "../connect.php";
 $sqlChoice="";
  $sqlQ=$resultQ="";
  $resultQuery=FALSE;
  $fname=$lname=$email=$phone=$regD="";
  $flag=0;


$displayChoice=isset($_GET["Qoption"])? strval($_GET["Qoption"]):null;
$limitValue=isset($_GET["limitVal"]) ? intval($_GET["limitVal"]):null;

// echo $displayChoice." ".$limitValue;
echo "
<tr class='table-light'>
<th>User_Id</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Email</th>
<th>Phone</th>
<th>Registration Date</th>
</tr>";
if($displayChoice==="Farmer"){
// echo "yes";
$sqlQ=$conn->query("SELECT * FROM farmersTb LIMIT $limitValue");
if($sqlQ){

while($row =$sqlQ->fetch_assoc()) {
$fid=$row['Farmer_Id'];
// $fname=$row['FName'];
$fname=$row['FName'];
$lname=$row['LName'] ;
$email=$row['Email'] ;
$phone=$row['phone'];
$regD=$row['reg_date'];

  echo "<tr>";
  echo "<td>" . $fid . "</td>";
  echo "<td>" . $fname . "</td>";
  echo "<td>" . $lname . "</td>";
  echo "<td>" . $email. "</td>";
  echo "<td>" . $phone. "</td>";
  echo "<td>" . $regD . "</td>";
  echo "<td>" . "<a style='color:red;' href='deleteUser.php?FID=$fid&user=$displayChoice'> <i class='fas fa-trash-alt'></i></a>". "</td>";
  echo "</tr>";

// echo "</table>";
// mysqli_close($conn);
}
}
else{ echo "No Result Found";}


}

// else if it is client
else{
$client=$conn->query("SELECT * FROM clientsTb LIMIT $limitValue");
if($client){
while($row =$client->fetch_assoc()) {
$fid=$row["Client_Id"];
// $fname=$row['FName'];
$fname=$row["FName"];
$lname=$row["LName"] ;
$email=$row["Email"] ;
$phone=$row["phone"];
$regD=$row["reg_date"];

  echo "<tr>";
   echo "<td>" . $fid . "</td>";
  echo "<td>" . $fname . "</td>";
  echo "<td>" . $lname . "</td>";
  echo "<td>" . $email. "</td>";
  echo "<td>" . $phone. "</td>";
  echo "<td>" . $regD . "</td>";
  echo "<td>" . "<a style='color:red;' href='deleteUser.php?FID=$fid&user=$displayChoice'> <i class='fas fa-trash-alt'></i></a>". "</td>";
  echo "</tr>";

// echo "</table>";

}
}
else{
echo "result not found";
}

}

mysqli_close($conn);

?>