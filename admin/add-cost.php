<?php
include 'includes/header.php';
include './functions/costFunctions.php';

if (isset($_POST['submit_form'])) {
    addCost();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./total_cost.php">View
                                Cost</li>
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
                        <h3 class="mb-4 text-center htext">Add Cost</h3>
                        <form class="row form_new" id="submitForm" method="post" enctype="multipart/form-data" name="myform"
                            >
                         
                            <div class="col-md-12">
                                <label class="form-label" for="Department"> Classifications<span class="errorindicator">*</span></label>
                                <?php
                                $queryAdmin = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
                                ?>
                                <select class="form-select" name="classification" size="1" id="classification">
                                    <option value="">Select</option>
                                    <?php

                                    while ($fetchAdminRoles = mysqli_fetch_array($queryAdmin)) {
                                    ?>
                                    <option 

                                    value="<?php echo $fetchAdminRoles['classification'] ?>" <?php echo (isset($_POST['classification']) && $_POST['classification'] == $fetchAdminRoles['classification']) ? 'selected' : ''; ?>
                                    
                                    >
                                        <?php echo $fetchAdminRoles['classification'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label">  Maker Min Value<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="maker_min" id="maker_min" value="<?php echo isset($_POST['maker_min']) ? htmlspecialchars($_POST['maker_min']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Maker Max Value<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="maker_max" id="maker_max" value="<?php echo isset($_POST['maker_max']) ? htmlspecialchars($_POST['maker_max']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="employeeImage" class="form-label"> Material Min Value<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="material_min" id="material_min" value="<?php echo isset($_POST['material_min']) ? htmlspecialchars($_POST['material_min']) : ''; ?>">

                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Material Max Value<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="material_max" id="material_max" value="<?php echo isset($_POST['material_max']) ? htmlspecialchars($_POST['material_max']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                         
                          


                      


                            <!-- <div class="col-md-6">
                                <label class="form-label">Select Role</label>
                                <select class="form-select" name="role" size="1" id="employeerole">
                                    <option value="">Select</option>
                                    <option value="Junior-Executive">Junior Executive</option>
                                    <option value="Senior-Executive">Senior Executive</option>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div> -->
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-employee"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-employee"
                                        class="btn btn-primary px-4 submit d-none">Submit</button>
                                </div>
                            </div>

                    </div>
                </div>

            </div>
        </div>
        <!--end row-->
    </div>
</div>




<?php include 'includes/footer.php'; ?>

<script src="./assets/api/costapi.js"></script>









