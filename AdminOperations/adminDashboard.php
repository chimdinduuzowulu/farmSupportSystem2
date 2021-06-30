<?php
session_start();
if(!isset($_SESSION["userName"])){
header("location:AdminLogin.php");

}

include "../connect.php";
$totalFarmers=$totalClients=$totalMessages=0;
$sql="SELECT COUNT(DISTINCT Email) AS FTOTAL FROM farmersTb";
$result=mysqli_query($conn, $sql);
if($result==TRUE)
{
while($row=$result->fetch_assoc()){
$totalFarmers=$row["FTOTAL"];
}

}
$sql1="SELECT COUNT(DISTINCT Email) AS CTOTAL FROM clientsTb";
$result=mysqli_query($conn, $sql1);
if($result==TRUE)
{
while($row=$result->fetch_assoc()){
$totalClients=$row["CTOTAL"];
}

}
$sql2="SELECT MessageNotice AS MessageTotal FROM AdminTable WHERE Admin_Id=1";
$result=mysqli_query($conn, $sql2);
if($result==TRUE)
{
while($row=$result->fetch_assoc()){
$totalMessages=$row["MessageTotal"];

}

}
 $upadateProfile=$conn->query("SELECT * FROM AdminTable WHERE Admin_Id=1");
        if($upadateProfile){
        while($row=$upadateProfile -> fetch_assoc()){
        $userName =$row["AdminUserName"];
                $profileImage = 'ProfileUpload/'.$row["profileImage"];
                
                 }         }

$Options="";
$MaxValue=0;
$Semail="";



?>

<?php 
if(isset($_POST["send"])){
$Options=$_POST["queryOptions"];
$MaxValue=$_POST["MaxDisplayValue"];
// echo "<script>view();</script>";

}



?>

<!DOCTYPE html>
<html>
<title>Admin | Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/439a1fb029.js" crossorigin="anonymous"></script>
<!-- <script src="javascript/functions.js" crossorigin=""></script> -->
<link rel="stylesheet" href="adminCss/AdminDashboard.css">
<link rel="stylesheet" href="adminCss/dash2.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}

a i:hover{
cursor: pointer;
transform: translateY(3px);transform: scale(1.3);
}
/* #tableCon{visibility:hidden;}
#tableCon2{visibility:hidden;} */

</style>

<!-- <script src="AdminOperations/javascript/functions.js" crossorigin=""></script> -->
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open()"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">Logo</span>
</div>
<br>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse  w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="<?php echo $profileImage;?>" class="w3-circle w3-margin-right" style="width:60px;height:60px;">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong><?php echo $userName ?></strong></span><br>
      <a href="messageViwed.php"  class="w3-bar-item w3-button"><sup style="color:red;font-size:19px;padding:0px;font-weight:lighter;"><?php echo $totalMessages?></sup><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="AdminSetting.php" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container" >
    <h5>Admin Dashboard</h5>
  </div>
  <div class="w3-bar-block" id="adminSidebar">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="#" class="w3-bar-item w3-button w3-padding" onclick="ClearThem()"><i class="fa fa-home fa-fw"></i>  Home </a>
    <!-- <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-plus fa-fw"></i>  -->
    <a href="#" class="w3-bar-item w3-button w3-padding" onclick="viewUsers()"><i class="fa fa-search fa-fw"></i>  Show  Users</a>
    <a href="#" class="w3-bar-item w3-button w3-padding" onclick="searchUsers()"><i class="fa fa-search fa-fw"></i>  Search User</a>
    <a href="AdminSetting.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Logout</a><br><br>
  </div>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" id="wholeContainer" style="margin-left:300px;margin-top:3px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:32px;">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $totalMessages?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>New Messages</h4>
      </div>
    </div>
  
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $totalClients?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total Clients</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $totalFarmers?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total Farmers </h4>
      </div>
    </div>
  </div>

  <div class="w3-container" id="tableCon">
    <h5>Show Users</h5>
    <div class="w3-container" id="queryShow">
    <form id="ViewUser" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <select name="queryOptions" id="states" class="input--style-5"  required> 
                                 <option value=''>View Users Choice</option>
                                    <option value="Farmer">Farmers</option>
                                    <option value="Client">Client</option>
        
      </select>
      <input type="number" name="MaxDisplayValue" required>
      
      <input type="submit" Value="show users" name="send" class="btn btn-primary" id="btnPrimary" onclick="view()">

</form>
    </div>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white table" style="" id="tableAjax">
    

    
    </table>
    <!-- closing of tableAjax -->
  </div>
<!-- tablecontainer two for displaying searched user -->
  <div class="w3-container" id="tableCon2">
    <h5>Find Users</h5>
    <div class="w3-container" id="queryShow2">
    <form method="POST" id="ViewUser2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    
      <input type="email" name="Email" required>
      
      <input type="submit" Value="Search" name="submit" class="btn btn-primary" id="btnPrimary2" onclick="searchUser()">

</form>
    </div>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white table" style="" id="tableAjax2">
    

    
    </table>
    
  </div>

<br>
  <div class="w3-container w3-dark-grey w3-padding-32" style="margin-top:60px;">
    <div class="w3-row">
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-green">Demographic</h5>
        <p>Language</p>
        <p>Country</p>
        <p>City</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-red">System</h5>
        <p>Browser</p>
        <p>OS</p>
        <p>More</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-orange">Target</h5>
        <p>Users</p>
        <p>Active</p>
        <p>Geo</p>
        <p>Interests</p>
      </div>
    </div>
  </div> 
  <!-- Footer -->
  <footer class="w3-container w3-padding-16">
    <h4>FOOTER</h4>
    <p>Powered by <a href="" target="_blank">Farm Support System</a></p>
  </footer>
  <!-- End page content -->
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (!empty($_POST["Email"])){
 $Semail=$_POST["Email"];

}
else{$Semail="";}
}


if ($_SERVER["REQUEST_METHOD"] == "GET") { 
if (!empty($_GET["queryOptions"])){
 $Options=$_GET["queryOptions"];

}
else{$Options="";}

if (!empty($_GET["MaxDisplayValue"])){
 $MaxValue=$_GET["MaxDisplayValue"];

}
else{$MaxValue='';}

}








?>


<script>



// document.getElementById ("btnPrimary").addEventListener ("click",view());
// to stop page refreshing on submit

//     var form = document.getElementById("ViewUser");
// form.onsubmit= (event) =>{ event.preventDefault(); } 
//   var form2 = document.getElementById("ViewUser2");
//   form2.onsubmit= (event) =>{ event.preventDefault(); } 
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

var viewForm = document.getElementById("tableCon");
var searchForm = document.getElementById("tableCon2");
viewForm.style.visibility = 'hidden';
searchForm.style.visibility = 'hidden';
// getting the id of the tables to display the fetched result

var tableAjax = document.getElementById("tableAjax");
var tableAjax2 = document.getElementById("tableAjax2");
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

// to hide the two forms when home is clicked
function ClearThem(){
window.location.reload();

}

// script to show the view users form when show users is clicked
function viewUsers(){
if(viewForm.style.visibility === 'hidden' && searchForm.style.visibility === 'hidden'){
viewForm.style.visibility = 'visible';
}
else if(searchForm.style.visibility === 'visible' && viewForm.style.visibility === 'hidden'){
searchForm.style.visibility = 'hidden';
viewForm.style.visibility = 'visible';
}
else if(viewForm.style.visibility === 'visible' && searchForm.style.visibility === 'hidden'){
viewForm.style.visibility = 'visible';
searchForm.style.visibility = 'hidden';
}
else{

console.log("function called");
}
}
// ...............................
// to search for users 
function searchUsers(){
if(viewForm.style.visibility === 'hidden' && searchForm.style.visibility === 'hidden'){
viewForm.style.visibility ='hidden';
searchForm.style.visibility ='visible';
}
else if(searchForm.style.visibility === 'hidden' && viewForm.style.visibility === 'visible'){
viewForm.style.visibility = 'hidden';
searchForm.style.visibility = 'visible';
}
else if(viewForm.style.visibility === 'hidden' && searchForm.style.visibility === 'visible'){
searchForm.style.visibility = 'visible';
viewForm.style.visibility = 'hidden';
}
else{
searchForm.style.visibility = 'visible';
viewForm.style.visibility = 'hidden';
}
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
// ...............Ajax Request to fetcth the data from ajaxResponse.php and display it.
function view(){
var flag=0;
// var form = new FormData(document.getElementByTagName('form'));
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        tableAjax.innerHTML = this.responseText;
      }
    };
    if(flag==0){
     xmlhttp.open("GET","ajaxResponse.php?Qoption=<?php echo $Options ?>&limitVal=<?php echo $MaxValue?>",true);
     flag=1;
    xmlhttp.send();
    }
    else{
     xmlhttp.open("GET","ajaxResponse.php?Qoption=<?php echo "" ?>&limitVal=<?php echo 0?>",true);
     flag=0;
    // xmlhttp.send();
    
    }
   

  
}

// search for users
function searchUser(){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        tableAjax2.innerHTML = this.responseText;
      }
    };
    
    xmlhttp.open("GET","SearchUsers.php?email=<?php echo $Semail ?>",true);
    xmlhttp.send();
  
    
  
}




</script>
<?php 
// echo "here ".$Semail." ".$Options." and ".$MaxValue;
$Semail=$Options=$MaxValue="";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
