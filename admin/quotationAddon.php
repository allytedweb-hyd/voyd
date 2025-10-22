<?php
include './includes/header.php';
include './includes/db.php';
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-addon.php">Add Excess
                                Quotation
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
                        <h3 class="mb-4 text-center htext">View Excess Quotation</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Questionnaire Id</th>
                                            <th scope="col">Customer Id</th>
                                             <th scope="col">Project Name</th>
                                            <th scope="col">Customer Name</th>
                                           
                                            <th scope="col">project Class</th>
                                            <th scope="col">vendor Name</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Product Code</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Changed On</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $sel = mysqli_query($conn, "SELECT * FROM quotation_addon WHERE  status=1 ORDER BY addon_id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                        ?>

                                            <tr>
                                                <th scope="row"><?php echo $i; ?></th>
                                                <td><?php echo $fetch['que_id']; ?></td>
                                                <td><?php echo $fetch['customer_id'] ?></td>
                                                <td><?php echo $fetch['customer_name'] ?></td>
                                                <td><?php echo $fetch['project_name'] ?></td>
                                                <td><?php echo $fetch['project_class'] ?></td>
                                                <td><?php echo $fetch['vendor_name'] ?></td>
                                                <td><?php echo $fetch['item_name'] ?></td>
                                                <td><?php echo $fetch['item_code'] ?></td>
                                                <td><?php echo $fetch['quantity'] ?></td>
                                                <td><?php echo $fetch['updated_by'] ?></td>
                                                <td><?php echo $fetch['updated_At'] ?></td>
                                                <td><a class="iedit" href="./edit-addon.php?id=<?php echo $fetch['addon_id']; ?>"><i class='bx bx-edit'></i></a>
                                                    <a class="idelete" href="./delete-addon.php?id=<?php echo $fetch['addon_id']; ?>"><i class='bx bx-trash'></i></a>
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
        targets: [11], 
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

        $('#example2_filter input[type="search"]').on('input', function () {
        this.value = this.value.trim();
    });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>