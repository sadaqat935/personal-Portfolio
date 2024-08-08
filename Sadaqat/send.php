<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'itsadaqat000@gmail.com'; // Your Gmail address
        $mail->Password = 'cszo hxxm nyeb pvcr'; // Use an app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // or PHPMailer::ENCRYPTION_STARTTLS
        $mail->Port = 465; // Use 587 if using TLS

        $mail->setFrom('itsadaqat000@gmail.com', 'Sadaqat Ali'); // Your name or a suitable sender name
        $mail->addAddress('itsadaqat000@gmail.com'); // Fixed recipient address

        $mail->isHTML(true);
        $mail->Subject = 'Message from ' . htmlspecialchars($_POST["name"]) . ': ' . htmlspecialchars($_POST["subject"]); // Subject includes user's name and subject
        $mail->Body = '<p><strong>Name:</strong> ' . htmlspecialchars($_POST["name"]) . '</p>' .
                      '<p><strong>Email:</strong> ' . htmlspecialchars($_POST["email"]) . '</p>' .
                      '<p><strong>Subject:</strong> ' . htmlspecialchars($_POST["subject"]) . '</p>' .
                      '<p><strong>Message:</strong></p>' .
                      '<p>' . nl2br(htmlspecialchars($_POST["message"])) . '</p>';

        $mail->send();

        // Redirect to index.html after sending the email
        header('Location: index.html');
        exit(); // Ensure no further code is executed
    } catch (Exception $e) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Message could not be sent',
                        text: 'Mailer Error: {$mail->ErrorInfo}'
                    });
                });
              </script>";
    }
}
?>
