<?php

function deleteCustomer($customer_id)
{
    include 'connection.php';

    $sqlquery = "UPDATE customer SET is_deleted = 1  WHERE customer_id = '$customer_id'";
    return mysqli_query($con, $sqlquery);
}

function deleteCategory($cat_id)
{
    include 'connection.php';

    $sqlquery = "UPDATE category SET is_deleted = 1  WHERE cat_id = '$cat_id'";
    return mysqli_query($con, $sqlquery);
}

function deleteProduct($product_id)
{
    include 'connection.php';

    $sqlquery = "UPDATE product SET is_deleted = 1  WHERE product_id = '$product_id'";
    return mysqli_query($con, $sqlquery);
}

function deleteContact($contact_id)
{
    include 'connection.php';

    $sqlquery = "UPDATE contact SET is_deleted = 1  WHERE contact_id = '$contact_id'";
    return mysqli_query($con, $sqlquery);
}

function deleteSubcategory($subcat_id)
{
    include 'connection.php';

    $sqlquery = "UPDATE subcategory SET is_deleted = 1  WHERE subcat_id = '$subcat_id'";
    return mysqli_query($con, $sqlquery);
}

?>