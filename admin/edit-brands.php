<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/brandFunctions.php';

if (isset($_POST['submit'])) {
    editBrands();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./brands.php">View Brands</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Brands</h3>

                        <?php
                        $query = mysqli_query($conn, "select * from brands where 
                        brand_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data">

                            <div class="col-md-6">
                                <label class="form-label"> Category<span class="errorindicator">*</span></label>
                                <select class="form-select" id="input4" name="category" class="category">
                                    <!-- <option><?php echo $fetch['brand_category'] ?></option>
                                    <option value="Kitchen">Kitchen</option>
                                    <option value="Paints">Paints</option>
                                    <option value="Ply-Wood">Ply-Wood</option>
                                    <option value="Sanitary">Sanitary</option>
                                    <option value="Electrical">Electrical</option>    
                                                                    -->

                                                                    <option value="<?php echo $fetch['brand_category']; ?>" selected><?php echo $fetch['brand_category']; ?></option>
    <?php
    $categories = ["Kitchen", "Paints", "Ply-Wood", "Sanitary", "Electrical"];
    foreach ($categories as $category) {
        if ($category !== $fetch['brand_category']) {
            echo "<option value=\"$category\">$category</option>";
        }
    }
    ?>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div> 

                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Title<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo $fetch['brand_title']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                <img src="./Uploads/brands/<?php echo $fetch['brand_image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['brand_image'] ?>" />
                                <input type="hidden" name="brandId" value="<?php echo $fetch['brand_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo $fetch['brand_alttext']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary px-4 submit">Submit</button>
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