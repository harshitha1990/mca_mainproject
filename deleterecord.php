<?php
	include_once "Database.php";
	$db=new Database();
	if(strpos($_POST['id'],'j')===0)
	{
		$str="delete from mainproject.journal where jid=".substr($_POST['id'],1);
	}
	else
	{
		$str="delete from mainproject.activities where aid=".$_POST['id'];
	}
	$res=$db->query($str);
	echo "Deletion ".$res;
?>
