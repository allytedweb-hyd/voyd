<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/vendortestimonialFunctions.php';
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-vendortestimonials.php">Add Vendor Testimonials</li></a>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">
                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Vendor Testimonials</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Vendor</th>
                                            <th scope="col">Testimonial Name</th>
                                           
                                            <th scope="col">Image</th>
                                           
                                            <th scope="col">Description</th>
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Changed On</th>
                                            <th scope="col" class="actionbuttons">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sel = mysqli_query($conn, "select * from vendor_testimonials where status=1 ORDER BY vendor_testimonial_id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                        ?>
                                            <tr>
                                                <th scope="row" class="numberrow"><?php echo $i; ?></th>

                                                <?php

$getvendorname = mysqli_query($conn, "SELECT * FROM vendor_management
 WHERE vendor_id='".$fetch['name']."' ");

$fetchvendorname = mysqli_fetch_array($getvendorname)

?>


                                                <td>
                                                    <!-- <?php echo $fetchvendorname['vendor_full_name']; ?> -->

                                                       <div class="tooltip-text"
                                                 data-toggle="tooltip" data-placement="bottom"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($fetchvendorname['vendor_full_name']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($fetchvendorname['vendor_full_name'])); ?>
                                                </div>
                                            
                                            </td>
                                                <td>
                                                    <!-- <?php echo $fetch['testimonial_name']; ?> -->

                                                      <div class="tooltip-text"
                                                 data-toggle="tooltip" data-placement="bottom"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($fetch['testimonial_name']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($fetch['testimonial_name'])); ?>
                                                </div>
                                            </td>
                                               
                                                <td><img class="imagedata" src='Uploads/vendortestimonials/<?php echo $fetch['image']; ?>' /></td>
                                               
                                                <td>

                                                


                                                <?php
        $rawDesc = $fetch['content'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>
                                                    
                                                
                                               
                                            
                                            </td>
                                                 <?php
                                                   $admindata = mysqli_query($conn, "select * from login_admin where id ='" . $fetch['updated_by'] . "' && status=1");
                    $fetchadmin = mysqli_fetch_array($admindata);

                    ?>
                                                <td><?php echo $fetch['updated_by']; ?></td>
                                                <td><?php echo $fetch['updated_at']; ?></td>
                                                <td class="actionbuttons"><a class="iedit" href="./edit-vendortestimonials.php?id=<?php echo $fetch['vendor_testimonial_id']; ?>"> <i class='bx bx-edit'></i></a>
                                                    <a class="idelete" href="./delete-vendortestimonials.php?id=<?php echo $fetch['vendor_testimonial_id']; ?>"><i class='bx bx-trash' name="deleteTestimonial"></i></a>
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
            }],
              columnDefs: [
    {
        targets: [6], 
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