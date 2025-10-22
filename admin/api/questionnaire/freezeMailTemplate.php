<?php
include '../../includes/db.php';
include '../../vendor/autoload.php';

function freezeProject()
{
    return '
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr.Interior</title>
    <link rel="stylesheet" href="table.css">
    <script src="https://kit.fontawesome.com/f4a31849b1.js" crossorigin="anonymous"></script>
    <div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card PrintArea" id="invoice">
                    <div style="padding: 10px;font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Open Sans, Helvetica eue, sans-serif;">
                        
                        <img src="https://mmworkspace.com/mr.Interior/admin/assets/images/FYI-logo.png" width="100px" />
                        <table style="width: 100%; margin: 10px 0px;">
                            <tr style="width: 100%;">
                                <td style="width: 33%; line-height: 25px;">
                                    <label>To</label><br />
                                    <label style="font-weight: bold; font-size: 15px;">Mr.Interior</label><br />
                                    

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
                                   
                                    <strong>Note:</strong> This quotation is available upto 30days from the day you have
                                    prepared your Quotation
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
                    
                    <button type="submit" id="print_button" name="submit" class="btn btn-primary px-4 submit">Print</button>

                    <button type="button" id="mail_button" name="submit" class="btn btn-info px-4 submit">Send</button>
                  
                </div>
            </div>
        </div>

    </div>

</div>
    </div>
    </body>

</html>
';
}
