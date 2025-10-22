<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/subcategoryFunctions.php';

if (isset($_POST['submit_form'])) {
    editSubCategory();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./subcategory.php">View Sub
                                Category</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Sub Category</h3>

                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM subcategory WHERE 
                        subcategory_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label class="form-label"> Select Category<span class="errorindicator">*</span></label>
                                <select class="form-select" size="1" name="category" id="pcategory">
                                    <!-- <?php
                                    $categoryid = mysqli_query($conn, "select * from category where category_id='" . $fetch['category'] . "'");
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
           
            $categoryid = mysqli_query($conn, "SELECT * FROM category WHERE category_id='" . $fetch['category'] . "'");
            $categoryname = mysqli_fetch_array($categoryid);
            ?>
       
            <option value="<?php echo $fetch['category']; ?>"><?php echo $categoryname['category_name']; ?></option>

            <?php
          
            $query = mysqli_query($conn, "SELECT * FROM category WHERE status=1 AND category_id != '" . $fetch['category'] . "'");
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

                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Enter Sub-Category<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="subcategory" id="psubcategory" value="<?php echo $fetch['sub_category'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image<span class="errorindicator">*</span><span class="requiredtext"> (JPG,JPEG,PNG
                                        220 ×
                                        200px)</span></label>
                                <input type="file" class="form-control" name="Image" id="pcategoryImage">
                                <img src="./Uploads/subcategory/<?php echo $fetch['scategory_image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['scategory_image'] ?>" />
                                <input type="hidden" name="subcategoryId" value="<?php echo $fetch['subcategory_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="pcategoryAlttext" value="<?php echo $fetch['alt_text']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-psubcategory" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-psubcategory" class="btn btn-primary px-4 submit d-none">Submit</button>
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
<script src="./assets/api/prosubcategoryapi.js"></script>