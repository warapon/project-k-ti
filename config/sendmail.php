<?php
class mail
{
    public function send($mailsend,$pass)
    {
        require_once 'PhpMail/mailerClass/PHPMailerAutoload.php';

        $mail = new PHPMailer;
        $mail->CharSet = 'UTF-8';
//Tell PHPMailer to use SMTP
        $mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
        $mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

//Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
        $mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "suratthanifruit@gmail.com";

//Password to use for SMTP authentication
        $mail->Password = "suratthanifruit01";

//Set who the message is to be sent from
        $mail->setFrom('suratthanifruit@gmail.com', 'Suratthanifruit');

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
        $mail->addAddress($mailsend);

//Set the subject line
        $mail->Subject = '[suratthanifruit]รหัสผ่าน suratthanifruit ของคุณ';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

        $mail->Body = "การเข้าใช้ระบบ suratthanifruit<br>
ขั้นตอนที่ 1:<br>
การเปิดใช้งาน : http://suratthanifruit.com/main.php?page=login<br>
--------------------------------------------<br>
ขั้นตอนที่ 2:<br>
อีเมล์: $mailsend<br>
รหัสผ่าน: $pass<br>
--------------------------------------------<br>
<br>
ขอแสดงความนับถือ<br>
http://suratthanifruit.com";

//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        $mail->isHTML(true);
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
        if (!$mail->send()) {
            $msg = "Mailer Error: " . $mail->ErrorInfo;
            //echo "<script>alert('ทำรายการไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');window.location.href='login.php';</script>";
        } else {
//            echo "อีเมล์ในการยืนยันถูกส่งไปหาคุณแล้วกรุณาปฏิบัติตามคำแนะนำเพื่อยืนยันและเปลี่ยนรหัสผ่าน";
            $msg = 1;
        }
        return $msg;
    }

}

?>

