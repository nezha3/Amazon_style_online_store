<?php
/************************************************
File:		  index.php
Author:		Oliver Chi
Purpose:	First Page of Website
**************************************************/

	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];

	require("libcommon.php");
	require("layout.php");

	//set home page cookie
	if (getPage() == "") pageCookie("home");

  echo $header;

	echo $content;

  echo $footer;

	exit;
?>
