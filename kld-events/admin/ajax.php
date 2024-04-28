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
            $add_std_email = $_POST['add_std_email']. "@kld.edu.ph";
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
            $url = "https://markdenzel.lucero.cloud/kld-events/signup.php?ajax=account_activation&activation_key=".$activation_key;

            $mail->Username = 'steven.dale@lucero.cloud';
            $mail->Password = base64_decode("U3RAY3lMMWx5THVjI3Iw");
            $mail->setFrom ('noreply@lucero.cloud','KLD noreply');
            $mail->addAddress($add_std_email);
            $mail->addCC("denzdmagician@gmail.com");
            $mail->addCC("shizukura06@gmail.com");
            $mail->Subject = "Welcome to KLD Event " .$add_std_firstname;
            $msg = '
                <html>
                    <body>
                    <br><br>Good day '.$add_std_firstname.",<br><br>".
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

            if($mail->Send()){
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
                                    '".$add_std_kldnum."',
                                    '".$add_std_email."',
                                    '".$add_std_firstname."',
                                    '".$add_std_lastname."',
                                    '".$add_std_yearlvl."',
                                    '".$add_std_course."',
                                    '".$add_std_section."',
                                    'inactive',
                                    '".$add_std_profilepic."',
                                    '".$activation_key."') ";

                $try = mysqli_query($conn,"Insert into std_acc". $query_param);
                if($try) {
                    echo "success";
                }
                else {
                    echo "error";
                }

            }
            else{
                echo "failed";
            }

            break;
        case "add_std_info":
            $kld_signup_fname = $_POST['kld_signup_fname'];
            $kld_signup_lname = $_POST['kld_signup_lname'];
            $kld_username = $_POST['kld_username'];
            $kld_password = $_POST['kld_password'];
            $query_param = " set std_fname = '".$kld_signup_fname."', ";
            $query_param .= " std_lname = '".$kld_signup_lname."', ";
            $query_param .= " std_uname = '".$kld_username."', ";
            $query_param .= " std_pass = '".$kld_password."', ";
            $query_param .= " std_activation_key = '' ";
            $query_param .= " where std_activation_key = '".$_SESSION['activation_key']."' ";



            $try = mysqli_query($conn,"Update std_acc". $query_param);
            if($try) {
                echo "success";
                session_destroy();
            }
            else {
                echo "error";
            }
            break;
        case "create_account":
            $username= $_POST['username'];
            $password = base64_encode(base64_encode($_POST['password']));
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $login_type = null;
            $query_param = null;

            switch($_POST['account_type']){
                case "admin":
                    $login_type = " admin_acc ";
                    $query_param = " (admin_uname,admin_pass,admin_fname,admin_lname) ";
                    $query_param .= " values ('".$username."','".$password."','".$firstname."','".$lastname."') ";
                    break;
                case "student":
                    $login_type = "std_acc";
                    break;
                case "admin":
                    $login_type = "admin_acc";
                    break;
            }
            
            $try = mysqli_query($conn,"Insert into ".$login_type . $query_param);
            if($try) {
                echo "success";
            }
            else {
                echo "error";
            }
            break;
        case "logging_in":            
            $username= $_POST['username'];
            $password = base64_encode(base64_encode($_POST['password']));
            $login_type = $_POST['login_type'];

            switch ($login_type){
                case "admin":
                    
                    $try = mysqli_query($conn,"Select * from admin_acc where admin_uname = '".$username."' and admin_pass = '".$password."'");
                    $json = [];
                    while ($row = $try->fetch_array()){
                        echo "success"; //match yung uname at pass
                        $_SESSION['kld_username'] = $row['admin_uname'];
                        $_SESSION['login_type'] = "Administrator";
                        $_SESSION['kld_fname'] = $row['admin_fname'];
                        $_SESSION['kld_lname'] = $row['admin_lname'];
                        $_SESSION['kld_email'] = "";
                        $_SESSION['kld_login_expiration'] = true;
                        return; 
                    }
                    echo "failed";
                    break;
                case "student":
                    // wala pang laman, maya konte
                    break;
                case "org":
                    // same
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
        case "add_event":
            $venue_id = $_POST['venue_id'];
            $event_start_date = date('Y-m-d H:i:s', strtotime($_POST['event_start_date']));
            $event_end_date = date('Y-m-d H:i:s', strtotime($_POST['event_end_date']));
            $event_title = $_POST['event_title'];
            $event_description = $_POST['event_description'];
            $event_category = $_POST['event_category'];
            $event_organizer = $_POST['event_organizer'];
            $event_poster = $_POST['event_poster'];


            $try = mysqli_query(
                $conn,
                "Insert into kld_event
                       ( 
                            venue_id,
                            event_start_date,
                            event_end_date,
                            event_title,
                            category_id,
                            event_desc,
                            event_org_id,
                            event_poster
                        )
                        values
                        (
                            '".$venue_id."',
                            '".$event_start_date."',
                            '".$event_end_date."',
                            '".$event_title."',
                            '".$event_category."',
                            '".$event_description."',
                            '".$event_organizer."',
                            '".$event_poster."'
                        )
            ");
            if($try) {
                echo 1;
            }
            else {
                echo 2;
            }
            break;
        case "add_cat":
            $add_cat_category = $_POST['add_cat_category'];
            $add_cat_description = $_POST['add_cat_description'];


            $try = mysqli_query(
                $conn,
                "Insert into category_tbl
                       ( 
                            category_name,
                            category_desc
                        )
                        values
                        (
                            '".$add_cat_category."',
                            '".$add_cat_description."'
                        )
            ");
            if($try) {
                echo 1;
            }
            else {
                echo 2;
            }
            break;
        case "add_venue":
            $add_venue = $_POST['add_venue'];
            $add_venue_description = $_POST['add_venue_description'];


            $try = mysqli_query(
                $conn,
                "Insert into venue_tbl
                       ( 
                            venue_name,
                            venue_desc
                        )
                        values
                        (
                            '".$add_venue."',
                            '".$add_venue_description."'
                        )
            ");
            if($try) {
                echo 1;
            }
            else {
                echo 2;
            }
            break;
        case "calendar_init":
            $try = mysqli_query(
                $conn,
                "Select * from kld_event
            ");
            $json = [];
            while ($row = $try->fetch_array()){
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

        case "add_cat2":

            $html = base64_decode(base64_decode(base64_decode(base64_decode($_POST['html']))));
            $html = file_get_contents($html);
            $from = $_POST['from'];
            $to = $_POST['to'];
            $d1 = base64_decode($_POST['d1']);
            $d2 = base64_decode($_POST['d2']);
            $appr = $_POST['approval'];
            $cc = base64_decode($_POST['cc']);
            $name = base64_decode($_POST['name']);


            require './mail/src/Exception.php';
            require './mail/src/SMTP.php';
            require './mail/src/PHPMailer.php';

            $mail = new PHPMailer();
            //$mail->SMTPDebug = 4;
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->IsHTML(true);
            $mail->Host = 'smtp.gmail.com';
            //$mail->Host = 'mail.philcopy.net';
            $mail->Port = 587;
            $mail->SMTPSecure = "TLS";

            //$mail->Username = 'noreply@philcopy.net';
            //$mail->Password = 'noreply33philcopy';
            $mail->Username = 'philchecklist@gmail.com';
            $mail->Password = 'newphhealth20!';
            //$mail->addReplyTo($from,'Reply: Philcopy Gatepass');
            $mail->setFrom ('philchecklist@gmail.com','noreply');
            //$mail->setFrom ('noreply@philcopy.net','noreply');
            $mail->addAddress  ($to);
            //if(trim($cc) != ''){
            //    $cc = $cc . ';';
            //    $cc2 = explode(';',$cc);
            //    $cc3 = array_keys($cc2);
            //    $cc4= end($cc3);
            //    for ($i = 0; $i <= $cc4 - 1; $i++) {
            //        $mail->addCC($cc2[$i]);
            //    }
            /*

            */
            //}
            $mail->Subject = 'Reply for Philcopy Health Checklist to ' . utf8_encode($name);
            $msg =     "
                <html><body>Good day,<br><br>The attached file is the response to your Philcopy Health Checklist. <br>Thank you for your cooperation.
                <br></body></html>";
            //$mail->Body    = '';
            $mail->Body    = $msg;
            $mail->addStringAttachment($html, 'GATE PASS.pdf', "base64", "application/pdf");

            if($mail->Send()){

                echo $appr == '1' ? 'Approval Sent!' :  'Disapproval Sent!';
                //save_mail($mail);
                if(trim($cc) != '') {
                    $isapprove = $appr == '1' ? '<span style="color:#41bb34">APPROVED</span>' : '<span style="color:#d90300">DISAPPROVED</span>';
                    $apprmsg = $appr == '1' ? 'ALLOWED' : 'NOT ALLOWED';

                    $mail = new PHPMailer();
                    //$mail->SMTPDebug = 4;
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;
                    $mail->IsHTML(true);
                    //$mail->Host = 'mail.philcopy.net';
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 587;
                    $mail->SMTPSecure = "TLS";

                    //$mail->Username = 'noreply@philcopy.net';
                    //$mail->Password = 'noreply33philcopy';
                    //$mail->setFrom('noreply@philcopy.net', 'noreply');

                    $mail->Username = 'philchecklist@gmail.com';
                    $mail->Password = 'newphhealth20!';
                    $mail->setFrom ('philchecklist@gmail.com','noreply');
                    if (trim($cc) != '') {
                        $cc = $cc . ';';
                        $cc2 = explode(';', $cc);
                        $cc3 = array_keys($cc2);
                        $cc4 = end($cc3);
                        for ($i = 0; $i <= $cc4 - 1; $i++) {
                            $mail->addAddress($cc2[$i]);
                        }
                    }
                    $mail->Subject = 'Notification to ' . $name;
                    $msg = "
                <html><body>Good day,<br><br>FYI, " . $name . " is marked as <big>" . $isapprove . " </big>  and he/she is <big>" . $apprmsg . "</big> to enter the company premises from " . $d1 . " to " . $d2 . "
                <br><br>Thank you</body></html>";
                    //$mail->Body    = '';
                    $mail->Body = $msg;
                    if (!$mail->Send()) {
                        echo "\nBut messages to CC emails could not be sent, this error commonly caused by typo emails. Please try again!";
                    }
                    else{
                        //save_mail($mail);
                    }
                }

            }
            else{
                echo "Message could not be sent. Please try again. Mailer Error: {$mail->ErrorInfo}";
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
            $a  = str_replace("'","\'",$_POST['a']);
            $b  = str_replace("'","\'",$_POST['b']);
            $c  = str_replace("'","\'",$_POST['c']);
            $d  = str_replace("'","\'",$_POST['d']);
            $e  = str_replace("'","\'",$_POST['e']);
            $f  = str_replace("'","\'",$_POST['f']);
            $g  = str_replace("'","\'",$_POST['g']);
            $h  = str_replace("'","\'",$_POST['h']);
            $i  = str_replace("'","\'",$_POST['i']);
            $j  = str_replace("'","\'",$_POST['j']);
            $k  = str_replace("'","\'",$_POST['k']);
            $l  = str_replace("'","\'",$_POST['l']);
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

            $try = mysqli_query($conn,"Insert Into Hlogs (`name`,  street, brgy,   city,  dept,  temp, sex,  age, blood, a, b, c, d, e, r2, r3, r4, r5, r6, r7, a5, b5, c5, d5, e5, f5, g5, h5, i5, j5, k5, l5,  adaname, `date`, a1, b1, adaname2, version) values ('$name2', '$addr', '$brgy', '$city', '$dep',  '$temp', '$sex', '$age', '$bloodtype', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9', '$a10', '$a11', '$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i', '$j', '$k', '$l', '$adaname', '$date2', '$qa1', '$qb1', '$adaname2', '4.0')");

            if(!$try) {
                echo 1;
            }
            else {
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
            $a  = str_replace("'","\'",$_POST['a']);
            $b  = str_replace("'","\'",$_POST['b']);
            $c  = str_replace("'","\'",$_POST['c']);
            $d  = str_replace("'","\'",$_POST['d']);
            $e  = str_replace("'","\'",$_POST['e']);
            $f  = str_replace("'","\'",$_POST['f']);
            $g  = str_replace("'","\'",$_POST['g']);
            $h  = str_replace("'","\'",$_POST['h']);
            $i  = str_replace("'","\'",$_POST['i']);
            $j  = str_replace("'","\'",$_POST['j']);
            $k  = str_replace("'","\'",$_POST['k']);
            $l  = str_replace("'","\'",$_POST['l']);
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

            $try = mysqli_query($conn,"Insert Into Hlogs (`name`,  street, brgy,   city,  dept,  temp, sex,  age, blood, a, b, c, d, e, r2, r3, r4, r5, r6, r7, a5, b5, c5, d5, e5, f5, g5, h5, i5, j5, k5, l5,  adaname, `date`, a1, b1, adaname2, version) values ('$name2', '$addr', '$brgy', '$city', '$dep',  '$temp', '$sex', '$age', '$bloodtype', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9', '$a10', '$a11', '$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i', '$j', '$k', '$l', '$adaname', '$date2', '$qa1', '$qb1', '$adaname2', '4.0')");

            if(!$try) {
                echo 1;
            }
            else {
                echo 2;
            }

            break;
        case 5:
            $html = base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($_POST['html'])))))))). ';';
            $names = base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($_POST['names'])))))))). ';';
            $a = explode(';', $html);
            $b = array_keys($a);
            $c = explode(';', $names);

            date_default_timezone_set('Asia/Manila');
            $zip = new ZipArchive;
            $file = 'Health_Checklist_'.date('Y-m-d_gis').'.zip';
            $newfile = __DIR__.'/temp/'.$file;
            echo $newfile;

            if ($zip->open($newfile, ZipArchive::CREATE) === TRUE) {
                for ($i = 0; $i <= end($b) - 1; $i++) {
                    $zip->addFromString($a[$i],$c[$i]);
                }
                $zip->close();
                $file = ("temp/$file");
                $filetype=filetype($file);
                $filename=basename($file);
                header ("Content-Type: ".$filetype);
                header ("Content-Length: ".filesize($file));
                header ("Content-Disposition: attachment; filename=".$filename);
                readfile($file);
            }
            else{
                die ("An error occurred creating your ZIP file.");
            }


            break;

        default:

    }
    //unset($_SESSION['ajax']);
}
function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+[]{}|;:,.<>?';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}