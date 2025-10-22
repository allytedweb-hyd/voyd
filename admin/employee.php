<?php
include './includes/header.php';
include './includes/db.php';
include './functions/employeeFunctions.php';

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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-employee.php">Add
                                Employees
                        </li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-12 mx-auto">

                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Employees</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Created Date</th>
                                            <th scope="col">Updated Date</th>
                                            <th scope="col" class="actionbuttons">Action</th>
                                            <th scope="col" class="actionbuttons">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $sel = mysqli_query($conn, "SELECT * FROM login_admin WHERE status IN (1, 2) ORDER BY id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                        ?>
                                        <tr>
                                            <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                            <td>
                                                
                                            <!-- <?php echo $fetch['admin_name']; ?> -->

                                                 <div class="tooltip-text"
                                                 data-toggle="tooltip" data-placement="bottom"
                                                    title="<?php echo htmlspecialchars(ucwords(strip_tags($fetch['admin_name']))); ?>">
                                                    <?php echo htmlspecialchars(strip_tags($fetch['admin_name'])); ?>
                                                </div>
                                        
                                        </td>


                                             <?php
                                    $gcategoryid = mysqli_query($conn, "select * from admin_roles where role_id='" . $fetch['role_id'] . "'");
                                    $gcategoryname = mysqli_fetch_array($gcategoryid);
                                    ?>


                                            <td><?php echo $gcategoryname['role'] ?></td>

                                            <td><img class="imagedata"
                                                    src='Uploads/adminRoles/<?php echo $fetch['profile_pic']; ?>' />
                                            </td>

                                            <td><?php echo $fetch['updated_by'] ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($fetch['created_At'])) ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($fetch['updated_at'])) ?></td>
                                            <td class="actionbuttons"><a class="iedit"
                                                    href="./edit-employee.php?id=<?php echo $fetch['id']; ?>"><i
                                                        class='bx bx-edit'></i></a>
                                                <a class="idelete" style="cursor: pointer;" onclick="deleteConfirmation(event, <?php echo $fetch['id']; ?>)"><i
                                                        class='bx bx-trash'></i></a>
                                            </td>

                                            <td class="actionbuttons">
                                            <div class="form-check form-switch">
  <input class="form-check-input statusToggle" type="checkbox" role="switch"  data-id="<?php echo $fetch['id']; ?>"
  <?php echo ($fetch['status'] == 2) ? 'checked' : ''; ?>>
  
</div>
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
        buttons: [    {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+2))'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':not(:nth-last-child(-n+2))'
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
        targets: [5,6], 
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
            window.location.href = `./delete-employee.php?id=${id}`;
        }
    });
}

</script>




<!-- <script>
$(document).ready(function () {
    $('.statusToggle').on('change', function () {
        var checkbox = $(this);
        var id = checkbox.data('id');
        var status = checkbox.is(':checked') ? 2 : 1;

        $.ajax({
            url: 'update-status.php',
            type: 'POST',
            data: {
                id: id,
                status: status
            },
            dataType: 'json', 
            success: function (response) {
                if (response.success) {
                    console.log("Status updated successfully");
                  
                    Swal.fire("Updated!", "", "success");

   


                } else {
                    console.error("Update failed:", response.error);
                    checkbox.prop('checked', !checkbox.is(':checked'));
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", error);
                checkbox.prop('checked', !checkbox.is(':checked'));
            }
        });
    });
});
</script> -->



<script>
    $(document).ready(function () {
    $('.statusToggle').on('change', function () {
        var checkbox = $(this);
        var id = checkbox.data('id');
        var status = checkbox.is(':checked') ? 2 : 1;

        $.ajax({
            url: 'update-status.php',
            type: 'POST',
            data: {
                id: id,
                status: status
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    const isActivated = (status === 2);
                    const message = isActivated ? "Account Activated" : "Account Deactivated";
                    const iconColor = isActivated ? "#28a745" : "#dc3545"; 
                    const icon = isActivated ? "success" : "error";

                    Swal.fire({
                        title: message,
                        width:400,
                        icon: icon,
                        iconColor: iconColor,
                        timer: 1500,
                        showConfirmButton: false
                    });

                } else {
                    console.error("Update failed:", response.error);
                    checkbox.prop('checked', !checkbox.is(':checked')); 
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", error);
                checkbox.prop('checked', !checkbox.is(':checked')); 
            }
        });
    });
});

</script>