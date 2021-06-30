
<?php
error_reporting (E_ALL ^ E_NOTICE); 
session_start();
include "connect.php";
$user=$_SESSION["user"];
// echo $_SESSION["images"];
$productTittle=$productDescription="";

$viewMax=$productMaxViewValue=0;
$viewProductVal=$displayView=0;
$imagesHold="";
$Fname =$Lname= $Email= $phone=$password=$ProductTitle=$confirmPass=$Fullname=$updateProfileEmailId=$productDescription=$Ustate=$LGA=$town=$SaveMessage="";

// .............Getting the user(sessioned details).........

$fid = isset($_GET['fID']) ? intval($_GET['fID']) : null;
$ProductTitle = isset($_GET['ProductTitle']) ? strval($_GET['ProductTitle']) : null;
$productDescription=isset($_GET['productsDescription']) ? strval($_GET['productsDescription']) : null;
if (!empty($fid && $ProductTitle && $productDescription) )
{
$productTittle=$ProductTitle ;

// sellecting all the details from farmers and product table where the two has the same email and product.tils = what the user clicked on the image
$query0 = $conn->query("SELECT p.productTitle,p.productDescription,p.image_name,f.FName,f.LName,f.Email,f.phone
FROM productTable AS p, farmersTb AS f
WHERE p.Farmer_Id='$fid' AND f.Farmer_Id='$fid' AND p.productTitle='$productTittle' AND p.productDescription='$productDescription'
");
if($query0){
    while($row = $query0->fetch_assoc()){
        $Fname =$row["FName"];
        $Lname= $row["LName"];
        $Email= $row["Email"];
        $phone=$row["phone"];
        $imagesHold=$row["image_name"];
        $productTittle=$row["productTitle"];
        $productDescription=$row["productDescription"];
    }
}
$Fullname=$Fname." ".$Lname;
$query2 = $conn->query("SELECT * FROM Ustate 
WHERE Farmer_Id='$fid'
");
if($query2){
    while($row = $query2->fetch_assoc()){
        $Ustate =$row["stateName"];
        $stateId=$row["State_Id"];
    }
}
$query3 = $conn->query("SELECT * FROM localGovt 
WHERE State_Id='$stateId'
");
if($query3){
    while($row = $query3->fetch_assoc()){
        $LGA =$row["localGovtName"];
        $LGA_ID =$row["LocalGov_Id"];
    }
}
$query4 = $conn->query("SELECT * FROM town 
WHERE LocalGov_Id='$LGA_ID'
");
if($query4){
    while($row = $query4->fetch_assoc()){
        $town =$row["townName"];
    }
}
$address=$Ustate." ,".$LGA." ,".$town." <br>";

// to increment ViewValue of the products..........................
$sql =$conn->query("SELECT MAX(viewValue) AS viewProduct FROM productTable
   WHERE Farmer_Id='$fid'
   
   ");
                            if ($sql) {
                            // output data of each row  
                            while($row = $sql->fetch_assoc()) {
                            $viewProductVal=$row["viewProduct"];
                            
                            }
                            }

                      $viewProductVal++;      
        $sql2 = $conn->query("UPDATE productTable
                SET  viewValue = '$viewProductVal'
                WHERE Farmer_Id='$fid'");
        if($sql2) {
            // echo "yeah i did";
        }

}

// Use $ID to fetch whatever data you need




?>

<!DOCTYPE html>  
<head>    
<html>
<title>FSS| Product Details</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/439a1fb029.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/productsDescp2.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<!-- <link rel="stylesheet" href="css/productsDescriptionTwo.css"> -->
</head>
<body>

<!-- to get the profile image of the farmer and display it on the products pages -->
<?php 
// profile image..................
  $getProfile=$conn->query("SELECT * FROM farmersTb WHERE Farmer_Id='$fid'");
        if($getProfile ->num_rows > 0){
        while($row=$getProfile -> fetch_assoc()){
                // echo "<script>alert(hey oka);</script>";
                $profileImage = 'farmerOperations/ProfileUpload/'.$row["profileImage"];
                
                }
                
}

?>
<!-- Top container -->
<div class="bodyContainer"> 
<div id="backToDashboard"><h2><a href="home.php" style="text-decoration:none;color:white;"><i class="fas fa-home"></i></a></h2>
<div id="pageDescription" ><h2 style="text-decoration:none;color:white;">Farmer's Profile</h2></div>
<div class="flexDiv">
<div id="oneflex">
        <div id="boxflex1">
            <div id="boxflex12">
            <h2 style="font-size:24px;font-weight:light; margin-top:12px"><?php echo $Fullname; ?></h2> 
            <img src="<?php echo $profileImage ?>" class="w3-circle w3-margin-right" style="width:100px;height:100px;margin-bottom:5px;" alt="No Profile image"> 
            <p style="font-size:20px;font-weight:lighter;">A Farmer</p>
            
            </div>
            
            <div id="boxflex13" style="line-height:33px;font-size:18px;">
            <p style="font-size:20px;font-weight:lighter;">LOCATION</p>
            <p><i class="fas fa-map-marker"></i>  <?php echo $address;?></p>
            <p><i class="fas fa-phone"></i>  <?php echo $phone?></p>  <p id="farmermWrite2"><i class="fas fa-envelope"></i>  <?php echo $Email?> </p><br><br><br>
            <p id="farmermWrite2"><i class="fas fa-comment-alt"></i> <a target="_blank" style="text-decoration:none;color:black;" href="https://mail.google.com/mail/u/<?php echo $user?>/?fs=1&tf=cm&source=mailto&to=<?php echo $Email?>">click here to leave A message</a></p><br><br><br>
            
            </div>
        </div>
        <div id="boxflex2">
        <h3 id="aboutStyle" >ABOUT PRODUCTS</h3>
                <div id="aboutLine" style="background-color:grey;width:100%;height:2px;">
                        <div class="" style="background-color:blue;width:50%;height:2px;"></div>
                </div>
            <p id="loremWrite">Product Details</p>
            <p id="farmermWrite" style="text-align:center;padding:12px;overflow:hidden;
height:auto;FONT-FAMILY:Roboto, 'Helvetica Neue', sans-serif;
FONT-SIZE:23px;
LINE-HEIGHT:21px;
TEXT-ALIGN:center;margin:auto;
LETTER-SPACING:normal;margin:auto;color:black;font-weight:bolder;">
<?php echo $productTittle?> </p>
            <p id="farmermWrite2" >
            <?php echo $productDescription?> </p>
           <!-- <button class="btn btn-primary"><a href="chatPage.php" style="color:white;text-decoration:none;">Start a chat</a></button> -->
      
        </div>

</div>



<div id="twoflex">

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
<?php
include "connect.php";
$showImage1=$conn->query("SELECT image_name,imageNumCount FROM productTable
WHERE productTitle='$productTittle' AND productDescription='$productDescription' AND Farmer_Id='$fid' AND imageNumCount=1
");
if($showImage1){
while($row1=$showImage1->fetch_assoc()){
$imageURL1='farmerOperations/uploads/'.$row1["image_name"];
?>
<!-- getting the first image with numcpunt as one to be the bootstarp slider active one -->
<div class="carousel-inner">
  <div class="carousel-item active" id="images">
      <a href="" target="_blank"><img  src="<?php echo $imageURL1; ?>" alt="not found"  class="img-thumnail" /></a>
    </div>

<?php  }}?>


<?php
// then getting the rest of the images excluding the first one for the inner slider images
$showImage=$conn->query("SELECT image_name,imageNumCount FROM productTable
WHERE productTitle='$productTittle' AND productDescription='$productDescription' AND Farmer_Id='$fid' AND NOT imageNumCount=1
");
if($showImage){
while($row=$showImage->fetch_assoc()){
$imageURL='farmerOperations/uploads/'.$row["image_name"];

?>    
<!-- displaying the fetched images -->
    <div class="carousel-item" id="images">
      <a href="" target="_blank"><img src="<?php echo $imageURL; ?>" alt="missing"  class="img-thumnail" /></a>
    </div>
               
                
                 



<?php 

}}

?>
<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



<!-- END OF TWOFLEX DIV -->
</div>
<!-- END OF FLEX DIV -->
</div>


<!-- end of body container -->
</div>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>



