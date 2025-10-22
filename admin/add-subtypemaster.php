<?php
include 'includes/header.php';
include './functions/subtypeMaterFunctions.php';

if (isset($_POST['submit_form'])) {
    addSubtypemaster();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./subtypemaster.php">View Sub Type 
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
                        <h3 class="mb-4 text-center htext">Add Sub Type </h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">


                        <div class="col-md-12">
                                <label for="input1" class="form-label"> Product<span class="errorindicator">*</span></label>

                                <select class="form-select" name="product" id="product">

                                <option value="">
Select
                                </option>

                                  <?php
                                $querytestimonial = mysqli_query($conn, "SELECT * FROM product_master WHERE status=1");
                                  while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonials['product_master'] ?>">
                                        <?php echo $fetchTestimonials['product_master'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                
                                <p id="errText" class="error-text"></p>
                            </div>



                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Product Type<span class="errorindicator">*</span></label>

                                <select class="form-select" name="producttype" id="producttype">

                                <option value="">
Select
                                </option>

                                  <?php
                                $querytestimonial = mysqli_query($conn, "SELECT * FROM product_type_master WHERE status=1");
                                  while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonials['product_type'] ?>">
                                        <?php echo $fetchTestimonials['product_type'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                
                                <p id="errText" class="error-text"></p>
                            </div>



                            <div class="col-md-12">
                                <label for="input1" class="form-label">  Sub Type<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="subtype" id="subtype">
                                <p id="errText" class="error-text"></p>
                            </div>


                         

                             <!-- <div class="col-md-12">
                                <label for="input1" class="form-label"> Recommend</label>
                                <input type="text" class="form-control" name="recommend" id="recommend">
                                <p id="errText" class="error-text"></p>
                            </div>

                             <div class="col-md-12">
                                <label for="input1" class="form-label"> Strongly Recommend</label>
                                <input type="text" class="form-control" name="strongly_recommend" id="strongly_recommend">
                                <p id="errText" class="error-text"></p>
                            </div> -->

                             <div class="col-md-12">
                                <label for="input1" class="form-label">  Priority<span class="errorindicator">*</span> </label>

                                  <select class="form-select" name="recommend" id="recommend">
                                    <option value="">Select</option>
                                    <option value="recommend">Recommend</option>
                                    <option value="not_recommend">Not Recommend</option>
                                    <option value="highly_recommend">Highly Recommend</option>
                                </select>


                                
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
<script src="./assets/api/subtypemasterapi.js"></script>


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

  
    capitalizeFirstLetter("subtype");
    

 
});
</script>