<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/blogFunctions.php';

if(isset($_POST['submit_form'])) {
    editBlog();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./blog.php">View Blog</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Blog</h3>
                        <?php
                        $query = mysqli_query($conn, "select * from blog where 
                        blog_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Title<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo $fetch['blog_title']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Author<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="author" id="author" value="<?php echo $fetch['author']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Ratings<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="comments" id="comments" value="<?php echo $fetch['comments']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Date<span class="errorindicator">*</span></label>
                                <input type="date" class="form-control" name="date" id="date" value="<?php echo $fetch['blog_date']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                             <div class="col-md-12">
                                <label for="input2" class="form-label"> Link<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="link" id="link" value="<?php echo $fetch['link']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image<span class="errorindicator">*</span><span class="requiredtext"> (JPG,JPEG,PNG
                                        363 ×
                                        268px)</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                <img src="./Uploads/blog/<?php echo $fetch['blog_image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['blog_image'] ?>" />
                                <input type="hidden" name="blogId" value="<?php echo $fetch['blog_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo $fetch['blog_alttext']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                             
                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Description<span class="errorindicator">*</span></label>
                                <textarea id="blogdesc" name="description"><?php echo $fetch['blog_description']; ?></textarea>
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

<script src="./assets/api/blogapi.js"></script>

<!-- <script>
		CKEDITOR.replace('blogdesc', {
			height: 320,
		});
	</script> -->

    <script>
$('#blogdesc').summernote({
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