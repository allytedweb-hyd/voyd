<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/propertyTypeFunctions.php';

if (isset($_POST['submit_form'])) {
    editPropertyType();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./propertyType.php">View
                                Property Type</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Property Type</h3>

                        <?php
                        $query = mysqli_query($conn, "select * from property_type where 
                        propertyType_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data">
                        <!-- <div class="col-md-12">
                                <label class="form-label">Select Property</label>
                                <select class="form-control" id="property" name="property">
                                <option><php echo $fetch['property_name'] ?></option>
                                <php
                                    $query=mysqli_query($conn,"SELECT * FROM property WHERE status=1");
                                    while($fetchType=mysqli_fetch_array($query)){
                                    ?>
                                    <option value="<php echo $fetchType['enter_property'] ?>"><php echo $fetchType['enter_property'] ?></option>
                                    
                                    </div> -->

                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Enter Property Type<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="propertyType" id="propertype"
                                value="<?php echo $fetch['property_Type'] ?>">
                                <input type="hidden" name="propertyTypeId"
                                    value="<?php echo $fetch['propertyType_id'] ?>" />
                                    <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-propertyType"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-propertyType"
                                        class="btn btn-primary px-4 submit d-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- <!end row -->
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./assets/api/propertyTypeapi.js"></script>