<?php

/************************************************
File:		  account.php
Author:		Oliver Chi
Purpose:	account management for register user
**************************************************/

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database
pageCookie("account");//set account page cookie

/* Actions */
if ($_SERVER["REQUEST_METHOD"] == "GET") {//Function Management
  if (isset($_GET['function'])){
    if ($_GET['function'] == "user"){
      $result = $db->query("SELECT * FROM user WHERE user.email = '".getEmail()."';");//sql
      while($user = $result->fetchArray()){
        $id = $user['id'];
        $email = $user['email'];
        $key = $user['key'];
        $name = $user['name'];
      }
      echo "<p class='title'>User Management</p>";
      echo "<form action='account.php' method='GET' class='edit'>";
      echo "<b>USER ID </b><input type='text' name='id' value='$id' readonly><br><br>";
      echo "<b>EMAIL </b><input id='email' type='text' name='email' value='$email' onkeyup='user_valid()'><br><br>";
      echo "<b>Password </b><input id='password' type='text' name='key' value='$key' onkeyup='user_valid()'><br><br>";
      echo "<b>Name </b><input id='name' type='text' name='name' value='$name' onkeyup='user_valid()'><br><br>";
      echo "<input class='button' type='submit' value='UPDATE USER INFORMATION' disabled>";
      echo "<p class='error_msg'></p>";
      echo "</form>";
    } else if ($_GET['function'] == "order"){
      $result = $db->query("SELECT * FROM user WHERE user.email = '".getEmail()."';");//sql
      while($user = $result->fetchArray()){
        $userid = $user['id'];
      }
      echo "<p class='title'>Order Management</p>";
      echo "<table class='orders'>";
      echo "<tr>
      	     <th>Order ID</th><th>User ID</th><th>Date</th><th>Total Price($)</th><th>IF PAID</th><th>Delivery ID</th><th>Action</th>
      	    </tr>";
      $result = $db->query("SELECT * FROM orders WHERE orders.userid = $userid;");//sql
      while($order = $result->fetchArray()){
        $id = $order['id'];
        $date = $order['date'];
        $totalprice = $order['totalprice'];
        $ifpaid = $order['ifpaid'];
        if ($ifpaid){
          $ifpaid = "YES";
        }else{
          $ifpaid = "NO";
        }
        $deliveryid = $order['deliveryid'];
        echo "<tr>";
        echo "<td>".$id."</td>";
        echo "<td>".$userid."</td>";
        echo "<td>".$date."</td>";
        echo "<td>".$totalprice."</td>";
        echo "<td>".$ifpaid."</td>";
        echo "<td>".$deliveryid."</td>";
        echo "<td><a href='#' onclick='delete_order($id)'>Delete It</a></td>";
        echo "</tr>";
      }
      echo "</table><br><br>";
    } else if ($_GET['function'] == "comments"){

    }
  } else if (isset($_GET['id']) && isset($_GET['email']) && isset($_GET['key']) && isset($_GET['name'])){
      if ( updateUser(intval($_GET['id']), strval($_GET['email']), strval($_GET['key']), strval($_GET['name']) ) ){//update user
        userCookie(strval($_GET['email']));
        nameCookie(strval($_GET['name']));
        goHome();
      }
  } else if ( isset($_GET['deleteorder']) ){
      $orderid = intval($_GET['deleteorder']);
      if ( deleteOrder($orderid) ){
          header("Refresh:1; url=index.php");
      }
  } else {
      echo "<script language = 'javascript 'type = 'text/javascript'>";
      echo "//Valid User INFORMATION
            function user_valid(){
              $('.error_msg').empty();//empty error message
              var email = $('#email').val();
              var key = $('#password').val();
              var name = $('#name').val();
              if (!(matchExpression(email).email)) $('.error_msg').text('Incorret Email Format!');
              if (!(matchExpression(key).onlyMixOfAlphaNumeric)) $('.error_msg').text('Incorret Password Format: Password Only Contains Letters and Numbers!');
              if (!(matchExpression(name).onlyLetters)) $('.error_msg').text('Incorret Name Format: Name Only Contains Letters!');
              if ($('.error_msg').text().length == 0){//no error
                $('.button').removeAttr('disabled');
              } else {//having error
                $('.button').attr('disabled','');
              }
            }";

      echo "//Delete Order
            function delete_order(id){
              var ajaxRequest = new XMLHttpRequest();
              ajaxRequest.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                  edit_order();
                }
              }
              ajaxRequest.open('GET', 'account.php?deleteorder='+id, true);
              ajaxRequest.send();
            }
           ";

      echo "// Ajax: manage user information
            function edit_user(){
              var ajaxRequest = new XMLHttpRequest();
              ajaxRequest.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                  $('#function').empty();//empty previous elements
                  $('#function').append(this.responseText);//append new elements
                }
              }
              ajaxRequest.open('GET', 'account.php?function=user', true);
              ajaxRequest.send();
            }";

      echo "// Ajax: manage order information
            function edit_order(){
              var ajaxRequest = new XMLHttpRequest();
              ajaxRequest.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                  $('#function').empty();//empty previous elements
                  $('#function').append(this.responseText);//append new elements
                }
              }
              ajaxRequest.open('GET', 'account.php?function=order', true);
              ajaxRequest.send();
            }";

      echo "// Ajax: manage user information
            function edit_comments(){
              var ajaxRequest = new XMLHttpRequest();
              ajaxRequest.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                  $('#function').empty();//empty previous elements
                  $('#function').append(this.responseText);//append new elements
                }
              }
              ajaxRequest.open('GET', 'account.php?function=comments', true);
              ajaxRequest.send();
            }";

      echo "</script>";

      echo "<h2>&emsp;Account Management</h2>";

      echo "<div><center>&emsp;<a href='#' onclick='edit_user()'>Edit User Information</a>&emsp;";
      echo "<a href='#' onclick='edit_order()'>Manage Orders</a>&emsp;";
      echo "<a href='#' onclick='edit_comments()'>Manage Comments</a>&emsp;</center></div>";

      echo "<div id='function'></div>";
  }
}

$db->close();//close connection of database

?>
