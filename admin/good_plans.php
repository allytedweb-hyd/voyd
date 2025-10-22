<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/goodplanFunctions.php';
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-goodplan.php">Add Good Plan</li></a>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">
                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Good Plans</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Maker Classification</th>
                                            <th scope="col">Maker Icon</th>
                                            <th scope="col">Maker Text</th>
                                                    <th scope="col">Material Classification</th>
                                            <th scope="col">Material Icon</th>
                                            <th scope="col">Material Text</th>
                                            <th scope="col">Project Cost</th>
                                                                                  
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Changed On</th>
                                            <th scope="col" class="actionbuttons">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sel = mysqli_query($conn, "select * from good_plans where status=1 ORDER BY good_plan_id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                        ?>
                                            <tr>
                                                <th scope="row" class="numberrow"><?php echo $i; ?></th>

                                                <?php $getmaker = mysqli_query($conn, "SELECT * FROM classification WHERE classification_id='".$fetch['maker_classification']."'");

                                                $maker= mysqli_fetch_array( $getmaker);
                                                ?>

                                              <td><?php echo $maker['classification']; ?></td>
                                              
                                                <td><img class="imagedata" src='Uploads/classifications/<?php echo $fetch['maker_icon']; ?>' /></td>
                                                <td>

                                                 <div class="tooltip-text"
                                                 data-toggle="tooltip" data-placement="bottom"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($fetch['maker_text']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($fetch['maker_text'])); ?>
                                                </div>
                                                    
                                                
                                                </td>


                                                <?php $getmakerss = mysqli_query($conn, "SELECT * FROM classification WHERE classification_id='".$fetch['material_classification']."'");

                                                $makerss= mysqli_fetch_array( $getmakerss);
                                                ?>


                                                <td><?php echo $makerss['classification']; ?></td>
                                                   
                                                  

   <td><img class="imagedata" src='Uploads/classifications/<?php echo $fetch['material_icon']; ?>' /></td>
                                                     
                                                     <td>

                                                     


                                                <?php
        $rawDesc = $fetch['material_text'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>

                                                        
                                                     
                                                     </td>
                                                     <td><?php echo $fetch['project_cost']; ?></td>


                                                      
                                                   
                                                <td><?php echo $fetch['updated_by']; ?></td>
                                                <td><?php echo $fetch['updated_at']; ?></td>
                                                <td class="actionbuttons"><a class="iedit" href="./edit-goodplan.php?id=<?php echo $fetch['good_plan_id']; ?>"> <i class='bx bx-edit'></i></a>
                                                    <a class="idelete" href="./delete-goodplan.php?id=<?php echo $fetch['good_plan_id']; ?>"><i class='bx bx-trash' name="deleteTestimonial"></i></a>
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
        targets: [9], 
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