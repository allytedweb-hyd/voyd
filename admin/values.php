<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/valueFunctions.php';
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-values.php">Add Values</li></a>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">
                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Values</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Select Product</th>
                                            <th scope="col">Select Category</th>
                                            <th scope="col">Select Sub-Category</th>
                                            <th scope="col">Select Attributes</th>
                                            <th scope="col">Enter Values</th>
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Changed On</th>
                                            <th scope="col" class="actionbuttons">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sel = mysqli_query($conn, "select * from value_master where status=1 ORDER BY values_id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                        ?>
                                            <tr>
                                                <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                                <?php 
                                                $productid = mysqli_query($conn, "select * from product_type where productType_id='".$fetch['product']."'");
                                                $productname = mysqli_fetch_array($productid);                                            
                                                ?>
                                                <td><?php echo $productname['enter_productType']; ?></td>
                                                <?php 
                                                $mcategoryid = mysqli_query($conn, "select * from manufacturer_category where mcategory_id='".$fetch['category']."'");
                                                $mcategoryname = mysqli_fetch_array($mcategoryid);                                            
                                                ?>
                                                <td><?php echo $mcategoryname['category_name']; ?></td>
                                                <?php 
                                                $msubcategoryid = mysqli_query($conn, "select * from manufacturer_subCategory where mSubcategory_id='".$fetch['subcategory']."'");
                                                $msubcategoryname = mysqli_fetch_array($msubcategoryid);                                            
                                                ?>
                                                <td><?php echo $msubcategoryname['sub_category']; ?></td>
                                                <?php 
                                                $attributeid = mysqli_query($conn, "select * from attributes where attribute_id='".$fetch['attributes']."'");
                                                $attributename = mysqli_fetch_array($attributeid);                                            
                                                ?>
                                                <td><?php echo $attributename['attributes']; ?></td>
                                                <td><?php echo $fetch['enter_values']; ?></td>
                                                <td><?php echo $fetch['updated_by']; ?></td>
                                                <td><?php echo $fetch['updated_At']; ?></td>
                                                <td class="actionbuttons"><a class="iedit" href="./edit-values.php?id=<?php echo $fetch['values_id']; ?>"><i class='bx bx-edit'></i></a>
                                                    <a class="idelete" href="./delete-values.php?id=<?php echo $fetch['values_id']; ?>"><i class='bx bx-trash' name="deleteProject"></i></a>
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
        targets: [7], 
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