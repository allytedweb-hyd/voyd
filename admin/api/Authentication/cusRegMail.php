<?php

include "../../includes/db.php";
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header("HTTP/1.1 200 OK");
    die();
}


require_once "../../vendor/autoload.php";

include '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
include '../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$json = file_get_contents('php://input');
$data = json_decode($json);

@$firstName = $data->firstName;
@$lastName = $data->lastName;
@$mobileNo = $data->mobileNo;
@$place = $data->place;
@$email = $data->email;
@$password = $data->password;
@$state = $data->state;
@$refferedBy = $data->refferedBy;
@$gstNo = $data->gstNo;
@$companyName = $data->companyName;
@$address = $data->address;

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
    $mail->addAddress($email);               //Name is optional    
    $mail->addAddress('sripriyaallyted@gmail.com');               //Name is optional    

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Customer Registration';
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
    <title>VOYD Interiors</title>
    <!--[if (mso 16)]><style type="text/css"> a {text-decoration: none;}  </style><![endif]--><!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--><!--[if gte mso 9]><xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml>
<![endif]--><!--[if !mso]><!-- -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Petit+Formal+Script&family=Roboto+Slab:wght@100..900&display=swap"
        rel="stylesheet">
    <!--<![endif]-->
    <style type="text/css">
        @import url("https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Petit+Formal+Script&display=swap");

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

        h1 {
            margin: 0px !important;
        }

        h2 {
            margin: 0px !important;
            Margin: 0;
            font-family: Roboto Slab, serif;
            /* font-family: Roboto Slab, serif; */
            letter-spacing: 0;
            font-size: 43px;
            font-style: normal;
            font-weight: 400;
            line-height: 55px;
            color: #000000;
        }

        h3 {
            margin: 0px !important;
            font-family: Roboto Slab, serif;
            line-height: 70px;
            letter-spacing: 0;
            font-size: 40px;
        }



        h3 span:nth-child(1) {
            color: #ADA785;
        }

        h3 span:nth-child(2) {
            color: #000;

        }

        h4 {
            Margin: 0 !important;
            font-family: Petit Formal Script, cursive;
            line-height: 54px;
            letter-spacing: 0;
            color: #432916;
            font-size: 40px;
            font-weight: 400;
        }

        h5 {
            Margin: 0 !important;
            font-family: Petit Formal Script, cursive;
            line-height: 42px;
            letter-spacing: 0;
            color: #432916;
            font-size: 36px;
            font-weight: 400;
        }

        h6 {
            margin: 0px !important;
            font-family: Roboto Slab, serif !important;
            font-weight: 400;
            font-size: 18px;
        }

        p {
            margin: 0px !important;
            font-family: verdana, geneva, sans-serif !important;
        }

        @media only screen and (max-width:600px) {
            .es-m-p30t {
                padding-top: 15px !important
            }

            .es-m-p20r {
                padding-right: 10px !important
            }

            .es-m-p5b {
                padding-bottom: 5px !important
            }

            .es-m-p20l {
                padding-left: 10px !important
            }

            .es-m-p10t {
                padding-top: 10px !important
            }

            .es-m-p10b {
                padding-bottom: 10px !important
            }

            .es-m-p15b {
                padding-bottom: 15px !important
            }

            .es-m-p45r {
                padding-right: 45px !important
            }

            .es-m-p20b {
                padding-bottom: 20px !important
            }

            .es-m-p45l {
                padding-left: 45px !important
            }

            .es-m-p0b {
                padding-bottom: 0px !important
            }

            .es-m-p30b {
                padding-bottom: 15px !important
            }

            .es-m-p30b.second {
                padding-bottom: 20px !important;
            }

            .es-m-p15t {
                padding-top: 15px !important
            }

            .es-m-p10r {
                padding-right: 10px !important
            }

            .es-m-p10l {
                padding-left: 10px !important
            }

            .es-m-p10 {
                padding: 10px !important
            }

            .es-m-p25b {
                padding-bottom: 25px !important
            }

            .es-m-p20t {
                padding-top: 20px !important
            }

            .es-m-p50r {
                padding-right: 50px !important
            }

            .es-m-p35b {
                padding-bottom: 35px !important
            }

            .es-m-p50l {
                padding-left: 50px !important
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
                font-size: 18px !important;
                text-align: center !important;
            }

            h3 span {
                font-size: 18px !important;
                font-weight: 400;
            }

            h4 {
                font-size: 24px !important;
                text-align: center
            }

            h5 {
                font-size: 20px !important;
                text-align: left
            }

            h6 {
                font-size: 12px !important;
                text-align: center !important;
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

            .img-6271 {
                width: 108px !important;
                height: auto !important
            }

            .img-7264 {
                width: 61px !important;
                height: auto !important
            }

            .img-7855 {
                width: 61px !important;
                height: auto !important
            }

            .img-1786 {
                width: 54px !important;
                height: auto !important
            }

            .img-4091 {
                width: 219px !important;
                height: auto !important
            }

            .img-4886 {
                width: 144px !important;
                height: auto !important
            }

            .es-text-4165 .es-text-mobile-size-16,
            .es-text-4165 .es-text-mobile-size-16 * {
                font-size: 16px !important;
                line-height: 150% !important;
                padding: 0px 12px !important;
            }

            .es-text-4028 .es-text-mobile-size-48,
            .es-text-4028 .es-text-mobile-size-48 * {
                font-size: 48px !important;
                line-height: 150% !important
            }

            .es-text-1383 .es-text-mobile-size-48,
            .es-text-1383 .es-text-mobile-size-48 * {
                font-size: 30px !important;
                line-height: 100% !important;
                padding-bottom: 10px;
            }

            .es-text-3164.es-m-p45l.es-m-p45r {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            .es-text-2006.es-m-p45l.es-m-p45r {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            .es-text-6001 .es-text-mobile-size-36,
            .es-text-6001 .es-text-mobile-size-36 * {
                font-size: 20px !important;
                line-height: 150% !important
            }

            .es-text-2006 .es-text-mobile-size-13,
            .es-text-2006 .es-text-mobile-size-13 * {
                font-size: 12px !important;
                line-height: 130% !important
            }

            .es-content-body a {
                font-size: 12px !important;
            }

            .es-text-9453 .es-text-mobile-size-14,
            .es-text-9453 .es-text-mobile-size-14 * {
                font-size: 14px !important;
                line-height: 150% !important
            }

            .es-text-3164 .es-text-mobile-size-13,
            .es-text-3164 .es-text-mobile-size-13 * {
                font-size: 12px !important;
                line-height: 130% !important
            }

            .es-text-8438.es-m-p10 {
                padding: 0px 10px !important;
            }

            .es-m-p50l.es-m-p35b.es-m-p50r {
                padding-left: 25px !important;
                padding-right: 25px !important;
            }

            .es-text-8438 .es-text-mobile-size-28,
            .es-text-8438 .es-text-mobile-size-28 * {
                font-size: 20px !important;
                line-height: 150% !important
            }

            .es-text-3830 .es-text-mobile-size-26.es-override-size,
            .es-text-3830 .es-text-mobile-size-26.es-override-size * {
                font-size: 22px !important;
                line-height: 130% !important
            }

            .es-text-3830 {
                padding-right: 20px !important;
                padding-left: 20px !important;
                padding-bottom: 0px !important;
            }

            .es-m-p20l.es-m-p20r .halfTable {
                width: 50% !important;
            }

            .es-text-2655 .es-text-mobile-size-13.es-override-size,
            .es-text-2655 .es-text-mobile-size-13.es-override-size * {
                font-size: 13px !important;
                line-height: 150% !important;
                padding: 0px 20px !important;

            }

            .es-text-4028 .es-text-mobile-size-36.es-override-size,
            .es-text-4028 .es-text-mobile-size-36.es-override-size * {
                font-size: 18px !important;
                line-height: 150% !important
            }

            .es-text-4028 .es-text-mobile-size-28.es-override-size,
            .es-text-4028 .es-text-mobile-size-28.es-override-size * {
                font-size: 16px !important;
                line-height: 150% !important
            }

            .es-text-1383 .es-text-mobile-size-36.es-override-size,
            .es-text-1383 .es-text-mobile-size-36.es-override-size * {
                font-size: 18px !important;
                line-height: 150% !important
            }

            .es-text-1383 .es-text-mobile-size-28.es-override-size,
            .es-text-1383 .es-text-mobile-size-28.es-override-size * {
                font-size: 16px !important;
                line-height: 150% !important
            }

            a.es-button.es-button-1985 {
                font-size: 14px !important;
                padding: 5px 20px !important
            }

            a.es-button.es-button-3153 {
                font-size: 14px !important
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
                            <td align="center" bgcolor="#ffffff" style="padding:0;Margin:0;background-color:#ffffff">
                                <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0"
                                    class="es-content-body"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:600px"
                                    role="none">
                                    <tr>
                                        <td align="left"
                                            background="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bgbig.png"
                                            class="es-m-p30t es-m-p20l es-m-p20r es-m-p5b"
                                            style="Margin:0;padding-top:40px;padding-right:30px;padding-bottom:15px;padding-left:30px;background-image:url(https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bgbig.png);background-repeat:no-repeat;background-position:left top">
                                            <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:540px">
                                                        <table cellspacing="0" role="presentation" width="100%"
                                                            cellpadding="0"
                                                            background="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bg1_EP7.png"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-image:url(https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bg1_EP7.png);background-repeat:no-repeat;background-position:left top">
                                                            <tr>
                                                                <td align="center" class="es-m-p10t"
                                                                    style="padding:0;Margin:0;padding-top:20px;font-size:0">
                                                                    <img alt="" width="220"
                                                                        src="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/voydgreen.png"
                                                                        class="img-4886" height="83"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0;Margin:0;font-size:0"><img
                                                                        width="310"
                                                                        src="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/ribbon.png"
                                                                        alt="" class="img-4091" height="90"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-text-4165 es-m-p10b"
                                                                    style="padding:0;Margin:0;padding-bottom:15px">
                                                                    <p class="es-text-mobile-size-16"
                                                                        style="Margin:0;mso-line-height-rule:exactly;line-height:24px;letter-spacing:0;color:#705645;font-size:16px">
                                                                        You <strong> ' . $firstName . ' ' . $lastName .
        '</strong></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-m-p15b es-text-2655"
                                                                    style="padding:0;Margin:0;padding-bottom:25px">
                                                                    <p class="es-text-mobile-size-13 es-override-size"
                                                                        style="Margin:0;mso-line-height-rule:exactly;line-height:21px;letter-spacing:0;color:#705645;font-size:14px">
                                                                        Elegance and quality no matter what your style
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td background="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bgbig.png"
                                            align="left" class="es-m-p20l es-m-p20r"
                                            style="padding:0;Margin:0;padding-right:30px;padding-left:30px;background-position:left top;background-image:url(https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bgbig.png);background-repeat:no-repeat;background-size:auto contain">
                                            <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:540px">
                                                        <table cellpadding="0" cellspacing="0" role="presentation"
                                                            width="100%"
                                                            background="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bg2.png"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-image:url(https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bg2.png);background-repeat:no-repeat;background-position:left top">
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0;Margin:0;padding-top:10px">
                                                                    <h6
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family: Roboto Slab, serif;line-height:21px;letter-spacing:0;color:#333333;font-size:18px;font-weight: 400;">
                                                                        <span style="color:#ADA785">From</span> <strong
                                                                            style="color:#0E6844">VOYD</strong>
                                                                    </h6>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-text-3830"
                                                                    style="padding:0;Margin:0;padding-bottom:15px;padding-right:50px;padding-left:50px">
                                                                    <h2 class="es-text-mobile-size-26 es-override-size es-m-txt-c"
                                                                        style="Margin:0;font-family: Roboto Slab, serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:43px;font-style:normal;font-weight:400;line-height:47.8px;color:#000000">
                                                                        <span style="color:#ADA785">We</span> have new
                                                                        interior <br> designers with top- <br>trending
                                                                        styles
                                                                    </h2>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-text-4028"
                                                                    style="padding:0;Margin:0">
                                                                    <h3 class="es-text-mobile-size-48"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family: Roboto Slab, serif;line-height:72px;letter-spacing:0;color:#ADA785;font-size:42px;font-weight: 400;">
                                                                        <span
                                                                            class="es-text-mobile-size-36 es-override-size"
                                                                            style="font-weight: 300;">800+
                                                                        </span><span
                                                                            class="es-override-size es-text-mobile-size-28"
                                                                            style="font-size:32px;color:#000000;font-family: Roboto Slab, serif;">Designs</span>
                                                                    </h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0;Margin:0;font-size:0"><img
                                                                        src="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/seperator.png"
                                                                        alt="" width="364" class="adapt-img" height="2"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-text-1383"
                                                                    style="padding:0;Margin:0">
                                                                    <h3 class="es-text-mobile-size-48"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family: Roboto Slab, serif;line-height:72px;letter-spacing:0;color:#ADA785;font-size:42px;font-weight: 400;">
                                                                        <span
                                                                            class="es-text-mobile-size-36 es-override-size"
                                                                            style="font-weight: 300;">100K+</span>
                                                                        <span
                                                                            class="es-text-mobile-size-28 es-override-size"
                                                                            style="font-family: Roboto Slab, serif;font-size:32px;color:#000000">VOYD
                                                                            Family</span>
                                                                    </h3>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"
                                            background="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bgbig.png"
                                            class="es-m-p20l es-m-p20r"
                                            style="padding:0;Margin:0;padding-right:30px;padding-left:30px;background-image:url(https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bgbig.png);background-repeat:no-repeat;background-position:left top;background-size:auto contain">
                                            <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:540px">
                                                        <table width="100%" background bgcolor="#fefaf3" cellpadding="0"
                                                            cellspacing="0" role="presentation"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="center"
                                                                    style=" padding: 20px 0px 0px;Margin:0"><span
                                                                        class="es-button-border"
                                                                        style="border-style:solid;border-color:#2CB543;background:#643209;border-width:0px;display:inline-block;border-radius:5px;width:auto"><a
                                                                            target="_blank"
                                                                            href="https://mrinterior.mmworkspace.com"
                                                                            class="es-button es-button-3153"
                                                                            style="mso-style-priority:100 !important;text-decoration:none !important;mso-line-height-rule:exactly;color:#FFFFFF;font-size:16px;padding:10px 75px;display:inline-block;background:#643209;border-radius:5px;font-family:verdana, geneva, sans-serif;font-weight:normal;font-style:normal;line-height:19.2px;width:auto;text-align:center;letter-spacing:0;mso-padding-alt:0;mso-border-alt:10px solid #643209">Get
                                                                            Started</a> </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0;Margin:0;padding-top:15px;font-size:0">
                                                                    <img src="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/percent.png"
                                                                        alt="" width="69" class="img-1786" height="69"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-m-p45l es-m-p45r es-m-p20b"
                                                                    style="Margin:0;padding-top:15px;padding-right:125px;padding-bottom:30px;padding-left:125px">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;line-height:21px;letter-spacing:0;color:#705645;font-size:14px">
                                                                        Use code <span style="color:#e69138">1234</span>
                                                                        on checkout to receive <span
                                                                            style="color:#e69138">5% off</span> on your
                                                                        first purchase.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-m-p0b"
                                                                    style="padding:0;Margin:0;padding-right:50px;padding-left:50px;padding-bottom:20px;font-size:0">
                                                                    <img width="440"
                                                                        src="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/line.png"
                                                                        alt="" class="adapt-img" height="1"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-text-6001"
                                                                    style="padding:0;Margin:0;padding-bottom:15px;padding-top:10px">
                                                                    <h4 class="es-text-mobile-size-36"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family: Petit Formal Script, cursive;line-height:54px;letter-spacing:0;color:#432916;font-size:36px">
                                                                        <em>New arrival</em>
                                                                    </h4>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"
                                            background="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bgbig.png"
                                            class="es-m-p20l es-m-p20r"
                                            style="padding:0;Margin:0;padding-right:30px;padding-left:30px;background-image:url(https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bgbig.png);background-repeat:no-repeat;background-position:left top">
                                            <!--[if mso]><table style="width:540px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
                                            <table align="left" cellpadding="0" cellspacing="0"
                                                class="es-left halfTable" role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:270px">
                                                        <table width="100%" bgcolor="#fefaf3" cellpadding="0"
                                                            cellspacing="0" role="presentation"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#fefaf3">
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0;Margin:0;font-size:0"><img
                                                                        src="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/swing.png"
                                                                        alt="" width="101" class="img-7855" height="103"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-text-9453"
                                                                    style="padding:0;Margin:0;padding-top:10px">
                                                                    <p class="es-text-mobile-size-14"
                                                                        style="Margin:0;mso-line-height-rule:exactly;line-height:21px;letter-spacing:0;color:#432916;font-size:14px">
                                                                        <strong>RECLINER</strong>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    class="es-text-2006 es-m-p45l es-m-p45r"
                                                                    style="padding:0;Margin:0;padding-right:30px;padding-left:30px">
                                                                    <p class="es-text-mobile-size-13"
                                                                        style="Margin:0;mso-line-height-rule:exactly;line-height:16.9px;letter-spacing:0;color:#615F5E;font-size:13px">
                                                                        Relax in unmatched comfort with our premium recliner chair..</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-m-p20b"
                                                                    style="padding:0;Margin:0;padding-top:10px;padding-bottom:40px">
                                                                    <a name="SHOP%20NOW"
                                                                        style="mso-line-height-rule:exactly;text-decoration:underline;color:#705645;font-size:14px;font-family:verdana, geneva, sans-serif"></a>
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:verdana, geneva, sans-serif;line-height:21px;letter-spacing:0;color:#705645;font-size:14px">
                                                                        <a target="_blank"
                                                                            style="mso-line-height-rule:exactly;text-decoration:underline;color:#705645;font-size:14px;font-family:verdana, geneva, sans-serif"
                                                                            href="https://mrinterior.mmworkspace.com/shop">SHOP
                                                                            NOW</a>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table> <!--[if mso]></td><td style="width:270px" valign="top"><![endif]-->
                                            <table cellspacing="0" align="right" cellpadding="0"
                                                class="halfTable es-right" role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:270px">
                                                        <table width="100%" bgcolor="#fefaf3" cellpadding="0"
                                                            cellspacing="0" role="presentation"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#fefaf3">
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0;Margin:0;font-size:0"><img alt=""
                                                                        width="101"
                                                                        src="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/chair.png"
                                                                        class="img-7264" height="103"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0;Margin:0;padding-top:10px">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:verdana, geneva, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">
                                                                        <strong>SINGLE</strong>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    class="es-text-3164 es-m-p45l es-m-p45r"
                                                                    style="padding:0;Margin:0;padding-right:30px;padding-left:30px">
                                                                    <p class="es-text-mobile-size-13"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:verdana, geneva, sans-serif;line-height:16.9px;letter-spacing:0;color:#615F5E;font-size:13px">
                                                                        Enhance your space with our elegant single seating chair.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-m-p30b second"
                                                                    style="padding:0;Margin:0;padding-top:10px;padding-bottom:40px">
                                                                    <a name="SHOP%20NOW"
                                                                        style="mso-line-height-rule:exactly;text-decoration:underline;color:#705645;font-size:14px"></a>
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:verdana, geneva, sans-serif;line-height:21px;letter-spacing:0;color:#705645;font-size:14px">
                                                                        <a target="_blank"
                                                                            style="mso-line-height-rule:exactly;text-decoration:underline;color:#705645;font-size:14px"
                                                                            href="https://mrinterior.mmworkspace.com/shop">SHOP
                                                                            NOW</a>
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
                                        <td align="left"
                                            background="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bgbig.png"
                                            class="es-m-p20l es-m-p20r"
                                            style="padding:0;Margin:0;padding-right:30px;padding-left:30px;background-image:url(https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bgbig.png);background-repeat:no-repeat;background-position:left top">
                                            <!--[if mso]><table style="width:540px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
                                            <table align="left" cellpadding="0" cellspacing="0" class="es-left"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:270px">
                                                        <table bgcolor="#e9ebed" cellpadding="0" cellspacing="0"
                                                            role="presentation" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#e9ebed">
                                                            <tr>
                                                                <td align="center"
                                                                    class="es-m-p15t es-m-p10r es-m-p10b es-m-p10l"
                                                                    style="padding:30px;Margin:0;font-size:0"><img
                                                                        alt="" width="210"
                                                                        src="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bigchair.png"
                                                                        class="img-6271" height="247"
                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td>
<td style="width:270px" valign="top"><![endif]-->
                                            <table cellspacing="0" align="right" cellpadding="0" class="es-right"
                                                role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:270px">
                                                        <table cellspacing="0" role="presentation" width="100%"
                                                            bgcolor="#e9ebed" cellpadding="0"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#e9ebed">
                                                            <tr>
                                                                <td align="left" class="es-text-8438 es-m-p10"
                                                                    style="padding:0;Margin:0;padding-top:80px;padding-left:35px">
                                                                    <h5 class="es-text-mobile-size-28 es-m-txt-c"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family: Petit Formal Script, cursive;line-height:42px;letter-spacing:0;color:#432916;font-size:28px">
                                                                        <em>King Chair</em>
                                                                    </h5>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left"
                                                                    style="padding:0;Margin:0;padding-right:30px;padding-left:35px;padding-top:5px">
                                                                    <p class="es-m-txt-c"
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:verdana, geneva, sans-serif;line-height:21px;letter-spacing:0;color:#595959;font-size:14px">
                                                                        Amet minim mollit non deserunt ullamco est sit
                                                                        aliqua.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-m-p25b"
                                                                    style="padding:0;Margin:0;padding-top:5px;padding-bottom:80px">
                                                                    <span class="es-button-border"
                                                                        style="border-style:solid;border-color:#DCC29C;background:transparent;border-width:2px;display:inline-block;border-radius:2px;width:auto"><a
                                                                            target="_blank"
                                                                            href="https://mrinterior.mmworkspace.com"
                                                                            class="es-button es-button-1985"
                                                                            style="mso-style-priority:100 !important;text-decoration:none !important;mso-line-height-rule:exactly;color:#432916;font-size:16px;padding:5px 30px;display:inline-block;background:transparent;border-radius:2px;font-family:verdana, geneva, sans-serif;font-weight:normal;font-style:normal;line-height:19.2px;width:auto;text-align:center;letter-spacing:0;mso-padding-alt:0;mso-border-alt:10px solid transparent">SHOP
                                                                            NOW</a></span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"
                                            background="https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bgbig.png"
                                            class="es-m-p20l es-m-p20r es-m-p30b"
                                            style="padding:0;Margin:0;padding-right:30px;padding-left:30px;padding-bottom:50px;background-image:url(https://ejoaiel.stripocdn.email/content/guids/CABINET_eb1904eafa7415ec1f3cb33f1d6c94325bc0c7ff976093a9d235b3ee0f2c1391/images/bgbig.png);background-repeat:no-repeat;background-position:left top">
                                            <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="center" valign="top"
                                                        style="padding:0;Margin:0;width:540px">
                                                        <table width="100%" cellpadding="0" cellspacing="0"
                                                            role="presentation" bgcolor="#432916"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#432916">
                                                            <tr>
                                                                <td align="center" class="es-m-p20t"
                                                                    style="padding:0;Margin:0;padding-top:35px;padding-bottom:10px;font-size:0">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        class="es-table-not-adapt es-social"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td valign="top" align="center"
                                                                                style="padding:0;Margin:0;padding-right:10px">
                                                                                <a href="https://mrinterior.mmworkspace.com/"
                                                                                    target="_blank">
                                                                                    <img height="30" title="Facebook"
                                                                                        src="https://ejoaiel.stripocdn.email/content/assets/img/social-icons/logo-white/facebook-logo-white.png"
                                                                                        alt="Fb" width="30"
                                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                                </a>
                                                                            </td>
                                                                            <td align="center" valign="top"
                                                                                style="padding:0;Margin:0;padding-right:10px">
                                                                                <a href="https://mrinterior.mmworkspace.com/"
                                                                                    target="_blank">
                                                                                    <img title="Instagram"
                                                                                        src="https://ejoaiel.stripocdn.email/content/assets/img/social-icons/logo-white/instagram-logo-white.png"
                                                                                        alt="Ig" width="30" height="30"
                                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                                </a>
                                                                            </td>
                                                                            <td valign="top" align="center"
                                                                                style="padding:0;Margin:0;padding-right:10px">
                                                                                <a href="https://mrinterior.mmworkspace.com/"
                                                                                    target="_blank">
                                                                                    <img title="X"
                                                                                        src="https://ejoaiel.stripocdn.email/content/assets/img/social-icons/logo-white/x-logo-white.png"
                                                                                        alt="X" width="30" height="30"
                                                                                        style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                                </a>
                                                                            </td>
                                                                            <td align="center" valign="top"
                                                                                style="padding:0;Margin:0;padding-right:10px">
                                                                                <img alt="Email" width="30" height="30"
                                                                                    title="Email"
                                                                                    src="https://ejoaiel.stripocdn.email/content/assets/img/other-icons/logo-white/mail-logo-white.png"
                                                                                    style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="padding:0;Margin:0">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:verdana, geneva, sans-serif;line-height:21px;letter-spacing:0;color:#ffffff;font-size:14px">
                                                                        Sent from VOYD</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-m-p50l es-m-p35b es-m-p50r"
                                                                    style="Margin:0;padding-top:5px;padding-bottom:50px;padding-right:85px;padding-left:85px">
                                                                    <p
                                                                        style="Margin:0;mso-line-height-rule:exactly;font-family:verdana, geneva, sans-serif;line-height:21px;letter-spacing:0;color:#fff;font-size:14px">
                                                                        Plot No 28 28/A, Survey No 40, Financial
                                                                        District Road, Raidurgam Khajaguda Village,
                                                                        Serilingampally Mandal, Rangareddy
                                                                        Dist, Hyderabad, Telangana, India</p>
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
    $mail->AltBody = 'Customer Registration';

    $send = $mail->send();

    if ($send) {
        $stat = ['status' => true, 'message' => ' We’ve sent a confirmation email to your inbox.'];
        // $stat = ['status' => true, 'message' => '✨ You’re in ! We’ve sent a confirmation email to your inbox. Get started to design the interiors of your dreams—tailored to your style, space, and budget!'];
    }
} catch (Exception $e) {
    $stat = ["status" => false, "error" => $e, "message" => "Failed"];
}

echo json_encode($stat);
