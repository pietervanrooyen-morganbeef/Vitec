<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Status - Vitec</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        /* Use Inter as the default font */
        body { 
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">
    
    <!-- Status Card -->
    <div class="max-w-lg w-full mx-auto bg-white rounded-xl shadow-2xl p-8 md:p-12 text-center">
        <?php
            // Initialize variables for message content
            $heading = '';
            $message = '';
            $heading_color = 'text-gray-800'; // Default color

            // Check for the status parameter in the URL
            if (isset($_GET['status'])) {
                $status = $_GET['status'];

                if ($status == 'success') {
                    // Success message
                    $heading = 'Thank You!';
                    $message = 'Your message has been sent successfully. We will get back to you shortly.';
                    $heading_color = 'text-green-600';
                } elseif ($status == 'error') {
                    // Generic error message
                    $heading = 'Oops!';
                    $message = 'Something went wrong and we couldn\'t send your message. Please try again later.';
                    $heading_color = 'text-red-600';
                } elseif ($status == 'validation_error') {
                    // Validation error
                    $heading = 'Incomplete Form';
                    $message = 'Please fill out all the required fields before submitting.';
                    $heading_color = 'text-yellow-600';
                } elseif ($status == 'email_error') {
                    // Email format error
                    $heading = 'Invalid Email';
                    $message = 'The email address you entered is not in a valid format. Please correct it and try again.';
                    $heading_color = 'text-yellow-600';
                } else {
                    // Any other error
                    $heading = 'Error';
                    $message = 'An unknown error occurred. Please try again.';
                    $heading_color = 'text-red-600';
                }
            } else {
                // Default message if no status is provided
                $heading = 'Submission Status';
                $message = 'This page is for displaying the status of your form submission.';
            }

            // Display the messages
            echo "<h1 class='text-4xl font-bold $heading_color mb-4'>$heading</h1>";
            echo "<p class='text-gray-700 text-lg mb-8'>$message</p>";
        ?>
        
        <!-- Back Button -->
        <a href="contact.html" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
            &larr; Go Back to Contact Page
        </a>
    </div>

</body>
</html>
