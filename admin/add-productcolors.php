<?php
include 'includes/header.php';
include './functions/productcolorFunctions.php';

if (isset($_POST['submit_form'])) {

    $uploadDir = 'Uploads/products/';

    foreach (['image', 'image2', 'image3', 'image4', 'image5'] as $imgField) {
        if (isset($_FILES[$imgField]) && $_FILES[$imgField]['error'] === 0) {
            $filename = time() . '_' . basename($_FILES[$imgField]['name']);
            $targetPath = $uploadDir . $filename;
    
            if (move_uploaded_file($_FILES[$imgField]['tmp_name'], $targetPath)) {
                
                $postKey = 'old' . ucfirst($imgField); 
                $_POST[$postKey] = $filename;
            }
        }
    }


    addProductcolors();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./product_colors.php">View
                                Product by Colors</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Add Product Colors</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">

                            <div class="col-md-6">
                                <label class="form-label"> Product<span class="errorindicator">*</span></label>
                                <select class="form-select" name="product" size="1" id="product">
                                    <option value="">Select Category</option>
                                    <?php
                                    $query=mysqli_query($conn,"SELECT * FROM products WHERE status=1");
                                    while($fetch=mysqli_fetch_array($query)){
                                    ?>
                                    <option   value="<?php echo $fetch['product_id'] ?>" <?php echo (isset($_POST['product']) && $_POST['product'] == $fetch['product_id']) ? 'selected' : ''; ?>>
                                        <?php echo $fetch['product_title'] ?></option>
                                    <?php
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

                            

                            <span class="mt-2 mb-2" style="font-size: 14px; color: gray;">(** All Images Required only JPG,JPEG,PNG & Dimensions 
276 × 
260px, Size< 1 Mb)</span>

                           


                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 1<span class="errorindicator">*</span>  </label>
                                <input type="file" class="form-control" name="image" id="image">

                                <input type="hidden" name="oldImage" value="<?php echo isset($_POST['oldImage']) ? htmlspecialchars($_POST['oldImage']) : ''; ?>">

<?php if (!empty($_POST['oldImage'])): ?>
    <div style="margin-top: 2px;">
        <img src="Uploads/products/<?php echo htmlspecialchars($_POST['oldImage']); ?>" alt="Uploaded Image" width="80">
    </div>
<?php endif; ?>


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text 1<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo isset($_POST['alttext']) ? htmlspecialchars($_POST['alttext']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 2<span class="errorindicator">*</span></label>
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
                                <label for="input3" class="form-label"> Image Alt Text 2<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext2" id="alttext2" value="<?php echo isset($_POST['alttext']) ? htmlspecialchars($_POST['alttext']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 3<span class="errorindicator">*</span></label>
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
                                <label for="input3" class="form-label"> Image Alt Text 3<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext3" id="alttext3" value="<?php echo isset($_POST['alttext']) ? htmlspecialchars($_POST['alttext']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 4<span class="errorindicator">*</span></label>
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
                                <label for="input3" class="form-label"> Image Alt Text 4<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext4" id="alttext4" value="<?php echo isset($_POST['alttext']) ? htmlspecialchars($_POST['alttext']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 5<span class="errorindicator">*</span></label>
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
                                <label for="input3" class="form-label"> Image Alt Text 5<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext5" id="alttext5" value="<?php echo isset($_POST['alttext']) ? htmlspecialchars($_POST['alttext']) : ''; ?>">
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
                                <label class="form-label"> Quantity<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="qantity" size="1" id="qantity" value="<?php echo isset($_POST['qantity']) ? htmlspecialchars($_POST['qantity']) : ''; ?>" />

                                <p id="errText" class="error-text"></p>
                            </div>
                          

                        

                           

                        

                        


                          

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-pcolor"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-pcolor"
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
<script src="./assets/api/productcolors.js"></script>



