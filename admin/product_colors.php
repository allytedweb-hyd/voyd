<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/productFunctions.php';
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-productcolors.php">Add Product by Colours
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
                        <h3 class="mb-4 text-center htext">View Products</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Product Title</th>
                                            <th scope="col">Colour</th>
                                       
                                            <th scope="col">Image-1</th>
                                            <th scope="col">Alt Text-1</th>
                                            <th scope="col">Image-2</th>
                                            <th scope="col">Alt Text-2</th>
                                            <th scope="col">Image-3</th>
                                            <th scope="col">Alt Text-3</th>
                                            <th scope="col">Image-4</th>
                                            <th scope="col">Alt Text-4</th>
                                            <th scope="col">Image-5</th>
                                            <th scope="col">Alt Text-5</th>
                                         
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Changed On</th>
                                            <th scope="col" class="actionbuttons">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sel = mysqli_query($conn, "select * from product_colors where status=1 ORDER BY product_color_id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                        ?>

                                            <tr>
                                                <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                                <td><?php 

                                                $productdata = mysqli_query($conn,"SELECT * FROM products WHERE product_id='".$fetch['product_name']."'");
                                                $productname = mysqli_fetch_array($productdata);
                                                ?>
                                                <?php echo $productname['product_title']; ?>
                                            </td>
                                                <td>

                                                <?php
                                                $colorid = mysqli_query($conn, "select * from colors where color_id='" . $fetch['product_color'] . "'");
                                                $colorname = mysqli_fetch_array($colorid);
                                                ?>

                                                <span style="background-color: <?php echo $colorname['color_code']  ?>;"></span>
                                            </td>
                                                
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image1']; ?>' />
                                                </td>
                                                <td><?php echo $fetch['alttext1']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image2']; ?>' /></td>
                                                <td><?php echo $fetch['alttext2']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image3']; ?>' /></td>
                                                <td><?php echo $fetch['alttext3']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image4']; ?>' /></td>
                                                <td><?php echo $fetch['alttext4']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image5']; ?>' /></td>
                                                <td><?php echo $fetch['alttext5']; ?></td>
                                        
                                                


                                               
                                                <td><?php echo $fetch['updated_by']; ?></td>
                                                <td><?php echo $fetch['updated_at']; ?></td>
                                                <td class="actionbuttons"><a class="iedit" href="./edit-productcolor.php?id=<?php echo $fetch['product_color_id']; ?>">
                                                        <i class='bx bx-edit'></i></a>
                                                    <a class="idelete" href="./delete-productcolor.php?id=<?php echo $fetch['product_color_id']; ?>"><i class='bx bx-trash' name="deleteProduct"></i></a>
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
            }],
                columnDefs: [
    {
        targets: [14], 
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