<?php
include 'includes/header.php';
include './functions/supersaleFunctions.php';

if (isset($_POST['submit_form'])) {
    addSupersale();
}
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="./super_sale.php">View Super Sale
                        </li></a>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">

        <div class="col-xl-6 mx-auto">

        <div class="card shadow-sm border-0 mb-4" style="max-width: 600px; margin: auto; background-color:#dae3e0; border-radius:20px; padding: 0px 0px 6px 0px;">
  <!-- <h3 class="text-center mb-4 fw-bold text-primary">Last Expired Super Sale</h3> -->
    <h3 class="mb-4 text-center htext mb-4" style="border-radius: 20px 20px 0px 0px;">Last Expired Super Sale</h3>

  <?php
date_default_timezone_set('Asia/Kolkata');

$now = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$nowStr = $now->format('Y-m-d H:i:s');


$query = "
  SELECT * FROM super_sale 
  WHERE status = 1 
  AND CONCAT(end_date, ' ', end_time) < '$nowStr' 
  ORDER BY super_sale_id DESC 
  LIMIT 1
";

$lastsale = mysqli_query($conn, $query);
$fetchsale = mysqli_fetch_array($lastsale);

if ($fetchsale) {
    $start = new DateTime($fetchsale['start_date'] . ' ' . $fetchsale['start_time'], new DateTimeZone('Asia/Kolkata'));
    $end = new DateTime($fetchsale['end_date'] . ' ' . $fetchsale['end_time'], new DateTimeZone('Asia/Kolkata'));

 
    $status = 'Expired';
} else {
    $status = 'No expired sales found';
}
?>


  <form class="row g-3 p-3">
    <div class="col-12">
      <label class="form-label fw-semibold text-secondary">Offer</label>
      <div class="border rounded px-3 py-2 bg-light">
        <?php echo isset($fetchsale['offer']) ? htmlspecialchars($fetchsale['offer']) . '%' : 'N/A'; ?>
      </div>
    </div>

    <div class="col-md-6">
      <label class="form-label fw-semibold text-secondary">Start Date</label>
      <div class="border rounded px-3 py-2 bg-light">
        <?php echo isset($fetchsale['start_date']) ? date('d/m/Y', strtotime($fetchsale['start_date'])) : 'N/A'; ?>
      </div>
    </div>
    <div class="col-md-6">
      <label class="form-label fw-semibold text-secondary">Start Time</label>
      <div class="border rounded px-3 py-2 bg-light">
        <?php echo isset($fetchsale['start_time']) ? date('H:i:s', strtotime($fetchsale['start_time'])) : 'N/A'; ?>
      </div>
    </div>

    <div class="col-md-6">
      <label class="form-label fw-semibold text-secondary">End Date</label>
      <div class="border rounded px-3 py-2 bg-light">
        <?php echo isset($fetchsale['end_date']) ? date('d/m/Y', strtotime($fetchsale['end_date'])) : 'N/A'; ?>
      </div>
    </div>
    <div class="col-md-6">
      <label class="form-label fw-semibold text-secondary">End Time</label>
      <div class="border rounded px-3 py-2 bg-light">
        <?php echo isset($fetchsale['end_time']) ? date('H:i:s', strtotime($fetchsale['end_time'])) : 'N/A'; ?>
      </div>
    </div>

    <div class="col-12">
      <label class="form-label fw-semibold text-secondary"></label>
      <div class="rounded " >
        
      </div>
    </div>
  </form>
</div>


</div>


            <div class="col-xl-6 mx-auto">

                <div class="">
                    <div class="card-body new_card_form">
                        <h3 class="mb-4 text-center htext">Add Super Sale</h3>
                        <form class="row form_new" method="post" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="input1" class="form-label">Offer %<span class="errorindicator">*</span>  <small>must be number</small></label>
                                <input type="number" min="1" 
    step="1" class="form-control" name="offer" id="offer" value="<?php echo isset($_POST['offer']) ? htmlspecialchars($_POST['offer']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Start Date<span class="errorindicator">*</span></label>
                                <input type="date" class="form-control" name="start_date" id="start_date" value="<?php echo isset($_POST['start_date']) ? htmlspecialchars($_POST['start_date']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> Start Time<span class="errorindicator">*</span></label>
                                <input type="time" class="form-control" name="star_time" id="star_time" step="1" value="<?php echo isset($_POST['star_time']) ? htmlspecialchars($_POST['star_time']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> End Date<span class="errorindicator">*</span></label>
                                <input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo isset($_POST['end_date']) ? htmlspecialchars($_POST['end_date']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="input1" class="form-label"> End Time<span class="errorindicator">*</span></label>
                                <input type="time" class="form-control" name="end_time" id="end_time" step="1" value="<?php echo isset($_POST['end_time']) ? htmlspecialchars($_POST['end_time']) : ''; ?>">
                                <p id="errText" class="error-text"></p>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="add-sale" class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-sale" class="btn btn-primary px-4 submit d-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!--end row-->


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
                                        $sel = mysqli_query($conn, "select * from products where status=1 AND productTag='super_sale' ORDER BY product_id DESC");
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
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['product_image']; ?>' />
                                                </td>
                                                <td><?php echo $fetch['product_alttext']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image_1']; ?>' /></td>
                                                <td><?php echo $fetch['alttext_1']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image_2']; ?>' /></td>
                                                <td><?php echo $fetch['alttext_2']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image_3']; ?>' /></td>
                                                <td><?php echo $fetch['alttext_3']; ?></td>
                                                <td><img class="imagedata" src='Uploads/products/<?php echo $fetch['image5']; ?>' /></td>
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




        


    </div>
</div>

<?php include 'includes/footer.php'; ?>,
<script src="./assets/api/supersale.js"></script>


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
        targets: [31], 
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
document.addEventListener("DOMContentLoaded", function () {
    const today = new Date().toISOString().split('T')[0];
    const startDate = document.getElementById("start_date");
    const endDate = document.getElementById("end_date");

    startDate.setAttribute("min", today);
    endDate.setAttribute("min", today);

    startDate.addEventListener("change", function () {
        endDate.setAttribute("min", this.value);
    });
});
</script>
