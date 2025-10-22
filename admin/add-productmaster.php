<?php
include 'includes/header.php';
include './functions/productMaterFunctions.php';

if (isset($_POST['submit_form'])) {

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $filename = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = 'Uploads/productmaster/' . $filename;
    
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $_POST['oldImage'] = $filename; 
        }
    }
    
    addProduct();
    
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./productmaster.php">View Product 
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
                        <h3 class="mb-4 text-center htext">Add Product </h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="input1" class="form-label">  Product<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="product" id="product"  value="<?= isset($_POST['product']) ? htmlspecialchars($_POST['product']) : '' ?>"  >
                                <p id="errText" class="error-text"></p>
                            </div>

                             <div class="col-md-12">
                                <label for="employeeImage" class="form-label"> Image<span class="errorindicator">*</span><span class="requiredtext">	(Required only JPG,JPEG,PNG & Dimensions 
122 × 
80, Size< 1 Mb)</span></label>
                                <input type="file" class="form-control"  name="image" id="image"  >

                                
                           

<input type="hidden" name="oldImage" value="<?php echo isset($_POST['oldImage']) ? htmlspecialchars($_POST['oldImage']) : ''; ?>">


<?php if (!empty($_POST['oldImage'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/productmaster/<?php echo htmlspecialchars($_POST['oldImage']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>



                                <p id="errText" class="error-text"></p>
                            </div>

                              <div class="col-md-12">
                                <label for="input1" class="form-label"> Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt_text" id="alt_text"   value="<?= isset($_POST['alt_text']) ? htmlspecialchars($_POST['alt_text']) : '' ?>"   >
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-material" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-material" class="btn btn-primary px-4 submit d-none">Submit</button>
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

<?php include 'includes/footer.php'; ?>,
<script src="./assets/api/productmasterapi.js"></script>


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

  
    capitalizeFirstLetter("product");
    capitalizeFirstLetter("alt_text");

 
});
</script>






<script>
    const hiddenImageInput = document.getElementById('image_old');
    if (hiddenImageInput) {
        console.log("Hidden image field value:", hiddenImageInput.value);
    }
</script>


