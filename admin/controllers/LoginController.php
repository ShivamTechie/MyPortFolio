<?php
/**
 * Login Controller
 * Handle Admin Authentication
 */

require_once APP_PATH . '/models/User.php';

class LoginController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
        
        // If already logged in, redirect to dashboard
        if (Session::isLoggedIn()) {
            header('Location: ' . ADMIN_URL . '?page=dashboard');
            exit;
        }
        
        $this->index();
    }

    /**
     * Show Login Form
     */
    public function index() {
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/login.php';
    }
}
