<?php
include './includes/header.php';
include './includes/db.php';
include './utils/imageValidation.php';
include './utils/alerts.php';

if (isset($_POST['submit_btn'])) {
    $id = intval($_POST['admin_id']);
    $name = mysqli_real_escape_string($conn, $_POST['admin_name']);
    $designation = mysqli_real_escape_string($conn, $_POST['admin_designation']);
    $mobile = mysqli_real_escape_string($conn, $_POST['admin_mobile']);
    $address = mysqli_real_escape_string($conn, $_POST['admin_address']);
    $email = mysqli_real_escape_string($conn, $_POST['admin_email']);
    // $image = mysqli_real_escape_string($conn, $_FILES['profile_pic']);
   
     $image = $_FILES['profile_pic'];
    $path = './Uploads/adminRoles/';

       $allowedExtensions = ['jpg', 'jpeg', 'png'];
$maxFileSize = 5 * 1024 * 1024; // 5MB
$uploadImage = false;

if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
    $fileName = $_FILES['profile_pic']['name'];
    $fileSize = $_FILES['profile_pic']['size'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileType, $allowedExtensions)) {
        showToast('Error', 'Invalid file type. Only JPG, JPEG, PNG allowed.', 'error');
    } elseif ($fileSize > $maxFileSize) {
        showToast('Error', 'File size exceeds 5MB.', 'error');
    } else {
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $newFileName = date('YmdHis') . rand(100, 999) . '.' . $fileType;
        $destPath = rtrim($path, '/') . '/' . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $uploadImage = $newFileName;
        } else {
            showToast('Error', 'Failed to upload image.', 'error');
        }
    }
}



    // if ($uploadImage === false) {
    //     showToast('Error', 'Image Upload Failed', 'error');
    // } else {
  


    // $query = mysqli_query($conn, "UPDATE login_admin SET admin_name='" . $name . "', admin_designation='" . $designation . "',mobile_number='" . $mobile . "', address='" . $address . "', profile_pic='" . $uploadImage . "', username='" . $email . "' WHERE id='" . $id . "' ");

    if ($uploadImage === false) {
   
    $query = mysqli_query($conn, "UPDATE login_admin SET admin_name='" . $name . "', admin_designation='" . $designation . "', mobile_number='" . $mobile . "', address='" . $address . "', username='" . $email . "' WHERE id='" . $id . "' ");
} else {
  
    $query = mysqli_query($conn, "UPDATE login_admin SET admin_name='" . $name . "', admin_designation='" . $designation . "', mobile_number='" . $mobile . "', address='" . $address . "', profile_pic='" . $uploadImage . "', username='" . $email . "' WHERE id='" . $id . "' ");
}



    if ($query) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Details updated successfully',
                    confirmButtonColor: '#3085d6'
                  }).then(function() {
                window.location.href = window.location.pathname;
            });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: 'Something went wrong while updating details.',
                    confirmButtonColor: '#d33'
                });
            });
        </script>";
    }
    

}


?>




<?php
if (isset($_POST['submit_password'])) {
    $id = intval($_SESSION['admin_id']);
    $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    $getUserQuery = mysqli_query($conn, "SELECT password FROM login_admin WHERE id = '$id'");
    $userData = mysqli_fetch_assoc($getUserQuery);
    $current_password = $userData['password'];

    if ($old_password === $current_password) {
        if ($new_password === $confirm_password) {
            $updateQuery = mysqli_query($conn, "UPDATE login_admin SET password = '$new_password', conform_password = '$confirm_password' WHERE id = '$id'");
            if ($updateQuery) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Password updated successfully',
                            confirmButtonColor: '#3085d6'
                          }).then(function() {
                window.location.href = window.location.pathname;
            });
                    });
                </script>";
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error updating password',
                            confirmButtonColor: '#d33'
                        });
                    });
                </script>";
            }
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Mismatch',
                        text: 'New password and confirm password do not match',
                        confirmButtonColor: '#f39c12'
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect',
                    text: 'Old password is incorrect',
                    confirmButtonColor: '#e74c3c'
                });
            });
        </script>";
    }
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
                        <li class="breadcrumb-item"><a href="index.php"><i class="bx bx-home-alt"></i></a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end breadcrumb -->

        <?php

        $result = mysqli_query($conn, "select * from login_admin where id ='" . $_SESSION['admin_id'] . "' && status=2");
        $fetch = mysqli_fetch_array($result);

        ?>
        <div class="container">
            <div class="main-body">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body profilecard" >
                               
                                <div class="d-flex flex-column align-items-center text-center">
                                    <!-- <img src="Uploads/adminRoles/<?php echo $fetch['profile_pic']; ?>" alt="Admin" class="rounded-circle p-1" width="110"> -->
                                   <div class="profile-image-upload-wrapper" style="position: relative; width: 110px; height: 110px; cursor: pointer;">
    <img id="imagePreview" src="Uploads/adminRoles/<?php echo $fetch['profile_pic']; ?>" alt="Admin" class="rounded-circle p-1" width="110" height="110" />
    <input type="file" name="profile_pic" 
           style="position: absolute; top: 0; left: 0; width: 110px; height: 110px; opacity: 0; cursor: pointer;" 
           disabled onchange="previewImage(event)" />
        
    
    <div style="position: absolute; bottom: 5px; right: 5px; background: rgba(0,0,0,0.5); border-radius: 50%; padding: 5px; display: flex; align-items: center;">
        <i class='bx bx-camera' style="color: white; font-size: 20px;"></i>
    </div>
</div>

                                    <div class="mt-3">
                                        <h4><?php echo $fetch['admin_name']; ?>  <span>   <button type="button" name="" class="btn btn-primary editdetails edit-btn"><i class='bx bx-edit' ></i></button></span></h4>


                                        <?php

$rolequery = mysqli_query($conn,"SELECT * FROM admin_roles WHERE role_id='".$fetch['admin_designation']."'");

$fetchrole=mysqli_fetch_array($rolequery);


?>



                                        <p class="text-secondary mb-1"><?php echo $fetchrole['role']; ?></p>
                                        <p class="text-muted font-size-sm mb-1">Hyderabad</p>
                                    </div>
                                </div>
                            

                                


                                <hr class="" />
                                <!-- <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                            </svg>Website</h6>
                                        <span class="text-secondary">https://voyd.com</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info">
                                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                            </svg>Twitter</h6>
                                        <span class="text-secondary">www.twitter.com</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger">
                                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                            </svg>Instagram</h6>
                                        <span class="text-secondary">www.instagram.com</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary">
                                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                            </svg>Facebook</h6>
                                        <span class="text-secondary">www.facebook.com</span>
                                    </li>
                                </ul> -->
                                
                                <div class="text-center">
                              <h4>Address</h4>
                              <p><?php echo $fetch['address']; ?></p>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body profiledetailscard">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="admin_name" class="form-control editable-field" value="<?php echo $fetch['admin_name']; ?>" />
                                        <input type="hidden" name="admin_id" value="<?php echo $fetch['id']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Designation</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <!-- <input type="text" name="admin_designation" class="form-control" value="<?php echo $fetchrole['role']; ?>" /> -->
                                         <select name="admin_designation" class="form-select editable-field" id="" style="font-size: 16px;
    color: #7d7676;" >

                                         <?php
    $role_id = $fetch['admin_designation']; 
    $queryAdmin = mysqli_query($conn, "SELECT * FROM admin_roles WHERE status=1");

    while ($role = mysqli_fetch_array($queryAdmin)) {
        $selected = ($role['role_id'] == $role_id) ? 'selected' : '';
        echo '<option value="' . $role['role_id'] . '" ' . $selected . '>' . $role['role'] . '</option>';
    }
    ?>


                                         </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="admin_email" class="form-control editable-field" value="<?php echo $fetch['username']; ?>" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" name="admin_mobile" class="form-control editable-field" value="<?php echo $fetch['mobile_number']; ?>" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <!-- <input type="text" name="admin_address" class="form-control editable-field" value="<?php echo $fetch['address']; ?>" /> -->
                                        <textarea class="editable-field" name="admin_address" id="testdesc"><?php echo $fetch['address']; ?></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-4 text-secondary">
                                    <button type="submit" name="submit_btn" class="btn btn-primary savebtn">Save</button>
                                    </div>
                                    <div class="col-sm-5 text-secondary text-end">
                                    
                                    </div>
                                </div>

                                <hr>

                                <div class="row text-center mb-2">

                                <h5>Change Password</h5>
                                </div>
                            
                                <div class="row mb-3">
                                    <div class="col-sm-3 d-flex">
                                    <span><h6 class="mb-0">Old Password</h6></span>     <span>  <button type="button" class="btn btn-primary editpasswordbtn" id="enablePasswordBtn"><i class='bx bx-edit' ></i></button></span>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="old_password" class="form-control password-field"  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">New Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="new_password" class="form-control password-field"  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Confirm Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="confirm_password" class="form-control password-field"  />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-4 text-secondary">
                                      

                                        <button type="submit" name="submit_password" class="btn btn-primary savebtn" >Change Password</button>
                                    </div>
                                    <div class="col-sm-5 text-secondary text-end">
                                 
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php
include 'includes/footer.php';
?>


<!-- <script>
document.addEventListener("DOMContentLoaded", function () {
  
    document.querySelectorAll(".editable-field").forEach(function (el) {
        el.setAttribute("disabled", true);
    });

   
    document.querySelector(".edit-btn").addEventListener("click", function () {
        document.querySelectorAll(".editable-field").forEach(function (el) {
            el.removeAttribute("disabled");
        });
    });
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
 
    document.querySelectorAll(".password-field").forEach(function (input) {
        input.setAttribute("disabled", true);
    });

   
    document.getElementById("enablePasswordBtn").addEventListener("click", function () {
        document.querySelectorAll(".password-field").forEach(function (input) {
            input.removeAttribute("disabled");
        });
    });
});
</script> -->



<!-- <script>

document.addEventListener("DOMContentLoaded", function () {
    const editableFields = document.querySelectorAll(".editable-field");
    const passwordFields = document.querySelectorAll(".password-field");
    const editBtn = document.querySelector(".edit-btn");
    const passwordBtn = document.getElementById("enablePasswordBtn");
    const saveBtn = document.querySelector("button[name='submit_btn']");
    const changePasswordBtn = document.querySelector("button[name='submit_password']");

 
    editableFields.forEach(field => field.setAttribute("disabled", true));
    passwordFields.forEach(field => field.setAttribute("disabled", true));

   
    saveBtn.disabled = false;
    changePasswordBtn.disabled = false;

  
    editBtn.addEventListener("click", function () {
        editableFields.forEach(field => field.removeAttribute("disabled"));
        passwordFields.forEach(field => field.setAttribute("disabled", true));

        saveBtn.disabled = false;
        changePasswordBtn.disabled = true; 
    });

   
    passwordBtn.addEventListener("click", function () {
        passwordFields.forEach(field => field.removeAttribute("disabled"));
        editableFields.forEach(field => field.setAttribute("disabled", true));

        changePasswordBtn.disabled = false;
        saveBtn.disabled = true; 
    });
});
</script>


<script>
$('#testdesc').summernote({
    placeholder: 'Enter Text',
    tabsize: 2,
    height: 120,
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
    ],
    callbacks: {
        onPaste: function (e) {
            e.preventDefault();
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            document.execCommand('insertText', false, bufferText);
        }
    }
});
</script> -->




<script>
document.addEventListener("DOMContentLoaded", function () {
    const editableFields = document.querySelectorAll(".editable-field");
    const passwordFields = document.querySelectorAll(".password-field");
    const editBtn = document.querySelector(".edit-btn");
    const passwordBtn = document.getElementById("enablePasswordBtn");
    const saveBtn = document.querySelector("button[name='submit_btn']");
    const changePasswordBtn = document.querySelector("button[name='submit_password']");

   
    editableFields.forEach(field => field.setAttribute("disabled", true));
    passwordFields.forEach(field => field.setAttribute("disabled", true));

    
    saveBtn.disabled = false;
    changePasswordBtn.disabled = false;

 
    $('#testdesc').summernote('disable');

   
    editBtn.addEventListener("click", function () {
        editableFields.forEach(field => field.removeAttribute("disabled"));
        passwordFields.forEach(field => field.setAttribute("disabled", true));

        $('#testdesc').summernote('enable');

        saveBtn.disabled = false;
        changePasswordBtn.disabled = true;
    });

   
    passwordBtn.addEventListener("click", function () {
        passwordFields.forEach(field => field.removeAttribute("disabled"));
        editableFields.forEach(field => field.setAttribute("disabled", true));

        $('#testdesc').summernote('disable');

        changePasswordBtn.disabled = false;
        saveBtn.disabled = true;
    });
});
</script>

<script>
$('#testdesc').summernote({
    placeholder: 'Enter Text',
    tabsize: 2,
    height: 60,
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
    ],
    callbacks: {
        onPaste: function (e) {
            e.preventDefault();
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            document.execCommand('insertText', false, bufferText);
        }
    }
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const saveBtn = document.querySelector("button[name='submit_btn']");
    const changePasswordBtn = document.querySelector("button[name='submit_password']");

    form.addEventListener("submit", function (e) {
       
        const isSave = document.activeElement === saveBtn;
        const isPasswordChange = document.activeElement === changePasswordBtn;

        if (isSave) {
            const name = form.admin_name.value.trim();
            const designation = form.admin_designation.value.trim();
            const email = form.admin_email.value.trim();
            const mobile = form.admin_mobile.value.trim();
            const address = $('#testdesc').summernote('code').replace(/<[^>]*>?/gm, '').trim();

            if (!name || !designation || !email || !mobile || !address) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Validation Error',
                    text: 'Please fill in all profile fields.',
                    confirmButtonColor: '#f39c12'
                });
                return;
            }
        }

        if (isPasswordChange) {
            const oldPassword = form.old_password.value.trim();
            const newPassword = form.new_password.value.trim();
            const confirmPassword = form.confirm_password.value.trim();

            if (!oldPassword || !newPassword || !confirmPassword) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Validation Error',
                    text: 'Please fill in all password fields.',
                    confirmButtonColor: '#f39c12'
                });
                return;
            }

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Mismatch',
                    text: 'New password and confirmation do not match.',
                    confirmButtonColor: '#e74c3c'
                });
                return;
            }
        }
    });
});
</script>



<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function () {
        const nameInput = form.admin_name;
        nameInput.value = nameInput.value
            .toLowerCase()
            .replace(/\b\w/g, function (char) {
                return char.toUpperCase();
            });
    });
});
</script>

<script>
document.querySelector('.edit-btn').addEventListener('click', function() {
    document.querySelector('input[name="profile_pic"]').removeAttribute('disabled');
});
</script>


<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('imagePreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;  
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

