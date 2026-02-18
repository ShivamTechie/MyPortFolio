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
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        
        // Verify CSRF token
        if (!isset($_POST['csrf_token']) || !Session::verifyCsrfToken($_POST['csrf_token'])) {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Invalid request. Please refresh and try again.']);
                exit;
            }
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

        // Validate required fields
        if (empty($data['name']) || empty($data['title']) || empty($data['email'])) {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
                exit;
            }
            Session::flash('error', 'Please fill in all required fields.', 'error');
            header('Location: ' . ADMIN_URL . '?page=profile');
            exit;
        }

        // Handle profile image upload
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            require_once APP_PATH . '/core/Upload.php';
            $upload = new Upload(UPLOAD_PATH . '/profile', ALLOWED_IMAGE_TYPES);
            $imageName = $upload->upload($_FILES['profile_image']);
            
            if ($imageName) {
                $data['profile_image'] = $imageName;
            } else {
                if ($isAjax) {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'message' => 'Failed to upload profile image.']);
                    exit;
                }
            }
        }

        // Handle resume upload
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
            require_once APP_PATH . '/core/Upload.php';
            $upload = new Upload(UPLOAD_PATH . '/resume', ALLOWED_DOC_TYPES);
            $resumeName = $upload->upload($_FILES['resume']);
            
            if ($resumeName) {
                $data['resume_path'] = $resumeName;
            } else {
                if ($isAjax) {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'message' => 'Failed to upload resume.']);
                    exit;
                }
            }
        }

        // Debug: Log the update attempt
        error_log("Profile Update Data: " . print_r($data, true));
        
        $result = $this->profileModel->updateProfile($data);
        
        // Debug: Log the result
        error_log("Profile Update Result: " . ($result ? 'SUCCESS' : 'FAILED'));
        
        if ($result) {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true, 
                    'message' => 'Profile updated successfully! ✓',
                    'reload' => true,
                    'updated_data' => $data
                ]);
                exit;
            }
            Session::flash('success', 'Profile updated successfully!', 'success');
        } else {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false, 
                    'message' => 'Failed to update profile. Database update failed.',
                    'debug_data' => $data
                ]);
                exit;
            }
            Session::flash('error', 'Failed to update profile.', 'error');
        }

        header('Location: ' . ADMIN_URL . '?page=profile');
        exit;
    }
}
