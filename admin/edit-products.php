<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/productFunctions.php';

if (isset($_POST['submit_form'])) {
    editProducts();
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
                        <h3 class="mb-4 text-center htext">Update Products</h3>
                        <?php
                        $query = mysqli_query($conn, "select * from products where 
                        product_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Title<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo $fetch['product_title'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Room<span class="errorindicator">*</span></label>
                                <select class="form-control" id="room" size="1" name="room">
                                 

<?php
$query = mysqli_query($conn, "SELECT * FROM property_sections WHERE status=1");
while ($row = mysqli_fetch_array($query)) {
    $selected = ($row['section_id'] == $fetch['room']) ? 'selected' : '';
    echo '<option value="' . $row['section_id'] . '" ' . $selected . '>' . $row['enter_section'] . '</option>';
}
?>



                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>



                            <div class="col-md-6">
                                <label class="form-label"> Category<span class="errorindicator">*</span></label>
                                <select class="form-control" name="category" id="category">
                                    <!-- <?php
                                    $categoryid = mysqli_query($conn, "select * from category where category_id='" . $fetch['product_category'] . "'");
                                    $categoryname = mysqli_fetch_array($categoryid);
                                    ?>
                                    <option><?php echo $categoryname['category_name'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM category WHERE status=1");
                                    while ($fetchCat = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchCat['category_id'] ?>">
                                            <?php echo $fetchCat['category_name'] ?></option>
                                    <?php
                                    }
                                    ?> -->


<?php
        $categoryid = mysqli_query($conn, "select * from category where category_id='" . $fetch['product_category'] . "'");
        $categoryname = mysqli_fetch_array($categoryid);
        ?>
        <option value="<?php echo $categoryname['category_id']; ?>"><?php echo $categoryname['category_name']; ?></option>
        <?php
        
        $query = mysqli_query($conn, "SELECT * FROM category WHERE status=1 AND category_id != '" . $fetch['product_category'] . "'");
        while ($fetchCat = mysqli_fetch_array($query)) {
        ?>
            <option value="<?php echo $fetchCat['category_id']; ?>">
                <?php echo $fetchCat['category_name']; ?>
            </option>
        <?php
        }
        ?>


                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Sub-Category<span class="errorindicator">*</span></label>
                                <select class="form-select" name="subcategory" size="1" id="subcategory">
                                    <!-- <?php
                                    $subcategoryid = mysqli_query($conn, "select * from subcategory where subcategory_id='" . $fetch['sub_category'] . "'");
                                    $subcategoryname = mysqli_fetch_array($subcategoryid);
                                    ?>
                                    <option><?php echo $subcategoryname['sub_category'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM subcategory WHERE status=1");
                                    while ($fetchSub = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchSub['subcategory_id'] ?>">
                                            <?php echo $fetchSub['sub_category'] ?></option>
                                    <?php
                                    }
                                    ?> -->

<?php
        $subcategoryid = mysqli_query($conn, "select * from subcategory where subcategory_id='" . $fetch['sub_category'] . "'");
        $subcategoryname = mysqli_fetch_array($subcategoryid);
        ?>
        <option value="<?php echo $subcategoryname['subcategory_id']; ?>"><?php echo $subcategoryname['sub_category']; ?></option>
        <?php
        // Fetch all subcategories excluding the selected one
        $query = mysqli_query($conn, "SELECT * FROM subcategory WHERE status=1 AND subcategory_id != '" . $fetch['sub_category'] . "'");
        while ($fetchSub = mysqli_fetch_array($query)) {
        ?>
            <option value="<?php echo $fetchSub['subcategory_id']; ?>">
                <?php echo $fetchSub['sub_category']; ?>
            </option>
        <?php
        }
        ?>


                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Product Brand<span class="errorindicator">*</span></label>
                                <select type="text" class="form-select" name="brand" id="productbrand">
                                    <!-- <?php
                                    $brandid = mysqli_query($conn, "select * from brand_master where brand_id='" . $fetch['product_brand'] . "'");
                                    $brandname = mysqli_fetch_array($brandid);
                                    ?>
                                    <option><?php echo $brandname['enter_brand'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM brand_master WHERE status=1");
                                    while ($fetchbrand = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchbrand['brand_id'] ?>">
                                            <?php echo $fetchbrand['enter_brand'] ?></option>
                                    <?php
                                    }
                                    ?> -->

<?php
        $brandid = mysqli_query($conn, "select * from brand_master where brand_id='" . $fetch['product_brand'] . "'");
        $brandname = mysqli_fetch_array($brandid);
        ?>
        <option value="<?php echo $brandname['brand_id']; ?>"><?php echo $brandname['enter_brand']; ?></option>
        <?php
        
        $query = mysqli_query($conn, "SELECT * FROM brand_master WHERE status=1 AND brand_id != '" . $fetch['product_brand'] . "'");
        while ($fetchbrand = mysqli_fetch_array($query)) {
        ?>
            <option value="<?php echo $fetchbrand['brand_id']; ?>">
                <?php echo $fetchbrand['enter_brand']; ?>
            </option>
        <?php
        }
        ?>



                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                          <div class="col-md-6">
    <label class="form-label">Sizes</label>
    <select class="form-control" id="input4" name="size" class="size">
        <?php 
     
        $currentSize = trim($fetch['product_size']);

        
        if (!empty($currentSize)) {
            echo '<option value="'.htmlspecialchars($currentSize).'" selected>'.htmlspecialchars($currentSize).'</option>';
        }

     
        $query = mysqli_query($conn, "SELECT DISTINCT TRIM(enter_size) AS size FROM sizes WHERE status=1 ORDER BY size ASC");

        while ($fetchDim = mysqli_fetch_array($query)) {
            $size = $fetchDim['size'];
        
            if ($size === $currentSize) {
                continue;
            }
            echo '<option value="'.htmlspecialchars($size).'">'.htmlspecialchars($size).'</option>';
        }
        ?>
    </select>
</div>


                            <div class="col-md-6">
                                <label class="form-label"> Color<span class="errorindicator">*</span></label>
                                <select class="form-select" name="color" id="color">
                                     <!-- <?php
                                    $colorid = mysqli_query($conn, "select * from colors where color_id='" . $fetch['product_color'] . "'");
                                    $colorname = mysqli_fetch_array($colorid);
                                    ?>
                                    <option><?php echo $colorname['color_code'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM colors WHERE status=1");
                                    while ($fetchCol = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchCol['color_id'] ?>">
                                            <?php echo $fetchCol['color_shade'] ?></option>
                                    <?php
                                    }
                                    ?>  -->


<?php
        
        $colorid = mysqli_query($conn, "SELECT * FROM colors WHERE color_id='" . $fetch['product_color'] . "'");
        $colorname = mysqli_fetch_array($colorid);
        ?>
        
        <option value="<?php echo $fetch['product_color']; ?>"><?php echo $colorname['color_code']; ?></option>

        <?php
        
        $query = mysqli_query($conn, "SELECT * FROM colors WHERE status=1");
        while ($fetchCol = mysqli_fetch_array($query)) {
            
            if ($fetchCol['color_id'] != $fetch['product_color']) {
                echo '<option value="' . $fetchCol['color_id'] . '">' . $fetchCol['color_shade'] . '</option>';
            }
        }
        ?>










                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Quantity<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="qantity" size="1" id="qantity" value="<?php echo $fetch['product_quantity']; ?>">
                                <!-- <select class="form-select" name="qantity" id="qantity">
                               

                                    <option value="<?php echo $fetch['product_quantity']; ?>">
            <?php echo $fetch['product_quantity']; ?>
        </option>
        
       
        <?php
        $selectedQuantity = $fetch['product_quantity'];
        $quantities = [1, 2, 3]; 

        
        foreach ($quantities as $quantity) {
            if ($quantity != $selectedQuantity) {
                echo "<option value=\"$quantity\">$quantity</option>";
            }
        }
        ?>

                                </select> -->
                                <p id="errText" class="error-text"></p>
                            </div>

                               <span class="mt-2 mb-2" style="font-size: 14px; color: gray;">(** All Images Required only JPG,JPEG,PNG & Dimensions 
614 × 
428px, Size< 1 Mb)</span>



                            <div class="col-md-6">
                                <label class="form-label"> Material<span class="errorindicator">*</span></label>
                                <select class="form-select" name="material" id="material">
                                    <!-- <?php
                                    $materialid = mysqli_query($conn, "select * from material where material_id='" . $fetch['product_material'] . "'");
                                    $materialname = mysqli_fetch_array($materialid);
                                    ?>
                                    <option><?php echo $materialname['material_name'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM material WHERE status=1");
                                    while ($fetchMat = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchMat['material_id'] ?>">
                                            <?php echo $fetchMat['material_name'] ?></option>
                                    <?php
                                    }
                                    ?> -->

<?php
        $materialid = mysqli_query($conn, "select * from material where material_id='" . $fetch['product_material'] . "'");
        $materialname = mysqli_fetch_array($materialid);
        ?>
        <option value="<?php echo $materialname['material_id']; ?>"><?php echo $materialname['material_name']; ?></option>
        <?php
      
        $query = mysqli_query($conn, "SELECT * FROM material WHERE status=1 AND material_id != '" . $fetch['product_material'] . "'");
        while ($fetchMat = mysqli_fetch_array($query)) {
        ?>
            <option value="<?php echo $fetchMat['material_id']; ?>">
                <?php echo $fetchMat['material_name']; ?>
            </option>
        <?php
        }
        ?>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-1<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image" id="image1">
                                <img src="./Uploads/products/<?php echo $fetch['image_4'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['image_4'] ?>" />
                                <input type="hidden" name="productId" value="<?php echo $fetch['product_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-1<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext1" value="<?php echo $fetch['product_alttext'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-2<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image1" id="image2">
                                <img src="./Uploads/products/<?php echo $fetch['image_1'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage1" value="<?php echo $fetch['image_1'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-2<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt1" id="alt2" value="<?php echo $fetch['alttext_1'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-3<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image2" id="image3">
                                <img src="./Uploads/products/<?php echo $fetch['image_2'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage2" value="<?php echo $fetch['image_2'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-3<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt2" id="alt3" value="<?php echo $fetch['alttext_2'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-4<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image3" id="image4">
                                <img src="./Uploads/products/<?php echo $fetch['image_3'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage3" value="<?php echo $fetch['image_3'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-4<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt3" id="alt4" value="<?php echo $fetch['alttext_3'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-5<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image5" id="image5">
                                <img src="./Uploads/products/<?php echo $fetch['image_5'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage5" value="<?php echo $fetch['image_5'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-5<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt5" id="alt5" value="<?php echo $fetch['img_alt_text5'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Availability<span class="errorindicator">*</span></label>
                                <select class="form-select" name="availability" id="availability">
                                <?php
    $options = [
        'in_stock' => 'In Stock',
        'out_of_stock' => 'Out of Stock'
    ];

    foreach ($options as $value => $label) {
        if ($fetch['availability'] === $value) {
            echo "<option value=\"$value\" selected>$label</option>";
        } else {
            echo "<option value=\"$value\">$label</option>";
        }
    }
    ?>
                                 </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Stock Keeping Unit<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="sku" id="sku" value="<?php echo $fetch['sku'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> MRP<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="mrp" id="mrp" value="<?php echo $fetch['product_mrp'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Offer Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="offer" id="productOffer" value="<?php echo $fetch['product_offerprice'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Product Priority<span class="errorindicator">*</span></label>
                                <select class="form-select" name="product_priority" id="productPriority">
                                    <option value="<?php echo $fetch['productPriority'] ?>">
                                        <?php echo $fetch['productPriority'] ?></option>
                                    <option value="">Select</option>
                                    <option value="Popular">Popular</option>
                                    <option value="Basic">Basic</option>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Product Tag<span class="errorindicator">*</span></label>
                                <select class="form-select" name="product_tag" id="productTag">

                                <?php
$productTag = isset($fetch['productTag']) ? $fetch['productTag'] : '';
$tags = [
    'new_arrival' => 'New Arrival',
    'super_sale' => 'Super Sale',
    'favorite' => 'Favorite'
];
?>

<?php foreach ($tags as $value => $label): ?>
        <option value="<?php echo $value; ?>" <?php echo ($productTag === $value) ? 'selected' : ''; ?>>
            <?php echo $label; ?>
        </option>
    <?php endforeach; ?>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> GST<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="gst" id="productGst" value="<?php echo $fetch['gst'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Other(Tax)<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="other" id="Other" value="<?php echo $fetch['other'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <hr>

    <h5>Features 
    <button type="button" id="add-feature-btn" class="btn btn-sm btn-outline-primary">
        <i class="bx bx-plus"></i> Add
    </button>
</h5>

<div id="feature-container">
<?php
$features = [];

if (!empty($fetch['product_features'])) {
    $decodedFeatures = json_decode($fetch['product_features'], true);
    if (is_array($decodedFeatures)) {
        $features = $decodedFeatures;
    }
}

if (!empty($features)) {
    foreach ($features as $index => $feature) {
?>
    <div class="row mb-2 feature-row">
        <div class="col-md-6">
            <label class="form-label">Icon</label>
            <input type="file" name="feature_icon[]" class="form-control" />
            <input type="hidden" name="old_feature_icon[]" value="<?php echo htmlspecialchars($feature['icon']); ?>">
            <?php if (!empty($feature['icon'])): ?>
                <img src="Uploads/products/<?php echo htmlspecialchars($feature['icon']); ?>" width="50" />
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <label class="form-label">Feature</label>
            <input type="text" name="feature_text[]" class="form-control" value="<?php echo htmlspecialchars($feature['text']); ?>" />
        </div>
    </div>
<?php
    }
} else {
   
?>

<span class="mt-2 mb-2" style="font-size: 14px; color: gray;">(** Icon Required only JPG,JPEG,PNG & Dimensions 
100 × 
100px, Size< 1 Mb)</span>


    <div class="row mb-2 feature-row">
        <div class="col-md-6">
            <label class="form-label">Icon</label>
            <input type="file" name="feature_icon[]" class="form-control" />
        </div>
        <div class="col-md-6">
            <label class="form-label">Feature</label>
            <input type="text" name="feature_text[]" class="form-control" />
        </div>
    </div>
<?php
}
?>
</div>





                   <hr>


<h5>Shipping Information</h5>

 <div class="col-md-6">
                                <label for="input3" class="form-label"> Courier<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="courier" id="courier" value="<?php echo $fetch['courier'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Shipping<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="shipping" id="shipping" value="<?php echo $fetch['shipping'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Ground Shipping<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="ground_shipping" id="ground_shipping" value="<?php echo $fetch['ground_shipping'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Global Export<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="global_export" id="global_export" value="<?php echo $fetch['global_export'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


<hr>








                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Description<span class="errorindicator">*</span></label>
                                <textarea id="productdesc" name="description"><?php echo $fetch['product_description'] ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Additional info<span class="errorindicator">*</span></label>
                                <textarea id="add_info" name="add_info"><?php echo $fetch['additional_info'] ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Specifications<span class="errorindicator">*</span></label>
                                <textarea id="specification" name="specification"><?php echo $fetch['specification'] ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-product" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-product" class="btn btn-primary px-4 submit d-none">Submit</button>
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
<script src="./assets/api/productapi.js"></script>

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

<script>
document.getElementById('add-feature-btn').addEventListener('click', function () {
    const container = document.getElementById('feature-container');

    const row = document.createElement('div');
    row.className = 'row mb-2 feature-row';

    row.innerHTML = `
        <div class="col-md-6">
            <label class="form-label">Icon</label>
            <input type="file" name="feature_icon[]" class="form-control" />
            <input type="hidden" name="old_feature_icon[]" value="">
        </div>
        <div class="col-md-6 d-flex align-items-end">
            <div class="w-100">
                <label class="form-label">Feature</label>
                <input type="text" name="feature_text[]" class="form-control" />
            </div>
            <button type="button" class="btn btn-danger ms-2 remove-feature"><i class="bx bx-trash"></i></button>
        </div>
    `;

    container.appendChild(row);
});


document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-feature')) {
        e.target.closest('.feature-row').remove();
    }
});

</script>
