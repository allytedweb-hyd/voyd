<?php
include 'includes/header.php';
include './functions/testimonialtabsFunctions.php';

if (isset($_POST['submit_form'])) {

    $uploadDir = 'Uploads/testimonialtabs/';

    foreach (['image1', 'image2', 'image3', 'image4'] as $imgField) {
        if (isset($_FILES[$imgField]) && $_FILES[$imgField]['error'] === 0) {
            $filename = time() . '_' . basename($_FILES[$imgField]['name']);
            $targetPath = $uploadDir . $filename;
    
            if (move_uploaded_file($_FILES[$imgField]['tmp_name'], $targetPath)) {
                
                $postKey = 'old' . ucfirst($imgField); 
                $_POST[$postKey] = $filename;
            }
        }
    }


    addTestimonialtabs();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./testimonialtabs.php">View
                                Testimonial Tabs</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Add Testimonial Tab</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data" name="myform" id="myform">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Testimonial Name<span class="errorindicator">*</span></label>

                                <select class="form-select" name="testimonialname" id="testimonialname">

                                <option value="">
Select
                                </option>

                                  <?php
                                $querytestimonial = mysqli_query($conn, "SELECT * FROM testimonials WHERE status=1");
                                  while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                                    ?>
                                    <option 
                                    value="<?php echo $fetchTestimonials['testimonial_id'] ?>" <?php echo (isset($_POST['testimonialname']) && $_POST['testimonialname'] == $fetchTestimonials['testimonial_id']) ? 'selected' : ''; ?>
                                    >

                                        <?php echo $fetchTestimonials['testimonial_name'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Tab<span class="errorindicator">*</span></label>

                                <select class="form-select" name="tab" id="tab">

                                <option value="">
Select
                                </option>

                                  <?php
                                $querytestimonial = mysqli_query($conn, "SELECT * FROM property_sections WHERE status=1");
                                  while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                                    ?>
                                    <option 
                                    value="<?php echo $fetchTestimonials['enter_section'] ?>" <?php echo (isset($_POST['tab']) && $_POST['tab'] == $fetchTestimonials['enter_section']) ? 'selected' : ''; ?>
                                    >
                                        <?php echo $fetchTestimonials['enter_section'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                
                                <p id="errText" class="error-text"></p>
                            </div>


                             <span class="mt-2 mb-2" style="font-size: 14px; color: gray;">(** All Images Required only JPG,JPEG,PNG & Dimensions 
374 × 
347px, Size< 1 Mb)</span>
                            
                            

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 1<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image1" id="image1">

                                <input type="hidden" name="oldImage1" value="<?php echo isset($_POST['oldImage1']) ? htmlspecialchars($_POST['oldImage1']) : ''; ?>">


<?php if (!empty($_POST['oldImage1'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/testimonialtabs/<?php echo htmlspecialchars($_POST['oldImage1']); ?>" alt="Uploaded Image" width="80">
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
        <img src="Uploads/testimonialtabs/<?php echo htmlspecialchars($_POST['oldImage2']); ?>" alt="Uploaded Image" width="80">
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
        <img src="Uploads/testimonialtabs/<?php echo htmlspecialchars($_POST['oldImage3']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Icon<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image4" id="icon">

                                <input type="hidden" name="oldImage4" value="<?php echo isset($_POST['oldImage4']) ? htmlspecialchars($_POST['oldImage4']) : ''; ?>">


<?php if (!empty($_POST['oldImage4'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/testimonialtabs/<?php echo htmlspecialchars($_POST['oldImage4']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo isset($_POST['alttext']) ? htmlspecialchars($_POST['alttext']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Description<span class="errorindicator">*</span></label>
                                <textarea id="testdesc" name="description"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-testimonial"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-testimonial"
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
<script src="./assets/api/testimonialtabsapi.js"></script>

<!-- <script>
    CKEDITOR.replace('testdesc', {
        height: 320,
    });
</script> -->

<script>
$('#testdesc').summernote({
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

  
    capitalizeFirstLetter("alttext");
    

 
});
</script>