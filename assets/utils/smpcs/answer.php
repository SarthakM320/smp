<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include '../db_link.php';
include '../mail_recaptcha_config.php';

function send_email($from_mail, $from_name, $to_email, $to_name, $subject, $mail_body, $is_html = false, $alt_body = ''){
    require './../PHPMailer/src/Exception.php';
    require './../PHPMailer/src/PHPMailer.php';
    require './../PHPMailer/src/SMTP.php';


    $mail = new PHPMailer(true);

    try {
        //Server settings
//    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp-auth.iitb.ac.in';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//    $mail->SMTPSecure = "ssl"; // sets the prefix to the server
        $mail->Username   = LDAP;                     // SMTP username
        $mail->Password   = LDAP_A_T;                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 25;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom($from_mail, $from_name);
        $mail->addAddress($to_email, $to_name);     // Add a recipient
//        $mail->addAddress('to@example.com');               // Name is optional
//        $mail->addReplyTo('replyto@example.com', 'Information');
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');

        // Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML($is_html);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $mail_body;
        $mail->AltBody = ($alt_body=='')?$mail_body:$alt_body;

        if($mail->send()) return true;
        else return false;
    } catch (\PHPMailer\PHPMailer\Exception $e) {
//        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}

function Answer(){
    try
    {
        $answer = $_POST['answer'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $query = $_POST['query'];
        $id = $_POST['id'];



        $subject = 'SMP, IIT Bombay | Reply to your Query ['.$query;
        $subject = substr($subject,0,100).'...]';
        $mail_body = '<b>Your Query</b>: '.$query.'<br>';
        $mail_body .= '<b>Answer</b>:<br>'.$answer;
        $mail_body .= '<br><br>Please do not reply back to this mail. Go to <a href="https://smp.gymkhana.iitb.ac.in/queries.html" target="_blank">https://smp.gymkhana.iitb.ac.in/queries.html</a> to ask your query. Thank you.';

        send_email('smp@iitb.ac.in','SMP, IIT Bombay',$email,$name,$subject,$mail_body);

        $link = linkToSMP();
        $sql="UPDATE `queries` SET `answered`=:answered, `answer`=:answer WHERE `id`=:id";
        $handle=$link->prepare($sql);
        $handle->execute(array('answered' => '1', 'answer'=>$answer, 'id'=>$id));
        return "S";
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo Answer();
?>
