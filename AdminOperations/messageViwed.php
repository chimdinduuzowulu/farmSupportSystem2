<?php
include "../connect.php";
// function messageRead(){

$sql2=$conn->query("UPDATE AdminTable SET  MessageNotice=0
WHERE Admin_Id=1");
// $result=mysqli_query($conn, $sql2);
if($sql2)
{
header("location: https://mail.google.com/mail/u/0/#inbox");

}

?>


