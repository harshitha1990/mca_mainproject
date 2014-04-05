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
		$this->host="localhost";
		$this->dbusername="root";
		$this->dbpassword="harshi";
		$this->dbname="mainproject";
		$this->con=mysql_connect($this->host,$this->dbusername,$this->dbpassword);
		mysql_select_db($this->dbname);
		if(!$this->con)
		{
			echo "Error in connection";
		}
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
	
	public function selectQuery($str)
	{
		$result=mysql_query($str,$this->con);
		$values=mysql_fetch_array($result);
		
		if($values==null)
			return "avail";
		else
			return $values;
			
	}
	
	public function selectQueryList($str)
	{
		$result=mysql_query($str,$this->con);
		if($result==null)
			return "No Subjects";
		else
		{
			$subjects=array();
			while($values=mysql_fetch_array($result))
			{
				$subjects[]=$values[0];
			}
			return $subjects;
		}	
	}
	
	public function selectQueryPerformance($str)
	{
		$result=mysql_query($str,$this->con);
		if($result==null)
			return "Tests Not Attended";
		else
		{
			$subjects=array();
			$i=0;
			while($values=mysql_fetch_array($result))
			{
				$subjects[$i]=(object) array($values[0],($values[1]/$values[2])*100);
				//($values[1]/$values[2])*100;
				$i=$i+1;
			}
			return json_encode($subjects);
		}	
	}
	
	public function selectClassPerformance($str)
	{
		$result=mysql_query($str,$this->con);
		if($result==null)
			return "Tests Not Attended";
		else
		{
			$subjects=array();
			$i=0;
			while($values=mysql_fetch_array($result))
			{
				$subjects[$i]=(object) array($values[0],$values[1]);
				$i=$i+1;
			}
			return json_encode($subjects);
		}	
	}
	
	public function selectQueryJson($str)
	{
		$result=mysql_query($str,$this->con);
		$rowCount=mysql_num_rows($result);
		$arr=array();
		echo "<select id='examDropDown'>";
		if($rowCount!=0)
		{	
			/*echo "<select id='examDropDown'>";*/
			while($values=mysql_fetch_array($result))
			{
				echo "<option>".$values[0]."</option>";
			}
			/*echo "</select>";*/
		}
		else
		{
			echo "<option>No Examcode</option>";
		}
		echo "</select>";
			 
			
	}
	
	public function getSubjectList($str){
		$result=mysql_query($str,$this->con);
		$rowCount=mysql_num_rows($result);
		$subjects=array();
		$dates=array();
		if($rowCount!=0)
		{
			echo "<div id='exams_homepage'>";
			while($values1=mysql_fetch_array($result))
			{
				$subjects[]=$values1[0];				
			}
			for($i=0;$i<sizeof($subjects);$i++)
			{
				echo "<h3>".$subjects[$i]."</h3>";
				echo "<div>";
				echo "<p>";
				echo "<ul>";
				$result2=mysql_query("select distinct(examdate) from exam,questionnaire where questionnaire.examcode=exam.examcode and subject='".$subjects[$i]."' and exam.examdate<CURDATE() and avail=0",$this->con);
				while($values2=mysql_fetch_array($result2))
				{
					echo "<li><a href='http://localhost/test/miniproject/frontend/getquestions.php?subject=".$subjects[$i]."&date=".$values2[0]."' target='_blank'>".$values2[0]."</a></li><br/>";
				}
				echo "</ul>";
				echo "</p>";
				echo "</div>";
			}
			echo "</div>";
		}
		else
		{
			echo "Sorry.No Subjects";
		}
	}
	
	public function printQuestions($str)
	{
		$result=mysql_query($str,$this->con);
		$rowCount=mysql_num_rows($result);
		if($rowCount>0)
		{
			$list=array();
			$row=mysql_fetch_array($result);
			/*$num=current($row);*/
			$num_rows=mysql_num_rows($result);
			$_SESSION['count']=$_SESSION['count']+$num_rows;
		?>
			<!--Marks:<label name="count" id="count"><?php echo $num_rows;?><br/></label>-->
		<?php
			for($i=0;$i<$num_rows;$i++)
			{
				$list[]=$i;
			}	
			$list=$this->swap($list,$num_rows);
			for($i=0;$i<$num_rows;$i++)
			{	
				if(mysql_data_seek($result,$list[$i])==1)
				{
					$row=mysql_fetch_array($result);				
					echo "<fieldset class='question'>";
					echo "<p>".($i+1).". ".$row[1]."</p>";
					echo "<input type='hidden' class='labelhide' id='qid".$row[9].($i+1)."' value='".$row[0]."' />";
					echo "<input type='radio' name='qid".$row[9].($i+1)."' value='a'/>".$row[2];
					echo "<input type='radio' name='qid".$row[9].($i+1)."' value='b'/>".$row[3];
					echo "<input type='radio' name='qid".$row[9].($i+1)."' value='c'/>".$row[4];
					echo "<input type='radio' name='qid".$row[9].($i+1)."' value='d'/>".$row[5];
					echo "</fieldset>";
					echo "<br/>";
				}
					
			}?>
			<!--<button name="ques_submit" id="ques_submit" >Submit</button>-->
			<?php
		}
		else
		{
			return "No Test is Scheduled";
		}
		
		
	}
	
	public function swap($list,$max)
	{
		for($i=0;$i<=floor($max/2);$i++)
		{
			$r1=rand(0,$max-1);
			$r2=rand(0,$max-1);
			$x=$list[$r1];
			$list[$r1]=$list[$r2];
			$list[$r2]=$x;
		}
		return $list;
	}
	
	public function ranks()
	{
		
		$result2=mysql_query(" select * from result,exam where exam.eid=result.eid and exam.avail=1 order by score desc",$this->con);
		$num_rows2=mysql_num_rows($result2);
		$flag=0;
		if($num_rows2>0 )
		{
			$i=1;
			$flag=1;
			while($values=mysql_fetch_array($result2))
			{
				$query="update result set rank=$i where username='$values[0]' and eid=$values[1]";
				mysql_query($query,$this->con);
				$i=$i+1;
			}
		}
		return flag;
	}
	
	public function reports($str)
	{
		$flag=$this->ranks();
		
			
			$result=mysql_query($str,$this->con);
			$num_rows=mysql_num_rows($result);
			if($num_rows>0)
			{
				echo "<p id='five' >Top 5</p>";
				echo "<div class='reports'>";
				echo "<table border='0' cellspacing='0' cellpadding='0'>";
				echo "<tr>";
				echo "<th>USERNAME</th>";
				/*echo "<th>NAME</th>";*/
				echo "<th>SCORE</th>";
				echo "<th>RANK</th>";
				echo "</tr>";
				while($value=mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>".$value[0]."</td>";
					echo "<td>".$value[1]."</td>";
					echo "<td>".$value[2]."</td>";
					/* "<td>".$value[3]."</td>";*/
					echo "</tr>";
				}
				echo "</table>";
				echo "</div>";
			}
		

	}
	
	public function userReports($str)
	{
		$flag=$this->ranks();
		$result=mysql_query($str,$this->con);
		$num_rows=mysql_num_rows($result);
			if($num_rows>0)
			{
				echo "<div class='userReports'>";
				while($value=mysql_fetch_array($result))
				{
					print_r("<p class='res'>You scored <b>".$value[0]."</b> marks and your rank is <b>".$value[1]."</b></p>");
				}
				echo "</div>";
			}
		
		else
		{
			echo "<center><h1>Rank Not Yet Generated</h1><br/><h4>Please Write The Exam</h4><center>";
		}
	}

	public function isExamination($str)
	{
		$result=mysql_query($str,$this->con);
		$num_rows=mysql_num_rows($result);
		if($num_rows>0)
		{
		?>
		<section id="instruction" class="adminforms">
			<h3 id="guidelines">INSTRUCTIONS</h3>
			<p>	
				1)Examination consists of three sections.<br/>
				2)You can start with any section.<br/>
				3)Each Question carries one mark.<br/>
				4)No negitive marking.<br/>
				5)Click submit after you answer all the sections.<br/>
				6)Your examination starts once you click start.<br/>
				<button type="button" id="start">Start</button>
			</p>
	
		</section>
		
		<?php
		}
		else
		{
			echo "<center><h1>No Exam Is Scheduled For Today</h1></center>";
		}
	}
	
	public function __destruct(){
		mysql_close($this->con);
	}	
}
?>

