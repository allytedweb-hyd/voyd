<?php
include 'includes/header.php';
include './functions/manufact-categoryFunctions.php';

if (isset($_POST['submit_form'])) {

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
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="./manufacturer-category.php">View Category
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
                        <form class="row form_new" method="post" enctype="multipart/form-data" id="myform" name="myform">

                        <div class="col-md-12">
                                <label class="form-label"> Select Product Type<span class="errorindicator">*</span></label>
                                <select class="form-select" name="productType" size="1" id="productType">
                                    <option value="">Select Product Type</option>

                                    <?php
                                    $query=mysqli_query($conn,"SELECT * FROM product_type WHERE status=1");
                                    while($fetch=mysqli_fetch_array($query)){
                                    ?>
                                    <option 
                                    value="<?php echo $fetch['productType_id'] ?>" <?php echo (isset($_POST['productType']) && $_POST['productType'] == $fetch['productType_id']) ? 'selected' : ''; ?>
                                    >
                                        <?php echo $fetch['enter_productType'] ?></option>
                                    <?php
                                     }
                                     ?>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Enter Category<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="category" id="category" value="<?php echo isset($_POST['category']) ? htmlspecialchars($_POST['category']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-category"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-category"
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
<script src="./assets/api/categoryapi.js"></script>


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

  
    capitalizeFirstLetter("category");
   

 
});
</script>