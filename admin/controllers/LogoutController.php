<?php
/**
 * Logout Controller
 * Handle User Logout
 */

class LogoutController {
    public function __construct() {
        Session::logout();
        header('Location: ' . ADMIN_URL . '?page=login');
        exit;
    }
}
