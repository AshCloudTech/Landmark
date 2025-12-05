<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = $_POST["form_name"] ?? '';
    $email   = $_POST["form_email"] ?? '';
    $phone   = $_POST["form_phone"] ?? '';
    $subject = $_POST["form_subject"] ?? '';
    $message = $_POST["form_message"] ?? '';

    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host       = 'smtp.office365.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'Syeda.umme.hani@cloudtechnologiesltd.co.uk'; 
        $mail->Password   = 'Hani@069'; // replace with real password or app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // FROM & TO
        $mail->setFrom($email, $name); 
        $mail->addAddress('Syeda.umme.hani@cloudtechnologiesltd.co.uk');

        // EMAIL CONTENT
        $mail->isHTML(true);
        $mail->Subject = "New Contact Message: $subject";
        $mail->Body    = "
            <h2>New Contact Form Submission</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>
