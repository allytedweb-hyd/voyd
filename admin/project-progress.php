<?php
include 'includes/header.php';
include 'includes/db.php';

if (isset($_POST['submit_btnnn'])) {

    $Filters = mysqli_real_escape_string($conn, $_POST['filter']);

    $fquery = mysqli_query($conn, "SELECT * FROM questionnaire T1, quotation T2 WHERE T1.que_id = T2.que_id AND T1.status=1;");
    $fetch = mysqli_fetch_array($fquery);

    $Project = "VOYD0" . $fetch['customer_id'] . "-" . $fetch['property'] . "(" . $fetch['property_type'] . ")-" . $fetch['que_id'];
    $questionnaireid = $fetch['que_id'];
    $customerid = $fetch['customer_id'];
    $quoteid = $fetch['quotation_id'];

    $mquery = mysqli_query($conn, "INSERT into project_graph SET task_name='" . $Filters . "',questionnaire_id='" . $questionnaireid . "',customer_id='" . $customerid . "',project_name='" . $Project . "',quotation_id='" . $quoteid . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

    if ($mquery === true) {
        echo "<script>alert('success')</script>";
    } else {
        echo "<script>alert('failed')</script>";
    }
}

// if (isset($_POST['submit'])) {

//     $Percentage = mysqli_real_escape_string($conn, $_POST['percentage']);
//     $projectStatus =  mysqli_real_escape_string($conn, $_POST['projectStatus']);
//     $projectSubStatus =  mysqli_real_escape_string($conn, $_POST['projectSubStatus']);
//     $getdata = mysqli_real_escape_string($conn, $_POST['charttask']);




//     $query = mysqli_query($conn, "UPDATE project_graph SET percentage='" . $Percentage . "', description='" . $Description . "' WHERE graph_id='" . $getdata . "' ");
//     if ($query === true) {
//         echo "<script>alert('success')</script>";
//     } else {
//         echo "<script>alert('failed')</script>";
//     }
// }

?>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Forms</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="./index.php"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="questionnaire_form.php">Request
                                A Quote</li></a>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->


        <section id="projectdetails">
            <div class="container">
                <div class="col-md-8 project">
                    <div class="card status">
                        <div class="card-body p-4 pstatus">
                            <h3 class="mb-4 projecttext mt-4">Project Details</h3>
                            <div class="progess-project">
                                <div class="col-md-12">
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM questionnaire T1, quotation T2 WHERE T1.que_id = T2.que_id AND T1.status=1");
                                    $fetchcus = mysqli_fetch_array($query);
                                    ?>
                                    <div class="project-details">
                                        <div class="project name">
                                            <h6 class="d-flex justify-content-between">Project Name <span class="">:</span></h6>
                                            <h6 class="d-flex justify-content-between">Quotation Id <span class="">:</span></h6>
                                            <h6 class="d-flex justify-content-between">Property <span class="">:</span></h6>
                                            <h6 class="d-flex justify-content-between">Property Type <span class="">:</span></h6>
                                            <h6 class="d-flex justify-content-between">Location <span class="">:</span></h6>
                                            <h6 class="d-flex justify-content-between">Product Classification <span class="">:</span></h6>
                                            <h6 class="d-flex justify-content-between">Manufacturer Classification <span class="">:</span></h6>
                                            <h6 class="d-flex justify-content-between">Project Budget <span class="">:</span> </h6> 
                                        </div>
                                        <div class="property ms-2">
                                            <p class="project">
                                                <?php echo "VOYD0" . $fetchcus['customer_id'] . "-" . $fetchcus['property'] . "(" . $fetchcus['property_type'] . ")-" . $fetchcus['que_id'] ?>
                                            </p>
                                          
<p class="project"><?php echo !empty($fetchcus['quotation_id']) ? $fetchcus['quotation_id'] : "No Data"; ?></p>
<p class="project"><?php echo !empty($fetchcus['property']) ? $fetchcus['property'] : "No Data"; ?></p>
<p class="project"><?php echo !empty($fetchcus['property_type']) ? $fetchcus['property_type'] : "No Data"; ?></p>
<p class="project"><?php echo !empty($fetchcus['property_location']) ? $fetchcus['property_location'] : "No Data"; ?></p>
<p class="project"><?php echo !empty($fetchcus['product_classification']) ? $fetchcus['product_classification'] : "No Data"; ?></p>
<p class="project"><?php echo !empty($fetchcus['manufacturer_classification']) ? $fetchcus['manufacturer_classification'] : "No Data"; ?></p>
<p class="project"><?php echo !empty($fetchcus['budget']) ? $fetchcus['budget'] : "No Data"; ?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- <hr /> -->

                            <!-- <div class="track text-center">
                                <h6>Click the Start button to start the process of your project.</h6>
                                <h6>You can track your project in project progress.</h6>
                                <button type="button" class="btn btn-success mt-3" id="btnStart">Start</a></button>
                            </div> -->

                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="projectstatus">
            <div class="container">
                <div class="projectstat">
                    <div class="card status">
                        <div class="card-body p-4 pstatus">
                            <div class=projecttext>
                                <!-- <button class="statusback" id="btnback">Back</button> -->
                                <h3 class="mb-4 projecttext text-center">Project Status</h3>
                                <form method="post" enctype="multipart/form-data">
                                    <!-- <div class="filterbutton"> -->
                                    <div class="filters chart">
                                        <!-- <select class="form-select" id="Cfilter" name="filter" onChange="Taskfilter()">
                                            <option value="">Select</option>
                                            <?php
                                            $query = mysqli_query($conn, "SELECT * FROM task_master WHERE status=1");
                                            while ($fetch = mysqli_fetch_array($query)) {
                                            ?>
                                            <option value="<?php echo $fetch['task_id'] ?>">
                                                <?php echo $fetch['task_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select> -->
                                       <select class="form-select" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" id="taskDropdown" onchange="loadTaskPercentage(this.value)">
    <option value="">Select Task</option>
    <option value="false_ceiling">False Ceiling</option>
    <option value="elec_light">Elec & Light</option>
    <option value="sanitary">Sanitary</option>
    <option value="wardrobes">Wardrobes</option>
    <option value="wall_putty">Wall Putty</option>
    <option value="painting">Painting</option>
</select>


                                    </div>

                                    <!-- <div class="col-md-12">
                                        <div class="d-md-flex d-grid gap-3 pbutton">
                                            <button type="submit" name="submit_btnnn" class="btn btn-info px-4 submit">Submit</button>
                                        </div>
                                    </div> -->
                                    <!-- </div> -->
                                </form>

                            </div>

                            <?php
                            $sel = mysqli_query($conn, "SELECT * FROM project_graph WHERE questionnaire_id='" . $_GET['id'] . "'&& status=1");
                            $fetch = mysqli_fetch_array($sel)
                            ?>

                            <div class="piechartt col-md-12 d-flex flex-row">


                                <div id="chart" class="col-md-6">
                                </div>


                                <div class="graphtext col-md-6">
                                    <form method="POST" enctype="multipart/form-data">
                                        <h4 id="task_name"></h4>

                                        <div class="col-md-12">
                                            <label for="projectPercentage" class="form-label">Percentage</label>
                                            <input type="text" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="percentage"
                                                id="projectPercentage" placeholder="Enter Percentage" readonly>
                                        </div>

                                        <!-- <div class="col-md-12">
                                            <label>Project Status</label>
                                            <select class="form-select" name="projectStatus">
                                                <option value="">Select</option>
                                                <?php

                                                $getQuery = mysqli_query($conn, "SELECT * FROM tbl_status_master WHERE status=1");
                                                while ($result = mysqli_fetch_array($getQuery)) {
                                                ?>
                                                <option value="<?php echo $result['status_master'] ?>">
                                                    <?php echo $result['status_master'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div> -->

                                        <?php
$queId = $_GET['id'] ?? null;
$projectSubStatus = '';

if ($queId) {
    $statusQuery = mysqli_query($conn, "
        SELECT T2.project_sub_status 
        FROM questionnaire T1 
        JOIN quotation T2 ON T1.que_id = T2.que_id 
        WHERE T1.que_id = '$queId' AND T1.status = 1
    ");
if ($statusQuery && mysqli_num_rows($statusQuery) > 0) {
    $row = mysqli_fetch_assoc($statusQuery);
    $projectSubStatus = strip_tags($row['project_sub_status']); 
}
}
?>


                             <div class="col-md-12">
    <label for="projectSubStatus">Project Sub-Status</label>
    <input type="text" 
           class="form-control" 
           id="taskStatus" 
           name="taskStatus" 
           style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;"
           value="<?php echo htmlspecialchars(strip_tags($projectSubStatus)); ?>" 
           readonly>
</div>

<?php

$getreason = mysqli_query($conn,"SELECT manager_reason FROM quotation WHERE que_id = '".$_GET['id']."'");

$Reasondata = mysqli_fetch_array($getreason);

?>

       <div class="col-md-12">
    <label for="projectSubStatus">Reason</label>
    <div
           class="form-control" 
          
         
           style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important; height: fit-content;
    line-height: 20px;"
           
           ><?php echo !empty($Reasondata['manager_reason']) 
                ? ($Reasondata['manager_reason'])
                : 'No reason provided.';  ?></div>
</div>




                                        <!-- <div class="col-md-12">
                                            <label>Project Sub-Status</label>
                                            <select class="form-select" name="projectSubStatus">
                                                <option value="">Select</option>
                                                <?php
                                                $getStatus = mysqli_query($conn, "SELECT * FROM tbl_status_master WHERE status_master='" . $projectStatus . "' && status=1");
                                                $statusVal = mysqli_fetch_array($getStatus);
                                                $getSubStatus = mysqli_query($conn, "SELECT * FROM tbl_subStatus_master WHERE status_master= '" . $statusVal['status_master'] . "' && status=1");
                                                while ($subStatusRes = mysqli_fetch_array($getSubStatus)) {
                                                ?>
                                                    <option value="<?php echo $subStatusRes['sub_status_master'] ?>">
                                                        <?php echo $subStatusRes['sub_status_master'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div> -->

                                        <div class="col-md-12">
                                            <div class="d-md-flex d-grid align-items-center gap-3 mt-3">
                                                <button type="submit" name="submit" id="approveBtn"
                                                    class="btn btn-primary px-4 submit">Approve</button>

                                                    <button 
    type="button"
    class="btn btn-primary px-4 submit open-update-modal"  
    data-bs-toggle="modal" 
    data-bs-target="#statusUpdateModal"
    data-queid="<?php echo $_GET['id']; ?>"
>
    Update
</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>


        <!-- Modal -->
<div class="modal fade" id="statusUpdateModal" tabindex="-1" aria-labelledby="statusUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="statusUpdateForm" novalidate>
        <div class="modal-header">
          <h5 class="modal-title" id="statusUpdateModalLabel">Update Project Percentages</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body row">
  <input type="hidden" name="que_id" id="modal_que_id" value="" />

         <div class="col-md-6 mb-3">
  <label class="form-label">False Ceiling %</label>
  <input type="number" step="0.01" min="0" max="100" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="false_ceiling" placeholder="Enter %" />
</div>

        <div class="col-md-6 mb-3">
  <label class="form-label">False Ceiling Status</label>
  <input type="text" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="false_ceiling_status" placeholder="Enter Status" />
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">Electrical & Lighting %</label>
  <input type="number" step="0.01" min="0" max="100" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="electrical_lighting" placeholder="Enter %" />
</div>

    <div class="col-md-6 mb-3">
  <label class="form-label">Electrical & Lighting Status</label>
  <input type="text" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="electrical_lighting_status" placeholder="Enter Status" />
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">Sanitary %</label>
  <input type="number" step="0.01" min="0" max="100" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="sanitary" placeholder="Enter %" />
</div>

  <div class="col-md-6 mb-3">
  <label class="form-label">Sanitary Status</label>
  <input type="text" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="sanitary_status" placeholder="Enter Status" />
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">Wardrobes %</label>
  <input type="number" step="0.01" min="0" max="100" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="wardrobes" placeholder="Enter %" />
</div>

 <div class="col-md-6 mb-3">
  <label class="form-label">Wardrobes Status</label>
  <input type="text" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="wardrobes_status" placeholder="Enter Status" />
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">Wall Putty %</label>
  <input type="number" step="0.01" min="0" max="100" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="wall_putty" placeholder="Enter %" />
</div>

 <div class="col-md-6 mb-3">
  <label class="form-label">Wall Putty Status</label>
  <input type="text" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="wall_putty_status" placeholder="Enter Status" />
</div>



<div class="col-md-6 mb-3">
  <label class="form-label">Painting %</label>
  <input type="number" step="0.01" min="0" max="100" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="painting" placeholder="Enter %" />
</div>

 <div class="col-md-6 mb-3">
  <label class="form-label">Painting Status</label>
  <input type="text" class="form-control" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;" name="painting_status" placeholder="Enter Status" />
</div>



<div class="col-md-12 mb-3">
  <label class="form-label">Reason</label>
<textarea name="manager_reason" id="adesc"></textarea>
</div>

<button type="submit" id="projectSubStatusupdate" class="btn btn-primary px-4 submit">Update</button>

        </div>
      
      </form>
    </div>
  </div>
</div>





        <?php include 'includes/footer.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>




        <script>
        function Taskfilter() {
            var val = $("#Cfilter").val();
            console.log('Task Filter val----------', val);
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: {
                    task: val
                },
                success: function(result) {
                    console.log(result);
                    document.getElementById('task_name').innerHTML = result;
                }
            })
        }
        </script>



        <script>
        var options = {
            series: [0],
            chart: {
                type: 'radialBar',
                offsetY: -20,
                sparkline: {
                    enabled: true
                }
            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    track: {
                        background: "#e7e7e7",
                        strokeWidth: '97%',
                        margin: 5, 
                        dropShadow: {
                            enabled: true,
                            top: 2,
                            left: 0,
                            color: '#999',
                            opacity: 1,
                            blur: 2
                        }
                    },
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            offsetY: -2,
                            fontSize: '22px'
                        }
                    }
                }
            },
            grid: {
                padding: {
                    top: -10
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    shadeIntensity: 0.4,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 53, 91]
                },
            },
            labels: ['Average Results'],
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        </script>
        <script>
        function projectSubStatus() {
            var val = $("#category").val();
            console.log('product category val-----', val);
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: {
                    id4: val
                },
                success: function(result) {
                    console.log(result);
                    document.getElementById('subcategory').innerHTML = result;
                }
            })
        }
        </script>

       <!-- <script>
function loadTaskPercentage(taskKey) {
    const urlParams = new URLSearchParams(window.location.search);
    const queId = urlParams.get('id'); 

    if (!taskKey || !queId) return;

    $.ajax({
        type: "POST",
        url: "ajax.php", 
        data: {
            action: 'get_status_percentages',
            que_id: queId
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                const taskPercentage = parseFloat(response.data[taskKey]) || 0;
                console.log("Loaded Percentage:", taskPercentage);

                chart.updateSeries([taskPercentage]);
                $('#task_name').text(taskKey.replace(/_/g, " ").toUpperCase());
                $('#projectPercentage').val(taskPercentage); 
            } else {
                console.warn("No data found");
                chart.updateSeries([0]);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
            chart.updateSeries([0]);
        }
    });
}

</script> -->




<script>
function loadTaskPercentage(taskKey) {
    const urlParams = new URLSearchParams(window.location.search);
    const queId = urlParams.get('id'); 

    if (!taskKey || !queId) return;

    // Explicitly map task keys to their corresponding status fields
    const statusFieldMap = {
        false_ceiling: 'false_ceiling_status',
        elec_light: 'electrical_lighting_status',
        sanitary: 'sanitary_status',
        wardrobes: 'wardrobes_status',
        wall_putty: 'wall_putty_status',
        painting: 'painting_status'
    };

    const statusKey = statusFieldMap[taskKey];

    $.ajax({
        type: "POST",
        url: "ajax.php", 
        data: {
            action: 'get_status_percentages',
            que_id: queId
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                const data = response.data;

                const taskPercentage = parseFloat(data[taskKey]) || 0;
                const taskStatus = data[statusKey] || 'Not Set';

                chart.updateSeries([taskPercentage]);
                $('#task_name').text(taskKey.replace(/_/g, " ").toUpperCase());
                $('#projectPercentage').val(taskPercentage); 
                $('#taskStatus').val(taskStatus);  
            } else {
                chart.updateSeries([0]);
                $('#taskStatus').val('N/A');
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
            chart.updateSeries([0]);
            $('#taskStatus').val('Error');
        }
    });
}
</script>



<!-- <script>
$('#approveBtn').on('click', function(e) {
    e.preventDefault(); 

    const queId = new URLSearchParams(window.location.search).get('id');

    $.ajax({
        type: 'POST',
        url: 'ajax.php?id=' + queId,  
        data: {
            action: 'approve_status',
            approve_status: 'approved'
        },
        success: function(response) {
            const res = JSON.parse(response);
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Approved!',
                    text: 'Project approved successfully!',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Approval failed: ' + res.message,
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'AJAX Error',
                text: 'An error occurred while processing your request.',
                confirmButtonText: 'OK'
            });
        }
    });
});


</script> -->



<script>
    const customerId = "<?php echo isset($fetchcus['customer_id']) ? $fetchcus['customer_id'] : ''; ?>";
    console.log("id",customerId);
</script>

<script>
$('#approveBtn').on('click', function(e) {
    e.preventDefault();

    const queId = new URLSearchParams(window.location.search).get('id');

    $.ajax({
        type: 'POST',
        url: 'ajax.php?id=' + queId,
        data: {
            action: 'approve_status',
            approve_status: 'approved'
        },
        success: function(response) {
            const res = JSON.parse(response);
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Approved!',
                    text: 'Project approved successfully!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    
                    $.ajax({
                        type: 'POST',
                        url: 'update_rewards.php',
                        data: {
                            que_id: queId,
                            customer_id: customerId  
                        },
                        success: function(rewardResponse) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Rewards Updated',
                                text: 'Rewards updated successfully!',
                                confirmButtonText: 'OK'
                            });
                            console.log('Rewards updated:', rewardResponse);
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Reward Update Failed',
                                text: 'Failed to update rewards after approval.',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Approval failed: ' + res.message,
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'AJAX Error',
                text: 'An error occurred while processing your request.',
                confirmButtonText: 'OK'
            });
        }
    });
});

</script>

<script>
    $('#adesc').summernote({
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
$(document).on('click', '.open-update-modal', function () {
    const queId = $(this).data('queid');
    $('#modal_que_id').val(queId); // Set hidden input for que_id

    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: {
            action: 'get_status_percentages',
            que_id: queId
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                const data = response.data;

                // Populate all modal input fields
                $('input[name="false_ceiling"]').val(data.false_ceiling || 0);
                $('input[name="false_ceiling_status"]').val(data.false_ceiling_status || '');

                $('input[name="electrical_lighting"]').val(data.elec_light || 0);
                $('input[name="electrical_lighting_status"]').val(data.electrical_lighting_status || '');

                $('input[name="sanitary"]').val(data.sanitary || 0);
                $('input[name="sanitary_status"]').val(data.sanitary_status || '');

                $('input[name="wardrobes"]').val(data.wardrobes || 0);
                $('input[name="wardrobes_status"]').val(data.wardrobes_status || '');

                $('input[name="wall_putty"]').val(data.wall_putty || 0);
                $('input[name="wall_putty_status"]').val(data.wall_putty_status || '');

                $('input[name="painting"]').val(data.painting || 0);
                $('input[name="painting_status"]').val(data.painting_status || '');

                $('#adesc').summernote('code', data.manager_reason || '');
            } else {
                console.warn('No data found for this que_id');
            }
        },
        error: function () {
            console.error('Failed to fetch status data.');
        }
    });
});
</script>

<!-- <script>
$('#statusUpdateForm').on('submit', function (e) {
    e.preventDefault();

    const formData = $(this).serialize(); 

    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: formData + '&action=update_status_percentages',
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'Status updated successfully!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    $('#statusUpdateModal').modal('hide');
                    location.reload(); 
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed!',
                    text: response.message || 'Something went wrong.',
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'AJAX Error!',
                text: 'Failed to submit form. Please try again.',
            });
        }
    });
});
</script> -->



<script>
    $('#statusUpdateForm').on('submit', function (e) {
    e.preventDefault();

    let hasAnyInput = false;
    let invalidFields = [];

    $(this).find('input[type="number"]').each(function () {
        const value = $(this).val().trim();
        const label = $(this).closest('.mb-3').find('label').text();

        if (value !== '') {
            hasAnyInput = true;

            const numericValue = parseFloat(value);
            if (!isNaN(numericValue) && numericValue > 100) {
                invalidFields.push(label);
            }
        }
    });

    // Case 1: No input filled at all
    if (!hasAnyInput) {
        Swal.fire({
            icon: 'warning',
            title: 'Incomplete Form!',
            text: 'Please fill at least one input before submitting.',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Case 2: One or more fields exceed 100
    if (invalidFields.length > 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Invalid Input!',
            html: 'Percentage cannot be more than <strong>100%</strong>.<br><br>Check these fields:<br><ul style="text-align:left;">' + invalidFields.map(field => `<li>${field}</li>`).join('') + '</ul>',
            confirmButtonText: 'OK'
        });
        return;
    }

    // ✅ Proceed with form submission via AJAX
    const formData = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: formData + '&action=update_status_percentages',
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'Status updated successfully!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    $('#statusUpdateModal').modal('hide');
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed!',
                    text: response.message || 'Something went wrong.',
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'AJAX Error!',
                text: 'Failed to submit form. Please try again.',
            });
        }
    });
});

</script>
