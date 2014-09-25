<?php
	include_once "Database.php";
	$db=new Database();

	if($_POST['method']=='attended')
	{
		$str="update mainproject.activities set eventname='".$_POST['ename']."', adate='".$_POST['adate']."', tdate='".$_POST['tdate']."', type='".$_POST['type']."' , category='".$_POST['category']."',place='".$_POST['place']."',days=".$_POST['days'].",startyear='".$_POST['startyear']."' and endyear='".$_POST['endyear']."' where aid=".substr($_POST['aid'],1);
		$res=$db->query($str);
		echo $res;
	}
	if($_POST['method']=='presented')
	{
		$str="update mainproject.activities set eventname='".$_POST['ename']."', adate='".$_POST['adate']."', tdate='".$_POST['tdate']."', type='".$_POST['type']."' , category='".$_POST['category']."',place='".$_POST['place']."',days=".$_POST['days'].",startyear='".$_POST['startyear']."' and title='".$_POST['title']."' where aid=".substr($_POST['aid'],1);
		$res=$db->query($str);
		echo $res;
	}
	if($_POST['method']=='journal')
	{
		$str="update mainproject.journal set title='".$_POST['jtitle']."', jdate='".$_POST['jdate']."', jname='".$_POST['jname']."', impactfactor=".$_POST['impactfactor']." where jid=".substr($_POST['aid'],1);
		error_log($str);
		$res=$db->query($str);
		echo $res;
	}
?>

