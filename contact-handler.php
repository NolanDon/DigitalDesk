<?php
// Allow requests from any origin (can be restricted to specific domains)
header("Access-Control-Allow-Origin: *");
// Allow certain HTTP methods
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// Allow certain headers (for content-type and authorization headers, for example)
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200); // Send success status for preflight
    exit; // Stop further execution
}

// Proceed only for POST requests
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Extract and sanitize form data
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags($_POST['phone']));
    $message = htmlspecialchars(strip_tags($_POST['message']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400); // Bad request
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
        http_response_code(200); // OK
        echo "Message sent successfully!";
    } else {
        http_response_code(500); // Internal server error
        echo "Failed to send message.";
    }
} else {
    // Method not allowed for non-POST requests
    http_response_code(405); // Method not allowed
    echo "Method Not Allowed";
    exit;
}
?>
