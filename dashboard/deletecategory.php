<?php
require_once '../service/index.php';

if (isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] != '') {
    // Assuming deleteCategory function needs to be called
    // Ensure to implement proper validation and sanitization before using user input in SQL queries
    $catId = $_REQUEST['cat_id'];
    // deleteCategory($catId);

    // Redirect after deleting the category
    header('Location: category.php');
    exit;
}
?>
