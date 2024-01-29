<?php
// Include your connection file
require_once '../service/index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $categoryId = mysqli_real_escape_string($con, $_POST['editImageCategoryId']);

    // Handle image upload
    $targetDirectory = "../service/uploads/category/";
    $targetFile = $targetDirectory . basename($_FILES["editCategoryImage"]["name"]);

    if (move_uploaded_file($_FILES["editCategoryImage"]["tmp_name"], $targetFile)) {
        // Image uploaded successfully
        // Perform the SQL query to update the category image
        $sql = "UPDATE category SET cat_image = '$targetFile' WHERE cat_id = '$categoryId'";

        if (mysqli_query($con, $sql)) {
            // Category image updated successfully
            header('Location: category.php'); // Redirect back to the category page
            exit();
        } else {
            // Error updating category image
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Error uploading image.";
    }

    // Close the connection
    mysqli_close($con);
}
?>
