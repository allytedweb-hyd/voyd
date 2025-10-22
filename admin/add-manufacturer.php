<?php
include 'includes/header.php';
include './functions/manufacturerFunctions.php';

if(isset($_POST['submit_form'])) {
    addManufacturer();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./manufacturer.php">View
                                Manufacturer</li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Add Manufacturer</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input4" class="form-label"> Email<span class="errorindicator">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Contact Number-1<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="Phone" name="Phone" value="<?php echo isset($_POST['Phone']) ? htmlspecialchars($_POST['Phone']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Contact Number-2<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="Phone1" name="Phone1" value="<?php echo isset($_POST['Phone1']) ? htmlspecialchars($_POST['Phone1']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Aadhar Number<span class="errorindicator">*</span></label>
                                <input type="number" class="form-control" id="aadhar" name="aadhar" value="<?php echo isset($_POST['aadhar']) ? htmlspecialchars($_POST['aadhar']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Website Url<span class="errorindicator">*</span></label>
                                <input type="Text" class="form-control" id="website" name="website" value="<?php echo isset($_POST['website']) ? htmlspecialchars($_POST['website']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Store Location<span class="errorindicator">*</span></label>
                                <input type="Text" class="form-control" id="location" name="location" value="<?php echo isset($_POST['location']) ? htmlspecialchars($_POST['location']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> GST Number<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" id="gstnumber" name="gstnumber" value="<?php echo isset($_POST['gstnumber']) ? htmlspecialchars($_POST['gstnumber']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Select Product Type<span class="errorindicator">*</span></label>
                                <select class="form-select" name="productType" size="1" id="manuproducType" onChange="productTypevalue()">
                                    <option value="">Select Product Type</option>
                                    <?php
                                    $query=mysqli_query($conn,"SELECT * FROM product_type WHERE status=1");
                                    while($fetch=mysqli_fetch_array($query)){
                                    ?>
                                    <option 
                                    value="<?php echo $fetch['productType_id'] ?>" <?php echo (isset($_POST['productType']) && $_POST['productType'] == $fetch['productType_id']) ? 'selected' : ''; ?>
                                    >
                                        <?php echo $fetch['enter_productType'] ?></option>
                                    <?php
                                     }
                                     ?>

                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Select Class<span class="errorindicator">*</span></label>
                                <select class="form-select" name="class" size="1" id="class" onChange="McategoryValue()">
                                    <option value="">Select Class</option>
                                    <?php
                                    $query=mysqli_query($conn,"SELECT * FROM manufacturer_category WHERE status=1");
                                    while($fetch=mysqli_fetch_array($query)){
                                    ?>
                                    <option 
                                    value="<?php echo $fetch['mcategory_id'] ?>" <?php echo (isset($_POST['class']) && $_POST['class'] == $fetch['mcategory_id']) ? 'selected' : ''; ?>
                                    >
                                        <?php echo $fetch['category_name'] ?></option>
                                    <?php
                                    }
                                     ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Select Characteristics<span class="errorindicator">*</span></label>
                                <select class="form-select" name="characteristics" size="1" id="characteristics" onChange="MsubcategoryValue()">
                                    <option value="">Select Characteristics</option>
                                    <?php
                                    $query=mysqli_query($conn,"SELECT * FROM manufacturer_subCategory WHERE status=1");
                                    while($fetch=mysqli_fetch_array($query)){
                                    ?>
                                    <option 
                                    value="<?php echo $fetch['mSubcategory_id'] ?>" <?php echo (isset($_POST['characteristics']) && $_POST['characteristics'] == $fetch['mSubcategory_id']) ? 'selected' : ''; ?>
                                    >
                                        <?php echo $fetch['sub_category'] ?></option>
                                    <?php
                                    }
                                     ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Select Attributes<span class="errorindicator">*</span></label>
                                <select class="form-select" name="attributes" size="1" id="attributes" onChange="attributeValue()">
                                    <option value="">Select Attributes</option>
                                    <?php
                                    $query=mysqli_query($conn,"SELECT * FROM attributes WHERE status=1");
                                    while($fetch=mysqli_fetch_array($query)){
                                    ?>
                                    <option 
                                    value="<?php echo $fetch['attribute_id'] ?>" <?php echo (isset($_POST['attributes']) && $_POST['attributes'] == $fetch['attribute_id']) ? 'selected' : ''; ?>
                                    >
                                        <?php echo $fetch['attributes'] ?></option>
                                    <?php
                                    }
                                     ?>
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"> Select Values<span class="errorindicator">*</span></label>
                                <select class="form-select" name="values" size="1" id="manuvalue">
                                    <option value="">Select value</option>
                                    
                                </select>
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-12">
                                <label for="input4" class="form-label"> Address<span class="errorindicator">*</span></label>
                                <textarea id="editor" name="address"><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-manufacturer"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-manufacturer"
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
<script src="./assets/api/manufacturerapi.js"></script>

<script>
    function productTypevalue(){
        var val = $("#manuproducType").val();
        console.log('product type val----------',val);
        $.ajax({
    type: "POST",
    url: "ajax.php",
    data: {
        id:val
    },
    success: function(result){
        console.log(result);
        document.getElementById('class').innerHTML = result;
    }
})
    }
</script>

<script>
    function McategoryValue(){
        var val = $("#class").val();
        console.log('category val------',val);
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                id1:val
            },
            success: function(result){
        console.log(result);
        document.getElementById('characteristics').innerHTML = result;
    }
        })
    }
</script>

<script>
    function MsubcategoryValue(){
        var val = $("#characteristics").val();
        console.log('subcategory val-----',val);
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                id2:val
            },
            success: function(result){
                console.log(result);
                document.getElementById('attributes').innerHTML = result;
            }
        })
    }
</script>

<script>
    // function attributeValue(){
    //     var val = $("#attributes").val();
    //     console.log('attribute val-----',val);
    //     $.ajax({
    //         type: "POST",
    //         url: "ajax.php",
    //         data: {
    //             id3:val
    //         },
    //         success: function(result){
    //             console.log(result);
    //             document.getElementById('manuvalue').innerHTML = result;
    //         }
    //     })
    // }

//     function attributeValue() {
//     $('#add-manufacturer').prop('disabled', true); 

//     var val = $("#attributes").val();

//     $.ajax({
//         type: "POST",
//         url: "ajax.php",
//         data: { id3: val },
//         success: function (result) {
//             $('#attributes').html(result);
//             $('#add-manufacturer').prop('disabled', false); 
//         }
//     });
// }

function attributeValue() {
    $('#add-manufacturer').prop('disabled', true); 

    var val = $("#attributes").val();

    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: { id3: val },
        success: function (result) {
            $('#manuvalue').html(result);
            $('#add-manufacturer').prop('disabled', false); 
        }
    });
}





</script>

<script>
$('#editor').summernote({
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

  
    capitalizeFirstLetter("name");
  

 
});
</script>