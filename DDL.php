<?php
include 'dbconnect.php';

// creating categories table:
$cat_create_sql = "CREATE TABLE categories(
                cat_id VARCHAR(100) NOT NULL PRIMARY KEY,
                cat_title VARCHAR(100) NOT NULL
                )";

if (mysqli_query($conn, $cat_create_sql) === TRUE) {
    echo "Table Categories1 created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// creating sub categories table:
$sub_cat_create_sql = "CREATE TABLE sub_categories(
                sub_cat_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                sub_cat_title VARCHAR(100) NOT NULL,
                cat_parent VARCHAR(100) NOT NULL
                )";

if (mysqli_query($conn, $sub_cat_create_sql) === TRUE) {
    echo "Table Sub_categories created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// creating products table:
$products_create_sql = "CREATE TABLE products(
                product_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                product_title VARCHAR(225) NOT NULL,
                product_cat VARCHAR(100) NOT NULL,
                product_sub_cat VARCHAR(100) NOT NULL,
                product_price INT(100) NOT NULL,
                product_desc TEXT NOT NULL,
                product_img VARCHAR(225) NOT NULL,
                product_qty INT(100) NOT NULL
                )";

if (mysqli_query($conn, $products_create_sql) === TRUE) {
    echo "Table Products created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>