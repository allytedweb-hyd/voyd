<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/producttypeMaterFunctions.php';

if(isset($_POST['submit_form'])) {
     editProducttypemaster();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./producttypemaster.php">View Product Type </li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Product Type </h3>

                        <?php
                        $query = mysqli_query($conn, "select * from product_type_master where 
                        product_type_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data">

                        
                            <div class="col-md-12">
                                <label for="input1" class="form-label">Product<span class="errorindicator">*</span></label>

                                <select class="form-select" name="product" id="product">

                                <!-- <option value="<?php echo $fetch['product'] ?>">
<?php echo $fetch['product'] ?>
                                </option>

                                  <?php
                                $querytestimonial = mysqli_query($conn, "SELECT * FROM product_master WHERE status=1");
                                  while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonials['product_master'] ?>">
                                        <?php echo $fetchTestimonials['product_master'] ?></option>
                                    <?php
                                    }
                                    ?> -->

<?php
        
        $selectedProduct = $fetch['product'];
        echo '<option value="' . htmlspecialchars($selectedProduct) . '">' . htmlspecialchars($selectedProduct) . '</option>';

      
        $queryProducts = mysqli_query($conn, "SELECT * FROM product_master WHERE status = 1");
        while ($product = mysqli_fetch_array($queryProducts)) {
            
            if ($product['product_master'] != $selectedProduct) {
                echo '<option value="' . htmlspecialchars($product['product_master']) . '">' . htmlspecialchars($product['product_master']) . '</option>';
            }
        }
        ?>

                                </select>
                                
                                <p id="errText" class="error-text"></p>
                            </div>



                            <div class="col-md-12">
                                <label for="input1" class="form-label">  Product Type<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="producttype" id="producttype" value="<?php echo $fetch['product_type'] ?>">
                                <input type="hidden" name="materialId" value="<?php echo $fetch['product_type_id'] ?>" />
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

<?php include 'includes/footer.php'; ?>
<script src="./assets/api/producttypemasterapi.js"></script>