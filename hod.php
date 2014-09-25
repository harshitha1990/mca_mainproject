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
		$(".logout").click(function(){
			window.location.href="http://localhost/test/index.html?seed="+Math.random();
		});
	});
</script>
</head>
<body>
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
	<ul class="nav nav-tabs menu">
	  <li id="attended"><a href="#">Participated</a></li>
	  <li id="presented"><a href="#">Presented</a></li>
	  <li id="journal"><a href="#">Journal</a></li>
	  <li id="reports_hod_report"><a href="#">Reports</a></li>
	</ul>
	<div id="content"> 
		
	</div>
</body>

</html>
