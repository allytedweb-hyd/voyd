<?php
include 'includes/header.php';
include './functions/supersaleFunctions.php';

if (isset($_POST['submit_form'])) {
    editSupersale();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./super_sale.php">View Super Sale
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
                        <h3 class="mb-4 text-center htext">Update Super Sale</h3>

                        <?php
                        $query = mysqli_query($conn, "select * from super_sale where 
                        super_sale_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>


                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="input1" class="form-label">Offer<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" name="offer" id="offer" value="<?php echo $fetch['offer'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Start Date<span class="errorindicator">*</span></label>
                                <input type="date" class="form-control" name="start_date" id="start_date" value="<?php echo $fetch['start_date'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Start Time<span class="errorindicator">*</span></label>
                                <input type="time" class="form-control" name="star_time" id="star_time" step="1" value="<?php echo $fetch['start_time'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> End Date<span class="errorindicator">*</span></label>
                                <input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo $fetch['end_date'] ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> End Time<span class="errorindicator">*</span></label>
                                <input type="time" class="form-control" name="end_time" id="end_time" step="1" value="<?php echo $fetch['end_time'] ?>">
                                <input type="hidden" name="saleId" value="<?php echo $fetch['super_sale_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-sale" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-sale" class="btn btn-primary px-4 submit d-none">Submit</button>
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
<script src="./assets/api/supersale.js"></script>



<script>
document.addEventListener("DOMContentLoaded", function () {
    const today = new Date().toISOString().split('T')[0];
    const startDate = document.getElementById("start_date");
    const endDate = document.getElementById("end_date");

    startDate.setAttribute("min", today);
    endDate.setAttribute("min", today);

    startDate.addEventListener("change", function () {
        endDate.setAttribute("min", this.value);
    });
});
</script>