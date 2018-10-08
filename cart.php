<?php

/************************************************
File:		  cart.php
Author:		Oliver Chi
Purpose:	display cart; add product to cart;
          save cart to database for register users
**************************************************/

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

	/* Actions */
	if ($_SERVER["REQUEST_METHOD"] == "POST") {//save cart to database for registered users only
		echo "POST";
	} else if ($_SERVER["REQUEST_METHOD"] == "GET") {//display cart or add product to cart
    echo "<table>";
    foreach ($_GET as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
  }
?>
