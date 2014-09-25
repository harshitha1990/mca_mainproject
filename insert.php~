<?php
	session_start();
	include "Activities.php";
	include "JournalClass.php";

	if($_POST['method']=='attended' or $_POST['method']=='presented')
	{
		$activities=new Activities();
		if($_POST['method']=='attended')
		{
			$str="insert into mainproject.activities(username,adate,place,type,category,startyear,endyear,attended_presented,eventname,tdate,days) values ('".$_SESSION['username']."','".$_POST['asdate']."','".$_POST['asplace']."','".$_POST['astype']."','".$_POST['ascategory']."','".$_POST['astartyear']."','".$_POST['asendyear']."',1,'".$_POST['aseventname']."','".$_POST['atdate']."',".$_POST['days'].")";
		}
		else
		{
			$str="insert into mainproject.activities(username,adate,place,type,category,startyear,endyear,attended_presented,title,eventname,tdate,days) values ('".$_SESSION['username']."','".$_POST['psdate']."','".$_POST['psplace']."','".$_POST['pstype']."','".$_POST['pscategory']."','".$_POST['pstartyear']."','".$_POST['psendyear']."',2,'".$_POST['pstitle']."','".$_POST['pseventname']."','".$_POST['ptdate']."',".$_POST['days'].")";
		}

		$result=$activities->createActivity($str);
		echo $result." Insertion";
	}
	else
	{
		$journal=new JournalClass();
		$str="insert into mainproject.journal(username,title,academicstartyear,academicendyear,jname,impactfactor,jdate) values ('".$_SESSION['username']."','".$_POST['jstitle']."','".$_POST['jstartyear']."','".$_POST['jsendyear']."','".$_POST['jseventname']."',".$_POST['jsimpactfactor'].",'".$_POST['jsdate']."')";
		$result=$journal->createJournal($str);
		echo $result. "Insertion";
		
	}
		

?>
