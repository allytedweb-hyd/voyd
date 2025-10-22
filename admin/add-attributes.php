<?php
include 'includes/header.php';
include './functions/attributeFunctions.php';

if (isset($_POST['submit_form'])) {

    addAttributes();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./attributes.php">View
                                Attributes
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
                        <h3 class="mb-4 text-center htext">Add Attributes</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data" id="myform" name="myform">

                            <div class="col-md-12">
                                <label class="form-label"> Select Product Type<span class="errorindicator">*</span></label>
                                <select class="form-select" name="productType" size="1" id="producType" onChange="productTypevalue()">
                                    <option value="">Select Product Type</option>

                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM product_type WHERE status=1");
                                    while ($fetch = mysqli_fetch_array($query)) {
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
                                <label class="form-label"> Select Category<span class="errorindicator">*</span></label>
                                <select class="form-select" name="category" size="1" id="category" onChange="McategoryValue()">
                                    <option value="">Select Category</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM manufacturer_category WHERE status=1");
                                    while ($fetch = mysqli_fetch_array($query)) {
                                    ?>
                                        <option 
                                        value="<?php echo $fetch['mcategory_id'] ?>" <?php echo (isset($_POST['category']) && $_POST['category'] == $fetch['mcategory_id']) ? 'selected' : ''; ?>
                                        >
                                            <?php echo $fetch['category_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"> Select Sub-Category<span class="errorindicator">*</span></label>
                                <select class="form-select" name="subcategory" size="1" id="subcategory">
                                    <option value="">Select Sub-Category</option>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Enter Attributes<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="attribute" id="attribute" value="<?php echo isset($_POST['attribute']) ? htmlspecialchars($_POST['attribute']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-attributes"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-attributes"
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
<script src="./assets/api/attributesapi.js"></script>

<script>
    function productTypevalue() {
        var val = $("#producType").val();
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                id: val
            },
            success: function(result) {
                document.getElementById('category').innerHTML = result;
            }
        })
    }
</script>

<script>
    function McategoryValue() {
        var val = $("#category").val();
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                id1: val
            },
            success: function(result) {
                document.getElementById('subcategory').innerHTML = result;
            }
        })
    }
</script>


<script>
    $(document).ready(function() {
        function capitalizeFirstLetter(fieldId) {
            const input = document.getElementById(fieldId);
            input.addEventListener('blur', function() {
                let val = input.value.trim();
                if (val.length > 0) {
                    input.value = val.charAt(0).toUpperCase() + val.slice(1);
                }
            });
        }


        capitalizeFirstLetter("attribute");



    });
</script>