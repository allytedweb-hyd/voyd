<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/contactFunctions.php';

if(isset($_POST['submit_form'])) {
    editContact();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./contact.php">View Contact</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Contact</h3>
                        <?php
                        $query = mysqli_query($conn, "select * from contact where 
                        contactus_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Address<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="address" id="addres" value="<?php echo $fetch['contact_address'] ?>">
                                <input type="hidden" name="contactId" value="<?php echo $fetch['contactus_id'] ?>" />
                            </div>

                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Mobile Number<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="number" id="number" value="<?php echo $fetch['contact_number'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alternate Number<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="altnumber" id="altnumber" value="<?php echo $fetch['alternate_number'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Timings<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="timings" id="timings" value="<?php echo $fetch['working_hours'] ?>">
                            </div>
                             
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-contact"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-contact"
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
<script src="./assets/api/contactapi.js"></script>