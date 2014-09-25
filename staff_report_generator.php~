<?php
	include_once "Database.php";
	$db=new Database();
	if($_POST['category']=="all")
		{
			$str="select eventname,title,place,adate,type,category,attended_presented from mainproject.activities where username='".$_POST['staff']."' and adate>='".$_POST['from']."' and adate<='".$_POST['to']."' order by attended_presented";
			$res=$db->generate_reports($str);
			echo $res;
		}
		else
		{
			$str="select eventname,title,place,adate,type,category,attended_presented from mainproject.activities where username='".$_POST['staff']."' and category='".$_POST['category']."'and adate>='".$_POST['from']."' and adate<='".$_POST['to']."' order by attended_presented";
			$res=$db->generate_reports($str);
			echo $res;
		}
?>
