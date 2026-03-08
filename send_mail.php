<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? strip_tags(trim($_POST['phone'])) : '';
    $date = isset($_POST['date']) ? strip_tags(trim($_POST['date'])) : '';
    $location = isset($_POST['location']) ? strip_tags(trim($_POST['location'])) : '';

    if (empty($name) || empty($email) || empty($phone)) {
        echo "error";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        // Provided credentials explicitly from the objective
        $mail->Username   = 'joeljosedesigner@gmail.com';
        $mail->Password   = 'oaykiryagwzaxzov';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('joeljosedesigner@gmail.com', 'System Inquiry'); // Always use an authenticated email for From
        $mail->addAddress('joeljosedesigner@gmail.com', 'Shalom Wedding Planners');     // Send to the specified lead email
        $mail->addReplyTo($email, $name); // Important: so they can easily reply to the customer's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Website Inquiry from $name";
        $mail->Body    = "
            <h3>You have received a new inquiry from the website.</h3>
            <table border='0' cellpadding='4' cellspacing='0'>
                <tr>
                    <td><strong>Name:</strong></td>
                    <td>{$name}</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td>{$email}</td>
                </tr>
                <tr>
                    <td><strong>Phone:</strong></td>
                    <td>{$phone}</td>
                </tr>
                <tr>
                    <td><strong>Wedding Date:</strong></td>
                    <td>{$date}</td>
                </tr>
                <tr>
                    <td><strong>Location:</strong></td>
                    <td>{$location}</td>
                </tr>
            </table>
        ";
        
        $mail->AltBody = "New Website Inquiry\n\nName: $name\nEmail: $email\nPhone: $phone\nDate: $date\nLocation: $location";

        $mail->send();
        echo 'success';
    } catch (Exception $e) {
        // Can optionally log $mail->ErrorInfo on the server if needed for debugging.
        echo 'error';
    }
} else {
    echo 'error';
}
