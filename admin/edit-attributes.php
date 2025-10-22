<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/attributeFunctions.php';

if (isset($_POST['submit_form'])) {
    editAttributes();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./attributes.php">View Attributes</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Attributes</h3>

                        <?php
                        $query = mysqli_query($conn, "select * from attributes where attribute_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data" id="myform" name="myform">

                            <div class="col-md-12">
                                <label class="form-label"> Select Product Type<span class="errorindicator">*</span></label>
                                <select class="form-select" name="productType" id="producType">
                                <?php
    $productid = mysqli_query($conn, "select * from product_type where productType_id='" . $fetch['product_type'] . "'");
    $productname = mysqli_fetch_array($productid);
    ?>
    <option value="<?php echo $productname['productType_id']; ?>"><?php echo $productname['enter_productType'] ?></option>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM product_type WHERE status=1");
    while ($fetchCat = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $fetchCat['productType_id'] ?>"><?php echo $fetchCat['enter_productType'] ?></option>
    <?php } ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"> Select Category<span class="errorindicator">*</span></label>
                                <select class="form-select" id="category" name="category">
                                <?php
    $mcategoryid = mysqli_query($conn, "select * from manufacturer_category where mcategory_id='" . $fetch['category'] . "'");
    $mcategoryname = mysqli_fetch_array($mcategoryid);
    ?>
    <option value="<?php echo $mcategoryname['mcategory_id']; ?>"><?php echo $mcategoryname['category_name'] ?></option>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM manufacturer_category WHERE status=1");
    while ($fetchCat = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $fetchCat['mcategory_id'] ?>"><?php echo $fetchCat['category_name'] ?></option>
    <?php } ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"> Select Sub-Category<span class="errorindicator">*</span></label>
                                <select class="form-select" id="subcategory" name="subcategory">
                                <?php
    $msubcategoryid = mysqli_query($conn, "select * from manufacturer_subCategory where mSubcategory_id='" . $fetch['sub_category'] . "'");
    $msubcategoryname = mysqli_fetch_array($msubcategoryid);
    ?>
    <option value="<?php echo $msubcategoryname['mSubcategory_id']; ?>"><?php echo $msubcategoryname['sub_category'] ?></option>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM manufacturer_subCategory WHERE status=1");
    while ($fetchSubcat = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $fetchSubcat['mSubcategory_id'] ?>"><?php echo $fetchSubcat['sub_category'] ?></option>
    <?php } ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Enter Attributes<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="attribute" id="attribute" value="<?php echo $fetch['attributes'] ?>">
                                <input type="hidden" name="attributesId" value="<?php echo $fetch['attribute_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-attributes" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-attributes" class="btn btn-primary px-4 submit d-none">Submit</button>
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