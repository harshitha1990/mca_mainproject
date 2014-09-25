<?php
	include "User.php";
	$user=new User();
	error_log("--------------------------------------");
	error_log(json_encode($_POST));
	$user->setUserName($_POST['username']);
	$user->setPassword($_POST['password']);
	$user->signin();
?>
