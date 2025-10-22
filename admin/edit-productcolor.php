<?php
include 'includes/header.php';
include './functions/productcolorFunctions.php';

if (isset($_POST['submit_form'])) {



    editProductcolors();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./gallery.php">View
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
                        <h3 class="mb-4 text-center htext">Update Product Colors</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">

                        <?php
                        $colorquery = mysqli_query($conn, "select * from product_colors where 
                        product_color_id='" . $_GET['id'] . "'");
                        $fetchcolor = mysqli_fetch_array($colorquery);
                        ?>


                            <div class="col-md-6">
                                <label class="form-label"> Product<span class="errorindicator">*</span></label>
                                <select class="form-select" name="product" size="1" id="product">
                                <?php
    $query = mysqli_query($conn, "SELECT * FROM products WHERE status=1");
    while ($fetch = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $fetch['product_id']; ?>" <?php echo ($fetchcolor['product_name'] == $fetch['product_id']) ? 'selected' : ''; ?>>
            <?php echo $fetch['product_title']; ?>
        </option>
    <?php
    }
    ?>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Color<span class="errorindicator">*</span></label>
                                <select class="form-select" name="color" size="1" id="color">
                                <?php
    $query = mysqli_query($conn, "SELECT * FROM colors WHERE status=1");
    while ($fetch = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $fetch['color_id']; ?>" <?php echo ($fetchcolor['product_color'] == $fetch['color_id']) ? 'selected' : ''; ?> 
            style="background-color: <?php echo $fetch['color_code']; ?>;">
            <?php echo $fetch['color_code']; ?>
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
                                <img src="./Uploads/products/<?php echo $fetchcolor['image1'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetchcolor['image1'] ?>" />
                          


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text 1<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo $fetchcolor['alttext1'] ?>">
                                <input type="hidden" name="productcolorId" value="<?php echo $fetchcolor['product_color_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 2<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image2" id="image2">
                                <img src="./Uploads/products/<?php echo $fetchcolor['image2'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage2" value="<?php echo $fetchcolor['image2'] ?>" />

                               


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text 2<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext2" id="alttext2" value="<?php echo $fetchcolor['alttext2'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 3<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image3" id="image3">
                                <img src="./Uploads/products/<?php echo $fetchcolor['image3'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage3" value="<?php echo $fetchcolor['image3'] ?>" />
                              


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text 3<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext3" id="alttext3" value="<?php echo $fetchcolor['alttext3'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 4<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image4" id="image4">
                                <img src="./Uploads/products/<?php echo $fetchcolor['image4'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage4" value="<?php echo $fetchcolor['image4'] ?>" />
                             


                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text 4<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext4" id="alttext4" value="<?php echo $fetchcolor['alttext4'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 5<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image5" id="image5">
                                <img src="./Uploads/products/<?php echo $fetchcolor['image5'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage5" value="<?php echo $fetchcolor['image5'] ?>" />
                             



                                <p id="errText" class="error-text"></p>
                            </div>
                          

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text 5<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext5" id="alttext5" value="<?php echo $fetchcolor['alttext5'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                                            <div class="col-md-6">
    <label class="form-label">Sizes</label>
    <select class="form-control" id="size" name="size" class="size">
        <?php 
     
        $currentSize = trim($fetchcolor['product_size']);

        
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
                                <label class="form-label"> Quantity<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="qantity" size="1" id="qantity" value="<?php echo $fetchcolor['product_quantity']; ?>">
                                <!-- <select class="form-select" name="qantity" id="qantity">
                               

                                    <option value="<?php echo $fetchcolor['product_quantity']; ?>">
            <?php echo $fetchcolor['product_quantity']; ?>
        </option>
        
       
        <?php
        $selectedQuantity = $fetchcolor['product_quantity'];
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
                          

                        
                            
                            <div class="col-md-6">
                                <label class="form-label"> Material<span class="errorindicator">*</span></label>
                                <select class="form-select" name="material" id="material">
                                    <!-- <?php
                                    $materialid = mysqli_query($conn, "select * from material where material_id='" . $fetchcolor['product_material'] . "'");
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
        $materialid = mysqli_query($conn, "select * from material where material_id='" . $fetchcolor['product_material'] . "'");
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



