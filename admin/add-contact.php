<?php
include 'includes/header.php';
include './functions/contactFunctions.php';

if(isset($_POST['submit_form'])) {
    addContact();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./contact.php">View Contact
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
                        <h3 class="mb-4 text-center htext">Add Contact</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Address<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="address" id="address" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Mobile Number<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="number" id="number" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" value="<?php echo isset($_POST['number']) ? htmlspecialchars($_POST['number']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alternate Number<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="altnumber" id="altnumber" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" value="<?php echo isset($_POST['altnumber']) ? htmlspecialchars($_POST['altnumber']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Timings<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="timings" id="timings" value="<?php echo isset($_POST['timings']) ? htmlspecialchars($_POST['timings']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
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


