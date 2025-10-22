<?php
include 'includes/header.php';
include './functions/quoteAddonFunctions.php';

if (isset($_POST['submit_form'])) {
    addAddon();
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./assignedUserProjects.php">Back
                        </li>
                        </a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Add Excess Quotation</h3>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM questionnaire WHERE 
                        que_id='" . $_GET['queId'] . "'");
                        $fetch = mysqli_fetch_array($query);
                        ?>
                        <form class="row form_new" id="submitForm" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Questionnaire Id<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="questionnaire" id="queId"
                                    value="<?php echo $fetch['que_id']; ?>" readonly>
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Customer Id<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="customer" id="custId" readonly
                                    value="<?php echo $fetch['customer_id']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input5" class="form-label"> Project Name<span class="errorindicator">*</span></label>
                                <!-- <input type="text" class="form-control" readonly name="project" id="projName"
                                    value="<?php echo "VOYD0" . $fetch['customer_id'] . "-" . $fetch['property'] . "(" . $fetch['property_type'] . ")-" . $fetch['que_id'] ?>"> -->

                                    <input type="text" class="form-control" readonly name="project" id="projName"
    value="<?php 
        if (!empty($fetch['customer_id']) && !empty($fetch['property']) && !empty($fetch['property_type']) && !empty($fetch['que_id'])) {
            echo "VOYD0" . $fetch['customer_id'] . "-" . $fetch['property'] . "(" . $fetch['property_type'] . ")-" . $fetch['que_id'];
        } else {
            echo "";
        }
    ?>">




                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Customer Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" readonly name="name" id="custName"
                                    value="<?php echo $fetch['first_name'] . " " . $fetch['last_name']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input6" class="form-label"> Project Class<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="class" readonly id="projClass"
                                    value="<?php echo $fetch['product_classification'] . "&" . $fetch['manufacturer_classification']; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Vendor Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="Vendorname" id="venName">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input2" class="form-label"> Product Name<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="itemname" id="ItemName">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input3" class="form-label"> Product Code<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="code" id="ItemCode">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Quantity<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="quantity" id="quant">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input5" class="form-label"> Cost<span class="errorindicator">*</span></label>
                                <input type="text" class="form-control" name="itemCost" id="cost">
                                <p id="errText" class="error-text"></p>
                            </div>


                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-Addon"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-Addon"
                                        class="btn btn-primary px-4 submit d-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!--end row-->
        <div class="">
            <div class="card-body new_card mt-4">
                <div class="row" style="padding: 0px 10px;">
                    <div class="table-responsive pt-3">
                        <table class="table table-striped table-bordered" id="example2">
                            <thead>
                                <tr class="tableheadingrow">
                                    <th scope=" col">S.No</th>
                                    <th scope="col">Questionnaire Id</th>
                                    <th scope="col">Customer Id</th>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Customer Name</th>
                                    
                                    <th scope="col">Project Class</th>
                                    <th scope="col">Vendor Name</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Code</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Invoice</th>
                                    <!-- <th scope="col">Changed By</th>
                                    <th scope="col">Changed On</th> -->
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sel = mysqli_query($conn, "SELECT * FROM quotation_addon WHERE que_id='" . $_GET['queId'] . "' AND status=1");
                                $i = 1;

                                while ($fetch = mysqli_fetch_array($sel)) {
                                ?>

                                <tr>
                                    <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                    <td><?php echo $fetch['que_id']; ?></td>
                                    <td><?php echo $fetch['customer_id'] ?></td>
                                    <td><?php echo $fetch['customer_name'] ?></td>
                                    <td><?php echo $fetch['project_name'] ?></td>
                                    <td><?php echo $fetch['project_class'] ?></td>
                                    <td><?php echo $fetch['vendor_name'] ?></td>
                                    <td><?php echo $fetch['item_name'] ?></td>
                                    <td><?php echo $fetch['item_code'] ?></td>
                                    <td><?php echo $fetch['quantity'] ?></td>
                                    <!-- <td><?php echo $fetch['updated_by'] ?></td>
                                    <td><?php echo $fetch['updated_At'] ?></td> -->

                                      <td ><a style="font-size: 25px; display: flex; justify-content: center;"  href="addons-quotation.php?queId=<?php echo $fetch['que_id'] ?>&cusId=<?php echo $fetch['customer_id'] ?>"> <i
                            class='bx bx-show '></i> </a>
                                                </td>

                                    <td class="actionbuttons">
                                        <a class="iedit" href="./edit-addon.php?id=<?php echo $fetch['addon_id']; ?>"><i
                                                class='bx bx-edit'></i></a>
                                        <a class="idelete"
                                            href="./delete-addon.php?id=<?php echo $fetch['addon_id']; ?>"><i
                                                class='bx bx-trash'></i></a>
                                    </td>


                                </tr>
                                <?php $i++;
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="./assets/api/quoteAddonapi.js"></script>

<!-- <script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script> -->
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: [  {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+1))'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+1))'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+1))'
                }
            }]
        });

        $('#example2_filter input[type="search"]').attr('placeholder', 'Search....');

        $('#example2_filter input[type="search"]').on('input', function () {
        this.value = this.value.trim();
    });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
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

  
    capitalizeFirstLetter("venName");
    capitalizeFirstLetter("ItemName");

 
});
</script>




