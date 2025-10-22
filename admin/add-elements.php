<?php
include 'includes/header.php';
include './functions/elementFunctios.php';

if (isset($_POST['submit_form'])) {

    $uploadDir = 'Uploads/elements/';

    foreach (['image', 'image1', 'image2', 'image3', 'image4'] as $imgField) {
        if (isset($_FILES[$imgField]) && $_FILES[$imgField]['error'] === 0) {
            $filename = time() . '_' . basename($_FILES[$imgField]['name']);
            $targetPath = $uploadDir . $filename;
    
            if (move_uploaded_file($_FILES[$imgField]['tmp_name'], $targetPath)) {
                
                $postKey = 'old' . ucfirst($imgField); 
                $_POST[$postKey] = $filename;
            }
        }
    }

    addElements();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./interior-elements.php">View
                                Interior Elements</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Add Interior Elements</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data" name="myform" id="myform">

                            <div class="col-md-6">
                                <label class="form-label"> Property Block<span class="errorindicator">*</span></label>
                                <select class="form-select" name="category" size="1" id="category" onChange="categoryvalue()">
                                    <option value="">Select</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM property_sections WHERE status=1");
                                    while ($fetch = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetch['section_id'] ?>" <?php echo (isset($_POST['category']) && $_POST['category'] == $fetch['section_id']) ? 'selected' : ''; ?>>
                                            <?php echo $fetch['enter_section'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Interior Element<span class="errorindicator">*</span></label>
                                <select class="form-select" name="Name" size="1" id="Name">
                                    <option value="">Select</option>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Model<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="model" id="model" value="<?php echo isset($_POST['model']) ? htmlspecialchars($_POST['model']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Design Type<span class="errorindicator">*</span></label>
                                <select class="form-select" name="design" id="productDesign">
                                    <option value="">Select</option>
                                    <option value="Classic" <?php echo (isset($_POST['design']) && $_POST['design'] == 'Classic') ? 'selected' : ''; ?>>Classic</option>
<option value="Modern" <?php echo (isset($_POST['design']) && $_POST['design'] == 'Modern') ? 'selected' : ''; ?>>Modern</option>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-1<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image" id="image">

                                <input type="hidden" name="oldImage" value="<?php echo isset($_POST['oldImage']) ? htmlspecialchars($_POST['oldImage']) : ''; ?>">

<?php if (!empty($_POST['oldImage'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/elements/<?php echo htmlspecialchars($_POST['oldImage']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>

                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-1<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo isset($_POST['alttext']) ? htmlspecialchars($_POST['alttext']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-2<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image1" id="image1">

                                <input type="hidden" name="oldImage1" value="<?php echo isset($_POST['oldImage1']) ? htmlspecialchars($_POST['oldImage1']) : ''; ?>">

<?php if (!empty($_POST['oldImage1'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/elements/<?php echo htmlspecialchars($_POST['oldImage1']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-2<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt1" id="alt1" value="<?php echo isset($_POST['alt1']) ? htmlspecialchars($_POST['alt1']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-3<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image2" id="image2">

                                <input type="hidden" name="oldImage2" value="<?php echo isset($_POST['oldImage2']) ? htmlspecialchars($_POST['oldImage2']) : ''; ?>">

<?php if (!empty($_POST['oldImage2'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/elements/<?php echo htmlspecialchars($_POST['oldImage2']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-3<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt2" id="alt2" value="<?php echo isset($_POST['alt2']) ? htmlspecialchars($_POST['alt2']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-4<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image3" id="image3">

                                <input type="hidden" name="oldImage3" value="<?php echo isset($_POST['oldImage3']) ? htmlspecialchars($_POST['oldImage3']) : ''; ?>">

<?php if (!empty($_POST['oldImage3'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/elements/<?php echo htmlspecialchars($_POST['oldImage3']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-4<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt3" id="alt3" value="<?php echo isset($_POST['alt3']) ? htmlspecialchars($_POST['alt3']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-5<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image4" id="image4">

                                <input type="hidden" name="oldImage4" value="<?php echo isset($_POST['oldImage4']) ? htmlspecialchars($_POST['oldImage4']) : ''; ?>">

<?php if (!empty($_POST['oldImage4'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/elements/<?php echo htmlspecialchars($_POST['oldImage4']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-5<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt4" id="alt4" value="<?php echo isset($_POST['alt4']) ? htmlspecialchars($_POST['alt4']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"> Select Material<span class="errorindicator">*</span></label>
                                <select class="form-select" name="material" size="1" id="material">
                                    <option value="">Select Material</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM material WHERE status=1");
                                    while ($fetch = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetch['material_id'] ?>" <?php echo (isset($_POST['material']) && $_POST['material'] == $fetch['material_id']) ? 'selected' : ''; ?>>
                                            <?php echo $fetch['material_name'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                                 <div class="col-md-12">
                                <label for="input1" class="form-label"> Maker Classification<span class="errorindicator">*</span></label>


                                 <select class="form-select" name="product_classification" id="product_classification" >

                                <option value="">
Select
                                </option>

                                  <?php
                                $querytestimonialss = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
                                  while ($fetchTestimonialss = mysqli_fetch_array($querytestimonialss)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonialss['classification'] ?>" <?php echo (isset($_POST['product_classification']) && $_POST['product_classification'] == $fetchTestimonialss['classification']) ? 'selected' : ''; ?>>
                                        <?php echo $fetchTestimonialss['classification'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>


                                
                                <p id="errText" class="error-text"></p>
                            </div>
                                 <div class="col-md-12">
                                <label for="input1" class="form-label"> Material Classification<span class="errorindicator">*</span></label>


                                 <select class="form-select" name="material_classification" id="material_classification" >

                                <option value="">
Select
                                </option>

                                  <?php
                                $querytestimonialss = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
                                  while ($fetchTestimonialss = mysqli_fetch_array($querytestimonialss)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonialss['classification'] ?>" 
                                    <?php echo (isset($_POST['material_classification']) && $_POST['material_classification'] == $fetchTestimonialss['classification']) ? 'selected' : ''; ?>>
                                        <?php echo $fetchTestimonialss['classification'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>


                                
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Length<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="length" id="length" value="<?php echo isset($_POST['length']) ? htmlspecialchars($_POST['length']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Width<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="width" id="width" value="<?php echo isset($_POST['width']) ? htmlspecialchars($_POST['width']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Height<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="heigth" id="height" value="<?php echo isset($_POST['heigth']) ? htmlspecialchars($_POST['heigth']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Units<span class="errorindicator">*</span></label>

                                <select class="form-select" name="unit" id="unit">

                                <option value="">
Select
                                </option>

                                  <?php
                                $querytestimonial = mysqli_query($conn, "SELECT * FROM units WHERE status=1");
                                  while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonials['unit_master'] ?>" <?php echo (isset($_POST['unit']) && $_POST['unit'] == $fetchTestimonials['unit_master']) ? 'selected' : ''; ?>>
                                        <?php echo $fetchTestimonials['unit_master'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                
                                <p id="errText" class="error-text"></p>
                            </div>




                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Cost Per 1Sqft<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="cost" id="cost" value="<?php echo isset($_POST['cost']) ? htmlspecialchars($_POST['cost']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Minimum Price<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="min_price" id="min_price" value="<?php echo isset($_POST['min_price']) ? htmlspecialchars($_POST['min_price']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Maximum Price<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="max_price" id="max_price" value="<?php echo isset($_POST['max_price']) ? htmlspecialchars($_POST['max_price']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Total Sq. Units<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="squnits" id="squnits" value="<?php echo isset($_POST['squnits']) ? htmlspecialchars($_POST['squnits']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-12">
                                <label for="input6" class="form-label"> Description<span class="errorindicator">*</span></label>
                                <!-- <input type="text" class="form-control" name="description" id="elementDes"> -->
                                <textarea name="description" id="elementDes"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-element" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-element" class="btn btn-primary px-4 submit d-none">Submit</button>
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
<script src="./assets/api/elementsapi.js"></script>

<!-- <script>
    CKEDITOR.replace('elementDes', {
        height: 320,
    });
</script> -->

<script>
$('#elementDes').summernote({
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


<script>
    function categoryvalue() {
        var val = $("#category").val();
        console.log('element category val-----', val);
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                element: val
            },
            success: function(result) {
                console.log(result);
                document.getElementById('Name').innerHTML = result;
            }
        })
    }
</script>






<!-- <script>
function fetchCostData() {
    var maker = $('#product_classification').val();
    var material = $('#material_classification').val();

    if (!maker || !material) {
        $('#cost').val('');
        $('#min_price').val('');
        $('#max_price').val('');
        return;
    }

    $.ajax({
        url: 'cost_calculation.php',
        method: 'POST',
        dataType: 'json',
        data: {
            maker_classification: maker,
            material_classification: material
        },
        success: function(response) {
            if (response.success) {
                $('#cost').val(response.cost_per_sqft);
                $('#min_price').val(response.min_price);
                $('#max_price').val(response.max_price);
            } else {
                alert('Error: ' + response.error);
                $('#cost').val('');
                $('#min_price').val('');
                $('#max_price').val('');
            }
        },
        error: function(xhr, status, error) {
            alert('AJAX error: ' + error);
        }
    });
}

$('#product_classification, #material_classification').on('change', fetchCostData);


</script> -->


<!-- <script>
    function fetchCostData() {
    var maker = $('#product_classification').val();
    var material = $('#material_classification').val();

    if (!maker || !material) {
        $('#cost').val('');
        $('#min_price').val('');
        $('#max_price').val('');
        return;
    }

    $.ajax({
        url: 'cost_calculation.php',
        method: 'POST',
        dataType: 'json',
        data: {
            maker_classification: maker,
            material_classification: material
        },
        success: function(response) {
            if (response.success) {
                $('#cost').val(response.cost_per_sqft);
                $('#min_price').val(response.min_price);
                $('#max_price').val(response.max_price);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.error,
                });
                $('#cost').val('');
                $('#min_price').val('');
                $('#max_price').val('');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'AJAX Error',
                text: error,
            });
        }
    });
}

$('#product_classification, #material_classification').on('change', fetchCostData);

</script> -->



<script>
    function fetchCostData() {
        var maker = $('#product_classification').val();
        var material = $('#material_classification').val();

        if (!maker || !material) {
            $('#cost').val('');
            $('#min_price').val('');
            $('#max_price').val('');
            return;
        }

        $.ajax({
            url: 'cost_calculation.php',
            method: 'POST',
            dataType: 'json',
            data: {
                maker_classification: maker,
                material_classification: material
            },
            success: function(response) {
                if (response.success) {
                    $('#cost').val(Math.round(response.cost_per_sqft));
                    $('#min_price').val(Math.round(response.min_price));
                    $('#max_price').val(Math.round(response.max_price));
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.error,
                    });
                    $('#cost').val('');
                    $('#min_price').val('');
                    $('#max_price').val('');
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'AJAX Error',
                    text: error,
                });
            }
        });
    }

    $('#product_classification, #material_classification').on('change', fetchCostData);
</script>
