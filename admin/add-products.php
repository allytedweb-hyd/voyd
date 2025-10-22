<?php
include 'includes/header.php';
include './functions/productFunctions.php';

if (isset($_POST['submit_form'])) {

    
    $uploadDir = 'Uploads/products/';

    foreach (['image', 'image2', 'image3', 'image4', 'image5'] as $imgField) {
        if (isset($_FILES[$imgField]) && $_FILES[$imgField]['error'] === 0) {
            $uploadResult = validateImage($uploadDir, $_FILES[$imgField]);
            if ($uploadResult) {
                $postKey = 'old' . ucfirst($imgField);
                $_POST[$postKey] = $uploadResult;
            } else {
                echo "Failed to upload $imgField<br>";
            }
        }
    }


    addProducts();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./products.php">View Products
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
                        <h3 class="mb-4 text-center htext">Add Products</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data" name="myform" id="myform">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Title<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Room<span class="errorindicator">*</span></label>

                                <select class="form-select" name="room" size="1" id="room" >
                                    <option value="">Select</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM property_sections WHERE status=1");
                                    while ($fetch = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetch['section_id'] ?>" <?php echo (isset($_POST['room']) && $_POST['room'] == $fetch['section_id']) ? 'selected' : ''; ?>>
                                            <?php echo $fetch['enter_section'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Category<span class="errorindicator">*</span></label>
                                <select class="form-select" name="category" size="1" id="category"
                                    onChange="pcategoryvalue()">
                                    <option value="">Select Category</option>

                                    
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM category WHERE status=1");
                                    while ($fetch = mysqli_fetch_array($query)) {
                                    ?>
                                    <option  value="<?php echo $fetch['category_id'] ?>" <?php echo (isset($_POST['category']) && $_POST['category'] == $fetch['category_id']) ? 'selected' : ''; ?> >
                                        <?php echo $fetch['category_name'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Sub-Category<span class="errorindicator">*</span></label>
                                <select class="form-select" name="subcategory" size="1" id="subcategory">
                                    <option value="">Select Sub-Category</option>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Product Brand<span class="errorindicator">*</span></label>
                                <select class="form-select" name="brand" id="productbrand">
                                    <option value="">Select Brand</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM brand_master WHERE status=1");
                                    while ($fetch = mysqli_fetch_array($query)) {
                                    ?>
                                    <option  value="<?php echo $fetch['brand_id'] ?>" <?php echo (isset($_POST['brand']) && $_POST['brand'] == $fetch['brand_id']) ? 'selected' : ''; ?>  >
                                        <?php echo $fetch['enter_brand'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                         <div class="col-md-6">
    <label class="form-label">Sizes</label>
    <select class="form-select" name="size" id="size" size="1">
        <option value="">Select</option>
        <?php
        $querysizes = mysqli_query($conn, "SELECT * FROM sizes WHERE status = 1");
        while ($fetchsizes = mysqli_fetch_array($querysizes)) {
            $size = htmlspecialchars(trim($fetchsizes['enter_size']));
            echo "<option value=\"$size\">$size</option>";
        }
        ?>
    </select>
    <p id="errText" class="error-text"></p>
</div>


                            <div class="col-md-6">
                                <label class="form-label"> Color<span class="errorindicator">*</span></label>
                                <select class="form-select" name="color" size="1" id="color">
                                    <option value="">Select Color</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM colors WHERE status=1");
                                    while ($fetch = mysqli_fetch_array($query)) {
                                    ?>
                                    <option   value="<?php echo $fetch['color_id'] ?>" <?php echo (isset($_POST['color']) && $_POST['color'] == $fetch['color_id']) ? 'selected' : ''; ?>  
                                        style="background-color: <?php echo $fetch['color_code'] ?>;">
                                        <?php echo $fetch['color_code'] ?>
                                    </option>

                                    
                                    <?php
                                    }
                                    ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Quantity<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="qantity" size="1" id="qantity" value="<?php echo isset($_POST['qantity']) ? htmlspecialchars($_POST['qantity']) : ''; ?>" />

                                <p id="errText" class="error-text"></p>
                            </div>

                              <span class="mt-2 mb-2" style="font-size: 14px; color: gray;">(** All Images Required only JPG,JPEG,PNG & Dimensions 
614 × 
428px, Size< 1 Mb)</span>



                            <div class="col-md-6">
                                <label class="form-label"> Material<span class="errorindicator">*</span></label>
                                <select class="form-select" name="material" size="1" id="material">
                                    <option value="">Select Material</option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM material WHERE status=1");
                                    while ($fetch = mysqli_fetch_array($query)) {
                                    ?>
                                    <option   value="<?php echo $fetch['material_id'] ?>" <?php echo (isset($_POST['material']) && $_POST['material'] == $fetch['material_id']) ? 'selected' : ''; ?>    >
                                        <?php echo $fetch['material_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-1<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image" id="image1">

                                <input type="hidden" name="oldImage" value="<?php echo isset($_POST['oldImage']) ? htmlspecialchars($_POST['oldImage']) : ''; ?>">

<?php if (!empty($_POST['oldImage'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/products/<?php echo htmlspecialchars($_POST['oldImage']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-1<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext1" value="<?php echo isset($_POST['alttext']) ? htmlspecialchars($_POST['alttext']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-2<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image2" id="image2">

                                <input type="hidden" name="oldImage2" value="<?php echo isset($_POST['oldImage2']) ? htmlspecialchars($_POST['oldImage2']) : ''; ?>">

<?php if (!empty($_POST['oldImage2'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/products/<?php echo htmlspecialchars($_POST['oldImage2']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-2<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt1" id="alt2" value="<?php echo isset($_POST['alt1']) ? htmlspecialchars($_POST['alt1']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-3<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image3" id="image3">

                                <input type="hidden" name="oldImage3" value="<?php echo isset($_POST['oldImage3']) ? htmlspecialchars($_POST['oldImage3']) : ''; ?>">

<?php if (!empty($_POST['oldImage3'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/products/<?php echo htmlspecialchars($_POST['oldImage3']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-3<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt2" id="alt3" value="<?php echo isset($_POST['alt2']) ? htmlspecialchars($_POST['alt2']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-4<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image4" id="image4">

                                <input type="hidden" name="oldImage4" value="<?php echo isset($_POST['oldImage4']) ? htmlspecialchars($_POST['oldImage4']) : ''; ?>">

<?php if (!empty($_POST['oldImage4'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/products/<?php echo htmlspecialchars($_POST['oldImage4']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-4<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt3" id="alt4" value="<?php echo isset($_POST['alt3']) ? htmlspecialchars($_POST['alt3']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-5<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image5" id="image5">

                                <input type="hidden" name="oldImage5" value="<?php echo isset($_POST['oldImage5']) ? htmlspecialchars($_POST['oldImage5']) : ''; ?>">

<?php if (!empty($_POST['oldImage5'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/products/<?php echo htmlspecialchars($_POST['oldImage5']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>



                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-5<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt5" id="alt5" value="<?php echo isset($_POST['alt5']) ? htmlspecialchars($_POST['alt5']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Availability<span class="errorindicator">*</span></label>
                                <select class="form-select" name="availability" id="availability">
                             <option value="">Select</option>
                             <option value="in_stock">In Stock</option>
                             <option value="no_stock">Out of Stock</option>
                                 </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Stock Keeping Unit<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="sku" id="sku" value="<?php echo isset($_POST['sku']) ? htmlspecialchars($_POST['sku']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>




                            <div class="col-md-6">
                                <label for="input3" class="form-label"> MRP<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="mrp" id="mrp" value="<?php echo isset($_POST['mrp']) ? htmlspecialchars($_POST['mrp']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Offer Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="offer" id="productOffer" value="<?php echo isset($_POST['offer']) ? htmlspecialchars($_POST['offer']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Product Priority<span class="errorindicator">*</span></label>
                                <select class="form-select" name="product_priority" id="productPriority">
                                    <option value="">Select</option>
                                    <option value="Popular">Popular</option>
                                    <option value="Basic">Basic</option>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Product Tag<span class="errorindicator">*</span></label>
                                <select class="form-select" name="product_tag" id="productTag">
                                    <option value="">Select</option>
                                    <option value="New Arrival">New Arrival</option>
                                    <option value="super_sale">Super Sale</option>
                                    <option value="favorite">Favorite</option>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> GST<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="gst" id="productGst" value="<?php echo isset($_POST['gst']) ? htmlspecialchars($_POST['gst']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Other(Tax)<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="other" id="Other" value="<?php echo isset($_POST['other']) ? htmlspecialchars($_POST['other']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <hr>
                            
                            <h2>feartures <span> <button type="button" id="add-feature-btn" class="btn btn-sm btn-outline-primary">
        <i class="bx bx-plus"></i>  
    </button></span></h2>

       <span class="mt-2 mb-2" style="font-size: 14px; color: gray;">(** Icon Required only JPG,JPEG,PNG & Dimensions 
100 × 
100px, Size< 1 Mb)</span>

          

                          <div id="feature-container" class="row mb-2 ">

  
    <div class="col-md-6 feature-group">
        <label class="form-label">Icon<span class="errorindicator"></span></label>
        <input type="file" class="form-control" name="feature_icon[]" />
   
    </div>
    <div class="col-md-6 feature-group">
        <label class="form-label">Feature<span class="errorindicator"></span></label>
        <input type="text" class="form-control" name="feature_text[]" />
     
    </div>
</div>

                           <hr>


<h2>Shipping Information</h2>

 <div class="col-md-6">
                                <label for="input3" class="form-label"> Courier<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="courier" id="courier" value="<?php echo isset($_POST['courier']) ? htmlspecialchars($_POST['courier']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Shipping<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="shipping" id="shipping" value="<?php echo isset($_POST['shipping']) ? htmlspecialchars($_POST['shipping']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Ground Shipping<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="ground_shipping" id="ground_shipping" value="<?php echo isset($_POST['ground_shipping']) ? htmlspecialchars($_POST['ground_shipping']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Global Export<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="global_export" id="global_export" value="<?php echo isset($_POST['global_export']) ? htmlspecialchars($_POST['global_export']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


<hr>

<div class="col-md-12">
                                <label for="input4" class="form-label"> Description<span class="errorindicator">*</span></label>
                                <textarea id="productdesc" name="description"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Additional info<span class="errorindicator">*</span></label>
                                <textarea id="add_info" name="add_info"><?php echo isset($_POST['add_info']) ? htmlspecialchars($_POST['add_info']) : ''; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Specifications<span class="errorindicator">*</span></label>
                                <textarea id="specification" name="specification"><?php echo isset($_POST['specification']) ? htmlspecialchars($_POST['specification']) : ''; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-product"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-product"
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

<!-- <script>
CKEDITOR.replace('productdesc', {
    height: 320,
});
</script> -->

<script>
$('#productdesc').summernote({
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
$('#add_info').summernote({
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
$('#specification').summernote({
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

<script src="./assets/api/productapi.js"></script>

<script>
function pcategoryvalue() {
    var val = $("#category").val();
    console.log('product category val-----', val);
    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {
            id4: val
        },
        success: function(result) {
            console.log(result);
            document.getElementById('subcategory').innerHTML = result;
        }
    })
}
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

  
    capitalizeFirstLetter("title");
    

 
});
</script>


<script>
document.getElementById('add-feature-btn').addEventListener('click', function () {
    const container = document.getElementById('feature-container');

    const rowDiv = document.createElement('div');
    rowDiv.className = 'row mb-2';

    rowDiv.innerHTML = `
        <div class="col-md-6 feature-group">
            <label class="form-label">Icon</label>
            <input type="file" class="form-control" name="feature_icon[]" />
        </div>
        <div class="col-md-6 feature-group">
            <label class="form-label">Feature</label>
            <input type="text" class="form-control" name="feature_text[]" />
        </div>
    `;

    container.appendChild(rowDiv);
});



</script>
