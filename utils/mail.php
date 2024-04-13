<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'fly.group.cityu@gmail.com';
        $mail->Password   = 'nysqkbxyscfzktvu';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('fly.group.cityu@gmail.com', 'Fly Group from CityU');
        $mail->addAddress($to);

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function sendVerficationEmailCode($to, $code) {
    $subject = '[PetShop] Verification Code';
    $verificationEmailBody = "
Dear User,
</br></br>
We received a request to reset your account password associated with this email address. Your verification code is:
</br></br>
<b>{VERIFICATION_CODE}</b>
</br></br>
If you did not request a password reset, please ignore this email.
</br></br>
Thank you,</br>
Fly Team (CityU)
";
    $verificationEmailBody = str_replace('{VERIFICATION_CODE}', $code, $verificationEmailBody);
    sendEmail($to, $subject, $verificationEmailBody);
}

function sendWelcomeEmail($to) {
    $welcomeEmailBody = "
Dear User, 
</br></br>
Welcome aboard! We're excited to have you here.
</br></br>
You can now avail our full suite of services. We hope you can enjoy higher quality and cheaper pet supplies and toys through our website. 
</br></br>
If you encounter any issues or have any queries while using our services, feel free to reach out to us.
</br></br>
Thanks again for joining us, and we look forward to serving you in the days to come. We wish you and your pet a wonderful day together!
</br></br>
Thank you,</br>
Fly Team (CityU)
";
    $subject = '[PetShop] Welcome to our Store!';
    sendEmail($to, $subject, $welcomeEmailBody);

}

function sendReportEmail($to, $body) {
    // need to be updated
    $subject = '[PetShop] Your Report has been prepared!';
    sendEmail($to, $subject, $body);
}

//sendVerficationEmailCode('yongze_yang@outlook.com', 123456);
//sendWelcomeEmail('yongze_yang@outlook.com');

?>
