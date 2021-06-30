<?php 
// if(!isset($_SESSION["user"])|| !isset($_SESSION["farmerId"])){
// location

// }
error_reporting (E_ALL ^ E_NOTICE); 
 session_start();
error_reporting (E_ALL ^ E_NOTICE); 
$_SESSION["user"];
$user=$_SESSION["userName"];
  include "connect.php";
  $_SESSION["Email"] ;
  $imageEmail=$_SESSION["Email"] ;
  $message="";
  $fid=0;
if(isset($_POST["send"])){
$message=$_POST["Cmessage"];
// echo "<script>alert('hey')</script>";

}


  ?>

<!DOCTYPE html>  
 <html>  
      <head>  
           <title>FSS| Home</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
           <script src="https://kit.fontawesome.com/439a1fb029.js" crossorigin="anonymous"></script>
           <!-- <script src="javascript/homeLiveSearch.js"></script> -->
           <link rel="stylesheet" href="css/homestyle2.css"/>
         
           
      </head>  
      <body>  
 <!-- <div class="container">   -->
    
  <div class="overallContainer">
<div class="schedule">

<div class="box2">
<div class="con1">
    <h1>Find Farm Produce <br> In Nigeria <br>NEAR TO YOU </h1>
    <p>OR CONNECT US DIRECTLY <br> <a href="farmerLogin.php" target="_blank" rel="noopener noreferrer">Farmer Login/Signup</a> </p> 
</div>
<div class="con2">
<h1>LOOKING FOR SOMTHING? </h1>
<P>Search Here</P>
<p id="flexp">  
<form action="" method="POST"> 
<input type="text" name="productSearch" id="btn1" placeholder="Type your search: *" required> 
<select name="state" id="btn3" class=""  required> 
                                 <option value=''>Select State......</option>
                                    <option value="Abia">Abia</option>
                                    <option value="Adamawa">Adamawa</option>
                                    <option value="Akwa Ibom">Akwa Ibom</option>
                                    <option value="Anambra">Anambra</option>
                                    <option value="Bauchi">Bauchi</option>
                                    <option value="Bayelsa">Bayelsa</option>
                                    <option value="Benue">Benue</option>
                                    <option value="Borno">Borno</option>
                                    <option value="Cross River">Cross River</option>
                                    <option value="Delta">Delta</option>
                                    <option value="mercEbonyiedes">Ebonyi</option>
                                    <option value="Edo">Edo</option>
                                    <option value="Ekiti">Ekiti</option>
                                    <option value="Enugu">Enugu</option>
                                    <option value="Gombe">Gombe</option>
                                    <option value="Imo">Imo</option>
                                    <option value="Jigawa">Jigawa</option>
                                    <option value="Kaduna">Kaduna</option>
                                    <option value="Kano">Kano</option>
                                    <option value="Katsina">Katsina</option>
                                    <option value="Kebbi">Kebbi</option>
                                    <option value="Kogi">Kogi</option>
                                    <option value="Kwara">Kwara</option>
                                    <option value="Lagos">Lagos</option>
                                    <option value="Nasarawa">Nasarawa</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Ogun">Ogun</option>
                                    <option value="Ondo">Ondo</option>
                                    <option value="Osun">Osun</option>
                                    <option value="Oyo">Oyo</option>
                                    <option value="Plateau">Plateau</option>
                                    <option value="Rivers">Rivers</option>
                                    <option value="Sokoto">Sokoto</option>
                                    <option value="Taraba">Taraba</option>
                                    <option value="Yobe">Yobe</option>
                                    <option value="Zamfara">Zamfara</option>
                                    </select>

<input type="submit" name="submit" value="Search" id="btn2">
</form> 
</p>

</div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>  
 </html>  


<div id="backendDisplayFlex">
  <?php
 $fid=0;
$IncrementSearchedValue=0;
$incrementedSearchedProduct="";
$viewsValue=0;
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
  $searchLocation ="Select State.....";
$countCheck=0;
$product="";
// <?php
if(isset($_POST["submit"])){
$countCheck=1;
$productDetails=$productSearchtTittle="";
$searchLocation = $_POST["state"];
$productSearch= $_POST["productSearch"];

// code to update the frquently searchded product............................
$sql1 = "SELECT DISTINCT searchValue AS MaxSearched1,productTitle AS Tittle FROM productTable
WHERE productTitle='$productSearch';
";
 $result1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($result1) > 0) {
                            // output data of each row  
                            while($row = mysqli_fetch_assoc($result1)) {
                            $IncrementSearchedValue=$row["MaxSearched1"]; 
                            $incrementedSearchedProduct=$row["Tittle"];
                            }
                            }
                            $IncrementSearchedValue++;
$sql22 =$conn->query( "UPDATE productTable
                SET  searchValue = '$IncrementSearchedValue'
                WHERE productTitle LIKE '%$incrementedSearchedProduct%';");
                $returnResult1= mysqli_query($conn,$sql22);
                if($sql22->num_rows > 0){echo "";}
        // to now display that product thta has the heighest searched value


// Get images from the database
$query = $conn->query("SELECT *
FROM productTable,Ustate,localGovt,town
WHERE productTable.Farmer_Id=Ustate.Farmer_Id
AND productTable.imageNumCount=1
AND Ustate.State_Id=localGovt.State_Id
AND Ustate.stateName='$searchLocation'
AND productTable.productTitle LIKE '%$productSearch%'
AND localGovt.LocalGov_Id=town.LocalGov_Id;");

if($query->num_rows > 0){
// echo "<script>alert('yeah')</script>";
    while($row = $query->fetch_assoc()){
        $imageURL = 'farmerOperations/uploads/'.$row["image_name"];
        $productDetails= $row["productTitle"];
         $fid= $row["Farmer_Id"];
         $timeOfUpload=$row["uploaded_on"];
         $productsDescription= $row["productDescription"];
        $_SESSION["title"]=$productDetails;
		    $_SESSION["ProductEmail"]=$EmailDetails;
        $_SESSION["productDescription"]=$productsDescription;
        $_SESSION["images"]=$imageURL;
?>

<div class="wraapper">
<div class="food1">
<h1 class="addtocart">
<button ><a href="productsDescription.php?fID=<?php echo $fid?>&ProductTitle=<?php echo $productDetails?>&productsDescription=<?php echo $productsDescription?>" > <?php echo $productDetails; ?></a></a></button>
</h1>
 <img src="<?php  echo $_SESSION["images"]; ?>" class="card-img-top" alt=""/> 
<p class="price">
<span id="cart1"> <?php echo $productsDescription ?></span> <br>
<i class="fa fa-star star" aria-hidden="true"></i>
<i class="fa fa-star star" aria-hidden="true"></i>
<i class="fa fa-star star" aria-hidden="true"></i>
<i class="fa fa-star star" aria-hidden="true"></i>
<i class="fa fa-star-o star" aria-hidden="true"></i>
<br>
<span id="price1"> <?php echo "Uploaded on ".$timeOfUploads?> </span>
</p>

</div>
</div>



<?php }
}
else {echo"<p>Search Not Found.</p>";}




// end of isset function

}


// ...................................else of not isset....for preview images before the user makes a search....................................

if($countCheck==0){ 
         $timeOfUploads=$row["uploaded_on"];
$query = $conn->query("SELECT p.image_name,p.productTitle,p.uploaded_on,p.productDescription,f.Farmer_Id FROM `productTable` 
AS p,farmersTb AS f
WHERE p.Farmer_Id=f.Farmer_Id AND 
imageNumCount=1
-- AND productTitle
LIMIT 50
");

if($query->num_rows > 0){
$flag=True;
    while($row = $query->fetch_assoc()){
        $imageURL = 'farmerOperations/uploads/'.$row["image_name"];
        $productDetails= $row["productTitle"];
         $fid= $row["Farmer_Id"];
         $timeOfUploads=$row["uploaded_on"];
         $productsDescription= $row["productDescription"];
         $_SESSION["images"]=$imageURL;
        

?>

<div class="wraapper">

<div class="food1">
<h1 class="addtocart">
<button ><a href="productsDescription.php?fID=<?php echo $fid?>&ProductTitle=<?php echo $productDetails?>&productsDescription=<?php echo $productsDescription?>" > <?php echo $productDetails; ?></a></button>
</h1>
 <img src="<?php  echo $imageURL?>" class="card-img-top" alt=""/> 
<p class="price">
<span id="cart1"> <?php echo $productsDescription ?></span> <br>
<i class="fa fa-star star" aria-hidden="true"></i>
<i class="fa fa-star star" aria-hidden="true"></i>
<i class="fa fa-star star" aria-hidden="true"></i>
<i class="fa fa-star star" aria-hidden="true"></i>
<i class="fa fa-star-o star" aria-hidden="true"></i>
<br>
<span id="price1"> <?php echo "Uploaded on ".$timeOfUploads?> </span>
</p>

</div>




</div>


<?php      }
}
else{?>
 <p>No produces Yet</p>
 <?php
 }
?>

<!-- for the else of not isset -->
<?php
}      
?>
</div>

<!-- </div> -->
<div id="justImage">
<p>Want to Report A Fraudulent Seller?</p>
<p> Make your complaints In the section Below..includeing the Email address</p>

</div>
<footer>

<form method="POST" id="form"> 
<label>
Make A Complaint
<textarea  placeholder="Leave a comment here" id="messBox" name="Cmessage" required></textarea>
<label>
<input type="submit" Value="Send" name="send" onclick="sendMail()">
</form>
<p id="resultMessage"></p>
<!-- <?php echo $message;?> -->
</footer>
<!-- <?php echo $_POST["Cmessage"]?> -->
  <script>
//           var formd = document.getElementById("form");
// formd.onsubmit= (event) =>{ event.preventDefault(); }
           function sendMail() {
           
                // alert("yes");
                // var message=document.getElementById("mess").value();
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("resultMessage").innerHTML = this.responseText;
                       
                      }
                    };
                    xmlhttp.open("GET","MailSender.php?messagereport=<?php echo $message?>&user=<?php echo $user?>",true);

                    xmlhttp.send();
// <?php echo $message=" ";?>
                    // if(xmlhttp.send()){document.getElementById("messBox").innerHTML =" "; }
                  
                }
                        
           </script>
</body> 
</html>
