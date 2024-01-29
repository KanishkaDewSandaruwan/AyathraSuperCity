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
                    <li class="menu-item active">
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
                            <h6 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Customer
                                List</h6>
                        </div>
                        <div class="row">
                            <!-- Responsive Table -->
                            <div class="card">
                                <h5 class="card-header">Customer List</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>#</th>
                                                <th>Customer Name</th>
                                                <th>Customer Email</th>
                                                <th>Customer Phone</th>
                                                <th>Customer NIC</th>
                                                <th>Customer Address</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Call the getallCustomer function to retrieve data
                                            $customers = getallCustomer();

                                            // Check if there are any records
                                            if ($customers && mysqli_num_rows($customers) > 0) {
                                                $counter = 1;
                                                // Loop through the customer data and display it in the table
                                                while ($row = mysqli_fetch_assoc($customers)) {
                                                    echo "<tr>";
                                                    echo "<th scope='row'>" . $counter . "</th>";
                                                    echo "<td>" . $row['customer_name'] . "</td>";
                                                    echo "<td>" . $row['customer_email'] . "</td>";
                                                    echo "<td>" . $row['customer_phone'] . "</td>";
                                                    echo "<td>" . $row['customer_nic'] . "</td>";
                                                    echo "<td>" . $row['customer_address'] . "</td>";
                                                    echo "<td>" . $row['trndate'] . "</td>";
                                                    echo "<td>";
                                                    echo "<button class='btn btn-danger btn-sm' onclick='deleteCustomer(" . $row['customer_id'] . ")'>Delete</button>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                    $counter++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>No records found</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--/ Responsive Table -->
                        </div>

                        <!-- Footer -->
                        <?php require_once './pages/footer.php' ?>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>

                <script>
                    function deleteCustomer(customerId) {
                        if (confirm("Are you sure you want to delete this customer?")) {
                            window.location.href = 'delete.php?customer_id=' + customerId;
                        }
                    }
                </script>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->
        <?php require_once './pages/footer_assets.php' ?>
</body>

</html>