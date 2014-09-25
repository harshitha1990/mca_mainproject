<?php
	session_start();
	include_once "Database.php";
	$db=new Database();
	$str="select eventname,title,place,adate,type,category,attended_presented,aid from mainproject.activities where username='".$_SESSION['username']."'  order by adate desc";
	$res=$db->report_individual($str);
	echo $res;
?>
