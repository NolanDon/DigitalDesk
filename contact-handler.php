<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your secret key
    $secretKey = "YOUR_SECRET_KEY";

    // Get the reCAPTCHA token from the form
    $recaptchaToken = $_POST['recaptcha-token'];

    // Verify the token with Google's API
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents("$url?secret=$secretKey&response=$recaptchaToken");
    $responseData = json_decode($response);

    if (!$responseData->success || $responseData->score < 0.5) {
        // Invalid or low-score CAPTCHA
        echo "CAPTCHA verification failed. Please try again.";
        exit;
    }

    // Proceed with processing the form (e.g., sending email)
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags($_POST['phone']));
    $message = htmlspecialchars(strip_tags($_POST['message']));

    $to = "info@highwoodweb.com";
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
