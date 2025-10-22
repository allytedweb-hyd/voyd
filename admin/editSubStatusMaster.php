<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/subStatusMasterFunction.php';

if (isset($_POST['subStatus'])) {
    editSubStatusMaster();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./subStatusMaster.php">View
                                Sub-Status Masters</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Sub-Status Master</h3>

                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM tbl_subStatus_master WHERE 
                        sub_status_id='" . $_GET['id'] . "' && status=1");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="projectStatus" class="form-label"> Status<span class="errorindicator">*</span></label>
                                <select class="form-select" id="statusMaster" name=status_master>
                                    <?php
    // Get current selected status
    $getname = mysqli_query($conn, "SELECT * FROM tbl_status_master WHERE status_id='" . $fetch['status_master'] . "'");
    $statusname = mysqli_fetch_array($getname);
    ?>
    <option value="<?php echo $statusname['status_id']; ?>" selected>
        <?php echo $statusname['status_master']; ?>
    </option>

    <option value="">Select</option>

    <?php
    // List all other statuses excluding the current one
    $getStatus = mysqli_query($conn, "SELECT * FROM tbl_status_master WHERE status = 1 AND status_id != '" . $fetch['status_master'] . "'");
    while ($getStatusOptions = mysqli_fetch_array($getStatus)) {
    ?>
        <option value="<?php echo $getStatusOptions['status_id']; ?>">
            <?php echo $getStatusOptions['status_master']; ?>
        </option>
    <?php
    }
    ?>



                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Sub-Status<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="sub_status" id="projectStatus" value="<?php echo $fetch['sub_status_master'] ?>">
                                <input type="hidden" name="statusMasterId" value="<?php echo $fetch['sub_status_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="addSubStatus" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="subStatus" type="submit" id="submitSubStatus" class="btn btn-primary px-4 submit d-none">Submit</button>
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
<script src="./assets/api/substatusapi.js"></script>