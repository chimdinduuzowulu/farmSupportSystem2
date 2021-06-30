<?php
session_start();
$emailId=$_SESSION["addItems"];
$_SESSION["userName"];
header("location: ../dashboard.php");

?>