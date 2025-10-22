<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/googlereviewsFunctions.php';

if(isset($_POST['submit_form'])) {
    editGooglereview();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./google_reviews.php">View Google Reviews</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Google Reviews</h3>
                        <?php
                        $query = mysqli_query($conn, "select * from google_reviews where 
                        review_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Name<span class="errorindicator">*</span></label>
                                <!-- <input type="text" class="form-control" name="name" id="name" value="<?php echo $fetch['name']; ?>"> -->

                                 <?php

$getvendorname = mysqli_query($conn, "SELECT * FROM vendor_management
 WHERE vendor_id='".$fetch['name']."' ");

$fetchvendorname = mysqli_fetch_array($getvendorname)

?>

                                   <select name="name" id="name" class="form-select ">
                                    <!-- <option value="<?php echo $fetchvendorname['vendor_id']; ?>"><?php echo $fetchvendorname['vendor_full_name']; ?></option>
                                    <?php
                                    $getActiveVendor = mysqli_query($conn, "SELECT * FROM vendor_management WHERE status = 1");
                                    while ($vendorsList = mysqli_fetch_array($getActiveVendor)) {

                                    ?>
                                        <option value=<?php echo $vendorsList['vendor_id'] ?>><?php echo $vendorsList['vendor_full_name'] ?> </option>

                                    <?php
                                    }
                                    ?> -->


<option value="<?php echo $fetchvendorname['vendor_id']; ?>">
            <?php echo $fetchvendorname['vendor_full_name']; ?>
        </option>

        <?php
        // Only fetch vendors that are active AND not already selected
        $getActiveVendor = mysqli_query($conn, "SELECT * FROM vendor_management WHERE status = 1 AND vendor_id != '" . $fetch['name'] . "'");
        while ($vendorsList = mysqli_fetch_array($getActiveVendor)) {
        ?>
            <option value="<?php echo $vendorsList['vendor_id']; ?>">
                <?php echo $vendorsList['vendor_full_name']; ?>
            </option>
        <?php } ?>


                                </select>


                                <p id="errText" class="error-text"></p>
                            </div>

                             <div class="col-md-6">
                                <label for="input2" class="form-label"> Reviewer Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="review_name" id="review_name" value="<?php echo $fetch['review_name']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                        

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image<span class="errorindicator">*</span> <span class="requiredtext">	(JPG,JPEG,PNG & 
                                151×89px)</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                <img src="./Uploads/googlereviews/<?php echo $fetch['image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['image'] ?>" />
                                <input type="hidden" name="blogId" value="<?php echo $fetch['review_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Location<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="location" id="location" value="<?php echo $fetch['location']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                             
                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Description<span class="errorindicator">*</span></label>
                                <textarea id="reviewdesc" name="description"><?php echo $fetch['content']; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-blog"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-blog"
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

<script src="./assets/api/googlereviewsapi.js"></script>

<!-- <script>
		CKEDITOR.replace('blogdesc', {
			height: 320,
		});
	</script> -->

    <script>
$('#reviewdesc').summernote({
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