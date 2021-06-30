<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <script src="https://kit.fontawesome.com/439a1fb029.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/myProducts2.css">
</head>
<style>
body{background-image:url(../images/admin.jpeg);}


</style>
<body>


<button type="button" class="btn btn-primary"><a href="../dashboard.php" style="font-size:21px;color:white;padding:12px;text-decoration:none;">Dashboard</a></button>




<!-- ................................................=======================================................. -->
 <?php
// Include the database configuration file
include_once '../connect.php';
session_start();
$farmerid=$_SESSION["farmerId"];
$emailId=$_SESSION["addItems"];
$lastUpdated="";
// Get images from the database
$query = $conn->query("SELECT * FROM productTable 
WHERE Farmer_Id='$farmerid'
AND  
imageNumCount=1
ORDER BY Product_Id DESC

");
// ................
// $queDES = $conn->query("SELECT * FROM farmersTb 
// WHERE Farmer_Id='$farmerid'"); 
// if($query->num_rows > 0){
// while($row = $query->fetch_assoc()){}

// }

?>
<div class="container-fluid">
<div class="productsContainer">
<?php
// $first = true;
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["image_name"];
        $product=$row["productTitle"];
        $productDesc=$row["productDescription"];
        $uploadOn=$row["uploaded_on"];
        $_SESSION["PrductT"]=$product;
?>

    <div class="card mb-3" style="">
        <div class="row g-0">
                <div class="col-md-4">
                <img src="<?php echo $imageURL; ?>" alt=""  class="img-thumnail"/>
                </div>
                <div class="col-md-8">
                <div class="card-body" id="cardBody">
                    <h5 class="card-title"><?php echo $product?></h5>
                <p class="card-text"><?php echo $productDesc?></p>
                <p class="card-text" id="updateDelete"><a href="updateItems.php?farmerId=<?php echo $farmerid?>&Title=<?php echo $product?>&Decs=<?php echo $productDesc?>" ><i class="fas fa-edit"></i></a><br><br><a href="deleteProduct.php?farmerId=<?php echo $farmerid?>&Title=<?php echo $product?>&Decs=<?php echo $productDesc?>" style="color:red;" ><i class="fas fa-trash-alt"></i></a></p>
                <p class="card-text"><small class="text-muted">Uploaded on <?php echo $uploadOn?></small></p>
                </div>
            </div>
    </div>
    </div> 
    <!-- </div> -->
    <!-- <img src="<?php echo $imageURL; ?>" alt="" height="250" width="250" class="img-thumnail"/> -->
<?php }
}


else{ ?>
    <p></p>
<?php } ?> 









</div>













<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>


