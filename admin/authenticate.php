<?php
/**
 * Direct Authentication Endpoint (No Routing)
 * Handles AJAX Login
 */

// Load Configuration
require_once __DIR__ . '/../config/config.php';
require_once APP_PATH . '/core/Database.php';
require_once APP_PATH . '/core/Model.php';
require_once APP_PATH . '/core/Session.php';
require_once APP_PATH . '/models/User.php';

// Start Session
Session::start();

// Set JSON header
header('Content-Type: application/json');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get POST data
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$csrf_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

// Validate CSRF
if (!Session::verifyCsrfToken($csrf_token)) {
    echo json_encode(['success' => false, 'message' => 'Invalid security token. Please refresh and try again.']);
    exit;
}

// Validate inputs
if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Please enter both username and password.']);
    exit;
}

// Find user
$userModel = new User();
$user = $userModel->findByUsername($username);

if (!$user) {
    echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
    exit;
}

// Verify password
if (!$userModel->verifyPassword($password, $user['password'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
    exit;
}

// Set session
Session::setUser($user['id'], $user['username']);
Session::set('user_email', $user['email']);

// Success
echo json_encode([
    'success' => true,
    'message' => 'Login successful!',
    'redirect' => ADMIN_URL . '?page=dashboard'
]);
exit;
