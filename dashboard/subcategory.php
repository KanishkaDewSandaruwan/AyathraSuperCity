<?php
require_once '../service/index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../service/inc/connection.php';

    if (isset($_POST['categoryName']) && isset($_FILES['categoryImage'])) {
        // Add New Category
        $categoryName = mysqli_real_escape_string($con, $_POST['categoryName']);
        $targetDirectory = "../service/uploads/category/";

        if (empty($categoryName)) {
            displayErrorWithAlert("Category name cannot be empty.");
        } else {
            $checkDuplicate = mysqli_query($con, "SELECT cat_id FROM category WHERE is_deleted = 0 AND cat_name = '$categoryName' LIMIT 1");

            if (mysqli_num_rows($checkDuplicate) > 0) {
                displayErrorWithAlert("Category with the same name already exists.");
            } else {
                handleImageUpload($targetDirectory, 'categoryImage', $categoryName);
                // Perform the SQL query to add the new category
                $sql = "INSERT INTO category(cat_name, cat_image, trndate, is_deleted, status) VALUES ('$categoryName', '$targetFile', NOW(), 0, 1)";

                if (mysqli_query($con, $sql)) {
                    displaySuccessWithAlert("Category added successfully.");
                } else {
                    displayErrorWithAlert("Error: " . mysqli_error($con));
                }
            }
        }
    } elseif (isset($_POST['subcategoryName']) && isset($_POST['catId']) && isset($_FILES['subcategoryImage'])) {
        // Add New Subcategory
        $subcategoryName = mysqli_real_escape_string($con, $_POST['subcategoryName']);
        $catId = mysqli_real_escape_string($con, $_POST['catId']);
        $targetDirectory = "../service/uploads/subcategory/";

        if (empty($subcategoryName)) {
            displayErrorWithAlert("Subcategory name cannot be empty.");
        } else {
            $checkDuplicate = mysqli_query($con, "SELECT subcat_id FROM subcategory WHERE is_deleted = 0 AND subcatname = '$subcategoryName' LIMIT 1");

            if (mysqli_num_rows($checkDuplicate) > 0) {
                displayErrorWithAlert("Subcategory with the same name already exists.");
            } else {
                handleImageUpload($targetDirectory, 'subcategoryImage', $subcategoryName);
                // Perform the SQL query to add the new subcategory
                $sql = "INSERT INTO subcategory(cat_id, subcatname, subcat_image, is_deleted) VALUES ('$catId', '$subcategoryName', '$targetFile', 0)";

                if (mysqli_query($con, $sql)) {
                    displaySuccessWithAlert("Subcategory added successfully.");
                } else {
                    displayErrorWithAlert("Error: " . mysqli_error($con));
                }
            }
        }
    }

    mysqli_close($con);
}

function handleImageUpload($targetDirectory, $inputName, $itemName)
{
    global $targetFile;

    if (isset($_FILES[$inputName]) && $_FILES[$inputName]["error"] == 0) {
        $targetFile = $targetDirectory . basename($_FILES[$inputName]["name"]);

        $check = getimagesize($_FILES[$inputName]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetFile)) {
                return; // Image uploaded successfully
            } else {
                displayErrorWithAlert("Error uploading image for $itemName.");
            }
        } else {
            displayErrorWithAlert("Invalid image file for $itemName.");
        }
    } else {
        displayErrorWithAlert("Please select an image file for $itemName.");
    }
}

function displayErrorWithAlert($message)
{
    echo '<script>alert("' . $message . '"); window.location.href = "subcategory.php";</script>';
    exit();
}


function displaySuccessWithAlert($message)
{
    echo '<script>alert("' . $message . '"); window.location.href = "subcategory.php";</script>';
    exit();
}

?>
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
                    <li class="menu-item ">
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
                                Category
                                List</h6>
                        </div>
                        <!-- Add Subcategory Button -->
                        <div class="mb-3">
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addSubcategoryModal">
                                Add New Subcategory
                            </button>
                        </div>

                        <!-- Subcategory Table -->
                        <div class="card">
                            <h5 class="card-header">Sub Category List</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <!-- Table Header -->
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Sub Category Name</th>
                                            <th>Image</th>
                                            <th>Edit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        <?php
                                        // Call the getallSubcategories function to retrieve data
                                        $subcategories = getallSubcategory();

                                        // Check if there are any records
                                        if ($subcategories && mysqli_num_rows($subcategories) > 0) {
                                            $counter = 1;
                                            // Loop through the subcategory data and display it in the table
                                            while ($row = mysqli_fetch_assoc($subcategories)) {

                                                $categories = get_categories($row['cat_id']);
                                                if ($row2 = mysqli_fetch_assoc($categories)) {

                                                    echo "<tr>";
                                                    echo "<th scope='row'>" . $counter . "</th>";
                                                    echo "<td>" . $row2['cat_name'] . "</td>";
                                                    echo "<td>" . $row['subcatname'] . "</td>";
                                                    echo "<td><img src='" . $row['subcat_image'] . "' width='100px' class='image-edit-btn-subcategory' data-bs-toggle='modal' data-bs-target='#editSubcategoryImageModal' data-subcategory-id='" . $row['subcat_id'] . "'></td>";
                                                    echo "<td><button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editSubcategoryNameModal' data-subcategory-id='" . $row['subcat_id'] . "' data-subcategory-name='" . $row['subcatname'] . "'>Edit Name</button></td>";
                                                    echo "<td><button class='btn btn-danger btn-sm' onclick='deleteSubcategory(" . $row['subcat_id'] . ")'>Delete</button></td>";
                                                    echo "</tr>";
                                                    $counter++;
                                                }
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No records found</td></tr>";
                                        }
                                        ?>
                                        <script>

                                            function deleteSubcategory(subcategoryId) {
                                                if (confirm("Are you sure you want to delete this subcategory?")) {
                                                    window.location.href = 'delete.php?subcat_id=' + subcategoryId;
                                                }
                                            }
                                        </script>
                                    </tbody>
                                </table>
                            </div>
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
        <!-- Edit Image Modal -->
        <div class="modal fade" id="editSubcategoryImageModal" tabindex="-1" role="dialog"
            aria-labelledby="editImageModalLabel" aria-hidden="true">
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

        <!-- Add Subcategory Modal -->
        <div class="modal fade" id="addSubcategoryModal" tabindex="-1" role="dialog"
            aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add New Subcategory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your form fields here -->
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="subcategoryName" class="form-label">Subcategory Name</label>
                                <input type="text" class="form-control" id="subcategoryName" name="subcategoryName"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="subcategoryImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="subcategoryImage" name="subcategoryImage"
                                    accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="catId" class="form-label">Category</label>
                                <select class="form-select" id="catId" name="catId" required>
                                    <!-- Populate this dropdown with category options -->
                                    <?php
                                    $categories = getallCategory();
                                    while ($row = mysqli_fetch_assoc($categories)) {
                                        echo "<option value='{$row['cat_id']}'>{$row['cat_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Subcategory</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Name Modal for Subcategory -->
        <div class="modal fade" id="editSubcategoryNameModal" tabindex="-1" role="dialog"
            aria-labelledby="editNameModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNameModalLabel">Edit Subcategory Name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your form fields for editing subcategory name here -->
                        <form method="post" action="edit_subcategory.php">
                            <input type="hidden" id="editNameSubcategoryId" name="editNameSubcategoryId">
                            <div class="mb-3">
                                <label for="editSubcategoryName" class="form-label">New Subcategory Name</label>
                                <input type="text" class="form-control" id="editSubcategoryName"
                                    name="editSubcategoryName" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('.image-edit-btn-subcategory').click(function () {
                    var subcategoryId = $(this).data('subcategory-id');
                    $('#editImageSubcategoryId').val(subcategoryId);
                });

                $('button[data-bs-target="#editSubcategoryNameModal"]').click(function () {
                    var subcategoryId = $(this).data('subcategory-id');
                    var subcategoryName = $(this).data('subcategory-name');
                    $('#editNameSubcategoryId').val(subcategoryId);
                    $('#editSubcategoryName').val(subcategoryName);
                });
            });
        </script>


</body>

</html>