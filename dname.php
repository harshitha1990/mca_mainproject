<?php
	session_start();
	include_once "Database.php";
	$str="select deptname from mainproject.department where deptno in (select deptno from mainproject.employee where username='".$_SESSION['username']."')";
	$db=new database();
	$res=$db->selectQuery($str);
	echo $res[0];
	
?>
