<?php
include 'includes/header.php';
include './includes/db.php';
include './vendor/autoload.php';

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../admin/assets/css/style2.css">

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <!-- <div class="breadcrumb-title pe-3">Forms</div> -->
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="./index.php"><i class="bx bx-home-alt"></i></a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>


        <?php
        $query = mysqli_query($conn, "SELECT * FROM questionnaire tbl1, quotation tbl2 WHERE tbl1.que_id=tbl2.que_id AND tbl1.customer_id='" . $_GET['cusId'] . "' AND tbl1.status=1 AND tbl1.que_id = '" . $_GET['queId'] . "'");
        $fet = mysqli_fetch_array($query);


        $excessQuote = mysqli_query($conn, "SELECT *FROM quotation_addon WHERE que_id='" . $_GET['queId'] . "' && customer_id='" . $_GET['cusId'] . "' && status=1")

            ?>

        <!-- <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card PrintArea" id="invoice">
                    <div
                        style="padding: 25px;font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
                        <?php
                        $data = file_get_contents('https://mmworkspace.com/mr.Interior/admin/assets/images/FYI-logo.png');
                        $base64 = 'data:image/' . 'png' . ';base64,' . base64_encode($data);
                        ?>
                        <img src="<?php echo $base64; ?>" width="155px" />
                        <table style="width: 100%; margin: 10px 0px;">
                            <tr style="width: 100%;">
                                <td style="width: 33%; line-height: 25px;">
                                    <label style="margin-bottom: 0px;">To</label><br />
                                    <label
                                        style="font-weight: bold; font-size: 15px; margin-bottom:0px"><?php echo $fet['first_name'] . " " . $fet['last_name'] ?></label><br />
                                    <?php echo $fet['email'] ?><br />
                                    <?php echo $fet["street"] ?>,<?php echo $fet["locality"] ?><br />
                                    <?php echo $fet["city"] ?>,<?php echo $fet["state"] ?><br />

                                    
                                    <span style="font-weight: bold;">Sub:</span> Quote for
                                    <?php echo $fet['property'] ?>(<?php echo $fet['property_type'] ?>) Interiors
                                </td>

                                <td style="width: 33%; line-height: 25px; text-align: right;">
                                    <label style="margin-bottom: 0px;">From</label><br />
                                    <label
                                        style="font-weight: bold; font-size: 15px; margin-bottom: 0px;">Mr.Interior</label>
                                    <br />
                                    Kacheguda Railway Station<br />
                                    9FQX+RQ3, RTC Colony, Kachiguda,<br />
                                    Hyderabad, Telangana 500027<br />
                                    <span style="font-weight: bold;">GSTIN: H0965B43Y8K56 </span>

                                </td>
                            </tr>
                        </table>
                        <hr />
                        <table style="width: 100%;">
                            <tr style="background: #13c8e5; color: white;">
                                <th>S:No</th>
                                <th>Excess Items</th>
                                <th>Quantity</th>
                                <th>Cost</th>
                                <th>Amount</th>
                            </tr>
                            <?php
                            $getExcessQuote = mysqli_query($conn, "SELECT * FROM quotation_addon WHERE que_id='" . $_GET['queId'] . "' && customer_id='" . $_GET['cusId'] . "' && status = 1");
                            $i = 1;

                            while ($fetch = mysqli_fetch_array($getExcessQuote)) {


                                ?>

                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $fetch['item_name'] ?></td>
                                    <td><?php echo $fetch['quantity'] ?></td>
                                    <td><?php echo $fetch['item_cost'] ?></td>
                                    <td><?php echo ($fetch['quantity'] * $fetch['item_cost']) ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr style="background: #eee;">
                                <th colspan="4">Total</th>
                                <td>3,09,800</td>
                            </tr>
                        </table>
                        <hr />
                        <table style="width: 100%;  bottom: 0;">
                            <tr style="width: 100%; text-align:center;">
                                <td style="width: 0%;">
                                    <div>
                                        <h5>
                                            Terms And Conditions:<br />
                                        </h5>
                                    </div>
                                </td>
                            </tr>
                            <tr style="width: 100%; text-align:center;">
                                <td style="width: 0%;">
                                    <?php $dt = '["created_At"]';
                                    $date = strtotime(str_replace(',', '', $dt));
                                    ?>
                                    <strong>Note:</strong> This quotation is available upto 30days from the day you have
                                    prepared your Quotation<?php echo $date; ?>
                                </td>
                            </tr>
                        </table>
                        <table style="width: 100%;  bottom: 0;">
                            <tr style="width: 0%; text-align:center;">
                                <td style="width: 0%;">
                                    <div>
                                        <strong>
                                            Contact:
                                        </strong>
                                    </div>
                                </td>
                            </tr>
                            <tr style="width: 0%; text-align:center;">
                                <td style="width: 0%;">
                                    <strong> Email:</strong> interior@gmail.com | ph.no: 7321456849 , 9785403216
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>


                <div class="col-md-12 download-print-container">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" id="download" name="submit"
                            class="btn btn-primary px-4 submit">Download</button>
                    </div>
                  
                    <button type="submit" id="print_button" name="submit"
                        class="btn btn-primary px-4 submit">Print</button>

                    <button type="button" id="mail_button" name="submit" class="btn btn-info px-4 submit">Send</button>
                 
                </div>
            </div>
        </div> -->
      
<div id="grandparent">
  <div id="parent">

         <section class="billHeaderSection PrintArea" id="invoice" >
            <div class="container">
                <div class="flexBlock">
                    <div class="logoTitle">
                        <div class="image">
                            <img src="assets/images/voydGreen.png" alt="Logo" />
                        </div>
                    </div>
                    <div class="sideTitleBlock">
                        <h3>Project Estimation Bill</h3>
                        <p>Effortlessly handle your estimation bill right here.</p>
                    </div>
                </div>

               
                <div class="row cardDetailsRow">
                    <div class="col-md-5 columns">
                        <div class="cardOneOuter">
                            <div class="cardOne">
                                <h6>Estimated By:</h6>
                                <h5>VOYD Interior Execution Partner</h5>
                                <p>Plot No 28/A, Survey No 40, Khajaguda, Serilingampalle (M), Telangana 500032</p>
                                <div class="contacts"><span class="email">Email</span><span>info@voyd.com</span></div>
                                <div class="contacts"><span>Phone</span><span>+91 9876543212</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 columns">
                        <div class="cardOneOuter">
                            <div class="cardOne">
                                <h6>Estimation to:</h6>
                                <h5>
                                    <span><img src="assets/images/teamImgBg.png" alt="" /></span>
                                    <?php echo $fet["first_name"] . " " . $fet["last_name"]; ?>
                                </h5>
                                <p><?php echo "{$fet['street']}, {$fet['locality']}, {$fet['city']}, {$fet['state']}"; ?></p>
                                <div class="contacts"><span class="email">Email</span><span><?php echo $fet["email"]; ?></span></div>
                                <div class="contacts"><span>Phone</span><span>+91 <?php echo $fet["mobile"]; ?></span></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="amountCard">
                            <h6>Estimation Amount</h6>
                            <div>
                                <h3>₹ <?php echo number_format((float)$fet['budget'], 0, '.', ','); ?></h3>
                                <h4>INR</h4>
                            </div>
                            <p><?php echo date("M d, Y", strtotime($fet['created_At'])); ?></p>
                        </div>
                    </div>
                </div>

              
                <div class="row">
                    <div class="col-md-12">
                        <div class="billTableCard">
                            <div class="billTable">
                                <table style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>S:No</th>
                                <th>Excess Items</th>
                                <th>Quantity</th>
                                <th>Cost</th>
                                <th>Amount</th>
                                        </tr>
                                    </thead>
                                 <tbody>
<?php
$grandTotal = 0;
$i = 1;

// Fetch and render main quote data
if (!empty($quoteData)) {
    foreach ($quoteData as $areaName => $areaData) {
        foreach ($areaData['tabs'] as $tabIndex => $tab) {
            if (empty($tab)) continue;

            foreach ($tab as $item) {
                $price = isset($item['minimum_price']) ? (float)$item['minimum_price'] : 0;
                $total = $price;
                $grandTotal += $total;
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $item['element_name_display'] . '/' . $item['model']; ?></td>
                    <td>1</td>
                    <td>₹ <?php echo number_format($price, 2, '.', ','); ?></td>
                    <td>₹ <?php echo number_format($total, 2, '.', ','); ?></td>
                </tr>
                <?php
            }
        }
    }
}

// Fetch and render excess quotation data
$getExcessQuote = mysqli_query($conn, "SELECT * FROM quotation_addon WHERE que_id='" . $_GET['queId'] . "' AND customer_id='" . $_GET['cusId'] . "' AND status = 1");

while ($fetch = mysqli_fetch_array($getExcessQuote)) {
    $amount = $fetch['quantity'] * $fetch['item_cost'];
    $grandTotal += $amount;
    ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $fetch['item_name']; ?> (Excess Item)</td>
        <td><?php echo $fetch['quantity']; ?></td>
        <td>₹ <?php echo number_format($fetch['item_cost'], 2, '.', ','); ?></td>
        <td>₹ <?php echo number_format($amount, 2, '.', ','); ?></td>
    </tr>
<?php } ?>
</tbody>

                                </table>
                            </div>

                           
                            <div class="grandTotal leftAligns">
    <h3>Total</h3>
    <h3>₹ <?php echo number_format($grandTotal, 2, '.', ','); ?></h3>
</div>
<?php
$gst = $grandTotal * 0.18;
$finalTotal = $grandTotal + $gst;
?>
<div class="grandTotal gstTotal leftAligns">
    <h3>GST (18%)</h3>
    <h3>₹ <?php echo number_format($gst, 2, '.', ','); ?></h3>
</div>
<div class="grandTotal">
    <h3>Grand Total</h3>
    <h3>₹ <?php echo number_format($finalTotal, 2, '.', ','); ?></h3>
</div>


                          
                            <div class="termsBlock">
                                <h6>Terms & Conditions:</h6>
                                <p>Fees and payment terms will be established in the contract or agreement prior to the commencement of the project.</p>
                            </div>
                            <div class="contactBlock">
                                <div class="details">
                                    <h6>VOYD Interior Designing Solutions</h6>
                                    <p>www.voyd.com</p>
                                    <p>info@voyd.com <span>/ +91 98765 43210</span></p>
                                </div>
                                <div class="logo">
                                    <!-- <img src="assets/images/logo/voydGreen.png" alt="" /> -->
                                    <img src="assets/images/voydGreen.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        </div>
        </div>



          <div class="col-md-12 download-print-container mt-3">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button style="margin:inherit;" type="submit" id="download" name="submit"
                            class="btn btn-primary px-4 submit">Download</button>
                    </div>
                  
                    <button style="margin:inherit;" type="submit" id="print_button" name="submit"
                        class="btn btn-primary px-4 submit">Print</button>

                    <button type="button" id="mail_button" name="submit" style="margin:inherit;" class="btn btn-primary px-4 submit">Mail</button>
                 
                </div>



    </div>

</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.1/html2pdf.bundle.min.js"></script>

<?php include 'includes/footer.php' ?>





<script>
    $("#download").click(function () {
        var pdf_content = document.getElementById("invoice");
        html2pdf(pdf_content, {
            margin: 0.3,
            filename: 'invoice.pdf',
            image: {
                type: 'jpg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2,
                allowTaint: false,
                useCORS: true
            },
            jsPDF: {
                unit: 'in',
                format: 'a3',
                orientation: 'portrait'
            }
        });
    })










</script> 









<script src="assets/js/jquery.PrintArea.js"></script>
<script>
    // $('#print_button').on("click", function () {
    //     $(".PrintArea").printArea();
    // });

$('#print_button').on('click', function() {
  // Get the parent of the invoice div
  var content = $('#invoice').parent().html();

  var printWindow = window.open('', '', 'height=600,width=800');

  printWindow.document.write('<html><head><title>Print</title>');
  
  // Set base href to help with relative paths in CSS/images
  printWindow.document.write('<base href="' + window.location.origin + window.location.pathname + '">');

  // Include CSS files
  printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">');
  printWindow.document.write('<link rel="stylesheet" href="assets/css/style2.css">');
  printWindow.document.write('</head><body>');

  // Write the parent's inner HTML to the print window
  printWindow.document.write(content);

  printWindow.document.write('</body></html>');
  printWindow.document.close();
  printWindow.focus();

  setTimeout(function() {
    printWindow.print();
    printWindow.close();
  }, 1000);
});





 

</script>

<!-- <script>
    $("#mail_button").click(function () {
        $("#mail_button").text('sending.......');
        var data1 = "<?php echo $fet['email']; ?>";
        var inv = $("#invoice").html();
        $.ajax({
            type: 'post',
            url: 'quote-mail.php',
            data: {
                mail: data1,
                invoice: inv
            },
            success: function (response) {
                alert(response);
                $("#mail_button").text('mail sent')
            }
        });
    });


</script> -->



<script>
$(document).ready(function() {
    $("#mail_button").click(function () {
        var $btn = $(this);
        $btn.prop('disabled', true);
        $btn.text('Sending...');

        var recipientEmail = "<?php echo htmlspecialchars($fet['email'], ENT_QUOTES); ?>";
        var queId = "<?php echo htmlspecialchars($_GET['queId'] ?? '', ENT_QUOTES); ?>";
        var cusId = "<?php echo htmlspecialchars($_GET['cusId'] ?? '', ENT_QUOTES); ?>";

        if (!recipientEmail || !queId || !cusId) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Required data missing.',
                confirmButtonText: 'OK'
            });
            $btn.prop('disabled', false);
            $btn.text('Send');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'quote-mail.php',
            data: {
                mail: recipientEmail,
                queId: queId,
                cusId: cusId
            },
            success: function (response) {
                $btn.prop('disabled', false);
                $btn.text('Sent');
                Swal.fire({
                    icon: 'success',
                    title: 'Email Sent!',
                    text: 'Quotation has been successfully sent.',
                    confirmButtonText: 'OK'
                });
            },
            error: function () {
                $btn.prop('disabled', false);
                $btn.text('Sent');
                Swal.fire({
                    icon: 'error',
                    title: 'Failed!',
                    text: 'Something went wrong while sending the email.',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>

