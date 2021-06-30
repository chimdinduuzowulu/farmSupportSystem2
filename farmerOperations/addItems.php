<?php 
error_reporting (E_ALL ^ E_NOTICE); 
 session_start();
$emailId=$_SESSION["addItems"];
$uploaderName=$_SESSION["userName"] ;
$farmerid=$_SESSION["farmerId"];

// $uploadCount=0;
$total=0;
// goBack isset
if(isset($_POST['goBack'])){ 
header('location: ../dashboard.php');

}

// upload items isset

if(isset($_POST['submit'])){ 

// $image_count=0;
    // Include the database configuration file 
    include_once "../connect.php";
    $productTittle=$_POST["productTitle"];
    $productDescription=$_POST["productDescription"];
     
    // File upload configuration 
    $targetDir = "uploads/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 

     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType =$uploadFile= ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    $imgaefiles=array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
          if(count($fileNames) > 6){

          $statusMsg = 'Images cant exceed 6....'; 
          
          }


          else {
         $imageNumCount=1;
          foreach($_FILES['files']['name'] as $key=>$val){ 
         
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             

            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                $count="";
                $sqlqr = $conn->query("SELECT MAX(uploadCount) AS totalUploads FROM farmersTb
                WHERE Farmer_Id='$farmerid'");
                            // $result=mysqli_query($conn, $sqlqr);
                            if ($sqlqr) {
                            
                            // output data of each row  
                            // $image_countCheck=0;
                            while($row =$sqlqr->fetch_assoc()) {
                            $total=$row["totalUploads"];
                            $total=intval($total);
                            
                            }
                            }
               
                
                    // Image db insert sql 
                    
                    $insertValuesSQL .= "('".$productTittle."','".$productDescription."','".$fileName."','".$imageNumCount."','".$farmerid."', NOW()),";
                    // echo $insertValuesSQL;
                    $imageNumCount++;
                    

                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
        

        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            

            $insert = $conn->query("INSERT INTO productTable (productTitle,productDescription,image_name,imageNumCount,Farmer_Id,uploaded_on) VALUES $insertValuesSQL"); 
              if($insert){ 
              
              $image_countIncrement=0;
              $uploadCount=$total+1;
              echo $uploadCount;
              $updateQuery=$conn->query("UPDATE farmersTb
                SET uploadCount ='$uploadCount'
                WHERE Farmer_Id= '$farmerid'");
                // $returnResult= mysqli_query($conn,$updateQuery);
                if($updateQuery){
               
                
                
                
                }
                // ELSE IF $returnResult IS NOT tRUE...
                else{$SaveMessage="Slight Error occured: **";echo "bad thing";}

            //   $uploadCount+=$insertCount;
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
     
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 



          }

            
        } 

               # end of the file processing operation...

        
    }
    else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
     
    // Display status message 
    echo $statusMsg; 
}
?>

<!DOCTYPE html>  
 <html>  
      <head>  
           <title>FSS| newUpload</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  


           <style>
           body{background-image:url(../images/addItems.jpeg);background-attachment:fixed;background-size:cover;background-position:center;font-weight:lighter;}
           .container{width:70%;margin:auto;text-align:center;height:auto;background-color:rgba(0,0,0,0.70);transform:translateY(60px)}
           .container form{
           width:100%;height:600px;
           
           }
           .container form input,textarea{
           font-size:18px;line-height:43px;
           width:80%;margin:auto;border:none;outline:!important none;border-radius:5px;height:50px;margin-top:20px;margin-bottom:20px;color:black;
           
           }
           #submit,#backbtn{width:20%;height:42px;font-size:18px;color:white;text-align:center;}
           #submit{line-height:2px}
           </style>
      </head>  
      <body>  
<div class="container" style="width:40%;height:auto;margin:auto;">  
                <h3 align="center" style="color:white;">upload New products</h3>  
                <br />  
<form action="" method="post" enctype="multipart/form-data">
<label style="color:white;">What's the product you want to sell?(like Yam, Beans ..)
<input type="text" name="productTitle" id="title" /> </label>
<br>
<label style="color:white;">Add a little description of how you quantify and sell the produce:
<textarea name="productDescription" id="" cols="30" rows="10"></textarea>

</label><br><br>

    <input type="file" name="files[]" multiple style="color:white;" >
    <br />   <br />  
    <input type="submit" name="submit" id="submit" value="UPLOAD" class="btn btn-primary" /> 
    <a href="goBack.php" class="w3-bar-item w3-button w3-padding btn btn-primary" id="backbtn">Go Back</a><br><br>
    
</form>
</div>

</body>  
 </html>  
