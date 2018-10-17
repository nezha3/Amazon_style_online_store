<?php

/************************************************
File:		  order.php
Author:		Oliver Chi
Purpose:	display order; generate new order;
**************************************************/

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

// Set out order page
require("layout.php");//get layout of HTML
pageCookie("order");//set order page cookie

/* Actions */
if ($_SERVER["REQUEST_METHOD"] == "POST") {//pay order and store order
  echo var_dump($_POST);
  // $info = json_decode($_POST);
  // for ($i=0; $i < count($info);$i++){
  //   $product = json_decode( info[$i] );
  // }
  //
  //
  // echo "Order ID: ".$order->id."&nbsp;&nbsp;&nbsp;Date: ".$order->date."&nbsp;&nbsp;&nbsp;Paid: ".$order->ifpaid;

} else if ($_SERVER["REQUEST_METHOD"] == "GET") {//display current order waiting for payment
  if (isset($_GET["order"])){
    $info = json_decode("[".$_GET["order"]."]");//json missing infomation
    //create new order in Database
    if (getNextID("orders")!=""){
      $orderid = getNextID("orders") + 1;
    } else {
      $orderid = 10000001;
    }
    $userid = getUserID();
    $date = date("Y-m-d");
    $sql = "INSERT INTO orders (id, userid, date, totalprice, ifpaid, deliveryid)
    VALUES ($orderid, $userid, '$date', NULL, 1, NULL);";
    if ($db->exec($sql)){
      $j = 0; // caculate insert times
      for ($i=0; $i < count($info);$i++){
        if (getNextID("orderproducts")!=""){
          $id = getNextID("orderproducts") + 1;
        } else {
          $id = 10000001;
        }
        $productid = $info[$i]->id;
        $amount = $info[$i]->quantity;
        $result = $db->query("SELECT product.price FROM product WHERE product.id = $productid ;");//sql
        while($product = $result->fetchArray()){
          $price = $product[0];
        }
        $sql = "INSERT INTO orderproducts(id, orderid, productid, price, discount, amount)
        VALUES ($id, $orderid, $productid, $price, 1.0, $amount) ;";
        if ($db->exec($sql)){
          $j = $j + 1;
        } else {
          echo "FAIL: insert product $productid into orderproducts table";
        }
      }
      if ($j == $i) {//successfully generate order
        echo "[Successfully Generate Order In Database]: ";
        echo " Order ID: $orderid --";
        echo " Date: $date --";
        echo " Paid: YES";
      }
    } else {
      echo "Database Error. Please Try It Later.";
    }
  } else {
    echo $header;//display header

    /* redesign content of page */
    /* display current order */
    echo "<script language = 'javascript' type = 'text/javascript'>";
    echo "// Pay Current Order (protected method)
    // Store Order Into Database
    function payOrder(info){
      var ajaxRequest = new XMLHttpRequest();
      ajaxRequest.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
          $('#order_info').empty();
          $('#order_info').text(this.responseText);
          $('#paythisorder').css('display','none');
        }
      }
      ajaxRequest.open('GET', 'order.php?order='+info, true);
      ajaxRequest.send();
    }
    ";
    echo "</script>";
    echo "<div id='content'><!-- Order Content--><div id='order'><!-- Display Order --><h2>&nbsp;&nbsp;&nbsp;Current Order:</h2>";
    echo  "<center><h3 id='order_info'>Order ID: newOrder&nbsp;&nbsp;&nbsp;Date: ".date("d/m/Y")."&nbsp;&nbsp;&nbsp;Paid: NO</h3></center>";
    echo "<table>
    <tr>
    <th>Product ID</th><th>Product Name</th><th>Quantity</th><th>Price per Unit</th>
    </tr>
    ";
    $totalprice=0;
    //echo var_dump($_GET);//only for test
    for ($i=0; $i < count($_GET['product']);$i++){
      $product = json_decode( $_GET['product'][$i] );
      echo "<tr>";
      echo "<td>".$product->id."</td>";
      $result = $db->query("SELECT product.title, product.price FROM product WHERE product.id == ".$product->id);//sql
      while($book = $result->fetchArray()){
        echo "<td>".$book['title']."</td>";
        echo "<td>".$product->quantity."</td>";
        echo "<td>$".$book['price']."</td></tr>";
        $totalprice = $totalprice + (float)$book['price']*((float)($product->quantity));
      }
    }
    echo "<tr><td> </td><td> </td><td>Total:</td><td>$".(string)$totalprice."</td></tr></table>";
    echo "</table>";
    $info = json_encode($_GET['product']);
    //echo var_dump($info);//for test
    echo "<input id='paythisorder' onclick='payOrder($info)' type='button' value='Pay This Order'>";

    echo "</div></div><!-- End of Content-->";
    echo $footer;//display footer
  }
}

$db->close();
exit;
?>
