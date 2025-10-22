<?php
include 'includes/header.php';
include 'includes/db.php';
// include './utils/alerts.php';
include './ajax.php';
include './functions/assignProjectFunction.php';
// $Select_Product = mysqli_real_escape_string($conn, $_POST['filterval']);
// echo $Select_Product;
// exit();

// $que_id = $_COOKIE['queId'];


// $getQuote = mysqli_query($conn, "SELECT * FROM questionnaire T1, quotation T2 WHERE T1.que_id = T2.que_id AND T1.que_id='" . $que_id . "' AND T1.status=1");
// $getQuoteRes = mysqli_fetch_array($getQuote);
// $vendorClass = $getQuoteRes['manufacturer_classification'];
$que_id = isset($_COOKIE['queId']) ? $_COOKIE['queId'] : null;

if ($que_id) {
    $getQuote = mysqli_query($conn, "SELECT * FROM questionnaire T1, quotation T2 WHERE T1.que_id = T2.que_id AND T1.que_id='" . $que_id . "' AND T1.status=1");

    if ($getQuote && mysqli_num_rows($getQuote) > 0) {
        $getQuoteRes = mysqli_fetch_array($getQuote);
        $vendorClass = $getQuoteRes['manufacturer_classification'];
    } else {
        $vendorClass = null;
    }
} else {
    $vendorClass = null;
}

$queryprojectUser = mysqli_query($conn, "SELECT * FROM login_admin WHERE admin_designation='project user' && status=1");


if (isset($_POST['assign_btn'])) {
    assignProject($que_id);
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
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">

                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Request A Quote</h3>
                        <div class="row" style="padding: 0px 10px;">


                            <div class="filters col-md-2">
                                <select class="form-select" id="filter" name="filterval"
                                    onChange="filtervalue(this.value)">
                                    <option value="">Select</option>
                                    <option value="All">All</option>
                                    <option value="Freeze">Freeze</option>
                                    <option value="Start">Start</option>

                                </select>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope="col">S.No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Project Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile Number</th>
                                            <th scope="col">State</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Locality</th>
                                            <th scope="col">Street</th>
                                            <th scope="col">Quote Id</th>
                                            <!-- <th scope="col">Map Link</th> -->
                                            <th scope="col">Property</th>
                                            <th scope="col">Property Type</th>
                                            <th scope="col">Property Location</th>
                                            <th scope="col">Budget</th>
                                            <th scope="col">Product Classification</th>
                                            <th scope="col">Manufacturer Classification</th>
                                            <th scope="col" id="assignedVendor">Vendor </th>
                                            <th scope="col" id="assignedProjectUser">Project user</th>
                                            <th scope="col" id="projectStartdate">Start Date</th>
                                            <th scope="col" id="projectDeadlineHeader">Deadline</th>
                                            <th scope="col" id="projectInvoicesShow">Invoice</th>
                                            <th scope="col">Action</th>
                                            <th scope="col" id="projectStatus">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="quote-table-data">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end row-->

    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Assign Project</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onclick="handlePopupClose()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="assignProjectForm">
                    <div class="form-group">
                        <!-- <input type="text" name="vendorClass" value="" id="vendorClassInput" class="form-control" /> -->
                        <label for="projectUsers" class="control-label">Project User:</label>


                        <select class="form-select" style="border:1px solid !important;" name="projectUser" size="1" id="projectUsers">
                            <!-- <option value="">Select</option> -->
                            <!-- <?php

                            // $getuser = mysqli_qury($conn,"SELECT * FROM login_admin WHERE status=2")

                            // while ($getuserdetails = mysqli_fetch_array($getuser)) {
                            ?>
                            <!-- <option value="<?php echo $getuserdetails['admin_name'] ?>">
                                <?php echo $getuserdetails['admin_name'] ?></option> -->
                            <?php
                            // }
                            ?> -->
                              <option value="">Select</option>
    <?php

    $getrole = mysqli_query($conn,"SELECT * FROM admin_roles WHERE role_id=3 AND status=1");
    $getroledetails = mysqli_fetch_array( $getrole );

    $getuser = mysqli_query($conn, "SELECT * FROM login_admin WHERE role_id='".$getroledetails['role_id']."' AND status=2");

   
    if ($getuser) {
        while ($getuserdetails = mysqli_fetch_array($getuser)) {
            ?>
            <option value="<?php echo htmlspecialchars($getuserdetails['admin_name']); ?>">
                <?php echo htmlspecialchars($getuserdetails['admin_name']); ?>
            </option>
            <?php
        }
    } else {
  
        echo '<option value="">Error loading users</option>';
 
    }
    ?>
                        </select>
                       <p id="projectUserError" class="error-text text-danger"></p>

                    </div>

                    <div class="form-group">
                        <label for="classVendors" class="control-label">Vendor Name:</label>


                        <select class="form-select" style="border:1px solid !important;" name="vendor" size="1" id="classVendors">
                            <option value="">Select</option>
                            <?php
                            $getVendor = mysqli_query($conn, "SELECT * FROM vendor WHERE  status=2");
                            while ($fetchProjectUser = mysqli_fetch_array($getVendor)) {
                            ?>
                            <option
                                value="<?php echo $fetchProjectUser['vendor_firstname'] . " " . $fetchProjectUser['vendor_lastname'] ?>">
                                <?php echo $fetchProjectUser['vendor_firstname'] . " " . $fetchProjectUser['vendor_lastname'] ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                        <p id="vendorError" class="error-text text-danger"></p>
                    </div>

                           <div class="form-group">
                        <label for="" class="control-label">Project Start-Date:</label>
                        <input type="date" id="projectStartInput" style="border:1px solid !important;" class="form-control" name="startDate" />
                        <p id="endStartError" class="error-text text-danger"></p>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Project End-Date:</label>
                        <input type="date" id="projectDeadline" style="border:1px solid !important;" class="form-control" name="endDate" />
                        <p id="endDateError" class="error-text text-danger"></p>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-primary px-4 submit" name="assign_btn">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
$("#assignProjectForm").on("submit", function (e) {
    let isValid = true;

    $("#projectUserError").text("");
    $("#vendorError").text("");
    $("#endDateError").text("");
    $("#endStartError").text("");

    const projectUser = $("#projectUsers").val().trim();
    const vendor = $("#classVendors").val().trim();
    const startDateVal = $("#projectStartInput").val().trim();
    const endDateVal = $("#projectDeadline").val().trim();

    const startDate = new Date(startDateVal);
    const endDate = new Date(endDateVal);
    const today = new Date();
    today.setHours(0, 0, 0, 0); 

    if (projectUser === "") {
        $("#projectUserError").text("Please select a Project User.");
        isValid = false;
    }

    if (vendor === "") {
        $("#vendorError").text("Please select a Vendor.");
        isValid = false;
    }

    if (startDateVal === "") {
        $("#endStartError").text("Please select a start date.");
        isValid = false;
    } else if (startDate < today) {
        $("#endStartError").text("Start date cannot be in the past.");
        isValid = false;
    }

    if (endDateVal === "") {
        $("#endDateError").text("Please select an end date.");
        isValid = false;
    } else if (endDate < today) {
        $("#endDateError").text("End date cannot be in the past.");
        isValid = false;
    } else if (startDate > endDate) {
        $("#endStartError").text("Start date cannot be after end date.");
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
    }
});

</script>


<!-- <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script> -->

<!-- <script>
$(document).ready(function() {
    var table = $('#example2').DataTable({
        lengthChange: false,
        buttons: [  {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+2))'
                }
            },
           {
    extend: 'pdfHtml5',
    exportOptions: {
        columns: ':not(:nth-last-child(-n+2))'
    },
    orientation: 'landscape',
    pageSize: 'A3', 
    customize: function(doc) {
        doc.defaultStyle.fontSize = 8; 
        doc.styles.tableHeader.fontSize = 10;
        doc.content[1].table.widths = '*'.repeat(28).split(''); 
    }
},
           {
    extend: 'print',
    exportOptions: {
        columns: ':not(:nth-last-child(-n+2))'
    },
    customize: function (win) {
        $(win.document.body)
            .css('font-size', '10pt')
            .find('table')
            .addClass('compact')
            .css('font-size', 'inherit')
            .css('width', '100%')
            .css('table-layout', 'fixed'); 

        $(win.document.body).find('table thead th').css('word-break', 'break-word');
    }
}

        ]
    });

    $('#example2_filter input[type="search"]').on('input', function () {
        this.value = this.value.trimStart();
    });

    table.buttons().container()
        .appendTo('#example2_wrapper .col-md-6:eq(0)');
});
</script> -->


<script>
function initializeTable() {
    // Destroy existing DataTable if exists
    if ($.fn.DataTable.isDataTable("#example2")) {
        $('#example2').DataTable().destroy();
        $('#example2').empty(); // Optional: clear the table
    }

    $('#example2').DataTable({
        dom: 'Bfrtip', // include buttons
        lengthChange: false,
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+2))'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+2))'
                },
                orientation: 'landscape',
                pageSize: 'A3',
                customize: function (doc) {
                    doc.defaultStyle.fontSize = 8;
                    doc.styles.tableHeader.fontSize = 10;
                    // Correct way to set widths
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+2))'
                },
                customize: function (win) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit')
                        .css('width', '100%')
                        .css('table-layout', 'fixed');

                    $(win.document.body).find('table thead th').css('word-break', 'break-word');
                }
            }
        ],
        initComplete: function () {
            this.api().buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        }
    });
}
</script>



<script>
$(document).ready(function() {
    $('#assignedVendor').hide();
    $('#assignedProjectUser').hide();
    $('#projectDeadlineHeader').hide();
    $('#projectInvoicesShow').show();
    $('#projectStartdate').hide();
    $('#projectStatus').hide();
})

function filtervalue() {
    var val = $("#filter").val();
    console.log("filter val is===", val)
    if (val == "All" || val == "") {
        $('#assignedVendor').hide();
        $('#assignedProjectUser').hide();
        $('#projectDeadlineHeader').hide();
        $('#projectInvoicesShow').show();
        $('#projectStartdate').hide();
        $('#projectStatus').hide();
    } else {
        $('#assignedVendor').show();
        $('#assignedProjectUser').show();
        $('#projectDeadlineHeader').show();
        $('#projectInvoicesShow').show();
        $('#projectStartdate').show();
        $('#projectStatus').show();
    }
    $.ajax({
        type: "GET",
        url: "ajax.php",
        data: {
            filter: val
        },
        success: function(result) {
            console.log("result", result);
            $(".quote-table-data").html(result);
            initializeTable();
        }
    })
}
</script>

<script>
onload
var val = $("#filter").val();
$.ajax({
    type: "GET",
    url: "ajax.php",
    data: {
        filter: val
    },
    success: function(result) {
        // console.log("result=====", result);
        $(".quote-table-data").html(result);
        initializeTable();
    }
})
</script>

<script>
function handlePopupClose() {
    $('#exampleModal').modal('hide')
}
</script>


<script>
$(document).on("click", ".unfreeze-btn", function () {
    const queId = $(this).data("id");

    if (!queId) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Invalid questionnaire ID',
        });
        return;
    }

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to unfreeze this item?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, unfreeze it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("./api/questionnaire/unfreeze.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ queId: queId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Unfroze!',
                        text: 'Questionnaire has been unfrozen.',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: data.message || 'Unknown error occurred.'
                    });
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Check console for details.'
                });
            });
        }
    });
});


</script>
