<?php
/**
 * Profile Controller
 * Manage Profile Information
 */

require_once APP_PATH . '/models/Profile.php';

class ProfileController {
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
        // Verify CSRF token
        if (!isset($_POST['csrf_token']) || !Session::verifyCsrfToken($_POST['csrf_token'])) {
            Session::flash('error', 'Invalid request.', 'error');
            header('Location: ' . ADMIN_URL . '?page=profile');
            exit;
        }

        $data = [
            'name' => $_POST['name'] ?? '',
            'title' => $_POST['title'] ?? '',
            'bio' => $_POST['bio'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'email' => $_POST['email'] ?? '',
            'address' => $_POST['address'] ?? '',
            'linkedin' => $_POST['linkedin'] ?? '',
            'github' => $_POST['github'] ?? '',
            'twitter' => $_POST['twitter'] ?? ''
        ];

        // Handle profile image upload
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            require_once APP_PATH . '/core/Upload.php';
            $upload = new Upload(UPLOAD_PATH . '/profile', ALLOWED_IMAGE_TYPES);
            $imageName = $upload->upload($_FILES['profile_image']);
            
            if ($imageName) {
                $data['profile_image'] = $imageName;
            }
        }

        // Handle resume upload
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
            require_once APP_PATH . '/core/Upload.php';
            $upload = new Upload(UPLOAD_PATH . '/resume', ALLOWED_DOC_TYPES);
            $resumeName = $upload->upload($_FILES['resume']);
            
            if ($resumeName) {
                $data['resume_path'] = $resumeName;
            }
        }

        if ($this->profileModel->updateProfile($data)) {
            Session::flash('success', 'Profile updated successfully!', 'success');
        } else {
            Session::flash('error', 'Failed to update profile.', 'error');
        }

        header('Location: ' . ADMIN_URL . '?page=profile');
        exit;
    }
}
