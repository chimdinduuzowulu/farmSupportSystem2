<?php
error_reporting (E_ALL ^ E_NOTICE); 
include "../farmsupportTables.php";
// Create connection
$conn = mysqli_connect($serverName, $userName, $password,$database);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$fname = $_POST["first_name"];
$lname = $_POST["last_name"];
$Email = $_POST["email"];
$phone = $_POST["phone"];
$passW = $_POST["password"];
$confirmPassW = $_POST["retyped_password"];
$UsedEmail="";
$passwordNoM="";
$flag = false;
if(isset($_POST["submit"]))
{

$checkEmail = "SELECT * FROM clientsTb";
        $result = mysqli_query($conn, $checkEmail);
        if (mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)) {
            if($row["Email"]==$Email){
            $flag=TRUE;
            $UsedEmail="This email already exits...";
            
            }
         
         }
        
        }


if($flag ==false) {

$put = "INSERT INTO clientsTb (FName,LName,Email,phone,passW,confirmPassW)
VALUES('$fname','$lname','$Email','$phone','$passW' ,'$confirmPassW')";
if (mysqli_query($conn, $put)){
$success="Your Account was created successfully";
header("location: ../index.php");
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
    <title>Client Registration </title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title"> All inputs are required <span style="color:red;">*</span></h2>
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
                          <!-- <div class="form-row">
                            <div class="name">Company</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="company" required>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" value='<?php echo $Email?>' required>
                                </div>
                            </div>
                        </div>
						<p style="color:red;font-size:12px;text-align:center;width:40%;height:50px;margin:auto;" ><?php echo $UsedEmail?></p>
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
                                    <p><?$passwordNoM?></p>
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