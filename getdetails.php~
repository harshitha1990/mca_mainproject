<?php
	include_once "Database.php";
	$db=new Database();
	if($_POST["method"]=="Staff")
	{
		$str="select empname from mainproject.employee where deptno in(select deptno from mainproject.department where deptname='".$_POST['dept']."')";

		$res=$db->getdetails_report("Staff",$str);
		echo $res;

	}
	else if($_POST["method"]=="Department")
	{
		$str="select distinct(deptname) from mainproject.department";
		$db=new Database();
		$res=$db->getdetails_report("Department",$str);
		echo $res;
	}
	else
	{
		if($_POST['staff']=='All')
		{
			$res=$db->generate_reports_staff_category_all($_POST['dept'],$_POST['from'],$_POST['to'],$_POST['category'],$_POST['filter']);
			echo $res;
		}
		else if($_POST['filter']=='Journal')
		{
			$res=$db->reports_journal($_POST['staff'],$_POST['from'],$_POST['to']);
			echo $res;
		}
		else if($_POST['category']=="all")
		{
			
			if($_POST['filter']==1)
			{
				$res=$db->generate_reports_attended_all($_POST['staff'],$_POST['from'],$_POST['to'],$_POST['filter']);
				echo $res;
			}
			if($_POST['filter']==2)
			{	
				$res=$db->generate_reports_presented_all($_POST['staff'],$_POST['from'],$_POST['to'],$_POST['filter']);
				echo $res;
			}
			
		}
		else
		{
			if($_POST['filter']==1)
			{
				$res=$db->generate_reports_attended($_POST['staff'],$_POST['category'],$_POST['from'],$_POST['to'],$_POST['filter']);
				echo $res;
			}
			if($_POST['filter']==2)
			{	
				$res=$db->generate_reports_presented($_POST['staff'],$_POST['category'],$_POST['from'],$_POST['to'],$_POST['filter']);
				echo $res;
			}
			
		}
	}
	
?>
