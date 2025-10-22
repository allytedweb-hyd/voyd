<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/blogFunctions.php';
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-blog.php">Add Blog</li></a>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">
                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Blog</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Ratings</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Alt Text</th>
                                            <th scope="col">Link</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Changed On</th>
                                            <th scope="col" class="actionbuttons">Action</th>
                                            <th scope="col" class="actionbuttons">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sel = mysqli_query($conn, "select * from blog where status!=0 ORDER BY blog_id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                        ?>
                                            <tr class="<?php echo ($fetch['status'] == 2) ? 'status-green' : 'status-red'; ?>">
                                                <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                                <td>
                                                   

                                                <?php
        $rawDesc = $fetch['blog_title'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>
                                            
                                            </td>
                                                <td>
                                                    <!-- <?php echo $fetch['author']; ?> -->

                                                       <div class="tooltip-text"
                                                 data-toggle="tooltip" data-placement="bottom"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($fetch['author']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($fetch['author'])); ?>
                                                </div>
                                            </td>
                                                <td><?php echo $fetch['comments']; ?></td>
                                                <td><?php echo $fetch['blog_date']; ?></td>
                                                <td><img class="imagedata" src='Uploads/blog/<?php echo $fetch['blog_image']; ?>' /></td>
                                                <td><?php echo $fetch['blog_alttext']; ?></td>
                                                <td>


                                          

                                                <?php
        $rawDesc = $fetch['link'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>


                                                    
                                                
                                            
                                            </td>
                                                <td>
                                               
                                            
                                                <?php
        $rawDesc = $fetch['blog_description'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>
                                                    
                                                
                                                </td>
                                                <td><?php echo $fetch['updated_by']; ?></td>
                                                <td><?php echo $fetch['updated_At']; ?></td>



                                                <td class="actionbuttons"><a class="iedit" href="./edit-blog.php?id=<?php echo $fetch['blog_id']; ?>"><i class='bx bx-edit'></i></a>
                                                    <a class="idelete" style="cursor: pointer;" onclick="deleteConfirmation(event, <?php echo $fetch['blog_id']; ?>)"><i class='bx bx-trash' name="deleteProject"></i></a>
                                                </td>

                                                 <td class="actionbuttons">
    <?php
    if ($fetch['status'] == 1) {
        echo "<button class='approve' onclick='active(" . $fetch['blog_id'] . ")'>Active</button>";
    } else {
        echo "<button class='approve inactivebutton'  onclick='inactive(" . $fetch['blog_id'] . ")'>Inactive</button>";
    }
    ?>
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
            buttons: [
  {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+2))'
                }
            },

               {
    extend: 'pdf',
    orientation: 'landscape',
    pageSize: 'A4',
    exportOptions: {
      columns: ':visible' 
    },
    customize: function (doc) {
      doc.styles.tableHeader.alignment = 'left';
      doc.defaultStyle.fontSize = 8; 
    },
       exportOptions: {
                    columns: ':not(:nth-last-child(-n+2))'
                }
  }, 
           
            {
                extend: 'print',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+2))'
                }
            }],
                columnDefs: [
    {
        targets: [10], 
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

function deleteConfirmation(e, id) {
    e.preventDefault(); 

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `./delete-blog.php?id=${id}`;
        }
    });
}

</script>




<script>
  function active(val) {
    $.ajax({
        type: 'POST',
        url: 'activeblog.php',
        dataType: 'json',
        data: { id: val },
        success: function(response) {
            Swal.fire({
                icon: response.status === 'success' ? 'success' : 'error',
                title: response.status === 'success' ? 'Activated!' : 'Error',
                text: response.message
            }).then(() => {
                if (response.status === 'success') {
                    window.location.reload();
                }
            });
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong while activating the blog.'
            });
        }
    });
}

</script>

<script>
    function inactive(val) {
        $.ajax({
            type: 'post',
            url: 'inactiveblog.php',
            data: {
                id: val
            },
            success: function(response) {
                console.log('success');
                // alert('Inactive');
                // window.location.reload();
                  Swal.fire({
                    title: "Inactive!",
                    text: "Blog is Inactivated!",
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        });
    }
</script>