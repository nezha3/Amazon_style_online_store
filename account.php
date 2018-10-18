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
if ($_SERVER["REQUEST_METHOD"] == "GET") {//ACTIONS

  //Function Management Action
  if (isset($_GET['function'])){

    if ($_GET['function'] == "user"){//User Managment
      $result = $db->query("SELECT * FROM user WHERE user.email = '".getEmail()."';");//sql
      while($user = $result->fetchArray()){//get user
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


    } else if ($_GET['function'] == "order"){//Order Management
      $result = $db->query("SELECT * FROM user WHERE user.email = '".getEmail()."';");//sql
      while($user = $result->fetchArray()){//get user
        $userid = $user['id'];
        $username=$user['name'];
      }
      echo "<p class='title'>Order Management</p>";
      echo "<table class='orders'>";
      echo "<tr>
      <th>Order ID</th><th>User</th><th>Date</th><th>Total Price($)</th><th>PAID</th><th>Delivery ID</th><th>Action</th>
      </tr>";
      $results = $db->query("SELECT * FROM orders WHERE orders.userid = $userid;");//sql
      while($order = $results->fetchArray()){//get order
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
        echo "<td>".$username."</td>";
        echo "<td>".$date."</td>";
        echo "<td>".$totalprice."</td>";
        echo "<td>".$ifpaid."</td>";
        echo "<td>".$deliveryid."</td>";
        echo "<td><a href='#' onclick='delete_order($id)'>Delete It</a></td>";
        echo "</tr>";
      }
      echo "</table><br><br>";


    } else if ($_GET['function'] == "comments"){//Comments Management
      $result = $db->query("SELECT * FROM user WHERE user.email = '".getEmail()."';");//sql
      while($user = $result->fetchArray()){//get register user name
        $userid = $user['id'];
        $username=$user['name'];
      }
      echo "<p class='title'>Comments Management</p>";
      echo "<table class='comments'>";
      echo "<tr>
      <th>Review ID</th><th>User</th><th>Book Title</th><th>Star</th><th>Comment</th><th>Action</th>
      </tr>";
      $results = $db->query("SELECT * FROM review WHERE review.userid = $userid;");//sql
      while($review = $results->fetchArray()){//get review
        $id = $review['id'];
        $productid = $review['productid'];
        $star = $review['star'];
        $comment = $review['comment'];
        $result = $db->query("SELECT product.title FROM product WHERE product.id = $productid;");//sql
        while($product = $result->fetchArray()){$title = $product[0];}//get product title
        echo "<tr>";
        echo "<td>".$id."</td>";
        echo "<td>".$username."</td>";
        echo "<td>".$title."</td>";
        echo "<td>".$star."</td>";
        echo "<td>".$comment."</td>";
        echo "<td><a href='#' onclick='delete_comment($id)'>Delete It</a></td>";
        echo "</tr>";
      }
      echo "<tr>";
      echo "<td>New Review</td>";
      echo "<td>".$username."</td>";
      echo "<td colspan='4'><form action='account.php' method='GET' class='edit'><input type='text' placeholder='book title' id='title' name='title' onkeyup='comment_valid()'><br><br>";
      echo "<input type='text' placeholder='star (1-5)' id='star' name='star' onkeyup='comment_valid()'><br><br>";
      echo "<input type='text' placeholder='comment' id='comment' name='comment' onkeyup='comment_valid()'><br><br>";
      echo "<input type='submit' class='button' value='Push New Comment' disabled><p class='error_msg'></p></form></td>";
      echo "</tr>";
      echo "</table><br><br>";
    }
  //End of Function Mnagement Action

  // Update User Action
  } else if (isset($_GET['id']) && isset($_GET['email']) && isset($_GET['key']) && isset($_GET['name'])){
    if ( updateUser(intval($_GET['id']), strval($_GET['email']), strval($_GET['key']), strval($_GET['name']) ) ){//update user
      userCookie(strval($_GET['email']));
      nameCookie(strval($_GET['name']));
      goHome();
    }

  // Create New Comment Action
} else if (isset($_GET['title']) && isset($_GET['star']) && isset($_GET['comment']) ){
  $title = strval($_GET['title']);
  $star = intval($_GET['star']);
  $comment = strval($_GET['comment']);
  $productid = "";

  $result = $db->query("SELECT product.id FROM product WHERE product.title = '$title';");//sql
  while($product = $result->fetchArray()){//get product id
    $productid = $product[0];
  }
  if ($productid == "") {//no product id due to incorrect title
    echo "No Book Found: Book Title Incorrect!";
  } else {//insert new comment into review table
    $id = getNextID("review");//get review next available id
    $userid = getUserID();//get user id
    if (insertComment($id, $userid, $productid, $star, $comment)){//do insert
      echo "Insert Comment Successfully!";
      goHome();
    }
  }

  // Delete Order Action
  } else if ( isset($_GET['deleteorder']) ){
    $orderid = intval($_GET['deleteorder']);
    if ( deleteOrder($orderid) ){
      header("Refresh:1; url=index.php");
    }

  // Delete Comment Action
  } else if ( isset($_GET['deletecomment']) ){
    $commentid = intval($_GET['deletecomment']);
    if ( deleteComment($commentid) ){
      header("Refresh:1; url=index.php");
    }

  // Main Page Display Action
  } else {
    echo "<script language = 'javascript 'type = 'text/javascript'>";
    echo "//Valid User Information
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

    echo "//Valid Comment Information
    function comment_valid(){
      $('.error_msg').empty();//empty error message
      var title = $('#title').val();
      var star = $('#star').val();
      var comment = $('#comment').val();
      if (title == '') $('.error_msg').text('No Title!');
      if (!(star=='1'||star=='2'||star=='3'||star=='4'||star=='5')) $('.error_msg').text('Incorret Star: star should be one of 1 to 5.');
      if (comment == '') $('.error_msg').text('Empty Comment!');
      if ($('.error_msg').text().length == 0){//no error
        $('.button').removeAttr('disabled');
      } else {//having error
        $('.button').attr('disabled','');
      }
    }";

    echo "//Delete Comment
    function delete_comment(id){
      var ajaxRequest = new XMLHttpRequest();
      ajaxRequest.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
          edit_comments();
        }
      }
      ajaxRequest.open('GET', 'account.php?deletecomment='+id, true);
      ajaxRequest.send();
    }
    ";

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
