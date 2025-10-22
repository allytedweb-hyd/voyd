<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/companyFunctions.php';

if (isset($_POST['submit_form'])) {
    editCompanies();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./topcompanies.php">View Companies</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Companies</h3>

                        <?php
                        $query = mysqli_query($conn, "select * from top_companies where 
                        company_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data">

                            <div class="col-md-12">
                                <label for="input2" class="form-label"> Image<span class="errorindicator">*</span> <span class="requiredtext">	(Required only JPG,JPEG,PNG & Dimensions 
212 × 
80px, Size< 1 Mb)</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                <img src="./Uploads/companies/<?php echo $fetch['company_image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['company_image'] ?>" />
                                <input type="hidden" name="companyId" value="<?php echo $fetch['company_id'] ?>" />
                            </div>

                            <div class="col-md-12 mt-4">
                                <label for="input3" class="form-label"> Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alttext" id="alttext" value="<?php echo $fetch['company_alttext']; ?>">
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-company"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-company"
                                        class="btn btn-primary px-4 submit d-none">Submit</button>
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
<script src="./assets/api/companiesapi.js"></script>