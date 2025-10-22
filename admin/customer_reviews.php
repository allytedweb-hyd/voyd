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
                        <h3 class="mb-4 text-center htext">View Customer Reviews</h3>
                        <div class="row" style="padding: 0px 10px;">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="example2">
                                <thead>
                                    <tr class="tableheadingrow">
                                        <th scope=" col">S.No</th>
                                      
                                        <th scope="col" style="width:100px !important;">Customer Name</th>
                                        <th scope="col">Product</th>
                                    
                                        <th scope="col">Rating</th>
                                        
                                         <th scope="col" style="width: 300px;">Review Title</th>
                                         <th scope="col" style="width: 300px;">Review Content</th>
                                       
                                 
                                        <th scope="col" class="actionbuttons">Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                   $sel = mysqli_query($conn, "select * from customer_reviews where status=1 ORDER BY cus_review_id DESC");
                                      $i=1;

                                     while ($fetch = mysqli_fetch_array($sel)) {

                                      ?>
                                    <tr>
                                    <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                    <td style="width: 100px !important;">
                                        
                                    <!-- <?php echo $fetch['customer_name']; ?> -->

                                    <?php
$customerdata = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id='" . $fetch['customer_name'] . "'");
$customername = mysqli_fetch_array($customerdata);

                 
          $rawDesc = ($customername['first_name'] ?? '') . ' ' . ($customername['last_name'] ?? '');
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>

                                
                                </td>
                                   <td>
                                    <!-- <?php echo $fetch['product_title']; ?> -->

                                    <?php

                                    $getproduct = mysqli_query($conn,"SELECT * FROM products WHERE product_id='".$fetch['product_title']."'");

                                    $productname = mysqli_fetch_array($getproduct);
                                    
                                    ?>



                                      <div class="tooltip-text"
                                                 data-toggle="tooltip" data-placement="bottom"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($productname['product_title']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($productname['product_title'])); ?>
                                                </div>
                                
                                </td>
                                    <td><?php echo $fetch['rating']; ?></td>
                                    <td>
                                        <!-- <?php echo $fetch['review_title']; ?> -->

                                                           <?php
        $rawDesc = $fetch['review_title'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" style="max-width: 300px!important;" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 200, '...')) ?> 
    </div>
                                
                                </td>
                                    <td>
                                        
                                    <!-- <?php echo $fetch['review_content']; ?> -->

                                                      <?php
        $rawDesc = $fetch['review_content'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" style="max-width: 300px!important;" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 200, '...')) ?> 
    </div>
                                
                                </td>
                                   
                              
                                        <td class="actionbuttons">
                                        <a class="idelete" href="./delete-cusreview.php?id=<?php echo $fetch['cus_review_id']; ?>"><i class='bx bx-trash' name="deleteCustomer"></i></a>
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