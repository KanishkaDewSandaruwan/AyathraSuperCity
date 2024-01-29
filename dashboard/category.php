+
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/"
    data-template="vertical-menu-template-free">
<?php require_once './pages/header.php' ?>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.php" class="app-brand-link">
                        <span class="app-brand-logo demo">

                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">Ayathra</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item ">
                        <a href="index.php" class="menu-link">
                            <i class="menu-icon bx bx-home-circle"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>

                    <!-- Customer -->
                    <li class="menu-item ">
                        <a href="customer.php" class="menu-link">
                            <i class="menu-icon bx bx-user"></i>
                            <div data-i18n="Customer">Customer</div>
                        </a>
                    </li>

                    <!-- Orders -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon bx bx-shopping-bag"></i>
                            <div data-i18n="Orders">Orders</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="order-pending.php" class="menu-link">
                                    <div data-i18n="Pending Orders">Pending Orders</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="order-completed.php" class="menu-link">
                                    <div data-i18n="Completed Orders">Completed Orders</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Products -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon bx bx-package"></i>
                            <div data-i18n="Products">Products</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="products.php" class="menu-link">
                                    <div data-i18n="Products List">Products List</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="stocks.php" class="menu-link">
                                    <div data-i18n="Products List">Products List</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Category -->
                    <li class="menu-item active">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon bx bx-filter-alt"></i>
                            <div data-i18n="Filters">Filters</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="category.php" class="menu-link">
                                    <div data-i18n="Category">Category</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="subcategory.php" class="menu-link">
                                    <div data-i18n="Sub Category">Sub Category</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>


            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php require_once './pages/navbar.php' ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <h6 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Sub
                                Category</h6>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addCategoryModal">
                                    Add New Category
                                </button>
                            </div>
                            <!-- Responsive Table -->
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Include your connection file
                                require_once '../service/inc/connection.php';

                                // Retrieve form data
                                $categoryName = mysqli_real_escape_string($con, $_POST['categoryName']);

                                // Check if category name is not empty
                                if (empty($categoryName)) {
                                    echo '<div id="error-toast" class="alert alert-danger alert-dismissible" role="alert">
                                        Category name cannot be empty.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                                    echo '<script>
                                        setTimeout(function(){
                                            window.location.href = "category.php";
                                        }, 2000); // Reload the page after 2 seconds
                                    </script>';
                                } else {
                                    // Check if the category name already exists
                                    $checkDuplicate = mysqli_query($con, "SELECT cat_id FROM category WHERE is_deleted = 0 AND cat_name = '$categoryName' LIMIT 1");

                                    if (mysqli_num_rows($checkDuplicate) > 0) {
                                        echo '<div id="error-toast" class="alert alert-danger alert-dismissible" role="alert">
                                            Category with the same name already exists.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                                        echo '<script>
                                            setTimeout(function(){
                                                window.location.href = "category.php";
                                            }, 2000); // Reload the page after 2 seconds
                                        </script>';
                                    } else {
                                        // Handle image upload
                                        $targetDirectory = "../service/uploads/category/"; // Change this to your desired upload directory
                            
                                        // Check if an image file was selected
                                        if (isset($_FILES["categoryImage"]) && $_FILES["categoryImage"]["error"] == 0) {
                                            $targetFile = $targetDirectory . basename($_FILES["categoryImage"]["name"]);

                                            // Check if the image file is a valid image
                                            $check = getimagesize($_FILES["categoryImage"]["tmp_name"]);
                                            if ($check !== false) {
                                                // Move the uploaded file
                                                if (move_uploaded_file($_FILES["categoryImage"]["tmp_name"], $targetFile)) {
                                                    // Image uploaded successfully
                                                    // Perform the SQL query to add the new category
                                                    $sql = "INSERT INTO category(cat_name, cat_image, trndate, is_deleted, status) VALUES ('$categoryName', '$targetFile', NOW(), 0, 1)";

                                                    if (mysqli_query($con, $sql)) {
                                                        // Category added successfully
                                                        echo '<div id="success-toast" class="alert alert-success alert-dismissible" role="alert">
                                                                Category added successfully.
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>';
                                                        echo '<script>
                                                            setTimeout(function(){
                                                                window.location.href = "category.php";
                                                            }, 2000); // Reload the page after 2 seconds
                                                            </script>';
                                                        exit();
                                                    } else {
                                                        // Error adding category
                                                        echo '<div id="error-toast" class="alert alert-danger alert-dismissible" role="alert">
                                                            Error: ' . mysqli_error($con) . '
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>';
                                                        echo '<script>
                                                            setTimeout(function(){
                                                                window.location.href = "category.php";
                                                            }, 2000); // Reload the page after 2 seconds
                                                            </script>';
                                                    }
                                                } else {
                                                    echo '<div id="error-toast" class="alert alert-danger alert-dismissible" role="alert">
                                                    Error uploading image.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                                    echo '<script>
                                                            setTimeout(function(){
                                                                window.location.href = "category.php";
                                                            }, 2000); // Reload the page after 2 seconds
                                                            </script>';
                                                }
                                            } else {
                                                echo '<div id="error-toast" class="alert alert-danger alert-dismissible" role="alert">
                                                Invalid image file.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                                echo '<script>
                                                            setTimeout(function(){
                                                                window.location.href = "category.php";
                                                            }, 2000); // Reload the page after 2 seconds
                                                            </script>';
                                            }
                                        } else {
                                            echo '<div id="error-toast" class="alert alert-danger alert-dismissible" role="alert">
                                                Please select an image file.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                            echo '<script>
                                                            setTimeout(function(){
                                                                window.location.href = "category.php";
                                                            }, 2000); // Reload the page after 2 seconds
                                                            </script>';
                                        }
                                    }
                                }

                                // Close the connection
                                mysqli_close($con);
                            }
                            ?>
                            <script>
                                // Automatically close the success toast after 1 minute (60,000 milliseconds)
                                setTimeout(function () {
                                    var successToast = new bootstrap.Toast(document.getElementById("success-toast"));
                                    successToast.hide();
                                }, 100);

                                // Automatically close the error toast after 1 minute (60,000 milliseconds)
                                setTimeout(function () {
                                    var errorToast = new bootstrap.Toast(document.getElementById("error-toast"));
                                    errorToast.hide();
                                }, 100);
                            </script>



                            <div class="card">
                                <h5 class="card-header">Category List</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>#</th>
                                                <th>Category Name</th>
                                                <th>Image</th>
                                                <th>Date</th>
                                                <th>Edit</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Call the getallCategories function to retrieve data
                                            $categories = getallCategory();

                                            // Check if there are any records
                                            if ($categories && mysqli_num_rows($categories) > 0) {
                                                $counter = 1;
                                                // Loop through the category data and display it in the table
                                                while ($row = mysqli_fetch_assoc($categories)) {
                                                    echo "<tr>";
                                                    echo "<th scope='row'>" . $counter . "</th>";
                                                    echo "<td>" . $row['cat_name'] . "</td>";
                                                    echo "<td><img src='" . $row['cat_image'] . "' width='100px' class='image-edit-btn' data-bs-toggle='modal' data-bs-target='#editImageModal' data-category-id='" . $row['cat_id'] . "'></td>";
                                                    echo "<td>" . $row['trndate'] . "</td>";
                                                    echo "<td><button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editNameModal' data-category-id='" . $row['cat_id'] . "' data-category-name='" . $row['cat_name'] . "'>Edit Name</button></td>";
                                                    echo "<td><button class='btn btn-danger btn-sm' onclick='deleteCategory(" . $row['cat_id'] . ")'>Delete</button></td>";
                                                    echo "</tr>";
                                                    $counter++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'>No records found</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <script>
                                function deleteCategory(categoryId) {
                                    if (confirm("Are you sure you want to delete this category?")) {
                                        window.location.href = 'delete.php?cat_id=' + categoryId;
                                    }
                                }
                            </script>

                            <!--/ Responsive Table -->
                        </div>

                        <!-- Footer -->
                        <?php require_once './pages/footer.php' ?>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->
        <?php require_once './pages/footer_assets.php' ?>
        <script>
            $(document).ready(function () {
                $('.image-edit-btn').click(function () {
                    var categoryId = $(this).data('category-id');
                    $('#editImageCategoryId').val(categoryId);
                });
            });
        </script>

        <!-- Edit Image Modal -->
        <div class="modal fade" id="editImageModal" tabindex="-1" role="dialog" aria-labelledby="editImageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editImageModalLabel">Edit Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your form fields for editing the image here -->
                        <form method="post" action="edit_catimage.php" enctype="multipart/form-data">
                            <input type="hidden" id="editImageCategoryId" name="editImageCategoryId">
                            <div class="mb-3">
                                <label for="editCategoryImage" class="form-label">New Image</label>
                                <input type="file" class="form-control" id="editCategoryImage" name="editCategoryImage"
                                    accept="image/*">
                            </div>
                            <!-- Add other fields for editing image information -->
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Add Category Modal -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog"
            aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your form fields here -->
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" name="categoryName" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoryImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="categoryImage" name="categoryImage"
                                    accept="image/*" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('button[data-bs-target="#editNameModal"]').click(function () {
                    var categoryId = $(this).data('category-id');
                    var categoryName = $(this).data('category-name');
                    $('#editNameCategoryId').val(categoryId);
                    $('#editCategoryName').val(categoryName);
                });
            });
        </script>
        <!-- Edit Name Modal -->
        <div class="modal fade" id="editNameModal" tabindex="-1" role="dialog" aria-labelledby="editNameModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNameModalLabel">Edit Category Name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your form fields for editing category name here -->
                        <form method="post" action="edit_category.php">
                            <input type="hidden" id="editNameCategoryId" name="editNameCategoryId">
                            <div class="mb-3">
                                <label for="editCategoryName" class="form-label">New Category Name</label>
                                <input type="text" class="form-control" id="editCategoryName" name="editCategoryName"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        // Check if the reload parameter is present in the URL
        if (isset($_GET['reload']) && $_GET['reload'] == 'true') {
            echo '<script type="text/javascript">
            // Use JavaScript to reload the page
            location.reload();
          </script>';
        }
        ?>

</body>

</html>