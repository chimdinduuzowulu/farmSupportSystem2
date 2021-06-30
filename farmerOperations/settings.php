<?php
session_start();
include "../connect.php";
$farmerid=$_SESSION["farmerId"];
// .................value intial for the inputes
// <?php 
$q=$conn->query("SELECT * FROM farmersTb WHERE Farmer_Id= '$farmerid'");
if($q-> num_rows >0){
while ($row=$q->fetch_assoc())
{
$na=$row["FName"];
$lna=$row["LName"];
$ph=$row["phone"];
// $sta=$row["FName"];
$ema=$row["Email"];
// $Tow=$row["FName"];

}

}
$q2=$conn->query("SELECT * FROM Ustate WHERE Farmer_Id= '$farmerid'");
if($q2-> num_rows >0){
while ($row=$q2->fetch_assoc())
{
$sta=$row["stateName"];

$SI=$row["State_Id"];

}

}
$q3=$conn->query("SELECT * FROM localGovt WHERE State_Id='$SI'");
if($q3-> num_rows >0){
while ($row=$q3->fetch_assoc())
{
$lgan=$row["localGovtName"];

$LI=$row["LocalGov_Id"];

}

}
$q4=$conn->query("SELECT * FROM town WHERE LocalGov_Id='$LI'");
if($q4-> num_rows >0){
while ($row=$q4->fetch_assoc())
{
$tn=$row["townName"];

// $Tow=$row["FName"];

}

}

// ..............................
$Fname =$Lname= $Email= $phone=$password=$confirmPass=$Fullname=$updateProfileEmailId=$Ustate=$LGA=$town=$SaveMessage=$SaveMessage1="";
$Fullname = $_SESSION["userName"];
// security settings saving.............
if(isset($_POST["Save"])){
$uEmail= $_POST["ProfileEmail"];
$uP= $_POST["currentPassword"];
$newPass=$_POST["newPassword"];
        $sqlquery = "SELECT * FROM farmersTb";
        $result = mysqli_query($conn, $sqlquery);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row  
            while($row = mysqli_fetch_assoc($result)) {
            if($row["Email"]==$uEmail && $row["Farmer_Id"]==$farmerid && $row["passW"]==$uP && $row["confirmPassW"]==$uP){
                $updateQuery="UPDATE farmersTb
                SET passW ='$newPass', confirmPassW = '$newPass'
                WHERE Farmer_Id= '$farmerid'";
                $returnResult= mysqli_query($conn,$updateQuery);

                if( $returnResult=== TRUE){$SaveMessage1="Changes have been saved **";}
                
                }else{$SaveMessage1="There is an input Error***";}
        }

        }         

}
// ...................Account settings saveing...............
if(isset($_POST["Save2"])){
$fname = $_POST["Fname"];
$lname = $_POST["lname"];
$ustate=$_POST["ustate"];
$ulocalgovt=$_POST["ulocalgovt"];
$uEmails=$_POST["uEmail"];
$utown = $_POST["town"];
$uphone = $_POST["phone"];

        $sqlquery = "SELECT * FROM farmersTb";
        $result = mysqli_query($conn, $sqlquery);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row  
            while($row = mysqli_fetch_assoc($result)) {
                    $Fname =$row["FName"];
                    $Lname= $row["LName"];
                    $Email= $row["Email"];
                    $phone=$row["phone"];
                             
                

        }
        $updateQuery="UPDATE farmersTb
                SET FName ='$fname', LName = '$lname', Email = '$uEmails',phone = '$uphone'
                WHERE Farmer_Id= '$farmerid'";
                $returnResult= mysqli_query($conn,$updateQuery);

                if( $returnResult=== TRUE){$SaveMessage="Changes have been saved **";}
        }        
        $updateQuery2="UPDATE Ustate
                SET stateName ='$ustate'
                WHERE Farmer_Id= '$farmerid'";
                $returnResult= mysqli_query($conn,$updateQuery2); 
                $updateQuery4="UPDATE localGovt
                SET  localGovtName='$ulocalgovt'
                WHERE State_Id= '$SI'";
                $returnResult= mysqli_query($conn,$updateQuery4); 
                $updateQuery3="UPDATE town
                SET  townName='$utown'
                WHERE LocalGov_Id= '$LI'";
                $returnResult= mysqli_query($conn,$updateQuery3); 
                
    

                // $updateProfileEmailId=$uEmails;$_SESSION["EmailId"]=$uEmails;
                // $_SESSION["userName"]= $fname." ".$lname;
                // $Fullname = $_SESSION["userName"];
                // $_SESSION["addItems"]=$uEmails;
                // $address=$ustate." ,".$ulocalgovt." ,".$utown." <br>";


}

$profileImage=$profileMessage="";
if(isset($_POST["upload2"])){
// $profileImage=$profileMessage="";
 // File upload configuration 
    $targetDir = "ProfileUpload/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    $fileName = $_FILES['profileImage']['name']; 
    $imgaefile=$_FILES['profileImage']['name'];
    // $fileName = basename($_FILES['profile']['name']); 
    $targetFilePath = $targetDir . $fileName; 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    // to check if the file type is valid from the giving array of extensions
    if(in_array($fileType, $allowTypes)){
    // upload the file to server..............
    move_uploaded_file($_FILES["profileImage"]["tmp_name"],$targetFilePath);
    $insertValuesSQL =$fileName;
    if(!empty($insertValuesSQL)){
    $updateQuery="UPDATE farmersTb
                SET profileImage ='$insertValuesSQL'";
                if(mysqli_query($conn,$updateQuery) ===TRUE){
                $profileMessage="Profile Picture updated";
                
                }
                else{
                $profileMessage="failed to update";
                
                }
                
    
    }
    else{
    echo "<script>alert('Select Image');</script>";
    }

    }
    else{
    $profileMessage="image must be: png,jpeg,gif or jpg";
    }

 }

  $upadateProfile=$conn->query("SELECT * FROM farmersTb WHERE Farmer_Id='$farmerid'");
        if($upadateProfile ->num_rows > 0){
        while($row=$upadateProfile -> fetch_assoc()){
                // echo "<script>alert(hey oka);</script>";
                $profileImage = 'ProfileUpload/'.$row["profileImage"];
                
                }
                
}
?>
<!-- .......................................for farmer profile image picture.............. -->


<!DOCTYPE html>  
<head>    
<html>
<title>FSS| Acount Settings</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/fsettings.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
</head>
<body>

<!-- Top container -->
<div class="bodyContainer"> 
<div id="backToDashboard"><h2><a href="../dashboard.php" style="text-decoration:none;color:#212529;;">Dashboard</a></h2>
<div id="pageDescription"><h2>SETTINGS</h2></div>

<div class="flexDiv">
<div id="">
<img src="<?php echo $profileImage; ?>" alt="Admin image"  class="rounded-circle" width="150" height="150" style="border:1px solid black;">
                  <form method="POST" enctype="multipart/form-data">

                    <input type="file" name="profileImage" value="choose Image" style="height:30px;width:70%;background-color:;color:black;;margin:auto;border-radius:8px;margin:2px;margin-bottom:3px;"> <br><br>
                    <input type="submit" name="upload2" value="upload" style="" id="uploadImage">
                    <div class="mt-3">
                    </form>
                    <span style="color:green;font-size:12px;text-align:center;"><?php echo $profileMessage?></span>
</div>
<div id="twoflex">
<div id="twoflex4">

<p>Security Settings</p>
</div>
<div id="twoflex5">
<!-- ....security settings..... -->
<div id="securitySettings">   
<form action="" method="POST">
<label>Current Email:
<br>
<input type="Email" name="ProfileEmail" id="ProfileEmail" /> </label>
<br>
<label>Current password:<br>
<input type="text" name="currentPassword" id="currentPassword" /> </label>

</label><br><br>
<label>New password:<br>
<input type="text" name="newPassword" id="newPassword" /> </label>

</label><br>

<input type="submit" name="Save" id="Save" value="Save" class="btn btn-primary" /> 
<p style="text-align:center;color:red; font-size:12px;"><?php echo $SaveMessage1; ?></p>
    <!-- <a href="goBack.php" class="w3-bar-item w3-button w3-padding btn btn-primary">Go Back</a><br><br> -->
    
</form>
</div>

<!-- ........ACCOUNT SETTINGS...... -->
<div id="securitySettings2">  
<h3 id="ACs">Account Settings</h3> 
<form action="" method="post">
<label>First Name:
<br>
<input type="text" name="Fname" id="fname" value="<?php echo $na?>" /> </label>
<label>Last Name:<br>
<input type="text" name="lname" id="lasname" value="<?php echo $lna?>"/> </label>
</label>
<label>State:<br>
<input type="text" name="ustate" id="ustate" value="<?php echo $sta?>"/> </label>
</label>
<label>Local Govt:<br>
<input type="text" name="ulocalgovt" id="ulocalgovt" value="<?php echo $lgan?>"/>
</label>
<label>Town:<br>
<input type="text" name="town" id="ulocalgovt" value="<?php echo $tn?>"/>
</label>
<label>phone:<br>
<input type="text" name="phone" id="ulocalgovt" value="<?php echo $ph?>"/>
</label>
<label id="emailMove"> Email:<br>
<input type="Email" name="uEmail" id="uEmail" value="<?php echo $ema?>"/>
</label>
<label id="submitLabel">
<input type="submit" name="Save2" id="Save2" value="Save Changes" class="btn btn-primary" /> </label>
<p style="text-align:center;color:red; font-size:12px;"><?php echo $SaveMessage; ?></p>
    
</form>
</div>

</div>















<!-- END OF TWOFLEX DIV -->

</div>


<!-- END OF FLEX DIV -->
</div>



<!-- end of body container -->
</div>
</html>
</body>
