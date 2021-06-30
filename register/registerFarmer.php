<?php
error_reporting (E_ALL ^ E_NOTICE); 
include "../farmsupportTables.php";
// Create connection
$conn = mysqli_connect($serverName, $userName, $password,$database);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$farmerFId=$stateFid=$lgaFId=0;
$UsedEmail ="";
$passwordNoM="";
$flag = false;
if(isset($_POST["submit"]))
{
$fname = $_POST["first_name"];
$lname = $_POST["last_name"];
$LocalGovt = $_POST["LocalGovt"];
$town = $_POST["Town"];
$state = $_POST["state"];
$Email = $_POST["email"];
$phone = $_POST["phone"];
$passW = $_POST["password"];
$confirmPassW = $_POST["retyped_password"];
// check used email

$checkEmail = "SELECT * FROM farmersTb";
        $result = mysqli_query($conn, $checkEmail);
        if (mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)) {
            if($row["Email"]==$Email){
            $flag=TRUE;
            $UsedEmail="This email already exits...";
            
            }
         }

        }
if($passW !=$confirmPassW){
$passwordNoM="password Does Not Macth!";
$flag=TRUE;

}

if($flag ==false) {

$put = "INSERT INTO farmersTb (FName,LName,Email,phone,passW,confirmPassW)
VALUES('$fname','$lname','$Email','$phone','$passW' ,'$confirmPassW')";
$f=mysqli_query($conn, $put);
// getting the state_id of the registered famer and insert it into state as the foreign key
$farmerId=$conn->query("SELECT Farmer_Id FROM farmersTb WHERE Email='$Email'");
if($farmerId -> num_rows > 0){
while($row=$farmerId->fetch_assoc())
{
$farmerFId=$row["Farmer_Id"];

}

}
// state
$putstate = "INSERT INTO Ustate (stateName,Farmer_Id)
VALUES('$state','$farmerFId')";
$s=mysqli_query($conn, $putstate);
// ....
$stateId=$conn->query("SELECT State_Id FROM Ustate WHERE Farmer_Id='$farmerFId'");
if($stateId -> num_rows > 0){
while($row=$stateId->fetch_assoc())
{
$stateFid=$row["State_Id"];

}

}
$putLocalgovt = "INSERT INTO localGovt (localGovtName,State_Id)
VALUES('$LocalGovt','$stateFid')";
$l=mysqli_query($conn, $putLocalgovt);
// .........
$townId=$conn->query("SELECT LocalGov_Id FROM localGovt WHERE State_Id='$stateFid'");
if($townId -> num_rows > 0){
while($row=$townId->fetch_assoc())
{
$lgaFId=$row["LocalGov_Id"];

}

}

$puttown = "INSERT INTO town (townName,LocalGov_Id)
VALUES('$town','$lgaFId')";
$t=mysqli_query($conn, $puttown);
if ($f && $s && $l && $t){
$success="Your Account was created successfully";
header("location: ../farmerLogin.php");
} 
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);}

}
}


mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <!-- Title Page-->
    <title>Farmer Registration </title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <!-- beutifying css -->
	<link rel="stylesheet" type="text/css" href="../css/login.css">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title" > All inputs are required <span style="color:red;">*</span></h2>
                </div>
                <div class="card-body">

                    <form method="POST">
                        <div class="form-row m-b-55">
                            <div class="name">Name</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="first_name" value='<?php echo $fname?>' required>
                                            <label class="label--desc">first name</label>
                                        </div>
                                    </div>
                            
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="last_name" value='<?php echo $lname?>' required>
                                            <label class="label--desc">last name</label>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" value='<?php echo $Email?>' required>
                                </div>
                            </div>
						<p style="color:red;font-size:12px;text-align:center;width:40%;height:50px;margin:auto;" ><?php echo $UsedEmail?></p>
                        </div>
                        <div class="form-row m-b-55">
                            <div class="name">Phone</div>
                            <div class="value">
                                <div class="row row-refine">
                                    <!-- <div class="col-3">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="area_code">
                                            <label class="label--desc">Area Code</label>
                                        </div>
                                    </div> -->
                                    <div class="col-9">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="phone" value='<?php echo $phone?>' required>
                                            <label class="label--desc">Phone Number</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="form-row">
                            <div class="name">Select State</div>
                            <div class="value">
                                <div class="input-group">
                                <select name="state" id="states" class="input--style-5" value='<?php echo $state?>' required> 
                                 <option value="">Select State...</option>
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
                                    <!-- <input  type="text" name="username" > -->
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Local Govt: ?</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="LocalGovt" value='<?php echo $LocalGovt?>' required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Town: ?</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="Town"  value='<?php echo $town?>' required>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="password" value='<?php echo $passW?>' required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Retype Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="retyped_password" value='<?php echo $confirmPassW?>' required>
                                    <p style="color:red;font-size:9px;"><?php echo $passwordNoM?></p>
                                </div>
                            </div>
                        </div>
                       
                        <div>
                            <button class="btn btn--radius-2 btn--red" name="submit" type="submit">Submit</button>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--red"><?php $success?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->