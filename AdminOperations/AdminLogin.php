<?php 
error_reporting (E_ALL ^ E_NOTICE); 
session_start();
include "../connect.php";
$flag=0;
$passError=$UserNameError="";
if(isset($_POST["login"])){
$username=dataSecure($_POST["UserName"]);;
$password=dataSecure($_POST["password"]);
$sql="SELECT * FROM AdminTable";
$result=mysqli_query($conn,$sql);
if($result==TRUE){
while($row =$result->fetch_assoc()) {
      if(!empty($username) && !empty($password) && $row["AdminUserName"]==$username && $row["AdminPassword"]==$password){
        $passError=$UserNameError="";
          $user=$row["AdminUserName"];
        $_SESSION["userName"] = $user;
        $flag=1;
        header("location: adminDashboard.php");
        
            }
        }

}


if($flag==0){
$passError=$UserNameError="Login Error";


}
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="shortcut icon" href="../images/faviconimage.png" type="image/x-icon">
    <script
      src="https://kit.fontawesome.com/439a1fb029.js"
      crossorigin="anonymous"
    ></script>
     <title>Admin | Login</title>
    <link rel="stylesheet" href="adminCss/adminLogin2.css">

</head>
<body>

<!-- ......................CAONTACT US................. -->
<div class="contactimage jumbotron-fluid">
<!-- <button type="button" class="btn btn-secondary" id="btn1" >></button> -->
<h2>LOGIN</h2>
<!-- <button type="button" class="btn btn-secondary" id="btn2" >></button> -->
</div>
<!-- ..............................contact form container.............................. -->
<div class="contactForm jumbotron-fluid">
<div class="contactmessage">
<p style="color: rgb(221, 180, 46);"> -- Login -- </p>
<p class="line"> ________________________________ </p>
<h2>
      Admin Login
</h2>
<p class="line"> ________________________________</p>
</div>
<form action="" method="POST" autocomplete=off>
<!-- Username: -->
<input type="text" name="UserName" id="" placeholder="UserName"> <br><br>
<span style="color:red;font-size:21px;"> <?php echo $UserNameError?></span>
<!-- <label for="tel" id="phonelabel">Phone</label>
<input type="tel" name="PhoneNumber" id="" required placeholder="+234(099908480)"> -->
<!-- password: <br> -->
<input type="password" name="password" id=""  placeholder="Password"> <br><br>
<span style="color:red;font-size:21px;"> <?php echo  $passError?></span>
<input type="submit" value="Login" name="login" id="submit" > 
</form>
</div>
<span id="messageReceived"></span>

<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
</body>
</html>