<?php

//get all
function getallCustomer()
{
    include 'connection.php';

    $sqlquery = "SELECT * FROM customer WHERE is_deleted = 0 ORDER BY trndate DESC";
    return mysqli_query($con, $sqlquery);
}
function getallCategory()
{
    include 'connection.php';

    $sqlquery = "SELECT * FROM category WHERE is_deleted = 0 ORDER BY trndate DESC";
    return mysqli_query($con, $sqlquery);
}
function getallSubcategory()
{
    include 'connection.php';

    $sqlquery = "SELECT * FROM subcategory WHERE is_deleted = 0";
    return mysqli_query($con, $sqlquery);
}
function get_subcategories($subcat_id )
{
    include 'connection.php';

    $sqlquery = "SELECT * FROM subcategory WHERE is_deleted = 0 AND subcat_id  = '".$subcat_id."'";
    return mysqli_query($con, $sqlquery);
}
function get_categories($cat_id)
{
    include 'connection.php';

    $sqlquery = "SELECT * FROM category WHERE is_deleted = 0 AND cat_id = '".$cat_id."'";
    return mysqli_query($con, $sqlquery);
}
function getallProducts()
{
    include 'connection.php';

    $sqlquery = "SELECT * FROM product join category on category.cat_id = product.product_catid  WHERE product.is_deleted = 0 ORDER BY product.trndate DESC";
    return mysqli_query($con, $sqlquery);
}
function getallContact()
{
    include 'connection.php';

    $sqlquery = "SELECT * FROM contact WHERE is_deleted = 0 ORDER BY trndate DESC";
    return mysqli_query($con, $sqlquery);
}

?>