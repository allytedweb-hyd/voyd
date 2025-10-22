<?php
include '../../includes/db.php';
include "../../vendor/autoload.php";


// Function to generate HTML from report data
function generateQualityCheckReport($report)
{
    $rows = '';
    $index = 1;

    foreach ($report as $item) {

        $productName = htmlspecialchars($item->productName);
        $productType = htmlspecialchars($item->productType);
        $subType = htmlspecialchars($item->subType);
        $verifiedBadge = htmlspecialchars($item->verifiedBadge);
        $rows .= "<tr>
        <td>{$index}</td>
        <td>{$productName}</td>
        <td>{$productType}</td>
        <td>{$subType}</td>
        <td>{$verifiedBadge}</td>
        </tr>";

        $index++;
    }

    return <<<HTML
<!DOCTYPE html>
<html>

<head>
    <title>VOYD interior</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Lato', sans-serif;

        }

        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        a,
        td,
        th {
            font-family: 'Lato', sans-serif;

        }

        @media only screen and (max-width: 600px) {
            table[class="main-table"] {
                width: 100% !important;
            }

            td[class="padded"] {
                padding: 20px 10px !important;
            }

            h1 {
                font-size: 22px !important;
            }

            h3 {
                font-size: 16px !important;
            }

            p {
                font-size: 14px !important;
            }

            td[class="stack-column"],
            td[class="stack-column"] img {
                display: block;
                width: 100% !important;
                text-align: center !important;
            }
        }
    </style>
</head>

<body style="margin:0; padding:0; background-color:#e7f0f8; font-family:Segoe UI sans-serif">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#e7f0f8; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" class="main-table"
                    style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="background-color: #ffffff; padding:50px 30px 5px 30px; color:white;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">
                                        <img src="https://mrinterior.mmworkspace.com/assets/images/Group_1618873800_1.png"
                                            alt="Logo" style="width: 250px; border-radius:6px; margin-bottom:10px;">
                                        <h1 style="margin:0; font-size:16px; color:#434343; font-family: 'Lato', sans-serif; text-decoration: underline;     font-weight: 600;
">
                                            QUALITY CHECK REPORT</h1>
                                        <p
                                            style="margin:5px 0 0; font-size:14px; color:#393939; font-family: 'Lato', sans-serif;">
                                            Keeping standards high
                                            with every report we deliver.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="width:600px;">
                        <td class="padded" style="padding:20px; text-align:center;">
                            <p style="color:#444;">This report summarizes the quality check results for the products you
                                selected. Please review the details below.</p>
                        </td>
                    </tr>
                    <tr style="width:600px;">
                        <td class="padded" style="padding: 0 20px 20px;">
                            <table width="100%" cellpadding="10" cellspacing="0"
                                style="border-collapse: collapse; font-size:14px;">
                                <thead>
                                    <tr style="background-color:#8bc094e0; color:white; font-weight:bold;">
                                        <th align="left">S.no</th>
                                        <th align="left">Product</th>
                                        <th align="left">Type</th>
                                        <th align="left">Subtype</th>
                                        <th align="left">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                              
{$rows}
                        </tbody>
                </table>
            </td>
        </tr>
        <!-- <tr>
            <td align="center" class="padded" style="padding: 20px;">
                <a href="#"
                    style="background-color:#8bc094e0; color:#fff; padding:10px 25px; border-radius:20px; text-decoration:none; font-weight:bold; display:inline-block;">Download
                    Report</a>
            </td>
        </tr> -->

        <tr>
            <td style="background-color: #8bc094e0; padding:30px; color:white; text-align: center;">
                <img src="https://mrinterior.mmworkspace.com/assets/images/Group_1618873800_1.png" alt="VOYD interiors"
                    style="width: 160px; border-radius:6px; margin-bottom:10px;">
                <!-- <p style="margin:0;">My Account · Blog · Help</p> -->
                <p style="margin:10px 0;">
                    <a href="https://facebook.com" style="color:white; margin: 0 10px; text-decoration:none;"
                        target="_blank">
                        <i class="fab fa-facebook fa-xl"></i>
                    </a>
                    <a href="https://twitter.com" style="color:white; margin: 0 10px; text-decoration:none;"
                        target="_blank">
                        <i class="fab fa-twitter fa-xl"></i>
                    </a>
                    <a href="https://instagram.com" style="color:white; margin: 0 10px; text-decoration:none;"
                        target="_blank">
                        <i class="fab fa-instagram fa-xl"></i>
                    </a>
                    <a href="https://wa.me" style="color:white; margin: 0 10px; text-decoration:none;" target="_blank">
                        <i class="fab fa-whatsapp fa-xl"></i>
                    </a>
                </p>
                <p style="font-size: 12px; color: #09373B; margin: 5px 0;">
                    This email was sent to: <a href="mailto:info@example.com"
                        style="color: #FFFFFF; text-decoration: none;">info@example.com</a><br>
                    You are receiving this email because you are subscribed to our mailing list.<br>
                    For any questions, please send to <a href="mailto:info@example.com"
                        style="color: #FFFFFF; text-decoration: none;">info@example.com</a>
                </p>
                <!-- <p style="margin:5px 0;">
                    <a href="#" style="color:white; margin: 0 5px; text-decoration:none;">Unsubscribe</a>
                </p> -->
            </td>
        </tr>
    </table>
    </td>
    </tr>
    </table>
</body>

</html>
HTML;
}
