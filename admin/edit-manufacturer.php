<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/manufacturerFunctions.php';

if (isset($_POST['submit_form'])) {
    editManufacturer();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./manufacturer.php">View Manufacturer</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Manufacturer</h3>
                        <?php
                        $query = mysqli_query($conn, "select * from manufacturer where 
                        manufacturer_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $fetch['manufacturer_name'] ?>" />
                                <input type="hidden" name="manufacturerId" value="<?php echo $fetch['manufacturer_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input4" class="form-label"> Email<span class="errorindicator">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $fetch['manufacturer_email'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Contact Number-1<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="Phone" name="Phone" value="<?php echo $fetch['manufacturer_number'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Contact Number-2<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="Phone1" name="Phone1" value="<?php echo $fetch['contact_number'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Aadhar Number<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="aadhar" name="aadhar" value="<?php echo $fetch['manufacturer_aadhar'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Website Url<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="website" name="website" value="<?php echo $fetch['website_url'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Store Location<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="location" name="location" value="<?php echo $fetch['store_location'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> GST Number<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="gstnumber" name="gstnumber" value="<?php echo $fetch['gst_number'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Select Product Type<span class="errorindicator">*</span></label>
                                <select class="form-select" name="productType" size="1" id="manuproducType">
                                    <!-- <?php
                                    $productid = mysqli_query($conn, "select * from product_type where productType_id='" . $fetch['product_type'] . "'");
                                    $productname = mysqli_fetch_array($productid);
                                    ?>
                                    <option><?php echo $productname['enter_productType'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM product_type WHERE status=1");
                                    while ($fetchpro = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchpro['productType_id'] ?>">
                                            <?php echo $fetchpro['enter_productType'] ?></option>
                                    <?php
                                    }
                                    ?> -->


<option value="<?php echo $productname['productType_id']; ?>" selected>
        <?php echo $productname['enter_productType']; ?>
    </option>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM product_type WHERE status=1 AND productType_id != '" . $fetch['product_type'] . "'");
    while ($fetchpro = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $fetchpro['productType_id']; ?>">
            <?php echo $fetchpro['enter_productType']; ?>
        </option>
    <?php } ?>


                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Select Class<span class="errorindicator">*</span></label>
                                <select class="form-select" name="class" size="1" id="class">
                                    <!-- <?php
                                    $mcategoryid = mysqli_query($conn, "select * from manufacturer_category where mcategory_id='" . $fetch['class'] . "'");
                                    $mcategoryname = mysqli_fetch_array($mcategoryid);
                                    ?>
                                    <option><?php echo $mcategoryname['category_name'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM manufacturer_category WHERE status=1");
                                    while ($fetchCat = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchCat['mcategory_id'] ?>"><?php echo $fetchCat['category_name'] ?></option>
                                    <?php
                                    }
                                    ?> -->


<option value="<?php echo $mcategoryname['mcategory_id']; ?>" selected>
        <?php echo $mcategoryname['category_name']; ?>
    </option>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM manufacturer_category WHERE status=1 AND mcategory_id != '" . $fetch['class'] . "'");
    while ($fetchCat = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $fetchCat['mcategory_id']; ?>">
            <?php echo $fetchCat['category_name']; ?>
        </option>
    <?php } ?>


                                </select>
                                <p id="errText"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Select Characteristics<span class="errorindicator">*</span></label>
                                <select class="form-select" name="characteristics" size="1" id="characteristics">
                                    <!-- <?php
                                    $msubcategoryid = mysqli_query($conn, "select * from manufacturer_subCategory where mSubcategory_id='" . $fetch['characteristics'] . "'");
                                    $msubcategoryname = mysqli_fetch_array($msubcategoryid);
                                    ?>
                                    <option><?php echo $msubcategoryname['sub_category'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM manufacturer_subCategory WHERE status=1");
                                    while ($fetchSubcat = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchSubcat['mSubcategory_id'] ?>"><?php echo $fetchSubcat['sub_category'] ?></option>
                                    <?php
                                    }
                                    ?> -->


<option value="<?php echo $msubcategoryname['mSubcategory_id']; ?>" selected>
        <?php echo $msubcategoryname['sub_category']; ?>
    </option>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM manufacturer_subCategory WHERE status=1 AND mSubcategory_id != '" . $fetch['characteristics'] . "'");
    while ($fetchSubcat = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $fetchSubcat['mSubcategory_id']; ?>">
            <?php echo $fetchSubcat['sub_category']; ?>
        </option>
    <?php } ?>


                                </select>
                                <p id="errText"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Select Attributes<span class="errorindicator">*</span></label>
                                <select class="form-select" name="attributes" size="1" id="attributes">
                                    <!-- <?php
                                    $attributeid = mysqli_query($conn, "select * from attributes where attribute_id='" . $fetch['attributes'] . "'");
                                    $attributename = mysqli_fetch_array($attributeid);
                                    ?>
                                    <option><?php echo $attributename['attributes'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM attributes WHERE status=1");
                                    while ($fetchAtt = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchAtt['attribute_id'] ?>"><?php echo $fetchAtt['attributes'] ?></option>
                                    <?php
                                    }
                                    ?> -->

<option value="<?php echo $attributename['attribute_id']; ?>" selected>
        <?php echo $attributename['attributes']; ?>
    </option>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM attributes WHERE status=1 AND attribute_id != '" . $fetch['attributes'] . "'");
    while ($fetchAtt = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $fetchAtt['attribute_id']; ?>">
            <?php echo $fetchAtt['attributes']; ?>
        </option>
    <?php } ?>

                                </select>
                                <p id="errText"></p>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"> Select Values<span class="errorindicator">*</span></label>
                                <select class="form-select" name="values" size="1" id="manuvalue">
                                    <!-- <?php
                                    $valueid = mysqli_query($conn, "select * from value_master where values_id='" . $fetch['select_value'] . "'");
                                    $valuename = mysqli_fetch_array($valueid);
                                    ?>
                                    <option><?php echo $valuename['enter_values'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM value_master WHERE status=1");
                                    while ($fetchVal = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchVal['values_id'] ?>">
                                            <?php echo $fetchVal['enter_values'] ?></option>
                                    <?php
                                    }
                                    ?> -->


<option value="<?php echo $valuename['values_id']; ?>" selected>
        <?php echo $valuename['enter_values']; ?>
    </option>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM value_master WHERE status=1 AND values_id != '" . $fetch['select_value'] . "'");
    while ($fetchVal = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $fetchVal['values_id']; ?>">
            <?php echo $fetchVal['enter_values']; ?>
        </option>
    <?php } ?>



                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-12">
                                <label for="input11" class="form-label"> Address<span class="errorindicator">*</span></label>
                                <textarea id="editor" name="address"><?php echo $fetch['address']; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-manufacturer"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-manufacturer"
                                        class="btn btn-primary px-4 submit d-none">Submit</button>                                </div>
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
<script src="./assets/api/manufacturerapi.js"></script>

<script>
$('#editor').summernote({
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
