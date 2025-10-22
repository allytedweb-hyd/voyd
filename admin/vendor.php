<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/vendorFunctions.php';

?>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 nav-breadcrumb">
            <div class="d-flex">
                <!-- <div class="breadcrumb-title pe-3">Forms</div> -->
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="./index.php"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="./add-vendors.php">Add Vendor</li></a>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- <a href="./add-vendors.php"> <button type="button" class="btn btn-primary">Add Vendor</button></a> -->
        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">

                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Vendors</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <!-- <th scope="col">Image</th> -->
                                            <!-- <th scope="col">Alt Text</th> -->
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile Number</th>
                                           <th scope="col">Company Name</th>
                                            <th scope="col">Company Type</th>
                                            <th scope="col">Classification</th>
                                             <th scope="col">GST Number</th>
                                             <th scope="col">Pan Card</th>
                                            <th scope="col">Aadhar Number</th>
                                             <th scope="col">Locality</th>
                                            <!-- <th scope="col">DOB</th> -->
                                            <th scope="col">City</th>
                                            <!-- <th scope="col">Area</th> -->
                                            <th scope="col">State</th>
                                            
                                           
                                            <!-- <th scope="col">Zipcode</th> -->
                                            <th scope="col">Address</th>
                                            <th scope="col">Reason</th>
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Changed On</th>
                                            <th scope="col" class="actionbuttons">Action</th>
                                            <th scope="col" class="actionbuttons">Status</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sel = mysqli_query($conn, "select * from vendor where status!=0 ORDER BY vendor_id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {

                                            $value = $fetch["status"];

                                            if ($value === "1") {
                                                $class = "label-constant";
                                            } else if ($value === "2") {
                                                $class = "label-approve";
                                            } else if ($value === "3") {
                                                $class = "label-unapprove";
                                            } else if ($value === "4") {
                                                $class = "label-block";
                                            } else {
                                                $class = "label-approve";
                                            }
                                        ?>

                                            <tr class=<?php echo $class ?>>
                                                <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                                <td>
                                                    <!-- <?php echo $fetch['vendor_firstname']; ?> -->
                                                       <div class="tooltip-text"
                                                 data-toggle="tooltip" data-placement="bottom"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($fetch['vendor_firstname']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($fetch['vendor_firstname'])); ?>
                                                </div>
                                            </td>
                                                <td>
                                                    <!-- <?php echo $fetch['vendor_lastname']; ?> -->

                                                         <div class="tooltip-text"
                                                 data-toggle="tooltip" data-placement="bottom"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($fetch['vendor_lastname']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($fetch['vendor_lastname'])); ?>
                                                </div>
                                            
                                            </td>
                                                <!-- <td><img width=130 height=80 src='./uploads/vendor/<php echo $fetch['vendor_image']; ?>' /></td> -->
                                                <!-- <td><php echo $fetch['vendor_alttext']; ?></td> -->
                                                <td class="email-cell" ><?php echo $fetch['vendor_email']; ?></td>
                                                <td><?php echo $fetch['vendor_mobile']; ?></td>
                                                <td><?php echo $fetch['company_name']; ?></td>
                                                
                                                <td><?php echo $fetch['vendor_company']; ?></td>
                                                <td><?php echo $fetch['vendor_class']; ?></td>
                                                <td><?php echo $fetch['vendor_gst']; ?></td>
                                                 <td><?php echo $fetch['vendor_pancard']; ?></td>
                                                <td><?php echo $fetch['vendor_aadhar']; ?></td>
                                               
                                                 <td><?php echo $fetch['vendor_locality']; ?></td>
                                                  <td><?php echo $fetch['vendor_city']; ?></td>
                                                <td><?php echo $fetch['vendor_state']; ?></td>
                                               
                                               
                                                <td>

                                                 


                                                <?php
        $rawDesc = $fetch['vendor_address'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>

                                                    
                                               
                                            
                                            </td>
                                                <td><?php echo !empty($fetch['block_reason']) ? $fetch['block_reason'] : 'N/A'; ?></td>
                                                <td><?php echo !empty($wmoty) ? 'N/A' : $fetch['updated_by']; ?></td>
                                                <td><?php echo $fetch['updated_At']; ?></td>
                                                <td class="actionbuttons"><a class="iedit" href="./edit-vendor.php?id=<?php echo $fetch['vendor_id']; ?>"><i class='bx bx-edit'></i></a>
                                                    <a class="idelete" href="./delete-vendor.php?id=<?php echo $fetch['vendor_id']; ?>"><i class='bx bx-trash' name="deleteVendor"></i></a>
                                                </td>
                                                <td class="actionbuttons"> 
                                                    <!-- <button class='block' type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Block</button>
                                                    <button class='inactive' onclick="inactive">Inactive</button> -->
                                                    <?php
                                                    if ($fetch['status'] == 1) {
                                                    ?>
                                                        <button class='approve' onclick='approve(<?php echo $fetch["vendor_id"] ?>)'>Active</button>
                                                        <button class='block' data-bs-toggle='modal' data-bs-target='#staticBackdrop<?php echo $fetch["vendor_id"] ?>'>Block</button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="staticBackdrop<?php echo $fetch["vendor_id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">Block Reason</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form method="post">
                                                                        <div class="modal-body">
                                                                            <input type="text" name="blockreason" class="form-control" id="blockreason" required>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="submit" class="btn btn-secondary" onclick='block(<?php echo $fetch["vendor_id"] ?>)'>Save</button>
                                                                            <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php
                                                    } else if ($fetch['status'] == 2) {
                                                    ?>
                                                        <button class='unapprove' onclick='Unapprove(<?php echo $fetch["vendor_id"] ?>)'>Inactive</button>
                                                        <button class='block' data-bs-toggle='modal' data-bs-target='#staticBackdrop<?php echo $fetch["vendor_id"] ?>'>Block</button>
                                                        <div class="modal fade" id="staticBackdrop<?php echo $fetch["vendor_id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">Block Reason</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form method="post">
                                                                        <div class="modal-body">
                                                                            <input type="text" name="blockreason" class="form-control" id="blockreason">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="submit" class="btn btn-secondary" onclick='block(<?php echo $fetch["vendor_id"] ?>)'>Save</button>
                                                                            <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } else if ($fetch['status'] == 3) {
                                                    ?>
                                                        <button class='approve' onclick='approve(<?php echo $fetch["vendor_id"] ?>)'>Active</button>
                                                        <button class='Unblock' onclick='Unblock(<?php echo $fetch["vendor_id"] ?>)'>UnBlock</button>
                                                    <?php
                                                    } else if ($fetch['status'] == 4) {
                                                    ?>
                                                        <button class='approve' onclick='approve(<?php echo $fetch["vendor_id"] ?>)'>Active</button>
                                                        <button class='Unblock' onclick='Unblock(<?php echo $fetch["vendor_id"] ?>)'>UnBlock</button>
                                                    <?php
                                                    } else if ($fetch['status'] == 5) {
                                                    ?>
                                                        <button class='unapprove' onclick='Unapprove(<?php echo $fetch["vendor_id"] ?>)'>Inactive</button>
                                                        <button class='block' data-bs-toggle='modal' data-bs-target='#staticBackdrop<?php echo $fetch["vendor_id"] ?>'>Block</button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="staticBackdrop<?php echo $fetch["vendor_id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">Block Reason</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form method="post" onsubmit="return validateBlockReason();">
                                                                        <div class="modal-body">
                                                                            <input type="text" name="blockreason" class="form-control" id="blockreason">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="submit" class="btn btn-secondary" onclick='block(<?php echo $fetch["vendor_id"] ?>)'>Save</button>
                                                                            <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
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
        <!--end row-->




    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    function approve(val) {
        $.ajax({
            type: 'post',
            url: 'approveVendor.php',
            data: {
                id: val
            },
            success: function(response) {
                console.log('success');
                // alert('active');
       Swal.fire({
                    title: "Active!",
                    text: "Vendor is Verified!",
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        });
    }
</script>

<script>
    function Unapprove(val) {
        $.ajax({
            type: 'post',
            url: 'unapproveVendor.php',
            data: {
                id: val
            },
            success: function(response) {
                console.log('success');
                // alert('Inactive');
              Swal.fire({
                    title: "Inactive!",
                    text: "Vendor is Deactivated!",
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        });
    }
</script>

<script>
    function block(val) {
        var data1 = $("#blockreason").val();
        console.log(data1);
        $.ajax({
            type: 'post',
            url: 'blockVendor.php',
            data: {
                id: val,
                reason: data1
            },
            success: function(response) {
                console.log(data);
            }
        });
    }
</script>

<script>
    function Unblock(val) {
        $.ajax({
            type: 'post',
            url: 'unblockVendor.php',
            data: {
                id: val
            },
            success: function(response) {
                console.log('success');
                alert('Unblock');
                window.location.reload();
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: [ {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+1))'
                }
            },   {
    extend: 'pdf',
    orientation: 'landscape',
    pageSize: 'A2',
    exportOptions: {
      columns: ':visible' 
    },
    customize: function (doc) {
      doc.styles.tableHeader.alignment = 'left';
      doc.defaultStyle.fontSize = 8; 
    },  exportOptions: {
                    columns: ':not(:nth-last-child(-n+2))'
                }
  },     {
                extend: 'print',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+2))'
                }
            }],
              columnDefs: [
    {
        targets: [17], 
        render: function (data, type, row) {
      
            if (data === 0 || data === '0') return '0';

          
            const parsed = Date.parse(data);
            if (!data || isNaN(parsed)) return data;

            
            const date = new Date(parsed);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');

            return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
        }
    }
]
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
function validateBlockReason() {
    const input = document.getElementById('blockreason').value.trim();
    if (input === "") {
        alert("Block reason cannot be empty .");
        return false; 
    }
    return true;
}
</script>





 