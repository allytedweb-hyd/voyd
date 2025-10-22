<?php
include 'includes/header.php';
include './functions/subStatusMasterFunction.php';

if (isset($_POST['submit_substatus'])) {

    addSubStatus();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./subStatusMaster.php">View
                                Sub-Status Masters</li>
                        </a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Add Sub-Status Master</h3>
                        <form class="row form_new" id="submitForm" method="post" enctype="multipart/form-data" name="myform" id="myform">


                            <div class="col-md-12">
                                <label for="projectStatus" class="form-label"> Status<span class="errorindicator">*</span></label>
                                <select class="form-select" id="statusMaster" name=status_master>
                                    <option value="">Select</option>
                                    <?php
                                    $getStatus = mysqli_query($conn, "SELECT * FROM tbl_status_master WHERE status = 1");
                                    while ($getStatusOptions = mysqli_fetch_array($getStatus)) {
                                    ?>
                                        <option value="<?php echo $getStatusOptions['status_id'] ?>">
                                            <?php echo $getStatusOptions['status_master'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="projectStatus" class="form-label"> Sub-Status<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="sub_status" id="projectStatus">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="addSubStatus" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_substatus" type="submit" id="submitSubStatus" class="btn btn-primary px-4 submit d-none">Submit</button>
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

<?php include 'includes/footer.php' ?>

<script src="./assets/api/substatusapi.js"></script>



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

  
    capitalizeFirstLetter("projectStatus");
    

 
});
</script>