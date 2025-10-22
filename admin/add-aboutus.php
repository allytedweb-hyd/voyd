<?php
include 'includes/header.php';
include './functions/aboutFunctions.php';

if (isset($_POST['submit_form'])) {

    if (isset($_FILES['founderImage']) && $_FILES['founderImage']['error'] === 0) {
        $filename = time() . '_' . basename($_FILES['founderImage']['name']);
        $targetPath = 'Uploads/aboutus/' . $filename;
    
        if (move_uploaded_file($_FILES['founderImage']['tmp_name'], $targetPath)) {
            $_POST['oldImage'] = $filename; 
        }
    }


    addAbout();
}
?>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 btext">
            <!-- <div class="breadcrumb-title pe-3">Forms</div> -->
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a class="picon" href="./index.php"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="./aboutus.php">View
                                About Us</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Add About Us</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data" name="myform" id="myform">

                            <div class="col-md-12">
                                <label class="form-label"> Founder Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="founderName" id="founder" value="<?php echo isset($_POST['founderName']) ? htmlspecialchars($_POST['founderName']) : ''; ?>" />

                                <!-- <select class="form-select" name="content" size="1" id="content">
                                    <option value="">Select</option>
                                    <option value="About Store">About Store</option>
                                    <option value="Our Success">Our Success</option>
                                    <option value="What We Believe">What We Believe</option>
                                </select> -->
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label"> Founder Image<span class="errorindicator">*</span> <span class="requiredtext">	(Required only JPG,JPEG,PNG & Dimensions 
727 × 
630px, Size< 1 Mb)</span></label>
                                <input type="file" class="form-control" name="founderImage" id="founder-image" />

                                <input type="hidden" name="oldImage" value="<?php echo isset($_POST['oldImage']) ? htmlspecialchars($_POST['oldImage']) : ''; ?>">


<?php if (!empty($_POST['oldImage'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/category/<?php echo htmlspecialchars($_POST['oldImage']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>

                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label"> Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="founderImageAlt" id="founder-image-alt" value="<?php echo isset($_POST['founderImageAlt']) ? htmlspecialchars($_POST['founderImageAlt']) : ''; ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Description<span class="errorindicator">*</span></label>
                                <textarea id="adesc" name="description"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>


                            




                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-aboutus"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-aboutus"
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

<!-- <div>
    <div style="background-color:#000; width:500px; height:200px;">
       <p style="color:#fff">Section</p>
    </div>
    <div style="background-color: aquamarine; width:500px; height:200px;">
       <p style="color:#fff">Section</p>
    </div>
    <div style="background-color:#000; width:500px; height:200px;">
       <p style="color:#fff">Section</p>
    </div>
</div> -->

<?php include 'includes/footer.php'; ?>

<!-- <script>
		CKEDITOR.replace('adesc', {
            height: 320,
		});
	</script> -->

<script>
    $('#adesc').summernote({
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

<script src="./assets/api/aboutusapi.js"></script>


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

  
    capitalizeFirstLetter("founder");
    capitalizeFirstLetter("founder-image-alt");

 
});
</script>