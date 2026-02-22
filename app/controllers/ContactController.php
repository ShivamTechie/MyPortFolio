<?php
/**
 * Contact Controller
 * Handle Contact Form Submissions
 */

require_once APP_PATH . '/models/ContactMessage.php';
require_once APP_PATH . '/core/Mail.php';

class ContactController extends Controller {
    
    public function index() {
        if ($this->isPost()) {
            $this->submit();
        } else {
            $this->redirect('');
        }
    }

    private function submit() {
        // Start output buffering
        ob_start();
        
        try {
            // Get form data
            $name = $this->sanitize($this->post('name'));
            $email = $this->sanitize($this->post('email'));
            $subject = $this->sanitize($this->post('subject', 'No Subject'));
            $message = $this->sanitize($this->post('message'));

            // Log received data
            error_log("Contact Form Submission - Name: $name, Email: $email");

            // Validation
            $validation = new Validation();
            $validation->required($name, 'name');
            $validation->required($email, 'email');
            $validation->email($email, 'email');
            $validation->required($message, 'message');

            if ($validation->hasErrors()) {
                ob_end_clean();
                $this->json([
                    'success' => false,
                    'message' => 'Please fill all required fields correctly.',
                    'errors' => $validation->getErrors()
                ], 400);
                return;
            }

            // Save to database
            $messageModel = new ContactMessage();
            $data = [
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message
            ];

            $messageId = $messageModel->insert($data);
            error_log("Contact Message Insert Result: " . ($messageId ? "SUCCESS (ID: $messageId)" : "FAILED"));

            if ($messageId) {
                // Send email notification if SMTP is configured
                if (!empty(SMTP_USERNAME) && !empty(SMTP_PASSWORD)) {
                    try {
                        $mail = new Mail();
                        $mail->sendContactEmails($data);
                        error_log("Contact Email Sent Successfully");
                    } catch (Exception $e) {
                        error_log("Email Send Error: " . $e->getMessage());
                    }
                }

                ob_end_clean();
                $this->json([
                    'success' => true,
                    'message' => 'Thank you for your message! I will get back to you soon.'
                ]);
            } else {
                ob_end_clean();
                $this->json([
                    'success' => false,
                    'message' => 'Failed to send message. Please try again.'
                ], 500);
            }
        } catch (Exception $e) {
            ob_end_clean();
            error_log("Contact Form Error: " . $e->getMessage());
            $this->json([
                'success' => false,
                'message' => 'An error occurred. Please try again later.'
            ], 500);
        }
    }
}
