<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postData = file_get_contents("php://input");

    // Decode the JSON data
    $formData = json_decode($postData, true); // true converts to associative array

    // Now you can access form data using array keys
    $name = $formData["name"];
    $email = $formData["email"];
    $phone = $formData["phone"];
    $message = $formData["message"];

    $to = "info@cloftware.com"; 
    $subject = "New Contact Form Submission";
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    $emailBody = "Name: $name\n" .
                 "Email: $email\n" .
                 "Phone: $phone\n" .
                 "Message:\n$message";

    if (mail($to, $subject, $emailBody, $headers)) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error"));
    }
}
?>
