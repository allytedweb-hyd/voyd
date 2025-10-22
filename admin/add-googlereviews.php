<?php
include 'includes/header.php';
include './functions/googlereviewsFunctions.php';

if(isset($_POST['submit_form'])) {

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $filename = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = 'Uploads/googlereviews/' . $filename;
    
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $_POST['oldImage'] = $filename; 
        }
    }

    addGooglereview();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./google_reviews.php">View Google Reviews
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
                        <h3 class="mb-4 text-center htext">Add Google Reviews</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Name<span class="errorindicator">*</span></label>
                                <!-- <input type="text" class="form-control" name="name" id="name"> -->
                                  <select name="name" id="name" class="form-select ">
                                    <option value="">Select Vendor</option>
                                    <?php
                                    $getActiveVendor = mysqli_query($conn, "SELECT * FROM vendor_management WHERE status = 1");
                                    while ($vendorsList = mysqli_fetch_array($getActiveVendor)) {

                                    ?>
                                        <option 
                                        value="<?php echo $vendorsList['vendor_id'] ?>" <?php echo (isset($_POST['name']) && $_POST['name'] == $vendorsList['vendor_id']) ? 'selected' : ''; ?>                                    
                                    ><?php echo $vendorsList['vendor_full_name'] ?> </option>

                                    <?php
                                    }
                                    ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                              <div class="col-md-6">
                                <label for="input2" class="form-label"> Reviewer Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="review_name" id="review_name" value="<?php echo isset($_POST['review_name']) ? htmlspecialchars($_POST['review_name']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                          

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image<span class="errorindicator">*</span> <span class="requiredtext">	(JPG,JPEG,PNG & 
151×89px)</span></label>
                                <input type="file" class="form-control" name="image" id="image">

                                <input type="hidden" name="oldImage" value="<?php echo isset($_POST['oldImage']) ? htmlspecialchars($_POST['oldImage']) : ''; ?>">


<?php if (!empty($_POST['oldImage'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/googlereviews/<?php echo htmlspecialchars($_POST['oldImage']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Location<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="location" id="location" value="<?php echo isset($_POST['location']) ? htmlspecialchars($_POST['location']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Description<span class="errorindicator">*</span></label>
                                <textarea id="reviewdesc" name="description"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-blog"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-blog"
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

<!-- <script>
		CKEDITOR.replace('blogdesc', {
			height: 320,
		});
	</script> -->

    <script>
$('#reviewdesc').summernote({
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

<script src="./assets/api/googlereviewsapi.js"></script>

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

  
    
    capitalizeFirstLetter("location");

 
});
</script>