<div>
	<select id="department">
		<option>Department</option>
	</select><br/>
	<select id="role">
		<option>Role</option>
		<option>principal</option>
		<option>hod</option>
		<option>staff</option>
	</select><br/>
	<label>Employee id</label><br/>
	<input type="text" id="signup_employee"><br/>
	<label>Name</label><br/>
	<input type="text" id="signup_name" /><br/>
	<label>Username</label>	<label id="admin_error_username">&nbsp;&nbsp;&nbsp;</label><br/>
	<input type="text" id="signup_username" />
	<label>Password</label><br/>
	<input type="password" id="signup_password" style="width:100%;"/><br/>
	<label>Re-enter Password</label><label id="admin_error_renter">&nbsp;&nbsp;&nbsp;</label><br/>
	<input type="password" id="signup_renter_password" style="width:100%;"><br/><br/>
	<button type="button" id="signup_button" style="margin-left:350px;">Sign Up</button> 
	
</div>
<script>
	function validatePassword(pass1,pass2){
		if(pass1 == pass2)
			return true;
		else
			return false;
	}

	$(function(){
		$("#department").focus(function(){
			$.post("getdetails.php?seed="+Math.random(),{
				method:'Department'
			},function(data){
				$("#department").html(data);
			});
		});

		$("#signup_username").blur(function(){
			$.post("usernamecheck.php?seed="+Math.random(),{
				eusername:$("#signup_username").val()
				},function(data){
					alert(data);
				});
		});
		$("#signup_button").click(function(){
			$.post("signup_php_file.php?seed="+Math.random(),{
				dept:$("#department").val(),
				role:$("#role").val(),
				eid:$("#signup_employee").val(),
				ename:$("#signup_name").val(),
				eusername:$("#signup_username").val(),
				epassword:$("#signup_password").val()
			},function(data){
				if(data.trim()=="Username Created Successful")
				{
					alert(data);
					window.location.href="http://localhost/test/index.html?seed="+Math.random();
				}
				else
				{
					alert(data);
				}
			});
		});

		$("#signup_renter_password").blur(function(){
			var pass1=$("#signup_password").val();
			var pass2=$("#signup_renter_password").val();
			if(!validatePassword(pass1,pass2))
			{
				$(":password").val("");
				$("#admin_error_renter").html("&nbsp;&nbsp;&nbsp;Passwords doesnot match.");
				
			}
			else
				$("#admin_error_renter").val("");
		});
		
		$("#reset").click(function(){
			resetFields();
		});
		
		$("#password").focus(function(){
			$("#admin_error_renter").html("");
		});
		
	});
</script>

