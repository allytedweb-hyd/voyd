<?php
include 'includes/header.php';
include './functions/goodplanFunctions.php';

if (isset($_POST['submit_form'])) {

    addGoodplan();
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
                        <h3 class="mb-4 text-center htext">Add Good Plan</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="input1" class="form-label"> Maker Classification<span class="errorindicator">*</span></label>


                                 <select class="form-select" name="maker_classification" id="maker_classification" onchange="fetchMakerImage()">

                                <option value="">
Select
                                </option>

                                  <?php
                                $querytestimonial = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
                                  while ($fetchTestimonials = mysqli_fetch_array($querytestimonial)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonials['classification_id'] ?>">
                                        <?php echo $fetchTestimonials['classification'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>


                                
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="input2" class="form-label"> Maker Icon<span class="errorindicator">*</span></label>
                                <!-- <input type="file" class="form-control" name="maker_icon" id="maker_icon"> -->
                               <input type="hidden" name="maker_icon" id="maker_icon_default">
                                <div id="maker_icon_container"></div>

                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Maker Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="maker_text" id="maker_text" value="<?php echo isset($_POST['maker_text']) ? htmlspecialchars($_POST['maker_text']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                              <div class="col-md-12">
                                <label for="input1" class="form-label"> Material Classification<span class="errorindicator">*</span></label>


                                 <select class="form-select" name="material_classification" id="material_classification" onchange="fetchMaterialImage()">

                                <option value="">
Select
                                </option>

                                  <?php
                                $querytestimonialss = mysqli_query($conn, "SELECT * FROM classification WHERE status=1");
                                  while ($fetchTestimonialss = mysqli_fetch_array($querytestimonialss)) {
                                    ?>
                                    <option value="<?php echo $fetchTestimonialss['classification_id'] ?>">
                                        <?php echo $fetchTestimonialss['classification'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>


                                
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="input2" class="form-label"> Material Icon<span class="errorindicator">*</span></label>
                                <!-- <input type="file" class="form-control" name="material_icon" id="material_icon"> -->
                               <input type="hidden" name="material_icon" id="material_icon_default">
                                 <div id="material_icon_container"></div>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Material Text<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="material_text" id="material_text" value="<?php echo isset($_POST['material_text']) ? htmlspecialchars($_POST['material_text']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-12">
                                <label for="input3" class="form-label"> Project Cost<span class="errorindicator">*</span><span class="requiredtext"> (ex.1.2 , 0.45 lakhs)</span></label>
                                <input type="text" class="form-control" name="project_cost" id="project_cost" value="<?php echo isset($_POST['project_cost']) ? htmlspecialchars($_POST['project_cost']) : ''; ?>">
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



