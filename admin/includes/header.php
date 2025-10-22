<?php


    // session_start();

    
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include './includes/db.php';

if ($_SESSION['admin_id'] == '') {
    echo "<script>
    window.location.href = 'login.php'
</script>";
}
if ($_SESSION['role'] == "1") {
    $project_user = "admin";
} else if ($_SESSION['role'] == "2") {
    $project_user = "project manager";
} else if ($_SESSION['role'] == "3") {
    $project_user = "project user";
}

$notifications = $_SESSION['notifications'] ?? [];


// $projectUser = false;
// if ($_SESSION['admin_id'] == '') {
//     echo "<script>window.location.href='login.php'</script>";
// }
// if ($_SESSION['role'] == 'SuperAdmin') {
//     $superAdmin = true;
// } else if ($_SESSION['role'] == 'Company') {
//     $company = true;
// } else {
//     $superViser = true;
// }


?>

<!doctype html>
<html lang="en" class="semi-dark">




<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/voydGeen1.png" type="image/png" />
    <!--plugins-->
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet"> -->
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="assets/css/dark-theme.css" />
    <link rel="stylesheet" href="assets/css/semi-dark.css" />
    <link rel="stylesheet" href="assets/css/header-colors.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- mono sans font start -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cedarville+Cursive&family=Mona+Sans:ital,wght@0,200..900;1,200..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- mono sans font end -->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- links added for states cities countries -->



    <!-- end -->
    <title>VOYD - Admin</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">

                <img src="assets/images/voydWite.png" class="header-icon" alt="logo icon">

                <!-- <div>
                    <h4 class="logo-text">Mr.Interior</h4>
                </div> -->
                <!-- <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
                </div> -->
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">


                <li><a href="index.php">
                        <!-- <i class='bx bx-grid-alt' style='color:#ffffff'  ></i> -->
                        <img src="assets/images/dashboard.png" class="sidebaricon" alt="sidebaricon">
                        <span class="navicon">Dashboard</span></a>
                </li>
                <?php
                if ($project_user == "admin") {
                ?>

                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon">
                                <!-- <i class='bx bx-slider-alt'></i> -->
                                <img src="assets/images/about.png" class="sidebaricon" alt="sidebaricon">
                            </div>
                            <div class="menu-title">Masters</div>
                        </a>
                        <ul class="sidebardropdownadjust">

                            <li>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="icon"><i class='bx bx-layer'></i>
                                    </div>
                                    <div class="menu-title">Product</div>
                                </a>
                                <ul>
                                    <li> <a href="color.php"><i class='bx bx-radio-circle'></i><span class="navicon">Colors</span></a></li>
                                    <li> <a href="sizes.php"><i class='bx bx-radio-circle'></i><span class="navicon">Dimensions</span></a></li>
                                    <li> <a href="material.php"><i class='bx bx-radio-circle'></i><span class="navicon">Material</span></a></li>
                                    <li> <a href="category.php"><i class='bx bx-radio-circle'></i><span class="navicon">Category</span></a></li>
                                    <li> <a href="subcategory.php"><i class='bx bx-radio-circle'></i><span class="navicon">Sub-Category</span></a>
                                    <li><a href="brandsmaster.php"><i class='bx bx-radio-circle'></i><span class="navicon">Brands</span></a></li>

                                </ul>
                            </li>

                            <li>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="icon"><i class='bx bxs-image'></i>
                                    </div>
                                    <div class="menu-title">Previous Projects</div>
                                </a>
                                <ul>
                                    <li> <a href="gallery-category.php"><i class='bx bx-radio-circle'></i><span class="navicon">Category</span></a></li>
                                </ul>
                            </li>


                            <li>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="icon"><i class='bx bx-message-square-check'></i>
                                    </div>
                                    <div class="menu-title">Quality Checker</div>
                                </a>
                                <ul>

                                    <li><a href="productmaster.php"><i class='bx bx-radio-circle'></i><span class="navicon">Product</span></a></li>
                                    <li><a href="producttypemaster.php"><i class='bx bx-radio-circle'></i><span class="navicon">Product Type</span></a></li>
                                    <li><a href="subtypemaster.php"><i class='bx bx-radio-circle'></i><span class="navicon">Sub Type</span></a></li>
                                </ul>
                            </li>



                            <!-- <li>
                                <a href="taskMaster.php">
                                    <div class="icon"><i class='bx bx-task'  ></i>
                                    </div>
                                    <div class="menu-title">Tasks</div>
                                </a>
                            </li> -->

                            <li>
                                <a href="unitmaster.php">
                                    <div class="icon"><i class='bx bx-unite'></i>
                                    </div>
                                    <div class="menu-title">Units</div>
                                </a>
                            </li>

                            <li>
                                <a href="productClassification.php">
                                    <div class="icon"><i class='bx bx-clipboard'></i>
                                    </div>
                                    <div class="menu-title">Classification</div>
                                </a>
                            </li>
                            <li>
                                <a href="promocode.php">
                                    <div class="icon"><i class='bx bx-clipboard'></i>
                                    </div>
                                    <div class="menu-title">Promo Code</div>
                                </a>
                            </li>

                            <!-- <li>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="icon"><i class='bx bx-clipboard' ></i>
                                    </div>
                                    <div class="menu-title">Classification</div>
                                </a>
                                <ul>
                                    <li> <a href="productClassification.php"><i class='bx bx-radio-circle'></i><span class="navicon">Product</span></a></li>
                                </ul>
                            </li> -->



                            <li>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="icon"><i class='bx bx-git-pull-request'></i>
                                    </div>
                                    <div class="menu-title">Request A Quote</div>
                                </a>
                                <ul>
                                    <li><a href="property.php"><i class='bx bx-radio-circle'></i><span class="navicon">Property</span></a></li>
                                    <li><a href="propertyType.php"><i class='bx bx-radio-circle'></i><span class="navicon">Property Type</span></a></li>
                                    <li><a href="propertySections.php"><i class='bx bx-radio-circle'></i><span class="navicon">Property Blocks</span></a></li>
                                    <!-- <li><a href="budget.php"><i class='bx bx-radio-circle'></i><span
                                            class="navicon">Budget</span></a></li> -->
                                    <li><a href="element-master.php"><i class='bx bx-radio-circle'></i><span class="navicon">Elements</span></a></li>
                                </ul>
                            </li>


                            <li>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="icon"><i class='bx bx-chair'></i>
                                    </div>
                                    <div class="menu-title">Manufacturer</div>
                                </a>
                                <ul>
                                    <li> <a href="product-type.php"><i class='bx bx-radio-circle'></i><span class="navicon">Product Type</span></a></li>
                                    <li> <a href="manufacturer-category.php"><i class='bx bx-radio-circle'></i><span class="navicon">Category</span></a></li>
                                    <li> <a href="manufacturerSubCategory.php"><i class='bx bx-radio-circle'></i><span class="navicon">Sub-Category</span></a>
                                    <li><a href="attributes.php"><i class='bx bx-radio-circle'></i><span class="navicon">Attributes</span></a></li>
                                    <li> <a href="values.php"><i class='bx bx-radio-circle'></i><span class="navicon">Values</span></a></li>
                                </ul>
                            </li>

                        </ul>

                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="icon">
                                <!-- <i class='bx bxs-group'></i> -->
                                <img src="assets/images/employee.png" class="sidebaricon" alt="sidebaricon">
                            </div>
                            <div class="menu-title">Employee</div>
                        </a>
                        <ul class="sidebardropdownadjust">
                            <li> <a href="add-adminRoles.php"><i class='bx bx-radio-circle'></i><span class="navicon">Add
                                        Roles</span></a>
                            </li>
                            <li> <a href="add-employee.php"><i class='bx bx-radio-circle'></i><span class="navicon">Add
                                        Employee</span></a>
                            </li>
                            <li> <a href="employeeprojects.php"><i class='bx bx-radio-circle'></i><span class="navicon">
                                        Employee Projects</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon">
                                <!-- <i class='bx bx-home'  ></i> -->
                                <img src="assets/images/home.png" class="sidebaricon" alt="sidebaricon">
                            </div>
                            <div class="menu-title">Home Page</div>
                        </a>
                        <ul class="sidebardropdownadjust">
                            <!-- <li><a href="manage-banners.php"><i class='bx bx-radio-circle'></i><span class="navicon">Banners</span></a></li>
                            <li><a href="services.php"><i class='bx bx-radio-circle'></i><span class="navicon">Services</span></a></li>
                            <li><a href="whyChooseus.php"><i class='bx bx-radio-circle'></i><span class="navicon">Why Choose
                                        Us</span></a></li> -->
                            <!-- <li><a href="projects.php"><i class='bx bx-radio-circle'></i><span class="navicon"> Previous
                                        Projects</span></a></li> -->
                            <li><a href="blog.php"><i class='bx bx-radio-circle'></i><span class="navicon">Blog</span></a>
                            </li>
                            <li><a href="topcompanies.php"><i class='bx bx-radio-circle'></i><span class="navicon">Top
                                        Companies</span></a></li>
                            <li><a href="gallery.php"><i class='bx bx-radio-circle'></i><span class="navicon">Previous
                                        Projects</span></a></li>
                            <li><a href="testimonials.php"><i class='bx bx-radio-circle'></i><span class="navicon">Testimonials</span></a></li>
                            <li><a href="testimonialtabs.php"><i class='bx bx-radio-circle'></i><span class="navicon">Testimonial Tabs</span></a></li>
                            <!-- <li><a href="guides.php"><i class='bx bx-radio-circle'></i><span class="navicon">Guides</span></a></li> -->
                            <!-- <li><a href="brands.php"><i class='bx bx-radio-circle'></i><span class="navicon">Brands We
                                        Use</span></a></li> -->
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon">
                                <!-- <i class='bx bx-slider-alt'></i> -->
                                <img src="assets/images/About1.png" class="sidebaricon" alt="sidebaricon">
                            </div>
                            <div class="menu-title">About Page</div>
                        </a>
                        <ul class="sidebardropdownadjust">
                            <li> <a href="aboutus.php"><i class='bx bx-radio-circle'></i><span class="navicon">About
                                        Us</span></a></li>
                            <li> <a href="ourteam.php"><i class='bx bx-radio-circle'></i><span class="navicon">Our
                                        Team</span></a></li>
                        </ul>
                    </li>

                    <!-- <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class='bx bxs-phone-call'  ></i>
                            </div>
                            <div class="menu-title">Contact Page</div>
                        </a>
                        <ul class="sidebardropdownadjust" > -->
                    <!-- <li> <a href="contact.php"><i class='bx bx-radio-circle'></i><span class="navicon">Contact</span></a></li> -->
                    <!-- <li> <a href="queries.php"><i class='bx bx-radio-circle'></i><span class="navicon">Queries</span></a></li>
                            <li> <a href="leads.php"><i class='bx bx-radio-circle'></i><span class="navicon">Leads</span></a></li>
                        </ul>
                    </li> -->
                <?php
                }
                ?>
                <?php if ($project_user == "admin") { ?>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon">
                                <!-- <i class='bx bx-question-mark'  ></i> -->
                                <img src="assets/images/quetionier.png" class="sidebaricon" alt="sidebaricon">
                            </div>
                            <div class="menu-title">Questionnaire</div>
                        </a>
                        <ul class="sidebardropdownadjust">
                            <li><a href="interior-elements.php"><i class='bx bx-radio-circle'></i><span class="navicon">Interior Elements</span></a></li>
                            <li><a href="total_cost.php"><i class='bx bx-radio-circle'></i><span class="navicon">Plans</span></a></li>
                            <li><a href="admin_assign_projects.php"><i class='bx bx-radio-circle'></i><span class="navicon">Assign Projects</span></a></li>
                            <!-- <li><a href="request_quote.php"><i class='bx bx-radio-circle'></i><span class="navicon">Questionnaire</span></a></li> -->
                        <?php
                    }
                        ?>

                        <?php
                        if ($project_user === "project manager") {

                        ?>
                            <!-- <li>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="parent-icon"><i class='bx bxs-store'></i></i>
                                    </div>
                                    <div class="menu-title">Masters</div>
                                </a>
                                <ul class="sidebardropdownadjust">
                                    <li><a href="add-status.php"><i class='bx bx-radio-circle'></i><span class="navicon">Status</span></a>
                                    </li>
                                    <li><a href="add-subStatus.php"><i class='bx bx-radio-circle'></i><span class="navicon">Sub-Status</span></a></li>
                                </ul>
                            </li> -->
                            <li>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="parent-icon"><i class='bx bx-archive'></i>
                                    </div>
                                    <div class="menu-title">My Quotations</div>
                                </a>
                                <ul class="sidebardropdownadjust">
                                    <li><a href="questionnaire_form.php"><i class='bx bx-radio-circle'></i><span class="navicon">Projects</span></a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($project_user === "project user") {

                        ?>
                            <li>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="parent-icon"><i class='bx bx-git-pull-request'></i>
                                    </div>
                                    <div class="menu-title">Freezed Projects</div>
                                </a>
                                <ul class="sidebardropdownadjust">
                                    <li><a href="assignedUserProjects.php"><i class='bx bx-radio-circle'></i><span class="navicon">My Projects</span></a></li>
                                </ul>
                            </li>
                            <!-- <li><a href="add-addon.php"><i class='bx bxs-analyse'></i></i><span class="navicon">Excess
                                    Quotation</span></a></li> -->
                        <?php
                        }
                        ?>

                        </ul>
                    </li>

                    <?php if ($project_user == "admin") { ?>
                        <li>
                            <a href="javascript:;" class="has-arrow">
                                <div class="parent-icon">
                                    <!-- <i class='bx bxs-cart-add'  ></i> -->
                                    <img src="assets/images/orders.png" class="sidebaricon" alt="sidebaricon">
                                </div>
                                <div class="menu-title">Shop</div>
                            </a>
                            <ul class="sidebardropdownadjust" >
                                <!-- <li><a href="shop-banners.php"><i class='bx bx-radio-circle'></i><span class="navicon">Banners</span></a></li> -->
                                <li><a href="customer_reviews.php"><i class='bx bx-radio-circle'></i><span class="navicon">Customer Reviews</span></a></li>
                                <!-- <li><a href="cart.php"><i class='bx bx-radio-circle'></i><span class="navicon">Cart</span></a></li> -->
                                <li><a href="super_sale.php"><i class='bx bx-radio-circle'></i><span class="navicon">Super Sale</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="has-arrow">
                                <div class="parent-icon">
                                    <!-- <i class='bx bx-home-circle' ></i> -->
                                    <img src="assets/images/vendor.png" class="sidebaricon" alt="sidebaricon">
                                </div>
                                <div class="menu-title">Vendor</div>
                            </a>
                            <ul class="sidebardropdownadjust">
                                <li><a href="vendor.php"><i class='bx bx-radio-circle'></i><span class="navicon">List Of Vendors</span></a></li>
                                <!-- <li><a href="manage-vendor.php"><i class='bx bx-radio-circle'></i><span class="navicon">Manage Vendor</span></a></li> -->
                                <li><a href="manage-vendor-list.php"><i class='bx bx-radio-circle'></i><span class="navicon">Manage Vendor List</span></a></li>
                                <li><a href="vendor_testimonials.php"><i class='bx bx-radio-circle'></i><span class="navicon">Vendor Testimonials</span></a></li>
                                <li><a href="google_reviews.php"><i class='bx bx-radio-circle'></i><span class="navicon">Google Reviews</span></a></li>
                            </ul>
                        </li>



                        <li>
                            <a href="javascript:;" class="has-arrow">
                                <div class="parent-icon">
                                    <!-- <i class='bx bx-support'></i> -->
                                    <img src="assets/images/query.png" class="sidebaricon" alt="sidebaricon">
                                </div>
                                <div class="menu-title">Queries</div>
                            </a>
                            <ul class="sidebardropdownadjust">
                                <li><a href="ongoing.php"><i class='bx bx-radio-circle'></i><span class="navicon">Sales Form</span></a></li>

                                <li><a href="customer_support.php"><i class='bx bx-radio-circle'></i><span class="navicon">Customer Support</span></a></li>
                                <li><a href="get_started.php"><i class='bx bx-radio-circle'></i><span class="navicon">Get Started</span></a></li>
                                <li><a href="designers.php"><i class='bx bx-radio-circle'></i><span class="navicon"> Designers</span></a></li>

                            </ul>
                        </li>

                        <li>
                            <a href="javascript:;" class="has-arrow">
                                <div class="parent-icon">
                                    <!-- <i class='bx bx-support'></i> -->
                                    <img src="assets/images/products.png" class="sidebaricon" alt="sidebaricon">
                                </div>
                                <div class="menu-title">Products</div>
                            </a>
                            <ul class="sidebardropdownadjust">
                                <li><a href="products.php"><i class='bx bx-radio-circle'></i><span class="navicon">Products</span></a></li>

                                <li><a href="product_colors.php"><i class='bx bx-radio-circle'></i><span class="navicon">Product Colours</span></a></li>
                              
                             

                            </ul>
                        </li>







                        <!-- <li class="parent-icon menu-title"><a href="breadcrumb.php">
                            <img src="assets/images/breadcrumb.png" class="sidebaricon" alt="sidebaricon">
                            <span class="navicon">
                                    Breadcrumb</span></a></li> -->
                        <li class="parent-icon menu-title"><a href="guides.php">
                                <!-- <i class='bx bxs-chevrons-right' id="edittt"></i>  -->
                                <img src="assets/images/Guides.png" class="sidebaricon" alt="sidebaricon">
                                <span class="navicon">
                                    Guides</span></a></li>

                        <li class="parent-icon"><a href="ongoingcard.php">
                                <!-- <i class='bx bxs-customize'></i> -->
                                <img src="assets/images/sales.png" class="sidebaricon" alt="sidebaricon">
                                <span class="navicon">Sales Card</span></a></li>

                        <!-- <li class="parent-icon"><a href="products.php">
                               
                                <img src="assets/images/products.png" class="sidebaricon" alt="sidebaricon">
                                <span class="navicon">Products</span></a></li> -->
                        <li class="parent-icon"><a href="leads.php">
                                <!-- <i class="fas fa-sitemap" style="font-size: 14px;" ></i> -->
                                <img src="assets/images/Leads.png" class="sidebaricon" alt="sidebaricon">
                                <span class="navicon">Leads</span></a></li>
                        <li class="parent-icon"><a href="customer.php">
                                <!-- <i class='bx bx-group'></i> -->
                                <img src="assets/images/customers.png" class="sidebaricon" alt="sidebaricon">
                                <span class="navicon">Customer</span></a></li>
                        <li class="parent-icon"><a href="manufacturer.php">
                                <!-- <i class='bx bxs-user'></i> -->
                                <img src="assets/images/manufacturer.png" class="sidebaricon" alt="sidebaricon">
                                <span class="navicon">Manufacturer</span></a>
                        </li>
                        <li class="parent-icon"><a href="good_plans.php">
                                <!-- <i class='bx bx-list-check'></i> -->
                                <img src="assets/images/Good Plan.png" class="sidebaricon" alt="sidebaricon">
                                <span class="navicon">Good Plans</span></a>
                        </li>
                        <li class="parent-icon"><a href="orders.php">
                                <!-- <i class='bx bx-cart'  ></i> -->
                                <img src="assets/images/orders.png" class="sidebaricon" alt="sidebaricon">
                                <span class="navicon">Orders</span></a></li>
                    <?php
                    }
                    ?>

            </ul>

            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand gap-3">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>



                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center gap-1">
                            <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
                                <a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
                                </a>
                            </li>

                            <li class="nav-item dark-mode d-none d-sm-flex">
                                <a class="nav-link dark-mode-icon app-container p-2 my-2" href="javascript:;"><i class='bx bx-moon' style="color: white;"></i>
                                </a>
                            </li>


                            <li class="nav-item  d-none d-sm-flex">
                            <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$notifications = $_SESSION['notifications'] ?? [];
?>
<div class="notification-wrapper" style="position: relative; display: inline-block; cursor: pointer;">
  <span class="notification-icon">
  </span>


  <?php if (!empty($notifications)): ?>
  <span class="notification-badge"><?php echo count($notifications); ?></span>
<?php endif; ?>

<div class="notification-dropdown" id="notificationDropdown">
  <?php if (!empty($notifications)): ?>
    <ul>
      <?php foreach ($notifications as $note): ?>
        <li><?php echo htmlspecialchars($note); ?></li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p style="padding:10px; margin:0;">No notifications</p>
  <?php endif; ?>
</div>

</div>

<script>
  const wrapper = document.querySelector('.notification-wrapper');
  const dropdown = document.getElementById('notificationDropdown');

  wrapper.addEventListener('click', (e) => {
    e.stopPropagation();
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  });

  document.addEventListener('click', () => {
    dropdown.style.display = 'none';
  });
</script>

<?php

unset($_SESSION['notifications']);
?>





                            </li>


                            <!-- side nav css -->
                            <div class="header-notifications-list">

                            </div>
                            <!-- end side nav css -->

                            <!-- <li class="nav-item dropdown dropdown-large">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                        class="alert-count">8</span>
                                    <i class='bx bx-shopping-bag'></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <p class="msg-header-title">My Cart</p>
                                            <p class="msg-header-badge">10 Items</p>
                                        </div>
                                    </a> -->
                            <div class="header-message-list">
                                <!-- <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="position-relative">
                                                    <div class="cart-product rounded-circle bg-light">
                                                        <img src="assets/images/products/11.png" class=""
                                                            alt="product image">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                    <p class="cart-product-price mb-0">1 X $29.00</p>
                                                </div>
                                                <div class="">
                                                    <p class="cart-price mb-0">$250</p>
                                                </div>
                                                <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                                </div>
                                            </div>
                                        </a> -->
                                <!-- <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="position-relative">
                                                    <div class="cart-product rounded-circle bg-light">
                                                        <img src="assets/images/products/02.png" class=""
                                                            alt="product image">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                    <p class="cart-product-price mb-0">1 X $29.00</p>
                                                </div>
                                                <div class="">
                                                    <p class="cart-price mb-0">$250</p>
                                                </div>
                                                <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                                </div>
                                            </div>
                                        </a> -->
                                <!-- <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="position-relative">
                                                    <div class="cart-product rounded-circle bg-light">
                                                        <img src="assets/images/products/03.png" class=""
                                                            alt="product image">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                    <p class="cart-product-price mb-0">1 X $29.00</p>
                                                </div>
                                                <div class="">
                                                    <p class="cart-price mb-0">$250</p>
                                                </div>
                                                <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                                </div>
                                            </div>
                                        </a> -->
                                <!-- <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="position-relative">
                                                    <div class="cart-product rounded-circle bg-light">
                                                        <img src="assets/images/products/04.png" class=""
                                                            alt="product image">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                    <p class="cart-product-price mb-0">1 X $29.00</p>
                                                </div>
                                                <div class="">
                                                    <p class="cart-price mb-0">$250</p>
                                                </div>
                                                <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                                </div>
                                            </div>
                                        </a> -->
                                <!-- <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="position-relative">
                                                    <div class="cart-product rounded-circle bg-light">
                                                        <img src="assets/images/products/05.png" class=""
                                                            alt="product image">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                    <p class="cart-product-price mb-0">1 X $29.00</p>
                                                </div>
                                                <div class="">
                                                    <p class="cart-price mb-0">$250</p>
                                                </div>
                                                <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                                </div>
                                            </div>
                                        </a> -->

                                <!-- <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="position-relative">
                                                    <div class="cart-product rounded-circle bg-light">
                                                        <img src="assets/images/products/07.png" class=""
                                                            alt="product image">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                    <p class="cart-product-price mb-0">1 X $29.00</p>
                                                </div>
                                                <div class="">
                                                    <p class="cart-price mb-0">$250</p>
                                                </div>
                                                <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                                </div>
                                            </div>
                                        </a> -->
                                <!-- <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="position-relative">
                                                    <div class="cart-product rounded-circle bg-light">
                                                        <img src="assets/images/products/08.png" class=""
                                                            alt="product image">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                    <p class="cart-product-price mb-0">1 X $29.00</p>
                                                </div>
                                                <div class="">
                                                    <p class="cart-price mb-0">$250</p>
                                                </div>
                                                <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                                </div>
                                            </div>
                                        </a> -->
                                <!-- <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="position-relative">
                                                    <div class="cart-product rounded-circle bg-light">
                                                        <img src="assets/images/products/09.png" class=""
                                                            alt="product image">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                    <p class="cart-product-price mb-0">1 X $29.00</p>
                                                </div>
                                                <div class="">
                                                    <p class="cart-price mb-0">$250</p>
                                                </div>
                                                <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                                </div>
                                            </div>
                                        </a> -->
                            </div>
                            <!-- <a href="javascript:;">
                                        <div class="text-center msg-footer">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <h5 class="mb-0">Total</h5>
                                                <h5 class="mb-0 ms-auto">$489.00</h5>
                                            </div>
                                            <button class="btn btn-primary w-100">Checkout</button>
                                        </div>
                                    </a> -->
                            <!-- </div>
                            </li> -->
                        </ul>
                    </div>
                    <?php

                    $result = mysqli_query($conn, "select * from login_admin where id ='" . $_SESSION['admin_id'] . "' && status=2");
                    $fetch = mysqli_fetch_array($result);

                    ?>
                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="Uploads/adminRoles/<?php echo $fetch['profile_pic']; ?>" class="user-img" alt="user">
                            <div class="user-info">
                                <p class="user-name mb-0"><?php echo $fetch['admin_name']; ?></p>

                                <?php

                                $rolequery = mysqli_query($conn, "SELECT * FROM admin_roles WHERE role_id='" . $fetch['admin_designation'] . "'");

                                $fetchrole = mysqli_fetch_array($rolequery);


                                ?>




                                <p class="designattion mb-0"><?php echo $fetchrole['role']; ?></p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <!-- <li><a class="dropdown-item d-flex align-items-center" href="login.php"><i class="bx bx-log-in-circle"></i><span>Login</span></a>
                            </li> -->
                            <li><a class="dropdown-item d-flex align-items-center" href="profile.php"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
                            </li>
                            <!-- <li><a class="dropdown-item d-flex align-items-center" href="index.php"><i
                                        class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
                            </li> -->
                            <!-- <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-download fs-5"></i><span>Downloads</span></a>
                            </li> -->
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="logout.php"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>


        <!-- search modal -->
        <div class="modal" id="SearchModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
                <div class="modal-content">
                    <div class="modal-header gap-2">
                        <div class="position-relative popup-search w-100">
                            <input class="form-control form-control-lg ps-5 border border-3 border-primary" type="search" placeholder="Search">
                            <span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-4"><i class='bx bx-search'></i></span>
                        </div>
                        <button type="button" class="btn-close d-md-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="search-list">
                            <p class="mb-1">Html Templates</p>
                            <div class="list-group">
                                <a href="javascript:;" class="list-group-item list-group-item-action active align-items-center d-flex gap-2 py-1"><i class='bx bxl-angular fs-4'></i>Best Html Templates</a>
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-vuejs fs-4'></i>Html5 Templates</a>
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-magento fs-4'></i>Responsive Html5 Templates</a>
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-shopify fs-4'></i>eCommerce Html Templates</a>
                            </div>
                            <p class="mb-1 mt-3">Web Designe Company</p>
                            <div class="list-group">
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-windows fs-4'></i>Best Html Templates</a>
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-dropbox fs-4'></i>Html5 Templates</a>
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-opera fs-4'></i>Responsive Html5 Templates</a>
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-wordpress fs-4'></i>eCommerce Html Templates</a>
                            </div>
                            <p class="mb-1 mt-3">Software Development</p>
                            <div class="list-group">
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-mailchimp fs-4'></i>Best Html Templates</a>
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-zoom fs-4'></i>Html5 Templates</a>
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-sass fs-4'></i>Responsive Html5 Templates</a>
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-vk fs-4'></i>eCommerce Html Templates</a>
                            </div>
                            <p class="mb-1 mt-3">Online Shoping Portals</p>
                            <div class="list-group">
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-slack fs-4'></i>Best Html Templates</a>
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-skype fs-4'></i>Html5 Templates</a>
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-twitter fs-4'></i>Responsive Html5 Templates</a>
                                <a href="javascript:;" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bxl-vimeo fs-4'></i>eCommerce Html Templates</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end search modal -->

        <script>
  document.getElementById('clearNotifications')?.addEventListener('click', function() {
    fetch('clear_notifications.php').then(() => {
      location.reload();
    });
  });
</script>

<script>
document.getElementById('notificationToggle').addEventListener('click', function(event) {
  const dropdown = document.getElementById('notificationDropdown');
  dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
});
window.addEventListener('click', function(event) {
  const container = document.getElementById('notificationToggle');
  if (!container.contains(event.target)) {
    document.getElementById('notificationDropdown').style.display = 'none';
  }
});
</script>