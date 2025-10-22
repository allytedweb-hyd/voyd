<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/subcategoryFunctions.php';
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-status.php">Add Sub-Status
                                Master</li></a>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">
                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Status Masters</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Status Master</th>
                                            <th scope="col">Sub-Status Master</th>
                                            <th scope="col">Created/Updated By</th>
                                            <th scope="col">Created Date</th>
                                            <th scope="col">Updated Date</th>
                                            <th scope="col" class="actionbuttons">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sel = mysqli_query($conn, "SELECT * FROM tbl_subStatus_master WHERE status=1 ORDER BY sub_status_id DESC");
                                        $i = 1;

                                        

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                            $statusMaster = mysqli_query($conn, "SELECT * FROM tbl_status_master WHERE status_id = '". $fetch['status_master']."' && status=1");
                                            $statusMasterRes = mysqli_fetch_array($statusMaster)

                                        ?>
                                        <tr>
                                            <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                            <td><?php echo $statusMasterRes['status_master']; ?></td>
                                            <td><?php echo $fetch['sub_status_master']; ?></td>
                                            <td><?php echo $fetch['created_by']; ?></td>
                                            <td><?php echo $fetch['created_date']; ?></td>
                                            <td><?php echo $fetch['updated_date']; ?></td>
                                            <td class="actionbuttons"><a class="iedit"
                                                    href="./editSubStatusMaster.php?id=<?php echo $fetch['sub_status_id']; ?>"><i
                                                        class='bx bx-edit'></i></a>
                                                <a class="idelete"
                                                    href="./deleteSubStatus.php?id=<?php echo $fetch['sub_status_id']; ?>"><i
                                                        class='bx bx-trash' name="deleteProject"></i></a>
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
        targets: [4,5], 
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