<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">-->
<link href="jqueryui/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script type="text/javascript" src="jquery.js"></script>
<scipt type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="code.js"></script>
<!--<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
<script src="jqueryui/js/jquery-ui-1.10.4.custom.js"></script>
<script>
	$(function(){
		$(".logout").click(function(){
			/*$.post('logout.php');*/
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
	<ul class="nav nav-tabs menu">
	  <li id="attended"><a href="#">Participated</a></li>
	  <li id="presented"><a href="#">Presented</a></li>
	  <li id="journal"><a href="#">Journal</a></li>
	  <li id="report_staff"><a href="#">Report</a></li>
	</ul>
	<div id="content"> 
		
		
	</div>
</body>

</html>
