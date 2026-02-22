<?php
/**
 * Profile Controller
 * Manage Profile Information
 */

require_once ADMIN_PATH . '/controllers/BaseController.php';
require_once APP_PATH . '/models/Profile.php';

class ProfileController extends BaseController {

    private $profileModel;

    public function __construct() {
        $this->profileModel = new Profile();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->update();
        } else {
            $this->index();
        }
    }

    /**
     * Show Profile Form
     */
    public function index() {
        $profile = $this->profileModel->getProfile();
        $csrfToken = Session::generateCsrfToken();

        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/profile.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }

    /**
     * Update Profile
     */
    public function update() {

        ob_start();

        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        /* ===============================
         * CSRF VALIDATION
         * =============================== */
        if (!isset($_POST['csrf_token']) || !Session::verifyCsrfToken($_POST['csrf_token'])) {
            ob_end_clean();
            $this->jsonOrRedirect($isAjax, false, 'Invalid request. Please refresh and try again.');
        }

        /* ===============================
         * COLLECT FORM DATA
         * =============================== */
        $data = [
            'name'      => $_POST['name'] ?? '',
            'title'     => $_POST['title'] ?? '',
            'bio'       => $_POST['bio'] ?? '',
            'phone'     => $_POST['phone'] ?? '',
            'email'     => $_POST['email'] ?? '',
            'address'   => $_POST['address'] ?? '',
            'linkedin'  => $_POST['linkedin'] ?? '',
            'github'    => $_POST['github'] ?? '',
            'twitter'   => $_POST['twitter'] ?? ''
        ];

        /* ===============================
         * BASIC VALIDATION
         * =============================== */
        if (empty($data['name']) || empty($data['title']) || empty($data['email'])) {
            ob_end_clean();
            $this->jsonOrRedirect($isAjax, false, 'Please fill in all required fields.');
        }

        require_once APP_PATH . '/core/Upload.php';

        /* ===============================
         * PROFILE IMAGE UPLOAD
         * =============================== */
        if (!empty($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {

            $imageUpload = new Upload(
                UPLOAD_PATH . '/profile',
                ALLOWED_IMAGE_TYPES
            );

            $imageName = $imageUpload->upload($_FILES['profile_image']);

            if ($imageName) {
                $data['profile_image'] = $imageName;
            } else {
                ob_end_clean();
                $this->jsonOrRedirect($isAjax, false, 'Failed to upload profile image.');
            }
        }

        /* ===============================
         * RESUME UPLOAD (DOC / DOCX / PDF)
         * =============================== */
        if (!empty($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {

            $resumeUpload = new Upload(
                UPLOAD_PATH . '/resume',
                ALLOWED_DOC_TYPES
            );

            $resumeName = $resumeUpload->upload($_FILES['resume']);

            if ($resumeName) {
                $data['resume_path'] = $resumeName;
            } else {
                ob_end_clean();
                $this->jsonOrRedirect(
                    $isAjax,
                    false,
                    'Invalid resume file. Please upload PDF, DOC, or DOCX.'
                );
            }
        }

        /* ===============================
         * UPDATE DATABASE
         * =============================== */
        $result = $this->profileModel->updateProfile($data);

        ob_end_clean();

        if ($result) {
            $this->jsonOrRedirect(
                $isAjax,
                true,
                'Profile updated successfully!',
                ['reload' => true]
            );
        } else {
            $this->jsonOrRedirect(
                $isAjax,
                false,
                'Failed to update profile.'
            );
        }
    }

    /**
     * Helper: JSON (AJAX) or Redirect
     */
    private function jsonOrRedirect($isAjax, $success, $message, $extra = []) {

        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(array_merge([
                'success' => $success,
                'message' => $message
            ], $extra));
            exit;
        }

        Session::flash(
            $success ? 'success' : 'error',
            $message,
            $success ? 'success' : 'error'
        );

        header('Location: ' . ADMIN_URL . '?page=profile');
        exit;
    }
}