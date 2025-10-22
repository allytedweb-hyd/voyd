<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/serviceFunctions.php';

if (isset($_POST['submit_form'])) {
    editServices();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./services.php">View Services
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
                        <h3 class="mb-4 text-center htext">Update Services</h3>
                        <?php
                        $query = mysqli_query($conn, "select * from services where 
                        service_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Title<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo $fetch['service_title']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Sub Title<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="subtitle" id="subtitle" value="<?php echo $fetch['service_subtitle']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label">Image<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                <img src="./Uploads/services/<?php echo $fetch['service_image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['service_image'] ?>" />
                                <input type="hidden" name="serviceId" value="<?php echo $fetch['service_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label">Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo $fetch['service_alttext']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input4" class="form-label">Description<span class="errorindicator">*</span></label>
                                <textarea id="servicedesc" name="description"><?php echo $fetch['service_description']; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-service"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-service"
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
<script src="./assets/api/serviceapi.js"></script>

<!-- <script>
    CKEDITOR.replace('servicedesc', {
        height: 320,
    });
</script> -->

<script>
$('#servicedesc').summernote({
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