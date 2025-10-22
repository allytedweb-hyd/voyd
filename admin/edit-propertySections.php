<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/property_SectionFunctions.php';

if (isset($_POST['submit_form'])) {
    editPropertySection();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./propertySections.php">View Property Blocks</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Update Property Blocks</h3>

                        <?php
                        $query = mysqli_query($conn, "select * from property_sections where 
                        section_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>

                        <form class="row form_new" method="post" enctype="multipart/form-data">
                        <!-- <div class="col-md-12">
                                <label class="form-label">Select Property</label>
                                <select class="form-control" id="property" name="property">
                                <option><php echo $fetch['property_name'] ?></option>
                                <php
                                    $query=mysqli_query($conn,"SELECT * FROM property WHERE status=1");
                                    while($fetchsect=mysqli_fetch_array($query)){
                                    ?>
                                    <option value="<php echo $fetchsect['enter_property'] ?>"><php echo $fetchsect['enter_property'] ?></option>
                                    <php
                                     }
                                     ?>
                                </select>
                            </div> -->

                            <!-- <div class="col-md-12">
                                <label class="form-label">Select Property Type</label>
                                <select class="form-select" name="propertyType" size="1" id="propertyType">
                                <option><php echo $fetch['property_Type'] ?></option>
                                <php
                                    $query=mysqli_query($conn,"SELECT * FROM property_type WHERE status=1");
                                    while($fetchType=mysqli_fetch_array($query)){
                                    ?>
                                    <option value="<php echo $fetchType['property_Type'] ?>"><php echo $fetchType['property_Type'] ?></option>
                                    <php
                                     }
                                     ?>
                                </select>
                                <p id="errText"></p>
                            </div> -->

                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Enter Property Block<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="propertySection" id="PropertySection" value="<?php echo $fetch['enter_section'] ?>">
                                <input type="hidden" name="propertySectionId" value="<?php echo $fetch['section_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Image<span class="errorindicator">*</span> </label>
                                <input type="file" class="form-control" name="image" id="image">
                                <img src="./Uploads/propertyblock/<?php echo $fetch['image'] ?>" width="100" height="80" />
                                <input type="hidden" name="oldImage" value="<?php echo $fetch['image'] ?>" />
                             
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Image Alt Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="alt_text" id="alt_text" value="<?php echo $fetch['alt_text']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" id="add-propertySections"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-propertySections"
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
<script src="./assets/api/propertySectionapi.js"></script>