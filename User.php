<?php
	include_once "Database.php";

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
	

		public function signin()
		{
			$db=new Database();
			$response=$db->selectQuery("select role from mainproject.employee where username='".$this->username."' and password='".$this->password."'");

			
			if($response!="avail") {
				$_SESSION['username']=$this->username;
				echo $response[0];
				
			} else {
				echo "Username and Password are wrong";
			}
		}
		
		
	}
?>
