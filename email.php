<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = filter_var(trim($_POST["phone"]), FILTER_SANITIZE_STRING);
    $subject = filter_var(trim($_POST["subject"]), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

    // Basic validation
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        // Handle error - redirect back to form with error message
        http_response_code(400);
        echo "Please fill out all required fields and provide a valid email.";
        exit;
    }

    // --- Email Configuration ---
    
    // The email address messages will be sent TO.
    $recipient = "admin@vi-tec.co.za";

    // The subject line for the email you receive.
    // If the user provided a subject, use it. Otherwise, use a default.
    $email_subject = "New Contact Form Submission: " . (!empty($subject) ? $subject : "From $name");

    // Build the email content.
    $email_content = "You have received a new message from your website contact form.\n\n";
    $email_content .= "Here are the details:\n\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $email\n";
    if (!empty($phone)) {
        $email_content .= "Phone: $phone\n";
    }
    $email_content .= "\nMessage:\n$message\n";

    // Build the email headers.
    // This makes sure the email appears to come from the user so you can reply directly.
    $email_headers = "From: $name <$email>";

    // --- Send the Email ---
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // Success: Redirect to a thank-you page or back to the contact page
        // For simplicity, we can redirect back to the contact page with a success status.
        // You could create a dedicated 'thank-you.html' page for a better user experience.
        header("Location: contact.html?status=success");
        exit;
    } else {
        // Failure: Send an error response
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
        exit;
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
