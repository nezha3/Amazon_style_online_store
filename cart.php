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
	if (array_key_exists('id', $_GET)){
		if (cartCheck()){//add more product into cart
			$oldCartValue = (object)getCart();
			$json_id = $oldCartValue->id;//previous array id
			$json_quantity = $oldCartValue->quantity;//previous arry quantity
			array_push($json_id, strval($_GET['id']) );//array id + new element
			array_push($json_quantity, intval($_GET['quantity']) );//array quanity + new element
			$cartValue = (object)array();//empty json
			$cartValue->id = $json_id;
			$cartValue->quantity = $json_quantity;
			cartCookie($cartValue);//set cart cookie
			//var_dump($cartValue);//only for test: cart info
			header("Refresh:0; url=cart.php");
		} else {//no product in cart
			$json_id = strval($_GET['id']);//new json id
			$json_quantity = intval($_GET['quantity']);//new json quanity
			$cartValue = (object)array();//empty json
			$cartValue->id = array( $json_id );
			$cartValue->quantity = array( $json_quantity );
			cartCookie($cartValue);//set cart cookie
			//var_dump($cartValue);//only for test: cart info
			header("Refresh:0; url=cart.php");
		}
	}
}

// Set out cart page
require("layout.php");//get layout of HTML
pageCookie("cart");//set cart page cookie
/* redesign content of page */
/* display products in cart and prepare for ordering */
echo $header;
echo "<div id='content'><!-- Cart Content-->
<div id='products_in_cart'><!-- Display Products in Cart -->
<h2>&nbsp;&nbsp;&nbsp;Products in Cart:</h2>";

// Check if having product in cart
if (cartCheck()){//not empty
	echo "<form method='GET' action='./order.php'>";
	echo "<table id='products_table'>
	<tr>
	<th>Selected</th><th>Product ID</th><th>Product Name</th><th>Quantity</th><th>Price per Unit</th>
	</tr>";
	$cartValue=(object)getCart();
	$totalprice=0;
	for ($i=0; $i < count($cartValue->id);$i++){
		$json = json_encode(array("id" => $cartValue->id[$i], "quantity" => $cartValue->quantity[$i]));
		echo "<tr>";
		echo "<td><input type='checkbox' name='product[]' value='".$json."'></td>";
		echo "<td>".$cartValue->id[$i]."</td>";
		$result = $db->query("SELECT product.id, product.title, product.price FROM product WHERE product.id == ".$cartValue->id[$i]);//sql
		while($book = $result->fetchArray()){
			echo "<td>".$book['title']."</td>";
			echo "<td>".$cartValue->quantity[$i]."</td>";
			echo "<td>$".$book['price']."</td></tr>";
			$totalprice = $totalprice + (float)$book['price']*((float)($cartValue->quantity[$i]));
		}
	}
	echo "<tr><td> </td><td> </td><td> </td><td>Total:</td><td>$".(string)$totalprice."</td></tr></table>";
	if (!loginCheck()) {
		echo "<i>Please login your account to make an order!</i><br>";
		echo "<input id='emptycart' type='button' onclick='empty_cart()' value='Empty Your Cart'><br>";
	} else {
		echo "<input id='addtoorder' type='submit' value='Add Them To Order'>";
		echo "<input id='emptycart' type='button' onclick='empty_cart()' value='Empty Your Cart'>";
		echo "<input id='savecart' type='button' onclick='save_cart()' value='Save Them To Account' disabled>";
	}
	echo "</form>";
} else {
	echo "<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---YOUR CART IS EMPTY! NO PRODUCT!---</b>";
}
echo "</table>
</div>
<!-- Confirm Ordering -->
</div><!-- End cart-->";
echo $footer;

$db->close();
exit;
?>
