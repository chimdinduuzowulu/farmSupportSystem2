<?php
include "connect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'vendor2/autoload.php'; 
// $message="";
$contact_message = isset($_GET['messagereport']) ? strval($_GET['messagereport']) : null; 
$complainer = isset($_GET['user']) ? strval($_GET['user']) : null; 

$mail = new PHPMailer;
$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->isSMTP(); 
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure =PHPMailer::ENCRYPTION_STARTTLS; ; // ssl is deprecated
$mail->SMTPAuth = true;
$mail->Username = 'chimdindu73@gmail.com'; // email
$mail->Password = 'chimdindu7309030428141'; // password
$mail->setFrom("chimdindu73@gmail.com" ,"chimdindu"); // From email and name
$mail->addAddress('chimdindu73@gmail.com', 'chimdindu'); // to email and name
// $mail->addReplyTo($email,$contact_fname);
$mail->isHTML(true);
$mail->Subject = 'Complaint submission: '.$contact_message;
$mail->Body='<p align=center font-family=fantasy;line-height=45.8px;> Message: '.$contact_message.' <br> By: '.$complainer.'</p>';
// $mail->msgHTML("Signup Happened"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
if(!$mail->send()){
    echo "Complaint Not Sent:";
}else{
   
   $sql=$conn->query("SELECT MessageNotice FROM AdminTable
    WHERE Admin_Id =1");

    if($sql){
    while($row=$sql->fetch_assoc()){
    $message=$row["MessageNotice"];
    
    }
    
    } 
$message++;

    $query=$conn->query("UPDATE AdminTable
    SET MessageNotice ='$message' WHERE Admin_Id=1");
    // $resultq=mysqli_query($conn,$query);
    if($query){echo "Message sent!";}
     





}

// $upload_details="INSERT INTO contact_us (CONTACT_FNAME,CONTACT_LNAME ,CONTACT_EMAIL,CONTACT_MESSAGE) VALUES ('$contact_fname','$contact_lname','$email','$contact_message')";     
            
            // if ($con->query($upload_details)===TRUE){
                        // echo ("");
                    //   }
                    //   else{$con->error;}

?>