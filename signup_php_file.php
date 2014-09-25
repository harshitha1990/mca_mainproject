<?php
	include_once "Database.php";
	$db=new Database();

	$str1="select deptno from mainproject.department where deptname='".$_POST['dept']."'";
	$res1=$db->selectQuery($str1);
	if($res1!="avail")
	{
		$str="insert into mainproject.employee(empno,empname,username,password,role,deptno) values ('".$_POST['eid']."','".$_POST	['ename']."','".$_POST['eusername']."','".$_POST['epassword']."','".$_POST['role']."',".$res1[0].")";
		$res=$db->query($str);
		echo "Username Created " .$res;
	}
	else
		echo "Insertion Problem";

?>	
