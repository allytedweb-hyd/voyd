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


$name = $data->customerName;
$mobileNo = $data->mobile;
$email = $data->email;
$subject = $data->subject;
$query = $data->query;


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
    //Name is optional    
    $mail->addAddress("sripriyaallyted@gmail.com");               //Name is optional    
    // $mail->addAddress("harisatya@makersmind.in");               //Name is optional    
    $mail->addAddress("sekharrebel216@gmail.com");               //Name is optional    
    $mail->addAddress("Sripriyaa@allyted.com");               //Name is optional    

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Customer Support';
    $mail->Body = '
    <!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title>Support Form</title>
    <!--[if (mso 16)]><style type="text/css"> a {text-decoration: none;}  </style><![endif]--><!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--><!--[if gte mso 9]><noscript> <xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml> </noscript>
<![endif]--><!--[if mso]><xml> <w:WordDocument xmlns:w="urn:schemas-microsoft-com:office:word"> <w:DontUseAdvancedTypographyReadingMail/> </w:WordDocument> </xml>
<![endif]-->
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

        h3 {
            margin: 0px !important;
        }

        h4 {
            margin: 0px !important;
        }

        h5 {
            margin: 0px !important;
        }

        h6 {
            margin: 0px !important;
        }

        p {
            margin: 0px !important;
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

        h3 {
            font-size: 30px;
            color: #0e6844 !important;
        }

        h4 {
            font-size: 24px;
        }

        h5 {
            font-size: 20px;
            color: #0e6844 !important;
        }

        h6.es-text-mobile-size-14 {
            color: #0e6844 !important;

        }

        h6 {
            font-size: 16px;
        }

        .m_-663907889522980749es-m-p15b span {
            padding: 6px 18px;

        }

        .m_-663907889522980749es-m-p15b span a {
            color: #fff;

        }

        a {
            color: #fff !important;
            font-size: 14px !important;
            padding: 10px 20px 10px 20px !important;
            display: inline-block !important;
            background: #0e6844 !important;
            border-radius: 5px !important;
        }

        p a {

            text-decoration: none;
            padding: unset !important;
            background: none !important;
        }

        p a {
            color: #551a8b !important;
        }

        p a:hover {
            color: #0a6fd7 !important;
        }

        p a:active {
            color: #02955a !important;
        }

        .es-header-body {
            margin: 40px auto;
        }

        .es-header .es-m-p15l table.es-left.referaalCode {
            width: 100% !important;
        }

        .es-left.referaalCode {
            width: 100% !important;
        }

        @media only screen and (max-width:600px) {
            .es-header .es-m-p15l table.es-left.referaalCode {
                width: 100% !important;
            }

            .es-left.referaalCode {
                width: 100% !important;
            }

            .es-header-body {
                margin: 0px auto !important;
            }

            .es-m-p5t {
                padding-top: 5px !important
            }

            .es-m-p5b {
                padding-bottom: 5px !important
            }

            .es-m-p9r {
                padding-right: 9px !important
            }

            .es-m-p15t {
                padding-top: 15px !important
            }

            .es-m-p15r {
                padding-right: 15px !important
            }

            .es-m-p15l {
                padding-left: 15px !important
            }

            .es-m-p0b {
                padding-bottom: 0px !important
            }

            .es-m-p10t {
                padding-top: 10px !important
            }

            .es-m-p15b {
                padding-bottom: 15px !important
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

            h1 {
                font-size: 40px !important;
                text-align: left
            }

            h2 {
                font-size: 32px !important;
                text-align: left
            }

            h2 {
                font-size: 32px !important;
                text-align: left
            }

            h3 {
                font-size: 26px !important;
                text-align: left
            }

            h4 {
                font-size: 22px !important;
                text-align: left
            }

            h5 {
                font-size: 18px !important;
                text-align: left
            }

            h6 {
                font-size: 16px !important;
                text-align: left
            }

            .es-header-body h1 a,
            .es-content-body h1 a,
            .es-footer-body h1 a {
                font-size: 40px !important
            }

            .es-header-body h2 a,
            .es-content-body h2 a,
            .es-footer-body h2 a {
                font-size: 32px !important
            }

            .es-header-body h3 a,
            .es-content-body h3 a,
            .es-footer-body h3 a {
                font-size: 28px !important
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
                font-size: 14px !important
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
                font-size: 14px !important;
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

            .es-header table.es-right {
                width: 50% !important;
            }

            .es-header table.es-left {
                width: 50% !important;
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

            .img-4282 {
                width: 103px !important;
                height: auto !important
            }

            .es-text-8355 .es-text-mobile-size-13.es-override-size,
            .es-text-8355 .es-text-mobile-size-13.es-override-size * {
                font-size: 13px !important;
                line-height: 150% !important
            }

            .es-text-9416 .es-text-mobile-size-13.es-override-size,
            .es-text-9416 .es-text-mobile-size-13.es-override-size * {
                font-size: 13px !important;
                line-height: 150% !important
            }

            .es-text-1448 .es-text-mobile-size-16.es-override-size,
            .es-text-1448 .es-text-mobile-size-16.es-override-size * {
                font-size: 16px !important;
                line-height: 150% !important
            }

            .es-text-9182 .es-text-mobile-size-13.es-override-size,
            .es-text-9182 .es-text-mobile-size-13.es-override-size * {
                font-size: 13px !important;
                line-height: 150% !important
            }

            .es-text-6629 .es-text-mobile-size-13.es-override-size,
            .es-text-6629 .es-text-mobile-size-13.es-override-size * {
                font-size: 13px !important;
                line-height: 150% !important
            }

            .es-text-4163 .es-text-mobile-size-11.es-override-size,
            .es-text-4163 .es-text-mobile-size-11.es-override-size * {
                font-size: 11px !important;
                line-height: 150% !important
            }

            .es-text-1075 .es-text-mobile-size-11.es-override-size,
            .es-text-1075 .es-text-mobile-size-11.es-override-size * {
                font-size: 11px !important;
                line-height: 150% !important
            }

            .es-text-8219 .es-text-mobile-size-18.es-override-size,
            .es-text-8219 .es-text-mobile-size-18.es-override-size * {
                font-size: 18px !important;
                line-height: 150% !important
            }

            .es-text-1179 .es-text-mobile-size-22.es-override-size,
            .es-text-1179 .es-text-mobile-size-22.es-override-size * {
                font-size: 22px !important;
                line-height: 150% !important
            }

            .es-text-1507 .es-text-mobile-size-14.es-override-size,
            .es-text-1507 .es-text-mobile-size-14.es-override-size * {
                font-size: 14px !important;
                line-height: 150% !important
            }

            .es-header .es-m-p15l table.es-left {
                width: 20% !important;
            }

            .es-header .es-m-p15l table.es-right {
                width: 80% !important;
            }

            a.es-button.es-button-5783 {
                font-size: 14px !important;
                padding: 5px 15px !important
            }

            .es-text-1135 .es-text-mobile-size-13.es-override-size,
            .es-text-1135 .es-text-mobile-size-13.es-override-size * {
                font-size: 13px !important;
                line-height: 150% !important
            }
        }

        @media screen and (max-width:384px) {
            .mail-message-content {
                width: 414px !important
            }

            .es-m-p5t.es-m-p15l .es-left.referaalCode {
                width: 100% !important;
            }

            .es-header .es-m-p15l table.es-right.head {
                width: 100% !important;
            }
        }
    </style>
</head>

<body class="body"
    style="width:100%;height:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
    <div dir="ltr" class="es-wrapper-color" lang="en" style="background-color:#F6F6F6">
        <!--[if gte mso 9]><v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t"> <v:fill type="tile" color="#f6f6f6"></v:fill> </v:background><![endif]-->
        <table width="100%" cellspacing="0" cellpadding="0" class="es-wrapper" role="none"
            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-color:#F6F6F6">
            <tr>
                <td valign="top" style="padding:0;Margin:0">
                    <table cellspacing="0" cellpadding="0" align="center" class="es-header" role="none"
                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important;background-color:transparent">
                        <tr>
                            <td align="center" style="padding:0;Margin:0">
                                <table cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center"
                                    class="es-header-body" role="none"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                    <tr>
                                        <td align="left" bgcolor="#0e6844" class="es-m-p5t es-m-p5b"
                                            style="padding:10px;Margin:0;background-color:#0e6844">
                                            <!--[if mso]><table style="width:580px" cellpadding="0" cellspacing="0"><tr><td style="width:290px" valign="top"><![endif]-->
                                            <table align="left" cellpadding="0" cellspacing="0" class="es-left"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td align="left" class="es-m-p5b"
                                                        style="padding:0;Margin:0;width:290px">
                                                        <table cellspacing="0" role="presentation" width="100%"
                                                            cellpadding="0" bgcolor="#0e6844"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#0e6844">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0;font-size:0">
                                                                    <img src="https://evrfhmc.stripocdn.email/content/guids/CABINET_7c22605aab4bafd1fe7af3c3efb5b7c365ee50f73f32f70dc19e582803578216/images/voydwite.png"
                                                                        alt="" width="120" class="img-4282" height="45"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table> <!--[if mso]></td><td style="width:290px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" align="right" class="es-right"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:290px">
                                                        <table cellpadding="0" cellspacing="0" role="presentation"
                                                            width="100%" bgcolor="#0e6844"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#0e6844">
                                                            <tr>
                                                                <td align="right"
                                                                    style="padding:0;Margin:0;padding-top:10px;font-size:0">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        class="es-table-not-adapt es-social"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td align="center" valign="top"
                                                                                class="es-m-p9r"
                                                                                style="padding:0;Margin:0;padding-right:10px">
                                                                                <img height="28" title="Facebook"
                                                                                    src="https://evrfhmc.stripocdn.email/content/assets/img/social-icons/logo-white/facebook-logo-white.png"
                                                                                    alt="Fb" width="28"
                                                                                    style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                            </td>
                                                                            <td align="center" valign="top"
                                                                                class="es-m-p9r"
                                                                                style="padding:0;Margin:0;padding-right:10px">
                                                                                <img width="28" height="28" title="X"
                                                                                    src="https://evrfhmc.stripocdn.email/content/assets/img/social-icons/logo-white/x-logo-white.png"
                                                                                    alt="X"
                                                                                    style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                            </td>
                                                                            <td align="center" valign="top"
                                                                                style="padding:0;Margin:0;padding-right:10px">
                                                                                <img src="https://evrfhmc.stripocdn.email/content/assets/img/social-icons/logo-white/instagram-logo-white.png"
                                                                                    alt="Ig" width="28" height="28"
                                                                                    title="Instagram"
                                                                                    style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
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
                                    <tr>
                                        <td align="left" class="es-m-p15t es-m-p15l es-m-p15r"
                                            style="padding:0;Margin:0;padding-top:20px;padding-right:20px;padding-left:20px">
                                            <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:560px">
                                                        <table cellpadding="0" cellspacing="0" role="presentation"
                                                            width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td class="es-text-1448 es-m-p0b"
                                                                    style="padding:0;Margin:0;padding-bottom:15px">
                                                                    <h4 class="es-override-size es-text-mobile-size-16"
                                                                        style="Margin:0;font-family:arial, helvetica
                                                                        neue, helvetica,
                                                                        sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:24px;font-style:normal;font-weight:normal;line-height:28.8px;color:#333333">
                                                                        <strong>New Submission from Customer
                                                                            Support</strong>
                                                                    </h4>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="es-text-9182" style="padding:0;Margin:0">
                                                                    <p class="es-text-mobile-size-13 es-override-size"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">
                                                                        A customer has submitted a support request
                                                                        through your website. Kindly reach out soon to
                                                                        assist and resolve their
                                                                        query.</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr>
                                        <td align="left" class="es-m-p5t es-m-p15r es-m-p15l"
                                            style="padding:0;Margin:0;padding-top:10px;padding-right:20px;padding-left:20px">
                                            <table align="right" cellpadding="0" cellspacing="0" class="es-right head"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:560px">
                                                        <table cellpadding="0" cellspacing="0" role="presentation"
                                                            width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left"
                                                                    style="padding:0;Margin:0;padding-bottom:5px">
                                                                    <h6
                                                                        style="Margin:0;font-family:arial,helvetica
                                                                        neue, helvetica,
                                                                        sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:16px;font-style:normal;font-weight:normal;line-height:19.2px;color:#384860">
                                                                        <strong>Details</strong>
                                                                    </h6>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" class="es-m-p5t es-m-p15r es-m-p15l"
                                            style="padding:0;Margin:0;padding-top:10px;padding-right:20px;padding-left:20px">
                                            <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:130px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:130px">
                                                        <table cellspacing="0" role="presentation" width="100%"
                                                            cellpadding="0"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;letter-spacing:0;color:#384860;font-size:14px">
                                                                        Name</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td><td style="width:430px" valign="top"><![endif]-->
                                            <table align="right" cellpadding="0" cellspacing="0" class="es-right"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:430px">
                                                        <table role="presentation" width="100%" cellpadding="0"
                                                            cellspacing="0"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;letter-spacing:0;color:#384860;font-size:14px">
                                                                        : &nbsp; ' . $name . '
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" class="es-m-p5t es-m-p15r es-m-p15l"
                                            style="padding:0;Margin:0;padding-top:10px;padding-right:20px;padding-left:20px">
                                            <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:130px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" align="left" class="es-left"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:130px">
                                                        <table cellspacing="0" role="presentation" width="100%"
                                                            cellpadding="0"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;letter-spacing:0;color:#384860;font-size:14px">
                                                                        Email</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td><td style="width:430px" valign="top"><![endif]-->
                                            <table align="right" cellpadding="0" cellspacing="0" class="es-right"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:430px">
                                                        <table role="presentation" width="100%" cellpadding="0"
                                                            cellspacing="0"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;letter-spacing:0;color:#384860;font-size:14px">
                                                                        : &nbsp; ' . $email . '</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" class="es-m-p5t es-m-p15l es-m-p15r"
                                            style="padding:0;Margin:0;padding-top:10px;padding-right:20px;padding-left:20px">
                                            <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:130px" valign="top"><![endif]-->
                                            <table align="left" cellpadding="0" cellspacing="0" class="es-left"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:130px">
                                                        <table role="presentation" width="100%" cellpadding="0"
                                                            cellspacing="0"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;letter-spacing:0;color:#384860;font-size:14px">
                                                                        Mobile</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td><td style="width:430px" valign="top"><![endif]-->
                                            <table cellspacing="0" align="right" cellpadding="0" class="es-right"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:430px">
                                                        <table cellpadding="0" cellspacing="0" role="presentation"
                                                            width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial,  helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;letter-spacing:0;color:#384860;font-size:14px">
                                                                        : &nbsp; ' . $mobileNo . '</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" class="es-m-p5t es-m-p15l es-m-p15r"
                                            style="padding:0;Margin:0;padding-top:10px;padding-right:20px;padding-left:20px">
                                            <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:130px" valign="top"><![endif]-->
                                            <table align="left" cellpadding="0" cellspacing="0" class="es-left"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:130px">
                                                        <table role="presentation" width="100%" cellpadding="0"
                                                            cellspacing="0"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica,
                                                                                                            sans-serif;line-height:21px;letter-spacing:0;color:#384860;font-size:14px">
                                                                        Issue Type</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td><td style="width:430px" valign="top"><![endif]-->
                                            <table cellspacing="0" align="right" cellpadding="0" class="es-right"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:430px">
                                                        <table cellpadding="0" cellspacing="0" role="presentation"
                                                            width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial,  helvetica neue, helvetica,
                                                                                                            sans-serif;line-height:21px;letter-spacing:0;color:#384860;font-size:14px">
                                                                        : &nbsp; ' . $subject . '</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" class="es-m-p5t es-m-p15l es-m-p15r"
                                            style="padding:0;Margin:0;padding-top:10px;padding-right:20px;padding-left:20px">
                                            <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:130px" valign="top"><![endif]-->
                                            <table align="left" cellpadding="0" cellspacing="0" class="es-left"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:130px">
                                                        <table role="presentation" width="100%" cellpadding="0"
                                                            cellspacing="0"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica,
                                                                                                            sans-serif;line-height:21px;letter-spacing:0;color:#384860;font-size:14px">
                                                                        Message</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td><td style="width:430px" valign="top"><![endif]-->
                                            <table cellspacing="0" align="right" cellpadding="0" class="es-right"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:430px">
                                                        <table cellpadding="0" cellspacing="0" role="presentation"
                                                            width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial,  helvetica neue, helvetica,
                                                                                                            sans-serif;line-height:21px;letter-spacing:0;color:#384860;font-size:14px">
                                                                        : &nbsp; ' . $query . '</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" class="es-m-p15l es-m-p15r"
                                            style="padding:0;Margin:0;padding-right:20px;padding-left:20px;padding-top:5px">
                                            <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:560px">
                                                        <table cellspacing="0" role="presentation" width="100%"
                                                            cellpadding="0"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" class="es-text-1135"
                                                                    style="padding:0;Margin:0;padding-top:10px">
                                                                    <p class="es-text-mobile-size-13 es-override-size es-m-txt-c"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">
                                                                        Kindly reach out promptly — your response will
                                                                        create a great impression and strengthen trust
                                                                        with the user.</p>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-m-p15t es-m-p15b"
                                                                    style="padding:0;Margin:0;padding-top:25px;padding-bottom:20px;font-size:0">
                                                                    <img src="https://evrfhmc.stripocdn.email/content/guids/CABINET_7c22605aab4bafd1fe7af3c3efb5b7c365ee50f73f32f70dc19e582803578216/images/vectorline.png"
                                                                        alt="" width="420" class="adapt-img" height="2"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-m-p5b es-text-9416"
                                                                    style="padding:0;Margin:0;padding-bottom:10px">
                                                                    <p class="es-text-mobile-size-13 es-override-size"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;letter-spacing:0;color:#c2c1c1;font-size:14px">
                                                                        @2025 All&nbsp;rights&nbsp;reserved by VOYD
                                                                        Interiors</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-text-8355 es-m-p15b"
                                                                    style="padding:0;Margin:0;padding-bottom:20px">
                                                                    <p class="es-text-mobile-size-13 es-override-size"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;letter-spacing:0;color:#c2c1c1;font-size:14px">
                                                                        Copyright © 2025</p>
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

</html>
    ';
    $mail->AltBody = 'Customer Query';

    $insertInfo = mysqli_query($conn, "INSERT INTO customer_support SET first_name='" . $name . "', phone='" . $mobileNo . "', email='" . $email . "', issue='" . $subject . "', message='" . $query . "', query_through='support', status=1");

    if ($insertInfo) {
        $send = $mail->send();
    }

    if ($send) {
        $stat = ['status' => true, 'message' => 'Thank you. Assistance will be provided shortly.'];
    }
} catch (Exception $e) {
    $stat = ["status" => false, "error" => $e, "message" => "Failed"];
}

echo json_encode($stat);
