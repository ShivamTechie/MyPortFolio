<?php
/**
 * Authenticate Controller
 * Process Login Requests
 */

require_once APP_PATH . '/models/User.php';

class AuthenticateController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->login();
        } else {
            header('Location: ' . ADMIN_URL . '?page=login');
            exit;
        }
    }

    /**
     * Process Login
     */
    private function login() {
        // Verify CSRF token
        if (!isset($_POST['csrf_token']) || !Session::verifyCsrfToken($_POST['csrf_token'])) {
            Session::flash('error', 'Invalid request. Please try again.', 'error');
            header('Location: ' . ADMIN_URL . '?page=login');
            exit;
        }

        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Validation
        if (empty($username) || empty($password)) {
            Session::flash('error', 'Please enter both username and password.', 'error');
            header('Location: ' . ADMIN_URL . '?page=login');
            exit;
        }

        // Find user
        $user = $this->userModel->findByUsername($username);

        if (!$user) {
            Session::flash('error', 'Invalid username or password.', 'error');
            header('Location: ' . ADMIN_URL . '?page=login');
            exit;
        }

        // Verify password
        if (!$this->userModel->verifyPassword($password, $user['password'])) {
            Session::flash('error', 'Invalid username or password.', 'error');
            header('Location: ' . ADMIN_URL . '?page=login');
            exit;
        }

        // Set session
        Session::setUser($user['id'], $user['username']);
        Session::set('user_email', $user['email']);
        Session::flash('success', 'Welcome back, ' . $user['username'] . '!', 'success');

        header('Location: ' . ADMIN_URL . '?page=dashboard');
        exit;
    }
}
