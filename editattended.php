<?php
	include_once "Database.php";
	$db=new Database();
	if(strpos($_GET['aid'],'a')===0)
	{
		$str="select eventname,adate,tdate,place,type,category from mainproject.activities where aid=".substr($_GET['aid'],1);
		$res=$db->selectQuery($str);
		$arr=array();	
		$arr[]=array('ename'=>$res[0],'adate'=>$res[1],'tdate'=>$res[2],'place'=>$res[3],'type'=>$res[4],'category'=>$res[5]);
		echo json_encode($arr);
	}
	else if(strpos($_GET['aid'],'p')===0)
	{
		$str="select eventname,adate,tdate,place,type,category,title from mainproject.activities where aid=".substr($_GET['aid'],1);
		$res=$db->selectQuery($str);
		$arr=array();	
		$arr[]=array('ename'=>$res[0],'adate'=>$res[1],'tdate'=>$res[2],'place'=>$res[3],'type'=>$res[4],'category'=>$res[5],'title'=>$res[6]);

		echo json_encode($arr);
	}
	else
	{
		$str="select title,jdate,jname,impactfactor from mainproject.journal where jid=".substr($_GET['aid'],1);
		$res=$db->selectQuery($str);
		$arr=array();	
		$arr[]=array('title'=>$res[0],'jdate'=>$res[1],'jname'=>$res[2],'impactfactor'=>$res[3]);
		echo json_encode($arr);	
	}
	
?>
