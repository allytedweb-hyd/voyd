<?php
include 'includes/header.php';
include './functions/categoryFunctions.php';
if (isset($_POST['submit_form'])) {
    $uploadDir = 'Uploads/category/';
    foreach (['CategoryImage' => 'oldImage', 'bannerimage2' => 'oldImage2'] as $imgField => $postKey) {
        if (isset($_FILES[$imgField]) && $_FILES[$imgField]['error'] === 0) {
            $uploadResult = validateImage($uploadDir, $_FILES[$imgField]);
            if ($uploadResult) {
                $_POST[$postKey] = $uploadResult;
            } else {
                echo "Failed to upload $imgField<br>";
            }
        }
    }
    addCategory();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./category.php">View Category
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
                        <h3 class="mb-4 text-center htext">Add Category</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Enter Category<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="category" id="procategory" value="<?php echo isset($_POST['category']) ? htmlspecialchars($_POST['category']) : ''; ?>">
                                <p id="errText" class="error-text" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Offer<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="offer" id="offer" value="<?php echo isset($_POST['offer']) ? htmlspecialchars($_POST['offer']) : ''; ?>">
                                <p id="errText" class="error-text" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="CategoryImage" id="pcategoryImage">
                                <input type="hidden" name="oldImage" value="<?php echo isset($_POST['oldImage']) ? htmlspecialchars($_POST['oldImage']) : ''; ?>">
<?php if (!empty($_POST['oldImage'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/category/<?php echo htmlspecialchars($_POST['oldImage']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="categoryAlttext" value="<?php echo isset($_POST['alttext']) ? htmlspecialchars($_POST['alttext']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label">Banner Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="bannerimage2" id="bannerimage">
                                <input type="hidden" name="oldImage2" value="<?php echo isset($_POST['oldImage2']) ? htmlspecialchars($_POST['oldImage2']) : ''; ?>">
<?php if (!empty($_POST['oldImage2'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/category/<?php echo htmlspecialchars($_POST['oldImage2']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input3" class="form-label">Banner Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext2" id="bannerAlttext" value="<?php echo isset($_POST['alttext2']) ? htmlspecialchars($_POST['alttext2']) : ''; ?>">
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
    capitalizeFirstLetter("procategory");
    capitalizeFirstLetter("categoryAlttext");
});
</script>