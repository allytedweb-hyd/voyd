<?php
include 'includes/header.php';
include './functions/breadcrumbFunctions.php';

if (isset($_POST['submit_form'])) {

    if (isset($_FILES['BreadcrumbImage']) && $_FILES['BreadcrumbImage']['error'] === 0) {
        $filename = time() . '_' . basename($_FILES['BreadcrumbImage']['name']);
        $targetPath = 'Uploads/breadcrumbs/' . $filename;
    
        if (move_uploaded_file($_FILES['BreadcrumbImage']['tmp_name'], $targetPath)) {
            $_POST['oldImage'] = $filename; 
        }
    }


    addBreadcrumb();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./breadcrumb.php">View
                                Breadcrumb
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
                        <h3 class="mb-4 text-center htext">Add Breadcrumb</h3>
                        <form class="row form_new" id="" name="submitForm" method="post" enctype="multipart/form-data">

                            <div class="col-md-6">
                                <label class="form-label"> Page<span class="errorindicator">*</span></label>
                                <select class="form-select" name="breadcrumbPage" size="1" id="pageType">
                                    <option value="">Select</option>
                                    <option value="About page">About page</option>
                                    <option value="Services page">Services page</option>
                                    <option value="Blog page">Blog page</option>
                                    <option value="Contact page">Contact page</option>
                                    <option value="Shop page">Shop page</option>
                                    <option value="Gallery page">Gallery page</option>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>



                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Breadcumb Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="BreadcrumbImage" id="breadcrumbImage">

                                <input type="hidden" name="oldImage" value="<?php echo isset($_POST['oldImage']) ? htmlspecialchars($_POST['oldImage']) : ''; ?>">


<?php if (!empty($_POST['oldImage'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/breadcrumbs/<?php echo htmlspecialchars($_POST['oldImage']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="breadcrumbAlttext" value="<?php echo isset($_POST['alttext']) ? htmlspecialchars($_POST['alttext']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Breadcrumb Title<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="BreadcrumbTitle" id="breadcrumbTitle" value="<?php echo isset($_POST['BreadcrumbTitle']) ? htmlspecialchars($_POST['BreadcrumbTitle']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-breadcrumb"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-breadcrumb"
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
<script src="./assets/api/breadcrumbapi.js"></script>


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

  
    capitalizeFirstLetter("breadcrumbAlttext");
    capitalizeFirstLetter("breadcrumbTitle");

 
});
</script>