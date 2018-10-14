<?php

/************************************************
File:		  search.php
Author:		Oliver Chi
Purpose:	do simple and complex searches
**************************************************/

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database
pageCookie('search');//set page cookie

//print out header and footer;
//clear contents
require("layout.php");
echo $header;
echo "<script language = 'javascript' type = 'text/javascript'>
          function check_inputs(){
            $('.error_msg').empty();
            if ($('#field1').val() == '' && $('#text1').val() == '' && $('#field3').val() == '' && $('#text3').val() == ''){//if no input
              $('.error_msg').text('Please input your reseach content!');
            } else {//input desn't form one reseach condition
              if (!($('#field1').val() != '' && $('#text1').val() != '') && !($('#field1').val() == '' && $('#text1').val() == '')){
                $('.error_msg').text('Missing at least one complete research condition, please recheck your input!');
              }
              if (!($('#field3').val() != '' && $('#text3').val() != '') && !($('#field3').val() == '' && $('#text3').val() == '')){
                $('.error_msg').text('Missing at least one complete research condition, please recheck your input!');
              }
              if ($('#field1').val() != $('#field3').val()){//or operation for divided search objectives
                $('#field2 option.and').removeAttr('disabled', '');
                $('#field2 option.or').removeAttr('selected', '');
                $('#field1 option.price').removeAttr('disabled', '');
                $('#field3 option.price').removeAttr('disabled', '');
                $('#field1 option.date').removeAttr('disabled', '');
                $('#field3 option.date').removeAttr('disabled', '');
                if (($('#field1').val() == 'keyword') || ($('#field3').val() == 'keyword') ){//check key inputs
                  $('#field1 option.key').attr('selected', '');
                  $('#field3 option.key').attr('selected', '');
                }
              } else {
                if ($('#field1').val() == 'title'){//or operation for same search objective
                  $('#field2 option.and').attr('disabled', '');
                  $('#field2 option.or').attr('selected', '');
                }
                if ($('#field1').val() == 'author'){//or operation for same search objective
                  $('#field2 option.and').attr('disabled', '');
                  $('#field2 option.or').attr('selected', '');
                }
              }
            }
            if ( $('#field1').val() == 'date' ){//no two date
              $('#field3 option.date').attr('disabled', '');
            }
            if ( $('#field3').val() == 'date' ){//no two date
              $('#field1 option.date').attr('disabled', '');
            }
            if ( $('#field1').val() == 'price' ){//no two price
              $('#field3 option.price').attr('disabled', '');
            }
            if ( $('#field3').val() == 'price' ){//no two price
              $('#field1 option.price').attr('disabled', '');
            }
            if ($('#field1').val() == 'author' && matchExpression($('#text1').val()).containsNumber){//check name inputs
              $('.error_msg').text('Author name is invalid, please recheck your input!');
            }
            if ($('#field3').val() == 'author' && matchExpression($('#text3').val()).containsNumber){//check name inputs
              $('.error_msg').text('Author name is invalid, please recheck your input!');
            }
            if ($('#field1').val() == 'price' && !matchExpression($('#text1').val()).onlyNumbers){//check price inputs
              $('.error_msg').text('Price is invalid, please recheck your input!');
            }
            if ($('#field3').val() == 'price' && !matchExpression($('#text3').val()).onlyNumbers){//check price inputs
              $('.error_msg').text('Price is invalid, please recheck your input!');
            }
            if ($('#field1').val() == 'date' && !matchExpression($('#text1').val()).dateddmmyy){//check date inputs
              $('.error_msg').text('Date is invalid, please recheck your input!');
            }
            if ($('#field3').val() == 'date' && !matchExpression($('#text3').val()).dateddmmyy){//check date inputs
              $('.error_msg').text('Date is invalid, please recheck your input!');
            }
          }
      </script>";
echo "<div id='content'><!-- content -->
        <div class='card'><!-- search form -->
          <form class='center'>
            <div class='row'><!-- label row -->
              <div class='col-20'>
                <label>Compulsory Search Area</label>
              </div>
              <div class='col-20'>
                <label>Search Content</label>
              </div>
              <div class='col-20'>
                <label>AND/OR</label>
              </div>
              <div class='col-20'>
                <label>Option Search Area</label>
              </div>
              <div class='col-20'>
                <label>Search Content</label>
              </div>
            </div>
            <div class='row'><!-- inputs -->
              <div class='col-20'>
                <select id='field1' name='field1' onchange='check_inputs()'>
                  <option value=''>Search Entity Area</option>
                  <option value='title'>Book Title</option>
                  <option value='author'>Author</option>
                  <option class='date' value='date'>Publish Date(After DDMMYYYY)</option>
                  <option class='key' value='keyword'>Keyword</option>
                  <option class='price' value='price'>Price(less than $)</option>
                </select>
              </div>
              <div class='col-20'>
                <input type='text' id='text1' name='text1' placeholder='text/keywords' onchange='check_inputs()'>
              </div>
              <div class='col-20'>
                <select id='field2' name='field2' onchange='check_inputs()'>
                  <option class='and' value='AND'>AND</option>
                  <option class='or' value='OR'>OR</option>
                </select>
              </div>
              <div class='col-20'>
                <select id='field3' name='field3' onchange='check_inputs()'>
                  <option value=''>Search Entity Area</option>
                  <option value='title'>Book Title</option>
                  <option value='author'>Author</option>
                  <option class='date' value='date'>Publish Date(After DDMMYYYY)</option>
                  <option class='key' value='keyword'>Keyword</option>
                  <option class='price' value='price'>Price(less than $)</option>
                </select>
              </div>
              <div class='col-20'>
                <input type='text' id='text3' name='text3' placeholder='text/keywords' onchange='check_inputs()'>
              </div>
            </div>
            <div class='row'><!-- search button -->
              <input type='submit' value='Search Books'>
            </div>
          </form>
        </div>
        <div class='card'><!-- search result--><p class='error_msg'></p>";

// only for test TODO: check all elements submitted by form
/*
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
*/

/* check if complex search */
if (array_key_exists('field1', $_GET)) {//complex search
  $field1 = strval($_GET['field1']);//get field1
  $text1 = strval($_GET['text1']);//get field1
  if($field1==""||$text1==""){
    echo "<p class='error_msg'>The first search area is compulsory, please recheck your input!</p>";
  }
} else {//simple search
  if (array_key_exists('category', $_GET)) {
    $field = strval($_GET['category']);//get category
    $keyword = strval($_GET['keyword']);//get keyword
    if (strcmp($field, 'All')==0){//search in all categories
      $result = $db->query("SELECT * FROM product WHERE title LIKE '%$keyword%' ");//excute sql
      echo "<h3>Search Results:</h3>";
      echo "<div class='bookrow'>";
      while($book = $result->fetchArray()){
        echo "<div class='book'>";
        echo "<a href='#' onclick='books(".$book['id'].")'>";
        echo "<img src='assets/media/img/books/".$book['id'].".jpg' alt='Image'>";
        echo "<p>".$book['title']."</p>";
        echo "</a>";
        echo "</div>";
      }
      echo "</div><!-- end of book rows -->";
    } else {//search in one category
      $result = $db->query("SELECT * FROM product WHERE title LIKE '%$keyword%' AND category = '$field' ");//excute sql
      echo "<h3>Search Results:</h3>";
      echo "<div class='bookrow'>";
      while($book = $result->fetchArray()){
        echo "<div class='book'>";
        echo "<a href='#' onclick='books(".$book['id'].")'>";
        echo "<img src='assets/media/img/books/".$book['id'].".jpg' alt='Image'>";
        echo "<p>".$book['title']."</p>";
        echo "</a>";
        echo "</div>";
      }
      echo "</div><!-- end of book rows -->";
    }
  } else {
    echo "<p class='error_msg'>Error happened in search form, please recheck your input!</p>";
  }

}

echo "</div><!-- end of card -->
  </div><!-- end of content -->";
echo $footer;

$db->close();//close connection of database

 ?>
