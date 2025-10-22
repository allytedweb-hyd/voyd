<?php
include './includes/header.php';
include './includes/db.php';
include './functions/brandFunctions.php';


?>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <!-- <div class="breadcrumb-title pe-3">Forms</div> -->
            <!-- <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="./index.php"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-brands.php">Add Brands
                        </li></a>
                    </ol>
                </nav>
            </div> -->
        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">
                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">My Projects</h3>
                        <div class="row" style="padding: 0px 10px;">
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
                                            <th scope="col">Product Class</th>
                                            <th scope="col">Manufacturer Class</th>
                                            <th scope="col">Vendor </th>
                                            <th scope="col">Project Manager</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">Deadline</th>
                                            

                                            <th scope="col">Quote</th>
                                            <th scope="col">Status</th>
                                            <th style="display:none;">Freeze</th>
                                        </tr>
                                    </thead>
                                    <tbody class="quote-table-data">
                                        <?php
                                        $getuser = $_SESSION['Adminname'];
                                        $getuserId = $_SESSION['admin_id'];
                                        $getprojectUser = mysqli_query($conn, "SELECT * FROM login_admin WHERE id='".$getuserId ."'");
                                        $getprojectUserResult = mysqli_fetch_array($getprojectUser);
                                        $userName = $getprojectUserResult['admin_name'];
                                        $getMyProjects = mysqli_query($conn, "SELECT * FROM questionnaire T1, quotation T2 WHERE T1.que_id = T2.que_id AND T2.assigned_project_user='" . $userName . "' AND T1.status=1");
                                        $i = 1;
                                        while ($fetch = mysqli_fetch_array($getMyProjects)) {
                                        ?>
                                        
                                        <tr>
                                            <td class="numberrow"><?php echo $i ?></td>
                                            <td><?php echo $fetch['first_name'] . " " . $fetch['last_name']; ?></td>
                                            <td><a
                                                    href="addons-quotation.php?queId=<?php echo $fetch['que_id'] ?>&cusId=<?php echo $fetch['customer_id'] ?>"><?php echo "VOYD0" . $fetch['customer_id'] . "-" . $fetch['property'] . "(" . $fetch['property_type'] . ")-" . $fetch['que_id'] ?></a>
                                            </td>
                                            <td style="text-transform: none;" ><?php echo $fetch['email']; ?></td>
                                            <td><?php echo $fetch['mobile']; ?></td>
                                            <td><?php echo $fetch['state']; ?></td>
                                            <td><?php echo $fetch['city']; ?></td>
                                            <td>

                                                  <?php
        $rawDesc = $fetch['locality'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text"  data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>
                                              
                                            
                                          </td>
                                            <td>

                                                  <?php
        $rawDesc = $fetch['street'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text"  data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>
                                              
                                            
                                          </td>
                                            <td><?php echo $fetch['quotation_id']; ?></td>
                                            <!-- <td><?php echo $fetch['map_link']; ?></td> -->
                                            <td><?php echo $fetch['property']; ?></td>
                                            <td><?php echo $fetch['property_type']; ?></td>
                                            <td><?php echo $fetch['property_city']; ?></td>
                                            <td><?php echo $fetch['budget']; ?></td>
                                            <td><?php echo $fetch['product_classification']; ?></td>
                                            <td><?php echo $fetch['manufacturer_classification']; ?></td>
                                            <td><?php echo $fetch['assigned_vendor']; ?></td>
<?php
                                           $getmanager = mysqli_query($conn, "SELECT * FROM login_admin WHERE admin_designation = '2' AND status=2");
$Getdatamanager = mysqli_fetch_array($getmanager);
?>
<td><?php echo $Getdatamanager['admin_name']; ?></td>

                                            <td><?php echo $fetch['startdate']; ?></td>
                                            <td><?php echo $fetch['deadline']; ?></td>
                                           

                                            <?php
    $freezeValue = trim(strtolower($fetch['freeze']));
    $isUnfreezed = ($freezeValue === 'unfreezed' || $freezeValue === '');
?>



                                            <td class="excess-quote">
                                                <!-- <a href="add-addon.php?queId=<?php echo $fetch['que_id']; ?>"><i
                                                        class='bx bxs-add-to-queue'></i> Add</a> -->
                                                         <a 
        href="add-addon.php?queId=<?php echo $fetch['que_id']; ?>" 
        class="btn btn-sm btn-secondary <?php echo $isUnfreezed ? 'disabled' : ''; ?>" 
        <?php echo $isUnfreezed ? 'aria-disabled="true" tabindex="-1" onclick="return false;"' : ''; ?>
    ><i class='bx bxs-add-to-queue'></i> Add</a>
                                            </td>
                                            <!-- <td>
                                                <a class="iedit"
                                                    href="./delete-questionnaire.php?id=<?php echo $fetch['que_id']; ?>"><i
                                                        class='bx bx-trash' name="deleteQueries"></i></a>
                                                <a class="iedit"
                                                    href="./request_quote.php?id=<?php echo $fetch['que_id'] ?>"><i
                                                        class='bx bx-show'></i>
                                            </td> -->
                                            <!-- <td >
                                                <?php
                                                    $subStatQuery = "SELECT * FROM questionnaire T1, quotation T2 WHERE T1.que_id = T2.que_id AND T2.que_id='" . $fetch['que_id'] . "' AND T1.status=1";
                                                    $getSubStatus = mysqli_query($conn, $subStatQuery);
                                                    $subStatusRes = mysqli_fetch_array($getSubStatus);
                                                    ?>
                                                <select name="projectSubStatus" id="projectSubStatus"
                                                    class="form-select tbl-status" style="width: 300px !important;">
                                                    <option value="<?php echo $subStatusRes['project_sub_status'] ?>">
                                                        <?php echo $subStatusRes['project_sub_status'] ?></option>
                                                    <option value="">Select</option>
                                                    <?php
                                                        $querySubStatus = mysqli_query($conn, "SELECT * FROM tbl_subStatus_master WHERE Status = 1");
                                                        while ($queryResult = mysqli_fetch_array($querySubStatus)) {
                                                        ?>
                                                    <option value="<?php echo $queryResult['sub_status_master'] ?>">
                                                        <?php echo $queryResult['sub_status_master'] ?></option>
                                                    <?php
                                                        }
                                                        ?>
                                                </select>
                                                <input type="hidden" value="<?php echo $fetch['que_id'] ?>"
                                                    id="quotationId" />
                                            </td> -->
                                       
                                            <td>
                                                  <!-- <button class="btn btn-primary px-4 submit open-update-modal"  
          data-queid="<?php echo $fetch['que_id']; ?>">
    Update 
  </button> -->

   <button 
        class="btn btn-primary px-4 submit open-update-modal"  
        data-queid="<?php echo $fetch['que_id']; ?>"
        <?php echo $isUnfreezed ? 'disabled' : ''; ?>
    >
        Update
    </button>

                                            </td>
                                             <td style="display:none;"><?php echo $fetch['freeze']; ?></td>
                                       
                                        </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>
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



<!-- <div class="col-md-12 mb-3">
  <label class="form-label">Sub-Status</label>
<textarea name="subStatus" id="substatus"></textarea>
</div> -->

<button type="submit" id="projectSubStatus" class="btn btn-primary px-4 submit">Update</button>

        </div>
      
      </form>
    </div>
  </div>
</div>




<?php include 'includes/footer.php'; ?>

<!-- <script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script> -->
<!-- <script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script> -->
<script>
    $(document).ready(function() {
        const freezeColumnIndex = 22; 

        var table = $('#example2').DataTable({
            lengthChange: false,
            dom: "<'row custom-controls-row'<'col-md-4 dt-buttons-wrap'B><'col-md-4 dt-freeze-filter-wrapper text-center'><'col-md-4 dt-search-wrap'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(:nth-last-child(-n+3))' 
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    orientation: 'landscape',
                    pageSize: 'A1',
                    exportOptions: {
                        columns: ':not(:nth-last-child(-n+3))'
                    },
                    customize: function(doc) {
                        doc.defaultStyle.fontSize = 6;
                        doc.styles.tableHeader.fontSize = 6;
                        var table = doc.content[1].table;
                        var columnCount = table.body[0].length;
                        table.widths = new Array(columnCount).fill('*');
                    }
                },
          {
    extend: 'print',
    exportOptions: {
        columns: ':not(:nth-last-child(-n+3))' 
    },
    customize: function (win) {
       
        $(win.document.body).css({
            'font-size': '10pt',
            'margin': '20px',
            'line-height': '1.4'
        });

        
        const $table = $(win.document.body).find('table');

        $table.css({
            'width': '100%',
            'border-collapse': 'collapse',
            'table-layout': 'auto', 
            'word-break': 'break-word',
            'white-space': 'normal'
        });

        
        $table.find('thead th').css({
            'word-break': 'break-word',
            'white-space': 'normal',
            'padding': '6px',
            'text-align': 'left',
            'border': '1px solid #ddd'
        });

        
        $table.find('tbody td').css({
            'word-break': 'break-word',
            'white-space': 'normal',
            'padding': '6px',
            'text-align': 'left',
            'vertical-align': 'top',
            'border': '1px solid #ddd'
        });

        
        const css = '@page { size: landscape; margin: 1cm; }';
        const head = win.document.head || win.document.getElementsByTagName('head')[0];
        const style = win.document.createElement('style');

        style.type = 'text/css';
        style.media = 'print';

        if (style.styleSheet) {
            style.styleSheet.cssText = css;
        } else {
            style.appendChild(win.document.createTextNode(css));
        }

        head.appendChild(style);
    }
}


            ]
        });

        
        $('#example2_filter input[type="search"]').attr('placeholder', 'Search....').on('input', function() {
            this.value = this.value.trim();
        });

       
        const freezeDropdown = `
            <label class="mb-0 d-inline-block me-2">Freeze:</label>
            <select id="freezeFilter" style="width:150px !important;" class="form-select form-select-sm d-inline-block ">
                <option value="">All</option>
                <option value="freezed">Freezed</option>
                <option value="unfreezed">Unfreezed</option>
            </select>
        `;
        $('.dt-freeze-filter-wrapper').html(freezeDropdown);

        // Custom filter for freeze column
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var selectedFreeze = $('#freezeFilter').val();
            var freezeValue = data[freezeColumnIndex] || '';
console.log('Filter:', selectedFreeze, 'Row freeze:', freezeValue);
            if (selectedFreeze === "" || freezeValue.toLowerCase() === selectedFreeze.toLowerCase()) {
                return true;  // Show the row
            }
            return false; // Hide the row
        });

       $('#freezeFilter').on('change', function () {
    var val = $(this).val().toLowerCase();

    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var freezeVal = (data[freezeColumnIndex] || '').toLowerCase().trim();

        // Treat empty as 'unfreezed'
        if (freezeVal === '') {
            freezeVal = 'unfreezed';
        }

        if (val === '') { // no filter, show all
            return true;
        }

        if (val === 'unfreezed' && (freezeVal === 'unfreezed')) {
            return true;
        }

        if (val === 'freezed' && freezeVal === 'freezed') {
            return true;
        }

        return false;
    });

    table.draw();

    // Remove custom filter after applying to avoid stacking filters
    $.fn.dataTable.ext.search.pop();
});


        // Tooltip initialization for locality & street (optional)
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>




<script>
$('#projectSubStatus').on('change', function(e) {
    var id = $('#quotationId').val();
    var data = {
        'subStatus': this.value,
        'queId': id
    };
    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: data,
        success: function(result) {
            if (result) {
                Swal.fire({
                    title: "Success",
                    text: "Sub-Status updated successfully",
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: "Failed",
                    text: "Failed to update",
                    icon: "error"
                });
            }
        }

    })
});
</script>


<!-- <script>
$(document).ready(function () {
  $('.open-update-modal').on('click', function () {
    const queId = $(this).data('queid');
    $('#modal_que_id').val(queId);
    $('#statusUpdateModal').modal('show');
  });

$('#statusUpdateForm').on('submit', function (e) {
  e.preventDefault();

 
  let isValid = false;

  $(this).find('input[type="number"]').each(function() {

    const val = parseFloat($(this).val());
    if (!isNaN(val) && val > 0) {
      isValid = true;
      return false; 
    }
  });

  if (!isValid) {
    Swal.fire("Validation Error", "Please enter at least one percentage value greater than 0.", "warning");
    return; 
  }


  const formData = $(this).serialize() + '&action=update_status_percentages';

  $.ajax({
    url: 'ajax.php',
    type: 'POST',
    data: formData,
    success: function (response) {
      Swal.fire("Success", "Percentages updated!", "success");
      $('#statusUpdateModal').modal('hide');
    },
    error: function () {
      Swal.fire("Error", "Something went wrong.", "error");
    }
  });
});

});
</script> -->



<script>
    $(document).ready(function () {
  $('.open-update-modal').on('click', function () {
    const queId = $(this).data('queid');
    $('#modal_que_id').val(queId);
    $('#statusUpdateForm input[type="number"]').val('');
    $.ajax({
      url: 'ajax.php',
      type: 'POST',
      dataType: 'json',
      data: {
        action: 'get_status_percentages',
        que_id: queId
      },
      success: function (response) {
        if (response.success) {
          const data = response.data;

          $('input[name="false_ceiling"]').val(data.false_ceiling);
          $('input[name="electrical_lighting"]').val(data.elec_light);
          $('input[name="sanitary"]').val(data.sanitary);
          $('input[name="wardrobes"]').val(data.wardrobes);
          $('input[name="wall_putty"]').val(data.wall_putty);
          $('input[name="painting"]').val(data.painting);


           $('input[name="false_ceiling_status"]').val(data.false_ceiling_status);
    $('input[name="electrical_lighting_status"]').val(data.electrical_lighting_status);
    $('input[name="sanitary_status"]').val(data.sanitary_status);
    $('input[name="wardrobes_status"]').val(data.wardrobes_status);
    $('input[name="wall_putty_status"]').val(data.wall_putty_status);
    $('input[name="painting_status"]').val(data.painting_status);






        } else {
          Swal.fire("Info", "No data found for this project.", "info");
        }

        $('#statusUpdateModal').modal('show');
      },
      error: function () {
        Swal.fire("Error", "Failed to fetch data.", "error");
      }
    });
  });

//   $('#statusUpdateForm').on('submit', function (e) {
//     e.preventDefault();

//     let isValid = false;

//     $(this).find('input[type="number"]').each(function () {
//       const val = parseFloat($(this).val());
//       if (!isNaN(val) && val > 0) {
//         isValid = true;
//         return false;
//       }
//     });

//     if (!isValid) {
//       Swal.fire("Validation Error", "Please enter at least one percentage value greater than 0.", "warning");
//       return;
//     }

//     const formData = $(this).serialize() + '&action=update_status_percentages';

//     $.ajax({
//       url: 'ajax.php',
//       type: 'POST',
//       data: formData,
//       dataType: 'json',
//       success: function (response) {
//         if (response.success) {
//           Swal.fire("Success", "Status updated!", "success");
//           $('#statusUpdateModal').modal('hide');
//         } else {
//           Swal.fire("Error", "Update failed.", "error");
//         }
//       },
//       error: function () {
//         Swal.fire("Error", "Something went wrong.", "error");
//       }
//     });
//   });
// });



$('#statusUpdateForm').on('submit', function (e) {
  e.preventDefault();

  let isValid = false;
  let isAllValidRange = true;

 
  $(this).find('input[type="number"]').each(function() {
    const val = parseFloat($(this).val());
    if (!isNaN(val)) {
      if (val > 0) {
        isValid = true;
      }
      if (val < 0 || val > 100) {
        isAllValidRange = false;
      }
    }
  });

  if (!isValid) {
    Swal.fire("Validation Error", "Please enter at least one percentage value greater than 0.", "warning");
    return; 
  }

  if (!isAllValidRange) {
    Swal.fire("Validation Error", "Percentage values must be between 0 and 100.", "warning");
    return;
  }

  const formData = $(this).serialize() + '&action=update_status_percentages';

  $.ajax({
    url: 'ajax.php',
    type: 'POST',
    data: formData,
    success: function (response) {
      Swal.fire("Success", "Percentages updated!", "success");
      $('#statusUpdateModal').modal('hide');
    },
    error: function () {
      Swal.fire("Error", "Something went wrong.", "error");
    }
  });
});

  });


    




</script>


<script>
$('#substatus').summernote({
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

