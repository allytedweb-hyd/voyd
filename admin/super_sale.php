<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/supersaleFunctions.php';
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-supersale.php">Add Super Sale
                        </li></a>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">
                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Super Sale</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">Start Time</th>
                                       
                                            <th scope="col">End Date</th>
                                            <th scope="col">End Time</th>
                                            <th scope="col">Period</th>
                                            <th scope="col">Offer</th>
                                        
                                         
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Changed On</th>
                                            <th scope="col" class="actionbuttons">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sel = mysqli_query($conn, "select * from super_sale where status=1 ORDER BY super_sale_id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                        ?>

                                            <tr>
                                                <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                              
                                                <?php
$start_date = DateTime::createFromFormat('Y-m-d', $fetch['start_date'])->format('d/m/Y');
$start_time = DateTime::createFromFormat('H:i:s', $fetch['start_time'])->format('H:i:s');
$end_date = DateTime::createFromFormat('Y-m-d', $fetch['end_date'])->format('d/m/Y');
$end_time = DateTime::createFromFormat('H:i:s', $fetch['end_time'])->format('H:i:s');
?>
                                                
                                                
                                                <td><?php echo $start_date; ?></td>
                                                <td><?php echo $start_time; ?></td>
                                                <td><?php echo $end_date; ?></td>
                                                <td><?php echo $end_time; ?></td>
                                                

                                                <?php
$start_datetime = new DateTime($fetch['start_date'] . ' ' . $fetch['start_time']);
$end_datetime = new DateTime($fetch['end_date'] . ' ' . $fetch['end_time']);
$interval = $start_datetime->diff($end_datetime);


$days = $interval->d;
$hours = str_pad($interval->h, 2, "0", STR_PAD_LEFT);
$minutes = str_pad($interval->i, 2, "0", STR_PAD_LEFT);
$seconds = str_pad($interval->s, 2, "0", STR_PAD_LEFT);

if ($days > 0) {
    $period_str = $days . 'd ' . "$hours:$minutes:$seconds";
} else {
    $period_str = "$hours:$minutes:$seconds";
}


?>
<td><?php echo $period_str; ?></td>

<td><?php echo $fetch['offer']?>% off</td>

                                                
                                        
                                                


                                               
                                                <td><?php echo $fetch['updated_by']; ?></td>
                                                <td><?php echo $fetch['updated_at']; ?></td>
                                                <!-- <td class="actionbuttons"><a class="iedit" href="./edit-supersale.php?id=<?php echo $fetch['super_sale_id']; ?>">
                                                        <i class='bx bx-edit'></i></a>
                                                    <a class="idelete" href="./delete-supersale.php?id=<?php echo $fetch['super_sale_id']; ?>"><i class='bx bx-trash' name="deleteProduct"></i></a>
                                                </td> -->

                                                <?php
$start_datetime = new DateTime($fetch['start_date'] . ' ' . $fetch['start_time'], new DateTimeZone('Asia/Kolkata'));
$end_datetime = new DateTime($fetch['end_date'] . ' ' . $fetch['end_time'], new DateTimeZone('Asia/Kolkata'));
$now = new DateTime('now', new DateTimeZone('Asia/Kolkata'));

$isEditable = $now < $end_datetime;
?>
<td class="actionbuttons">
    <?php if ($isEditable): ?>
        <a class="iedit" href="./edit-supersale.php?id=<?php echo $fetch['super_sale_id']; ?>"><i class='bx bx-edit'></i></a>
    <?php endif; ?>
    <a class="idelete" href="./delete-supersale.php?id=<?php echo $fetch['super_sale_id']; ?>"><i class='bx bx-trash'></i></a>
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
                orientation: 'landscape',
                pageSize: 'A2',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+1))',
                     
                    
                },
                customize: function (doc) {
      doc.styles.tableHeader.alignment = 'left';
      doc.defaultStyle.fontSize = 10; 
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