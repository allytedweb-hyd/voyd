<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/employeeFunctions.php';

if (isset($_POST['submit_form'])) {
    editEmployee();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./employee.php">View Employees
                        </li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Employees</h3>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM login_admin WHERE 
                        id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>
                        <form class="row form_new" method="post" enctype="multipart/form-data" name="myform" id="myform">
                           <div class="col-md-12">
                                <label for="employeeName" class="form-label"> Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="name" id="employeeName" value="<?php echo $fetch['admin_name']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="Department"> Role<span class="errorindicator">*</span></label>
                                <?php
                                $queryAdmin = mysqli_query($conn, "SELECT * FROM admin_roles WHERE status=1");
                                ?>
                                <select class="form-select" name="department" size="1" id="Department">

                                  <!-- <?php
                                    $gcategoryid = mysqli_query($conn, "select * from admin_roles where role_id='" . $fetch['role_id'] . "'");
                                    $gcategoryname = mysqli_fetch_array($gcategoryid);
                                    ?>
                                    <option value="<?php echo $gcategoryname['role_id']; ?>"  ><?php echo $gcategoryname['role'] ?></option>

                                    
                                    <?php

                                    while ($fetchAdminRoles = mysqli_fetch_array($queryAdmin)) {
                                    ?>
                                    <option value="<?php echo $fetchAdminRoles['role_id'] ?>">
                                        <?php echo $fetchAdminRoles['role'] ?></option>
                                    <?php
                                    }
                                    ?> -->

<?php
    $role_id = $fetch['role_id']; 
    $queryAdmin = mysqli_query($conn, "SELECT * FROM admin_roles WHERE status=1");

    while ($role = mysqli_fetch_array($queryAdmin)) {
        $selected = ($role['role_id'] == $role_id) ? 'selected' : '';
        echo '<option value="' . $role['role_id'] . '" ' . $selected . '>' . $role['role'] . '</option>';
    }
    ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Mobile Number<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="number" id="employeeno" value="<?php echo $fetch['mobile_number']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input5" class="form-label"> Email<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="email" id="employeemail" value="<?php echo $fetch['username']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="employeeImage" class="form-label"> Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image" id="employeeImage">
<img src="./Uploads/adminRoles/<?php echo $fetch['profile_pic'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['profile_pic'] ?>" />
                                <input type="hidden" name="employeeId" value="<?php echo $fetch['id'] ?>" />


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="imgtext" value="<?php echo $fetch['img_alt']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Password<span class="errorindicator">*</span></label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control" name="password"
                                        id="inputChoosePassword" value="<?php echo $fetch['password']; ?>">
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i
                                            class='bx bx-hide'></i></a>

                                </div>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Confirm Password<span class="errorindicator">*</span></label>
                                <div class="input-group" id="show_hide_password_con">
                                    <input type="password" class="form-control" name="conPassword"
                                        id="employeeconpassword" value="<?php echo $fetch['conform_password']; ?>">
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i
                                            class='bx bx-hide'></i></a>
                                </div>
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-12">
                                <label for="input5" class="form-label"> Address<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="address" id="employeeAddress" value="<?php echo $fetch['address']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>



                          
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-employee"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-employee"
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

<script src="./assets/api/employeeapi.js"></script>


<script>
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bx-hide");
            $('#show_hide_password i').removeClass("bx-show");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bx-hide");
            $('#show_hide_password i').addClass("bx-show");
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $("#show_hide_password_con a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password_con input').attr("type") == "text") {
            $('#show_hide_password_con input').attr('type', 'password');
            $('#show_hide_password_con i').addClass("bx-hide");
            $('#show_hide_password_con i').removeClass("bx-show");
        } else if ($('#show_hide_password_con input').attr("type") == "password") {
            $('#show_hide_password_con input').attr('type', 'text');
            $('#show_hide_password_con i').removeClass("bx-hide");
            $('#show_hide_password_con i').addClass("bx-show");
        }
    });
});
</script>