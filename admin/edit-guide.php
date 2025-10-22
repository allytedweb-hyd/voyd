<?php
include 'includes/header.php';
include './functions/guideFunctions.php';

if (isset($_POST['submit_form'])) {
    editGuide();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./guides.php">View
                                Guides</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

              <?php
                        $query = mysqli_query($conn, "select * from guides where 
                        guide_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>


                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Edit Guide</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">


                        <div class="col-md-12">
                                <label for="input3" class="form-label"> Title<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo $fetch['title']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                        

                            <div class="col-md-12">
                                <label for="input2" class="form-label"> Image<span class="errorindicator">*</span> <span class="requiredtext">	(Required only JPG,JPEG,PNG & Dimensions 
341 × 
308px, Size< 1 Mb)</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                 <img src="./Uploads/guides/<?php echo $fetch['image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['image'] ?>" />
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['guide_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo $fetch['img_alt_text']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                           

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> PDF<span class="errorindicator">*</span></label>
                                <input type="file" class="form-control" name="pdf" id="pdf">
                                 <iframe src="./Uploads/guides/<?php echo $fetch['pdf']?>" width="100" height="80" frameborder="0" style="border: none;"></iframe>
                                             <input type="hidden" name="oldPdf" value="<?php echo $fetch['pdf'] ?>"/>
                                             <input type="hidden" name="galleryId" value="<?php echo $fetch['guide_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Description<span class="errorindicator">*</span></label>
                                <!-- <input type="text" class="form-control" name="desc" id="desc"> -->
                                <textarea name="desc" id="desc"><?php echo $fetch['description'];?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                           

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-guide"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-guide"
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
<script src="./assets/api/guidesapi.js"></script>

  <script>
$('#desc').summernote({
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

  
    capitalizeFirstLetter("title");
    capitalizeFirstLetter("alttext");

 
});
</script>