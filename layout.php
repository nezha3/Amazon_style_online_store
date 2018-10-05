<?php

/************************************************
File:		  layout.php
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
	<link rel='stylesheet' type='text/css' href='assets/css/form.css' />
	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<script language = "javascript" type = "text/javascript"><!-- Ajax functions -->
		// Ajax: display books in one category
		function category(num){
			var ajaxRequest = new XMLHttpRequest();
			ajaxRequest.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					$("#rightcolumn .card:first").empty();//empty previous elements
					$("#rightcolumn .card:first").append(this.responseText);//append new elements
				}
			}
			ajaxRequest.open("GET", "books.php?category="+num, true);
			ajaxRequest.send();
		}
		// Ajax: display books by product.id
		function books(id){
			var ajaxRequest = new XMLHttpRequest();
			ajaxRequest.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					$("#content").empty();//empty previous elements
					$("#content").append(this.responseText);//append new elements
				}
			}
			ajaxRequest.open("GET", "books.php?id="+id, true);
			ajaxRequest.send();
		}

		// Ajax: display books in all categories
		function allcategories(){
			var ajaxRequest = new XMLHttpRequest();
			ajaxRequest.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					$("#rightcolumn .card:first").empty();//empty previous elements
					$("#rightcolumn .card:first").append(this.responseText);//append new elements
				}
			}
			ajaxRequest.open("GET", "books.php?row=category", true);
			ajaxRequest.send();
		}

		// Ajax: display books in Bestsellers
		function bestsellers(){
			var ajaxRequest = new XMLHttpRequest();
			ajaxRequest.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					$("#rightcolumn .card:nth-of-type(2)").empty();//empty previous elements
					$("#rightcolumn .card:nth-of-type(2)").append(this.responseText);//append new elements
				}
			}
			ajaxRequest.open("GET", "books.php?row=bestseller", true);
			ajaxRequest.send();
		}

		// Ajax: display books in Hot new releases
		function newreleases(){
			var ajaxRequest = new XMLHttpRequest();
			ajaxRequest.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					$("#rightcolumn .card:nth-of-type(3)").empty();//empty previous elements
					$("#rightcolumn .card:nth-of-type(3)").append(this.responseText);//append new elements
				}
			}
			ajaxRequest.open("GET", "books.php?row=newrelease", true);
			ajaxRequest.send();
		}
		//Homepage: content structure
		function content(){
			var ajaxRequest = new XMLHttpRequest();
			ajaxRequest.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					$("#content").empty();//empty previous elements
					$("#content").append(this.responseText);//append new elements
				}
			}
			ajaxRequest.open("GET", "home.php", true);
			ajaxRequest.send();
		}
		// Home page: content body
		function home(){
			content();
			allcategories();
			//bestseller();
			//newreleases();
		}

		// Check and Get Cookies
		function getCookie(cname) {
		    var name = cname + "=";
		    var decodedCookie = decodeURIComponent(document.cookie);
		    var ca = decodedCookie.split(';');
		    for(var i = 0; i <ca.length; i++) {
		        var c = ca[i];
		        while (c.charAt(0) == ' ') {
		            c = c.substring(1);
		        }
		        if (c.indexOf(name) == 0) {
		            return c.substring(name.length, c.length);
		        }
		    }
		    return "";
		}

		// Set Cookies
		function setCookie(cname, cvalue, exdays) {//parameters: cookie name, cookie value, extra days
		    var d = new Date();
		    d.setTime(d.getTime() + (exdays*24*60*60*1000));
		    var expires = "expires="+ d.toUTCString();
		    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}

		// Load Login page
		function login(){
			if (getCookie("registeruser") == ""){
				var ajaxRequest = new XMLHttpRequest();
				ajaxRequest.onreadystatechange = function(){
					if (this.readyState == 4 && this.status == 200){
						$("#content").empty();//empty previous elements
						$("#content").append(this.responseText);//append new elements
						$("#account").text("New Account");
						$("#account").attr("onclick","register()");
						if (getCookie("page") == "login"){
							$('#loginMsg').css('display', 'block');
						}
					}
				}
				ajaxRequest.open("GET", "user.php?action=login", true);
				ajaxRequest.send();
			} else {
				$("#account").text("Logout Account");
				$("#account").attr("onclick","logout()");
			}
		}

		// Log out account
		function logout(){
			var r = confirm("Confirm: if you want to logout your account?");
			if (r == true) {//go to logout
				if (getCookie("registeruser") != ""){
					var ajaxRequest = new XMLHttpRequest();
					ajaxRequest.onreadystatechange = function(){
						if (this.readyState == 4 && this.status == 200){
							$("#account").text("Your Account");
							$("#account").attr("onclick","login()");
							if(getCookie("registeruser")!=""){
								$("#welcome_msg").empty();
								$("#welcome_msg").text("Welcome, "+getCookie("registeruser"));
							} else {
								$("#welcome_msg").empty();
								$("#welcome_msg").text("Welcome, BookLover");
							}
							window.location = 'index.php';
						}
					}
					ajaxRequest.open("GET", "user.php?action=logout", true);
					ajaxRequest.send();
				}
			} else {//keep unchanged
			}
		}

		// Sign up an account
		function register(){
			if (getCookie("registeruser") == ""){
				var ajaxRequest = new XMLHttpRequest();
				ajaxRequest.onreadystatechange = function(){
					if (this.readyState == 4 && this.status == 200){
						$("#content").empty();//empty previous elements
						$("#content").append(this.responseText);//append new elements
						$("#account").text("Login Account");
						$("#account").attr("onclick","login()");
					}
				}
				ajaxRequest.open("GET", "user.php?action=register", true);
				ajaxRequest.send();
			}
		}

		// load account management page
		function account(){
			if (getCookie("registeruser") != ""){
				var ajaxRequest = new XMLHttpRequest();
				ajaxRequest.onreadystatechange = function(){
					if (this.readyState == 4 && this.status == 200){
						$("#content").empty();//empty previous elements
						$("#content").append(this.responseText);//append new elements
						$("#account").text("Logout Your Account");
						$("#account").attr("onclick","logout()");
					}
				}
				ajaxRequest.open("GET", "account.php", true);
				ajaxRequest.send();
			}
		}

		$('document').ready(function(){//when DOM complete, run homepage content
			if(getCookie("registeruser")!=""){
				$("#welcome_msg").empty();
				$("#welcome_msg").text("Welcome, "+getCookie("registeruser"));
			} else {
				$("#welcome_msg").empty();
				$("#welcome_msg").text("Welcome, BookLover");
			}

			if (getCookie("page") == "login"){//layout login pages
				login();
			} else if (getCookie("page") == "account") {//layout account management page
				account();//load account management page
			}  else if (getCookie("page") == "home") {//layout home page
				home();
			}  else if (getCookie("page") == "search") {//layout search page

			} else {
				//home();
			}
		});
	</script>
</head>
<body>
	<div id="header">
		<div id="slogan">
			<div class="col-25">
				<span> Better than Amazon!!!</span><!-- slogan -->
				<img src="assets/media/img/brand.png" alt="AmazonBear">
			</div>
			<div class="col-75">
				<form id="searchbar" method="GET" action="./search.php">
				  <select name="category"><!-- select search range based departments -->
				    <option value="All">All Categories</option>
						<option value="0">$category[0]</option>
						<option value="1">$category[1]</option>
						<option value="2">$category[2]</option>
						<option value="3">$category[3]</option>
						<option value="4">$category[4]</option>
						<option value="5">$category[5]</option>
						<option value="6">$category[6]</option>
						<option value="7">$category[7]</option>
						<option value="8">$category[8]</option>
						<option value="9">$category[9]</option>
						<option value="10">$category[10]</option>
						<option value="11">$category[11]</option>
				  </select>
					<input id="searchtextbox" value="" name="keyword" autocomplete="off" placeholder="" dir="auto" tabindex="6" type="text">
					<input id="searchbutton" value="" tabindex="7" type="submit">
				</form>
			</div>
		</div>
		<div id="navbar"><!-- navigation bar -->
			<div class="col-25">
				<span id="welcome_msg"></span>
			</div>
			<div class="col-50">
			  <a href="index.php" onclick="setCookie('page', 'home', 1)">Home</a>
			  <a href="#">Shop by</a>
			  <a href="#">Sell</a>
				<a href="#" style="float:right">Cart</a>
				<a href="#" onclick="login()" id="account" style="float:right">Your Account</a>
			</div>
		</div>
	</div><!-- End header-->
HTML;

$content = <<<HTML
  <div id="content">
    <!-- Display category -->
    <!-- Display Books -->
  </div><!-- End content-->
HTML;

$footer = <<<HTML
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
