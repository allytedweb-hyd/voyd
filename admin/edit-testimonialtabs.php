<?php
include 'includes/header.php';
include './functions/testimonialtabsFunctions.php';

if (isset($_POST['submit_form'])) {
    editTestimonialtabs();
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
                        <h3 class="mb-4 text-center htext">Edit Testimonial Tab</h3>

                         <?php
                        $query = mysqli_query($conn, "select * from testimonial_tabs where tab_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>


                        <form class="row form_new" method="post" enctype="multipart/form-data" name="myform" id="myform">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Testimonial Name<span class="errorindicator">*</span></label>

                                <select class="form-select" name="testimonialname" id="testimonialname">

                                <!-- <?php
                                                $gettestimonialname = mysqli_query($conn,"SELECT * FROM testimonials WHERE testimonial_id='".$fetch['user_name']."'");

                                                $fetchname = mysqli_fetch_array($gettestimonialname);

?>

                                <option value="<?php echo $fetchname['testimonial_id']; ?>">
<?php echo $fetchname['testimonial_name']; ?>
                                </option>

                                  <?php
                                $querytestimonial = mysqli_query($conn, "SELECT * FROM testimonials WHERE status=1");
                                  while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonials['testimonial_id'] ?>">
                                        <?php echo $fetchTestimonials['testimonial_name'] ?></option>
                                    <?php
                                    }
                                    ?> -->


<?php
         
            $gettestimonialname = mysqli_query($conn, "SELECT * FROM testimonials WHERE testimonial_id='" . $fetch['user_name'] . "'");
            $fetchname = mysqli_fetch_array($gettestimonialname);
            ?>

        
            <option value="<?php echo $fetchname['testimonial_id']; ?>">
                <?php echo $fetchname['testimonial_name']; ?>
            </option>

            <?php
            
            $querytestimonial = mysqli_query($conn, "SELECT * FROM testimonials WHERE status=1 AND testimonial_id != '" . $fetchname['testimonial_id'] . "'");
            while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                ?>
                <option value="<?php echo $fetchTestimonials['testimonial_id']; ?>">
                    <?php echo $fetchTestimonials['testimonial_name']; ?>
                </option>
            <?php
            }
            ?>




                                </select>
                                
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Tab<span class="errorindicator">*</span></label>

                                <select class="form-select" name="tab" id="tab">

                         

                                <!-- <option value="<?php echo $fetch['tab_name']; ?>">
<?php echo $fetch['tab_name']; ?>
                                </option>

                                  <?php
                                $querytestimonial = mysqli_query($conn, "SELECT * FROM property_sections WHERE status=1");
                                  while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonials['enter_section'] ?>">
                                        <?php echo $fetchTestimonials['enter_section'] ?></option>
                                    <?php
                                    }
                                    ?> -->

 
  <option value="<?php echo $fetch['tab_name']; ?>">
                <?php echo $fetch['tab_name']; ?>
            </option>

            <?php
            
            $querytestimonial = mysqli_query($conn, "SELECT * FROM property_sections WHERE status=1 AND enter_section != '" . $fetch['tab_name'] . "'");
            while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                ?>
                <option value="<?php echo $fetchTestimonials['enter_section']; ?>">
                    <?php echo $fetchTestimonials['enter_section']; ?>
                </option>
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
                                 <img src="./Uploads/testimonialtabs/<?php echo $fetch['image1'] ?>" width="100" height="80" />
                                 <input type="hidden" name="oldImage1" value="<?php echo $fetch['image1'] ?>" />
                                <input type="hidden" name="testimonialId" value="<?php echo $fetch['tab_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 2<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image2" id="image2">
                                  <img src="./Uploads/testimonialtabs/<?php echo $fetch['image2'] ?>" width="100" height="80" />
                                  <input type="hidden" name="oldImage2" value="<?php echo $fetch['image2'] ?>" />

                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 3<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image3" id="image3">
                                  <img src="./Uploads/testimonialtabs/<?php echo $fetch['image3'] ?>" width="100" height="80" />
                                  <input type="hidden" name="oldImage3" value="<?php echo $fetch['image3'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Icon<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="icon" id="icon">
                                  <img src="./Uploads/testimonialtabs/<?php echo $fetch['icon'] ?>" width="100" height="80" />
                                  <input type="hidden" name="oldImage4" value="<?php echo $fetch['icon'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo $fetch['img_alt_text']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Description<span class="errorindicator">*</span></label>
                                <textarea id="testdesc" name="description"><?php echo $fetch['description']; ?></textarea>
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
