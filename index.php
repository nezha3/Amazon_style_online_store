<?php
/************************************************
File:		  index.php
Author:		Oliver Chi
Purpose:	View products
**************************************************/

	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];

	require("layout.php");

  echo $header;

  echo $footer;

	exit;
?>
