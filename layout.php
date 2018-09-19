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

		$('document').ready(function(){//when DOM complete, run homepage content
			home();
		});

	</script>
</head>
<body>
	<div id="header">
		<div id="slogan">
			<span> Better than Amazon!!!</span><!-- slogan -->
			<img src="assets/media/img/brand.png" alt="AmazonBear">
			<div id="searchbar">
			  <select><!-- select search range based departments -->
			    <option value="All">All</option>
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
					}
			  </select>
				<input id="searchtextbox" value="" name="field-keywords" autocomplete="off" placeholder="" dir="auto" tabindex="6" type="text">
				<input id="searchbutton" value="" tabindex="7" type="submit">
			</div>
		</div>
		<div id="navbar"><!-- navigation bar -->
		  <a href="#" onclick="home()">Home</a>
		  <a href="#">Shop by</a>
		  <a href="#">Sell</a>
			<a href="#" style="float:right">Cart</a>
			<a href="./pages/login.php" style="float:right">Your Account</a>
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
