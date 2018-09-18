<?php

/************************************************
File:		  content.php
Author:		Oliver Chi
Purpose:	HTML Section for content
**************************************************/

$content = <<<HTML
  <div id="content">
    <!-- Display category -->
    <div id="leftcolumn"><!-- left column for Category and Refine -->
      <div class="card"><!-- new releases -->
        <h3>New Releases</h3>
        <p><a href="#">Coming Soon</a></p>
        <p><a href="#">Last 30 Days</a></p>
        <p><a href="#">Last 90 Days</a></p>
      </div>
      <div class="card"><!-- discount -->
        <h3>Discount</h3>
        <p><a href="#">10% off or More</a></p>
        <p><a href="#">25% off or More</a></p>
        <p><a href="#">50% off or More</a></p>
        <p><a href="#">70% off or More</a></p>
      </div>
      <div class="card"><!-- refine by -->
        <h3>Refine by</h3>
        <form>
          <input type="checkbox" name="property1" value="1"> Paperback<br>
          <input type="checkbox" name="property2" value="2"> Hardcover<br>
          <input type="checkbox" name="property3" value="3"> E-Books<br>
          <input type="checkbox" name="property4" value="4"> On Sale<br>
          <input type="checkbox" name="property5" value="5"> Out of Stock<br>
          <input type="checkbox" name="property6" value="6"> Five Star Review<br>
          <input type="checkbox" name="property7" value="7"> 10 dollar and less<br>
        </form>
      </div>
    </div>

    <!-- Display Books -->
    <div id="rightcolumn"><!-- right column for display books -->
      <div class="card"><!-- by Category -->
        <h3>Shop by category</h3>
      </div>
      <div class="bookrow">
        <div class="book">
          <a href="#" onclick="category(0)">
            <img src="assets/media/img/category/0.jpg" alt="Image">
            <p>$category[0]</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/category/1.jpg" alt="Image">
            <p>$category[1]</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/category/2.jpg" alt="Image">
            <p>$category[2]</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/category/3.jpg" alt="Image">
            <p>$category[3]</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/category/4.jpg" alt="Image">
            <p>$category[4]</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/category/5.jpg" alt="Image">
            <p>$category[5]</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/category/6.jpg" alt="Image">
            <p>$category[6]</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/category/7.jpg" alt="Image">
            <p>$category[7]</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/category/8.jpg" alt="Image">
            <p>$category[8]</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/category/9.jpg" alt="Image">
            <p>$category[9]</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/category/10.jpg" alt="Image">
            <p>$category[10]</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/category/11.jpg" alt="Image">
            <p>$category[11]</p>
          </a>
        </div>
      </div>
      <div class="card"><!-- Bestsellers -->
        <h3>Bestsellers</h3>
      </div>
      <div class="bookrow">
        <div class="book">
          <a href="#">
            <img src="assets/media/img/bestseller/1.jpg" alt="bestseller Image">
            <p>All the Little Lights<p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/bestseller/2.jpg" alt="bestseller Image">
            <p>Literary</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/bestseller/3.jpg" alt="bestseller Image">
            <p>Classics</p>
          </a>
        </div>
      </div>
      <div class="card"><!-- new releases -->
        <h3>Hot new releases</h3>
      </div>
      <div class="bookrow">
        <div class="book">
          <a href="#">
            <img src="assets/media/img/newreleases/1.jpg" alt="newreleases Image">
            <p>The Wife Arrangement<p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/newreleases/2.jpg" alt="newreleases Image">
            <p>The Art of Inheriting Secrets</p>
          </a>
        </div>
        <div class="book">
          <a href="#">
            <img src="assets/media/img/newreleases/3.jpg" alt="newreleases Image">
            <p>Dead Lock</p>
          </a>
        </div>
      </div>
    </div>

  </div><!-- End content-->
HTML;

?>
