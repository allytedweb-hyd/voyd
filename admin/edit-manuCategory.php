<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/manufact-categoryFunctions.php';

if (isset($_POST['submit_form'])) {
    editCategory();
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
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="./manufacturer-category.php">View Category</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Category</h3>

                        <?php
                        $query = mysqli_query($conn, "select * from manufacturer_category where 
                        mcategory_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data" id="myform" name="myform">

                            <div class="col-md-12">
                                <label class="form-label"> Select Product Type<span class="errorindicator">*</span></label>
                                <select class="form-select" id="productType" name="productType" size="1">
                                    <!-- <?php
                                    $productid = mysqli_query($conn, "select * from product_type where productType_id='" . $fetch['select_product'] . "'");
                                    $productname = mysqli_fetch_array($productid);
                                    ?>
                                    <option><?php echo $productname['enter_productType'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM product_type WHERE status=1");
                                    while ($fetchCat = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchCat['productType_id'] ?>"><?php echo $fetchCat['enter_productType'] ?></option>
                                    <?php
                                    }
                                    ?> -->


<?php
    
    $productid = mysqli_query($conn, "SELECT * FROM product_type WHERE productType_id='" . $fetch['select_product'] . "'");
    $productname = mysqli_fetch_array($productid);
    ?>
    <option value="<?php echo $productname['productType_id']; ?>">
        <?php echo $productname['enter_productType']; ?>
    </option>

    <?php

    $query = mysqli_query($conn, "SELECT * FROM product_type WHERE status = 1 AND productType_id != '" . $fetch['select_product'] . "'");
    while ($fetchCat = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $fetchCat['productType_id']; ?>">
            <?php echo $fetchCat['enter_productType']; ?>
        </option>
    <?php } ?>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Enter Category<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="category" id="category" value="<?php echo $fetch['category_name'] ?>">
                                <input type="hidden" name="categoryId" value="<?php echo $fetch['mcategory_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-category"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-category"
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
<script src="./assets/api/categoryapi.js"></script>