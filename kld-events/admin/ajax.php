<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('control/db.php');
if (!array_key_exists('ajax', $_POST)) {
    echo '<script>window.close()</script>';
} else {

    switch ($_POST['ajax']) {
        case "add_std":
            $add_std_profilepic = base64_decode($_POST['add_std_profilepic']);
            $add_std_firstname = $_POST['add_std_firstname'];
            $add_std_lastname = $_POST['add_std_lastname'];
            $add_std_course = $_POST['add_std_course'];
            $add_std_yearlvl = $_POST['add_std_yearlvl'];
            $add_std_section = $_POST['add_std_section'];
            $add_std_kldnum = $_POST['add_std_kldnum'];
            $add_std_email = $_POST['add_std_email'] . "@kld.edu.ph";
            $activation_key = base64_encode(generateRandomString());

            require_once 'assets/mail/src/Exception.php';
            require_once 'assets/mail/src/SMTP.php';
            require_once 'assets/mail/src/PHPMailer.php';

            $mail = new PHPMailer();
            //$mail->SMTPDebug = 4;
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->IsHTML(true);
            $mail->Host = 'smtp.hostinger.com';
            $mail->Port = 587;
            //$mail->Port = 465;
            $mail->SMTPSecure = "TLS";
            $url = "https://markdenzel.lucero.cloud/kld-events/signup.php?ajax=account_activation&activation_key=" . $activation_key;
            /* 
            $url = "http://localhost/capstone-project-kld-events/kld-events/kld-events/signup.php?ajax=account_activation&activation_key=" . $activation_key; */

            $mail->Username = 'steven.dale@lucero.cloud';
            $mail->Password = base64_decode("U3RAY3lMMWx5THVjI3Iw");
            $mail->setFrom('noreply@lucero.cloud', 'KLD Events Account Activation');
            $mail->addAddress($add_std_email);
            $mail->addCC("mdplucero@kld.edu.ph");
            $mail->Subject = "Welcome to KLD Event " . $add_std_firstname;
            $msg = '

            <!--
                    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
                    <head>
                    <title></title>
                    <meta charset="UTF-8" />
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <!--[if !mso]>-->
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                    <!--<![endif]-->
                    <meta name="x-apple-disable-message-reformatting" content="" />
                    <meta content="target-densitydpi=device-dpi" name="viewport" />
                    <meta content="true" name="HandheldFriendly" />
                    <meta content="width=device-width" name="viewport" />
                    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no" />
                    <style type="text/css">
                    table {
                    border-collapse: separate;
                    table-layout: fixed;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt
                    }
                    table td {
                    border-collapse: collapse
                    }
                    .ExternalClass {
                    width: 100%
                    }
                    .ExternalClass,
                    .ExternalClass p,
                    .ExternalClass span,
                    .ExternalClass font,
                    .ExternalClass td,
                    .ExternalClass div {
                    line-height: 100%
                    }
                    body, a, li, p, h1, h2, h3 {
                    -ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                    }
                    html {
                    -webkit-text-size-adjust: none !important
                    }
                    body, #innerTable {
                    -webkit-font-smoothing: antialiased;
                    -moz-osx-font-smoothing: grayscale
                    }
                    #innerTable img+div {
                    display: none;
                    display: none !important
                    }
                    img {
                    Margin: 0;
                    padding: 0;
                    -ms-interpolation-mode: bicubic
                    }
                    h1, h2, h3, p, a {
                    line-height: inherit;
                    overflow-wrap: normal;
                    white-space: normal;
                    word-break: break-word
                    }
                    a {
                    text-decoration: none
                    }
                    h1, h2, h3, p {
                    min-width: 100%!important;
                    width: 100%!important;
                    max-width: 100%!important;
                    display: inline-block!important;
                    border: 0;
                    padding: 0;
                    margin: 0
                    }
                    a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: none !important;
                    font-size: inherit !important;
                    font-family: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important
                    }
                    u + #body a {
                    color: inherit;
                    text-decoration: none;
                    font-size: inherit;
                    font-family: inherit;
                    font-weight: inherit;
                    line-height: inherit;
                    }
                    a[href^="mailto"],
                    a[href^="tel"],
                    a[href^="sms"] {
                    color: inherit;
                    text-decoration: none
                    }
                    </style>
                    <style type="text/css">
                    @media (min-width: 481px) {
                    .hd { display: none!important }
                    }
                    </style>
                    <style type="text/css">
                    @media (max-width: 480px) {
                    .hm { display: none!important }
                    }
                    </style>
                    <style type="text/css">
                    @media (max-width: 480px) {
                    .t43{padding:0 0 22px!important;width:480px!important}.t30,.t39,.t51,.t6{text-align:center!important}.t29,.t38,.t5,.t50{vertical-align:top!important;width:600px!important}.t10,.t34,.t55{width:480px!important}.t3{border-top-left-radius:0!important;border-top-right-radius:0!important;padding:20px 30px!important}.t27{border-bottom-right-radius:0!important;border-bottom-left-radius:0!important;padding:30px!important}.t57{mso-line-height-alt:20px!important;line-height:20px!important}.t46{width:380px!important}.t1{width:44px!important}.t17,.t25{width:420px!important}
                    }
                    </style>
                    <!--[if !mso]>-->
                    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@500;800&amp;display=swap" rel="stylesheet" type="text/css" />
                    <!--<![endif]-->
                    <!--[if mso]>
                    <xml>
                    <o:OfficeDocumentSettings>
                    <o:AllowPNG/>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                    </xml>
                    <![endif]-->
                    </head>
                    <body id="body" class="t60" style="min-width:100%;Margin:0px;padding:0px;background-color:#E0E0E0;"><div class="t59" style="background-color:#E0E0E0;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td class="t58" style="font-size:0;line-height:0;mso-line-height-rule:exactly;background-color:#E0E0E0;" valign="top" align="center">
                    <!--[if mso]>
                    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false">
                    <v:fill color="#E0E0E0"/>
                    </v:background>
                    <![endif]-->
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center" id="innerTable"><tr><td align="center">
                    <table class="t44" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="566" class="t43" style="padding:50px 10px 31px 10px;">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t43" style="width:546px;padding:50px 10px 31px 10px;">
                    <!--<![endif]-->
                    <div class="t42" style="width:100%;text-align:center;"><div class="t41" style="display:inline-block;"><table class="t40" role="presentation" cellpadding="0" cellspacing="0" align="center" valign="top">
                    <tr class="t39"><td></td><td class="t38" width="546" valign="top">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t37" style="width:100%;"><tr>
                    <td class="t36" style="background-color:transparent;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
                    <table class="t11" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="546" class="t10">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t10" style="width:546px;">
                    <!--<![endif]-->
                    <div class="t9" style="width:100%;text-align:center;"><div class="t8" style="display:inline-block;"><table class="t7" role="presentation" cellpadding="0" cellspacing="0" align="center" valign="top">
                    <tr class="t6"><td></td><td class="t5" width="546" valign="top">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t4" style="width:100%;"><tr>
                    <td class="t3" style="overflow:hidden;background-color:#0F6C29;padding:49px 50px 42px 50px;border-radius:18px 18px 0 0;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="left">
                    <table class="t2" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="85" class="t1">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t1" style="width:85px;">
                    <!--<![endif]-->
                    <div style="font-size:0px;"><img class="t0" style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;" width="85" height="113.421875" alt="" src="https://f12118ac-43b3-4365-9119-d5eb13ce5a05.b-cdn.net/e/80e343f2-994b-4baa-be67-4abac901fa8b/8a78323c-2156-4770-88b5-9fd01f439b87.png"/></div></td>
                    </tr></table>
                    </td></tr></table></td>
                    </tr></table>
                    </td>
                    <td></td></tr>
                    </table></div></div></td>
                    </tr></table>
                    </td></tr><tr><td align="center">
                    <table class="t35" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="546" class="t34">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t34" style="width:546px;">
                    <!--<![endif]-->
                    <div class="t33" style="width:100%;text-align:center;"><div class="t32" style="display:inline-block;"><table class="t31" role="presentation" cellpadding="0" cellspacing="0" align="center" valign="top">
                    <tr class="t30"><td></td><td class="t29" width="546" valign="top">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t28" style="width:100%;"><tr>
                    <td class="t27" style="overflow:hidden;background-color:#F8F8F8;padding:40px 50px 40px 50px;border-radius:0 0 18px 18px;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="left">
                    <table class="t14" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="381" class="t13">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t13" style="width:381px;">
                    <!--<![endif]-->
                    <h1 class="t12" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:41px;font-weight:800;font-style:normal;font-size:30px;text-decoration:none;text-transform:none;letter-spacing:-1.56px;direction:ltr;color:#191919;text-align:left;mso-line-height-rule:exactly;mso-text-raise:3px;">Hi, ' . $add_std_firstname . '<br/>Welcome to KLD Events!</h1></td>
                    </tr></table>
                    </td></tr><tr><td><div class="t15" style="mso-line-height-rule:exactly;mso-line-height-alt:25px;line-height:25px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="left">
                    <table class="t18" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="446" class="t17">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t17" style="width:446px;">
                    <!--<![endif]-->
                    <p class="t16" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">You are reading this to notify you that we successfully added you to KLD Event. Below is the link to activate your account and create password.</p></td>
                    </tr></table>
                    </td></tr><tr><td><div class="t19" style="mso-line-height-rule:exactly;mso-line-height-alt:15px;line-height:15px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="left">
                    <table class="t22" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="234" class="t21" style="background-color:#0F6C29;overflow:hidden;text-align:center;line-height:44px;mso-line-height-rule:exactly;mso-text-raise:10px;padding:0 30px 0 30px;border-radius:40px 40px 40px 40px;">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t21" style="background-color:#0F6C29;overflow:hidden;width:174px;text-align:center;line-height:44px;mso-line-height-rule:exactly;mso-text-raise:10px;padding:0 30px 0 30px;border-radius:40px 40px 40px 40px;">
                    <!--<![endif]-->
                    <a class="t20" href=' . $url . ' style="display:block;margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:44px;font-weight:800;font-style:normal;font-size:12px;text-decoration:none;text-transform:uppercase;letter-spacing:2.4px;direction:ltr;color:#FFFFFF;text-align:center;mso-line-height-rule:exactly;mso-text-raise:10px;" target="_blank">Activate</a></td>
                    </tr></table>
                    </td></tr><tr><td><div class="t23" style="mso-line-height-rule:exactly;mso-line-height-alt:15px;line-height:15px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="left">
                    <table class="t26" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="446" class="t25">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t25" style="width:446px;">
                    <!--<![endif]-->
                    <p class="t24" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">If you have any questions or need further assistance, please do not hesitate to contact our support team by replying to this email or visiting our support page.</p></td>
                    </tr></table>
                    </td></tr></table></td>
                    </tr></table>
                    </td>
                    <td></td></tr>
                    </table></div></div></td>
                    </tr></table>
                    </td></tr></table></td>
                    </tr></table>
                    </td>
                    <td></td></tr>
                    </table></div></div></td>
                    </tr></table>
                    </td></tr><tr><td align="center">
                    <table class="t56" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="600" class="t55">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t55" style="width:600px;">
                    <!--<![endif]-->
                    <div class="t54" style="width:100%;text-align:center;"><div class="t53" style="display:inline-block;"><table class="t52" role="presentation" cellpadding="0" cellspacing="0" align="center" valign="top">
                    <tr class="t51"><td></td><td class="t50" width="600" valign="top">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t49" style="width:100%;"><tr>
                    <td class="t48" style="padding:0 50px 0 50px;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
                    <table class="t47" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="420" class="t46">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t46" style="width:420px;">
                    <!--<![endif]-->
                    <p class="t45" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:12px;text-decoration:none;text-transform:none;direction:ltr;color:#888888;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;">© 2024 KLD Events. All Rights Reserved<br/></p></td>
                    </tr></table>
                    </td></tr></table></td>
                    </tr></table>
                    </td>
                    <td></td></tr>
                    </table></div></div></td>
                    </tr></table>
                    </td></tr><tr><td><div class="t57" style="mso-line-height-rule:exactly;mso-line-height-alt:50px;line-height:50px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr></table></td></tr></table></div><div class="gmail-fix" style="display: none; white-space: nowrap; font: 15px courier; line-height: 0;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div></body>
                    </html>

                <html>
                    <body>
                    <br><br>Good day ' . $add_std_firstname . ",<br><br>" .
                "You are reading this to notify you that we successfully added you to KLD Event.
                        <br><br>Below is the link to activate your account and create password.<br><br><br><br>
                        <center>
                            <a style=
                                'text-decoration: none;
                                background:#00bf00;
                                border:1px solid transparent;
                                color:white;
                                border-radius:15px;
                                padding:15px 47px;
                                min-width: 300px;
                                min-height: 50px;
                                font-size:13px;
                                margin-right:7px' 
                                href='$url'>Activate</a>
                        </center>
                        <br>
                    </body>
                </html>";
            //$mail->Body    = '';
            $mail->Body = $msg;

            if ($mail->Send()) {
                $query_param = " (  std_kld_id,
                                    std_kld_email,
                                    std_fname,
                                    std_lname,
                                    yearlvl,
                                    course_id,
                                    section_id,
                                    status,
                                    std_profilepic,
                                    std_activation_key) ";
                $query_param .= "   values (
                                    '" . $add_std_kldnum . "',
                                    '" . $add_std_email . "',
                                    '" . $add_std_firstname . "',
                                    '" . $add_std_lastname . "',
                                    '" . $add_std_yearlvl . "',
                                    '" . $add_std_course . "',
                                    '" . $add_std_section . "',
                                    'inactive',
                                    '" . $add_std_profilepic . "',
                                    '" . $activation_key . "') ";

                $try = mysqli_query($conn, "Insert into std_acc" . $query_param);
                if ($try) {
                    echo "success";
                } else {
                    echo "error";
                }
            } else {
                echo "failed";
            }

            break;
        case "add_emp":
            $add_emp_profilepic = base64_decode($_POST['add_emp_profilepic']);
            $add_emp_firstname = $_POST['add_emp_firstname'];
            $add_emp_lastname = $_POST['add_emp_lastname'];
            $add_emp_role = $_POST['add_emp_role'];
            $add_emp_org = $_POST['add_emp_org'];
            $add_emp_kldnum = $_POST['add_emp_kldnum'];
            $add_emp_email = $_POST['add_emp_email'] . "@kld.edu.ph";
            $activation_key = base64_encode(generateRandomString());

            require_once 'assets/mail/src/Exception.php';
            require_once 'assets/mail/src/SMTP.php';
            require_once 'assets/mail/src/PHPMailer.php';

            $mail = new PHPMailer();
            //$mail->SMTPDebug = 4;
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->IsHTML(true);
            $mail->Host = 'smtp.hostinger.com';
            $mail->Port = 587;
            //$mail->Port = 465;
            $mail->SMTPSecure = "TLS";
            $url = "https://markdenzel.lucero.cloud/kld-events/emp-user/signup.php?ajax=account_activation&activation_key=" . $activation_key;/* 
            $url = "http://localhost/capstone-project-kld-events/kld-events/kld-events/emp-user/signup.php?ajax=account_activation&activation_key=" . $activation_key; */

            $mail->Username = 'steven.dale@lucero.cloud';
            $mail->Password = base64_decode("U3RAY3lMMWx5THVjI3Iw");
            $mail->setFrom('noreply@lucero.cloud', 'KLD Events');
            $mail->addAddress($add_emp_email);
            $mail->addCC("mdplucero@kld.edu.ph");
            $mail->Subject = "Welcome to KLD Event " . $add_emp_firstname;
            $msg = '
    
                <!--
                        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
                        <head>
                        <title></title>
                        <meta charset="UTF-8" />
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                        <!--[if !mso]>-->
                        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                        <!--<![endif]-->
                        <meta name="x-apple-disable-message-reformatting" content="" />
                        <meta content="target-densitydpi=device-dpi" name="viewport" />
                        <meta content="true" name="HandheldFriendly" />
                        <meta content="width=device-width" name="viewport" />
                        <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no" />
                        <style type="text/css">
                        table {
                        border-collapse: separate;
                        table-layout: fixed;
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt
                        }
                        table td {
                        border-collapse: collapse
                        }
                        .ExternalClass {
                        width: 100%
                        }
                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                        line-height: 100%
                        }
                        body, a, li, p, h1, h2, h3 {
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%;
                        }
                        html {
                        -webkit-text-size-adjust: none !important
                        }
                        body, #innerTable {
                        -webkit-font-smoothing: antialiased;
                        -moz-osx-font-smoothing: grayscale
                        }
                        #innerTable img+div {
                        display: none;
                        display: none !important
                        }
                        img {
                        Margin: 0;
                        padding: 0;
                        -ms-interpolation-mode: bicubic
                        }
                        h1, h2, h3, p, a {
                        line-height: inherit;
                        overflow-wrap: normal;
                        white-space: normal;
                        word-break: break-word
                        }
                        a {
                        text-decoration: none
                        }
                        h1, h2, h3, p {
                        min-width: 100%!important;
                        width: 100%!important;
                        max-width: 100%!important;
                        display: inline-block!important;
                        border: 0;
                        padding: 0;
                        margin: 0
                        }
                        a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: none !important;
                        font-size: inherit !important;
                        font-family: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important
                        }
                        u + #body a {
                        color: inherit;
                        text-decoration: none;
                        font-size: inherit;
                        font-family: inherit;
                        font-weight: inherit;
                        line-height: inherit;
                        }
                        a[href^="mailto"],
                        a[href^="tel"],
                        a[href^="sms"] {
                        color: inherit;
                        text-decoration: none
                        }
                        </style>
                        <style type="text/css">
                        @media (min-width: 481px) {
                        .hd { display: none!important }
                        }
                        </style>
                        <style type="text/css">
                        @media (max-width: 480px) {
                        .hm { display: none!important }
                        }
                        </style>
                        <style type="text/css">
                        @media (max-width: 480px) {
                        .t43{padding:0 0 22px!important;width:480px!important}.t30,.t39,.t51,.t6{text-align:center!important}.t29,.t38,.t5,.t50{vertical-align:top!important;width:600px!important}.t10,.t34,.t55{width:480px!important}.t3{border-top-left-radius:0!important;border-top-right-radius:0!important;padding:20px 30px!important}.t27{border-bottom-right-radius:0!important;border-bottom-left-radius:0!important;padding:30px!important}.t57{mso-line-height-alt:20px!important;line-height:20px!important}.t46{width:380px!important}.t1{width:44px!important}.t17,.t25{width:420px!important}
                        }
                        </style>
                        <!--[if !mso]>-->
                        <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@500;800&amp;display=swap" rel="stylesheet" type="text/css" />
                        <!--<![endif]-->
                        <!--[if mso]>
                        <xml>
                        <o:OfficeDocumentSettings>
                        <o:AllowPNG/>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                        </o:OfficeDocumentSettings>
                        </xml>
                        <![endif]-->
                        </head>
                        <body id="body" class="t60" style="min-width:100%;Margin:0px;padding:0px;background-color:#E0E0E0;"><div class="t59" style="background-color:#E0E0E0;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td class="t58" style="font-size:0;line-height:0;mso-line-height-rule:exactly;background-color:#E0E0E0;" valign="top" align="center">
                        <!--[if mso]>
                        <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false">
                        <v:fill color="#E0E0E0"/>
                        </v:background>
                        <![endif]-->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center" id="innerTable"><tr><td align="center">
                        <table class="t44" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                        <tr>
                        <!--[if mso]>
                        <td width="566" class="t43" style="padding:50px 10px 31px 10px;">
                        <![endif]-->
                        <!--[if !mso]>-->
                        <td class="t43" style="width:546px;padding:50px 10px 31px 10px;">
                        <!--<![endif]-->
                        <div class="t42" style="width:100%;text-align:center;"><div class="t41" style="display:inline-block;"><table class="t40" role="presentation" cellpadding="0" cellspacing="0" align="center" valign="top">
                        <tr class="t39"><td></td><td class="t38" width="546" valign="top">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t37" style="width:100%;"><tr>
                        <td class="t36" style="background-color:transparent;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
                        <table class="t11" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                        <tr>
                        <!--[if mso]>
                        <td width="546" class="t10">
                        <![endif]-->
                        <!--[if !mso]>-->
                        <td class="t10" style="width:546px;">
                        <!--<![endif]-->
                        <div class="t9" style="width:100%;text-align:center;"><div class="t8" style="display:inline-block;"><table class="t7" role="presentation" cellpadding="0" cellspacing="0" align="center" valign="top">
                        <tr class="t6"><td></td><td class="t5" width="546" valign="top">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t4" style="width:100%;"><tr>
                        <td class="t3" style="overflow:hidden;background-color:#0F6C29;padding:49px 50px 42px 50px;border-radius:18px 18px 0 0;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="left">
                        <table class="t2" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                        <tr>
                        <!--[if mso]>
                        <td width="85" class="t1">
                        <![endif]-->
                        <!--[if !mso]>-->
                        <td class="t1" style="width:85px;">
                        <!--<![endif]-->
                        <div style="font-size:0px;"><img class="t0" style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;" width="85" height="113.421875" alt="" src="https://f12118ac-43b3-4365-9119-d5eb13ce5a05.b-cdn.net/e/80e343f2-994b-4baa-be67-4abac901fa8b/8a78323c-2156-4770-88b5-9fd01f439b87.png"/></div></td>
                        </tr></table>
                        </td></tr></table></td>
                        </tr></table>
                        </td>
                        <td></td></tr>
                        </table></div></div></td>
                        </tr></table>
                        </td></tr><tr><td align="center">
                        <table class="t35" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                        <tr>
                        <!--[if mso]>
                        <td width="546" class="t34">
                        <![endif]-->
                        <!--[if !mso]>-->
                        <td class="t34" style="width:546px;">
                        <!--<![endif]-->
                        <div class="t33" style="width:100%;text-align:center;"><div class="t32" style="display:inline-block;"><table class="t31" role="presentation" cellpadding="0" cellspacing="0" align="center" valign="top">
                        <tr class="t30"><td></td><td class="t29" width="546" valign="top">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t28" style="width:100%;"><tr>
                        <td class="t27" style="overflow:hidden;background-color:#F8F8F8;padding:40px 50px 40px 50px;border-radius:0 0 18px 18px;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="left">
                        <table class="t14" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                        <tr>
                        <!--[if mso]>
                        <td width="381" class="t13">
                        <![endif]-->
                        <!--[if !mso]>-->
                        <td class="t13" style="width:381px;">
                        <!--<![endif]-->
                        <h1 class="t12" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:41px;font-weight:800;font-style:normal;font-size:30px;text-decoration:none;text-transform:none;letter-spacing:-1.56px;direction:ltr;color:#191919;text-align:left;mso-line-height-rule:exactly;mso-text-raise:3px;">Hi, ' . $add_emp_firstname . '<br/>Welcome to KLD Events!</h1></td>
                        </tr></table>
                        </td></tr><tr><td><div class="t15" style="mso-line-height-rule:exactly;mso-line-height-alt:25px;line-height:25px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="left">
                        <table class="t18" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                        <tr>
                        <!--[if mso]>
                        <td width="446" class="t17">
                        <![endif]-->
                        <!--[if !mso]>-->
                        <td class="t17" style="width:446px;">
                        <!--<![endif]-->
                        <p class="t16" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">You are reading this to notify you that we successfully added you to KLD Event. Below is the link to activate your account and create password.</p></td>
                        </tr></table>
                        </td></tr><tr><td><div class="t19" style="mso-line-height-rule:exactly;mso-line-height-alt:15px;line-height:15px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="left">
                        <table class="t22" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                        <tr>
                        <!--[if mso]>
                        <td width="234" class="t21" style="background-color:#0F6C29;overflow:hidden;text-align:center;line-height:44px;mso-line-height-rule:exactly;mso-text-raise:10px;padding:0 30px 0 30px;border-radius:40px 40px 40px 40px;">
                        <![endif]-->
                        <!--[if !mso]>-->
                        <td class="t21" style="background-color:#0F6C29;overflow:hidden;width:174px;text-align:center;line-height:44px;mso-line-height-rule:exactly;mso-text-raise:10px;padding:0 30px 0 30px;border-radius:40px 40px 40px 40px;">
                        <!--<![endif]-->
                        <a class="t20" href=' . $url . ' style="display:block;margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:44px;font-weight:800;font-style:normal;font-size:12px;text-decoration:none;text-transform:uppercase;letter-spacing:2.4px;direction:ltr;color:#FFFFFF;text-align:center;mso-line-height-rule:exactly;mso-text-raise:10px;" target="_blank">Activate</a></td>
                        </tr></table>
                        </td></tr><tr><td><div class="t23" style="mso-line-height-rule:exactly;mso-line-height-alt:15px;line-height:15px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="left">
                        <table class="t26" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                        <tr>
                        <!--[if mso]>
                        <td width="446" class="t25">
                        <![endif]-->
                        <!--[if !mso]>-->
                        <td class="t25" style="width:446px;">
                        <!--<![endif]-->
                        <p class="t24" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">If you have any questions or need further assistance, please do not hesitate to contact our support team by replying to this email or visiting our support page.</p></td>
                        </tr></table>
                        </td></tr></table></td>
                        </tr></table>
                        </td>
                        <td></td></tr>
                        </table></div></div></td>
                        </tr></table>
                        </td></tr></table></td>
                        </tr></table>
                        </td>
                        <td></td></tr>
                        </table></div></div></td>
                        </tr></table>
                        </td></tr><tr><td align="center">
                        <table class="t56" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                        <tr>
                        <!--[if mso]>
                        <td width="600" class="t55">
                        <![endif]-->
                        <!--[if !mso]>-->
                        <td class="t55" style="width:600px;">
                        <!--<![endif]-->
                        <div class="t54" style="width:100%;text-align:center;"><div class="t53" style="display:inline-block;"><table class="t52" role="presentation" cellpadding="0" cellspacing="0" align="center" valign="top">
                        <tr class="t51"><td></td><td class="t50" width="600" valign="top">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t49" style="width:100%;"><tr>
                        <td class="t48" style="padding:0 50px 0 50px;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
                        <table class="t47" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                        <tr>
                        <!--[if mso]>
                        <td width="420" class="t46">
                        <![endif]-->
                        <!--[if !mso]>-->
                        <td class="t46" style="width:420px;">
                        <!--<![endif]-->
                        <p class="t45" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:12px;text-decoration:none;text-transform:none;direction:ltr;color:#888888;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;">© 2024 KLD Events. All Rights Reserved<br/></p></td>
                        </tr></table>
                        </td></tr></table></td>
                        </tr></table>
                        </td>
                        <td></td></tr>
                        </table></div></div></td>
                        </tr></table>
                        </td></tr><tr><td><div class="t57" style="mso-line-height-rule:exactly;mso-line-height-alt:50px;line-height:50px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr></table></td></tr></table></div><div class="gmail-fix" style="display: none; white-space: nowrap; font: 15px courier; line-height: 0;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div></body>
                        </html>
    
                    <html>
                        <body>
                        <br><br>Good day ' . $add_emp_firstname . ",<br><br>" .
                "You are reading this to notify you that we successfully added you to KLD Event.
                            <br><br>Below is the link to activate your account and create password.<br><br><br><br>
                            <center>
                                <a style=
                                    'text-decoration: none;
                                    background:#00bf00;
                                    border:1px solid transparent;
                                    color:white;
                                    border-radius:15px;
                                    padding:15px 47px;
                                    min-width: 300px;
                                    min-height: 50px;
                                    font-size:13px;
                                    margin-right:7px' 
                                    href='$url'>Activate</a>
                            </center>
                            <br>
                        </body>
                    </html>";
            //$mail->Body    = '';
            $mail->Body = $msg;

            if ($mail->Send()) {
                $query_param = " (  emp_kld_id,
                                        emp_kld_email,
                                        emp_fname,
                                        emp_lname,
                                        org_id,
                                        emp_role,
                                        status,
                                        emp_profilepic,
                                        emp_activation_key) ";
                $query_param .= "   values (
                                        '" . $add_emp_kldnum . "',
                                        '" . $add_emp_email . "',
                                        '" . $add_emp_firstname . "',
                                        '" . $add_emp_lastname . "',
                                        '" . $add_emp_org . "',
                                        '" . $add_emp_role . "',
                                        'inactive',
                                        '" . $add_emp_profilepic . "',
                                        '" . $activation_key . "') ";

                $try = mysqli_query($conn, "Insert into emp_acc" . $query_param);
                if ($try) {
                    echo "success";
                } else {
                    echo "error";
                }
            } else {
                echo "failed";
            }

            break;
        case "add_org_user":
            $add_org_profilepic = base64_decode($_POST['add_org_profilepic']);
            $add_org_fname = $_POST['add_org_fname'];
            $add_org_lname = $_POST['add_org_lname'];
            $add_org_role = $_POST['add_org_role'];
            $add_org_organization = $_POST['add_org_organization'];
            $add_org_kldid = $_POST['add_org_kldid'];
            $add_org_email = $_POST['add_org_email'] . "@kld.edu.ph";
            $activation_key = base64_encode(generateRandomString());

            require_once 'assets/mail/src/Exception.php';
            require_once 'assets/mail/src/SMTP.php';
            require_once 'assets/mail/src/PHPMailer.php';

            $mail = new PHPMailer();
            //$mail->SMTPDebug = 4;
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->IsHTML(true);
            $mail->Host = 'smtp.hostinger.com';
            $mail->Port = 587;
            //$mail->Port = 465;
            $mail->SMTPSecure = "TLS";
            $url = "https://markdenzel.lucero.cloud/kld-events/org-admin/signup.php?ajax=account_activation&activation_key=" . $activation_key;/* 
            $url = "http://localhost/capstone-project-kld-events/kld-events/kld-events/org-admin/signup.php?ajax=account_activation&activation_key=" . $activation_key; */

            $mail->Username = 'steven.dale@lucero.cloud';
            $mail->Password = base64_decode("U3RAY3lMMWx5THVjI3Iw");
            $mail->setFrom('noreply@lucero.cloud', 'KLD noreply');
            $mail->addAddress($add_org_email);
            $mail->addCC("mdplucero@kld.edu.ph");
            $mail->Subject = "Welcome to KLD Event, " . $add_org_fname;
            $msg = '
    
                     <!--
                    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
                    <head>
                    <title></title>
                    <meta charset="UTF-8" />
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <!--[if !mso]>-->
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                    <!--<![endif]-->
                    <meta name="x-apple-disable-message-reformatting" content="" />
                    <meta content="target-densitydpi=device-dpi" name="viewport" />
                    <meta content="true" name="HandheldFriendly" />
                    <meta content="width=device-width" name="viewport" />
                    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no" />
                    <style type="text/css">
                    table {
                    border-collapse: separate;
                    table-layout: fixed;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt
                    }
                    table td {
                    border-collapse: collapse
                    }
                    .ExternalClass {
                    width: 100%
                    }
                    .ExternalClass,
                    .ExternalClass p,
                    .ExternalClass span,
                    .ExternalClass font,
                    .ExternalClass td,
                    .ExternalClass div {
                    line-height: 100%
                    }
                    body, a, li, p, h1, h2, h3 {
                    -ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                    }
                    html {
                    -webkit-text-size-adjust: none !important
                    }
                    body, #innerTable {
                    -webkit-font-smoothing: antialiased;
                    -moz-osx-font-smoothing: grayscale
                    }
                    #innerTable img+div {
                    display: none;
                    display: none !important
                    }
                    img {
                    Margin: 0;
                    padding: 0;
                    -ms-interpolation-mode: bicubic
                    }
                    h1, h2, h3, p, a {
                    line-height: inherit;
                    overflow-wrap: normal;
                    white-space: normal;
                    word-break: break-word
                    }
                    a {
                    text-decoration: none
                    }
                    h1, h2, h3, p {
                    min-width: 100%!important;
                    width: 100%!important;
                    max-width: 100%!important;
                    display: inline-block!important;
                    border: 0;
                    padding: 0;
                    margin: 0
                    }
                    a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: none !important;
                    font-size: inherit !important;
                    font-family: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important
                    }
                    u + #body a {
                    color: inherit;
                    text-decoration: none;
                    font-size: inherit;
                    font-family: inherit;
                    font-weight: inherit;
                    line-height: inherit;
                    }
                    a[href^="mailto"],
                    a[href^="tel"],
                    a[href^="sms"] {
                    color: inherit;
                    text-decoration: none
                    }
                    </style>
                    <style type="text/css">
                    @media (min-width: 481px) {
                    .hd { display: none!important }
                    }
                    </style>
                    <style type="text/css">
                    @media (max-width: 480px) {
                    .hm { display: none!important }
                    }
                    </style>
                    <style type="text/css">
                    @media (max-width: 480px) {
                    .t43{padding:0 0 22px!important;width:480px!important}.t30,.t39,.t51,.t6{text-align:center!important}.t29,.t38,.t5,.t50{vertical-align:top!important;width:600px!important}.t10,.t34,.t55{width:480px!important}.t3{border-top-left-radius:0!important;border-top-right-radius:0!important;padding:20px 30px!important}.t27{border-bottom-right-radius:0!important;border-bottom-left-radius:0!important;padding:30px!important}.t57{mso-line-height-alt:20px!important;line-height:20px!important}.t46{width:380px!important}.t1{width:44px!important}.t17,.t25{width:420px!important}
                    }
                    </style>
                    <!--[if !mso]>-->
                    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@500;800&amp;display=swap" rel="stylesheet" type="text/css" />
                    <!--<![endif]-->
                    <!--[if mso]>
                    <xml>
                    <o:OfficeDocumentSettings>
                    <o:AllowPNG/>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                    </xml>
                    <![endif]-->
                    </head>
                    <body id="body" class="t60" style="min-width:100%;Margin:0px;padding:0px;background-color:#E0E0E0;"><div class="t59" style="background-color:#E0E0E0;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td class="t58" style="font-size:0;line-height:0;mso-line-height-rule:exactly;background-color:#E0E0E0;" valign="top" align="center">
                    <!--[if mso]>
                    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false">
                    <v:fill color="#E0E0E0"/>
                    </v:background>
                    <![endif]-->
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center" id="innerTable"><tr><td align="center">
                    <table class="t44" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="566" class="t43" style="padding:50px 10px 31px 10px;">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t43" style="width:546px;padding:50px 10px 31px 10px;">
                    <!--<![endif]-->
                    <div class="t42" style="width:100%;text-align:center;"><div class="t41" style="display:inline-block;"><table class="t40" role="presentation" cellpadding="0" cellspacing="0" align="center" valign="top">
                    <tr class="t39"><td></td><td class="t38" width="546" valign="top">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t37" style="width:100%;"><tr>
                    <td class="t36" style="background-color:transparent;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
                    <table class="t11" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="546" class="t10">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t10" style="width:546px;">
                    <!--<![endif]-->
                    <div class="t9" style="width:100%;text-align:center;"><div class="t8" style="display:inline-block;"><table class="t7" role="presentation" cellpadding="0" cellspacing="0" align="center" valign="top">
                    <tr class="t6"><td></td><td class="t5" width="546" valign="top">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t4" style="width:100%;"><tr>
                    <td class="t3" style="overflow:hidden;background-color:#0F6C29;padding:49px 50px 42px 50px;border-radius:18px 18px 0 0;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="left">
                    <table class="t2" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="85" class="t1">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t1" style="width:85px;">
                    <!--<![endif]-->
                    <div style="font-size:0px;"><img class="t0" style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;" width="85" height="113.421875" alt="" src="https://f12118ac-43b3-4365-9119-d5eb13ce5a05.b-cdn.net/e/80e343f2-994b-4baa-be67-4abac901fa8b/8a78323c-2156-4770-88b5-9fd01f439b87.png"/></div></td>
                    </tr></table>
                    </td></tr></table></td>
                    </tr></table>
                    </td>
                    <td></td></tr>
                    </table></div></div></td>
                    </tr></table>
                    </td></tr><tr><td align="center">
                    <table class="t35" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="546" class="t34">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t34" style="width:546px;">
                    <!--<![endif]-->
                    <div class="t33" style="width:100%;text-align:center;"><div class="t32" style="display:inline-block;"><table class="t31" role="presentation" cellpadding="0" cellspacing="0" align="center" valign="top">
                    <tr class="t30"><td></td><td class="t29" width="546" valign="top">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t28" style="width:100%;"><tr>
                    <td class="t27" style="overflow:hidden;background-color:#F8F8F8;padding:40px 50px 40px 50px;border-radius:0 0 18px 18px;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="left">
                    <table class="t14" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="381" class="t13">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t13" style="width:381px;">
                    <!--<![endif]-->
                    <h1 class="t12" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:41px;font-weight:800;font-style:normal;font-size:30px;text-decoration:none;text-transform:none;letter-spacing:-1.56px;direction:ltr;color:#191919;text-align:left;mso-line-height-rule:exactly;mso-text-raise:3px;">Hi, ' . $add_org_fname . '<br/>Welcome to KLD Events!</h1></td>
                    </tr></table>
                    </td></tr><tr><td><div class="t15" style="mso-line-height-rule:exactly;mso-line-height-alt:25px;line-height:25px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="left">
                    <table class="t18" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="446" class="t17">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t17" style="width:446px;">
                    <!--<![endif]-->
                    <p class="t16" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">You are reading this to notify you that we successfully added you to KLD Event. Below is the link to activate your account and create password.</p></td>
                    </tr></table>
                    </td></tr><tr><td><div class="t19" style="mso-line-height-rule:exactly;mso-line-height-alt:15px;line-height:15px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="left">
                    <table class="t22" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="234" class="t21" style="background-color:#0F6C29;overflow:hidden;text-align:center;line-height:44px;mso-line-height-rule:exactly;mso-text-raise:10px;padding:0 30px 0 30px;border-radius:40px 40px 40px 40px;">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t21" style="background-color:#0F6C29;overflow:hidden;width:174px;text-align:center;line-height:44px;mso-line-height-rule:exactly;mso-text-raise:10px;padding:0 30px 0 30px;border-radius:40px 40px 40px 40px;">
                    <!--<![endif]-->
                    <a class="t20" href=' . $url . ' style="display:block;margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:44px;font-weight:800;font-style:normal;font-size:12px;text-decoration:none;text-transform:uppercase;letter-spacing:2.4px;direction:ltr;color:#FFFFFF;text-align:center;mso-line-height-rule:exactly;mso-text-raise:10px;" target="_blank">Activate</a></td>
                    </tr></table>
                    </td></tr><tr><td><div class="t23" style="mso-line-height-rule:exactly;mso-line-height-alt:15px;line-height:15px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="left">
                    <table class="t26" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="446" class="t25">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t25" style="width:446px;">
                    <!--<![endif]-->
                    <p class="t24" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">If you have any questions or need further assistance, please do not hesitate to contact our support team by replying to this email or visiting our support page.</p></td>
                    </tr></table>
                    </td></tr></table></td>
                    </tr></table>
                    </td>
                    <td></td></tr>
                    </table></div></div></td>
                    </tr></table>
                    </td></tr></table></td>
                    </tr></table>
                    </td>
                    <td></td></tr>
                    </table></div></div></td>
                    </tr></table>
                    </td></tr><tr><td align="center">
                    <table class="t56" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="600" class="t55">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t55" style="width:600px;">
                    <!--<![endif]-->
                    <div class="t54" style="width:100%;text-align:center;"><div class="t53" style="display:inline-block;"><table class="t52" role="presentation" cellpadding="0" cellspacing="0" align="center" valign="top">
                    <tr class="t51"><td></td><td class="t50" width="600" valign="top">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t49" style="width:100%;"><tr>
                    <td class="t48" style="padding:0 50px 0 50px;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
                    <table class="t47" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
                    <tr>
                    <!--[if mso]>
                    <td width="420" class="t46">
                    <![endif]-->
                    <!--[if !mso]>-->
                    <td class="t46" style="width:420px;">
                    <!--<![endif]-->
                    <p class="t45" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:12px;text-decoration:none;text-transform:none;direction:ltr;color:#888888;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;">© 2024 KLD Events. All Rights Reserved<br/></p></td>
                    </tr></table>
                    </td></tr></table></td>
                    </tr></table>
                    </td>
                    <td></td></tr>
                    </table></div></div></td>
                    </tr></table>
                    </td></tr><tr><td><div class="t57" style="mso-line-height-rule:exactly;mso-line-height-alt:50px;line-height:50px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr></table></td></tr></table></div><div class="gmail-fix" style="display: none; white-space: nowrap; font: 15px courier; line-height: 0;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div></body>
                    </html>

                <html>
                    <body>
                    <br><br>Good day ' . $add_org_fname . ",<br><br>" .
                "You are reading this to notify you that we successfully added you to KLD Event.
                        <br><br>Below is the link to activate your account and create password.<br><br><br><br>
                        <center>
                            <a style=
                                'text-decoration: none;
                                background:#00bf00;
                                border:1px solid transparent;
                                color:white;
                                border-radius:15px;
                                padding:15px 47px;
                                min-width: 300px;
                                min-height: 50px;
                                font-size:13px;
                                margin-right:7px' 
                                href='$url'>Activate</a>
                        </center>
                        <br>
                    </body>
                </html>";
            //$mail->Body    = '';
            $mail->Body = $msg;

            if ($mail->Send()) {
                $query_param = " (
                                        org_email,
                                        org_fname,
                                        org_lname,
                                        org_role,
                                        org_id,
                                        org_kld_id,
                                        status,
                                        org_profile,
                                        org_activation_key) ";
                $query_param .= "   values (
                                        '" . $add_org_email . "',
                                        '" . $add_org_fname . "',
                                        '" . $add_org_lname . "',
                                        '" . $add_org_role . "',
                                        '" . $add_org_organization . "',
                                        '" . $add_org_kldid . "',
                                        'NEW',
                                        '" . $add_org_profilepic . "',
                                        '" . $activation_key . "') ";

                $try = mysqli_query($conn, "Insert into org_acc" . $query_param);
                if ($try) {
                    echo "success";
                } else {
                    echo "error";
                }
            } else {
                echo "failed";
            }

            break;
        case "add_std_info":
            $kld_signup_fname = $_POST['kld_signup_fname'];
            $kld_signup_lname = $_POST['kld_signup_lname'];
            $kld_username = $_POST['kld_username'];
            $kld_password = $_POST['kld_password'];
            $query_param = " set std_fname = '" . $kld_signup_fname . "', ";
            $query_param .= " std_lname = '" . $kld_signup_lname . "', ";
            $query_param .= " std_uname = '" . $kld_username . "', ";
            $query_param .= " std_pass = '" . $kld_password . "', ";
            $query_param .= " std_activation_key = '' ";
            $query_param .= " where std_activation_key = '" . $_SESSION['activation_key'] . "' ";



            $try = mysqli_query($conn, "Update std_acc" . $query_param);
            if ($try) {
                echo "success";
                session_destroy();
            } else {
                echo "error";
            }
            break;
        case "add_emp_info":
            $kld_signup_fname = $_POST['kld_signup_fname'];
            $kld_signup_lname = $_POST['kld_signup_lname'];
            $kld_username = $_POST['kld_username'];
            $kld_password = $_POST['kld_password'];
            $query_param = " set emp_fname = '" . $kld_signup_fname . "', ";
            $query_param .= " emp_lname = '" . $kld_signup_lname . "', ";
            $query_param .= " emp_uname = '" . $kld_username . "', ";
            $query_param .= " emp_pass = '" . $kld_password . "', ";
            $query_param .= " emp_activation_key = '' ";
            $query_param .= " where emp_activation_key = '" . $_SESSION['activation_key'] . "' ";



            $try = mysqli_query($conn, "Update emp_acc" . $query_param);
            if ($try) {
                echo "success";
                session_destroy();
            } else {
                echo "error";
            }
            break;
        case "create_account":
            $username = $_POST['username'];
            $password = base64_encode(base64_encode($_POST['password']));
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $login_type = null;
            $query_param = null;

            switch ($_POST['account_type']) {
                case "admin":
                    $login_type = " admin_acc ";
                    $query_param = " (admin_uname,admin_pass,admin_fname,admin_lname) ";
                    $query_param .= " values ('" . $username . "','" . $password . "','" . $firstname . "','" . $lastname . "') ";
                    break;
                case "student":
                    $login_type = "std_acc";
                    break;
                case "admin":
                    $login_type = "admin_acc";
                    break;
            }

            $try = mysqli_query($conn, "Insert into " . $login_type . $query_param);
            if ($try) {
                echo "success";
            } else {
                echo "error";
            }
            break;
        case "logging_in":
            $username = $_POST['username'];
            $password = base64_encode(base64_encode($_POST['password']));
            $login_type = $_POST['login_type'];
            switch ($login_type) {
                case "admin":

                    $query = "Select * from admin_acc where admin_uname = '" . $username . "' and admin_pass = '" . $password . "'";
                    $try = mysqli_query($conn, $query);
                    $json = [];
                    while ($row = $try->fetch_array()) {
                        echo "success"; //match yung uname at pass
                        $_SESSION['kld_id'] = $row['admin_id'];
                        $_SESSION['kld_username'] = $row['admin_uname'];
                        $_SESSION['kld_admin_role'] = $row['admin_role'];
                        $_SESSION['kld_profile'] = $row['admin_profile'];
                        $_SESSION['login_type'] = "Administrator";
                        $_SESSION['kld_fname'] = $row['admin_fname'];
                        $_SESSION['kld_lname'] = $row['admin_lname'];
                        $_SESSION['kld_email'] = $row['admin_email'];
                        $_SESSION['kld_login_expiration'] = true;
                        return;
                    }
                    echo "failed";
                    break;
                case "student":
                    // wala pang laman, maya konte
                    $query = "Select std_acc.*, yearlvl_tbl.yearlvl_name, course_tbl.*, section_tbl.section_name
                    from std_acc
                    left join yearlvl_tbl on std_acc.yearlvl = yearlvl_tbl.yearlvl_id
                    left join course_tbl on std_acc.course_id = course_tbl.course_id
                    left join section_tbl on std_acc.section_id = section_tbl.section_id
                    where std_uname = '" . $username . "' and std_pass = '" . $password . "'";
                    $try = mysqli_query($conn, $query);
                    $json = [];
                    while ($row = $try->fetch_array()) {
                        echo "success"; //match yung uname at pass
                        $_SESSION['kld_id'] = $row['std_id'];
                        $_SESSION['kld_username'] = $row['std_uname'];
                        $_SESSION['kld_std_id'] = $row['std_kld_id'];
                        $_SESSION['kld_profile'] = $row['std_profilepic'];
                        $_SESSION['login_type'] = "Student";
                        $_SESSION['kld_fname'] = $row['std_fname'];
                        $_SESSION['kld_lname'] = $row['std_lname'];
                        $_SESSION['kld_email'] = $row['std_kld_email'];
                        $_SESSION['kld_login_expiration'] = true;
                        $_SESSION['kld_yearlvl'] = $row['yearlvl_name'];
                        $_SESSION['kld_course'] = $row['course_acronym'];
                        $_SESSION['kld_program'] = $row['course_name'];
                        $_SESSION['kld_section'] = $row['section_name'];
                        return;
                    }
                    echo "failed";
                    break;

                case "employee":
                    // wala pang laman, maya konte
                    $query = "Select emp_acc.*, org_tbl.org_name, org_tbl.org_id
                        from emp_acc
                        left join org_tbl on emp_acc.org_id = org_tbl.org_id
                        where emp_uname = '" . $username . "' and emp_pass = '" . $password . "'";
                    $try = mysqli_query($conn, $query);
                    $json = [];
                    while ($row = $try->fetch_array()) {
                        echo "success"; //match yung uname at pass
                        $_SESSION['kld_id'] = $row['emp_id'];
                        $_SESSION['kld_username'] = $row['emp_uname'];
                        $_SESSION['kld_emp_id'] = $row['emp_kld_id'];
                        $_SESSION['kld_profile'] = $row['emp_profilepic'];
                        $_SESSION['login_type'] = "Employee";
                        $_SESSION['kld_fname'] = $row['emp_fname'];
                        $_SESSION['kld_lname'] = $row['emp_lname'];
                        $_SESSION['kld_email'] = $row['emp_kld_email'];
                        $_SESSION['kld_org_id'] = $row['org_id'];
                        $_SESSION['kld_login_expiration'] = true;
                        $_SESSION['kld_org'] = $row['org_name'];
                        $_SESSION['kld_role'] = $row['emp_role'];
                        return;
                    }
                    echo "failed";
                    break;
                case "org":
                    $query = "Select * from org_acc where org_uname = '" . $username . "' and org_pass = '" . $password . "'";
                    $try = mysqli_query($conn, $query);
                    $json = [];
                    while ($row = $try->fetch_array()) {
                        echo "success"; //match yung uname at pass
                        $_SESSION['kld_username'] = $row['org_uname'];
                        $_SESSION['kld_org_role'] = $row['org_role'];
                        $_SESSION['login_type'] = "Organizer";
                        $_SESSION['kld_fname'] = $row['org_fname'];
                        $_SESSION['kld_lname'] = $row['org_lname'];
                        $_SESSION['kld_email'] = $row['org_email'];
                        $_SESSION['kld_login_expiration'] = true;
                        return;
                    }
                    echo "failed";
                    break;
                default:
                    die("Someone might be trying to brute-force logging in.");
            }
            break;
        case "logging_out":
            unset($_SESSION['ajax']);
            unset($_SESSION['kld_login_expiration']);
            unset($_COOKIE['kld_login_expiration']);
            session_destroy();
            header('location:/login.php');
            break;
        case "add_event":
            $eventType = $_POST['eventType'];
            $venue_id = $_POST['venue_id'];
            $event_start_date = date('Y-m-d H:i:s', strtotime($_POST['event_start_date']));
            $event_end_date = date('Y-m-d H:i:s', strtotime($_POST['event_end_date']));
            $event_title = htmlspecialchars($_POST['event_title'], ENT_QUOTES);
            $event_description = htmlspecialchars($_POST['event_description'], ENT_QUOTES);
            $event_category = $_POST['event_category'];
            $event_organization = $_POST['event_organization'];
            $event_poster = $_POST['event_poster'];

            // Insert into kld_event
            $try = mysqli_query(
                $conn,
                "INSERT INTO kld_event
                        (event_type, 
                        venue_id, 
                        event_start_date, 
                        event_end_date, 
                        event_title, 
                        category_id, 
                        event_desc, 
                        event_org_id, 
                        event_poster,
                        status)
                    VALUES
                        (
                            '" . $eventType . "',
                            '" . $venue_id . "',
                            '" . $event_start_date . "',
                            '" . $event_end_date . "',
                            '" . $event_title . "',
                            '" . $event_category . "',
                            '" . $event_description . "',
                            '" . $event_organization . "',
                            '" . $event_poster . "',
                            'pending'
                        )"
            );

            if ($try) {
                // Get the last inserted event_id
                $event_id = mysqli_insert_id($conn);
                $proposal_letter = $_POST['proposal_letter'];

                // Decode admin and organizer arrays
                $event_admins = json_decode($_POST['event_admins'], true) ?? []; // Use null coalescing
                $event_organizers = json_decode($_POST['event_organizers'], true) ?? []; // Use null coalescing

                // Insert stakeholders (admins)
                foreach ($event_admins as $admin_id) {
                    $insert_stakeholder = "INSERT INTO stakeholder_tbl (event_id, admin_id, status) VALUES ('$event_id', '$admin_id', 'pending')";
                    if (!mysqli_query($conn, $insert_stakeholder)) {
                        error_log("Error inserting admin stakeholder: " . mysqli_error($conn));
                    }
                }

                // Insert stakeholders (organizers)
                foreach ($event_organizers as $org_acc_id) {
                    $insert_stakeholder = "INSERT INTO stakeholder_tbl (event_id, org_acc_id, status) VALUES ('$event_id', '$org_acc_id', 'pending')";
                    if (!mysqli_query($conn, $insert_stakeholder)) {
                        error_log("Error inserting organizer stakeholder: " . mysqli_error($conn));
                    }
                }

                // Decode JSON data from the POST request
                $attendees = [
                    'course_ids' => json_decode($_POST['course_ids'], true),
                    'yearlvl_ids' => json_decode($_POST['yearlvl_ids'], true),
                    'section_ids' => json_decode($_POST['section_ids'], true),
                    'org_ids' => json_decode($_POST['org_ids'], true)
                ];

                // Always insert the event_id first
                $insert_invitation = "INSERT INTO event_invitation (event_id) VALUES ('$event_id')";
                mysqli_query($conn, $insert_invitation);

                // Insert additional data only if it's not null
                if (!is_null($attendees['course_ids'])) {
                    foreach ($attendees['course_ids'] as $course_id) {
                        $insert_invitation = "INSERT INTO event_invitation (event_id, course_id) VALUES ('$event_id', '$course_id')";
                        mysqli_query($conn, $insert_invitation);
                    }
                }

                if (!is_null($attendees['yearlvl_ids'])) {
                    foreach ($attendees['yearlvl_ids'] as $yearlvl_id) {
                        $insert_invitation = "INSERT INTO event_invitation (event_id, yearlvl_id) VALUES ('$event_id', '$yearlvl_id')";
                        mysqli_query($conn, $insert_invitation);
                    }
                }

                if (!is_null($attendees['section_ids'])) {
                    foreach ($attendees['section_ids'] as $section_id) {
                        $insert_invitation = "INSERT INTO event_invitation (event_id, section_id) VALUES ('$event_id', '$section_id')";
                        mysqli_query($conn, $insert_invitation);
                    }
                }

                if (!is_null($attendees['org_ids'])) {
                    foreach ($attendees['org_ids'] as $org_id) {
                        $insert_invitation = "INSERT INTO event_invitation (event_id, org_id) VALUES ('$event_id', '$org_id')";
                        mysqli_query($conn, $insert_invitation);
                    }
                }

                // Insert the proposal letter
                $insert_letter = "INSERT INTO letter_tbl (event_id, letter_content) VALUES ('$event_id', '$proposal_letter')";
                if (mysqli_query($conn, $insert_letter)) {
                    // Successfully inserted letter
                } else {
                    error_log("Error inserting letter: " . mysqli_error($conn));
                }

                // Return success response with event_id
                echo json_encode([
                    "status" => "success",
                    "event_id" => $event_id // Send the event ID back to the client
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Failed to add event. Reason: " . mysqli_error($conn)
                ]);
            }

            break;

        case "update_capacity":
            // Collect filters from the AJAX request
            $courseIds = isset($_POST['course_ids']) ? $_POST['course_ids'] : [];
            $yearlvlIds = isset($_POST['yearlvl_ids']) ? $_POST['yearlvl_ids'] : [];
            $sectionIds = isset($_POST['section_ids']) ? $_POST['section_ids'] : [];
            $orgIds = isset($_POST['org_ids']) ? $_POST['org_ids'] : [];
            $selectAllMembers = isset($_POST['select_all_kld_members']) ? $_POST['select_all_kld_members'] : false;

            // Prepare queries based on the select all switch
            if ($selectAllMembers === "true" || (empty($courseIds) && empty($yearlvlIds) && empty($sectionIds) && empty($orgIds))) {
                // If "Select All KLD Members" is active or no filters are selected, count all records
                $studentQuery = "SELECT COUNT(*) as student_count FROM std_acc";
                $employeeQuery = "SELECT COUNT(*) as employee_count FROM emp_acc";
            } else {
                // Count only records matching the selected filters
                $studentQuery = "SELECT COUNT(*) as student_count FROM std_acc WHERE course_id IN ('" . implode("','", $courseIds) . "') AND yearlvl_id IN ('" . implode("','", $yearlvlIds) . "') AND section_id IN ('" . implode("','", $sectionIds) . "')";
                $employeeQuery = "SELECT COUNT(*) as employee_count FROM emp_acc WHERE org_id IN ('" . implode("','", $orgIds) . "')";
            }

            // Execute queries
            $studentResult = mysqli_query($conn, $studentQuery);
            $studentCount = $studentResult ? $studentResult->fetch_assoc()['student_count'] : 0;

            $employeeResult = mysqli_query($conn, $employeeQuery);
            $employeeCount = $employeeResult ? $employeeResult->fetch_assoc()['employee_count'] : 0;

            // Calculate total count
            $totalCount = $studentCount + $employeeCount;

            // Return the total count as a JSON response
            echo json_encode(['totalCount' => $totalCount]);

            break;

        case "admin_approve":
            $id = $_POST['session_id']; // Session ID of the admin
            $eventId = $_POST['event_id']; // Event ID passed from AJAX

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("UPDATE stakeholder_tbl SET status=?, date_approved=NOW() WHERE event_id=? AND admin_id=?");
            $status = 'approved'; // Set status to 'approved'
            $stmt->bind_param("ssi", $status, $eventId, $id); // "ssi" indicates the types: string, string, integer

            if ($stmt->execute()) {
                echo "success"; // Indicate the update was successful
            } else {
                echo "error"; // Indicate there was an error with the update
            }

            $stmt->close();
            break;

        case "admin_reject":
            $id = $_POST['session_id']; // Session ID of the admin
            $eventId = $_POST['event_id']; // Event ID passed from AJAX

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("UPDATE stakeholder_tbl SET status=?, date_approved=NOW() WHERE event_id=? AND admin_id=?");
            $status = 'rejected'; // Set status to 'rejected'
            $stmt->bind_param("ssi", $status, $eventId, $id); // "ssi" indicates the types: string, string, integer

            if ($stmt->execute()) {
                echo "success"; // Indicate the update was successful
            } else {
                echo "error"; // Indicate there was an error with the update
            }

            $stmt->close();
            break;
        case "launch":
            $eventId = $_POST['event_id']; // Event ID passed from AJAX

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("UPDATE kld_event SET status=? WHERE event_id=?");
            $status = 'upcoming'; // Set status to 'approved'
            $stmt->bind_param("si", $status, $eventId); // "ssi" indicates the types: string, string, integer

            if ($stmt->execute()) {
                echo "success"; // Indicate the update was successful
            } else {
                echo "error"; // Indicate there was an error with the update
            }

            $stmt->close();
            break;
        case "cancel":
            $eventId = $_POST['event_id']; // Event ID passed from AJAX

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("UPDATE kld_event SET status=? WHERE event_id=?");
            $status = 'cancelled'; // Set status to 'approved'
            $stmt->bind_param("si", $status, $eventId); // "ssi" indicates the types: string, string, integer

            if ($stmt->execute()) {
                echo "success"; // Indicate the update was successful
            } else {
                echo "error"; // Indicate there was an error with the update
            }

            $stmt->close();
            break;
        case "complete":
            $eventId = $_POST['event_id']; // Event ID passed from AJAX

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("UPDATE kld_event SET status=? WHERE event_id=?");
            $status = 'completed'; // Set status to 'approved'
            $stmt->bind_param("si", $status, $eventId); // "ssi" indicates the types: string, string, integer

            if ($stmt->execute()) {
                echo "success"; // Indicate the update was successful
            } else {
                echo "error"; // Indicate there was an error with the update
            }

            $stmt->close();
            break;
        case "archived":
            $eventId = $_POST['event_id']; // Event ID passed from AJAX

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("UPDATE kld_event SET status=? WHERE event_id=?");
            $status = 'archived'; // Set status to 'approved'
            $stmt->bind_param("si", $status, $eventId); // "ssi" indicates the types: string, string, integer

            if ($stmt->execute()) {
                echo "success"; // Indicate the update was successful
            } else {
                echo "error"; // Indicate there was an error with the update
            }

            $stmt->close();
            break;
        case "std_attended":
            // Get the necessary parameters from POST data
            $eventId = $_POST['event_id']; // Event ID passed from AJAX
            $stdId = $_POST['std_id'];     // Student ID passed from AJAX
            $status = $_POST['status'];    // Status (attended or absent)

            if ($status == 'attended') {
                // Mark the student as attended (Insert or update)
                $stmt = $conn->prepare("INSERT INTO attendance_tbl (event_id, std_id, status) 
                                            VALUES (?, ?, ?) 
                                            ON DUPLICATE KEY UPDATE status = ?");
                // Binding parameters (i: integer, s: string)
                $stmt->bind_param("iiss", $eventId, $stdId, $status, $status);

                if ($stmt->execute()) {
                    echo "success"; // Success message if the query executed successfully
                } else {
                    echo "error"; // Error message if the query failed
                }
                $stmt->close();
            } else if ($status == 'absent') {
                // Delete the attendance record for "attended" students (Mark as absent)
                $stmt = $conn->prepare("DELETE FROM attendance_tbl WHERE event_id = ? AND std_id = ? AND status = 'attended'");
                $stmt->bind_param("ii", $eventId, $stdId);

                if ($stmt->execute()) {
                    echo "success"; // Success message if the query executed successfully
                } else {
                    echo "error"; // Error message if the query failed
                }

                $stmt->close();
            }
            break;
        case "emp_attended":
            // Get the necessary parameters from POST data
            $eventId = $_POST['event_id']; // Event ID passed from AJAX
            $empId = $_POST['emp_id'];     // Student ID passed from AJAX
            $status = $_POST['status'];    // Status (attended or absent)

            if ($status == 'attended') {
                // Mark the student as attended (Insert or update)
                $stmt = $conn->prepare("INSERT INTO attendance_tbl (event_id, emp_id, status) 
                                                VALUES (?, ?, ?) 
                                                ON DUPLICATE KEY UPDATE status = ?");
                // Binding parameters (i: integer, s: string)
                $stmt->bind_param("iiss", $eventId, $empId, $status, $status);

                if ($stmt->execute()) {
                    echo "success"; // Success message if the query executed successfully
                } else {
                    echo "error"; // Error message if the query failed
                }
                $stmt->close();
            } else if ($status == 'absent') {
                // Delete the attendance record for "attended" students (Mark as absent)
                $stmt = $conn->prepare("DELETE FROM attendance_tbl WHERE event_id = ? AND emp_id = ? AND status = 'attended'");
                $stmt->bind_param("ii", $eventId, $empId);

                if ($stmt->execute()) {
                    echo "success"; // Success message if the query executed successfully
                } else {
                    echo "error"; // Error message if the query failed
                }

                $stmt->close();
            }
            break;
        case "update-attendance-status":
            $eventId = $_POST['event_id'];
            $stdIds = $_POST['std_ids'];  // Array of student IDs
            $status = $_POST['status'];

            foreach ($stdIds as $stdId) {
                if ($status == 'attended') {
                    // Insert or update attendance status
                    $stmt = $conn->prepare("INSERT INTO attendance_tbl (event_id, std_id, status)
                                                VALUES (?, ?, ?)
                                                ON DUPLICATE KEY UPDATE status = ?");
                    $stmt->bind_param("iiss", $eventId, $stdId, $status, $status);
                } else {
                    // Delete attendance record for absent status
                    $stmt = $conn->prepare("DELETE FROM attendance_tbl WHERE event_id = ? AND std_id = ? AND status = 'attended'");
                    $stmt->bind_param("ii", $eventId, $stdId);
                }

                if (!$stmt->execute()) {
                    echo "error";
                    exit;
                }
            }

            echo "success";
            break;
        case "update-attendance-status-emp":
            $eventId = $_POST['event_id'];
            $empIds = $_POST['emp_ids'];  // Array of student IDs
            $status = $_POST['status'];

            foreach ($empIds as $empIds) {
                if ($status == 'attended') {
                    // Insert or update attendance status
                    $stmt = $conn->prepare("INSERT INTO attendance_tbl (event_id, emp_id, status)
                                                    VALUES (?, ?, ?)
                                                    ON DUPLICATE KEY UPDATE status = ?");
                    $stmt->bind_param("iiss", $eventId, $empIds, $status, $status);
                } else {
                    // Delete attendance record for absent status
                    $stmt = $conn->prepare("DELETE FROM attendance_tbl WHERE event_id = ? AND emp_id = ? AND status = 'attended'");
                    $stmt->bind_param("ii", $eventId, $empIds);
                }

                if (!$stmt->execute()) {
                    echo "error";
                    exit;
                }
            }

            echo "success";
            break;



        case "std_register":
            $eventId = $_POST['event_id']; // Event ID passed from AJAX
            $std_id = $_POST['std_id'];

            // Use prepared statements to prevent SQL injection for inserting into registration_tbl
            $stmt = $conn->prepare("INSERT INTO registration_tbl (event_id, std_id, status) VALUES (?, ?, ?)");
            $status_registered = 'registered'; // Status for registration
            $stmt->bind_param("iis", $eventId, $std_id, $status_registered); // "iis" indicates integer, integer, string

            if ($stmt->execute()) {
                echo "success"; // Indicate the insert was successful
            } else {
                echo "error"; // Indicate there was an error with the insert
            }

            $stmt->close();
            break;
        case "emp_register":
            $eventId = $_POST['event_id']; // Event ID passed from AJAX
            $emp_id = $_POST['emp_id'];

            // Use prepared statements to prevent SQL injection for inserting into registration_tbl
            $stmt = $conn->prepare("INSERT INTO registration_tbl (event_id, emp_id, status) VALUES (?, ?, ?)");
            $status_registered = 'registered'; // Status for registration
            $stmt->bind_param("iis", $eventId, $emp_id, $status_registered); // "iis" indicates integer, integer, string

            if ($stmt->execute()) {
                echo "success"; // Indicate the insert was successful
            } else {
                echo "error"; // Indicate there was an error with the insert
            }

            $stmt->close();
            break;

        case "add_comment":
            $comment = mysqli_real_escape_string($conn, $_POST['comment']);
            $event_id = intval($_POST['event_id']);
            $session_id = intval($_POST['session_id']);

            // Insert the comment into the comment_tbl
            $query = "INSERT INTO comment_tbl (event_id, admin_id, comment, comment_date) VALUES ('$event_id', '$session_id', '$comment', NOW())";

            if (mysqli_query($conn, $query)) {
                echo "success"; // Echo success message
            } else {
                // Instead of returning a JSON error message, echo a simple error message
                echo "error"; // Echo error message
            }
            break;


        case "venue_name":
            ob_start(); // Start output buffering to prevent unwanted output

            if (array_key_exists('ajax', $_POST)) {
                switch ($_POST['ajax']) {
                    case "venue_name":
                        if (isset($_POST['venue_id'])) {
                            $venue_id = $_POST['venue_id'];
                            $result = mysqli_query($conn, "SELECT event_start_date FROM kld_event WHERE venue_id = '$venue_id'");

                            $dates = [];
                            while ($row = mysqli_fetch_assoc($result)) {
                                $dates[] = date('m/d/Y', strtotime($row['event_start_date']));  // Format date as MM/DD/YYYY
                            }

                            ob_clean(); // Clean buffer before outputting JSON
                            echo json_encode($dates);  // Send JSON-encoded array
                        }
                        break;
                }
            }

            ob_end_flush(); // End buffering and send the output
            break;



        case "add_event_check_sections":
            $selectedPrograms = explode(",", base64_decode($_POST['selectedPrograms']));
            $selectedYearLevels = explode(",", base64_decode($_POST['selectedYearLevels']));
            $query = "Select * from section_tbl where course_id in (" . implode(",", $selectedPrograms) . ")";
            $query .= " and yearlvl in (" . implode(",", $selectedYearLevels) . ")";

            $try = mysqli_query($conn, $query);
            while ($row = $try->fetch_array()) {
                $result = '<option value="' . $row['section_id'] . '">' . $row['section_name'] . '</option>';
                echo $result;
            }
            if ($try) {
                echo 1;
            } else {
                echo 2;
            }
            break;
        case "attendance_check_sections":
            $selectedPrograms = explode(",", base64_decode($_POST['selectedPrograms']));
            $selectedYearLevels = explode(",", base64_decode($_POST['selectedYearLevels']));

            $selectedPrograms = array_map('intval', $selectedPrograms);
            $selectedYearLevels = array_map('intval', $selectedYearLevels);

            $query = "SELECT * FROM section_tbl WHERE course_id IN (" . implode(",", $selectedPrograms) . ")";
            $query .= " AND yearlvl IN (" . implode(",", $selectedYearLevels) . ")";

            $try = mysqli_query($conn, $query);
            $sections = [];

            if ($try && mysqli_num_rows($try) > 0) {
                while ($row = $try->fetch_array()) {
                    $sections[] = [
                        'section_id' => htmlspecialchars($row['section_id'], ENT_QUOTES, 'UTF-8'),
                        'section_name' => htmlspecialchars($row['section_name'], ENT_QUOTES, 'UTF-8')
                    ];
                }
            }

            echo json_encode(['status' => $try ? 1 : 2, 'sections' => $sections]);
            break;

        case "std_check_sections":
            $kt_datatable_program = explode(",", base64_decode($_POST['kt_datatable_program']));
            $kt_datatable_yearlvl = explode(",", base64_decode($_POST['kt_datatable_yearlvl']));
            $query = "Select * from section_tbl where course_id in (" . implode(",", $kt_datatable_program) . ")";
            $query .= " and yearlvl in (" . implode(",", $kt_datatable_yearlvl) . ")";

            $try = mysqli_query($conn, $query);
            while ($row = $try->fetch_array()) {
                $result = '<option value="' . $row['section_id'] . '">' . $row['section_name'] . '</option>';
                echo $result;
            }
            if ($try) {
                echo 1;
            } else {
                echo 2;
            }
            break;
        case "std_reg_check_sections":
            $kt_datatable_program = explode(",", base64_decode($_POST['kt_datatable_program']));
            $kt_datatable_yearlvl = explode(",", base64_decode($_POST['kt_datatable_yearlvl']));
            $query = "Select * from section_tbl where course_id in (" . implode(",", $kt_datatable_program) . ")";
            $query .= " and yearlvl in (" . implode(",", $kt_datatable_yearlvl) . ")";

            $try = mysqli_query($conn, $query);
            while ($row = $try->fetch_array()) {
                $result = '<option value="' . $row['section_id'] . '">' . $row['section_name'] . '</option>';
                echo $result;
            }
            if ($try) {
                echo 1;
            } else {
                echo 2;
            }

            break;
        case "std_att_check_sections":
            $kt_datatable_program_att = explode(",", base64_decode($_POST['kt_datatable_program_att']));
            $kt_datatable_yearlvl_att = explode(",", base64_decode($_POST['kt_datatable_yearlvl_att']));
            $query = "Select * from section_tbl where course_id in (" . implode(",", $kt_datatable_program_att) . ")";
            $query .= " and yearlvl in (" . implode(",", $kt_datatable_yearlvl_att) . ")";

            $try = mysqli_query($conn, $query);
            while ($row = $try->fetch_array()) {
                $result = '<option value="' . $row['section_id'] . '">' . $row['section_name'] . '</option>';
                echo $result;
            }
            if ($try) {
                echo 1;
            } else {
                echo 2;
            }

            break;
        case "view_registered":

            // Query to fetch the data
            $query = "SELECT sa.*, 
                        course_tbl.course_acronym, 
                        section_tbl.section_name, 
                        yearlvl_tbl.yearlvl_name,
                        at.status, 
                        at.attendance_date 
                    FROM std_acc sa
                    JOIN event_invitation ei 
                        ON (sa.course_id = ei.course_id OR ei.course_id IS NULL)
                        AND (sa.yearlvl = ei.yearlvl_id OR ei.yearlvl_id IS NULL)
                        AND (sa.section_id = ei.section_id OR ei.section_id IS NULL)
                    JOIN course_tbl ON sa.course_id = course_tbl.course_id
                    JOIN section_tbl ON sa.section_id = section_tbl.section_id
                    JOIN yearlvl_tbl ON sa.yearlvl = yearlvl_tbl.yearlvl_id
                    LEFT JOIN attendance_tbl at ON sa.std_id = at.std_id AND at.event_id = $eventId
                    WHERE ei.event_id = $eventId"; // Adjust query as needed
            $result = mysqli_query($conn, $query);

            $data = [];
            if ($result) {
                // Fetch all data from the query result
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            }

            // Return the data in JSON format
            echo json_encode(['data' => $data]);
            break;

        case "add_org":
            $org_name = $_POST['org_name'];
            $add_org_description = $_POST['add_org_description'];
            $org_pic = $_POST['org_pic']; // Adding the category icon

            $try = mysqli_query(
                $conn,
                "INSERT INTO org_tbl
                            (
                                org_name,
                                org_desc,
                                org_pic
                            )
                            VALUES
                            (
                                '" . $org_name . "',
                                '" . $add_org_description . "',
                                '" . $org_pic . "'
                            )"
            );

            if ($try) {
                echo "success";
            } else {
                echo "error";
            }
            break;
        case "edit_org":
            // Escape the inputs to handle special characters like single quotes
            $edit_org_name = mysqli_real_escape_string($conn, $_POST['edit_org_name']);
            $edit_org_description = mysqli_real_escape_string($conn, $_POST['edit_org_description']);
            $org_pic = mysqli_real_escape_string($conn, $_POST['org_pic']);
            $org_id = mysqli_real_escape_string($conn, $_POST['org_id']);

            $try = mysqli_query(
                $conn,
                "UPDATE org_tbl
                         SET
                             org_name = '$edit_org_name',
                             org_desc = '$edit_org_description',
                             org_pic = '$org_pic'
                         WHERE org_id = '$org_id'"
            );

            if ($try) {
                echo 1;
            } else {
                echo 2;
            }
            break;
        case "add_cat":
            $add_cat_category = $_POST['add_cat_category'];
            $add_cat_description = $_POST['add_cat_description'];
            $add_cat_icon = $_POST['add_cat_icon']; // Adding the category icon

            $try = mysqli_query(
                $conn,
                "INSERT INTO category_tbl
                        (
                            category_name,
                            category_desc,
                            category_icon
                        )
                        VALUES
                        (
                            '" . $add_cat_category . "',
                            '" . $add_cat_description . "',
                            '" . $add_cat_icon . "'
                        )"
            );

            if ($try) {
                echo "success";
            } else {
                echo "error";
            }
            break;
        case "edit_cat":
            // Escape the inputs to handle special characters like single quotes
            $edit_cat_category = mysqli_real_escape_string($conn, $_POST['edit_cat_category']);
            $edit_cat_description = mysqli_real_escape_string($conn, $_POST['edit_cat_description']);
            $edit_cat_icon = mysqli_real_escape_string($conn, $_POST['edit_cat_icon']);
            $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

            $try = mysqli_query(
                $conn,
                "UPDATE category_tbl
                     SET
                         category_name = '$edit_cat_category',
                         category_desc = '$edit_cat_description',
                         category_icon = '$edit_cat_icon'
                     WHERE category_id = '$category_id'"
            );

            if ($try) {
                echo 1;
            } else {
                echo 2;
            }
            break;

        case "add_course":
            $add_course_name = mysqli_real_escape_string($conn, $_POST['add_course_name']);
            $add_course_description = mysqli_real_escape_string($conn, $_POST['add_course_description']);
            $add_course_acronym = mysqli_real_escape_string($conn, $_POST['add_course_acronym']); // Adding the category icon

            $try = mysqli_query(
                $conn,
                "INSERT INTO course_tbl
                            (
                                course_name,
                                course_desc,
                                course_acronym
                            )
                            VALUES
                            (
                                '$add_course_name',
                                '$add_course_description',
                                '$add_course_acronym'
                            )"
            );

            if ($try) {
                echo 1;
            } else {
                echo 2;
            }
            break;

        case "edit_course":
            // Escape the inputs to handle special characters like single quotes
            $edit_course_name = mysqli_real_escape_string($conn, $_POST['edit_course_name']);
            $edit_course_description = mysqli_real_escape_string($conn, $_POST['edit_course_description']);
            $edit_course_acronym = mysqli_real_escape_string($conn, $_POST['edit_course_acronym']);
            $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);

            $try = mysqli_query(
                $conn,
                "UPDATE course_tbl
                         SET
                             course_name = '$edit_course_name',
                             course_desc = '$edit_course_description',
                             course_acronym = '$edit_course_acronym'
                         WHERE course_id = '$course_id'"
            );

            if ($try) {
                echo 1;
            } else {
                echo 2;
            }
            break;
        case "add_section":
            $add_section_name = mysqli_real_escape_string($conn, $_POST['add_section_name']);
            $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);
            $yearlvl = mysqli_real_escape_string($conn, $_POST['yearlvl']); // Adding the category icon

            $try = mysqli_query(
                $conn,
                "INSERT INTO section_tbl
                                (
                                    section_name,
                                    course_id,
                                    yearlvl
                                )
                                VALUES
                                (
                                    '$add_section_name',
                                    '$course_id',
                                    '$yearlvl'
                                )"
            );

            if ($try) {
                echo 1;
            } else {
                echo 2;
            }
            break;

        case "edit_section":
            // Escape the inputs to handle special characters like single quotes
            $edit_section_name = mysqli_real_escape_string($conn, $_POST['edit_section_name']);
            $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);
            $yearlvl = mysqli_real_escape_string($conn, $_POST['yearlvl']); // Adding the category icon
            $section_id = mysqli_real_escape_string($conn, $_POST['section_id']);

            $try = mysqli_query(
                $conn,
                "UPDATE section_tbl
                             SET
                                 section_name = '$edit_section_name',
                                 section_desc = '$course_id',
                                 section_acronym = '$yearlvl'
                             WHERE section_id = '$section_id'"
            );

            if ($try) {
                echo 1;
            } else {
                echo 2;
            }
            break;

        case "add_venue":
            $add_venue = $_POST['add_venue'];
            $add_venue_description = $_POST['add_venue_description'];
            $add_venue_img = $_POST['add_venue_img']; // Adding the category icon

            $try = mysqli_query(
                $conn,
                "INSERT INTO venue_tbl
                        (
                            venue_name,
                            venue_desc,
                            venue_img
                        )
                        VALUES
                        (
                            '" . $add_venue . "',
                            '" . $add_venue_description . "',
                            '" . $add_venue_img . "'
                        )"
            );

            if ($try) {
                echo "success";
            } else {
                echo "error";
            }
            break;
        case "edit_venue":
            // Escape the inputs to handle special characters like single quotes
            $edit_venue = mysqli_real_escape_string($conn, $_POST['edit_venue']);
            $edit_venue_description = mysqli_real_escape_string($conn, $_POST['edit_venue_description']);
            $venue_img = mysqli_real_escape_string($conn, $_POST['venue_img']);
            $venue_id = mysqli_real_escape_string($conn, $_POST['venue_id']);

            $try = mysqli_query(
                $conn,
                "UPDATE venue_tbl
                         SET
                             venue_name = '$edit_venue',
                             venue_desc = '$edit_venue_description',
                             venue_img = '$venue_img'
                         WHERE venue_id = '$venue_id'"
            );

            if ($try) {
                echo 1;
            } else {
                echo 2;
            }
            break;
            /* case "calendar_init":
            $try = mysqli_query(
                $conn,
                "Select * from kld_event
            "
            );
            $json = [];
            while ($row = $try->fetch_array()) {
                $temp_obj = new stdClass();
                $temp_obj->title = $row['event_title'];
                $temp_obj->start = $row['event_start_date'];
                $temp_obj->end = $row['event_end_date'];
                $temp_obj->description = $row['event_desc'];
                $temp_obj->className = $row['event_start_date'] == $row['event_end_date'] ? "fc-event-primary" : "fc-event-solid-info";

                array_push($json, $temp_obj);
            }

            echo json_encode($json);
            break; */
        case "venue_calendar":
            if (isset($_POST['venue_id'])) {
                $venue_id = mysqli_real_escape_string($conn, $_POST['venue_id']);

                $try = mysqli_query($conn, "SELECT * FROM kld_event WHERE venue_id = '$venue_id'");

                if (!$try) {
                    echo json_encode(["error" => "Failed to fetch events"]);
                    exit;
                }

                $json = [];

                // Array of possible event color classes
                $color_classes = [
                    "fc-event-solid-primary",
                    "fc-event-solid-info",
                    "fc-event-solid-success",
                    "fc-event-solid-warning",
                    "fc-event-solid-danger",
                    "fc-event-light",
                    "fc-event-solid-dark"
                ];

                while ($row = $try->fetch_array()) {
                    $temp_obj = new stdClass();
                    $temp_obj->title = $row['event_title'];
                    $temp_obj->start = $row['event_start_date'];
                    $temp_obj->end = $row['event_end_date'];
                    $temp_obj->description = $row['event_desc'];

                    // Randomly select a class from the array
                    $random_class = $color_classes[array_rand($color_classes)];

                    $temp_obj->className = $random_class;  // Assign the random class

                    array_push($json, $temp_obj);
                }

                echo json_encode($json);
            } else {
                echo json_encode(["error" => "Venue ID not provided"]);
            }
            break;


        case "add_cat2":
            $try = mysqli_query(
                $conn,
                "Select * from kld_event
            "
            );
            $json = [];
            while ($row = $try->fetch_array()) {
                $temp_obj = new stdClass();
                $temp_obj->title = $row['event_title'];
                $temp_obj->start = $row['event_start_date'];
                $temp_obj->end = $row['event_end_date'];
                $temp_obj->description = $row['event_desc'];
                $temp_obj->className = $row['event_start_date'] == $row['event_end_date'] ? "fc-event-primary" : "fc-event-solid-info";

                array_push($json, $temp_obj);
            }

            echo json_encode($json);
            break;

        case "hide_org":


            $org_acc_id = $_POST['org_acc_id'];
            $try = mysqli_query(
                $conn,
                "Update org_acc set status = 'INACTIVE' where org_acc_id = '" . $org_acc_id . "'
            "
            );
            if ($try) {
                echo 1;
            } else {
                echo 2;
            }

            break;




        case "registered-std":

            $eventId = $_POST['event_id'];
            $sql = "SELECT DISTINCT sa.*, 
										course_tbl.course_acronym, 
										section_tbl.section_name, 
										yearlvl_tbl.yearlvl_name,
										rt.status AS reg_status, 
										rt.reg_date AS reg_date 
									FROM std_acc sa
									JOIN event_invitation ei 
										ON (sa.course_id = ei.course_id OR ei.course_id IS NULL)
										AND (sa.yearlvl = ei.yearlvl_id OR ei.yearlvl_id IS NULL)
										AND (sa.section_id = ei.section_id OR ei.section_id IS NULL)
									JOIN course_tbl ON sa.course_id = course_tbl.course_id
									JOIN section_tbl ON sa.section_id = section_tbl.section_id
									JOIN yearlvl_tbl ON sa.yearlvl = yearlvl_tbl.yearlvl_id
									LEFT JOIN registration_tbl rt ON sa.std_id = rt.std_id AND rt.event_id = $eventId
									WHERE ei.event_id = $eventId";
            $result = $conn->query($sql);

            $data = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }

            echo json_encode($data);
            $conn->close();

            break;

        case "attendance-std":

            $eventId = $_POST['event_id'];
            $sql = "SELECT DISTINCT sa.std_id, sa.std_fname, sa.std_lname, sa.std_kld_id, sa.yearlvl, sa.section_id, sa.course_id, sa.std_profilepic,
									course_tbl.course_acronym, 
									section_tbl.section_name, 
									yearlvl_tbl.yearlvl_name,
									at.status, 
									at.attendance_date 
								FROM std_acc sa
								JOIN event_invitation ei 
									ON (sa.course_id = ei.course_id OR ei.course_id IS NULL)
									AND (sa.yearlvl = ei.yearlvl_id OR ei.yearlvl_id IS NULL)
									AND (sa.section_id = ei.section_id OR ei.section_id IS NULL)
								JOIN course_tbl ON sa.course_id = course_tbl.course_id
								JOIN section_tbl ON sa.section_id = section_tbl.section_id
								JOIN yearlvl_tbl ON sa.yearlvl = yearlvl_tbl.yearlvl_id
								LEFT JOIN attendance_tbl at ON sa.std_id = at.std_id AND at.event_id = $eventId
								WHERE ei.event_id = $eventId";
            $result = $conn->query($sql);

            $data = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }

            echo json_encode($data);
            $conn->close();

            break;
        case "attendance-emp":

            $eventId = $_POST['event_id'];
            $sql = "SELECT DISTINCT ea.emp_id, ea.emp_fname, ea.emp_lname, ea.emp_kld_id, ea.emp_role, ea.emp_profilepic, ea.org_id,
                                        org_tbl.org_name, 
                                        at.status, 
                                        at.attendance_date 
                                    FROM emp_acc ea
                                    JOIN event_invitation ei 
                                            ON (ea.org_id = ei.org_id OR ei.org_id IS NULL)
                                    JOIN org_tbl ON ea.org_id = org_tbl.org_id
                                    LEFT JOIN attendance_tbl at ON ea.emp_id = at.emp_id AND at.event_id = $eventId
                                    WHERE ei.event_id = $eventId";
            $result = $conn->query($sql);

            $data = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }

            echo json_encode($data);
            $conn->close();

            break;
        case "registered-emp":

            $eventId = $_POST['event_id'];
            $sql = "SELECT DISTINCT ea.*, 
                                            org_tbl.org_name, 
                                            rt.status AS reg_status, 
                                            rt.reg_date AS reg_date 
                                        FROM emp_acc ea
                                        JOIN event_invitation ei 
                                            ON (ea.org_id = ei.org_id OR ei.org_id IS NULL)
                                        JOIN org_tbl ON ea.org_id = org_tbl.org_id
                                        LEFT JOIN registration_tbl rt ON ea.emp_id = rt.emp_id AND rt.event_id = $eventId
                                        WHERE ei.event_id = $eventId";
            $result = $conn->query($sql);

            $data = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }

            echo json_encode($data);
            $conn->close();

            break;




        case "std-fetch":

            $sql = "SELECT 
									std_acc.*, 
									course_tbl.*, 
									section_tbl.*, 
									yearlvl_tbl.* 
								FROM 
									std_acc 
								JOIN 
									course_tbl ON std_acc.course_id = course_tbl.course_id 
								JOIN 
									section_tbl ON std_acc.section_id = section_tbl.section_id 
								JOIN 
									yearlvl_tbl ON std_acc.yearlvl = yearlvl_tbl.yearlvl_id";
            $result = $conn->query($sql);

            $data = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }

            echo json_encode($data);
            $conn->close();

            break;
        case "emp-fetch":

            $sql = "SELECT 
                            emp_acc.*, 
                            org_tbl.*
                        FROM 
                            emp_acc 
                        JOIN 
                            org_tbl ON emp_acc.org_id = org_tbl.org_id ";
            $result = $conn->query($sql);

            $data = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }

            echo json_encode($data);
            $conn->close();

            break;

        case "add_guide":
            $guide_title = $_POST['guide_title'];
            $guide_desc = $_POST['guide_desc'];
            $guide_image = $_POST['guide_image']; // Adding the category icon
            $event_id = $_POST['event_id'];

            $try = mysqli_query(
                $conn,
                "INSERT INTO guide_tbl
                        (
                            event_id,
                            guide_title,
                            guide_desc,
                            guide_image
                        )
                        VALUES
                        (
                            '" . $event_id . "',
                            '" . $guide_title . "',
                            '" . $guide_desc . "',
                            '" . $guide_image . "'
                        )"
            );

            if ($try) {
                echo "success";
            } else {
                echo "error";
            }


            break;

        case "delete_guide":
            $guide_id = $_POST['guide_id'];
            $event_id = $_POST['event_id'];

            // Delete the guide from the database
            $delete_query = "DELETE FROM guide_tbl WHERE guide_id = '$guide_id' AND event_id = '$event_id'";

            $try = mysqli_query($conn, $delete_query);

            if ($try) {
                echo "success";  // Successfully deleted
            } else {
                echo "error";  // Error occurred
            }

            break;
        case "add_agenda":
            $agenda_desc = $_POST['agenda_desc'];
            $agenda_time = $_POST['agenda_time']; // Adding the category icon
            $event_id = $_POST['event_id'];

            $try = mysqli_query(
                $conn,
                "INSERT INTO agenda_tbl
                            (
                                event_id,
                                agenda_time,
                                agenda_desc
                            )
                            VALUES
                            (
                                '" . $event_id . "',
                                '" . $agenda_time . "',
                                '" . $agenda_desc . "'
                            )"
            );

            if ($try) {
                echo "success";
            } else {
                echo "error";
            }


            break;
        case "add_link":
            $link_name = $_POST['link_name'];
            $link_url = $_POST['link_url']; // Adding the category icon
            $event_id = $_POST['event_id'];

            $try = mysqli_query(
                $conn,
                "INSERT INTO link_tbl
                                (
                                    event_id,
                                    link_name,
                                    link_url
                                )
                                VALUES
                                (
                                    '" . $event_id . "',
                                    '" . $link_name . "',
                                    '" . $link_url . "'
                                )"
            );

            if ($try) {
                echo "success";
            } else {
                echo "error";
            }


            break;
        case "add_file":
            // Check if a file is uploaded
            if (isset($_FILES['file'])) {
                $file = $_FILES['file'];
                $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

                // Validate file type
                if (!in_array($file['type'], $allowedTypes)) {
                    echo "Invalid file type.";
                    exit;
                }

                // Get the original file name
                $originalFileName = $file['name'];
                $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

                // Generate a unique file name if needed, or just keep the original one
                // Optional: To avoid overwriting files with the same name, you can prefix or suffix the original file name with a unique identifier
                $newFileName = uniqid('file_', true) . '.' . $fileExtension;

                $uploadDir = 'assets/file-upload/';
                $uploadFilePath = $uploadDir . $newFileName;

                // Ensure the upload directory exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
                }

                // Move the uploaded file to the target directory
                if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
                    $event_id = $_POST['event_id']; // Get event ID from POST data

                    // Insert the original file name and file path into the database
                    $sql = "INSERT INTO file_tbl (event_id, file_name, file_path) VALUES ('$event_id', '$originalFileName', '$uploadFilePath')";
                    if (mysqli_query($conn, $sql)) {
                        echo "success";
                    } else {
                        echo "Database error: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "No file uploaded.";
            }
            break;

        case "submit_feedback_std":
            $event_id = $_POST['event_id'];
            $std_id = $_POST['std_id'];
            $responses = json_decode($_POST['responses'], true); // Decode JSON string

            // Prepare the statement to insert into response_tbl
            $query = "INSERT INTO response_tbl (question_id, event_id, std_id, response) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                foreach ($responses as $response) {
                    $question_id = $response['question_id'];
                    $answer = $response['response'];
                    $stmt->bind_param("iiis", $question_id, $event_id, $std_id, $answer);
                    $stmt->execute();
                }
                $stmt->close();

                // Insert into feedback_tbl with status 'evaluated'
                $feedbackQuery = "INSERT INTO feedback_tbl (event_id, std_id, status) VALUES (?, ?, 'evaluated')";
                $feedbackStmt = $conn->prepare($feedbackQuery);

                if ($feedbackStmt) {
                    $feedbackStmt->bind_param("ii", $event_id, $std_id);
                    $feedbackStmt->execute();
                    $feedbackStmt->close();

                    echo "success";
                } else {
                    echo "error in feedback_tbl insertion";
                }
            } else {
                echo "error in response_tbl insertion";
            }

            break;

        case "submit_feedback_emp":
            $event_id = $_POST['event_id'];
            $emp_id = $_POST['emp_id'];
            $responses = json_decode($_POST['responses'], true); // Decode JSON string

            // Prepare the statement to insert into response_tbl
            $query = "INSERT INTO response_tbl (question_id, event_id, emp_id, response) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                foreach ($responses as $response) {
                    $question_id = $response['question_id'];
                    $answer = $response['response'];
                    $stmt->bind_param("iiis", $question_id, $event_id, $emp_id, $answer);
                    $stmt->execute();
                }
                $stmt->close();

                // Insert into feedback_tbl with status 'evaluated'
                $feedbackQuery = "INSERT INTO feedback_tbl (event_id, emp_id, status) VALUES (?, ?, 'evaluated')";
                $feedbackStmt = $conn->prepare($feedbackQuery);

                if ($feedbackStmt) {
                    $feedbackStmt->bind_param("ii", $event_id, $emp_id);
                    $feedbackStmt->execute();
                    $feedbackStmt->close();

                    echo "success";
                } else {
                    echo "error in feedback_tbl insertion";
                }
            } else {
                echo "error in response_tbl insertion";
            }

            break;



        case 3:
            include('db.php');
            $name2 = $_POST['name2'];
            $addr = $_POST['addr'];
            $brgy = $_POST['brgy'];
            $city = $_POST['city'];
            $temp = $_POST['temp'];
            $sex = $_POST['sex'];
            $age = $_POST['age'];
            $dep = $_POST['dep'];
            $a1 = (trim($_POST['a1']) == "false" ? "1" : "0");
            $a2 = (trim($_POST['a2']) == "false" ? "1" : "0");
            $a3 = (trim($_POST['a3']) == "false" ? "1" : "0");
            $a4 = (trim($_POST['a4']) == "false" ? "1" : "0");
            $a5 = (trim($_POST['a5']) == "false" ? "1" : "0");
            $a6 = (trim($_POST['a6']) == "false" ? "1" : "0");
            $a7 = (trim($_POST['a7']) == "false" ? "1" : "0");
            $a8 = (trim($_POST['a8']) == "false" ? "1" : "0");
            $a  = str_replace("'", "\'", $_POST['a']);
            $b  = str_replace("'", "\'", $_POST['b']);
            $c  = str_replace("'", "\'", $_POST['c']);
            $d  = str_replace("'", "\'", $_POST['d']);
            $e  = str_replace("'", "\'", $_POST['e']);
            $f  = str_replace("'", "\'", $_POST['f']);
            $g  = str_replace("'", "\'", $_POST['g']);
            $h  = str_replace("'", "\'", $_POST['h']);
            $i  = str_replace("'", "\'", $_POST['i']);
            $j  = str_replace("'", "\'", $_POST['j']);
            $k  = str_replace("'", "\'", $_POST['k']);
            $l  = str_replace("'", "\'", $_POST['l']);
            $a9  = (trim($_POST['a9']) == "false" ? "1" : "0");
            $a10 = (trim($_POST['a10']) == "false" ? "1" : "0");
            $a11 = (trim($_POST['a11']) == "false" ? "1" : "0");
            $from = $_POST['from'];
            $to = $_POST['to'];
            $cc = $_POST['cc'];
            $agreechk = $_POST['agreechk'];
            $bloodtype = $_POST['bloodtype'];
            $adaname = $_POST['adaname'];
            $date2 = trim($_POST['date2']);
            $qa1 = trim($_POST['qa1']);
            $qb1 = trim($_POST['qb1']);
            $adaname2 = $_POST['adaname2'];

            $try = mysqli_query($conn, "Insert Into Hlogs (`name`,  street, brgy,   city,  dept,  temp, sex,  age, blood, a, b, c, d, e, r2, r3, r4, r5, r6, r7, a5, b5, c5, d5, e5, f5, g5, h5, i5, j5, k5, l5,  adaname, `date`, a1, b1, adaname2, version) values ('$name2', '$addr', '$brgy', '$city', '$dep',  '$temp', '$sex', '$age', '$bloodtype', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9', '$a10', '$a11', '$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i', '$j', '$k', '$l', '$adaname', '$date2', '$qa1', '$qb1', '$adaname2', '4.0')");

            if (!$try) {
                echo 1;
            } else {
                echo 2;
            }

            break;

        case 4:
            include('db.php');
            $name2 = $_POST['name2'];
            $addr = $_POST['addr'];
            $brgy = $_POST['brgy'];
            $city = $_POST['city'];
            $temp = $_POST['temp'];
            $sex = $_POST['sex'];
            $age = $_POST['age'];
            $dep = $_POST['dep'];
            $a1 = (trim($_POST['a1']) == "false" ? "1" : "0");
            $a2 = (trim($_POST['a2']) == "false" ? "1" : "0");
            $a3 = (trim($_POST['a3']) == "false" ? "1" : "0");
            $a4 = (trim($_POST['a4']) == "false" ? "1" : "0");
            $a5 = (trim($_POST['a5']) == "false" ? "1" : "0");
            $a6 = (trim($_POST['a6']) == "false" ? "1" : "0");
            $a7 = (trim($_POST['a7']) == "false" ? "1" : "0");
            $a8 = (trim($_POST['a8']) == "false" ? "1" : "0");
            $a  = str_replace("'", "\'", $_POST['a']);
            $b  = str_replace("'", "\'", $_POST['b']);
            $c  = str_replace("'", "\'", $_POST['c']);
            $d  = str_replace("'", "\'", $_POST['d']);
            $e  = str_replace("'", "\'", $_POST['e']);
            $f  = str_replace("'", "\'", $_POST['f']);
            $g  = str_replace("'", "\'", $_POST['g']);
            $h  = str_replace("'", "\'", $_POST['h']);
            $i  = str_replace("'", "\'", $_POST['i']);
            $j  = str_replace("'", "\'", $_POST['j']);
            $k  = str_replace("'", "\'", $_POST['k']);
            $l  = str_replace("'", "\'", $_POST['l']);
            $a9  = (trim($_POST['a9']) == "false" ? "1" : "0");
            $a10 = (trim($_POST['a10']) == "false" ? "1" : "0");
            $a11 = (trim($_POST['a11']) == "false" ? "1" : "0");
            $from = $_POST['from'];
            $to = $_POST['to'];
            $agreechk = $_POST['agreechk'];
            $bloodtype = $_POST['bloodtype'];
            $adaname = $_POST['adaname'];
            $date2 = trim($_POST['date2']);
            $qa1 = trim($_POST['qa1']);
            $qb1 = trim($_POST['qb1']);
            $adaname2 = $_POST['adaname2'];

            $try = mysqli_query($conn, "Insert Into Hlogs (`name`,  street, brgy,   city,  dept,  temp, sex,  age, blood, a, b, c, d, e, r2, r3, r4, r5, r6, r7, a5, b5, c5, d5, e5, f5, g5, h5, i5, j5, k5, l5,  adaname, `date`, a1, b1, adaname2, version) values ('$name2', '$addr', '$brgy', '$city', '$dep',  '$temp', '$sex', '$age', '$bloodtype', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9', '$a10', '$a11', '$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i', '$j', '$k', '$l', '$adaname', '$date2', '$qa1', '$qb1', '$adaname2', '4.0')");

            if (!$try) {
                echo 1;
            } else {
                echo 2;
            }

            break;
        case 5:
            $html = base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($_POST['html'])))))))) . ';';
            $names = base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($_POST['names'])))))))) . ';';
            $a = explode(';', $html);
            $b = array_keys($a);
            $c = explode(';', $names);

            date_default_timezone_set('Asia/Manila');
            $zip = new ZipArchive;
            $file = 'Health_Checklist_' . date('Y-m-d_gis') . '.zip';
            $newfile = __DIR__ . '/temp/' . $file;
            echo $newfile;

            if ($zip->open($newfile, ZipArchive::CREATE) === TRUE) {
                for ($i = 0; $i <= end($b) - 1; $i++) {
                    $zip->addFromString($a[$i], $c[$i]);
                }
                $zip->close();
                $file = ("temp/$file");
                $filetype = filetype($file);
                $filename = basename($file);
                header("Content-Type: " . $filetype);
                header("Content-Length: " . filesize($file));
                header("Content-Disposition: attachment; filename=" . $filename);
                readfile($file);
            } else {
                die("An error occurred creating your ZIP file.");
            }


            break;

        default:
    }
    //unset($_SESSION['ajax']);
}
function generateRandomString($length = 20)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+[]{}|;:,.<>?';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
