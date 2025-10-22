<?php
include 'includes/header.php';
include './functions/vendorFunctions.php';
if (isset($_POST['submit_form'])) {
    addVendor();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./vendor.php">View Vendors</li>
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
                        <h3 class="mb-4 text-center htext">Add Vendors</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data" name="myform" id="myform">

                            <div class="col-md-6">
                                <label for="input1" class="form-label"> First Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo isset($_POST['FirstName']) ? htmlspecialchars($_POST['FirstName']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Last Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo isset($_POST['LastName']) ? htmlspecialchars($_POST['LastName']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <!-- <div class="col-md-6">
                                <label for="input2" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label">Image Alt Text</label>
                                <input type="text" class="form-control" id="alttext" name="alttext">
                                <p id="errText" class="error-text"></p>
                            </div> -->

                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Email<span class="errorindicator">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Mobile Number<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="Phone" name="Phone" value="<?php echo isset($_POST['Phone']) ? htmlspecialchars($_POST['Phone']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Gst Number<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="gstno" name="gstno"  onkeyup="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');"  value="<?php echo isset($_POST['gstno']) ? htmlspecialchars($_POST['gstno']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Company type<span class="errorindicator">*</span></label>
                                <select class="form-select" name="company" size="1" id="company">
                                    <option value="">Select Company</option>
                                    <option value="Registered Company">Registered Company</option>
                                    <option value="Individual(Self)">Individual(Self)</option>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Class<span class="errorindicator">*</span></label>
                                <select class="form-select" name="class" size="1" id="class">
                                    <option value="">Select Class</option>

                                    <?php
                                $querytestimonialss = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
                                  while ($fetchTestimonialss = mysqli_fetch_array($querytestimonialss)) {
                                    ?>
                                    <option 
                                    value="<?php echo $fetch['classification'] ?>" <?php echo (isset($_POST['class']) && $_POST['class'] == $fetch['classification']) ? 'selected' : ''; ?>
                                    >
                                        <?php echo $fetchTestimonialss['classification'] ?></option>
                                    <?php
                                    }
                                    ?>
                                  

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>


                            <!-- <div class="col-md-6">
                                <label for="input6" class="form-label">DOB</label>
                                <input type="date" class="form-control" id="DateofBirth" name="DateofBirth">
                                <p id="errText" class="error-text"></p>
                            </div> -->

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Aadhar Number<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="aadhar" name="aadhar"    maxlength="12"
       onkeyup="restrictAadharInput(this)" onblur="checkAadharLength(this)"  value="<?php echo isset($_POST['aadhar']) ? htmlspecialchars($_POST['aadhar']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Pan Card Number<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="pancard" name="pancard"  onkeyup="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');"  value="<?php echo isset($_POST['pancard']) ? htmlspecialchars($_POST['pancard']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input8" class="form-label"> Company Name<span class="errorindicator">*</span></label>

                                <input type="text" name="companyname" class="form-control"  id="companyname" value="<?php echo isset($_POST['companyname']) ? htmlspecialchars($_POST['companyname']) : ''; ?>">
                            
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input8" class="form-label"> State<span class="errorindicator">*</span></label>
                             
                                <input type="text" name="state" class="form-control"  id="stateId" value="Telangana">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input8" class="form-label"> City<span class="errorindicator">*</span></label>
                             
                                <input type="text" name="city" class="form-control"  id="cityId" value="Hyderabad">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input8" class="form-label"> Locality<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="locality" name="locality" value="<?php echo isset($_POST['locality']) ? htmlspecialchars($_POST['locality']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <!-- <div class="col-md-6">
                                <label for="input8" class="form-label">Area</label>
                                <input type="text" class="form-control" id="area" name="area">
                                <p id="errText" class="error-text"></p>
                            </div> -->
                            <!-- <div class="col-md-6">
                                <label for="input10" class="form-label">Zip Code</label>
                                <input type="number" class="form-control" id="Zip" name="Zip">
                                <p id="errText" class="error-text"></p>
                            </div> -->

                            <div class="col-md-12">
                                <label for="input11" class="form-label"> Address<span class="errorindicator">*</span></label>
                                <textarea id="vendordesc" name="address"><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3 mt-3">
                                    <button type="button" id="add-vendor" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-vendor" class="btn btn-primary px-4 submit d-none">Submit</button>
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

<!-- <script>
    CKEDITOR.replace('vendordesc', {
        height: 320,
    });
</script> -->

<script>
$('#vendordesc').summernote({
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
</script>


<script src="./assets/api/vendorapi.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

<!-- <script src="./assets/js/countrystatecity.js"></script> -->


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

  
    capitalizeFirstLetter("FirstName");
    capitalizeFirstLetter("LastName");
    capitalizeFirstLetter("companyname");
    capitalizeFirstLetter("stateId");
    capitalizeFirstLetter("cityId");
    capitalizeFirstLetter("locality");

 
});
</script>



<script>
function restrictAadharInput(input) {
   
    input.value = input.value.replace(/[^0-9]/g, '').slice(0, 12);
}

function checkAadharLength(input) {
   
    if (input.value.length < 12 && input.value.length > 0) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Aadhar',
            text: 'Aadhar number must be exactly 12 digits.',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false
        });
    }
}
</script>


