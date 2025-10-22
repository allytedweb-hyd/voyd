<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/breadcrumbFunctions.php';

if (isset($_POST['submit_form'])) {
    editBreadcrumb();
}

?>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <!-- <div class="breadcrumb-title pe-3">Forms</div> -->
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="./index.php"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="./breadcrumb.php">View
                                Breadcrumb
                        </li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Edit Breadcrumb</h3>
                        <form class="row form_new" id="submitForm" name="submitForm" method="post" enctype="multipart/form-data">

                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM breadcrumbs where 
                        breadcrumb_id='" . $_GET['id'] . "'");
                            $fetch = mysqli_fetch_array($query);
                            ?>

                            <div class="col-md-6">
                                <label class="form-label"> Page<span class="errorindicator">*</span></label>
                                <select class="form-select" name="breadcrumbPage" size="1" id="pageType">
                                    <!-- <option value="<?php echo $fetch['page_name'] ?>" ><?php echo $fetch['page_name'] ?></option>
                                    <option>About page</option>
                                    <option>Services page</option>
                                    <option>Blog page</option>
                                    <option>Contact page</option>
                                    <option>Shop page</option>
                                    <option>Gallery page</option> -->

                                    <?php
        $pages = [
            "About page",
            "Services page",
            "Blog page",
            "Contact page",
            "Shop page",
            "Gallery page"
        ];

        foreach ($pages as $page) {
            $selected = ($fetch['page_name'] === $page) ? 'selected' : '';
            echo "<option value=\"" . htmlspecialchars($page) . "\" $selected>$page</option>";
        }
        ?>



                                </select>
                            </div>



                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Breadcumb Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="BreadcrumbImage" id="breadcrumbImage">
                                <img src="./Uploads/breadcrumbs/<?php echo $fetch['breadcrumb_image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['breadcrumb_image'] ?>" />
                                <input type="hidden" name="breadcrumbId" value="<?php echo $fetch['breadcrumb_id'] ?>" />
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="breadcrumbAlttext" value="<?php echo $fetch['alt_text']; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Breadcrumb Title<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="BreadcrumbTitle" id="breadcrumbTitle" value="<?php echo $fetch['breadcrumb_title']; ?>">
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-breadcrumb" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-breadcrumb" class="btn btn-primary px-4 submit d-none">Submit</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!--end row-->
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./assets/api/breadcrumbapi.js"></script>