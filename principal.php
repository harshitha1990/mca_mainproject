<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/bootstrap-responsive.css">
<link rel="stylesheet" href="style.css">
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">-->
<link href="jqueryui/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="code.js"></script>
<!--<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
<script src="jqueryui/js/jquery-ui-1.10.4.custom.js"></script>
<script>
	$(function(){

		 $(".principal_date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			maxDate:0
		});
		$( ".principal_date" ).datepicker( "option", "dateFormat","yy-mm-dd");
		$("#principal_filter").change(function(){
			if($("#principal_filter").val()=='Journal')
			{
				$("#principal_category").val("No Category");
				$("#principal_category").attr('disabled', 'disabled');
			}
			else
			{
				$("#principal_category").val("Category");
				$("#principal_category").removeAttr('disabled');
			}
		});
		$("#principal_department").focus(function(){
			$.post("getdetails.php?seed="+Math.random(),{
				method:'Department'
			},function(data){
				$("#principal_department").html(data);
			});
		});
		$("#principal_staff").focus(function(){
			if($("#principal_department").val()!="Department")
			{
				$.post("getdetails.php?seed="+Math.random(),{
					method:'Staff',
					dept:$("#principal_department").val()
				},function(data){
					$("#principal_staff").html(data);
				});
			}
			else
			{
				alert("Please select Department");
			}
		});
		function operations()
		{
			var fromdate=new Date($("#durationfrom").val());
				var todate=new Date($("#durationto").val());
				if(todate<fromdate)
				{
					alert("To date should be greater than from date");
				}
				else
				{
					if($("#principal_filter").val()=='Journal')
					{
						$.post("getdetails.php?seed="+Math.random(),{
						method:'report',				
						dept:$("#principal_department").val(),
						staff:$("#principal_staff").val(),
						from:$("#durationfrom").val(),
						to:$("#durationto").val(),
						filter:$("#principal_filter").val()
						},function(data){
							$("#reportContainer").html(data);
						});
					}
					else if($("#principal_category").val()=="All")
					{
						var fil=0
						if ($("#principal_filter").val()=="Attended")
							fil=1
						else
							fil=2	
	
						$.post("getdetails.php?seed="+Math.random(),{
						method:'report',				
						dept:$("#principal_department").val(),
						staff:$("#principal_staff").val(),
						category:"all",
						from:$("#durationfrom").val(),
						to:$("#durationto").val(),
						filter:fil
						},function(data){
							$("#reportContainer").html(data);
						});
					}
					else
					{
						var fil=0
						if ($("#principal_filter").val()=="Attended")
							fil=1
						else
							fil=2	
						$.post("getdetails.php?seed="+Math.random(),{
						method:'report',				
						dept:$("#principal_department").val(),
						staff:$("#principal_staff").val(),
						category:$("#principal_category").val(),
						from:$("#durationfrom").val(),
						to:$("#durationto").val(),
						filter:fil
						},function(data){
							$("#reportContainer").html(data);
						});
					}
			}
		
		}
		$("#principalreport").click(function(){
			if(($("#principal_department").val()=="Department") && ($("#principal_staff").val()=="Staff") && ($("#principal_filter").val()=="Filter") && ($("#principal_category").val()=="Category") && ($("#durationfrom").val()=="") && ($("#durationto").val()==""))
			{
				alert("All Fields are mandatory");
			}
			else
			{
			if(($("#principal_department").val()=="Department") || ($("#principal_staff").val()=="Staff") || ($("#principal_filter").val()=="Filter") || ($("#principal_category").val()=="Category") || ($("#durationfrom").val()=="") || ($("#durationto").val()==""))
			{
				error_msg='Please enter';
				
				if($("#principal_department").val()=="Department")
				{
					error_msg=error_msg+" Department";
				}
				if($("#principal_staff").val()=="Staff")
				{
					error_msg=error_msg+" Staff";
				}
				if($("#principal_filter").val()=="Filter")
				{
					error_msg=error_msg+" Filter";
				}
				if($("#principal_category").val()=="Category")
				{
					if($("#principal_filter").val()!="Journal")
					{
						error_msg=error_msg+" Category";
					}
				}
				if($("#durationfrom").val()=="")
				{
					error_msg=error_msg+" fromdate";
				}
				if($("#durationto").val()=="")
				{
					error_msg=error_msg+" todate";
				}
				alert(error_msg);	

			}
			else
			{
				operations();
				}
			}
		});

		
		
		$(".logout").click(function(){
			window.location.href="http://localhost/test/index.html?seed="+Math.random();
		});
	});
</script>
</head>
<body>
<!--<div class="logout" style="width:80px;background-color:black;color:white;position:absolute;right:0px;padding:10px;cursor:pointer"><b>Logout</b></div>-->
<section id="settings_submenu">
		<span class="settings" id="settings_username"><?php echo $_SESSION['username']; ?></span><br/>
		<section id="settings_menu">
			<br/><!--<span class="settings" id="editProfile">Profile</span><br/>--><br/><span class="logout">Logout</span>
		</section>
	</section>
<div id="main">
	<header>
		<img src="banner1.png"></img>
	</header>
	
	<div id="content"> 
		<select id="principal_department">
			<option>Department</option>
		</select>
		<select id="principal_staff">
			<option>Staff</option>
		</select>
		<select id="principal_filter">
			<option>Filter</option>
			<option>Attended</option>
			<option>Presented</option>
			<option>Journal</option>
		</select>
		<select id="principal_category">
			<option>Category</option>
			<option>All</option>
			<option>Seminar</option>
			<option>Workshop</option>
		</select>
		<label>From</label>
		<input type="date" id="durationfrom" class="principal_text principal_date" style="width:200px;" placeholder="YYYY-MM-DD" />
		<label>To</label>
		<input type="date" id="durationto" class="principal_text principal_date" style="width:200px;" placeholder="YYYY-MM-DD"/><br/><br/>
		<button type="button" id="principalreport" style="margin-left:350px">View Report</button>
		<div id="reportContainer">
		</div>
       </div>
</div>
</body>

</html>
