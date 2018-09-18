<?php

/************************************************
File:		  books.php
Author:		Oliver Chi
Purpose:	display books in categories or others
**************************************************/

require("libcommon.php");

$num = intval($_GET['category']);

echo $category[$num].":";


 ?>
