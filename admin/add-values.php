<?php
include 'includes/header.php';
include './functions/valueFunctions.php';

if (isset($_POST['submit_form'])) {

    addValues();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./values.php">View
                                Values
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
                        <h3 class="mb-4 text-center htext">Add Values</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data" id="myform" name="myform">
  
                        <div class="col-md-6">
                                <label class="form-label"> Select Product Type<span class="errorindicator">*</span></label>
                                <select class="form-select" name="productType" size="1" id="producType" onChange="productTypevalue()">
                                    <option value="">Select Product Type</option>

                                    <?php
                                    $query=mysqli_query($conn,"SELECT * FROM product_type WHERE status=1");
                                    while($fetch=mysqli_fetch_array($query)){
                                    ?>
                                    <option value="<?php echo $fetch['productType_id'] ?>">
                                        <?php echo $fetch['enter_productType'] ?></option>
                                    <?php
                                     }
                                     ?>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Select Category<span class="errorindicator">*</span></label>
                                <select class="form-select" name="category" size="1" id="category" onChange="McategoryValue()">
                                    <option value="">Select Category</option>
                                    <?php
                                    $query=mysqli_query($conn,"SELECT * FROM manufacturer_category WHERE status=1");
                                    while($fetch=mysqli_fetch_array($query)){
                                    ?>
                                    <option value="<?php echo $fetch['mcategory_id'] ?>">
                                        <?php echo $fetch['category_name'] ?></option>
                                    <?php
                                    }
                                     ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Select Sub-Category<span class="errorindicator">*</span></label>
                                <select class="form-select" name="subcategory" size="1" id="subcategory" onChange="MsubcategoryValue()">
                                    <option value="">Select Sub-Category</option>
                                    <?php
                                    $query=mysqli_query($conn,"SELECT * FROM manufacturer_subCategory WHERE status=1");
                                    while($fetch=mysqli_fetch_array($query)){
                                    ?>
                                    <option value="<?php echo $fetch['mSubcategory_id'] ?>">
                                        <?php echo $fetch['sub_category'] ?></option>
                                    <?php
                                    }
                                     ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Select Attributes<span class="errorindicator">*</span></label>
                                <select class="form-select" name="attribute" size="1" id="attribute">

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Enter Values<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="values" id="values" value="<?php echo isset($_POST['values']) ? htmlspecialchars($_POST['values']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-values"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-values"
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
<script src="./assets/api/valuesapi.js"></script>

<script>
    function productTypevalue(){
        var val = $("#producType").val();
        console.log('product type val----------',val);
        $.ajax({
    type: "POST",
    url: "ajax.php",
    data: {
        id:val
    },
    success: function(result){
        console.log(result);
        document.getElementById('category').innerHTML = result;
    }
})
    }
</script>

<script>
    function McategoryValue(){
        var val = $("#category").val();
        console.log('category val------',val);
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                id1:val
            },
            success: function(result){
        console.log(result);
        document.getElementById('subcategory').innerHTML = result;
    }
        })
    }
</script>

<script>
    function MsubcategoryValue(){
        var val = $("#subcategory").val();
        console.log('subcategory val-----',val);
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                id2:val
            },
            success: function(result){
                console.log(result);
                document.getElementById('attribute').innerHTML = result;
            }
        })
    }
</script>

<!-- <script>
    function attributeValue(){
        var val = $("#attributes").val();
        console.log('attribute val-----',val);
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                id3:val
            },
            success: function(result){
                console.log(result);
                document.getElementById('attribute').innerHTML = result;
            }
        })
    }
</script> -->

