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
		$this->con=mysql_connect($this->host,$this->dbusername,$this->dbpassword,$this->dbname);
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
	
	public function getdetails_report($condition,$str)
	{
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		if($res!=null)
		{
			$num_rows=mysql_num_rows($res);
			$html="";
			if($num_rows>0)
			{
				$html="<option>".$condition."</option>";
				if($condition=='Staff')
				{
					$html=$html."<option>All</option>";
				}
				while($values=mysql_fetch_array($res))
				{
					$html=$html."<option>".$values[0]."</option>";
				}
			}
			else
			{
				$html="No ".$condition;
			}
			return $html;
		}
		else
			echo "Problem in loading";
			
	}
	public function generate_reports_attended_all($name,$from,$to,$filter)
	{
		$str="select eventname,place,adate,tdate,days,type,category from mainproject.activities where username='".$name."' and adate>='".$from."' and adate<='".$to."' and attended_presented=".$filter;
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="";

		if($num_rows>0)
		{
			$html="<div class='reports'><table cellspacing='0' cellpadding='0'><tr><th>Event Name</th><th>Place</th><th>From</th><th>To</th><th>Days</th><th>Type</th><th>Category</th></tr>";
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<tr><td>".$values[0]."</td><td>".$values[1]."</td><td>".$values[2]."</td><td>".$values[3]."</td><td>".$values[4]."</td><td>".$values[5]."</td><td>".$values[6]."</td></tr>";

			}
			$html=$html."</table></div>";
		}
		else
		{
			$html="<b>No Results</b>";
		}
		error_log("[[[[".$html."]]]]");
		return $html;
		
	}
	public function generate_reports_attended($name,$category,$from,$to,$filter)
	{
		$str="select eventname,place,adate,tdate,days,type from mainproject.activities where username='".$name."' and category='".$category."'and adate>='".$from."' and adate<='".$to."' and attended_presented=".$filter;
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="";
		if($num_rows>0)
		{
			$html="<div class='reports'><table cellspacing='0' cellpadding='0'><tr><th>Event Name</th><th>Place</th><th>From</th><th>To</th><th>Days</th><th>Type</th></tr>";
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<tr><td>".$values[0]."</td><td>".$values[1]."</td><td>".$values[2]."</td><td>".$values[3]."</td>
<td>".$values[4]."</td><td>".$values[5]."</td></tr>";

			}
			$html=$html."</table></div>";
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;
		
	}

	public function staff_reports_attended($name,$category,$from,$to,$filter)
	{
		$str="select eventname,place,adate,tdate,days,type,aid from mainproject.activities where username='".$name."' and category='".$category."'and adate>='".$from."' and adate<='".$to."' and attended_presented=".$filter;
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="";
		if($num_rows>0)
		{
			$html="<div class='reports'><table cellspacing='0' cellpadding='0'><tr><th>Event Name</th><th>Place</th><th>From</th><th>To</th><th>Days</th><th>Type</th></tr>";
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<tr><td>".$values[0]."</td><td>".$values[1]."</td><td>".$values[2]."</td><td>".$values[3]."</td><td>".$values[4]."</td><td>".$values[5]."</td>";
				$html=$html."<td><button class='deletebutton' id='".$values[6]."' type='button'>Delete</button></td><td><button class='editbutton' id='a".$values[6]."' type='button'>Edit</button></td></tr>";
			}
			$html=$html."</table></div>";
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;
		
	}

	public function staff_reports_attended_all($name,$from,$to,$filter)
	{
		$str="select eventname,place,adate,tdate,days,type,category,aid from mainproject.activities where username='".$name."' and adate>='".$from."' and adate<='".$to."' and attended_presented=".$filter;
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="";

		if($num_rows>0)

		{
			$html="<div class='reports'><table cellspacing='0' cellpadding='0'><tr><th>Event Name</th><th>Place</th><th>From</th><th>To</th><th>Days</th><th>Type</th><th>Category</th></tr>";
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<tr><td>".$values[0]."</td><td>".$values[1]."</td><td>".$values[2]."</td><td>".$values[3]."</td><td>".$values[4]."</td><td>".$values[5]."</td><td>".$values[6]."</td>";
				$html=$html."<td><button class='deletebutton' id='".$values[7]."' type='button'>Delete</button><br/></td><td><button class='editbutton' id='a".$values[7]."' type='button'>Edit</button></td></tr>";

			}
			$html=$html."</table></div>";
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;		
	}

	public function generate_reports_presented_all($name,$from,$to,$filter)
	{
		$str="select eventname,title,place,adate,tdate,days,type,category from mainproject.activities where username='".$name."' and adate>='".$from."' and adate<='".$to."' and attended_presented=".$filter;
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="";
		if($num_rows>0)
		{
			$html="<div class='reports'><table cellspacing='0' cellpadding='0'><tr><th>Event Name</th><th>Title</th><th>Place</th><th>From</th><th>To</th><th>Days</th><th>Type</th><th>Category</th></tr>";
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<tr><td>".$values[0]."</td><td>".$values[1]."</td><td>".$values[2]."</td><td>".$values[3]."</td><td>".$values[4]."</td><td>".$values[5]."</td><td>".$values[6]."</td><td>".$values[7]."</td></tr>";

			}
			$html=$html."</table></div>";
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;
		
	}
	public function generate_reports_presented($name,$category,$from,$to,$filter)
	{
		$str="select eventname,title,place,adate,tdate,days,type from mainproject.activities where username='".$name."' and category='".$category."'and adate>='".$from."' and adate<='".$to."' and attended_presented=".$filter;
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="";
		if($num_rows>0)
		{
			$html="<div class='reports'><table cellspacing='0' cellpadding='0'><tr><th>Event Name</th><th>Title</th><th>Place</th><th>From</th><th>To</th><th>Days</th><th>Type</th></tr>";
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<tr><td>".$values[0]."</td><td>".$values[1]."</td><td>".$values[2]."</td><td>".$values[3]."</td><td>".$values[4]."</td><td>".$values[5]."</td><td>".$values[6]."</td></tr>";

			}
			$html=$html."</table></div>";
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;
		
	}
	
	public function staff_reports_presented($name,$category,$from,$to,$filter)
	{
		$str="select eventname,title,place,adate,tdate,days,type,aid from mainproject.activities where username='".$name."' and category='".$category."'and adate>='".$from."' and adate<='".$to."' and attended_presented=".$filter;
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="";
		if($num_rows>0)
		{
			$html="<div class='reports'><table cellspacing='0' cellpadding='0'><tr><th>Event Name</th><th>Title</th><th>Place</th><th>From</th><th>To</th><th>Days</th><th>Type</th></tr>";
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<tr><td>".$values[0]."</td><td>".$values[1]."</td><td>".$values[2]."</td><td>".$values[3]."</td><td>".$values[4]."</td><td>".$values[5]."</td><td>".$values[6]."</td>";
				$html=$html."<td><button class='deletebutton' id='".$values[7]."' type='button'>Delete</button><br/></td><td><button class='editbutton' id='p".$values[7]."' type='button'>Edit</button></td></tr>";

			}
			$html=$html."</table></div>";
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;
		
	}

	public function staff_reports_presented_all($name,$from,$to,$filter)
	{
		$str="select eventname,title,place,adate,tdate,days,type,category,aid from mainproject.activities where username='".$name."' and adate>='".$from."' and adate<='".$to."' and attended_presented=".$filter;
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="";
		if($num_rows>0)
		{
			$html="<div class='reports'><table cellspacing='0' cellpadding='0'><tr><th>Event Name</th><th>Title</th><th>Place</th><th>From</th><th>To</th><th>Days</th><th>Type</th><th>Category</th></tr>";
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<tr><td>".$values[0]."</td><td>".$values[1]."</td><td>".$values[2]."</td><td>".$values[3]."</td><td>".$values[4]."</td><td>".$values[5]."</td><td>".$values[6]."</td><td>".$values[7]."</td>";
				$html=$html."<td><button class='deletebutton' id='".$values[8]."' type='button'>Delete</button><br/></td><td><button class='editbutton' id='p".$values[8]."' type='button'>Edit</button></td></tr>";

			}
			$html=$html."</table></div>";
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;
		
	}

	public function reports_journal($name,$from,$to)
	{
		$str="select title,jname,impactfactor,jdate from mainproject.journal where username='".$name."' and jdate>='".$from."' and jdate<='".$to."'";
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="";
		if($num_rows>0)
		{
			$html="<div class='reports'><table border='0' cellspacing='0' cellpadding='0'><tr><th>Title</th><th>Journal</th><th>Impact Factor</th><th>Date</th></tr>";
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<tr><td>".$values[0]."</td><td>".$values[1]."</td><td>".$values[2]."</td><td>".$values[3]."</td></tr>";
			
			}
			$html=$html."</table></div>";
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;
	
	}
	public function staff_reports_journal($name,$from,$to)
	{
		$str="select title,jname,impactfactor,jdate,jid from mainproject.journal where username='".$name."' and jdate>='".$from."' and jdate<='".$to."'";
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="";
		if($num_rows>0)
		{
			$html="<div class='reports'><table border='0' cellspacing='0' cellpadding='0'><tr><th>Title</th><th>Journal</th><th>Impact Factor</th><th>Date</th></tr>";
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<tr><td>".$values[0]."</td><td>".$values[1]."</td><td>".$values[2]."</td><td>".$values[3]."</td>";
				$html=$html."<td><button class='deletebutton' id='j".$values[4]."' type='button'>Delete</button><button class='editbutton' id='J".$values[4]."' type='button'>Edit</button></td></tr>";
			
			}
			$html=$html."</table></div>";
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;
	
	}


	public function report_individual($str)
	{
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="<br/><br/>";
		if($num_rows>0)
		{
			$html="<div class='reports'><table cellspacing='0' cellpadding='0'><tr><th>Event Name</th><th><Title</th><th>Place</th><th><Date</th><th>Type</th><th>Category</th><th>Attended/Presented</th><th>Modification</th></tr>";
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<tr><td>".$values[0]."</td><td>".$values[1]."</td><td>".$values[2]."</td><td>".$values[3]."</td><td>".$values[4]."</td><td>".$values[5]."</td>";
				/*if($values[1]!=null)
				{
					$html=$html."<br/>Title:".$values[1];
				}*/
				$a='';
				if($values[6]==1)
					$a='Attended';
				else
					$a='Presented';	
				$html=$html."<td>".$a."</td><td><button class='deletebutton' id='".$values[7]."' type='button'>Delete</button></fieldset><br/></td></tr>";	
				/*$html=$html."<br/><b>Place:</b>".$values[2]."<br/><b>Date:</b>".$values[3]."<br/><b>Type:</b>".$values[4]."<br/><b>Category:</b>".$values[5]."<br/><b>Attended/Presented:</b>".$a." <br/><button class='deletebutton' id='".$values[7]."' type='button'>Delete</button></fieldset><br/>";*/	
				$html=$html."</div></table>";
			}
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;
	}

	public function generate_reports_journal($str)
	{
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="";
		if($num_rows>0)
		{
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<fieldset style='background-color:#DCDCDC;'><b>Title:</b>".$values[0];
	
				$html=$html."<br/><b>Journal:</b>".$values[1]."<br/><b>Impact Factor:</b>".$values[2]."</fieldset>";
			}
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;
		
	}

	public function journal_individual($str)
	{
		$res=mysql_query($str,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res);
		$html="<br/><br/>";
		if($num_rows>0)
		{
			while($values=mysql_fetch_array($res))
			{
				$html=$html."<fieldset style='background-color:#DCDCDC;'><b>Title:</b>".$values[0];
	
				$html=$html."<br/><b>Journal:</b>".$values[1]."<br/><b>Impact Factor:</b>".$values[2]."<button class='deletebutton' id='".$values[3]."' type='button'>Delete</button></fieldset><br/>";	
			}
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;
	}
	
	public function generate_reports_staff_category_all($dept,$from,$to,$category,$filter)
	{
		$names_list="select empno,username from mainproject.employee where deptno in(select deptno from mainproject.department where deptname='".$dept."') and role!='principal'";
		$res1=mysql_query($names_list,$this->con) or die(print_r(mysql_error()));
		$num_rows=mysql_num_rows($res1);
		$html="<br/><br/>";
		if($num_rows>0)
		{
			$html=$html."<table width='100%' border='1'>";
			while($values=mysql_fetch_array($res1))
			{
				/*$html=$html."<tr><td>";
				$html=$html."<center><h4>".$values[0]."<br/>(".$values[1].")</h4></center>";
				$html=$html."</td><td><center>";*/
				if($filter=='Journal')
				{
					$res=$this->reports_journal($values[1],$from,$to);
				}
				else if($category=="all")
				{
			
					if($filter==1)
					{
						$res=$this->generate_reports_attended_all($values[1],$from,$to,$filter);
					}
					if($filter==2)
					{	
						$res=$this->generate_reports_presented_all($values[1],$from,$to,$filter);
					}
			
				}
				else
				{
					if($filter==1)
					{
						$res=$this->generate_reports_attended($values[1],$category,$from,$to,$filter);
					}
					if($filter==2)
					{	
						$res=$this->generate_reports_presented($values[1],$category,$from,$to,$filter);
					}
			
				}
				if($res=="<b>No Results</b>")
				{
				}
				else
				{
					$html=$html."<tr>";
					$html=$html."<td><center><h4>".$values[0]."<br/>(".$values[1].")</h4></center></td>";
					$html=$html."<td>".$res."</td></tr>";
				
				}
			}
			$html=$html."</table>";
	
		}
		else
		{
			$html="<b>No Results</b>";
		}
		return $html;
	}

	public function __destruct(){
		mysql_close($this->con);
	}	
}
?>

