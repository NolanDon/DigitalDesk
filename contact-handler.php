<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Load the secret key from the environment
    $secretKey = getenv('CAPTCHA');
    if (!$secretKey) {
        echo "Server error: missing secret key.";
        exit;
    }

    // Get the reCAPTCHA token from the form
    $recaptchaToken = $_POST['recaptcha-token'];

    // Verify the token with Google's API
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $postData = [
        'secret' => $secretKey,
        'response' => $recaptchaToken
    ];

    // Initialize cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "Server error: Unable to verify CAPTCHA.";
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    // Decode the response
    $responseData = json_decode($response);

    if (!$responseData->success || $responseData->score < 0.5) {
        echo "CAPTCHA verification failed. Please try again.";
        exit;
    }

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
