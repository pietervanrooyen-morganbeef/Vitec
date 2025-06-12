<?php
// This script processes the contact form submission.

// Check if the form was submitted using the POST method.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- CONFIGURATION ---
    // Set the recipient email address.
    $recipient_email = "naudevr@gmail.com";

    // --- FORM DATA CAPTURE ---
    // Sanitize and retrieve the data from the form fields.
    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $sender_email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $phone = trim(filter_var($_POST['phone'], FILTER_SANITIZE_STRING));
    $subject_line = trim(filter_var($_POST['subject'], FILTER_SANITIZE_STRING));
    $message_body = trim(filter_var($_POST['message'], FILTER_SANITIZE_STRING));

    // --- VALIDATION ---
    // Check if the required fields are empty.
    if (empty($name) || empty($sender_email) || empty($message_body)) {
        // Redirect to a status page with a validation error
        header("Location: email.php?status=validation_error");
        exit;
    }

    // Check for a valid email format.
    if (!filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
        // Redirect to a status page with an email format error
        header("Location: email.php?status=email_error");
        exit;
    }
    
    // --- EMAIL CONSTRUCTION ---
    $email_subject = "New Contact Form Message: $subject_line";
    $email_content = "You have received a new message from your website contact form.\n\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $sender_email\n";
    if (!empty($phone)) {
        $email_content .= "Phone: $phone\n";
    }
    $email_content .= "\nMessage:\n$message_body\n";
    $email_headers = "From: $name <$sender_email>\r\n";
    $email_headers .= "Reply-To: $sender_email\r\n";
    $email_headers .= "X-Mailer: PHP/" . phpversion();

    // --- SEND EMAIL ---
    if (mail($recipient_email, $email_subject, $email_content, $email_headers)) {
        // Redirect to a success page.
        header("Location: email.php?status=success");
        exit;
    } else {
        // Redirect to an error page.
        header("Location: email.php?status=error");
        exit;
    }

} else {
    // Block direct access to the script.
    http_response_code(405); // Method Not Allowed
    echo "There was a problem with your submission, please try again.";
}
?>
