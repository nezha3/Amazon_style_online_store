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
	pageCookie('home');//set page cookie
	require("layout.php");

  echo $header;

	echo $content;

  echo $footer;

	exit;
?>
