<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/galleryFunctions.php';
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-gallery.php">Add Previous Project</li></a>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">
                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Previous Projects</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Image 1</th>
                                            <th scope="col">Image 2</th>
                                            <th scope="col">Image 3</th>
                                            <th scope="col">Image 4</th>
                                            <th scope="col">Image 5</th>
                                            <th scope="col">Image 6</th>
                                            <th scope="col">Image 7</th>
                                            <th scope="col">Image 8</th>
                                            <th scope="col">Image 9</th>
                                            <th scope="col">Image 10</th>
                                            <th scope="col">Alt Text</th>
                                            <th scope="col">Profile Image</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Rating</th>
                                            <th scope="col">Custumer Name</th>
                                            <th scope="col">Customer Status</th>
                                            <th scope="col">Flat No.</th>
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Changed On</th>
                                            <th scope="col" class="actionbuttons">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sel = mysqli_query($conn, "select * from gallery where status=1 ORDER BY gallery_id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                        ?>
                                            <tr>
                                                <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                                <?php 
                                                $gcategoryid = mysqli_query($conn, "select * from gallery_category where gcategory_id='".$fetch['gallery_category']."'");
                                                $gcategoryname = mysqli_fetch_array($gcategoryid);                                            
                                                ?>
                                                <td><?php echo $gcategoryname['category_name']; ?></td>
                                                <td><img class="imagedata" src='Uploads/gallery/<?php echo $fetch['gallery_image']; ?>' /></td>
                                                <td><img class="imagedata" src='Uploads/gallery/<?php echo $fetch['gallery_image2']; ?>' /></td>
                                                <td><img class="imagedata" src='Uploads/gallery/<?php echo $fetch['gallery_image3']; ?>' /></td>
                                                <td><img class="imagedata" src='Uploads/gallery/<?php echo $fetch['gallery_image4']; ?>' /></td>
                                                <td><img class="imagedata" src='Uploads/gallery/<?php echo $fetch['gallery_image5']; ?>' /></td>
                                                <td><img class="imagedata" src='Uploads/gallery/<?php echo $fetch['gallery_image6']; ?>' /></td>
                                                <td><img class="imagedata" src='Uploads/gallery/<?php echo $fetch['gallery_image7']; ?>' /></td>
                                                <td><img class="imagedata" src='Uploads/gallery/<?php echo $fetch['gallery_image8']; ?>' /></td>
                                                <td><img class="imagedata" src='Uploads/gallery/<?php echo $fetch['gallery_image9']; ?>' /></td>
                                                <td><img class="imagedata" src='Uploads/gallery/<?php echo $fetch['gallery_image10']; ?>' /></td>
                                                <td><?php echo $fetch['gallery_alttext']; ?></td>
                                                     <td><img class="imagedata" src='Uploads/gallery/<?php echo $fetch['profile_img']; ?>' /></td>
                                                     <td><?php echo $fetch['price']; ?></td>
                                                     <td><?php echo $fetch['rating']; ?></td>
                                                     <td><?php echo $fetch['customer_name']; ?></td>
                                                     <td><?php echo $fetch['customer_status']; ?></td>
                                                     <td><?php echo $fetch['flat']; ?></td>
                                                <td><?php echo $fetch['updated_by']; ?></td>
                                                <td><?php echo $fetch['updated_At']; ?></td>
                                                <td class="actionbuttons"><a class="iedit" href="./edit-gallery.php?id=<?php echo $fetch['gallery_id']; ?>"> <i class='bx bx-edit'></i></a>
                                                    <a class="idelete" href="./delete-gallery.php?id=<?php echo $fetch['gallery_id']; ?>"><i class='bx bx-trash' name="deleteTestimonial"></i></a>
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
            buttons: [    {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+1))'
                }
            }, 
            
               {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A3', 
                title: 'Previous Projects',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function (doc) {
                    
                    doc.defaultStyle.fontSize = 8;
                    doc.styles.tableHeader.fontSize = 9;

                    
                    var colCount = doc.content[1].table.body[0].length;
                    var widths = [];
                    for (var i = 0; i < colCount; i++) {
                        widths.push('*');
                    }
                    doc.content[1].table.widths = widths;
                },   exportOptions: {
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
        targets: [20], 
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




 