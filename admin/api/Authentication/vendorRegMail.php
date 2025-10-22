<?php

include "../../includes/db.php";
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin,authorization");


ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "../../vendor/autoload.php";

include '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
include '../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$json = file_get_contents('php://input');
$data = json_decode($json);

@$vendorFirstName = $data->VendorFirstName;
@$vendorLastName = $data->vendorLastName;
@$vendorMobile = $data->vendorMobileNo;
@$vendorMail = $data->vendorEmail;
@$vendorCompany = $data->vendorCompany;
@$vendorGst = $data->vendorGstNo;
@$vendorAadhar = $data->vendorAadharNo;
@$vendorPan = $data->vendorPanNo;
@$vendorClass = $data->vendorClassification;
@$vendorLocality = $data->vendorLocality;
@$vendorCity = $data->vendorCity;
@$vendorState = $data->vendorState;
@$vendorAddress = $data->vendorAddress;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = 'mrinterior@mmworkspace.com';                     //SMTP username
    $mail->Password = 'Interior@321$#';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mrinterior@mmworkspace.com', 'VOYD Interiors');
    $mail->addAddress("harisatya@makersmind.in");               //Name is optional    
    $mail->addAddress("sripriyaallyted@gmail.com");               //Name is optional    
    $mail->addAddress($vendorMail);               //Name is optional    

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Vendor Registration';
    $mail->Body = '<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title>New Message 2</title>
    <!--[if (mso 16)]><style type="text/css"> a {text-decoration: none;}  </style><![endif]--><!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--><!--[if gte mso 9]><xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml>
<![endif]--><!--[if !mso]><!-- -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700,700i" rel="stylesheet"><!--<![endif]-->
    <style type="text/css">
        .rollover:hover .rollover-first {
            max-height: 0px !important;
            display: none !important;
        }

        .rollover:hover .rollover-second {
            max-height: none !important;
            display: block !important;
        }

        .rollover span {
            font-size: 0px;
        }

        u+.body img~div div {
            display: none;
        }

        #outlook a {
            padding: 0;
        }

        span.MsoHyperlink,
        span.MsoHyperlinkFollowed {
            color: inherit;
            mso-style-priority: 99;
        }

        a.es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        h3 {
            margin: 0px !important;
            font-size: 20px;
        }

        p {
            margin: 0px !important;

        }

        a[x-apple-data-detectors],
        #MessageViewBody a {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        .es-button.es-button-2538 {
            padding: 10px 30px;
            color: #ffffff !important;
            border-color: #2CB543;
            background: #189858;
            border-radius: 6px;
        }

        .es-button.es-button-2538:hover {
            background: #117c46;
        }

        @media only screen and (max-width:600px) {
            .es-m-p15t {
                padding-top: 15px !important
            }

            .es-m-p10r {
                padding-right: 10px !important
            }

            .es-m-p10l {
                padding-left: 10px !important
            }

            .es-m-p10t {
                padding-top: 10px !important
            }

            .es-m-p15r {
                padding-right: 15px !important
            }

            .es-m-p10b {
                padding-bottom: 10px !important
            }

            .es-m-p15l {
                padding-left: 15px !important
            }

            .es-m-p0t {
                padding-top: 0px !important
            }

            .es-m-p0b {
                padding-bottom: 0px !important
            }

            .halfTable .es-left {
                width: 50% !important;
            }

            .halfTable .es-right {
                width: 50% !important;
            }

            .es-m-p5b {
                padding-bottom: 5px !important
            }

            .es-m-p25b {
                padding-bottom: 25px !important;
                padding-top: 30px !important
            }

            .es-m-p4r {
                padding-right: 4px !important
            }

            .es-p-default {}

            *[class="gmail-fix"] {
                display: none !important
            }

            p,
            a {
                line-height: 150% !important
            }

            h1,
            h1 a {
                line-height: 120% !important
            }

            h2,
            h2 a {
                line-height: 120% !important
            }

            h3,
            h3 a {
                line-height: 120% !important
            }

            h4,
            h4 a {
                line-height: 120% !important
            }

            h5,
            h5 a {
                line-height: 120% !important
            }

            h6,
            h6 a {
                line-height: 120% !important
            }

            .es-header-body p {}

            .es-content-body p {}

            .es-footer-body p {}

            .es-infoblock p {}

            h1 {
                font-size: 36px !important;
                text-align: left
            }

            h2 {
                font-size: 26px !important;
                text-align: left
            }

            h3 {
                font-size: 20px !important;
                text-align: left
            }

            h4 {
                font-size: 24px !important;
                text-align: left
            }

            h5 {
                font-size: 20px !important;
                text-align: left
            }

            h6 {
                font-size: 16px !important;
                text-align: left
            }

            .es-header-body h1 a,
            .es-content-body h1 a,
            .es-footer-body h1 a {
                font-size: 36px !important
            }

            .es-header-body h2 a,
            .es-content-body h2 a,
            .es-footer-body h2 a {
                font-size: 26px !important
            }

            .es-header-body h3 a,
            .es-content-body h3 a,
            .es-footer-body h3 a {
                font-size: 20px !important
            }

            .es-header-body h4 a,
            .es-content-body h4 a,
            .es-footer-body h4 a {
                font-size: 24px !important
            }

            .es-header-body h5 a,
            .es-content-body h5 a,
            .es-footer-body h5 a {
                font-size: 20px !important
            }

            .es-header-body h6 a,
            .es-content-body h6 a,
            .es-footer-body h6 a {
                font-size: 16px !important
            }

            .es-menu td a {
                font-size: 12px !important
            }

            .es-header-body p,
            .es-header-body a {
                font-size: 14px !important
            }

            .es-content-body p,
            .es-content-body a {
                font-size: 14px !important
            }

            .es-footer-body p,
            .es-footer-body a {
                font-size: 14px !important
            }

            .es-infoblock p,
            .es-infoblock a {
                font-size: 12px !important
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3,
            .es-m-txt-c h4,
            .es-m-txt-c h5,
            .es-m-txt-c h6 {
                text-align: center !important
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3,
            .es-m-txt-r h4,
            .es-m-txt-r h5,
            .es-m-txt-r h6 {
                text-align: right !important
            }

            .es-m-txt-j,
            .es-m-txt-j h1,
            .es-m-txt-j h2,
            .es-m-txt-j h3,
            .es-m-txt-j h4,
            .es-m-txt-j h5,
            .es-m-txt-j h6 {
                text-align: justify !important
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3,
            .es-m-txt-l h4,
            .es-m-txt-l h5,
            .es-m-txt-l h6 {
                text-align: left !important
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important
            }

            .es-m-txt-r .rollover:hover .rollover-second,
            .es-m-txt-c .rollover:hover .rollover-second,
            .es-m-txt-l .rollover:hover .rollover-second {
                display: inline !important
            }

            .es-m-txt-r .rollover span,
            .es-m-txt-c .rollover span,
            .es-m-txt-l .rollover span {
                line-height: 0 !important;
                font-size: 0 !important;
                display: block
            }

            .es-spacer {
                display: inline-table
            }

            a.es-button,
            button.es-button {
                font-size: 20px !important;
                padding: 10px 20px 10px 20px !important;
                line-height: 120% !important
            }

            a.es-button,
            button.es-button,
            .es-button-border {
                display: inline-block !important
            }

            .es-m-fw,
            .es-m-fw.es-fw,
            .es-m-fw .es-button {
                display: block !important
            }

            .es-m-il,
            .es-m-il .es-button,
            .es-social,
            .es-social td,
            .es-menu.es-table-not-adapt {
                display: inline-block !important
            }

            .es-adaptive table,
            .es-left,
            .es-right {
                width: 100% !important
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important
            }

            .es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important
            }

            tr.es-desk-hidden {
                display: table-row !important
            }

            table.es-desk-hidden {
                display: table !important
            }

            td.es-desk-menu-hidden {
                display: table-cell !important
            }

            .es-menu td {
                width: 1% !important
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important
            }

            .h-auto {
                height: auto !important
            }

            .img-6902 {
                width: 93px !important;
                height: auto !important
            }

            .img-9248 {
                width: 100% !important
            }

            .img-6575 {
                width: 103px !important;
                height: auto !important
            }

            .es-text-1754 .es-text-mobile-size-13.es-override-size,
            .es-text-1754 .es-text-mobile-size-13.es-override-size * {
                font-size: 13px !important;
                line-height: 150% !important
            }

            .es-text-6142 .es-text-mobile-size-13.es-override-size,
            .es-text-6142 .es-text-mobile-size-13.es-override-size * {
                font-size: 13px !important;
                line-height: 150% !important
            }

            a.es-button.es-button-2538 {
                font-size: 14px !important;
                padding: 10px 20px 5px !important
            }

            .es-text-6411 .es-text-mobile-size-18.es-override-size,
            .es-text-6411 .es-text-mobile-size-18.es-override-size * {
                font-size: 18px !important;
                line-height: 110% !important
            }

            .es-text-7810 .es-text-mobile-size-14.es-override-size,
            .es-text-7810 .es-text-mobile-size-14.es-override-size * {
                font-size: 14px !important;
                line-height: 150% !important
            }

            .es-text-7603 .es-text-mobile-size-18.es-override-size,
            .es-text-7603 .es-text-mobile-size-18.es-override-size * {
                font-size: 18px !important;
                line-height: 110% !important
            }

            .es-text-4446 .es-text-mobile-size-14.es-override-size,
            .es-text-4446 .es-text-mobile-size-14.es-override-size * {
                font-size: 14px !important;
                line-height: 150% !important
            }

            .es-text-6313 .es-text-mobile-size-18.es-override-size,
            .es-text-6313 .es-text-mobile-size-18.es-override-size * {
                font-size: 18px !important;
                line-height: 110% !important
            }

            .es-text-6047 .es-text-mobile-size-14.es-override-size,
            .es-text-6047 .es-text-mobile-size-14.es-override-size * {
                font-size: 14px !important;
                line-height: 150% !important
            }
        }

        @media screen and (max-width:384px) {
            .mail-message-content {
                width: 414px !important
            }
        }
    </style>
</head>

<body class="body"
    style="width:100%;height:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
    <div dir="ltr" class="es-wrapper-color" lang="en" style="background-color:#FAFAFA">
        <!--[if gte mso 9]><v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t"> <v:fill type="tile" color="#fafafa"></v:fill> </v:background><![endif]-->
        <table width="100%" cellspacing="0" cellpadding="0" class="es-wrapper" role="none"
            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FAFAFA">
            <tr>
                <td valign="top" style="padding:0;Margin:0">
                    <table cellpadding="0" cellspacing="0" align="center" class="es-content" role="none"
                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important">
                        <tr>
                            <td align="center" style="padding:0;Margin:0">
                                <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0"
                                    class="es-content-body"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:600px"
                                    role="none">
                                    <tr>
                                        <td align="left" bgcolor="#ffffff" class="es-m-p15t es-m-p10l es-m-p10r"
                                            style="padding:0;Margin:0;padding-top:20px;padding-right:20px;padding-left:20px;background-color:#ffffff">
                                            <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:560px">
                                                        <table width="100%" cellpadding="0" cellspacing="0"
                                                            role="presentation" bgcolor="#179a59"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#179a59">
                                                            <tr>
                                                                <td align="left"
                                                                    style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;padding-left:25px;font-size:0">
                                                                    <a href="https://mrinterior.mmworkspace.com/"
                                                                        target="_blank">
                                                                        <img src="https://ejoaiel.stripocdn.email/content/guids/CABINET_9f9fa5a9ab437e3bda70690849dd1d0930a5bf60afd63ed31461530eaee4dcfd/images/voydwite.png"
                                                                            alt="VOYD Interiors" width="120"
                                                                            title="VOYD Interiors" class="img-6575"
                                                                            height="45"
                                                                            style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" bgcolor="#ffffff" class="es-m-p10l es-m-p10r"
                                            style="padding:0;Margin:0;padding-right:20px;padding-left:20px;background-color:#ffffff">
                                            <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:560px">
                                                        <table cellpadding="0" cellspacing="0" role="presentation"
                                                            width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0;Margin:0;font-size:0"><img alt=""
                                                                        src="https://ejoaiel.stripocdn.email/content/guids/CABINET_9f9fa5a9ab437e3bda70690849dd1d0930a5bf60afd63ed31461530eaee4dcfd/images/groupban.png"
                                                                        class="img-9248" width="560"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" bgcolor="#ffffff" class="es-m-p10l es-m-p10r"
                                            style="padding:0;Margin:0;padding-right:20px;padding-left:20px;background-color:#ffffff">
                                            <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:560px">
                                                        <table cellpadding="0" cellspacing="0" role="presentation"
                                                            width="100%" bgcolor="#ffffff"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff">
                                                            <tr>
                                                                <td align="center" class="es-m-p10t"
                                                                    style="padding:0;Margin:0;padding-top:15px">
                                                                    <a target="_blank"
                                                                        href="https://mrinterior.mmworkspace.com/"
                                                                        class="es-button es-button-2538" style="mso-style-priority:100 !important;text-decoration:none !important;mso-line-height-rule:exactly;color:#FFFFFF;font-size:16px;padding:10px 30px;display:inline-block;background:#189858;border-radius:5px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;font-weight:normal;font-style:normal;line-height:19.2px;width:auto;text-align:center;letter-spacing:0;mso-padding-alt:0;mso-border-alt:10px
                                                                        solid #189858">
                                                                        <span class="es-button-border"
                                                                            style="border-style:solid;border-color:#2CB543;background:#189858;border-width:0px;display:inline-block;border-radius:5px;width:auto">Visit
                                                                            Our Site </span></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" bgcolor="#ffffff" class="es-m-p10l es-m-p10r"
                                            style="padding:0;Margin:0;padding-right:20px;padding-left:20px;background-color:#ffffff">
                                            <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:295px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:295px">
                                                        <table role="presentation" width="100%" cellpadding="0"
                                                            cellspacing="0" bgcolor="#ffffff"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff">
                                                            <tr>
                                                                <td align="center"
                                                                    class="es-m-p10t es-m-p10b es-m-p15l es-m-p15r"
                                                                    style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px;font-size:0">
                                                                    <img src="https://ejoaiel.stripocdn.email/content/guids/CABINET_9f9fa5a9ab437e3bda70690849dd1d0930a5bf60afd63ed31461530eaee4dcfd/images/column2.png"
                                                                        alt="" width="260" class="adapt-img"
                                                                        height="186"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table> <!--[if mso]></td><td style="width:265px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" align="right" class="es-right"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:265px">
                                                        <table cellspacing="0" role="presentation" width="100%"
                                                            cellpadding="0" bgcolor="#ffffff"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff">
                                                            <tr>
                                                                <td align="left" bgcolor="#ffffff"
                                                                    class="es-m-p0t es-text-6411 es-m-p15l es-m-p15r"
                                                                    style="padding:0;Margin:0;padding-right:20px;padding-top:35px">
                                                                    <h3 class="es-text-mobile-size-18 es-override-size"
                                                                        style="Margin:0;font-family:arial,  helvetica
                                                                        neue, helvetica,
                                                                        sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:20px;font-style:normal;font-weight:bold;line-height:24px;color:#333333">
                                                                        Get Trending Satisfying Designs</h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left"
                                                                    class="es-text-7810 es-m-p0t es-m-p15r es-m-p0b es-m-p15l"
                                                                    style="padding:0;Margin:0;padding-right:20px;padding-top:5px;padding-bottom:5px">
                                                                    <p class="es-text-mobile-size-14 es-override-size"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial,
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:24px;letter-spacing:0;color:#333333;font-size:16px">
                                                                        Use the Objects on Path feature in Adobe
                                                                        illustrator to quickly and precisely arrange
                                                                        objects.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" class="es-m-p0b es-m-p15l"
                                                                    style="padding:0;Margin:0;padding-bottom:40px">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">
                                                                        <strong><a target="_blank"
                                                                                style="mso-line-height-rule:exactly;text-decoration:none;color:#1e76e3;font-size:14px"
                                                                                href="https://mrinterior.mmworkspace.com/">Learn
                                                                                more</a></strong>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" bgcolor="#ffffff" class="es-m-p10r es-m-p10l"
                                            style="padding:0;Margin:0;padding-right:20px;padding-left:20px;background-color:#ffffff">
                                            <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:295px" valign="top"><![endif]-->
                                            <table align="left" cellpadding="0" cellspacing="0" class="es-left"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:295px">
                                                        <table bgcolor="#ffffff" cellspacing="0" role="presentation"
                                                            width="100%" cellpadding="0"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff">
                                                            <!--[if !mso]><!-- -->
                                                            <tr class="es-desk-hidden"
                                                                style="display:none;float:left;overflow:hidden;width:0;max-height:0;line-height:0;mso-hide:all">
                                                                <td align="center"
                                                                    class="es-m-p10t es-m-p10b es-m-p15l es-m-p15r"
                                                                    style="padding:20px;Margin:0;font-size:0"><img
                                                                        src="https://ejoaiel.stripocdn.email/content/guids/CABINET_9f9fa5a9ab437e3bda70690849dd1d0930a5bf60afd63ed31461530eaee4dcfd/images/column1.png"
                                                                        width="255" alt="" class="adapt-img"
                                                                        height="183"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr><!--<![endif]-->
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:295px">
                                                        <table bgcolor="#ffffff" cellpadding="0" cellspacing="0"
                                                            role="presentation" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff">
                                                            <tr>
                                                                <td align="left"
                                                                    class="es-text-6313 es-m-p15l es-m-p15r"
                                                                    style="padding:0;Margin:0;padding-right:20px;padding-left:20px">
                                                                    <h3 class="es-text-mobile-size-18 es-override-size"
                                                                        style="Margin:0;font-family:arial,  helvetica
                                                                        neue, helvetica,
                                                                        sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:20px;font-style:normal;font-weight:bold;line-height:26px;color:#333333">
                                                                        Get Trainings on new materials</h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left"
                                                                    class="es-text-6047 es-m-p15l es-m-p15r"
                                                                    style="padding:0;Margin:0;padding-right:20px;padding-left:20px">
                                                                    <p class="es-text-mobile-size-14 es-override-size"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:24px;letter-spacing:0;color:#333333;font-size:16px">
                                                                        Get access to tons of high-quality,
                                                                        customisable, professionally created presets for
                                                                        mobile and desktop Adobe Photoshop Lightroom.
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" class="es-m-p15l"
                                                                    style="padding:0;Margin:0;padding-left:20px">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:22.4px;letter-spacing:0;color:#1e76e3;font-size:14px">
                                                                        <a target="_blank"
                                                                            style="mso-line-height-rule:exactly;text-decoration:none;color:#1e76e3;font-size:14px;line-height:22.4px"
                                                                            href="https://mrinterior.mmworkspace.com/"><strong>Explore
                                                                                now</strong></a>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table> <!--[if mso]></td><td style="width:265px" valign="top"><![endif]-->
                                            <table align="right" cellpadding="0" cellspacing="0" class="es-right"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:265px">
                                                        <table cellspacing="0" role="presentation" width="100%"
                                                            cellpadding="0" bgcolor="#ffffff"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff">
                                                            <tr class="es-mobile-hidden">
                                                                <td align="center" class="es-m-p15l es-m-p15r"
                                                                    style="padding:0;Margin:0;padding-right:20px;padding-top:10px;padding-bottom:10px;font-size:0">
                                                                    <img src="https://ejoaiel.stripocdn.email/content/guids/CABINET_9f9fa5a9ab437e3bda70690849dd1d0930a5bf60afd63ed31461530eaee4dcfd/images/column1.png"
                                                                        alt="" width="245" class="adapt-img"
                                                                        height="176"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" bgcolor="#ffffff" class="es-m-p10r es-m-p10l"
                                            style="padding:0;Margin:0;padding-right:20px;padding-left:20px;background-color:#ffffff">
                                            <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:295px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:295px">
                                                        <table cellspacing="0" role="presentation" width="100%"
                                                            cellpadding="0" bgcolor="#ffffff"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff">
                                                            <tr>
                                                                <td align="center"
                                                                    class="es-m-p10t es-m-p10b es-m-p15l es-m-p15r"
                                                                    style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px;font-size:0">
                                                                    <img src="https://ejoaiel.stripocdn.email/content/guids/CABINET_9f9fa5a9ab437e3bda70690849dd1d0930a5bf60afd63ed31461530eaee4dcfd/images/column3.png"
                                                                        alt="" width="255" class="adapt-img"
                                                                        height="183"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table> <!--[if mso]></td><td style="width:265px" valign="top"><![endif]-->
                                            <table cellspacing="0" align="right" cellpadding="0" class="es-right"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:265px">
                                                        <table role="presentation" width="100%" bgcolor="#ffffff"
                                                            cellpadding="0" cellspacing="0"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff">
                                                            <tr>
                                                                <td bgcolor="#ffffff" align="left"
                                                                    class="es-text-7603 es-m-p0t es-m-p15l es-m-p15r"
                                                                    style="padding:0;Margin:0;padding-right:20px;padding-top:30px">
                                                                    <h3 class="es-text-mobile-size-18 es-override-size"
                                                                        style="Margin:0;font-family:arial,helvetica
                                                                        neue, helvetica,
                                                                        sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:20px;font-style:normal;font-weight:bold;line-height:24px;color:#333333">
                                                                        Grow your business</h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left"
                                                                    class="es-text-4446 es-m-p0t es-m-p15l es-m-p15r"
                                                                    style="padding:0;Margin:0;padding-right:20px;padding-top:5px;padding-bottom:5px">
                                                                    <p class="es-text-mobile-size-14 es-override-size"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial,
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:24px;letter-spacing:0;color:#333333;font-size:16px">
                                                                        Premiere Pros AI features are crafted for those
                                                                        who merge creativity with cutting-edge
                                                                        technology.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" class="es-m-p5b es-m-p15l"
                                                                    style="padding:0;Margin:0;padding-bottom:40px">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial,
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">
                                                                        <strong><a target="_blank"
                                                                                style="mso-line-height-rule:exactly;text-decoration:none;color:#1e76e3;font-size:14px"
                                                                                href="https://mrinterior.mmworkspace.com/">Discover
                                                                                more</a></strong>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0;Margin:0">
                                            <table cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:600px"
                                                role="none">
                                                <tr>
                                                    <td align="left" class="es-m-p10l es-m-p10r halfTable"
                                                        style="padding:0;Margin:0;padding-right:20px;padding-left:20px;background: #f5f5f5;">
                                                        <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:296px" valign="top"><![endif]-->
                                                        <table cellspacing="0" align="left" cellpadding="0"
                                                            class="es-left" role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0;width:296px">
                                                                    <table cellspacing="0" role="presentation"
                                                                        width="100%" bgcolor="#f5f5f5" cellpadding="0"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#f5f5f5">
                                                                        <tr>
                                                                            <td align="left" class="es-m-p15l"
                                                                                style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-bottom:25px;font-size:0">
                                                                                <a href="https://mrinterior.mmworkspace.com/"
                                                                                    target="_blank">
                                                                                    <img src="https://ejoaiel.stripocdn.email/content/guids/CABINET_9f9fa5a9ab437e3bda70690849dd1d0930a5bf60afd63ed31461530eaee4dcfd/images/voydgreen.png"
                                                                                        alt="" width="136"
                                                                                        class="img-6902" height="50"
                                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table> <!--[if mso]></td>
<td style="width:264px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="right"
                                                            class="es-right" role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0;width:264px">
                                                                    <table cellspacing="0" role="presentation"
                                                                        width="100%" bgcolor="#f5f5f5" cellpadding="0"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#f5f5f5">
                                                                        <tr>
                                                                            <td align="right"
                                                                                class="es-m-p25b es-m-p15r"
                                                                                style="padding:0;Margin:0;padding-right:20px;padding-top:35px;padding-bottom:35px;font-size:0">
                                                                                <table cellpadding="0" cellspacing="0"
                                                                                    class="es-table-not-adapt es-social"
                                                                                    role="presentation"
                                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                    <tr>
                                                                                        <td align="center" valign="top"
                                                                                            class="es-m-p4r"
                                                                                            style="padding:0;Margin:0;padding-right:10px">
                                                                                            <a href="https://mrinterior.mmworkspace.com/"
                                                                                                target="_blank">
                                                                                                <img title="Facebook"
                                                                                                    src="https://ejoaiel.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png"
                                                                                                    alt="Fb" width="25"
                                                                                                    height="25"
                                                                                                    style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                                            </a>
                                                                                        </td>
                                                                                        <td align="center" valign="top"
                                                                                            class="es-m-p4r"
                                                                                            style="padding:0;Margin:0;padding-right:10px">
                                                                                            <a href="https://mrinterior.mmworkspace.com/"
                                                                                                target="_blank">
                                                                                                <img src="https://ejoaiel.stripocdn.email/content/assets/img/social-icons/logo-black/x-logo-black.png"
                                                                                                    alt="X" width="25"
                                                                                                    height="25"
                                                                                                    title="X"
                                                                                                    style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                                            </a>
                                                                                        </td>
                                                                                        <td align="center" valign="top"
                                                                                            class="es-m-p4r"
                                                                                            style="padding:0;Margin:0;padding-right:10px">
                                                                                            <a href="https://mrinterior.mmworkspace.com/"
                                                                                                target="_blank">
                                                                                                <img height="25"
                                                                                                    title="Instagram"
                                                                                                    src="https://ejoaiel.stripocdn.email/content/assets/img/social-icons/logo-black/instagram-logo-black.png"
                                                                                                    alt="Ig" width="25"
                                                                                                    style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                                            </a>
                                                                                        </td>
                                                                                        <td align="center" valign="top"
                                                                                            style="padding:0;Margin:0">
                                                                                            <a href="https://mrinterior.mmworkspace.com/"
                                                                                                target="_blank">
                                                                                                <img title="YouTube"
                                                                                                    src="https://ejoaiel.stripocdn.email/content/assets/img/social-icons/logo-black/youtube-logo-black.png"
                                                                                                    alt="Yt" width="25"
                                                                                                    height="25"
                                                                                                    style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table><!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0;Margin:0">
                                            <table cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:600px"
                                                role="none">
                                                <tr>
                                                    <td align="left" class="es-m-p10l es-m-p10r"
                                                        style="padding:0;Margin:0;padding-right:20px;padding-left:20px;padding-bottom:20px;background: #f5f5f5;">
                                                        <table width="100%" cellpadding="0" cellspacing="0" role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0;width:560px">
                                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                                        role="presentation" bgcolor="#f5f5f5"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#f5f5f5">
                                                                        <tr>
                                                                            <td align="left"
                                                                                class="es-m-p15l es-m-p15r es-m-p10b es-text-1754"
                                                                                style="padding:0;Margin:0;padding-right:20px;padding-left:20px;padding-bottom:20px">
                                                                                <p class="es-text-mobile-size-13 es-override-size"
                                                                                    style="Margin:0;mso-line-height-rule:exactly;font-family:roboto,
                                                                                    helvetica neue, helvetica, arial,
                                                                                    sans-serif;line-height:21px;letter-spacing:0;color:#757575;font-size:14px">
                                                                                    Welcome to VOYD Interiors! We are
                                                                                    delighted to have you as our valued
                                                                                    vendor partner. Together, we aim to
                                                                                    create
                                                                                    exceptional interiors, deliver
                                                                                    quality, and build lasting
                                                                                    collaborations that inspire success.</p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left"
                                                                                class="es-m-p15l es-m-p15r es-text-6142"
                                                                                style="padding:0;Margin:0;padding-right:20px;padding-left:20px;padding-bottom:30px">
                                                                                <p class="es-text-mobile-size-13 es-override-size"
                                                                                    style="Margin:0;mso-line-height-rule:exactly;font-family:roboto,
                                                                                    helvetica neue, helvetica, arial,
                                                                                    sans-serif;line-height:21px;letter-spacing:0;color:#757575;font-size:14px">
                                                                                    Welcome aboard VOYD Interiors! Your
                                                                                    partnership matters to us. Let’s
                                                                                    collaborate to deliver outstanding
                                                                                    interiors,
                                                                                    ensuring quality, creativity, and
                                                                                    mutual success</p>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>';
    $mail->AltBody = 'Customer Query';

    $send = $mail->send();

    if ($send) {
        $stat = ['status' => true, 'message' => 'Thanks for registering. Assistance will be provided shortly.'];
    }
} catch (Exception $e) {
    $stat = ["status" => false, "error" => $e, "message" => "Failed"];
}

echo json_encode($stat);
