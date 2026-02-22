<?php
/**
 * Mail Class
 * Email Handler using PHPMailer (Hostinger SMTP)
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once ROOT_PATH . '/vendor/autoload.php';

class Mail {

    private PHPMailer $mailer;
    private array $errors = [];

    public function __construct() {
        $this->mailer = new PHPMailer(true);
        $this->configure();
    }

    /**
     * Configure PHPMailer (Hostinger SMTP)
     */
    private function configure(): void {
        try {
            $this->mailer->isSMTP();
            $this->mailer->Host       = SMTP_HOST;
            $this->mailer->SMTPAuth   = true;
            $this->mailer->Username   = SMTP_USERNAME;
            $this->mailer->Password   = SMTP_PASSWORD;
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL
            $this->mailer->Port       = SMTP_PORT;

            $this->mailer->CharSet = 'UTF-8';
            $this->mailer->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);

        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }
    }

    /**
     * Core send method
     */
    private function send(string $to, string $subject, string $htmlBody): bool {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->clearAttachments();

            $this->mailer->addAddress($to);
            $this->mailer->Subject = $subject;
            $this->mailer->isHTML(true);
            $this->mailer->Body    = $htmlBody;
            $this->mailer->AltBody = strip_tags($htmlBody);

            return $this->mailer->send();

        } catch (Exception $e) {
            $this->errors[] = $this->mailer->ErrorInfo;
            return false;
        }
    }

    /**
     * PUBLIC: Handle contact form emails
     * - Sends email to admin
     * - Sends auto-reply to user
     */
    public function sendContactEmails(array $data): bool {

        $adminMailSent = $this->send(
            ADMIN_EMAIL,
            'New Contact Message — ' . ($data['subject'] ?: 'No Subject'),
            $this->adminTemplate($data)
        );

        $userMailSent = $this->send(
            $data['email'],
            'Thanks for contacting ' . SMTP_FROM_NAME,
            $this->userTemplate($data)
        );

        return $adminMailSent && $userMailSent;
    }

    /**
     * HTML Template — Admin Notification
     */
    private function adminTemplate(array $data): string {
        return "
        <div style='font-family: Arial, sans-serif; background:#f5f7fa; padding:30px'>
            <div style='max-width:600px; background:#ffffff; margin:auto; border-radius:8px; padding:30px'>
                <h2 style='color:#111827; margin-bottom:20px'>📩 New Contact Message</h2>

                <p><strong>Name:</strong> {$data['name']}</p>
                <p><strong>Email:</strong> {$data['email']}</p>
                <p><strong>Subject:</strong> {$data['subject']}</p>

                <hr style='margin:20px 0'>

                <p style='color:#374151'><strong>Message:</strong></p>
                <p style='color:#374151; line-height:1.6'>
                    " . nl2br(htmlspecialchars($data['message'])) . "
                </p>

                <hr style='margin:30px 0'>

                <p style='font-size:13px; color:#6b7280'>
                    Sent from <strong>" . APP_NAME . "</strong>
                </p>
            </div>
        </div>";
    }

    /**
     * HTML Template — User Auto Reply
     */
    private function userTemplate(array $data): string {
        return "
        <div style='font-family: Arial, sans-serif; background:#f5f7fa; padding:30px'>
            <div style='max-width:600px; background:#ffffff; margin:auto; border-radius:8px; padding:30px'>
                <h2 style='color:#111827; margin-bottom:20px'>Hi {$data['name']} 👋</h2>

                <p style='color:#374151; line-height:1.6'>
                    Thank you for reaching out to me! I’ve received your message and will get back to you as soon as possible.
                </p>

                <div style='margin:20px 0; padding:15px; background:#f9fafb; border-left:4px solid #3b82f6'>
                    <p style='margin:0; font-size:14px; color:#374151'>
                        <strong>Your Message:</strong><br>
                        " . nl2br(htmlspecialchars($data['message'])) . "
                    </p>
                </div>

                <p style='color:#374151'>
                    Until then, feel free to explore my portfolio or connect with me on social platforms.
                </p>

                <p style='margin-top:30px'>
                    Best regards,<br>
                    <strong>" . SMTP_FROM_NAME . "</strong>
                </p>

                <hr style='margin:30px 0'>

                <p style='font-size:13px; color:#6b7280'>
                    This is an automated response. Please do not reply to this email.
                </p>
            </div>
        </div>";
    }

    /**
     * Error helpers
     */
    public function getErrors(): array {
        return $this->errors;
    }

    public function getLastError(): ?string {
        return end($this->errors) ?: null;
    }
}