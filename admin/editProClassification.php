<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/proClassificationFunctions.php';

if (isset($_POST['submit_form'])) {
    editClassification();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./productClassification.php">View Product Classification</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Classification</h3>

                        <?php
                        $query = mysqli_query($conn, "select * from classification where 
                        classification_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Enter Classification<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="classification" id="proclassification" value="<?php echo $fetch['classification'] ?>">
                                <input type="hidden" name="classificationId" value="<?php echo $fetch['classification_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>


                               <div class="col-md-12">
                                <label for="input1" class="form-label"> Icon<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="icon" id="icon">
                                  <img src="./Uploads/classifications/<?php echo $fetch['icon'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['icon'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>



                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-classification" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-classification" class="btn btn-primary px-4 submit d-none">Submit</button>
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
<script src="./assets/api/classificationapi.js"></script>