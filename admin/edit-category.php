1:28
<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/categoryFunctions.php';
if (isset($_POST['submit_form'])) {
    editCategory();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./category.php">View Category</li></a>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Category</h3>
                        <?php
                        $query = mysqli_query($conn, "select * from category where
                        category_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label">Enter Category<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="category" id="procategory" value="<?php echo $fetch['category_name'] ?>">
                                <p id="errText" class="error-text" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input1" class="form-label">Offer<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="offer" id="offer" value="<?php echo $fetch['offer'] ?>">
                                <p id="errText" class="error-text" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label">Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="CategoryImage" id="pcategoryImage">
                                <img src="./Uploads/category/<?php echo $fetch['category_image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldCategoryImage" value="<?php echo $fetch['category_image'] ?>" />
                                <input type="hidden" name="categoryId" value="<?php echo $fetch['category_id'] ?>" />
                                <p id="errText" class="error-text" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input3" class="form-label">Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="categoryAlttext" value="<?php echo $fetch['alt_text']; ?>">
                                <p id="errText" class="error-text" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label">Banner Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="bannerimage" id="bannerimage">
                                <img src="./Uploads/category/<?php echo $fetch['banner_image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldBannerimage" value="<?php echo $fetch['banner_image'] ?>" />
                               

                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input3" class="form-label">Banner Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext2" id="bannerAlttext" value="<?php echo $fetch['alt_text2']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-pcategory" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-pcategory" class="btn btn-primary px-4 submit d-none">Submit</button>
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
<script src="./assets/api/procategoryapi.js"></script>