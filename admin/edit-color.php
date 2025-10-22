<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/colorFunctions.php';

if (isset($_POST['submit_form'])) {
    editColor();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./color.php">View Color</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Color</h3>
                        <?php
                        $query = mysqli_query($conn, "select * from colors where 
                        color_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Color Code<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="color" id="colorcode" value="<?php echo $fetch['color_code'] ?>">
                                <!-- <input type="hidden" name="colorId" value="<php echo $fetch['color_id'] ?>" /> -->
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Color Shade<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="colorShade" id="colorShade" value="<?php echo $fetch['color_shade'] ?>">
                                <input type="hidden" name="colorId" value="<?php echo $fetch['color_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-color" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-color" class="btn btn-primary px-4 submit d-none">Submit</button>
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
<script src="./assets/api/colorapi.js"></script>