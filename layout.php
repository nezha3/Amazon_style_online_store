<?php

/************************************************
File:		  index.php
Author:		Oliver Chi
Purpose:	HTML Section for header and footer
**************************************************/

$header = <<<HTML
<!doctype HTML public>
<html>
<head>
	<title>my bear can fly</title>
	<!-- icon -->
  <link rel="icon" type="image/png" href="assets/media/img/icon.png"><!-- my bear -->
	<!-- css -->
	<link rel='stylesheet' type='text/css' href='assets/css/gui.css' />
</head>
<body>
	<div id="header">
		<div id="slogan">
			<h2>Welcome to AmazonBear.com</h2><!-- slogan -->
		</div>
		<div id="navbar"><!-- navigation bar -->
		  <a href="#">Home</a>
		  <a href="#">Shop by</a>
		  <a href="#">Sell</a>
			<a href="#" style="float:right">Cart</a>
			<a href="#" style="float:right">Your Account</a>
		</div>
	</div><!-- End header-->
	<div id="content">
HTML;

$footer = <<<HTML
	</div><!-- End content-->
	<div id="footer">
		<div id="top">
			<a href="#header">Back to top</a>
		</div>
		<div id="bottom">
			<a href="#">Conditions of Use & Sale</a>
			<a href="#">Privacy Notice</a>
			<a href="#">Cookies & Internet Advertising</a>
			<span>© 1996-2018, AmazonBear.com, Inc. or its affiliates</span>
		</div>
	</div><!-- End footer-->
</body>
</html>
HTML;

?>
