<?php
session_start();
include "../connect.php";
$Fname =$Lname= $Email= $phone=$password=$confirmPass=$Fullname=$updateProfileEmailId=$Ustate=$LGA=$town=$SaveMessage="";
// Echo session variables that were set on previous page
$farmerid=$_SESSION["farmerId"];
// $updateProfileEmailId=$_SESSION["EmailId"];
$Fullname = $_SESSION["userName"];
// security settings saving............
// .............Getting the user(sessioned details).........
$query = $conn->query("SELECT * FROM farmersTb 
WHERE Farmer_Id='$farmerid';
");
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $Fname =$row["FName"];
        $Lname= $row["LName"];
        $Email= $row["Email"];
        $phone=$row["phone"];
        
    }
}
$query2 = $conn->query("SELECT * FROM Ustate 
WHERE Farmer_Id='$farmerid';
");
if($query2->num_rows > 0){
    while($row = $query2->fetch_assoc()){
        $Ustate =$row["stateName"];
        $stateid=$row["State_Id"];
    }
}
$query3 = $conn->query("SELECT * FROM localGovt 
WHERE State_Id='$stateid';
");
if($query3->num_rows > 0){
    while($row = $query3->fetch_assoc()){
        $LGA =$row["localGovtName"];
        $lgaid=$row["LocalGov_Id"];
    }
}
$query4 = $conn->query("SELECT * FROM town 
WHERE LocalGov_Id='$lgaid';
");
if($query4->num_rows > 0){
    while($row = $query4->fetch_assoc()){
        $town =$row["townName"];
    }
}
$address=$Ustate." ,".$LGA." ,".$town." <br>";
// profile mage.....

 $upadateProfile=$conn->query("SELECT * FROM farmersTb WHERE Farmer_Id='$farmerid'");
        if($upadateProfile ->num_rows > 0){
        while($row=$upadateProfile -> fetch_assoc()){
                // echo "<script>alert(hey oka);</script>";
                $profileImage = 'ProfileUpload/'.$row["profileImage"];
                
                }
                
}
?>


<!DOCTYPE html>  
<head>    
<html>
<title>FSS| Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/439a1fb029.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/Fprofile.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<link rel="stylesheet" href="css/dash2.css">
</head>
<body>

<!-- Top container -->
<div class="bodyContainer"> 
<div id="backToDashboard"><h2><a href="../dashboard.php" style="text-decoration:none;color:#212529;;">Dashboard</a></h2>
<div id="pageDescription"><h2>Profile</h2></div>
<div class="flexDiv">
<div id="oneflex">
        <div id="boxflex1" style="z-index:1;">
            <div id="boxflex12">
            <h2 style="font-size:24px;font-weight:light; margin-top:12px"><?php echo $Fullname; ?></h2> <br>
            <img src="<?php echo $profileImage; ?>" alt="image not found"  class="rounded-circle" width="160" height="160" style="">
            <p style="font-size:20px;font-weight:lighter;">Farmer</p>
            
            </div>
            <div id="boxflex13" style="line-height:33px;font-size:18px;z-index:1;">
            
            <p><i class="fas fa-map-marker"></i>  <?php echo $address; ?></p>
            <p><i class="fas fa-phone"></i>  <?php echo $phone?></p> <br><br><br>
            </div>
        </div>
        <div id="boxflex2">
        <h3 id="aboutStyle" >About</h3>
                <div id="aboutLine" style="background-color:grey;width:100%;height:2px;">
                        <div class="" style="background-color:blue;width:50%;height:2px;"></div>
                </div>
            <p id="loremWrite">A farmer 
            <br> </p>
            <p id="farmermWrite"><i class="fas fa-envelope"></i>  <?php echo $Email?><br> </p>
        
        </div>

</div>



<div id="twoflex">

<div id="twoflex1"><p>About Me</p>
<h1><p></p></h1>

</div>
<div id="twoflex2"><p>About</p></div>
<div id="twoflex3">
<!--  -->
<div id="">
<h3>Full Name</h3>
<p><?php echo $Fullname; ?></p>
</div>
<div id="">
<h3>Mobile</h3>
<p><?php echo $phone; ?></p>
</div>
<div id="">
<h3>Email</h3>
<p><?php echo $Email; ?></p>
</div>
</div>
<!--  -->
<!-- <div id="twoflex4">
<p>Security Settings</p>
</div> -->
<div id="twoflex5">


</div>






<!-- END OF TWOFLEX DIV -->

</div>


<!-- END OF FLEX DIV -->
</div>



<!-- end of body container -->
</div>
</html>
</body>
