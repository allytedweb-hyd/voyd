<?php
include 'includes/header.php';
include './functions/ongoingcardFunctions.php';

if(isset($_POST['submit_form'])) {
    editOngoingcard();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./ongoingcard.php">View Sales Pop-Up
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
                        <h3 class="mb-4 text-center htext">Update Sales Pop-Up</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">


                        <?php
                        $query = mysqli_query($conn, "select * from ongoing_card where 
                        ongoingcard_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>


                         

                              <div class="col-md-6">
                                <label for="input2" class="form-label">Main Heading<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="main_heading" id="main_heading" value="<?php echo $fetch['main_heading'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                              <div class="col-md-6">
                                <label for="input2" class="form-label">Sub Heading<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="sub_heading" id="sub_heading" value="<?php echo $fetch['sub_heading'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                          

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image<span class="errorindicator">*</span> <span class="requiredtext">	(JPG,JPEG,PNG & 
151×89px)</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                <img src="./Uploads/ongoing/<?php echo $fetch['image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['image'] ?>" />
                                <input type="hidden" name="ongoingcard_id" value="<?php echo $fetch['ongoingcard_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="img_alt_text" id="img_alt_text" value="<?php echo $fetch['img_alt_text'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Offer<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="offer" id="offer" value="<?php echo $fetch['offer'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Promo Code<span class="errorindicator">*</span></label>
                                
                                  <select name="promo" id="promo" class="form-select ">
                                    <!-- <option value="<?php echo $fetch['promo'] ?>"><?php echo $fetch['promo'] ?></option>
                                    <?php
                                    $getActiveVendor = mysqli_query($conn, "SELECT * FROM promocode_master WHERE status = 1");
                                    while ($vendorsList = mysqli_fetch_array($getActiveVendor)) {

                                    ?>
                                        <option value="<?php echo $vendorsList['promocode'] ?>"><?php echo $vendorsList['promocode'] ?> </option>

                                    <?php
                                    }
                                    ?> -->


<option value="<?php echo $fetch['promo']; ?>" selected>
            <?php echo $fetch['promo']; ?>
        </option>
        <?php
       
        $getActiveVendor = mysqli_query($conn, "SELECT * FROM promocode_master WHERE status = 1");

   
        while ($vendorsList = mysqli_fetch_array($getActiveVendor)) {
            if ($vendorsList['promocode'] != $fetch['promo']) { 
        ?>
            <option value="<?php echo $vendorsList['promocode']; ?>"><?php echo $vendorsList['promocode']; ?></option>
        <?php
            }
        }
        ?>


                                </select>
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

<!-- <script>
		CKEDITOR.replace('blogdesc', {
			height: 320,
		});
	</script> -->


<script src="./assets/api/ongoingapi.js"></script>

<script>
$(document).ready(function () {
    function capitalizeFirstLetter(fieldId) {
        const input = document.getElementById(fieldId);
        input.addEventListener('blur', function () {
            let val = input.value.trim();
            if (val.length > 0) {
                input.value = val.charAt(0).toUpperCase() + val.slice(1);
            }
        });
    }

  
    
    capitalizeFirstLetter("main_heading");
    capitalizeFirstLetter("sub_heading");
    capitalizeFirstLetter("img_alt_text");
    capitalizeFirstLetter("offer");

 
});
</script>