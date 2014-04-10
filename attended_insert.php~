<?php
	session_start();
	include "Activities.php";
	if($_POST['method']=='attended' or $_POST['method']=='presented')
	{
		$activities=new Activities();
		if($_POST['method']=='attended')
		{
			$str="insert into mainproject.activities(username,adate,place,type,category,startyear,endyear,attended_presented,eventname) values ('".$_SESSION['username']."','".$_POST['asdate']."','".$_POST['asplace']."','".$_POST['astype']."','".$_POST['ascategory']."','".$_POST['astartyear']."','".$_POST['asendyear']."',1,'".$_POST['aseventname']."')";
		}
		else
		{
			$str="insert into mainproject.activities(username,adate,place,type,category,startyear,endyear,attended_presented,title,eventname) values ('".$_SESSION['username']."','".$_POST['asdate']."','".$_POST['asplace']."','".$_POST['astype']."','".$_POST['ascategory']."','".$_POST['astartyear']."','".$_POST['asendyear']."',2,'".$_POST['atitle']."','".$_POST['aseventname']."')";
		}
		$result=$activities->createAttendedActivity($str);
		echo "Insertion ".$result;
	}
?>
