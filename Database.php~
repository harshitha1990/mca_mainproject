<?php
session_start();
class Database{
	private $host;
	private $dbusername;
	private $dbpassword;
	private $dbname;
	private $con;
	
	public function __construct()
	{
		$this->host="127.0.0.1";
		$this->dbusername="root";
		$this->dbpassword="";
		$this->dbname="mainproject";
		$this->con=mysql_connect($this->host,$this->dbusername,$this->dbpassword,$db->dbname);
		if(!$this->con)
		{
			echo "Error in connection";
		}
	}
		
	public function selectQuery($str)
	{
		$result=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$values=mysql_fetch_array($result);
		if($values==null)
			return "avail";
		else
			return $values;
	}

	public function query($str)
	{
		mysql_query($str,$this->con);
		$x=mysql_affected_rows();
		if($x>0)
		{
			return "Successful";
		}
		else
		{
			return "Failed";
		}
	}

	public function __destruct(){
		mysql_close($this->con);
	}	
}
?>

