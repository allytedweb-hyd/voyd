<?php
include 'includes/header.php';
include './functions/employeeFunctions.php';

if (isset($_POST['submit_form'])) {


    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $filename = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = 'Uploads/adminRoles/' . $filename;
    
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $_POST['oldImage'] = $filename; 
        }
    }

    addEmployee();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./employee.php">View
                                Employees</li>
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
                        <h3 class="mb-4 text-center htext">Add Employees</h3>
                        <form class="row form_new" id="submitForm" method="post" enctype="multipart/form-data" name="myform"
                            id="myform">
                            <div class="col-md-12">
                                <label for="employeeName" class="form-label"> Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="name" id="employeeName" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="Department"> Role<span class="errorindicator">*</span></label>
                                <?php
                                $queryAdmin = mysqli_query($conn, "SELECT * FROM admin_roles WHERE status=1");
                                ?>
                                <select class="form-select" name="department" size="1" id="Department">
                                    <option value="">Select</option>
                                    <?php

                                    while ($fetchAdminRoles = mysqli_fetch_array($queryAdmin)) {
                                    ?>
                                    <option 

                                    value="<?php echo $fetchAdminRoles['role_id'] ?>" <?php echo (isset($_POST['department']) && $_POST['department'] == $fetchAdminRoles['role_id']) ? 'selected' : ''; ?>
                                    
                                    >
                                        <?php echo $fetchAdminRoles['role'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Mobile Number<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="number" id="employeeno" value="<?php echo isset($_POST['number']) ? htmlspecialchars($_POST['number']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input5" class="form-label"> Email<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="email" id="employeemail" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="employeeImage" class="form-label"> Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image" id="employeeImage">

                                <input type="hidden" name="oldImage" value="<?php echo isset($_POST['oldImage']) ? htmlspecialchars($_POST['oldImage']) : ''; ?>">


<?php if (!empty($_POST['oldImage'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/adminRoles/<?php echo htmlspecialchars($_POST['oldImage']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>

                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="imgtext" value="<?php echo isset($_POST['alttext']) ? htmlspecialchars($_POST['alttext']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Password<span class="errorindicator">*</span></label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control" name="password"
                                        id="inputChoosePassword">
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i
                                            class='bx bx-hide'></i></a>

                                            <p id="errText" class="error-text" style="width: 100%;" ></p>

                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Confirm Password<span class="errorindicator">*</span></label>
                                <div class="input-group" id="show_hide_password_con">
                                    <input type="password" class="form-control" name="conPassword"
                                        id="employeeconpassword">
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i
                                            class='bx bx-hide'></i></a>

                                            <p id="errText" class="error-text" style="width: 100%;" ></p>
                                </div>
                               
                            </div>


                            <div class="col-md-12">
                                <label for="input5" class="form-label"> Address<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="address" id="employeeAddress">
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

  
    capitalizeFirstLetter("employeeName");
    capitalizeFirstLetter("imgtext");

 
});
</script>
