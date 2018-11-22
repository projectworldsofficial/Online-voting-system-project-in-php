<?php
session_start();
include "auth.php";
include "connection.php"; 
if(isset($_POST['cpass'])) {
	$currentpass = md5($_POST['cpassword']) ;
	$newpass = md5($_POST['npassword']);
	$cnewpass = md5($_POST['cnpassword']);
	$currentpass = addslashes($currentpass);
	$newpass = addslashes($newpass);
	$cnewpass = addslashes($cnewpass); 
	$currentpass = mysqli_real_escape_string($con, $currentpass);
	$newpass = mysqli_real_escape_string($con, $newpass);
	$cnewpass = mysqli_real_escape_string($con, $cnewpass);
	
$sql =  mysqli_query($con, 'SELECT password FROM loginusers WHERE username="'.$_SESSION['SESS_NAME'].'" ');
$row = mysqli_fetch_assoc($sql);
$pass = $row['password'];
if ($currentpass != $pass) {
	$error = "<center><h4><font color='#FF0000'>Incorrect Current Password!</h4></center></font>";
	include ("change_pass.php");
}
else if ($currentpass == $pass && $newpass == $cnewpass){
$sql1 = mysqli_query($con, 'UPDATE loginusers SET password="'. md5($_POST['npassword']).'" WHERE username="'.$_SESSION['SESS_NAME'].'" ');
$error = "<center><h4><font color='green'>Password successfully changed!</h4></center></font>";
include ("change_pass.php");
}
else {
	$error = "<center><h4><font color='#FF0000'>New Password and Confirm Password does not match!</h4></center></font>";
	include ("change_pass.php");
}
}
else {
	$error = "<center><h4><font color='#FF0000'>Error!</h4></center></font>";
	include ("change_pass.php");
}
?>