<?php

/************************************************
File:		  home.php
Author:		Oliver Chi
Purpose:	display content in homepage
**************************************************/

echo "<div id='leftcolumn'><!-- left column for Category and Refine -->
        <div class='card'><!-- new releases -->
          <h3>New Releases</h3>
          <p><a href='#'>Coming Soon</a></p>
          <p><a href='#'>Last 30 Days</a></p>
          <p><a href='#'>Last 90 Days</a></p>
        </div>
        <div class='card'><!-- discount -->
          <h3>Discount</h3>
          <p><a href='#'>10% off or More</a></p>
          <p><a href='#'>25% off or More</a></p>
          <p><a href='#'>50% off or More</a></p>
          <p><a href='#'>70% off or More</a></p>
        </div>
        <div class='card'><!-- refine by -->
          <h3>Refine by</h3>
          <form>
            <input type='checkbox' name='property1' value='1'> Paperback<br>
            <input type='checkbox' name='property2' value='2'> Hardcover<br>
            <input type='checkbox' name='property3' value='3'> E-Books<br>
            <input type='checkbox' name='property4' value='4'> On Sale<br>
            <input type='checkbox' name='property5' value='5'> Out of Stock<br>
            <input type='checkbox' name='property6' value='6'> Five Star Review<br>
            <input type='checkbox' name='property7' value='7'> 10 dollar and less<br>
          </form>
        </div>
      </div>";

echo "<div id='rightcolumn'><!-- right column for display books -->

        <div class='card'><!-- by Category -->
        </div>

        <div class='card'><!-- Bestsellers -->
        </div>

        <div class='card'><!-- new releases -->
        </div>
    </div>";

?>
