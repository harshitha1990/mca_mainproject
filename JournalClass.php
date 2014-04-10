<?php
	include_once "Database.php";

	class JournalClass{
		public function createJournal($str)
		{
			$db=new Database();
			$result=$db->query($str);
			echo $result;
		}
	}
?>
