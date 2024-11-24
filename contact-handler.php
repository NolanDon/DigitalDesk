<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Proceed with form processing
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags($_POST['phone']));
    $message = htmlspecialchars(strip_tags($_POST['message']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Send email
    $to = "nolan.donb@gmail.com";
    $subject = "New Contact Form Submission";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    $body = "You have received a new message:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Message:\n$message\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
}
?>
