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
                    <li class="menu-item active">
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
                    <li class="menu-item">
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
                            <h6 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Products
                                List</h6>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addProductModal">
                                    Add New Product
                                </button>
                            </div>
                            <!-- Responsive Table -->
                            <div class="card">
                                <h5 class="card-header">Product List</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Discount</th>
                                                <th>Purchase Price</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Call the getallProducts function to retrieve data
                                            $products = getallProducts();

                                            // Check if there are any records
                                            if ($products && mysqli_num_rows($products) > 0) {
                                                $counter = 1;
                                                // Loop through the product data and display it in the table
                                                // Loop through the product data and display it in the table
                                                while ($row = mysqli_fetch_assoc($products)) {
                                                    // Fetch subcategory data
                                                    $subcatData = mysqli_fetch_assoc(get_subcategories($row['subcat_id']));

                                                    echo "<tr>";
                                                    echo "<th scope='row'>" . $counter . "</th>";
                                                    echo "<td>" . $row['product_name'] . "</td>";
                                                    echo "<td>" . $row['cat_name'] . "</td>";

                                                    // Check if subcategory data is fetched successfully
                                                    if ($subcatData) {
                                                        echo "<td>" . $subcatData['subcatname'] . "</td>";
                                                    } else {
                                                        echo "<td>Subcategory Not Found</td>";
                                                    }

                                                    echo "<td>" . $row['product_catid'] . "</td>";
                                                    echo "<td>" . $row['product_description'] . "</td>";
                                                    echo "<td><img src='" . $row['product_image'] . "' width='100px' class='image-edit-btn' data-bs-toggle='modal' data-bs-target='#editImageModal' data-category-id='" . $row['product_id'] . "'></td>";
                                                    echo "<td>" . $row['product_price'] . "</td>";
                                                    echo "<td>" . $row['product_qty'] . "</td>";
                                                    echo "<td>" . $row['product_discount'] . "</td>";
                                                    echo "<td>" . $row['product_purchesprice'] . "</td>";
                                                    echo "<td>" . $row['status'] . "</td>";
                                                    echo "<td>" . $row['trndate'] . "</td>";
                                                    echo "<td>";
                                                    echo "<button class='btn btn-danger btn-sm' onclick='deleteProduct(" . $row['product_id'] . ")'>Delete</button>";

                                                    // Add Edit button with a data attribute for the product ID
                                                    echo "<button class='btn btn-primary btn-sm' onclick='editProduct(" . $row['product_id'] . ")'>Edit</button>";

                                                    echo "</td>";
                                                    echo "</tr>";
                                                    $counter++;
                                                }

                                            } else {
                                                echo "<tr><td colspan='13'>No records found</td></tr>";
                                            }
                                            ?>

                                            <script>
                                                function editProduct(productId) {
                                                    // Set the modal's href attribute dynamically based on the product ID
                                                    $('#editProductModal').attr('href', 'edit_product_modal.php?product_id=' + productId);

                                                    // Trigger the modal to open
                                                    $('#editProductModal').modal('show');
                                                }
                                            </script>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- JavaScript to handle the deletion -->
                            <script>
                                function deleteProduct(productId) {
                                    if (confirm("Are you sure you want to delete this product?")) {
                                        window.location.href = 'delete.php?product_id=' + productId;
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

        <!-- Add Product Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your form fields here -->
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="productName" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoryId" class="form-label">Category</label>
                                <select class="form-select" id="categoryId" name="categoryId" required>
                                    <?php
                                    // Call the getallCategory function to retrieve category data
                                    $categories = getallCategory();

                                    // Check if there are any categories
                                    if ($categories && mysqli_num_rows($categories) > 0) {
                                        echo "<option value='0'>Select Category</option>";
                                        while ($category = mysqli_fetch_assoc($categories)) {
                                            echo "<option value='" . $category['cat_id'] . "'>" . $category['cat_name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value='' disabled>No categories found</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subcategoryId" class="form-label">Subcategory</label>
                                <select class="form-select" id="subcategoryId" name="subcategoryId" required>
                                    <!-- Subcategories will be dynamically loaded here -->
                                </select>
                            </div>

                            <script>
                                $(document).ready(function () {
                                    $('#categoryId').change(function () {
                                        var categoryId = $(this).val();

                                        // Make an AJAX call to fetch subcategories based on the selected category
                                        $.ajax({
                                            url: 'get_subcategories.php', // Replace with your PHP script to fetch subcategories
                                            method: 'POST',
                                            data: { categoryId: categoryId },
                                            success: function (response) {
                                                console.log(response)
                                                // Update the subcategory select element with the fetched subcategories
                                                $('#subcategoryId').html(response);
                                            },
                                            error: function () {
                                                console.error('Error fetching subcategories.');
                                            }
                                        });
                                    });
                                });
                            </script>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="productDescription" name="productDescription"
                                    rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="productImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="productImage" name="productImage"
                                    accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Price</label>
                                <input type="number" class="form-control" id="productPrice" name="productPrice"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="productQuantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="productQuantity" name="productQuantity"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="productDiscount" class="form-label">Discount</label>
                                <input type="number" class="form-control" id="productDiscount" name="productDiscount"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="productPurchasePrice" class="form-label">Purchase Price</label>
                                <input type="number" class="form-control" id="productPurchasePrice"
                                    name="productPurchasePrice" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>

                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            // Retrieve form data
                            $productName = mysqli_real_escape_string($con, $_POST['productName']);

                            // Check if the product name already exists
                            $checkDuplicate = mysqli_query($con, "SELECT product_id FROM product WHERE is_deleted = 0 AND product_name = '$productName' LIMIT 1");

                            if (mysqli_num_rows($checkDuplicate) > 0) {
                                // Product with the same name already exists
                                displayError("Product with the same name already exists.");
                            }

                            // Retrieve other form data
                            $categoryId = mysqli_real_escape_string($con, $_POST['categoryId']);
                            $subcategoryId = mysqli_real_escape_string($con, $_POST['subcategoryId']);
                            $productDescription = mysqli_real_escape_string($con, $_POST['productDescription']);
                            $productPrice = mysqli_real_escape_string($con, $_POST['productPrice']);
                            $productQuantity = mysqli_real_escape_string($con, $_POST['productQuantity']);
                            $productDiscount = mysqli_real_escape_string($con, $_POST['productDiscount']);
                            $productPurchasePrice = mysqli_real_escape_string($con, $_POST['productPurchasePrice']);
                            $status = mysqli_real_escape_string($con, $_POST['status']);

                            // Handle image upload
                            $targetDirectory = "../service/uploads/products";
                            $targetFile = $targetDirectory . basename($_FILES["productImage"]["name"]);

                            // Check if the image file is a valid image
                            $check = getimagesize($_FILES["productImage"]["tmp_name"]);
                            if ($check !== false) {
                                if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
                                    // Image uploaded successfully
                                    // Perform the SQL query to add the new product
                                    $sql = "INSERT INTO product (product_name, product_catid, product_description, product_image, product_price, product_qty, product_discount, product_purchesprice, status, trndate, is_deleted, subcat_id) VALUES('$productName', '$categoryId', '$productDescription', '$targetFile', '$productPrice', '$productQuantity', '$productDiscount', '$productPurchasePrice', '$status', NOW(), 0, '$subcategoryId')";

                                    if (mysqli_query($con, $sql)) {
                                        echo '<script>alert("Product saved successfully!");';
                                        echo 'window.location.href = "products.php";</script>';
                                        exit();
                                    } else {
                                        // Error adding product
                                        displayError("Error: " . mysqli_error($con));
                                    }
                                } else {
                                    // Error uploading image
                                    displayError("Error uploading image.");
                                }
                            } else {
                                // Invalid image file
                                displayError("Invalid image file.");
                            }

                            // Close the connection
                            mysqli_close($con);
                        }

                        function displayError($message)
                        {
                            echo '<script>alert("' . $message . '"); window.location.href = "products.php";</script>';
                            exit();
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Edit product logic
        
            $productId = mysqli_real_escape_string($con, $_POST['editProductId']);
            $productName = mysqli_real_escape_string($con, $_POST['editProductName']);
            $categoryId = mysqli_real_escape_string($con, $_POST['editCategoryId']);
            $subcategoryId = mysqli_real_escape_string($con, $_POST['editSubcategoryId']);
            $productDescription = mysqli_real_escape_string($con, $_POST['editProductDescription']);
            $productPrice = mysqli_real_escape_string($con, $_POST['editProductPrice']);
            $productQuantity = mysqli_real_escape_string($con, $_POST['editProductQuantity']);
            $productDiscount = mysqli_real_escape_string($con, $_POST['editProductDiscount']);
            $productPurchasePrice = mysqli_real_escape_string($con, $_POST['editProductPurchasePrice']);
            $status = mysqli_real_escape_string($con, $_POST['editStatus']);

            // Handle image upload
            $targetDirectory = "../service/uploads/products";
            $targetFile = $targetDirectory . basename($_FILES["editProductImage"]["name"]);

            // Check if a new image is provided
            if ($_FILES["editProductImage"]["size"] > 0) {
                // Check if the image file is a valid image
                $check = getimagesize($_FILES["editProductImage"]["tmp_name"]);
                if ($check !== false) {
                    if (move_uploaded_file($_FILES["editProductImage"]["tmp_name"], $targetFile)) {
                        // Update product details with the new image
                        $updateSql = "UPDATE product SET product_name = '$productName', product_catid = '$categoryId', subcat_id = '$subcategoryId', product_description = '$productDescription', product_image = '$targetFile', product_price = '$productPrice', product_qty = '$productQuantity', product_discount = '$productDiscount', product_purchesprice = '$productPurchasePrice', status = '$status' WHERE product_id = '$productId'";
                    } else {
                        displayError("Error uploading image.");
                    }
                } else {
                    displayError("Invalid image file.");
                }
            } else {
                // Update product details without changing the image
                $updateSql = "UPDATE product SET product_name = '$productName', product_catid = '$categoryId', subcat_id = '$subcategoryId', product_description = '$productDescription', product_price = '$productPrice', product_qty = '$productQuantity', product_discount = '$productDiscount', product_purchesprice = '$productPurchasePrice', status = '$status' WHERE product_id = '$productId'";
            }

            if (mysqli_query($con, $updateSql)) {
                echo '<script>alert("Product updated successfully!"); window.location.href = "products.php";</script>';
                exit();
            } else {
                displayError("Error updating product: " . mysqli_error($con));
            }
        }

        // Display the existing product details for editing
        if (isset($_GET['editProduct'])) {
            $editProductId = mysqli_real_escape_string($con, $_GET['editProduct']);
            $editProduct = getSingleProduct($editProductId);

            if ($editProduct && mysqli_num_rows($editProduct) > 0) {
                $editRow = mysqli_fetch_assoc($editProduct);
                ?>
                <!-- Add your form fields here -->
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="editProductId" value="<?php echo $editRow['product_id']; ?>">
                    <div class="mb-3">
                        <label for="editProductName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="editProductName" name="editProductName" required
                            value="<?php echo $editRow['product_name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryId" class="form-label">Category</label>
                        <select class="form-select" id="editCategoryId" name="editCategoryId" required>
                            <?php
                            // Call the getallCategory function to retrieve category data
                            $categories = getallCategory();

                            // Check if there are any categories
                            if ($categories && mysqli_num_rows($categories) > 0) {
                                while ($category = mysqli_fetch_assoc($categories)) {
                                    $selected = ($category['cat_id'] == $editRow['product_catid']) ? 'selected' : '';
                                    echo "<option value='" . $category['cat_id'] . "' $selected>" . $category['cat_name'] . "</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No categories found</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editSubcategoryId" class="form-label">Subcategory</label>
                        <select class="form-select" id="editSubcategoryId" name="editSubcategoryId" required>
                            <?php
                            // Call the get_subcategories function to retrieve subcategory data
                            $subcategories = get_subcategories($editRow['product_catid']);

                            // Check if there are any subcategories
                            if ($subcategories && mysqli_num_rows($subcategories) > 0) {
                                while ($subcategory = mysqli_fetch_assoc($subcategories)) {
                                    $selected = ($subcategory['subcat_id'] == $editRow['subcat_id']) ? 'selected' : '';
                                    echo "<option value='" . $subcategory['subcat_id'] . "' $selected>" . $subcategory['subcatname'] . "</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No subcategories found</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editProductDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editProductDescription" name="editProductDescription" rows="3"
                            required><?php echo $editRow['product_description']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editProductImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="editProductImage" name="editProductImage" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="editProductPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="editProductPrice" name="editProductPrice" required
                            value="<?php echo $editRow['product_price']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editProductQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="editProductQuantity" name="editProductQuantity" required
                            value="<?php echo $editRow['product_qty']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editProductDiscount" class="form-label">Discount</label>
                        <input type="number" class="form-control" id="editProductDiscount" name="editProductDiscount" required
                            value="<?php echo $editRow['product_discount']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editProductPurchasePrice" class="form-label">Purchase Price</label>
                        <input type="number" class="form-control" id="editProductPurchasePrice" name="editProductPurchasePrice"
                            required value="<?php echo $editRow['product_purchesprice']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editStatus" name="editStatus" required>
                            <option value="1" <?php echo ($editRow['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                            <option value="0" <?php echo ($editRow['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
                <?php
            }
        }
        ?>

</body>

</html>