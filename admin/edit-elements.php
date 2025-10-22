<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/elementFunctios.php';

if (isset($_POST['submit_form'])) {
    editElements();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./interior-elements.php">View Interior Elements</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Interior Elements</h3>

                        <?php
                        $query = mysqli_query($conn, "select * from interior_elements where 
                        element_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data" name="myform" id="myform">

                            <div class="col-md-6">
                                <label class="form-label"> Property Block<span class="errorindicator">*</span></label>
                                <select class="form-control" id="category" size="1" name="category">
                                    <!-- <?php
                                    $categoryid = mysqli_query($conn, "select * from property_sections where section_id='" . $fetch['element_category'] . "'");
                                    $categoryname = mysqli_fetch_array($categoryid);
                                    ?>
                                    <option value="<?php echo $categoryname['section_id'] ?>"><?php echo $categoryname['enter_section'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM property_sections WHERE status=1");
                                    while ($fetchCat = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchCat['section_id'] ?>"><?php echo $fetchCat['enter_section'] ?></option>
                                    <?php
                                    }
                                    ?> -->

<?php
$query = mysqli_query($conn, "SELECT * FROM property_sections WHERE status=1");
while ($row = mysqli_fetch_array($query)) {
    $selected = ($row['section_id'] == $fetch['element_category']) ? 'selected' : '';
    echo '<option value="' . $row['section_id'] . '" ' . $selected . '>' . $row['enter_section'] . '</option>';
}
?>



                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Element Name<span class="errorindicator">*</span></label>
                                <select class="form-control" id="Name" size="1" name="Name">
                                    <!-- <?php
                                    $elementid = mysqli_query($conn, "select * from element_master where element_id='" . $fetch['element_name'] . "'");
                                    $elementname =  mysqli_fetch_array($elementid);
                                    ?>
                                    <option value="<?php echo $elementname['element_id'] ?>"><?php echo $elementname['element_name'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM element_master WHERE status=1");
                                    while ($fetchCol = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchCol['element_id'] ?>">
                                            <?php echo $fetchCol['element_name'] ?></option>
                                    <?php
                                    }
                                    ?> -->

<?php
$query = mysqli_query($conn, "SELECT * FROM element_master WHERE status=1");
while ($row = mysqli_fetch_array($query)) {
    $selected = ($row['element_id'] == $fetch['element_name']) ? 'selected' : '';
    echo '<option value="' . $row['element_id'] . '" ' . $selected . '>' . $row['element_name'] . '</option>';
}
?>


                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Model<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="model" id="model" value="<?php echo $fetch['model']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Design Type<span class="errorindicator">*</span></label>
                                <select class="form-select" name="design" id="productDesign">
                                    <!-- <?php
                                    $designid = mysqli_query($conn, "select * from interior_elements where element_id='" . $fetch['product_design'] . "'");
                                    $designname = mysqli_fetch_array($designid);
                                    ?>
                                    <option value="<?php echo $fetch['product_design'] ?>"><?php echo $fetch['product_design'] ?></option>
                                    <option value="Classic">Classic</option>
                                    <option value="Modern">Modern</option> -->

                                    <?php
$designs = ['Classic', 'Modern'];
foreach ($designs as $design) {
    $selected = ($fetch['product_design'] == $design) ? 'selected' : '';
    echo '<option value="' . $design . '" ' . $selected . '>' . $design . '</option>';
}
?>



                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-1<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                <img src="./Uploads/elements/<?php echo $fetch['element_image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['element_image'] ?>" />
                                <input type="hidden" name="elementId" value="<?php echo $fetch['element_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-1<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo $fetch['element_alttext']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-2<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image1" id="image1">
                                <img src="./Uploads/elements/<?php echo $fetch['image_1'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage1" value="<?php echo $fetch['image_1'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-2<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt1" id="alt1" value="<?php echo $fetch['alttext_1']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-3<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image2" id="image2">
                                <img src="./Uploads/elements/<?php echo $fetch['image_2'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage2" value="<?php echo $fetch['image_2'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-3<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt2" id="alt2" value="<?php echo $fetch['alttext_2']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-4<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image3" id="image3">
                                <img src="./Uploads/elements/<?php echo $fetch['image_3'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage3" value="<?php echo $fetch['image_3'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-4<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt3" id="alt3" value="<?php echo $fetch['alttext_3']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image-5<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image4" id="image4">
                                <img src="./Uploads/elements/<?php echo $fetch['image_4'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage4" value="<?php echo $fetch['image_4'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text-5<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt4" id="alt4" value="<?php echo $fetch['alttext_4']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"> Select Material<span class="errorindicator">*</span></label>
                                <select class="form-select" name="material" size="1" id="material">
                                    <!-- <?php
                                    $materialid = mysqli_query($conn, "select * from material where material_id='" . $fetch['material'] . "'");
                                    $materialname = mysqli_fetch_array($materialid);
                                    ?>
                                    <option value="<?php echo $materialname['material_id'] ?>"><?php echo $materialname['material_name'] ?></option>
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
$query = mysqli_query($conn, "SELECT * FROM material WHERE status=1");
while ($row = mysqli_fetch_array($query)) {
    $selected = ($row['material_id'] == $fetch['material']) ? 'selected' : '';
    echo '<option value="' . $row['material_id'] . '" ' . $selected . '>' . $row['material_name'] . '</option>';
}
?>



                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>



                             <div class="col-md-12">
                                <label for="input1" class="form-label"> Maker Classification<span class="errorindicator">*</span></label>


                                 <select class="form-select" name="product_classification" id="product_classification" >

                                 <!-- <?php $getmaker = mysqli_query($conn, "SELECT * FROM classification WHERE classification_id='".$fetch['product_classification']."'");

                                                $maker= mysqli_fetch_array( $getmaker);
                                                ?>

                                    <option value="<?php echo $maker['classification_id']; ?>">
<?php echo $maker['classification']; ?>
                                </option>

                                  <?php
                                $querytestimonialss = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
                                  while ($fetchTestimonialss = mysqli_fetch_array($querytestimonialss)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonialss['classification_id'] ?>">
                                        <?php echo $fetchTestimonialss['classification'] ?></option>
                                    <?php
                                    }
                                    ?> -->


<?php
$query = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
while ($row = mysqli_fetch_array($query)) {
    $selected = ($row['classification'] == $fetch['product_classification']) ? 'selected' : '';
    echo '<option value="' . $row['classification'] . '" ' . $selected . '>' . $row['classification'] . '</option>';
}
?>


                                </select>


                                
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Material Classification<span class="errorindicator">*</span></label>


                                 <select class="form-select" name="material_classification" id="material_classification" >

                                <!-- <option value="">
Select
                                </option>

                                  <?php
                                $querytestimonialss = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
                                  while ($fetchTestimonialss = mysqli_fetch_array($querytestimonialss)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonialss['classification_id'] ?>">
                                        <?php echo $fetchTestimonialss['classification'] ?></option>
                                    <?php
                                    }
                                    ?> -->


<?php
$query = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
while ($row = mysqli_fetch_array($query)) {
    $selected = ($row['classification'] == $fetch['material_classification']) ? 'selected' : '';
    echo '<option value="' . $row['classification'] . '" ' . $selected . '>' . $row['classification'] . '</option>';
}
?>



                                </select>


                                
                                <p id="errText" class="error-text"></p>
                            </div>







                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Length<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="length" id="length" value="<?php echo $fetch['length']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Width<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="width" id="width" value="<?php echo $fetch['width']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Height<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="height" id="height" value="<?php echo $fetch['height']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                             

                             <div class="col-md-6">
                                <label for="input1" class="form-label"> Units<span class="errorindicator">*</span></label>

                                <select class="form-select" name="unit" id="unit">

                                <!-- <option value="<?php echo $fetch['units']; ?></option>">
<?php echo $fetch['units']; ?>
                                </option>

                                  <?php
                                $querytestimonial = mysqli_query($conn, "SELECT * FROM units WHERE status=1");
                                  while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonials['unit_master'] ?>">
                                        <?php echo $fetchTestimonials['unit_master'] ?></option>
                                    <?php
                                    }
                                    ?> -->

<?php
$query = mysqli_query($conn, "SELECT * FROM units WHERE status=1");
while ($row = mysqli_fetch_array($query)) {
    $selected = ($row['unit_master'] == $fetch['units']) ? 'selected' : '';
    echo '<option value="' . $row['unit_master'] . '" ' . $selected . '>' . $row['unit_master'] . '</option>';
}
?>

                                </select>
                                
                                <p id="errText" class="error-text"></p>
                            </div>




                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Cost Per 1Sqft<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="cost" id="cost" value="<?php echo $fetch['cost_per_sqft']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Minimum Price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="min_price" id="min_price" value="<?php echo $fetch['minimum_price']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Maximum price<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="max_price" id="max_price" value="<?php echo $fetch['maximum_price']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Total Sq. Units<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="squnits" id="squnits" value="<?php echo $fetch['squnits']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input6" class="form-label"> Description<span class="errorindicator">*</span></label>
                                <!-- <input type="text" id="element1" class="form-control" name="description" maxlength="43" value="<?php echo $fetch['element_description']; ?>"> -->
                                <textarea id="elementDes" name="description"><?php echo $fetch['element_description']; ?></textarea>
                                 <p id="errText" class="error-text"></p>
                            </div>

                           <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-element"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-element"
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
<script src="./assets/api/elementsapi.js"></script>

<!-- <script>
    CKEDITOR.replace('element1', {
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