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
        // Get form data
        $name = $this->sanitize($this->post('name'));
        $email = $this->sanitize($this->post('email'));
        $subject = $this->sanitize($this->post('subject', 'No Subject'));
        $message = $this->sanitize($this->post('message'));

        // Validation
        $validation = new Validation();
        $validation->required($name, 'name');
        $validation->required($email, 'email');
        $validation->email($email, 'email');
        $validation->required($message, 'message');

        if ($validation->hasErrors()) {
            $this->json([
                'success' => false,
                'message' => 'Please fill all required fields correctly.',
                'errors' => $validation->getErrors()
            ], 400);
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

        if ($messageId) {
            // Send email notification if SMTP is configured
            if (!empty(SMTP_USERNAME) && !empty(SMTP_PASSWORD)) {
                try {
                    $mail = new Mail();
                    $mail->sendContactEmails($data);
                } catch (Exception $e) {
                    // Log error but don't fail the request
                }
            }

            $this->json([
                'success' => true,
                'message' => 'Thank you for your message! I will get back to you soon.'
            ]);
        } else {
            $this->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again.'
            ], 500);
        }
    }
}
