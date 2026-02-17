<?php
/**
 * Mail Class
 * Email Handler using PHPMailer
 */

// Load PHPMailer
require_once ROOT_PATH . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail {
    private $mailer;
    private $errors = [];

    public function __construct() {
        $this->mailer = new PHPMailer(true);
        $this->configure();
    }

    /**
     * Configure PHPMailer
     */
    private function configure() {
        try {
            // Server settings
            $this->mailer->isSMTP();
            $this->mailer->Host = SMTP_HOST;
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = SMTP_USERNAME;
            $this->mailer->Password = SMTP_PASSWORD;
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = SMTP_PORT;
            
            // Default sender
            $this->mailer->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
            $this->mailer->CharSet = 'UTF-8';
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }
    }

    /**
     * Send Email
     */
    public function send($to, $subject, $body, $altBody = '') {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->clearAttachments();
            
            $this->mailer->addAddress($to);
            $this->mailer->Subject = $subject;
            $this->mailer->isHTML(true);
            $this->mailer->Body = $body;
            $this->mailer->AltBody = $altBody ?: strip_tags($body);

            return $this->mailer->send();
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Send Contact Form Email
     */
    public function sendContactEmail($data) {
        $subject = "New Contact Form Submission: " . $data['subject'];
        $body = "
            <h2>New Contact Form Submission</h2>
            <p><strong>Name:</strong> {$data['name']}</p>
            <p><strong>Email:</strong> {$data['email']}</p>
            <p><strong>Subject:</strong> {$data['subject']}</p>
            <p><strong>Message:</strong></p>
            <p>{$data['message']}</p>
        ";

        return $this->send(ADMIN_EMAIL, $subject, $body);
    }

    /**
     * Get Errors
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Get Last Error
     */
    public function getLastError() {
        return end($this->errors);
    }
}
