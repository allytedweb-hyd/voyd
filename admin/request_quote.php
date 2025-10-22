<?php
include 'includes/header.php';
include 'includes/db.php';
include './vendor/autoload.php';

// $user = $_GET['user']


?>



<link rel="stylesheet" href="../admin/assets/css/style2.css">

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
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
        // $query = mysqli_query($conn, "SELECT * FROM questionnaire tbl1, quotation tbl2 WHERE tbl1.que_id=tbl2.que_id AND tbl1.customer_id='" . $user . "' AND tbl1.status=1 AND tbl2.status=1 AND tbl1.que_id = '" . $_GET['id'] . "'");
        // $fet = mysqli_fetch_array($query);

        $user = isset($_GET['user']) ? mysqli_real_escape_string($conn, $_GET['user']) : '';
$queId = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if ($user && $queId) {
    $query = mysqli_query($conn, "
        SELECT * 
        FROM questionnaire tbl1
        JOIN quotation tbl2 ON tbl1.que_id = tbl2.que_id 
        WHERE tbl1.customer_id = '$user' 
        AND tbl1.status = 1 
        AND tbl2.status = 1 
        AND tbl1.que_id = '$queId'
    ");

    if ($query && mysqli_num_rows($query) > 0) {
        $fet = mysqli_fetch_array($query);
        $quoteData = json_decode($fet['quote_data'], true);
    } else {
        echo "<div class='alert alert-warning'>No quotation found for this user.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>Invalid or missing parameters.</div>";
    exit;
}


        
        

        ?>

        <!-- <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card PrintArea" id="invoice">

              


                    <div style="padding: 10px;font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
">
                        <?php
                        $data = file_get_contents('https://mmworkspace.com/mr.Interior/admin/assets/images/FYI-logo.png');
                        $base64 = 'data:image/' . 'png' . ';base64,' . base64_encode($data);
                        ?>
                        <img src="<?php echo $base64; ?>" width="100px" />
                        <table style="width: 100%; margin: 10px 0px;">
                            <tr style="width: 100%;">
                                <td style="width: 33%; line-height: 25px;">
                                    <label>To</label><br />
                                    <label style="font-weight: bold; font-size: 15px;">Mr.Interior</label><br />
                                    <?php echo $fet["email"] ?><br />
                                    <?php echo $fet["street"] ?>,<?php echo $fet["locality"] ?><br />
                                    <?php echo $fet["city"] ?>,<?php echo $fet["state"] ?><br />

                                    
                                    <span style="font-weight: bold;">Sub:</span> Quote for 2BHK Falt Interior works
                                </td>

                                <td style="width: 33%; line-height: 25px; text-align: right;">
                                    <label>From</label><br />
                                    <label style="font-weight: bold; font-size: 15px;">Mr.Interior</label>
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
                                <th>Master BedroomItems</th>
                                <th>Sq.ft</th>
                                <th>Rate</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sliding Wardrobes</td>
                                <td>state</td>
                                <td>2400</td>
                                <td>2,16,000</td>
                            </tr>
                            <tr style="background: #eee;">
                                <td>2</td>
                                <td>Dressing Table</td>
                                <td>21</td>
                                <td>1800</td>
                                <td>37,800</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>King Size Bed Without Matters</td>
                                <td></td>
                                <td></td>
                                <td>56,000</td>
                            </tr style="background: #eee;">

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr style="background: #eee;">
                                <th colspan="4">Total</th>
                                <td>3,09,800</td>
                            </tr>
                            <tr style="background: #13c8e5; color: white;">
                                <th></th>
                                <th>Kids BedroomItems</th>
                                <th>Sq.ft</th>
                                <th>Rate</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Sliding Wardrobes</td>
                                <td>81</td>
                                <td>2400</td>
                                <td>1,94,000</td>
                            </tr>

                            <tr style="background: #eee;">
                                <td>5</td>
                                <td>Dressing Table</td>
                                <td>21</td>
                                <td>1800</td>
                                <td>37,800</td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td>Queen Size Bed Without Matters </td>
                                <td></td>
                                <td></td>
                                <td>56,000</td>
                            </tr>

                            <tr style="background: #eee;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <th colspan="4">Total</th>
                                <td>2,88,200</td>
                            </tr>


                            <tr style="background: #13c8e5; color: white;">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <tr style="background: #eee;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr style="background: #eee;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <th colspan="4">Total</th>
                                <td></td>
                            </tr>


                            <tr style="background: #13c8e5; color: white;">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <tr style="background: #eee;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr style="background: #eee;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <th colspan="4">Total</th>
                                <td></td>
                            </tr>

                            <tr style="background: #13c8e5; color: white;">
                                <th></th>
                                <th scope="col" colspan="5" style="background: #13c8e5; color: white;">Dinning & Living
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <tr style="background: #eee;">
                                <td>7</td>
                                <td>Base Unit</td>
                                <td>30</td>
                                <td>1900</td>
                                <td>57,000</td>
                            </tr>

                            <tr>
                                <td>8</td>
                                <td>Wall Unit</td>
                                <td>18</td>
                                <td></td>
                                <td>34,200</td>
                            </tr>

                            <tr style="background: #eee;">
                                <td>9</td>
                                <td>Loft</td>
                                <td>20</td>
                                <td></td>
                                <td>38,000</td>
                            </tr>

                            <tr>
                                <td>10</td>
                                <td>Tandem Basket + Accessories </td>
                                <td></td>
                                <td></td>
                                <td>1,00,000</td>
                            </tr>

                            <tr style="background: #eee;">
                                <th colspan="4">Total</th>
                                <td>2,29,200</td>
                            </tr>

                            <tr>
                                <td>11</td>
                                <td>Crockery Unit</td>
                                <td>35</td>
                                <td>2400</td>
                                <td>84,000</td>
                            </tr>

                            <tr style="background: #eee;">
                                <td>12</td>
                                <td>Partition</td>
                                <td>45</td>
                                <td></td>
                                <td>1,08,000</td>
                            </tr>

                            <tr>
                                <td>13</td>
                                <td>Tv Unit</td>
                                <td>63</td>
                                <td></td>
                                <td>1,51,200</td>
                            </tr>

                            <tr style="background: #eee;">
                                <th colspan="4">Total</th>
                                <td>3,43,200</td>
                            </tr>

                            <tr style="background: #13c8e5; color: white;">
                                <th></th>
                                <th scope="col" colspan="5">Others</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <tr style="background: #eee;">
                                <td>14</td>
                                <td>Shoe Rack</td>
                                <td>20</td>
                                <td>1800</td>
                                <td>36,000</td>
                            </tr>

                            <tr>
                                <td>15</td>
                                <td>False Ceiling</td>
                                <td></td>
                                <td></td>
                                <td>1,50,000</td>
                            </tr>

                            <tr style="background: #eee;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr style="background: #eee;">
                                <th colspan="4">Total</th>
                                <td>1,86,000</td>
                            </tr>

                            <tr>
                                <th colspan="4">Grand Total</th>
                                <td>13,56,400</td>
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
                                        <h5>
                                            Contact:
                                        </h5>
                                    </div>
                                </td>
                            </tr>
                            <tr style="width: 0%; text-align:center;">
                                <td style="width: 0%;">
                                    Email: interior@gmail.com | ph.no: 7321456849 , 9785403216
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
                    <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" id="print_button" name="submit" class="btn btn-primary px-4 submit">Print</button>

                    <button type="button" id="mail_button" name="submit" class="btn btn-info px-4 submit">Send</button>
                    </div>
                     <div class="loader-container">

            <div class="loader"></div>
        </div>
                </div>
            </div>
        </div>  -->
  


        <section class="billHeaderSection">
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
                                            <th class="center">Area</th>
                                            <th>Room</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $grandTotal = 0;
                                        if (!empty($quoteData)) {
                                            foreach ($quoteData as $areaName => $areaData) {
                                                $areaRows = [];
                                                $areaSubTotal = 0;

                                                foreach ($areaData['tabs'] as $tabIndex => $tab) {
                                                    if (empty($tab)) continue;

                                                    foreach ($tab as $item) {
                                                        $price = isset($item['minimum_price']) ? (float)$item['minimum_price'] : 0;
                                                        $areaRows[] = [
                                                            'area' => $areaName,
                                                            'room' => $areaName . '-' . ($tabIndex + 1),
                                                            'item' => $item['element_name_display'] . '/' . $item['model'],
                                                            'qty' => 1,
                                                            'unit_price' => $price,
                                                            'total' => $price
                                                        ];
                                                        $areaSubTotal += $price;
                                                    }
                                                }

                                                $rowCount = count($areaRows);
                                                foreach ($areaRows as $index => $row) {
                                                    echo '<tr>';
                                                    if ($index == 0) {
                                                        echo '<td rowspan="' . $rowCount . '"><strong>' . $row['area'] . '</strong></td>';
                                                    }
                                                    if ($index == 0 || $areaRows[$index]['room'] !== $areaRows[$index - 1]['room']) {
                                                        $roomRowSpan = count(array_filter($areaRows, function ($r) use ($row) {
                                                            return $r['room'] === $row['room'];
                                                        }));
                                                        echo '<td rowspan="' . $roomRowSpan . '"><strong>' . $row['room'] . '</strong></td>';
                                                    }
                                                    echo '<td>' . $row['item'] . '</td>';
                                                    echo '<td>1</td>';
                                                    echo '<td>₹ ' . number_format($row['unit_price'], 2, '.', ',') . '</td>';
                                                    echo '<td>₹ ' . number_format($row['total'], 2, '.', ',') . '</td>';
                                                    echo '</tr>';
                                                }

                                                echo '<tr class="subTotalRow">';
                                                echo '<td colspan="5" class="subTotalText"><strong>SUB TOTAL</strong></td>';
                                                echo '<td><strong>₹ ' . number_format($areaSubTotal, 2, '.', ',') . '</strong></td>';
                                                echo '</tr>';

                                                $grandTotal += $areaSubTotal;
                                            }
                                        }
                                        ?>
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
                                    <img src="assets/images/logo/voydGreen.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
  
  
    </div>

</div>
</div>

<?php include 'includes/footer.php' ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.1/html2pdf.bundle.min.js"></script>


<script>
    $("#download").click(function() {
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
                format: 'a4',
                orientation: 'portrait'
            }
        });
    })
</script>
<script src="assets/js/jquery.PrintArea.js"></script>
<script>
    $('#print_button').on("click", function() {
        $(".PrintArea").printArea();
    });
</script>

<script>
    $("#mail_button").click(function() {
        $("#mail_button").text('sending.......');
        var data1 = $("#quotemail").val();
        var inv = $("#invoice").html();
        $.ajax({
            type: 'post',
            url: 'quote-mail.php',
            data: {
                mail: data1,
                invoice: inv
            },
            success: function(response) {
                alert(response);
                $("#mail_button").text('mail sent')
            }
        });
    });
</script>

<script>
  function formatCurrency(currencyString) {
    const amount = parseFloat(currencyString);
    return amount.toLocaleString('en-IN', {
      style: 'currency',
      currency: 'INR',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });
  }

  // Example usage:
  console.log(formatCurrency("1234567"));     
  console.log(formatCurrency("1234567.89"));  
</script>
