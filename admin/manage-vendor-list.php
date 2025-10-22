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
                            <li class="breadcrumb-item active" aria-current="page"><a href="./manage-vendor.php">Add Manage Vendor</li></a>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- <a href="./manage-vendor.php"> <button type="button" class="btn btn-primary">Add Vendor</button></a> -->
        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">

                <div class="card new_card">
                    <h3 class="mb-4 text-center htext table-sub-head">View Vendors</h3>
                    <div class="card-body ">
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Profile Image</th>

                                            <th scope="col">Description</th>
                                            <th scope="col">Projects Done</th>
                                            <th scope="col">No of clients</th>
                                            <th scope="col">Pavilion</th>
                                            <th scope="col">Awards</th>
                                            <th scope="col">Spaces</th>
                                            <th scope="col">Workers</th>
                                            <th scope="col">Project Img 1</th>
                                            <th scope="col">Project Img 2</th>
                                            <th scope="col">Explore City</th>
                                            <th scope="col">Preffered Location 1</th>
                                            <th scope="col">Preffered Location 2</th>
                                            <th scope="col">Preffered Location 3</th>
                                            <th scope="col">Material Image 1</th>
                                            <th scope="col">Material Name 1</th>
                                            <th scope="col">Material Price 1</th>
                                            <th scope="col">Material Image 2</th>
                                            <th scope="col">Material Name 2</th>
                                            <th scope="col">Material Price 2</th>
                                            <th scope="col">Material Image 3</th>
                                            <th scope="col">Material Name 3</th>
                                            <th scope="col">Material Price 3</th>
                                            <th scope="col">Material Image 4</th>
                                            <th scope="col">Material Name 4</th>
                                            <th scope="col">Material Price 4</th>
                                            <th scope="col">Material Image 5</th>
                                            <th scope="col">Material Name 5</th>
                                            <th scope="col">Material Price 5</th>
                                            <th scope="col">Material Image 6</th>
                                            <th scope="col">Material Name 6</th>
                                            <th scope="col">Material Price 6</th>
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Changed On</th>
                                            <th scope="col" class="actionbuttons">Action</th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sel = mysqli_query($conn, "SELECT * from vendor_management WHERE status=1 ORDER BY id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {


                                        ?>


<?php

$getvendorname = mysqli_query($conn, "SELECT * FROM vendor WHERE vendor_id='".$fetch['vendor_id']."' ");

$fetchvendorname = mysqli_fetch_array($getvendorname)

?>



                                            <tr>
                                                <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                                <td>
                                                    <!-- <?php echo $fetchvendorname['vendor_firstname'] ?> <?php echo $fetchvendorname['vendor_lastname'] ?> -->

                                                       <div class="tooltip-text"
                                                 data-toggle="tooltip" data-placement="bottom"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($fetchvendorname['vendor_firstname'] . ' ' . $fetchvendorname['vendor_lastname']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($fetchvendorname['vendor_firstname'] . ' ' . $fetchvendorname['vendor_lastname'])); ?>
                                                </div>
                                                
                                                </td>
                                                <td><img src="Uploads/vendor-management/<?php echo $fetch['vendor_image']; ?>" alt="imag" class="imagedata" /></td>

                                                <td>

                                                  <!-- <div class="tooltip-text"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($fetch['vendor_description']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($fetch['vendor_description'])); ?>
                                                </div> -->

                                               


                                                <?php
        $rawDesc = $fetch['vendor_description'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>
                                                    
                                               
                                            
                                            </td>
                                                <td><?php echo $fetch['projects_done']; ?></td>
                                                <td><?php echo $fetch['no_of_clients']; ?></td>
                                                <td><?php echo $fetch['pavilion']; ?></td>
                                                <td><?php echo $fetch['awards']; ?></td>
                                                <td><?php echo $fetch['spaces']; ?></td>
                                                <td><?php echo $fetch['workers']; ?></td>
                                                <td>
                                            <img class="imagedata" src='Uploads/vendor-management/<?php echo $fetch['project_img_one']; ?>' />
                                            </td>
                                                <td>
                                                <img class="imagedata" src='Uploads/vendor-management/<?php echo $fetch['project_img_two']; ?>' />
                                            
                                            </td>
                                              <td><?php echo $fetch['explore_city']; ?></td>
                                                <td><?php echo $fetch['preffered_location_one']; ?></td>
                                                <td><?php echo $fetch['preffered_location_two']; ?></td>
                                                <td><?php echo $fetch['preffered_location_three']; ?></td>
                                                <td>
                                                   <img class="imagedata" src='Uploads/vendor-management/<?php echo $fetch['material_img_one']; ?>' />
                                            </td>
                                                <td><?php echo $fetch['material_name_one']; ?></td>
                                                <td><?php echo $fetch['material_price_one']; ?></td>
                                                <td>
                                                <img class="imagedata" src='Uploads/vendor-management/<?php echo $fetch['material_img_two']; ?>' />
                                            </td>
                                                <td><?php echo $fetch['material_name_two']; ?></td>
                                                <td><?php echo $fetch['material_price_two']; ?></td>
                                                <td>
                                                  <img class="imagedata" src='Uploads/vendor-management/<?php echo $fetch['material_img_three']; ?>' />
                                            </td>
                                                <td><?php echo $fetch['material_name_three']; ?></td>
                                                <td><?php echo $fetch['material_price_three']; ?></td>
                                                <td>
                                                   <img class="imagedata" src='Uploads/vendor-management/<?php echo $fetch['material_img_four']; ?>' />
                                            </td>
                                                <td><?php echo $fetch['material_name_four']; ?></td>
                                                <td><?php echo $fetch['material_price_four']; ?></td>
                                                <td>
                                                <img class="imagedata" src='Uploads/vendor-management/<?php echo $fetch['material_img_five']; ?>' />
                                            </td>
                                                <td><?php echo $fetch['material_name_five']; ?></td>
                                                <td><?php echo $fetch['material_price_five']; ?></td>
                                                <td>
                                                   <img class="imagedata" src='Uploads/vendor-management/<?php echo $fetch['material_img_six']; ?>' />
                                            </td>
                                                <td><?php echo $fetch['material_name_six']; ?></td>
                                                <td><?php echo $fetch['material_price_six']; ?></td>

                                                <!-- <?php
                                                   $admindata = mysqli_query($conn, "select * from login_admin where id ='" . $fetch['updated_by'] . "' && status=1");
                    $fetchadmin = mysqli_fetch_array($admindata);

                    ?> -->

                                                <td><?php echo $fetch['updated_by']; ?></td>
                                                <td><?php echo $fetch['created_at']; ?></td>
                                                <td class="actionbuttons"><a class="iedit" href="./edit-manage-vendor.php?id=<?php echo $fetch['id']; ?>"><i class='bx bx-edit'></i></a>
                                                    <a class="idelete" href="./delete-manage-vendor.php?id=<?php echo $fetch['id']; ?>"><i class='bx bx-trash' name="deleteVendor"></i></a>
                                                </td>
                                                <!-- <td>
                                                    
                                                    <?php
                                                    if ($fetch['status'] == 1) {
                                                    ?>
                                                        <button class='approve' onclick='approve(<?php echo $fetch["vendor_id"] ?>)'>Active</button>
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
                                                                            
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </td> -->

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
            }, {
    extend: 'pdf',
    orientation: 'landscape',
    pageSize: 'A1',
    exportOptions: {
      columns: ':visible' 
    },
    customize: function (doc) {
      doc.styles.tableHeader.alignment = 'left';
      doc.defaultStyle.fontSize = 8; 
    },  exportOptions: {
                    columns: ':not(:nth-last-child(-n+1))'
                }
  },   {
                extend: 'print',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+1))'
                }
            }],
               columnDefs: [
    {
        targets: [35], 
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





