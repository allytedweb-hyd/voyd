<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/vendorFunctions.php';

if (isset($_POST['submit_form'])) {
    editVendor();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./vendor.php">View Vendors</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Vendors</h3>
                        <?php
                        $query = mysqli_query($conn, "select * from vendor where 
                        vendor_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> First Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo $fetch['vendor_firstname'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Last Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo $fetch['vendor_lastname'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Email<span class="errorindicator">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $fetch['vendor_email'] ?>">
                                <input type="hidden" name="vendorId" value="<?php echo $fetch['vendor_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Mobile Number<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="Phone" name="Phone" value="<?php echo $fetch['vendor_mobile'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Gst Number<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="gstno" name="gstno" value="<?php echo $fetch['vendor_gst'] ?>">
                                <!-- <p id="errText" class="error-text"></p> -->
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Company type<span class="errorindicator">*</span></label>
                                <select class="form-select" name="company" size="1" id="company">
                                    <!-- <option><?php echo $fetch['vendor_company']; ?></option>
                                    <option value="Registered Company">Registered Company</option>
                                    <option value="Individual(Self)">Individual(Self)</option> -->

                                    <?php
            
            echo '<option>' . $fetch['vendor_company'] . '</option>';
            ?>
            <option value="Registered Company" <?php echo $fetch['vendor_company'] == 'Registered Company' ? 'disabled' : ''; ?>>Registered Company</option>
            <option value="Individual(Self)" <?php echo $fetch['vendor_company'] == 'Individual(Self)' ? 'disabled' : ''; ?>>Individual(Self)</option>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Class<span class="errorindicator">*</span></label>
                                <select class="form-select" name="class" size="1" id="class">
                                    <!-- <option><?php echo $fetch['vendor_class']; ?></option>
                                    <option value="Platinum">Platinum</option>
                                    <option value="Gold">Gold</option>
                                    <option value="Silver">Silver</option>
                                    <option value="Bronze">Bronze</option> -->

                                    <!-- <?php
          
            echo '<option>' . $fetch['vendor_class'] . '</option>';
            ?>
            <option value="Platinum" <?php echo $fetch['vendor_class'] == 'Platinum' ? 'disabled' : ''; ?>>Platinum</option>
            <option value="Gold" <?php echo $fetch['vendor_class'] == 'Gold' ? 'disabled' : ''; ?>>Gold</option>
            <option value="Silver" <?php echo $fetch['vendor_class'] == 'Silver' ? 'disabled' : ''; ?>>Silver</option>
            <option value="Bronze" <?php echo $fetch['vendor_class'] == 'Bronze' ? 'disabled' : ''; ?>>Bronze</option> -->


            <?php
$query = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
while ($row = mysqli_fetch_array($query)) {
    $selected = ($row['classification'] == $fetch['vendor_class']) ? 'selected' : '';
    echo '<option value="' . $row['classification'] . '" ' . $selected . '>' . $row['classification'] . '</option>';
}
?>



                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label">  Aadhar Number<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="aadhar" name="aadhar" value="<?php echo $fetch['vendor_aadhar'] ?>">
                                <!-- <p id="errText" class="error-text"></p> -->
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Pan Card Number<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="pancard" name="pancard" value="<?php echo $fetch['vendor_pancard'] ?>">
                                <!-- <p id="errText" class="error-text"></p> -->
                            </div>

                            <div class="col-md-6">
                                <label for="input9" class="form-label"> Company Name<span class="errorindicator">*</span></label>
                                <!-- <select class="countries form-select" name="country" id="countryId"> 
                                    <option><?php echo $fetch['vendor_country']; ?></option>
                                </select> -->

                                  <input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $fetch['company_name'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input9" class="form-label"> State<span class="errorindicator">*</span></label>
                                <!-- <select class="states form-select" name="state" id="stateId"> 
                                    <option><?php echo $fetch['vendor_state']; ?></option>
                                </select> -->
                                  <input type="text" class="form-control" id="stateId" name="state" value="<?php echo $fetch['vendor_state'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input9" class="form-label"> City<span class="errorindicator">*</span></label>
                                <!-- <select class="cities form-select" name="city" id="cityId"> 
                                    <option><?php echo $fetch['vendor_city']; ?></option>
                                </select> -->
                                  <input type="text" class="form-control" id="cityId" name="city" value="<?php echo $fetch['vendor_city'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            
                            <div class="col-md-6">
                                <label for="input8" class="form-label"> Locality<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="locality" name="locality" value="<?php echo $fetch['vendor_locality'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input11" class="form-label"> Address<span class="errorindicator">*</span></label>
                                <textarea id="vendordesc" name="address"><?php echo $fetch['vendor_address']; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-vendor" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-vendor" class="btn btn-primary px-4 submit d-none">Submit</button>                                </div>
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
<script src="./assets/api/vendorapi.js"></script>

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

<script src="./assets/js/countrystatecity.js"></script>