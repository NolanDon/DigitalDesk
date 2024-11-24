<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // // Load the secret key from the environment
    // $secretKey = getenv('CAPTCHA'); // Replace 'CAPTCHA' with the actual name of your environment variable
    // if (!$secretKey) {
    //     echo "Server error: missing secret key.";
    //     exit;
    // }

    // Get the reCAPTCHA token from the form
    // $recaptchaToken = $_POST['recaptcha-token'];

    // Verify the token with Google's API using POST
    // $url = "https://www.google.com/recaptcha/api/siteverify";
    // $postData = [
    //     'secret' => $secretKey,
    //     'response' => $recaptchaToken
    // ];

    // Initialize cURL
    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Receive server response
    // curl_setopt($ch, CURLOPT_POST, true); // Use POST method
    // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData)); // Pass POST data
    // // $response = curl_exec($ch);
    // curl_close($ch);

    // Decode the response
    // $responseData = json_decode($response);

    // if (!$responseData->success || $responseData->score < 0.5) {
    //     // CAPTCHA failed or score too low
    //     echo "CAPTCHA verification failed. Please try again.";
    //     exit;
    // }

    // Proceed with processing the form (e.g., sending email)
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags($_POST['phone']));
    $message = htmlspecialchars(strip_tags($_POST['message']));

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
