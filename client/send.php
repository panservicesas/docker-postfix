<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$defaultFromName = 'Panservice';
$defaultFrom = 'noreply@panservice.it';
$defaultRecipient = 'info@panservice.it';
$defaultHost = 'localhost';
$defaultPort = 1025;

$options = getopt('', [
    'fromName::',
    'from:',
    'recipient:',
    'host::',
    'port::'
]);

$fromName = $options['fromName'] ?? $defaultFromName;
$from = $options['from'] ?? $defaultFrom;
$recipient = $options['recipient'] ?? $defaultRecipient;
$host = $options['host'] ?? $defaultHost;
$port = isset($options['port']) ? (int)$options['port'] : $defaultPort;

if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
    echo "The sender's email address is invalid: $from\n";
    exit(1);
}

if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
    echo "The email address provided is invalid: $recipient\n";
    exit(1);
}

try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = $host;
    $mail->Port = $port;

    $mail->SMTPAutoTLS = false;
    $mail->SMTPSecure = false;

    $mail->setFrom($from, $defaultFromName);
    $mail->addAddress($recipient);

    $mail->Subject = 'Panservice - E-mail SMTP check';
    $mail->Body = 'E-mail sent with success!';

    echo "From: $from", "\n";
    echo "To: $recipient", "\n";

    $mail->send();

    echo "Email sent successfully!", "\n";

} catch (Exception $e) {
    echo "Error sending email: $mail->ErrorInfo", "\n";
}

?>