<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



include 'includes/header.php';

include './functions/manageVendorFunction.php';
if (isset($_POST['submit_form'])) {
    // file_put_contents('debug.log', "\n======= SUBMIT ATTEMPT =======\n", FILE_APPEND);
    // file_put_contents('debug.log', "POST:\n" . print_r($_POST, true), FILE_APPEND);
    // file_put_contents('debug.log', "FILES:\n" . print_r($_FILES, true), FILE_APPEND);


    $uploadDir = 'Uploads/vendor-management/';

    // foreach (['vendor_image',
    // 'project_image_one',
    // 'project_image_two',
    // 'material_image_one',
    // 'material_image_two',
    // 'material_image_three',
    // 'material_image_four',
    // 'material_image_five',
    // 'material_image_six'] as $imgField) {
    //     if (isset($_FILES[$imgField]) && $_FILES[$imgField]['error'] === 0) {
    //         $filename = time() . '_' . basename($_FILES[$imgField]['name']);
    //         $targetPath = $uploadDir . $filename;
    
    //         if (move_uploaded_file($_FILES[$imgField]['tmp_name'], $targetPath)) {
                
    //             $postKey = 'old' . ucfirst($imgField); 
    //             $_POST[$postKey] = $filename;
    //         }
    //     }
    // }

//    $imageFieldMap = [
//     'vendor_image' => 'oldImage1',
//     'project_image_one' => 'oldImage2',
//     'project_image_two' => 'oldImage3',
//     'material_image_one' => 'oldImage4',
//     'material_image_two' => 'oldImage5',
//     'material_image_three' => 'oldImage6',
//     'material_image_four' => 'oldImage7',
//     'material_image_five' => 'oldImage8',
//     'material_image_six' => 'oldImage9',
// ];

// foreach ($imageFieldMap as $imgField => $postKey) {
//     if (isset($_FILES[$imgField]) && $_FILES[$imgField]['error'] === 0) {
//         $filename = time() . '_' . basename($_FILES[$imgField]['name']);
//         $targetPath = $uploadDir . $filename;

//         if (move_uploaded_file($_FILES[$imgField]['tmp_name'], $targetPath)) {
//             $_POST[$postKey] = $filename;
//         }
//     }
// }






    addVendorManagement();
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

                <div class="card new_card_form">
                    <h3 class="mb-4 text-center htext">Add Manage Vendor</h3>
                    <div class="card-body p-4">
                        <form class="row " method="post" enctype="multipart/form-data">

                            <div class="col-md-6">
                                <label for="manageVendorName" class="form-label">Vendor Name<span class="errorindicator">*</span></label>

                                <select name="vendor_name" id="manageVendorName" class="form-select ">
                                    <option value="">Select Vendor</option>
                                    <?php
                                    $getActiveVendor = mysqli_query($conn, "SELECT * FROM vendor WHERE status = 2");
                                    while ($vendorsList = mysqli_fetch_array($getActiveVendor)) {

                                        ?>
                                        <option 
                                        value="<?php echo $vendorsList['vendor_id'] ?>" <?php echo (isset($_POST['vendor_name']) && $_POST['vendor_name'] == $vendorsList['vendor_id']) ? 'selected' : ''; ?>><?php echo $vendorsList['vendor_firstname'] ?>     <?php echo $vendorsList['vendor_lastname'] ?></option>

                                        <?php
                                    }
                                    ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="manageVendorImage" class="form-label">Vendor Image<span class="errorindicator">*</span> <span
                                        class="requiredtext"> (JPG,JPEG,PNG &
                                        445 ×
                                        240px, Size< 1 Mb)</span> </label>
                                <input type="file" class="form-control " name="vendor_image" id="manageVendorImage">

                                <!-- <input type="hidden" name="oldImage1" value="<?php echo isset($_POST['oldImage1']) ? htmlspecialchars($_POST['oldImage1']) : ''; ?>">

<?php if (!empty($_POST['oldImage1'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/vendor-management/<?php echo htmlspecialchars($_POST['oldImage1']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?> -->



                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="vendorDescription" class="form-label">Vendor Description<span class="errorindicator">*</span></label>
                                <textarea id="summernote" name="vendorDescription"><?php echo isset($_POST['vendorDescription']) ? htmlspecialchars($_POST['vendorDescription']) : ''; ?></textarea>

                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="projectsDone" class="form-label">Projects Done<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="projectsDone" name="projects_done" value="<?php echo isset($_POST['projects_done']) ? htmlspecialchars($_POST['projects_done']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="noOfClients" class="form-label">No Of Clients<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="noOfClients" name="no_of_clients"
                                    placeholder="Eg: 6" value="<?php echo isset($_POST['no_of_clients']) ? htmlspecialchars($_POST['no_of_clients']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="vendorPavilion" class="form-label">Pavilion<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="vendorPavilion" name="vendor_pavilion" value="<?php echo isset($_POST['vendor_pavilion']) ? htmlspecialchars($_POST['vendor_pavilion']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="vendorAwards" class="form-label">Awards<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="vendorAwards" name="vendor_awards" value="<?php echo isset($_POST['vendor_awards']) ? htmlspecialchars($_POST['vendor_awards']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="noOfSpaces" class="form-label">Spaces<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="noOfSpaces" name="no_of_spaces" value="<?php echo isset($_POST['no_of_spaces']) ? htmlspecialchars($_POST['no_of_spaces']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="noOfWorkers" class="form-label">Workers<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="noOfWorkers" name="no_of_workers" value="<?php echo isset($_POST['no_of_workers']) ? htmlspecialchars($_POST['no_of_workers']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <hr />
                            <h5>Mastering Execution</h5>
                            <div class="col-md-6">
                                <label for="projectImageOne" class="form-label">Project Image 1<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control " id="projectImageOne" name="project_image_one">

                                <!-- <input type="hidden" name="oldImage2" value="<?php echo isset($_POST['oldImage2']) ? htmlspecialchars($_POST['oldImage2']) : ''; ?>">

<?php if (!empty($_POST['oldImage2'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/vendor-management/<?php echo htmlspecialchars($_POST['oldImage2']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?> -->

                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="projectImageTwo" class="form-label">Project Image 2<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control " id="projectImageTwo" name="project_image_two">

                                <!-- <input type="hidden" name="oldImage3" value="<?php echo isset($_POST['oldImage3']) ? htmlspecialchars($_POST['oldImage3']) : ''; ?>">

<?php if (!empty($_POST['oldImage3'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/vendor-management/<?php echo htmlspecialchars($_POST['oldImage3']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?> -->


                                <p id="errText" class="error-text"></p>
                            </div>
                            <hr />
                            <h5>Explore the Location</h5>
                            <div class="col-md-6">
                                <label for="vendorLocationOne" class="form-label">City<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="vendorExploreCity"
                                    name="vendor_explore_city" value="Hyderabad">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="vendorLocationOne" class="form-label">Location 1<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="vendorLocationOne"
                                    name="vendor_location_one" value="<?php echo isset($_POST['vendor_location_one']) ? htmlspecialchars($_POST['vendor_location_one']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="vendorLocationTwo" class="form-label">Location 2<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="vendorLocationTwo"
                                    name="vendor_location_two" value="<?php echo isset($_POST['vendor_location_two']) ? htmlspecialchars($_POST['vendor_location_two']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="vendorLocationThree" class="form-label">Location 3<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="vendorLocationThree"
                                    name="vendor_location_three" value="<?php echo isset($_POST['vendor_location_three']) ? htmlspecialchars($_POST['vendor_location_three']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <hr />
                            <h5>Showcase Of Excellence</h5>
                            <h6 class="subheadingvendor">1. Project Info</h6>
                            <div class="col-md-6">
                                <label for="materialNameOne" class="form-label">Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialNameOne" name="material_name_one" value="<?php echo isset($_POST['material_name_one']) ? htmlspecialchars($_POST['material_name_one']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialImageOne" class="form-label">Project Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control " id="materialImageOne"
                                    name="material_image_one">

                                    <!-- <input type="hidden" name="oldImage4" value="<?php echo isset($_POST['oldImage4']) ? htmlspecialchars($_POST['oldImage4']) : ''; ?>">

<?php if (!empty($_POST['oldImage4'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/vendor-management/<?php echo htmlspecialchars($_POST['oldImage4']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?> -->


                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialPriceOne" class="form-label">Project Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialPriceOne" name="material_price_one" value="<?php echo isset($_POST['material_price_one']) ? htmlspecialchars($_POST['material_price_one']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <h6 class="subheadingvendor">2. Project Info</h6>
                            <div class="col-md-6">
                                <label for="materialNameTwo" class="form-label">Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialNameTwo" name="material_name_two" value="<?php echo isset($_POST['material_name_two']) ? htmlspecialchars($_POST['material_name_two']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialImageTwo" class="form-label">Project Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control " id="materialImageTwo"
                                    name="material_image_two">

                                    <!-- <input type="hidden" name="oldImage5" value="<?php echo isset($_POST['oldImage5']) ? htmlspecialchars($_POST['oldImage5']) : ''; ?>">

<?php if (!empty($_POST['oldImage5'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/vendor-management/<?php echo htmlspecialchars($_POST['oldImage5']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?> -->


                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialPriceTwo" class="form-label">Project Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialPriceTwo" name="material_price_two" value="<?php echo isset($_POST['material_price_two']) ? htmlspecialchars($_POST['material_price_two']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <h6 class="subheadingvendor">3. Project Info</h6>
                            <div class="col-md-6">
                                <label for="materialNameThree" class="form-label">Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialNameThree"
                                    name="material_name_three" value="<?php echo isset($_POST['material_name_three']) ? htmlspecialchars($_POST['material_name_three']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialImageThree" class="form-label">Project Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control " id="materialImageThree"
                                    name="material_image_three" >

                                    <!-- <input type="hidden" name="oldImage6" value="<?php echo isset($_POST['oldImage6']) ? htmlspecialchars($_POST['oldImage6']) : ''; ?>">

<?php if (!empty($_POST['oldImage6'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/vendor-management/<?php echo htmlspecialchars($_POST['oldImage6']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?> -->


                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialPriceThree" class="form-label">Project Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialPriceThree"
                                    name="material_price_three" value="<?php echo isset($_POST['material_price_three']) ? htmlspecialchars($_POST['material_price_three']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <h6 class="subheadingvendor">4. Project Info</h6>
                            <div class="col-md-6">
                                <label for="materialNameFour" class="form-label">Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialNameFour" name="material_name_four" value="<?php echo isset($_POST['material_name_four']) ? htmlspecialchars($_POST['material_name_four']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialImageFour" class="form-label">Project Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control " id="materialImageFour"
                                    name="material_image_four">

                                    <!-- <input type="hidden" name="oldImage7" value="<?php echo isset($_POST['oldImage7']) ? htmlspecialchars($_POST['oldImage7']) : ''; ?>">

<?php if (!empty($_POST['oldImage7'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/vendor-management/<?php echo htmlspecialchars($_POST['oldImage7']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?> -->


                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialPriceFour" class="form-label">Project Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialPriceFour"
                                    name="material_price_four" value="<?php echo isset($_POST['material_price_four']) ? htmlspecialchars($_POST['material_price_four']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <h6 class="subheadingvendor">5. Project Info</h6>
                            <div class="col-md-6">
                                <label for="materialNameFive" class="form-label">Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialNameFive" name="material_name_five" value="<?php echo isset($_POST['material_name_five']) ? htmlspecialchars($_POST['material_name_five']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialImageFive" class="form-label">Project Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control " id="materialImageFive"
                                    name="material_image_five">

                                    <!-- <input type="hidden" name="oldImage8" value="<?php echo isset($_POST['oldImage8']) ? htmlspecialchars($_POST['oldImage8']) : ''; ?>">

<?php if (!empty($_POST['oldImage8'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/vendor-management/<?php echo htmlspecialchars($_POST['oldImage8']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?> -->


                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label">Project Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialPriceFive"
                                    name="material_price_five" value="<?php echo isset($_POST['material_price_five']) ? htmlspecialchars($_POST['material_price_five']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <h6 class="subheadingvendor">6. Project Info</h6>
                            <div class="col-md-6">
                                <label for="materialPriceFive" class="form-label">Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialNameSix" name="material_name_six" value="<?php echo isset($_POST['material_name_six']) ? htmlspecialchars($_POST['material_name_six']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialImageSix" class="form-label">Project Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control " id="materialImageSix"
                                    name="material_image_six">

                                    <!-- <input type="hidden" name="oldImage9" value="<?php echo isset($_POST['oldImage9']) ? htmlspecialchars($_POST['oldImage9']) : ''; ?>">

<?php if (!empty($_POST['oldImage9'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/vendor-management/<?php echo htmlspecialchars($_POST['oldImage9']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?> -->


                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="materialPriceSix" class="form-label">Project Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="materialPriceSix" name="material_price_six" value="<?php echo isset($_POST['material_price_six']) ? htmlspecialchars($_POST['material_price_six']) : ''; ?>">
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

<script src="./assets/api/manageVendorApi.js"></script>


<script>
    $(document).ready(function () {
        function capitalizeFirstLetter(fieldId) {
            const input = document.getElementById(fieldId);
            input.addEventListener('blur', function () {
                let val = input.value.trim();
                if (val.length > 0) {
                    input.value = val.charAt(0).toUpperCase() + val.slice(1);
                }
            });
        }


        capitalizeFirstLetter("vendorExploreCity");
        capitalizeFirstLetter("vendorLocationOne");
        capitalizeFirstLetter("vendorLocationTwo");
        capitalizeFirstLetter("vendorLocationThree");
        capitalizeFirstLetter("materialNameOne");
        capitalizeFirstLetter("materialNameTwo");
        capitalizeFirstLetter("materialNameThree");
        capitalizeFirstLetter("materialNameFour");
        capitalizeFirstLetter("materialNameFive");
        capitalizeFirstLetter("materialNameSix");


    });
</script>
<script>
    $('#manageVendorName').on('change', function (e) {
        let id = $(this).val();
        if (!id) return;

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                vendorId: id,
                eveType: "vendor-name"
            },
            success: function (result) {
                console.log("Success result:", result);
                if (result > 0) {
                    Swal.fire({
                        title: "Warning!",
                        text: "Vendor Data Already Exists",
                        icon: "warning"
                    });
                }
            },
            error: function (error) {
                console.error("Error:", error);
            }
        });
    });
</script>