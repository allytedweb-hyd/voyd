<?php
include 'includes/header.php';
include './functions/goodplanFunctions.php';

if (isset($_POST['submit_form'])) {

    editGoodplan();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./good_plans.php">View
                                Good Plans
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
                        <h3 class="mb-4 text-center htext">Update Good Plan</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Maker Classification<span class="errorindicator">*</span></label>

                                <?php
                        $query = mysqli_query($conn, "select * from good_plans where 
                        good_plan_id='" . $_GET['id'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>


<?php

$query = mysqli_query($conn, "SELECT * FROM good_plans WHERE good_plan_id = '" . $_GET['id'] . "'");
$fetch = mysqli_fetch_array($query);


$selected_maker_classification = $fetch['maker_classification'];
$selected_material_classification = $fetch['material_classification'];
?>


                                 <select class="form-select" name="maker_classification" id="maker_classification" onchange="fetchMakerImage()">


                                  <!-- <?php $getmakerss = mysqli_query($conn, "SELECT * FROM classification WHERE classification_id='".$fetch['maker_classification']."'");

                                                $makerss= mysqli_fetch_array( $getmakerss);
                                                ?>


                                <option value="<?php echo $makerss['classification_id']; ?>">
<?php echo $makerss['classification']; ?>
                                </option>

                                  <?php
                                $querytestimonial = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
                                  while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonials['classification_id'] ?>">
                                        <?php echo $fetchTestimonials['classification'] ?></option>
                                    <?php
                                    }
                                    ?> -->

<?php
    $query = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
    while ($row = mysqli_fetch_array($query)) {
        $selected = ($row['classification_id'] == $fetch['maker_classification']) ? 'selected' : '';
        echo "<option value=\"{$row['classification_id']}\" $selected>{$row['classification']}</option>";
    }
    ?>






                                </select>


                                
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="input2" class="form-label"> Maker Icon<span class="errorindicator">*</span></label>
                              <div id="maker_icon_container">
                                <img src="./Uploads/classifications/<?php echo $fetch['maker_icon'] ?>" width="100" height="80" />
                            </div>
                            <input type="hidden" name="maker_icon" id="maker_icon_default" value="<?php echo $fetch['maker_icon']; ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Maker Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="maker_text" id="maker_text" value="<?php echo $fetch['maker_text']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                              <div class="col-md-12">
                                <label for="input1" class="form-label"> Material Classification<span class="errorindicator">*</span></label>


                                 <select class="form-select" name="material_classification" id="material_classification" onchange="fetchMaterialImage()">

                                 <!-- <?php $getmaker = mysqli_query($conn, "SELECT * FROM classification WHERE classification_id='".$fetch['material_classification']."'");

                                                $maker= mysqli_fetch_array( $getmaker);
                                                ?>

                                    <option value="<?php echo $maker['classification_id']; ?>">
<?php echo $maker['classification']; ?>
                                </option>

                                  <?php
                                $querytestimonialss = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
                                  while ($fetchTestimonialss = mysqli_fetch_array($querytestimonialss)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonialss['classification_id'] ?>">
                                        <?php echo $fetchTestimonialss['classification'] ?></option>
                                    <?php
                                    }
                                    ?> -->


    <?php
    $query = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
    while ($row = mysqli_fetch_array($query)) {
        $selected = ($row['classification_id'] == $fetch['material_classification']) ? 'selected' : '';
        echo "<option value=\"{$row['classification_id']}\" $selected>{$row['classification']}</option>";
    }
    ?>



                                </select>


                                
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="input2" class="form-label"> Material Icon<span class="errorindicator">*</span></label>
                                     <div id="material_icon_container">
                                <img src="./Uploads/classifications/<?php echo $fetch['material_icon'] ?>" width="100" height="80" />
                            </div>
                            <input type="hidden" name="material_icon" id="material_icon_default" value="<?php echo $fetch['material_icon']; ?>" />
                                
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Material Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="material_text" id="material_text" value="<?php echo $fetch['material_text']; ?>">
                                <input type="hidden" name="galleryId" value="<?php echo $fetch['good_plan_id'] ?>" />
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Project Cost<span class="errorindicator">*</span><span class="requiredtext"> (ex.1.2 , 0.45 lakhs)</span></label>
                                <input type="text" class="form-control" name="project_cost" id="project_cost" value="<?php echo $fetch['project_cost']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>



                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-gallery" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-gallery" class="btn btn-primary px-4 submit d-none">Submit</button>
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
<script src="./assets/api/goodplansapi.js"></script>



<script>
function fetchMakerImage() {
    const id = document.getElementById('maker_classification').value;
    if (!id) return;  

    fetch('get_classification_image.php?id=' + id)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                
                document.getElementById('maker_icon_container').innerHTML = '<img src="./Uploads/classifications/' + data.image_name + '" class="img-thumbnail" style="max-width:100px;">';
                
                document.getElementById('maker_icon_default').value = data.image_name;
            } else {
                document.getElementById('maker_icon_container').innerHTML = 'No image available.';
                document.getElementById('maker_icon_default').value = '';  
            }
        })
        .catch(error => console.error('Error fetching maker image:', error));
}

function fetchMaterialImage() {
    const id = document.getElementById('material_classification').value;
    if (!id) return;  

    fetch('get_classification_image.php?id=' + id)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                
                document.getElementById('material_icon_container').innerHTML = '<img src="./Uploads/classifications/' + data.image_name + '" class="img-thumbnail" style="max-width:100px;">';
               
                document.getElementById('material_icon_default').value = data.image_name;
            } else {
                document.getElementById('material_icon_container').innerHTML = 'No image available.';
                document.getElementById('material_icon_default').value = '';  
            }
        })
        .catch(error => console.error('Error fetching material image:', error));
}


</script>