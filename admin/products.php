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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./add-products.php">Add Products
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
                                            <th scope="col">Title</th>
                                            <th scope="col">Room</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Sub-Category</th>
                                            <th scope="col">Product Brand</th>
                                            <!-- <th scope="col">Dimensions</th> -->
                                            <th scope="col">Color</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Material</th>
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
                                            <th scope="col">MRP</th>
                                            <th scope="col">Offer Price</th>
                                            <th scope="col">Product Priority</th>
                                            <th scope="col">Product Tag</th>
                                            <th scope="col">GST</th>
                                            <th scope="col">Other</th>
                                            <th scope="col">Stock Keeping Unit</th>
                                            <th scope="col">Features</th>
                                            <th scope="col">Courier</th>
                                            <th scope="col">Shipping</th>
                                            <th scope="col">Gound Shipping</th>
                                            <th scope="col">Global Export</th>
                                            
                                            <th scope="col">Description</th>
                                            <th scope="col">Additional info</th>
                                            <th scope="col">Specifications</th>
                                            <th scope="col">Rating</th>
                                            <th scope="col">Changed By</th>
                                            <th scope="col">Changed On</th>
                                            <th scope="col" class="actionbuttons">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sel = mysqli_query($conn, "select * from products where status=1 ORDER BY product_id DESC");
                                        $i = 1;

                                        while ($fetch = mysqli_fetch_array($sel)) {
                                        ?>

                                            <tr>
                                                <th scope="row" class="numberrow"><?php echo $i; ?></th>
                                                <td>
                                                    

                                                <?php
        $rawDesc = $fetch['product_title'] ?? '';
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
                                                 $getroomdata=mysqli_query($conn,"SELECT * FROM property_sections WHERE section_id='".$fetch['room']."'");

                                                $rooms=mysqli_fetch_array($getroomdata);

                                                echo $rooms['enter_section'];

                                                  ?>

                                            
                                            </td>
                                                <?php
                                                $categoryid = mysqli_query($conn, "select * from category where category_id='" . $fetch['product_category'] . "'");
                                                $categoryname = mysqli_fetch_array($categoryid);
                                                ?>
                                                <td>
                                                    

                                                <?php
        $rawDesc = $categoryname['category_name'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>
                                            
                                            </td>
                                                <?php
                                                $subcategoryid = mysqli_query($conn, "select * from subcategory where subcategory_id='" . $fetch['sub_category'] . "'");
                                                $subcategoryname = mysqli_fetch_array($subcategoryid);
                                                ?>
                                                <td>
                                                    

                                                <?php
        $rawDesc = $subcategoryname['sub_category'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>
                                            
                                            </td>
                                                <?php
                                                $brandid = mysqli_query($conn, "select * from brand_master where brand_id='" . $fetch['product_brand'] . "'");
                                                $brandname = mysqli_fetch_array($brandid);
                                                ?>
                                                <td><?php echo $brandname['enter_brand']; ?></td>
                                                <!-- <td><php echo $fetch['product_size']; ?></td> -->
                                                <?php
                                                $colorid = mysqli_query($conn, "select * from colors where color_id='" . $fetch['product_color'] . "'");
                                                $colorname = mysqli_fetch_array($colorid);
                                                ?>
                                                <td><?php echo $colorname['color_code']; ?></td>
                                                <td><?php echo $fetch['product_quantity']; ?></td>
                                                <?php
                                                $materialid = mysqli_query($conn, "select * from material where material_id='" . $fetch['product_material'] . "'");
                                                $materialname = mysqli_fetch_array($materialid);
                                                ?>
                                                <td><?php echo $materialname['material_name']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image_4']; ?>' />
                                                </td>
                                                <td><?php echo $fetch['product_alttext']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image_1']; ?>' /></td>
                                                <td><?php echo $fetch['alttext_1']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image_2']; ?>' /></td>
                                                <td><?php echo $fetch['alttext_2']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image_3']; ?>' /></td>
                                                <td><?php echo $fetch['alttext_3']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image_5']; ?>' /></td>
                                                <td><?php echo $fetch['img_alt_text5']; ?></td>
                                                <td><?php echo $fetch['product_mrp']; ?></td>
                                                <td><?php echo $fetch['product_offerprice']; ?></td>
                                                <td><?php echo $fetch['productPriority']; ?></td>
                                                <td><?php echo $fetch['productTag']; ?></td>
                                                <td><?php echo $fetch['gst']; ?></td>
                                                <td><?php echo $fetch['other']; ?></td>
                                                <td><?php echo $fetch['sku']; ?></td>

                                   <td>
<?php
$featuresJson = $fetch['product_features'] ?? '[]'; 
$featuresArr = json_decode($featuresJson, true);

if (is_array($featuresArr) && count($featuresArr) > 0) {
    $tooltipContent = '<ul class="tooltip-feature-list">';
    foreach ($featuresArr as $feature) {
        $icon = htmlspecialchars($feature['icon'] ?? '');
        $text = htmlspecialchars($feature['text'] ?? '');
        $tooltipContent .= '<li class="tooltip-feature-item">';
        if ($icon) {
            $tooltipContent .= '<img class="tooltip-feature-icon" src="Uploads/products/' . $icon . '" alt="' . $text . '" />';
        }
        $tooltipContent .= '<span class="tooltip-feature-text">' . $text . '</span>';
        $tooltipContent .= '</li>';
    }
    $tooltipContent .= '</ul>';

    // Escape for HTML attribute
    $tooltipContentAttr = htmlspecialchars($tooltipContent, ENT_QUOTES);

    echo '<span data-bs-toggle="tooltip" data-bs-html="true" title="' . $tooltipContentAttr . '" class="tooltip-feature-trigger" style="cursor:pointer; text-decoration:underline; color:blue;">View Features</span>';
} else {
    echo 'No features';
}
?>
</td>

 <td><?php echo $fetch['courier']; ?></td>
 <td><?php echo $fetch['shipping']; ?></td>
 <td><?php echo $fetch['ground_shipping']; ?></td>
 <td><?php echo $fetch['global_export']; ?></td>



                                            


                                                <td>

                                            
                                                <?php
        $rawDesc = $fetch['product_description'] ?? '';
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
        $rawDesc = $fetch['additional_info'] ?? '';
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
        $rawDesc = $fetch['specification'] ?? '';
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
    $productId = $fetch['product_id'];
    $avgQuery = mysqli_query($conn, "
        SELECT AVG(rating) AS avg_rating, COUNT(*) as count 
        FROM customer_reviews 
        WHERE product_title = '$productId' AND status = 1
    ");
    if ($avgQuery) {
        $avgRow = mysqli_fetch_assoc($avgQuery);
        if ($avgRow['count'] > 0 && $avgRow['avg_rating'] !== null) {
            echo round($avgRow['avg_rating'], 2);
        } else {
            echo "No ratings";
        }
    } else {
        echo "Error";
    }
    ?>
</td>


                                                <td><?php echo $fetch['updated_by']; ?></td>
                                                <td><?php echo $fetch['updated_At']; ?></td>
                                                <td class="actionbuttons"><a class="iedit" href="./edit-products.php?id=<?php echo $fetch['product_id']; ?>">
                                                        <i class='bx bx-edit'></i></a>
                                                    <a class="idelete" href="./delete-products.php?id=<?php echo $fetch['product_id']; ?>"><i class='bx bx-trash' name="deleteProduct"></i></a>
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
        targets: [32], 
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
    
document.addEventListener('DOMContentLoaded', function () {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl);
  });
});

</script>