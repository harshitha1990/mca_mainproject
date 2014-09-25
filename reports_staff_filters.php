<?php
	session_start();
	include_once "Database.php";
	$db=new Database();

	if($_POST['filter']=='Journal')
	{
		$res=$db->staff_reports_journal($_SESSION['username'],$_POST['from'],$_POST['to']);
		echo $res;
	}
	else if($_POST['category']=="all")
	{
		
		if($_POST['filter']==1)
		{
			$res=$db->staff_reports_attended_all($_SESSION['username'],$_POST['from'],$_POST['to'],$_POST['filter']);
			echo $res;
		}
		if($_POST['filter']==2)
		{	
			$res=$db->staff_reports_presented_all($_SESSION['username'],$_POST['from'],$_POST['to'],$_POST['filter']);
			echo $res;
		}
		
	}
	else
	{
		if($_POST['filter']==1)
		{
			$res=$db->staff_reports_attended($_SESSION['username'],$_POST['category'],$_POST['from'],$_POST['to'],$_POST['filter']);
			echo $res;
		}
		if($_POST['filter']==2)
		{	
			$res=$db->staff_reports_presented($_SESSION['username'],$_POST['category'],$_POST['from'],$_POST['to'],$_POST['filter']);
			echo $res;
		}
	}	
		
?>
