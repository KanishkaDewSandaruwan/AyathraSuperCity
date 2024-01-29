<?php
// Include your connection file
require_once '../service/index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $categoryId = mysqli_real_escape_string($con, $_POST['editNameCategoryId']);
    $newCategoryName = mysqli_real_escape_string($con, $_POST['editCategoryName']);

    // Perform the SQL query to update the category name
    $sql = "UPDATE category SET cat_name = '$newCategoryName' WHERE cat_id = '$categoryId'";

    if (mysqli_query($con, $sql)) {
        // Category name updated successfully
        header('Location: category.php'); // Redirect back to the category page
        exit();
    } else {
        // Error updating category name
        echo "Error: " . mysqli_error($con);
    }

    // Close the connection
    mysqli_close($con);
}
?>
