<?php
/**
 * Change Password Controller
 * Handle Admin Password Changes
 */

require_once APP_PATH . '/models/User.php';

class ChangePasswordController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->update();
        } else {
            $this->index();
        }
    }

    /**
     * Show Change Password Form
     */
    public function index() {
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/change-password.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }

    /**
     * Update Password
     */
    public function update() {
        // Verify CSRF token
        if (!isset($_POST['csrf_token']) || !Session::verifyCsrfToken($_POST['csrf_token'])) {
            Session::flash('error', 'Invalid request.', 'error');
            header('Location: ' . ADMIN_URL . '?page=change-password');
            exit;
        }

        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Validation
        $validation = new Validation();
        $validation->required($currentPassword, 'current password');
        $validation->required($newPassword, 'new password');
        $validation->required($confirmPassword, 'confirm password');
        $validation->minLength($newPassword, 'new password', 6);

        if ($validation->hasErrors()) {
            Session::flash('error', 'Please fill all required fields correctly.', 'error');
            header('Location: ' . ADMIN_URL . '?page=change-password');
            exit;
        }

        // Check if new passwords match
        if ($newPassword !== $confirmPassword) {
            Session::flash('error', 'New passwords do not match.', 'error');
            header('Location: ' . ADMIN_URL . '?page=change-password');
            exit;
        }

        // Get current user
        $userId = Session::getUserId();
        $user = $this->userModel->getById($userId);

        if (!$user) {
            Session::flash('error', 'User not found.', 'error');
            header('Location: ' . ADMIN_URL . '?page=change-password');
            exit;
        }

        // Verify current password
        if (!$this->userModel->verifyPassword($currentPassword, $user['password'])) {
            Session::flash('error', 'Current password is incorrect.', 'error');
            header('Location: ' . ADMIN_URL . '?page=change-password');
            exit;
        }

        // Update password
        if ($this->userModel->updatePassword($userId, $newPassword)) {
            Session::flash('success', 'Password changed successfully! Please login again.', 'success');
            // Logout user to force re-login with new password
            Session::logout();
            header('Location: ' . ADMIN_URL . '?page=login');
            exit;
        } else {
            Session::flash('error', 'Failed to change password.', 'error');
            header('Location: ' . ADMIN_URL . '?page=change-password');
            exit;
        }
    }
}
