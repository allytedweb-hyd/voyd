<?php
include 'includes/header.php';
include './functions/galleryFunctions.php';

if (isset($_POST['submit_form'])) {

    $uploadDir = 'Uploads/gallery/';

  foreach (['image', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7', 'image8', 'image9', 'image10', 'profile_img'] as $imgField) {
    if (isset($_FILES[$imgField]) && $_FILES[$imgField]['error'] === 0) {
        $filename = time() . '_' . basename($_FILES[$imgField]['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES[$imgField]['tmp_name'], $targetPath)) {
            
            $postKey = ($imgField === 'profile_img') ? 'oldImage11' : 'old' . ucfirst($imgField);
            $_POST[$postKey] = $filename;
        }
    }
}



    addGallery();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./gallery.php">View
                                Previous Projects</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Add Previous Projects</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">

                            <div class="col-md-12">
                                <label class="form-label"> Category<span class="errorindicator">*</span></label>
                                <select class="form-select" name="category" size="1" id="category">
                                    <option value="">Select Category</option>
                                    <?php
                                    $query=mysqli_query($conn,"SELECT * FROM gallery_category WHERE status=1");
                                    while($fetch=mysqli_fetch_array($query)){
                                    ?>
                                    <option   value="<?php echo $fetch['gcategory_id'] ?>" <?php echo (isset($_POST['category']) && $_POST['category'] == $fetch['gcategory_id']) ? 'selected' : ''; ?>>
                                        <?php echo $fetch['category_name'] ?></option>
                                    <?php
                                     }
                                     ?>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            

                            <span class="mt-2 mb-2" style="font-size: 14px; color: gray;">(** All Images Required only JPG,JPEG,PNG & Dimensions 
276 × 
260px, Size< 1 Mb)</span>

                           


                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 1<span class="errorindicator">*</span>  </label>
                                <input type="file" class="form-control" name="image" id="image">

                                <input type="hidden" name="oldImage" value="<?php echo isset($_POST['oldImage']) ? htmlspecialchars($_POST['oldImage']) : ''; ?>">

<?php if (!empty($_POST['oldImage'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/gallery/<?php echo htmlspecialchars($_POST['oldImage']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 2<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image2" id="image2">


                                <input type="hidden" name="oldImage2" value="<?php echo isset($_POST['oldImage2']) ? htmlspecialchars($_POST['oldImage2']) : ''; ?>">

<?php if (!empty($_POST['oldImage2'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/gallery/<?php echo htmlspecialchars($_POST['oldImage2']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 3<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image3" id="image3">

                                <input type="hidden" name="oldImage3" value="<?php echo isset($_POST['oldImage3']) ? htmlspecialchars($_POST['oldImage3']) : ''; ?>">

<?php if (!empty($_POST['oldImage3'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/gallery/<?php echo htmlspecialchars($_POST['oldImage3']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 4<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image4" id="image4">

                                <input type="hidden" name="oldImage4" value="<?php echo isset($_POST['oldImage4']) ? htmlspecialchars($_POST['oldImage4']) : ''; ?>">

<?php if (!empty($_POST['oldImage4'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/gallery/<?php echo htmlspecialchars($_POST['oldImage4']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 5<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image5" id="image5">

                                <input type="hidden" name="oldImage5" value="<?php echo isset($_POST['oldImage5']) ? htmlspecialchars($_POST['oldImage5']) : ''; ?>">

<?php if (!empty($_POST['oldImage5'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/gallery/<?php echo htmlspecialchars($_POST['oldImage5']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>



                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 6<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image6" id="image6">

                                <input type="hidden" name="oldImage6" value="<?php echo isset($_POST['oldImage6']) ? htmlspecialchars($_POST['oldImage6']) : ''; ?>">

<?php if (!empty($_POST['oldImage6'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/gallery/<?php echo htmlspecialchars($_POST['oldImage6']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>



                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 7<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image7" id="image7">

                                <input type="hidden" name="oldImage7" value="<?php echo isset($_POST['oldImage7']) ? htmlspecialchars($_POST['oldImage7']) : ''; ?>">

<?php if (!empty($_POST['oldImage7'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/gallery/<?php echo htmlspecialchars($_POST['oldImage7']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>



                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 8<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image8" id="image8">

                                <input type="hidden" name="oldImage8" value="<?php echo isset($_POST['oldImage8']) ? htmlspecialchars($_POST['oldImage8']) : ''; ?>">

<?php if (!empty($_POST['oldImage8'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/gallery/<?php echo htmlspecialchars($_POST['oldImage8']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>



                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 9<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image9" id="image9">


                                <input type="hidden" name="oldImage9" value="<?php echo isset($_POST['oldImage9']) ? htmlspecialchars($_POST['oldImage9']) : ''; ?>">

<?php if (!empty($_POST['oldImage9'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/gallery/<?php echo htmlspecialchars($_POST['oldImage9']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>



                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 10<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image10" id="image10">

                                <input type="hidden" name="oldImage10" value="<?php echo isset($_POST['oldImage10']) ? htmlspecialchars($_POST['oldImage10']) : ''; ?>">

<?php if (!empty($_POST['oldImage10'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/gallery/<?php echo htmlspecialchars($_POST['oldImage10']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>



                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo isset($_POST['alttext']) ? htmlspecialchars($_POST['alttext']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                           

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Price<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="price" id="price" value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Rating<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="rating" id="rating" value="<?php echo isset($_POST['rating']) ? htmlspecialchars($_POST['rating']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Profile Image<span class="errorindicator">*</span> <span class="requiredtext">	(Required only JPG,JPEG,PNG & Dimensions 
35 × 
35px, Size< 1 Mb)</span></label>
                                <input type="file" class="form-control" name="profile_img" id="profile_img">

                                <input type="hidden" name="oldImage11" value="<?php echo isset($_POST['oldImage11']) ? htmlspecialchars($_POST['oldImage11']) : ''; ?>">

<?php if (!empty($_POST['oldImage11'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/gallery/<?php echo htmlspecialchars($_POST['oldImage11']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                             <div class="col-md-12">
                                <label for="input3" class="form-label"> Profile Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="profilealttext" id="profilealttext" value="<?php echo isset($_POST['profilealttext']) ? htmlspecialchars($_POST['profilealttext']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Customer Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="cus_name" id="cus_name" value="<?php echo isset($_POST['cus_name']) ? htmlspecialchars($_POST['cus_name']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Customer Status<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="cus_status" id="cus_status" value="<?php echo isset($_POST['cus_status']) ? htmlspecialchars($_POST['cus_status']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Flat No.<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="flat" id="flat" value="<?php echo isset($_POST['flat']) ? htmlspecialchars($_POST['flat']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-gallery"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-gallery"
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
<script src="./assets/api/galleryapi.js"></script>



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

  
    capitalizeFirstLetter("cus_name");
    capitalizeFirstLetter("profilealttext");
    capitalizeFirstLetter("cus_status");
    capitalizeFirstLetter("flat");

 
});
</script>