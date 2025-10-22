<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/element_masterFunctions.php';

if (isset($_POST['submit_form'])) {
    editElementMaster();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./element-master.php">View Interior Elements</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Elements</h3>

                        <?php
                        $query = mysqli_query($conn, "select * from element_master where 
                        element_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label class="form-label"> Property Block<span class="errorindicator">*</span></label>
                                <select class="form-select" name="property_block" size="1" id="eleBlock">
                                    <!-- <?php
                                    $blockid = mysqli_query($conn, "select * from property_sections where section_id='" . $fetch['property_block'] . "'");
                                    $blockname = mysqli_fetch_array($blockid);
                                    ?>
                                    <option><?php echo $blockname['enter_section'] ?></option>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM property_sections WHERE status=1");
                                    while ($fetchCat = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $fetchCat['section_id'] ?>"><?php echo $fetchCat['enter_section'] ?></option>
                                    <?php
                                    }
                                    ?> -->

<?php
    $selectedId = $fetch['property_block'];
    $blocks = mysqli_query($conn, "SELECT * FROM property_sections WHERE status = 1");

    while ($row = mysqli_fetch_array($blocks)) {
        $selected = ($row['section_id'] == $selectedId) ? 'selected' : '';
        echo '<option value="' . htmlspecialchars($row['section_id']) . '" ' . $selected . '>' . htmlspecialchars($row['enter_section']) . '</option>';
    }
    ?>


                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Enter Element<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="element" id="eleName" value="<?php echo $fetch['element_name'] ?>">
                                <input type="hidden" name="elementId" value="<?php echo $fetch['element_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="addEleMaster"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submitEleMaster"
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
<script src="./assets/api/elementsMasterApi.js"></script>