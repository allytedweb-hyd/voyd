<?php
include 'includes/header.php';
include './functions/manageVendorFunction.php';
if (isset($_POST['submit_form'])) {
    editVendorManagement();
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
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="./manage-vendor-list.php">Manager Vendor List
                        </li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-10 mx-auto">

                <div class="card form-card">
                    <h3 class="mb-4 text-center htext">Edit Manage Vendor</h3>

                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM vendor_management WHERE 
                        id='" . $_GET['id'] . "' && status=1");
                    $fetch = mysqli_fetch_array($query);

                    ?>

                    <div class="card-body p-4">
                        <form class="row " method="post" enctype="multipart/form-data">

                            <div class="col-md-6">
                                <label for="vendorName" class="form-label" id="vendorNameLabel"> Vendor Name<span class="errorindicator">*</span></label>

                                <select name="vendor_name" id="manageVendorName" class="form-select ">

                                    <!-- <?php

                                    $getvendorvalue = mysqli_query($conn, "SELECT * FROM vendor WHERE vendor_id='" . $fetch['vendor_id'] . "'");
                                    $fetchVendor = mysqli_fetch_array($getvendorvalue);

                                    ?>



                                    <option value="<?php echo $fetchVendor['vendor_id'] ?>">
                                        <?php echo $fetchVendor['vendor_firstname'] ?>
                                        <?php echo $fetchVendor['vendor_lastname'] ?></option> -->
                                    <!-- <?php
                                    $getActiveVendor = mysqli_query($conn, "SELECT * FROM vendor WHERE status = 2");
                                    while ($vendorsList = mysqli_fetch_array($getActiveVendor)) {
                                        ?>
                                        <option value=<?php echo $vendorsList['vendor_id'] ?>><?php echo $vendorsList['vendor_firstname'] ?> <?php echo $vendorsList['vendor_lastname'] ?></option>

                                    <?php
                                    }
                                    ?> -->


<?php

    $getvendorvalue = mysqli_query($conn, "SELECT * FROM vendor WHERE vendor_id='" . $fetch['vendor_id'] . "'");
    $fetchVendor = mysqli_fetch_array($getvendorvalue);
    ?>
    <option value="<?php echo $fetchVendor['vendor_id']; ?>">
        <?php echo $fetchVendor['vendor_firstname'] . ' ' . $fetchVendor['vendor_lastname']; ?>
    </option>

    <?php
 
    $getActiveVendor = mysqli_query($conn, "SELECT * FROM vendor WHERE status = 2 AND vendor_id != '" . $fetch['vendor_id'] . "'");
    while ($vendorsList = mysqli_fetch_array($getActiveVendor)) {
    ?>
        <option value="<?php echo $vendorsList['vendor_id']; ?>">
            <?php echo $vendorsList['vendor_firstname'] . ' ' . $vendorsList['vendor_lastname']; ?>
        </option>
    <?php } ?>


                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="manageVendorImage" class="form-label">
                                    Vendor Image<span class="errorindicator">*</span> <span class="requiredtext"> (JPG,JPEG,PNG &
                                        445 ×
                                        240px, Size< 1 Mb)</span> </label>
                                <input type="file" class="form-control form-file" name="vendor_image"
                                    id="manageVendorImage">
                                <img src="Uploads/vendor-management/<?php echo $fetch['vendor_image'] ?>" width="100"
                                    height="80" />
                                <input type="hidden" name="oldImage1" value="<?php echo $fetch['vendor_image'] ?>" />
                                <input type="hidden" name="vendor_image_id" value="<?php echo $fetch['id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="vendorDescription" class="form-label">
                                    Vendor Description<span class="errorindicator">*</span></label>
                                <textarea id="summernote"
                                    name="vendorDescription"><?php echo $fetch['vendor_description'] ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="projectsDone" class="form-label">
                                    Projects Done<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="projectsDone" name="projects_done"
                                    value="<?php echo $fetch['projects_done'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="noOfClients" class="form-label"> No Of
                                    Clients<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="noOfClients" name="no_of_clients"
                                    placeholder="Eg: 6" value="<?php echo $fetch['no_of_clients'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="vendorPavilion" class="form-label">
                                    Pavilion<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="vendorPavilion" name="vendor_pavilion"
                                    value="<?php echo $fetch['pavilion'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="vendorAwards" class="form-label">
                                    Awards<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="vendorAwards" name="vendor_awards"
                                    value="<?php echo $fetch['awards'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="noOfSpaces" class="form-label">
                                    Spaces<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="noOfSpaces" name="no_of_spaces"
                                    value="<?php echo $fetch['spaces'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="noOfWorkers" class="form-label">
                                    Workers<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="noOfWorkers" name="no_of_workers"
                                    value="<?php echo $fetch['workers'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <hr />
                            <h5>Mastering Execution</h5>
                            <div class="col-md-6">
                                <label for="projectImageOne" class="form-label">
                                    Project Image 1<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control form-file" id="projectImageOne"
                                    name="project_image_one">
                                <img src="Uploads/vendor-management/<?php echo $fetch['project_img_one'] ?>" width="100"
                                    height="80" />
                                <input type="hidden" name="oldImage2" value="<?php echo $fetch['project_img_one'] ?>" />
                                <input type="hidden" name="vendor_image_id" value="<?php echo $fetch['id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="projectImageTwo" class="form-label">
                                    Project Image 2<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control form-file" id="projectImageTwo"
                                    name="project_image_two">
                                <img src="Uploads/vendor-management/<?php echo $fetch['project_img_two'] ?>" width="100"
                                    height="80" />
                                <input type="hidden" name="oldImage3" value="<?php echo $fetch['project_img_two'] ?>" />
                                <input type="hidden" name="vendor_image_id" value="<?php echo $fetch['id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <hr />
                            <h5>Explore the Location</h5>
                            <div class="col-md-6">
                                <label for="vendorLocationOne" class="form-label">
                                    City<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="vendorExploreCity"
                                    name="vendor_explore_city" value="<?php echo $fetch['explore_city'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="vendorLocationOne" class="form-label">
                                    Location 1<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="vendorLocationOne"
                                    name="vendor_location_one" value="<?php echo $fetch['preffered_location_one'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="vendorLocationTwo" class="form-label">
                                    Location 2<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="vendorLocationTwo"
                                    name="vendor_location_two" value="<?php echo $fetch['preffered_location_two'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="vendorLocationThree" class="form-label"> Location 3<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="vendorLocationThree"
                                    name="vendor_location_three"
                                    value="<?php echo $fetch['preffered_location_three'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <hr />
                            <h5>Showcase Of Excellence</h5>
                            <h6 class="subheadingvendor">1. Project Info</h6>
                            <div class="col-md-6">
                                <label for="materialNameOne" class="form-label">
                                    Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialNameOne" name="material_name_one"
                                    value="<?php echo $fetch['material_name_one'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialImageOne" class="form-label">
                                    Project Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control form-file" id="materialImageOne"
                                    name="material_image_one">
                                <img src="Uploads/vendor-management/<?php echo $fetch['material_img_one'] ?>"
                                    width="100" height="80" />
                                <input type="hidden" name="oldImage4"
                                    value="<?php echo $fetch['material_img_one'] ?>" />
                                <input type="hidden" name="vendor_image_id" value="<?php echo $fetch['id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialPriceOne" class="form-label">
                                    Project Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialPriceOne" name="material_price_one"
                                    value="<?php echo $fetch['material_price_one'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <h6 class="subheadingvendor">2. Project Info</h6>
                            <div class="col-md-6">
                                <label for="materialNameTwo" class="form-label">
                                    Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialNameTwo" name="material_name_two"
                                    value="<?php echo $fetch['material_name_two'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialImageTwo" class="form-label">
                                    Project Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control form-file" id="materialImageTwo"
                                    name="material_image_two">
                                <img src="Uploads/vendor-management/<?php echo $fetch['material_img_two'] ?>"
                                    width="100" height="80" />
                                <input type="hidden" name="oldImage5"
                                    value="<?php echo $fetch['material_img_two'] ?>" />
                                <input type="hidden" name="vendor_image_id" value="<?php echo $fetch['id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialPriceTwo" class="form-label">
                                    Project Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialPriceTwo" name="material_price_two"
                                    value="<?php echo $fetch['material_price_two'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <h6 class="subheadingvendor">3. Project Info</h6>
                            <div class="col-md-6">
                                <label for="materialNameThree" class="form-label">
                                    Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialNameThree"
                                    name="material_name_three" value="<?php echo $fetch['material_name_three'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialImageThree" class="form-label">
                                    Project Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control form-file" id="materialImageThree"
                                    name="material_image_three">
                                <img src="Uploads/vendor-management/<?php echo $fetch['material_img_three'] ?>"
                                    width="100" height="80" />
                                <input type="hidden" name="oldImage6"
                                    value="<?php echo $fetch['material_img_three'] ?>" />
                                <input type="hidden" name="vendor_image_id" value="<?php echo $fetch['id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialPriceThree" class="form-label">
                                    Project Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialPriceThree"
                                    name="material_price_three" value="<?php echo $fetch['material_price_three'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <h6 class="subheadingvendor">4. Project Info</h6>
                            <div class="col-md-6">
                                <label for="materialNameFour" class="form-label">
                                    Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialNameFour" name="material_name_four"
                                    value="<?php echo $fetch['material_name_four'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialImageFour" class="form-label">
                                    Project Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control form-file" id="materialImageFour"
                                    name="material_image_four">
                                <img src="Uploads/vendor-management/<?php echo $fetch['material_img_four'] ?>"
                                    width="100" height="80" />
                                <input type="hidden" name="oldImage7"
                                    value="<?php echo $fetch['material_img_four'] ?>" />
                                <input type="hidden" name="vendor_image_id" value="<?php echo $fetch['id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialPriceFour" class="form-label">
                                    Project Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialPriceFour"
                                    name="material_price_four" value="<?php echo $fetch['material_price_four'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <h6 class="subheadingvendor">5. Project Info</h6>
                            <div class="col-md-6">
                                <label for="materialNameFive" class="form-label">
                                    Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialNameFive" name="material_name_five"
                                    value="<?php echo $fetch['material_name_five'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialImageFive" class="form-label">
                                    Project Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control form-file" id="materialImageFive"
                                    name="material_image_five">
                                <img src="Uploads/vendor-management/<?php echo $fetch['material_img_five'] ?>"
                                    width="100" height="80" />
                                <input type="hidden" name="oldImage8"
                                    value="<?php echo $fetch['material_img_five'] ?>" />
                                <input type="hidden" name="vendor_image_id" value="<?php echo $fetch['id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Material
                                    Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialPriceFive"
                                    name="material_price_five" value="<?php echo $fetch['material_price_five'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <h6 class="subheadingvendor">6. Project Info</h6>
                            <div class="col-md-6">
                                <label for="materialPriceFive" class="form-label">
                                    Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialNameSix" name="material_name_six"
                                    value="<?php echo $fetch['material_name_six'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialImageSix" class="form-label">
                                    Project Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control form-file" id="materialImageSix"
                                    name="material_image_six">
                                <img src="Uploads/vendor-management/<?php echo $fetch['material_img_six'] ?>"
                                    width="100" height="80" />
                                <input type="hidden" name="oldImage9"
                                    value="<?php echo $fetch['material_img_six'] ?>" />
                                <input type="hidden" name="vendor_image_id" value="<?php echo $fetch['id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialPriceSix" class="form-label">
                                    Project Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialPriceSix" name="material_price_six"
                                    value="<?php echo $fetch['material_price_six'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-manage-vendor"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-manage-vendor"
                                        class="btn btn-primary px-4 submit d-none">Submit</button>
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
<!-- <script src="./assets/api/manageVendorApi.js"></script> -->

<!-- <script>
    CKEDITOR.replace('testdesc', {
        height: 100,
    });
</script> -->


<script>

    $('#summernote').summernote({
        placeholder: 'Enter Text',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
            onPaste: function (e) {
                e.preventDefault();
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                document.execCommand('insertText', false, bufferText);
            }
        }
    });


</script>



<script>

    /* eslint-disable no-undef */

$(document).ready(function () {
    let validationRules = [
        {
            element: "#manageVendorName",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Select a vendor name",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        // {
        //     element: "#manageVendorImage",
        //     rules: {
        //         required: true,
        //         maxSize: 1 * 1024 * 1024,
        //         fileTypes: ["image/jpg", "image/png", "image/jpeg"],
        //     },
        //     errors: {
        //         requiredError: "*Provide an image",
        //         maxSizeError: "*Image size should be less than 1mb",
        //         fileTypeError: "*Image should` be of type jpg, jpeg or png",
        //     },

        
        // },
        // {
        //     element: "#projectImageOne",
        //     rules: {
        //         required: true,
        //         maxSize: 1 * 1024 * 1024,
        //         fileTypes: ["image/jpg", "image/png", "image/jpeg"],
        //     },
        //     errors: {
        //         requiredError: "*Provide an image",
        //         maxSizeError: "*Image size should be less than 1mb",
        //         fileTypeError: "*Image should be of type jpg, jpeg or png",
        //     },
        // },
        // {
        //     element: "#projectImageTwo",
        //     rules: {
        //         required: true,
        //         maxSize: 1 * 1024 * 1024,
        //         fileTypes: ["image/jpg", "image/png", "image/jpeg"],
        //     },
        //     errors: {
        //         requiredError: "*Provide an image",
        //         maxSizeError: "*Image size should be less than 1mb",
        //         fileTypeError: "*Image should be of type jpg, jpeg or png",
        //     },
        // },

        // {
        //     element: "#materialImageOne",
        //     rules: {
        //         required: true,
        //         maxSize: 1 * 1024 * 1024,
        //         fileTypes: ["image/jpg", "image/png", "image/jpeg"],
        //     },
        //     errors: {
        //         requiredError: "*Provide an image",
        //         maxSizeError: "*Image size should be less than 1mb",
        //         fileTypeError: "*Image should be of type jpg, jpeg or png",
        //     },
        // },
        // {
        //     element: "#materialImageTwo",
        //     rules: {
        //         required: true,
        //         maxSize: 1 * 1024 * 1024,
        //         fileTypes: ["image/jpg", "image/png", "image/jpeg"],
        //     },
        //     errors: {
        //         requiredError: "*Provide an image",
        //         maxSizeError: "*Image size should be less than 1mb",
        //         fileTypeError: "*Image should be of type jpg, jpeg or png",
        //     },
        // },
        // {
        //     element: "#materialImageThree",
        //     rules: {
        //         required: true,
        //         maxSize: 1 * 1024 * 1024,
        //         fileTypes: ["image/jpg", "image/png", "image/jpeg"],
        //     },
        //     errors: {
        //         requiredError: "*Provide an image",
        //         maxSizeError: "*Image size should be less than 1mb",
        //         fileTypeError: "*Image should be of type jpg, jpeg or png",
        //     },
        // },
        // {
        //     element: "#materialImageFour",
        //     rules: {
        //         required: true,
        //         maxSize: 1 * 1024 * 1024,
        //         fileTypes: ["image/jpg", "image/png", "image/jpeg"],
        //     },
        //     errors: {
        //         requiredError: "*Provide an image",
        //         maxSizeError: "*Image size should be less than 1mb",
        //         fileTypeError: "*Image should be of type jpg, jpeg or png",
        //     },
        // },
        // {
        //     element: "#materialImageFive",
        //     rules: {
        //         required: true,
        //         maxSize: 1 * 1024 * 1024,
        //         fileTypes: ["image/jpg", "image/png", "image/jpeg"],
        //     },
        //     errors: {
        //         requiredError: "*Provide an image",
        //         maxSizeError: "*Image size should be less than 1mb",
        //         fileTypeError: "*Image should be of type jpg, jpeg or png",
        //     },
        // },
        // {
        //     element: "#materialImageSix",
        //     rules: {
        //         required: true,
        //         maxSize: 1 * 1024 * 1024,
        //         fileTypes: ["image/jpg", "image/png", "image/jpeg"],
        //     },
        //     errors: {
        //         requiredError: "*Provide an image",
        //         maxSizeError: "*Image size should be less than 1mb",
        //         fileTypeError: "*Image should be of type jpg, jpeg or png",
        //     },
        // },

        {
            element: "#summernote",
            rules: {
                required: true,
                minLength: 3,
                maxLength: 270,
            },
            errors: {
                requiredError: "*Enter description",
                minLengthError: "*Description should be minimum 3 characters",
                maxLengthError: "*Description should be maximum 270 characters",
            },
        },
        {
            element: "#projectsDone",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Enter projects",
                regexError:
                    "*Projects Done is invalid. It accepts only numbers",
            },
        },
        {
            element: "#noOfClients",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Enter no. of clients",
                regexError:
                    "*Projects Done is invalid. It accepts only numbers",
            },
        },
        {
            element: "#vendorPavilion",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Enter vendor pavilion",
                regexError:
                    "*Projects Done is invalid. It accepts only numbers",
            },
        },
        {
            element: "#vendorAwards",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Enter vendor awards",
                regexError:
                    "*Projects Done is invalid. It accepts only numbers",
            },
        },
        {
            element: "#noOfSpaces",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Enter no. of spaces",
                regexError:
                    "*Projects Done is invalid. It accepts only numbers",
            },
        },
        {
            element: "#noOfWorkers",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Enter no. of workers",
                regexError:
                    "*Projects Done is invalid. It accepts only numbers",
            },
        },
        {
            element: "#vendorExploreCity",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
                minLength: 3,
                maxLength: 30,
            },
            errors: {
                requiredError: "*Enter city",
                regexError: "*city is invalid. It accepts only characters",
                minLengthError: "*city should be minimum 3 characters",
                maxLengthError: "*city should be maximum 30 characters",
            },
        },
        {
            element: "#vendorLocationTwo",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter location",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#vendorLocationThree",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter location",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#vendorLocationOne",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter location",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialNameOne",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter material",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialNameTwo",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter material",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialPriceTwo",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter price",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialNameThree",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter material",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialNameFour",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter material",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialNameFive",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter material",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialNameSix",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter material",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialPriceOne",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter price",
            },
        },
        {
            element: "#materialPriceTwo",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter price",
            },
        },
        {
            element: "#materialPriceThree",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter price",
            },
        },
        {
            element: "#materialPriceFour",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter price",
            },
        },
        {
            element: "#materialPriceFive",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter price",
            },
        },
        {
            element: "#materialPriceSix",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter price",
            },
        },
    ];
    console.log("validation rules====", validationRules);
    $("#add-manage-vendor").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validation errors =====", IsFormValid);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("add-manage-vendor").addClass("d-none");
            $("#add-manage-vendor").hide();
            $("#submit-manage-vendor")
                .removeClass("d-none")
                .addClass("d-block");
            $("#submit-manage-vendor").trigger("click");
        }
    });
});




</script>