<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/ongoingcardFunctions.php';
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

                        <?php
$ongoingExists = false;
$query = mysqli_query($conn, "SELECT COUNT(*) as count FROM ongoing_card WHERE status=1");
$row = mysqli_fetch_assoc($query);
if ($row['count'] > 0) {
    $ongoingExists = true;
}
?>

                        <li class="breadcrumb-item active" aria-current="page"><button type="button" class="ongoingcard" id="addOngoingBtn">Add Sales Pop-Up</button></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">
                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Sales Pop-Up</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Main Heading</th>
                                            <th scope="col">Sub Heading</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Alt Text</th>
                                            <th scope="col">Offer</th>
                                            <th scope="col">Promo Code</th>
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Changed On</th>
                                            <th scope="col" class="actionbuttons">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sel = mysqli_query($conn, "select * from ongoing_card where status=1 ORDER BY ongoingcard_id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                        ?>
                                            <tr>
                                                <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                                <td>
                                                    
                                                <!-- <?php echo $fetch['main_heading']; ?> -->

                                                    <div class="tooltip-text"
                                                 data-toggle="tooltip" data-placement="bottom"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($fetch['main_heading']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($fetch['main_heading'])); ?>
                                                </div>
                                            
                                            </td>
                                                <td>
                                                    <!-- <?php echo $fetch['sub_heading']; ?> -->

                                                        <div class="tooltip-text"
                                                 data-toggle="tooltip" data-placement="bottom"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($fetch['sub_heading']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($fetch['sub_heading'])); ?>
                                                </div>
                                            
                                            </td>
                                                <td class="imgtd" ><img class="imagedata"  src='Uploads/ongoing/<?php echo $fetch['image']; ?>' /></td>
                                                <td><?php echo $fetch['img_alt_text']; ?></td>
                                                <td><?php echo $fetch['offer']; ?></td>
                                                <td><?php echo $fetch['promo']; ?></td>
                                             
                                                <td><?php echo $fetch['updated_by']; ?></td>
                                                <td><?php echo $fetch['updated_at']; ?></td>
                                                <td class="actionbuttons"><a class="iedit" href="./edit-ongoingcard.php?id=<?php echo $fetch['ongoingcard_id']; ?>"> <i class='bx bx-edit'></i></a>
                                                    <a class="idelete" href="./delete-ongoingcard.php?id=<?php echo $fetch['ongoingcard_id']; ?>"><i class='bx bx-trash' name="deleteTestimonial"></i></a>
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
        targets: [8], 
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
document.getElementById('addOngoingBtn').addEventListener('click', function () {
    const ongoingExists = <?php echo $ongoingExists ? 'true' : 'false'; ?>;

    if (ongoingExists) {
        Swal.fire({
            icon: 'warning',
            title: 'Ongoing Offer Exists',
            text: 'Only one record is allowed. Please delete the existing one.',
        });
    } else {
      
        window.location.href = 'add-ongoingcard.php';
    }
});
</script>