<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/testimonialFunctions.php';

if (isset($_POST['submit_form'])) {
    editTestimonials();
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
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="./testimonials.php">View Testimonials</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Testimonials</h3>
                        <?php
                        $query = mysqli_query($conn, "select * from testimonials where 
                        testimonial_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>
                        <form class="row form_new" method="post" enctype="multipart/form-data" name="myform" id="myform">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $fetch['testimonial_name']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Rating<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="tdesig" name="designation" value="<?php echo $fetch['rating']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image<span class="errorindicator">*</span> <span class="requiredtext">	(Required only JPG,JPEG,PNG & Dimensions 
251 × 
264px, Size< 1 Mb)</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                <img src="./Uploads/testimonials/<?php echo $fetch['testimonial_image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['testimonial_image'] ?>" />
                                <input type="hidden" name="testimonialId" value="<?php echo $fetch['testimonial_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo $fetch['testimonial_alttext']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Testimonial Content<span class="errorindicator">*</span></label>
                                <textarea id="testdesc" name="description"><?php echo $fetch['testimonial_description']; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-testimonial" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-testimonial" class="btn btn-primary px-4 submit d-none">Submit</button>
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
<script src="./assets/api/testimonialsapi.js"></script>

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