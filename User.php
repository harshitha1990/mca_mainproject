<?php
session_start();
include "Database.php";

	class User{
		private $username;
		private $password;
		private $role;
		private $empname;
		private $empno;
		private $designation;
				
		public function setUsername($username)
		{
			$this->username=$username;
		}
		
		public function getUsername()
		{
			 return $this->username;
		}
		
		public function setPassword($password)
		{
			$this->password=$password;
		}
		
		public function getPassword()
		{
			return $this->password;
		}
		
		public function setRole($role)
		{
			$this->role=$role;
		}
		
		public function getRole()
		{
			return $this->role;
		}
		
		public function setEmpName($empname)
		{
			$this->empname=$empname;
		}
		
		public function getEmpName()
		{
			return $this->empname;
		}
		
		public function setEmpNo($empno)
		{
			$this->empno=$empno;
		}
		
		public function getEmpNo()
		{
			return $this->empno;
		}

		public function setDesignation($designation)
		{
			$this->empno=$empno;
		}
		
		public function getDesignation()
		{
			return $this->designation;
		}
	
		public function signUp($userRole)
		{
			
			$db=new Database();	
			$result=$db->selectQuery("select username from user where username='".$this->username."'");
			if($result!="avail")
			{
				echo "Sorry.".$this->username ."Username not available.Please select another username.";
			}
			else
			{
				//$dbs=new Database();
				if($userRole=='student')
				{	
					$response1=$db->query("insert into user(username,password,role) values('".$this->username."','".sha1($this->password)."','student')");	
					$response2=$db->query("insert into student(username) values('".$this->username."')");
					if($response1=="Successful" && $response2=="Successful") {
						echo "Username:".$this->username." .Registration Successful\n";
					} else {
						echo "Username:".$this->username." .Registration Failed.Try again\n";
					}
				}
				else if($userRole=='staff')
				{
					$response=$db->query("insert into user(username,password,role) values('".$this->username."','".sha1($this->password)."','staff')");	
					if($response=="Successful") {
						echo "Username:".$this->username." .Registration Successful\n";
					} else {
						echo "Username:".$this->username." .Registration Failed.Try again\n";
					}
				}
				else {
					echo "Please select the role";
				}
			}
		}
		
		/*public function signUp()
		{
			$db=new Database();	
			$result=$db->selectQuery("select username from user where username='".$this->username."'");
			if($result!="avail")
			{
				echo "Sorry.Username not available.Please select another username.";
			}
			else
			{
				$response=$db->query("insert into user(username,password,role) values('".$this->username."','".$this->password."','admin')");	
				
				echo "Registeration ".$response;
			}
		}*/
		
		public function signin()
		{
			$db=new Database();
			$response=$db->selectQuery("select role from employee where username='".$this->username."' and password='".$this->password."'");
			echo $response[0];
			
			if($response[0]!="avail") {
				$_SESSION['username']=$this->username;
			} else {
				echo "Username or Password is wrong";
			}
		}
		
		public function deleteUser()
		{
			$db=new Database();
			$response=$db->query("delete from user where username='".$this->username."'");
			echo  "Account Deletion ".$response;
		}
		
		public function editProfileStudent()
		{
			$db=new Database();
			/*$arr=$db->selectQuery("select * from user u,student s where u.username=s.username and u.username='".$this->username."'");
			$this->firstname=$arr[3];
			$this->lastname=$arr[4];
			$this->gender=$arr[5];
			$this->email=$arr[6];
			$this->mobile=$arr[7];
			$this->course=$arr[9];
			$this->year=/*$arr[10];
			$this->sem=/*$arr[11];*/
			$que="update user u,student s set u.firstname='".$this->firstname."',u.lastname='".$this->lastname."',u.gender='".$this->gender."',u.email='".$this->email."',u.mobile='".$this->mobile."',s.course='".$this->course."',s.year=".$this->year.",s.sem=".$this->sem." where u.username=s.username and u.username='".$this->username."'";
			echo $que;
			$result=$db->query($que);
			echo "Profile Updation ".$result;
		}
		
		public function fillFields()
		{
			$db=new Database();
			$arr=$db->selectQuery("select * from user where username='".$this->username."'");
			$this->firstname=$arr[3];
			$this->lastname=$arr[4];
			$this->gender=$arr[5];
			$this->email=$arr[6];
			$this->mobile=$arr[7];
		
		}
		public function editProfileAdmin()
		{
			$db=new Database();
			$result=$db->query("update user set firstname='".$this->firstname."',lastname='".$this->lastname."',gender='".$this->gender."',email='".$this->email."',mobile='".$this->mobile."' where username='".$this->username."'");
			echo "Profile Updation ".$result;
		}
		
		public function checkPwd($pwd)
		{
			$db=new Database();
			$result=$db->selectQuery("select password from user where username='".$this->username."'");
			return $result[0];
		}
		
		public function toNewPwd($pwd)
		{
			$db=new Database();
			$result=$db->query("update user set password='".$pwd."' where username='".$this->username."'");
			echo "Password Change ".$result;
		}
		
	}
?>
