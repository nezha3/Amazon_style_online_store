<?php

/*****************************************************************************
File:		  install.php
Author:		Oliver Chi
Purpose:	<installation processing> create tables and entries in database
******************************************************************************/

// Load Database
  $db = new SQLite3('./assets/db/db.sq3', SQLITE3_OPEN_READWRITE);

// Create All Tables
  /* create user table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS user (
      id INT(8) PRIMARY KEY,
      email VARCHAR(64),
      key VARCHAR(16),
      name VARCHAR(32) )"
  );
  /* create product table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS product (
      id INT(8) PRIMARY KEY,
      title VARCHAR(32),
      author VARCHAR(64),
      date DATE,
      category TINYINT(1),
      price FLOAT(10,2),
      discount FLOAT(2,2),
      brief TEXT,
      description LONGTEXT)"
  );
  /* create order table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS order (
      id INT(8) PRIMARY KEY,
      user-id INT(8),
      date DATE,
      total-price FLOAT(10,2),
      if-paid TINYINT(1),
      delivery-id INT(8) )"
  );
  /* create order-products table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS orderproducts (
      id INT(8) PRIMARY KEY,
      order-id INT(8),
      product-id INT(8),
      price FLOAT(10,2),
      discount FLOAT(10,2),
      amount TINYINT(1) )"
  );
  /* create delivery table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS delivery (
      id INT(8) PRIMARY KEY,
      order-id INT(8),
      status TINYINT(1),
      deliverer VARCHAR(64),
      barcode VARCHAR(32),
      phone VARCHAR(10),
      street VARCHAR(255),
      city VARCHAR(32),
      state VARCHAR(3),
      postcode VARCHAR(4) )"
  );
  /* create invoice table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS invoice (
      id INT(8) PRIMARY KEY,
      order-id INT(8),
      name VARCHAR(64),
      info VARCHAR(255),
      price FLOAT(10,2),
      gst FLOAT(10,2) )"
  );
  /* create review table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS review (
      id INT(8) PRIMARY KEY,
      user-id INT(8),
      product-id INT(8),
      star TINYINT(1),
      comment LONGTEXT )"
  );
  /* create cart table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS cart (
      id INT(8) PRIMARY KEY,
      user-id INT(8),
      product-id INT(8),
      amount TINYINT(1) )"
  );
  /* create admin table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS admin (
      name VARCHAR(10) PRIMARY KEY,
      key VARCHAR(10) )"
  );

// Insert All Entries and Test User information
  if ($db->exec("INSERT INTO admin (name, key) VALUES ('admin', 'usq-ict')") ) {/* administrator */
    echo "administrator info writes into database successfully";
  } else {
    echo "error in the processing of administrator info writing into database";
  }

  if ($db->exec("INSERT INTO user (id, email, key, name) VALUES (10000001, 'oliver.chi@icloud.com', 'u1037192', 'Oliver')") ){/* register user 1 */
    echo "register user 1 info writes into database successfully";
  } else {
    echo "error in the processing of register user 1 info writing into database";
  }

  if ($db->exec("INSERT INTO user (id, email, key, name) VALUES (10000002, 'eleen.guan@icloud.com', 'Eleen123', 'Eleen')") ){/* register user 2 */
    echo "register user 2 info writes into database successfully";
  } else {
    echo "error in the processing of register user 2 info writing into database";
  }

  /* product 1 */
  $sql-product1 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES ()";
  if ($db->exec($sql-product1)){
    echo "product 1 info writes into database successfully";
  } else {
    echo "error in the processing of product 1 info writing into database";
  }
  /* product 2 */
  $sql-product2 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES ()";
  if ($db->exec($sql-product2)){
    echo "product 2 info writes into database successfully";
  } else {
    echo "error in the processing of product 2 info writing into database";
  }
  /* product 3 */
  $sql-product3 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES ()";
  if ($db->exec($sql-product3)){
    echo "product 3 info writes into database successfully";
  } else {
    echo "error in the processing of product 3 info writing into database";
  }
  /* product 4 */
  $sql-product4 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES ()";
  if ($db->exec($sql-product4)){
    echo "product 4 info writes into database successfully";
  } else {
    echo "error in the processing of product 4 info writing into database";
  }
  /* product 5 */
  $sql-product5 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES ()";
  if ($db->exec($sql-product5)){
    echo "product 5 info writes into database successfully";
  } else {
    echo "error in the processing of product 5 info writing into database";
  }
  /* product 6 */
  $sql-product6 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES ()";
  if ($db->exec($sql-product6)){
    echo "product 6 info writes into database successfully";
  } else {
    echo "error in the processing of product 6 info writing into database";
  }
  /* product 7 */
  $sql-product1 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES ()";
  if ($db->exec($sql-product7)){
    echo "product 7 info writes into database successfully";
  } else {
    echo "error in the processing of product 7 info writing into database";
  }
  /* product 1 */
  $sql-product8 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES ()";
  if ($db->exec($sql-product8)){
    echo "product 8 info writes into database successfully";
  } else {
    echo "error in the processing of product 8 info writing into database";
  }
  /* product 9 */
  $sql-product1 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES ()";
  if ($db->exec($sql-product9)){
    echo "product 9 info writes into database successfully";
  } else {
    echo "error in the processing of product 9 info writing into database";
  }
  /* product 10 */
  $sql-product10 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES ()";
  if ($db->exec($sql-product10)){
    echo "product 10 info writes into database successfully";
  } else {
    echo "error in the processing of product 10 info writing into database";
  }
  /* product 11 */
  $sql-product11 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES ()";
  if ($db->exec($sql-product11)){
    echo "product 11 info writes into database successfully";
  } else {
    echo "error in the processing of product 11 info writing into database";
  }
  /* product 12 */
  $sql-product12 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES ()";
  if ($db->exec($sql-product12)){
    echo "product 12 info writes into database successfully";
  } else {
    echo "error in the processing of product 12 info writing into database";
  }

// Close database
  $db->close();

?>
