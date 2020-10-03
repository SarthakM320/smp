<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include 'db_link.php';
include 'mail_recaptcha_config.php';


//}

//function sendQuery(){
//    try {
//        session_start();
//        if(isset($_GET['name']) && $_GET['email'] && $_GET['phone'] && $_GET['query']){
//
//            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
//            $recaptcha_secret = RECAPTCHA_SECRET;
//            $recaptcha_response = $_POST['grecaptcha_response'];
//
//            // Make and decode POST request:
//            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
//            $recaptcha = json_decode($recaptcha);
//
//            // Take action based on the score returned:
//            if (!$recaptcha->success) {
////                if ($recaptcha->score >= 0.5) {
////                    $_SESSION['bot']=false;
////                    $_SESSION['action']=$recaptcha->action;
////                    $_SESSION['host']=$recaptcha->hostname;
//                return 'bot_detected';
////                } else {
////                    $_SESSION['bot']=true;
////                    return 'F';
////                }
//            }
//            $link = linkToSMP();
//            $name=htmlspecialchars($_GET['name']);
//            $email=htmlspecialchars($_GET['email']);
//            $phone=htmlspecialchars($_GET['phone']);
//            $query=htmlspecialchars($_GET['name']);
//
//            $subject = ;
//
//
//            echo send_email(, , , , $subject,$mail_body);

//function send_email($from_mail, $from_name, $to_email, $to_name, $subject, $mail_body, $is_html = false, $alt_body = ''){
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';


    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 3;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//        $mail->SMTPSecure = "ssl"; // sets the prefix to the server
        $mail->Username   = GMAIL_ID;                     // SMTP username
        $mail->Password   = GMAIL_PASSWORD;                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('smpqueries@gmail.com', 'SMP Website Queries');
        $mail->addAddress('smpqueries@gmail.com', 'SMP Website Queries');     // Add a recipient
//        $mail->addAddress('to@example.com');               // Name is optional
//        $mail->addReplyTo('replyto@example.com', 'Information');
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');

        // Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(false);                                  // Set email format to HTML
        $mail->Subject = 'Query from SMP Website';
        $mail->Body    = 'TEST Mail';
        $mail->AltBody = '';

        echo $mail->send();
    } catch (\PHPMailer\PHPMailer\Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//        return false;
    }
//
//            $sql="INSERT INTO `queries`(`name`, `email`,`phone`,`query`) VALUES (:name,:email,:phone,:query)";
//            $handle=$link->prepare($sql);
//            $handle->execute(array(
//                'name'=>$name,
//                'email'=>$email,
//                'phone'=>$phone,
//                'query' =>$query
//            ));
//            return 'S';
//        }
//        else{
//            return 'F';
//        }
//    }
//    catch(Exception $e){
//        return $e;
//    }
//}
//echo sendQuery();
?>