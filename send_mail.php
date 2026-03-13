<?php
/**
 * Contact Form Mail Handler
 * Upload this file to the same directory as your contact.html on BlueHost/JustHost.
 * Change the $to_email address below to where you want messages delivered.
 */

// ─── CONFIGURATION ────────────────────────────────────────────────────────────
$to_email   = 'authorcameronwest@yahoo.com';
$from_name  = 'CW Author Contact Form';
$subject_prefix = '[cameronwestauthor.com] ';
// ──────────────────────────────────────────────────────────────────────────────

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

// Collect and sanitize inputs
$name    = trim(strip_tags($_POST['name']    ?? ''));
$email   = trim(strip_tags($_POST['email']   ?? ''));
$subject = trim(strip_tags($_POST['subject'] ?? ''));
$message = trim(strip_tags($_POST['message'] ?? ''));
$website = trim($_POST['website'] ?? ''); // honeypot field

// Honeypot anti-spam: bots fill hidden fields, humans don't
if (!empty($website)) {
    http_response_code(200); // Pretend success to confuse bots
    echo json_encode(['success' => true]);
    exit;
}

// Basic validation
$errors = [];
if (empty($name))                        $errors[] = 'Name is required.';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
                                         $errors[] = 'A valid email address is required.';
if (empty($message))                     $errors[] = 'Message is required.';

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

// Build the email
$subject_line = $subject_prefix . (!empty($subject) ? $subject : 'New Contact Message');

$body  = "You have a new message from the contact form on cameronwestauthor.com.\n\n";
$body .= "Name:    {$name}\n";
$body .= "Email:   {$email}\n";
$body .= "Subject: {$subject}\n";
$body .= str_repeat('-', 60) . "\n";
$body .= $message . "\n";
$body .= str_repeat('-', 60) . "\n";
$body .= "\nReply directly to this email to respond to {$name}.";

// Headers — sets Reply-To so you can just hit Reply in your inbox
$headers  = "From: {$from_name} <noreply@cameronwestauthor.com>\r\n";
$headers .= "Reply-To: {$name} <{$email}>\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send it
$sent = mail($to_email, $subject_line, $body, $headers);

if ($sent) {
    echo json_encode(['success' => true, 'message' => 'Message sent successfully.']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Mail server error. Please try again later.']);
}
