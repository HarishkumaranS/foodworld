<?php
include 'database.php';
$cat_table = "CREATE TABLE IF NOT EXISTS categories (
    cat_id INT(3) NOT NULL AUTO_INCREMENT,
    cat_title VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL UNIQUE,
    PRIMARY KEY (cat_id)
)";
$reslut_qry=mysqli_query($con,$cat_table);
if($reslut_qry)
{
    echo "categories tables created<br>";
}
$fav_table="CREATE TABLE IF NOT EXISTS fav (
    fav_id INT(5) NOT NULL AUTO_INCREMENT,
    product_id INT(3) NOT NULL,
    user_id INT(3) NOT NULL,
    qty INT(3) NOT NULL,
    c_price INT(5) NOT NULL,
    fav_c_price INT(5) NOT NULL,
    p_price INT(5) NOT NULL,
    fav_p_price INT(5) NOT NULL,
    PRIMARY KEY (fav_id)
)";
$reslut_qry=mysqli_query($con,$fav_table);
if($reslut_qry)
{
    echo "fav table created<br>";
}
$payment_table="CREATE TABLE IF NOT EXISTS payment (
    payment_id INT(3) NOT NULL AUTO_INCREMENT,
    payment_type VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL,
    PRIMARY KEY (payment_id)
)";
$reslut_qry=mysqli_query($con,$payment_table);
if($reslut_qry)
{
    echo "payment table created<br>";
}
$product_table="CREATE TABLE IF NOT EXISTS product (
    product_id INT(3) AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(50) UNIQUE,
    product_scale VARCHAR(100),
    product_des VARCHAR(500),
    product_keyword VARCHAR(500),
    product_cat VARCHAR(20),
    product_img VARCHAR(100),
    product_img2 VARCHAR(100),
    product_img3 VARCHAR(100),
    product_stock INT(3),
    product_price INT(5),
    product_off INT(2),
    product_c_price INT(5)
)";
$reslut_qry=mysqli_query($con,$product_table);
if($reslut_qry)
{
    echo "product table created<br>";
}
$user_table="CREATE TABLE IF NOT EXISTS user (
    user_id INT(5) AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(20),
    user_email VARCHAR(30),
    user_pass VARCHAR(20),
    mob_num1 BIGINT(10) UNIQUE,
    mob_num2 BIGINT(10),
    address VARCHAR(100)
)";
$reslut_qry=mysqli_query($con,$user_table);
if($reslut_qry);
{
    echo "user table created<br>";
}
$order_table="CREATE TABLE IF NOT EXISTS user_order (
    o_id INT(5) AUTO_INCREMENT PRIMARY KEY,
    product_id INT(3),
    user_id INT(4),
    qty INT(3),
    o_price INT(5),
    status INT(1),
    d_date DATETIME,
    o_date DATETIME,
    payment_id INT(2)
)";
$reslut_qry=mysqli_query($con,$order_table);
if($reslut_qry)
{
    echo "order table created";
}
?>