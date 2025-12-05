<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = $_POST["form_name"] ?? '';
    $email   = $_POST["form_email"] ?? '';
    $phone   = $_POST["form_phone"] ?? '';
    $subject = $_POST["form_subject"] ?? '';
    $message = $_POST["form_message"] ?? '';

    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS (GMAIL)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'satisivm@gmail.com';     // Gmail address
        $mail->Password   = 'xoaa hwwk lyof zfff'; // DO NOT PUT REAL PASSWORD HERE
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // FROM & TO
        $mail->setFrom('satisivm@gmail.com', 'Website Contact');
        $mail->addAddress('satisivm@gmail.com'); // where the message arrives

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
