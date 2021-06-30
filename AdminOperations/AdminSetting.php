<?php
include "../connect.php";
$resultMessage=$profileMessage="";
$userNaneerr=$passErr=$Npass="";
$cpass=$UserName=$cpassErr="";
$profileImage ="";
if(isset($_POST["submit"]))
{
if(empty($_POST["CurrentPassword"])){
    $cpassErr="Must not be empty!";
}
else{
$cpass=test_input($_POST["CurrentPassword"]);
}
if(empty($_POST["NewPassword"])){
    $passErr="Must not be empty!";
}
else{
$Npass=test_input($_POST["NewPassword"]);
}
if(empty($_POST["UserName"])){
    $userNaneerr="Must not be empty!";
}
else{
$UserName=test_input($_POST["UserName"]);
}

// ...>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$query="SELECT * FROM AdminTable";
$check=mysqli_query($conn,$query);
if($check==TRUE){
while($row=$check->fetch_assoc()){
if($row["AdminPassword"]==$cpass){
$sql="UPDATE AdminTable 
SET AdminUserName='$UserName',AdminPassword='$Npass'
";
$result=mysqli_query($conn,$sql);
if($result ===FALSE)
{
$resultMessage="sorry there was an error";
}
else{
$resultMessage="changes saved succesfully";
}

}

}
}   
}

// to avoid sql injection we striped every input and: this would not be executed, because it would be saved as HTML escaped code
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


// ***************************For PassPort************************
 
    
    
?>
<?php
include "../connect.php";
 if(isset($_POST["upload"])){
$profileImage="";
 // File upload configuration 
    $targetDir = "ProfileUpload/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    $fileName = $_FILES['profileImage']['name']; 
    $imgaefile=$_FILES['profileImage']['name'];
    // $fileName = basename($_FILES['profile']['name']); 
    $targetFilePath = $targetDir . $fileName; 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    // to check if the file type is valid from the giving array of extensions
    if(in_array($fileType, $allowTypes)){
    // upload the file to server..............
    move_uploaded_file($_FILES["profileImage"]["tmp_name"],$targetFilePath);
    $insertValuesSQL =$fileName;
    if(!empty($insertValuesSQL)){
    $updateQuery="UPDATE AdminTable
                SET profileImage ='$insertValuesSQL'";
                if(mysqli_query($conn,$updateQuery) ===TRUE){
                $profileMessage="Profile Picture updated";
                
                }
                else{
                $profileMessage="failed to update";
                
                }
                
    
    }
    else{
    echo "<script>alert('Select Image');</script>";
    }

    }
    else{
    $profileMessage="image must be: png,jpeg,gif or jpg";
    }

 }

  $upadateProfile=$conn->query("SELECT * FROM AdminTable WHERE Admin_Id=1");
        if($upadateProfile ->num_rows > 0){
        while($row=$upadateProfile -> fetch_assoc()){
                echo "<script>alert(hey oka);</script>";
                $profileImage = 'ProfileUpload/'.$row["profileImage"];
                
                }
                
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>profile with data and skills - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
.text-secondary input{border:none;outline:!important none;width:100%;margin:auto;height:50px;}
.text-secondary .btn{width:30%;}
.text-secondary input:focus{outline:!important none;border:1px solid white;}
span.error{color:red;font-size:12px;text-align:center;}
    </style>
</head>
<body>
<div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">ADMIN PROFILE</li>
              <button class="btn btn-primary" style="margin-left:12px;"><a href="adminDashboard.php" style="color:white;text-decoration:none;">Dashboard</a> </button>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">

            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                  <?php ?>
                  <img src="<?php echo $profileImage; ?>" alt="Admin image"  class="rounded-circle" width="150" height="150" style="border:1px solid black;">
                  <form method="POST" enctype="multipart/form-data">

                    <input type="file" name="profileImage" value="choose Image" style="height:30px;width:70%;background-color:;color:black;;margin:auto;border-radius:8px;margin:29px;margin-bottom:3px;"> <br><br>
                    <input type="submit" name="upload" value="Change" style="">
                    <div class="mt-3">
                    <form>
                    <span style="color:green;font-size:12px;text-align:center;"><?php echo $profileMessage?></span>
                      <h4>ADMIN</h4>
                      
                      
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
            
                
                  <!-- <hr> -->
                  <form method="POST">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">User Name:<span class="error">*</span></h6>
                      
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <input type="text" placeholder="" name="UserName">
                     <span class="error"><?php echo $userNaneerr;?></span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Current Password:<span class="error">*</span></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="password" placeholder="" name="CurrentPassword">
                      <span class="error"><?php echo $cpassErr;?></span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">New Password<span class="error">*</span></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="password" placeholder="" name="NewPassword">
                      <span class="error"><?php echo $passErr;?></span>
                    </div>
                  </div>
                  <hr>
                  
                  
                  <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 text-secondary">
                        <input type="submit" class="btn btn-primary px-4" name="submit" value="Save Changes">
                    </div>
                </div>
                </form>
                <span style="color:green;font-size:14px;padding:12px;text-align:center;width:100%;"><?php echo $resultMessage?></span>
                </div>
              </div>

             

            </div>
          </div>

        </div>
    </div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>