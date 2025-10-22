<?php
include 'includes/header.php';
include 'includes/db.php';
include './utils/alerts.php';
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
                        <!-- <li class="breadcrumb-item active" aria-current="page"><a href="add-vendors.php">Add Vendors</li></a> -->
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">

                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Sales Pop-Up Form</h3>
                        <div class="row" style="padding: 0px 10px;">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="example2">
                                <thead>
                                    <tr class="tableheadingrow">
                                        <th scope=" col">S.No</th>
                                      
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                    
                                        <th scope="col">Mobile Number</th>
                                        
                                         <th scope="col">City</th>
                                         <th scope="col">Area</th>
                                         <th scope="col">Project</th>
                                         <th scope="col">Project Details</th>
                                 
                                        <th scope="col" class="actionbuttons">Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                   $sel = mysqli_query($conn, "select * from ongoing where status=1 ORDER BY ongoing_id DESC");
                                      $i=1;

                                     while ($fetch = mysqli_fetch_array($sel)) {

                                      ?>
                                    <tr>
                                    <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                    <td>
                                        <!-- <?php echo $fetch['name']; ?> -->

                                              <div class="tooltip-text"
                                                 data-toggle="tooltip" data-placement="bottom"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($fetch['name']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($fetch['name'])); ?>
                                                </div>
                                
                                </td>
                                   <td class="email-cell" ><?php echo $fetch['email']; ?></td>
                                    <td><?php echo $fetch['phone']; ?></td>
                                    <td><?php echo $fetch['city']; ?></td>
                                    <td><?php echo $fetch['area']; ?></td>
                                    <td><?php echo $fetch['project']; ?></td>
                                    <td><?php echo $fetch['project_details']; ?></td>
                              
                                        <td class="actionbuttons">
                                        <a class="idelete" href="./delete-ongoing.php?id=<?php echo $fetch['ongoing_id']; ?>"><i class='bx bx-trash' name="deleteCustomer"></i></a>
                                        </td>

                                    </tr>
                                    <?php $i++; } ?>
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
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
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

