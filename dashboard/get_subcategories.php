<?php

include '../service/inc/connection.php';

// Retrieve categoryId from POST data
$categoryId = $_POST['categoryId'];

// Use prepared statements to prevent SQL injection
$sqlquery = "SELECT * FROM subcategory WHERE is_deleted = 0 AND cat_id = ?";

// Prepare the statement
$stmt = mysqli_prepare($con, $sqlquery);

// Bind the parameters
mysqli_stmt_bind_param($stmt, 'i', $categoryId);

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result set
$result = mysqli_stmt_get_result($stmt);

// Close the statement
mysqli_stmt_close($stmt);

// Check if there are rows in the result set
if ($result && mysqli_num_rows($result) > 0) {
    // Build HTML options list
    $options = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row['subcat_id'] . '">' . $row['subcatname'] . '</option>';
    }
} else {
    // No subcategories found
    $options = '<option value="" disabled>No subcategories found</option>';
}

// Return the options list
echo $options;

?>
