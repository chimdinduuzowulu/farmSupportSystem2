<?php
// if(!isset($_SESSION["userName"])){
// header("location:farmerLogin.php");

// }
error_reporting (E_ALL ^ E_NOTICE); 

session_start();
include "connect.php";
$totalUploads=0;
$totalDeleted=0;
$mostSearched=0;
$mostSearchedProduct="";
$mostSearchedProductValue=0;
$mostViewValue=0;
$farmerid=$_SESSION["farmerId"];
$_SESSION["farmerId"];

// Echo session variables that were set on previous page
echo "WELCOME " . $_SESSION["userName"] . ".<br>";
echo $_SESSION["addItems"].".<br>";
$emailId=$_SESSION["addItems"];
// echo $emailId;
$sql = "SELECT MAX(uploadCount)AS totalUploads,TotalDeleted AS DeletedOnes FROM farmersTb WHERE Email='$emailId'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row  
        while($row = mysqli_fetch_assoc($result)) {
		  $total=$row["totalUploads"];
      $totalDeleted=$row["DeletedOnes"];
	   $totalUploads=$total;
        }
        }

 $sql4 = "SELECT MAX(searchValue)AS MaxSearchedValue
         FROM productTable";
         $result3 = mysqli_query($conn, $sql4);
         if (mysqli_num_rows($result3) > 0) {
          while($row = mysqli_fetch_assoc($result3)) {
            // $mostSearchedProduct=$row["title"];
            $mostSearchedProductValue=$row["MaxSearchedValue"];
            // $mostViewValue=$row["viewMaxVal"];
        }
        
        } 
     $sql5 = "SELECT productTitle  AS MaxSearchedProduct
         FROM productTable WHERE  searchValue='$mostSearchedProductValue'";
         $result4 = mysqli_query($conn, $sql5);
         if (mysqli_num_rows($result4) > 0) {
          while($row = mysqli_fetch_assoc($result4)) {
            // $mostSearchedProduct=$row["title"];
            $mostSearchedProduct=$row["MaxSearchedProduct"];
            // $mostViewValue=$row["viewMaxVal"];
        }
        
        } 
        $sql6 =$conn->query( "SELECT MAX(viewValue)  AS maxviewed
         FROM productTable WHERE  Farmer_Id='$farmerid'");
        //  $result5 = mysqli_query($conn, $sql6);
         if ($sql6) {
          while($row = $sql6->fetch_assoc()) {
            // $mostSearchedProduct=$row["title"];
            $mostViewValue=$row["maxviewed"];
            // $mostViewValue=$row["viewMaxVal"];
        }
        
        } 




      

if(isset($_POST["submit"])){   
// // remove all session variables
session_unset();
// destroy the session
session_destroy();
header("location: index.php");
}
// profile image..................
  $upadateProfile=$conn->query("SELECT * FROM farmersTb WHERE Farmer_Id='$farmerid'");
        if($upadateProfile ->num_rows > 0){
        while($row=$upadateProfile -> fetch_assoc()){
                // echo "<script>alert(hey oka);</script>";
                $profileImage = 'farmerOperations/ProfileUpload/'.$row["profileImage"];
                
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
<link rel="stylesheet" href="css/dashboard.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<link rel="stylesheet" href="css/dash2.css">
</head>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right"><a href="home.php" class="w3-bar-item w3-padding"><i class="fas fa-home fa-fw"></i></a></span>

</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="<?php echo $profileImage ?>" class="w3-circle w3-margin-right" style="width:56px;height:56px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong><?php echo $_SESSION["userName"]?></strong></span><br><br>
      <span><strong><?php echo $_SESSION["addItems"]?></strong></span><br>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="farmerOperations/Fprofile.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="farmerOperations/settings.php" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="home.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-home fa-fw"></i>  Home </a>
    <a href="farmerOperations/addItems.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-plus fa-fw"></i> Add new item</a>
    <a href="farmerOperations/MyProducts.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i> My Products</a>
    <!-- <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-search fa-fw"></i>  Search item</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-in fa-fw"></i>  Incoming items</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-out fa-fw"></i>  Outgoing items</a> -->
    <!-- <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-trash fa-fw"></i>  Deleted Items</a> -->
    <!-- <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-paper fa-fw"></i> Requests </a> -->
    <a href="farmerOperations/Fprofile.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw"></i>  Profile</a>
    <a href="farmerOperations/settings.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Logout</a><br><br>
  </div>
</nav>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fas fa-file-upload w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $totalUploads?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>TOTAL UPLOADS</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo  $mostViewValue  ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>VIEWS</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $mostSearchedProduct?>(<?php echo $mostSearchedProductValue?>)</h3>
          <!-- <h3></h3> -->
        </div>
        <div class="w3-clear"></div>
        <h4>MOST SEARCHED</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $totalDeleted?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total Deletes</h4>
      </div>
    </div>
  </div>
  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
        <!-- <h5>Regions</h5> -->
        <img src="images/image4.jpeg" style="width:100%" alt="Google Regional Map">
      </div>
      <div class="w3-twothird">
        <h5>Feeds</h5>
        <table class="w3-table w3-striped w3-white">
          <tr>
            <td><i class="fa fa-user w3-text-blue w3-large"></i></td>
            <td>New record, over 90 views.</td>
            <td><i>10 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
            <td>Database error.</td>
            <td><i>15 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-users w3-text-yellow w3-large"></i></td>
            <td>New record, over 40 users.</td>
            <td><i>17 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-comment w3-text-red w3-large"></i></td>
            <td>New comments.</td>
            <td><i>25 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bookmark w3-text-blue w3-large"></i></td>
            <td>Check transactions.</td>
            <td><i>28 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-laptop w3-text-red w3-large"></i></td>
            <td>CPU overload.</td>
            <td><i>35 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-share-alt w3-text-green w3-large"></i></td>
            <td>New shares.</td>
            <td><i>39 mins</i></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <!-- .............................. -->

  <hr>
 
  <div class="w3-container w3-dark-grey w3-padding-32">
    <div class="w3-row">
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-green">.</h5>
        <!-- <p>.</p>
        <p>.</p>
        <p>.</p> -->
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-red">.</h5>
        <!-- <p>.</p>
        <p>.</p>
        <p>.</p> -->
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-orange">.</h5>
        <!-- <p>.</p>
        <p>.</p>
        <p>.</p>
        <p>.</p> -->
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <!-- <h4>FOOTER</h4> -->
    <!-- <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p> -->
  </footer>
  <!-- End page content -->
</div>
<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");
// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");
// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}
// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body> 
</html>

