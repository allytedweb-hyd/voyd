<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/quoteAddonFunctions.php';

if (isset($_POST['submit_form'])) {
    editAddon();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./quotationAddon.php">View Excess Quotation</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Excess Quotation</h3>
                        <?php
                        $query = mysqli_query($conn, "select * from quotation_addon where 
                        addon_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                                <label for="input1" class="form-label"> Questionnaire Id<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="questionnaire" id="queId" value="<?php echo $fetch['que_id']; ?>">
                                <input type="hidden" name="addonId" value="<?php echo $fetch['addon_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Customer Id<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="customer" id="custId" value="<?php echo $fetch['customer_id']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input5" class="form-label"> Project Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="project" id="projName" value="<?php echo $fetch['project_name']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Customer Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="name" id="custName" value="<?php echo $fetch['customer_name']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input6" class="form-label"> Project Class<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="class" id="projClass" value="<?php echo $fetch['project_class']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Vendor Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="Vendorname" id="venName" value="<?php echo $fetch['vendor_name']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Item Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="itemname" id="ItemName" value="<?php echo $fetch['item_name']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Item Code<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="code" id="ItemCode" value="<?php echo $fetch['item_code']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Quantity<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="quantity" id="quant" value="<?php echo $fetch['quantity']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                                 <div class="col-md-6">
                                <label for="input5" class="form-label"> Cost<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="itemCost" id="cost" value="<?php echo $fetch['item_cost']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-Addon"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-Addon"
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

<script src="./assets/api/quoteAddonapi.js"></script>
