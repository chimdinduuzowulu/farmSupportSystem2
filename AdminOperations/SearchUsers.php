    <?php
  include "../connect.php";

$SearchUser=isset($_GET["email"])? strval($_GET["email"]) : null;
if(!empty($SearchUser)){
// if choice is farmer...
echo "
<tr class='table-light'>
<th>User_Id</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Email</th>
<th>Phone</th>
<th>Registration Date</th>
</tr>";

$sqlQ=$conn->query("SELECT * FROM farmersTb WHERE Email='$SearchUser'");
if($sqlQ){
while($row =$sqlQ->fetch_assoc()){
$fid=$row["Farmer_Id"];
// $fname=$row['FName'];
$fname=$row["FName"];
$lname=$row["LName"];
$email=$row["Email"];
$phone=$row["phone"];
$regD=$row["reg_date"];

  echo "<tr>";
  echo "<td>" . $fid . "</td>";
  echo "<td>" . $fname . "</td>";
  echo "<td>" . $lname . "</td>";
  echo "<td>" . $email. "</td>";
  echo "<td>" . $phone. "</td>";
  echo "<td>" . $regD . "</td>";
  echo "<td>" . "<a style='color:red;' href='deleteFarmer.php?FID=$fid'> <i class='fas fa-trash-alt'></i></a>". "</td>";
  echo "</tr>";

// echo "</table>";
// mysqli_close($conn);
}
}
else {echo "User Email Not Found Sorry.";}
}
else{
echo "no query argument received";
}



mysqli_close($conn);

?>