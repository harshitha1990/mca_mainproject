<?php
	include_once "Database.php";
	$db=new Database();
	$result=$db->selectQuery("select username from mainproject.employee where username='".$_POST['eusername']."'");
	if($result!="avail")
	{
		echo "Sorry.Username not available.Please select another username.";
	}
	else
	{
		echo "Available";
	}
?>
