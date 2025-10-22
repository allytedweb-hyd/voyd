<?php
include 'includes/header.php';
include './functions/adminRolesFunction.php';

if (isset($_POST['submit_role'])) {
    editRole();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./adminRoles.php">View
                                roles</li>
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
                        <h3 class="mb-4 text-center htext">Update Role</h3>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM admin_roles WHERE 
                        role_id='" . $_GET['id'] . "' && status=1");
                        $fetch = mysqli_fetch_array($query);
                        ?>
                        <form class="row form_new" id="submitForm" method="post" enctype="multipart/form-data" name="myform" id="myform">
                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Role<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="role" value="<?php echo $fetch['role'] ?>" id="empRole">
                                <input type="hidden" name="roleId" value="<?php echo $fetch['role_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-role" class="btn btn-primary px-4 submit">update</button>
                                    <button name="submit_role" type="submit" id="submit-role" class="btn btn-primary px-4 submit d-none">Update</button>
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

<script src="./assets/api/rolesapi.js"></script>