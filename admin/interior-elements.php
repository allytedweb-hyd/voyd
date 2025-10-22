<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/elementFunctios.php';

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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-elements.php">Add Interior Elements</li></a>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="">
            <div class="">
                <div class="">
                    <div class="card-body new_card">
                        <h3 class="mb-4 text-center htext">View Interior Elements</h3>
                        <div class="row" style="padding: 0px 10px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example2">
                                    <thead>
                                        <tr class="tableheadingrow">
                                            <th scope=" col">S.No</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Element Name</th>
                                            <th scope="col">Model</th>
                                            <th scope="col">Design Type</th>
                                            <th scope="col">Material</th>
                                            <th scope="col">Maker Classification</th>
                                            <th scope="col">Material Classification</th>
                                            <th scope="col">Length</th>
                                            <th scope="col">Width</th>
                                            <th scope="col">Height</th>
                                            <th scope="col">Units</th>
                                            <th scope="col">Cost Per 1Sqft</th>
                                            <th scope="col">Minimum Price</th>
                                            <th scope="col">Maximum Price</th>
                                            <th scope="col">Total Sqft</th>
                                            <th scope="col">Description</th>
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
                                        $sel = mysqli_query($conn, "select * from interior_elements where status=1 ORDER BY element_id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                        ?>
                                            <tr>
                                                <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                                <?php 
                                                $categoryid = mysqli_query($conn, "select * from property_sections where section_id='".$fetch['element_category']."'");
                                                $categoryname = mysqli_fetch_array($categoryid);                                            
                                                ?>
                                                <td><?php echo $categoryname['enter_section']; ?></td>
                                                <?php
                                                $elementid = mysqli_query($conn, "select * from element_master where element_id='".$fetch['element_name']."'");
                                                $elementname =  mysqli_fetch_array($elementid);
                                                ?>
                                                <td><?php echo $elementname['element_name']; ?></td>
                                                <td><?php echo $fetch['model']; ?></td>
                                                <?php 
                                                $designid = mysqli_query($conn, "select * from interior_elements where element_id='".$fetch['product_design']."'");
                                                $designname = mysqli_fetch_array($designid);                                            
                                                ?>
                                                <td><?php echo $fetch['product_design']; ?></td>

                                                <?php 
                                                $materialid = mysqli_query($conn, "select * from material where material_id='".$fetch['material']."'");
                                                $materialname = mysqli_fetch_array($materialid);                                            
                                                ?>
                                                <td><?php echo $materialname['material_name']; ?></td>

                                                
                                                <?php $getmakerss = mysqli_query($conn, "SELECT * FROM classification WHERE classification_id='".$fetch['product_classification']."'");

                                                $makerss= mysqli_fetch_array( $getmakerss);
                                                ?>


                                                <td><?php echo $fetch['product_classification']; ?></td>
                                                <td><?php echo $fetch['material_classification']; ?></td>

                                                <td><?php echo $fetch['length']; ?></td>
                                                <td><?php echo $fetch['width']; ?></td>
                                                <td><?php echo $fetch['height']; ?></td>
                                                <td><?php echo $fetch['units']; ?></td>
                                                <td><?php echo $fetch['cost_per_sqft']; ?></td>
                                                <td><?php echo $fetch['minimum_price']; ?></td>
                                                <td><?php echo $fetch['maximum_price']; ?></td>
                                                <td><?php echo $fetch['squnits']; ?></td>
                                                <td>
    <?php
        $rawDesc = $fetch['element_description'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>
</td>


                                                <td><img class="imagedata" src='Uploads/elements/<?php echo $fetch['element_image'] ?>' /></td>
                                                <td><?php echo $fetch['element_alttext']; ?></td>
                                                <td><img class="imagedata" src='Uploads/elements/<?php echo $fetch['image_1'] ?>' /></td>
                                                <td><?php echo $fetch['alttext_1']; ?></td>
                                                <td><img class="imagedata" src='Uploads/elements/<?php echo $fetch['image_2'] ?>' /></td>
                                                <td><?php echo $fetch['alttext_2']; ?></td>
                                                <td><img class="imagedata" src='Uploads/elements/<?php echo $fetch['image_3'] ?>' /></td>
                                                <td><?php echo $fetch['alttext_3']; ?></td>
                                                <td><img class="imagedata" src='Uploads/elements/<?php echo $fetch['image_4'] ?>' /></td>
                                                <td><?php echo $fetch['alttext_4']; ?></td>
                                             
                                                <td><?php echo $fetch['updated_by']; ?></td>
                                                <td><?php echo $fetch['updated_At']; ?></td>
                                                <td class="actionbuttons"><a class="iedit" href="./edit-elements.php?id=<?php echo $fetch['element_id']; ?>"> <i class='bx bx-edit'></i></a>
                                                    <a class="idelete" href="./delete-elements.php?id=<?php echo $fetch['element_id']; ?>"><i class='bx bx-trash' name="deleteTestimonial"></i></a>
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
        targets: [28], 
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