<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/galleryFunctions.php';

if (isset($_POST['submit_form'])) {
    editGallery();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./gallery.php">View Previous Projects</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Previous Project</h3>

                        <?php
                        $query = mysqli_query($conn, "select * from gallery where 
                        gallery_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data">

                            <div class="col-md-12">
                                <label class="form-label"> Category<span class="errorindicator">*</span></label>
                                <select class="form-control" id="category" name="category" size="1">

                               
                                    <!-- <?php
                                    $gcategoryid = mysqli_query($conn, "select * from gallery_category where gcategory_id='" . $fetch['gallery_category'] . "'");
                                    $gcategoryname = mysqli_fetch_array($gcategoryid);
                                    ?>
                                    <option value="<?php echo $gcategoryname['gcategory_id']; ?>"  ><?php echo $gcategoryname['category_name'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM gallery_category WHERE status=1");
                                    while ($fetchCat = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchCat['gcategory_id'] ?>"><?php echo $fetchCat['category_name'] ?></option>
                                    <?php
                                    }
                                    ?> -->

<?php
        
        $gcategoryid = mysqli_query($conn, "SELECT * FROM gallery_category WHERE gcategory_id='" . $fetch['gallery_category'] . "'");
        $gcategoryname = mysqli_fetch_array($gcategoryid);
        $selectedCategoryId = $gcategoryname['gcategory_id'];

        
        echo "<option value='$selectedCategoryId' selected>" . $gcategoryname['category_name'] . "</option>";

       
        $query = mysqli_query($conn, "SELECT * FROM gallery_category WHERE status=1 AND gcategory_id != '$selectedCategoryId'");

       
        while ($fetchCat = mysqli_fetch_array($query)) {
            echo "<option value='" . $fetchCat['gcategory_id'] . "'>" . $fetchCat['category_name'] . "</option>";
        }
        ?>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <span class="mt-2 mb-2" style="font-size: 14px; color: gray;">(** All Images Required only JPG,JPEG,PNG & Dimensions 
276 × 
260px, Size< 1 Mb)</span>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 1<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                <img src="./Uploads/gallery/<?php echo $fetch['gallery_image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['gallery_image'] ?>" />
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['gallery_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 2<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image2" id="image2">
                                <img src="./Uploads/gallery/<?php echo $fetch['gallery_image2'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage2" value="<?php echo $fetch['gallery_image2'] ?>" />
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['gallery_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 3<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image3" id="image3">
                                <img src="./Uploads/gallery/<?php echo $fetch['gallery_image3'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage3" value="<?php echo $fetch['gallery_image3'] ?>" />
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['gallery_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 4<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image4" id="image4">
                                <img src="./Uploads/gallery/<?php echo $fetch['gallery_image4'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage4" value="<?php echo $fetch['gallery_image4'] ?>" />
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['gallery_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 5<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image5" id="image5">
                                <img src="./Uploads/gallery/<?php echo $fetch['gallery_image5'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage5" value="<?php echo $fetch['gallery_image5'] ?>" />
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['gallery_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 6<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image6" id="image6">
                                <img src="./Uploads/gallery/<?php echo $fetch['gallery_image6'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage6" value="<?php echo $fetch['gallery_image6'] ?>" />
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['gallery_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 7<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image7" id="image7">
                                <img src="./Uploads/gallery/<?php echo $fetch['gallery_image7'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage7" value="<?php echo $fetch['gallery_image7'] ?>" />
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['gallery_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 8<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image8" id="image8">
                                <img src="./Uploads/gallery/<?php echo $fetch['gallery_image8'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage8" value="<?php echo $fetch['gallery_image8'] ?>" />
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['gallery_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 9<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image9" id="image9">
                                <img src="./Uploads/gallery/<?php echo $fetch['gallery_image9'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage9" value="<?php echo $fetch['gallery_image9'] ?>" />
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['gallery_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image 10<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image10" id="image10">
                                <img src="./Uploads/gallery/<?php echo $fetch['gallery_image10'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage10" value="<?php echo $fetch['gallery_image10'] ?>" />
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['gallery_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo $fetch['gallery_alttext']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                                <div class="col-md-6">
                                <label for="input3" class="form-label"> Price<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="price" id="price" value="<?php echo $fetch['price']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Rating<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="rating" id="rating" value="<?php echo $fetch['rating']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Profile Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="profile_img" id="profile_img">
                                 <img src="./Uploads/gallery/<?php echo $fetch['profile_img'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldProfile_img" value="<?php echo $fetch['profile_img'] ?>" />
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['gallery_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Profile Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="profilealttext" id="profilealttext" value="<?php echo $fetch['profile_img_alt_text']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>



                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Customer Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="cus_name" id="cus_name" value="<?php echo $fetch['customer_name']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Customer Status<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="cus_status" id="cus_status" value="<?php echo $fetch['customer_status']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Flat No.<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="flat" id="flat" value="<?php echo $fetch['flat']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>



                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-gallery"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-gallery"
                                        class="btn btn-primary px-4 submit d-none">Submit</button>                                </div>
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
<script src="./assets/api/galleryapi.js"></script>