<?php
include "../connect.php";
$farmerId=isset($_GET['farmerId']) ? intval($_GET['farmerId']) : null;
$Title=isset($_GET['Title']) ? strval($_GET['Title']) : null;
$Pdesc=isset($_GET['Decs']) ? strval($_GET['Decs']) : null;

if(!empty($farmerId) && !empty($Title) && !empty($Pdesc)){
if(!$conn){die("connection Error").mysqli_erro();}


else {
$query = $conn->query("SELECT * FROM productTable 
WHERE Farmer_Id='$farmerId' AND productTitle='$Title' AND productDescription='$Pdesc'");
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $title = $row["productTitle"];
        $desc=$row["productDescription"];
        

 }
    }


// else ...
}

// if !empty .......
}
$errMessage=$successMessage="";
// update form validation
if(isset($_POST["upload"])){
$newTittle=dataSecure($_POST["Ptittle"]);
$newProduct=dataSecure($_POST["Pdesc"]);
$query2 = $conn->query("UPDATE productTable  SET
productTitle='$newTittle',productDescription='$newProduct'
WHERE Farmer_Id='$farmerId'
 AND productTitle='$Title' AND productDescription='$Pdesc'");
if($query2){
$Title=$newTittle;
$Pdesc=$newProduct;

$successMessage="Update Successfull";
// header("location:updateItems.php")
  
    }else{$successMessage="Update Not Successfull";}






}

function dataSecure($a){
$a=trim($a);
$a=stripslashes($a);
$a=htmlspecialchars($a);
return $a;

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <script src="https://kit.fontawesome.com/439a1fb029.js" crossorigin="anonymous"></script>
      <style>
      *{
      box-sizing:border-box;
      margin:0;padding:0;
      }
      body{background-image:url(../images/signup.jpeg);background-size:cover;background-position:center;}
      .row{width:90%;height:auto;margin:auto;}
      form{
      width:100%;height:100%;text-align:center;
      /* background-color:black; */
      margin:auto;
      
      }
      label{color:white;font-size:24px;}
      form input,textarea{
      width:70%;height:50px;margin:auto;text-align:center;
      
      }
        #images{
        width:100%;
        height:auto;
        display:flex;flex-wrap:wrap;
        /* background-color:red; */
        
        }
        #images > div{
        width:23%;height:400px;margin:auto;margin:12px;
        
        
        }
        #images >div img{
        
        width:100%;height:100%;transition:linear 2s ease-in-out;
        
        }
        #images >div img:hover{
        transform:scale(1.3,1.3);
        }
      .small{width:15%;height:70px;margin:2px;margin-top:14px;margin-bottom:14px; }
      h1{text-align:center;width:40%;margin:auto;height:100px;font-size:35px;color:white;margin-top:30px;padding:23px;}
      </style>
    <!-- <link rel="stylesheet" href="css/myProducts2.css"> -->
</head>
<body>
<h1> Edit Product</h1>
<span><?php echo $successMessage?></span>
<div class="row">
<form  method="POST" class="row g-3">
 <div class="col-md-6" >
 <label for="exampleFormControlInput1" class="form-label">Product Title</label>
<input type="text" value="<?php echo $Title?>" class="form-control" name="Ptittle">
</div>
<span style="color:red; font-size:12px;"><?php echo $errMessage?> </span>
<br>
 <div class="col-md-6">
 
<label for="exampleFormControlTextarea1" class="form-label">Product Description</label>
<textarea value="<?php echo $Pdesc?>" class="form-control" name="Pdesc" id="exampleFormControlTextarea1" rows="3">
<?php echo $Pdesc?>
</textarea>
</div>
<span style="color:red; font-size:12px;"><?php echo $errMessage?> </span>

<div id="images">
<?php
$query = $conn->query("SELECT * FROM productTable 
WHERE Farmer_Id='$farmerId' AND productTitle='$Title' AND productDescription='$Pdesc'");
if($query){
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["image_name"];
        $imagename=$row["image_name"];
 
?>
<div class="col-md-4 mb-3 text-center">
<img src="<?php echo $imageURL; ?>" alt=""  class="rounded"/> <br>
            <a href="deleteImages.php?farmerId=<?php echo $farmerId?>&Title=<?php echo $Title?>&Decs=<?php echo $Pdesc?>&imageName=<?php echo $imagename?>" style="color:red;"><i class="fas fa-trash-alt"></i></a>
            <!-- <p><?php echo $imageURL?></p> -->
            </div>




<?php 
    }}
?>
</div>
<input type="submit" name="upload"  value="Update" class="small" style="background-color:green; color:white;border-radius:5px;border-collapse:collapse;border:none;"><button class="btn btn-primary small" value=""><a href="../dashboard.php" style="color:white;text-decoration:none;">Dashboard</a></button>
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
