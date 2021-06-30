<?php
error_reporting (E_ALL ^ E_NOTICE); 
session_start();
include "farmsupportTables.php";
// Create connection
// $conn = mysqli_connect($serverName, $userName, $password,$database);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$uEmail= $_POST["Email"];
$uP= $_POST["passWord"];
$passError=$UserNameError="";
if (isset($_POST["submit"])){
        $sql = $conn->query("SELECT * FROM clientsTb");
        // $result = mysqli_query($conn, $sql);
        if ($sql) {
        // output data of each row  
        while($row =$sql->fetch_assoc()) {
        if($row["Email"]==$uEmail && $row["passW"]==$uP && $row["confirmPassW"]==$uP){
		$passError=$UserNameError="";
		$fnamehold=$row["FName"];
		$lnamehold=$row["LName"];
		$_SESSION["user"]=$row["Email"];
        $passError=$UserNameError="";
        $_SESSION["userName"] = $fnamehold." ".$lnamehold;
        $_SESSION["Password"] = $uP;
        header("location: home.php");
        
            }
        }
        }$passError=$UserNameError="password or username Error: *"; 

        //
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">

	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!-- beutifying css -->
	<!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->
	<link rel="stylesheet" type="text/css" href="css/login2.css">

<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="">
			<div class="wrap-login100">
				<form class=" validate-form" method="POST">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-24 p-t-27">
						LogIn as Buyer
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="Email" placeholder="Email:" value="<?php echo $uEmail?>"  required>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="passWord" placeholder="Password" value="<?php echo $uP?>" required>
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
						<br><br>
						<p style="color:red; font-size:18px;text-align:center;" ><?php echo $passError?></p>
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn" style="color: : white">
						<input type="submit" name="submit" class="login100-form-btn">
					
					</div>
					
					<div class="text-center p-t-90">
						<a href="register/register.php" class="txt1" href="register/register.php">
							New User?<br>
						</a>
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
<!-- register as seller or farmer -->
						<div class="text-center p-t-90">
						<a href="farmerLogin.php" class="txt1">
							Login/signup as a Farmer<br>
						</a>
						
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>