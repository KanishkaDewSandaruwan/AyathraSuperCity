<?php
require_once '../service/index.php';

if (isset($_REQUEST['customer_id']) && $_REQUEST['customer_id'] != '') {
    deleteCustomer($_REQUEST['customer_id']);
    redirectToOriginalPage();

} else if (isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] != '') {
    deleteCategory($_REQUEST['cat_id']);
    redirectToOriginalPage();

} else if (isset($_REQUEST['product_id']) && $_REQUEST['product_id'] != '') {
    deleteProduct($_REQUEST['product_id']);
    redirectToOriginalPage();

} else if (isset($_REQUEST['contact_id']) && $_REQUEST['contact_id'] != '') {
    deleteContact($_REQUEST['contact_id']);
    redirectToOriginalPage();

} else if (isset($_REQUEST['subcat_id']) && $_REQUEST['subcat_id'] != '') {
    deleteSubcategory($_REQUEST['subcat_id']);
    redirectToOriginalPage();
    
}

function redirectToOriginalPage() {
    // Output JavaScript alert and redirect
    echo '<script>alert("Deleted successfully!");';
    echo 'window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
    exit();
}
?>
