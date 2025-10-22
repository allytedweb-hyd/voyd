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
                        <h3 class="mb-4 text-center htext">View Get Started</h3>
                        <div class="row" style="padding: 0px 10px;">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="example2">
                                <thead>
                                    <tr class="tableheadingrow">
                                        <th scope=" col">S.No</th>
                                        <th scope=" col">Who am I</th>
                                        <th scope="col" style="width: 300px;">Name</th>
                                    
                                        <th scope="col">Mobile Number</th>
                                 
                                        <th scope="col" class="actionbuttons">Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                   $sel = mysqli_query($conn, "select * from get_started_with_us where status=1 ORDER BY id DESC");
                                      $i=1;

                                     while ($fetch = mysqli_fetch_array($sel)) {

                                      ?>
                                    <tr>
                                    <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                    <td><?php echo $fetch['who_am_i']; ?></td>
                                   
                                    <td>
                                        <!-- <?php echo $fetch['name']; ?> -->

                                           
                                                <?php
        $rawDesc = $fetch['name'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" style="max-width: 300px !important;" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 200, '...')) ?> 
    </div>
                                
                                </td>
                                    <td><?php echo $fetch['mobile']; ?></td>
                              
                                        <td class="actionbuttons">
                                        <a class="idelete" href="./delete-getstarted.php?id=<?php echo $fetch['id']; ?>"><i class='bx bx-trash' name="deleteCustomer"></i></a>
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