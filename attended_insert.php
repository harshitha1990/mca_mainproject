<?php
	session_start();
	include "Activities.php";
	$activities=new Activities();
	$str="insert into mainproject.activities(username,adate,place,type,category,startyear,endyear,attended_presented,eventname) values ('".$_SESSION['username']."','".$_POST['asdate']."','".$_POST['asplace']."','".$_POST['astype']."','".$_POST['ascategory']."','".$_POST['astartyear']."','".$_POST['asendyear']."',1,'".$_POST['aseventname']."')";
	$result=$activities->createAttendedActivity($str);
	echo "Insertion ".$result;
?>
