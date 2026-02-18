<?php
/**
 * AJAX Profile Update Endpoint
 * Clean JSON-only response with no HTML
 */

// Prevent any output
ob_start();

// Load Configuration
require_once dirname(__DIR__, 2) . '/config/config.php';

// Load Core Classes
require_once APP_PATH . '/core/Database.php';
require_once APP_PATH . '/core/Model.php';
require_once APP_PATH . '/core/Session.php';
require_once APP_PATH . '/models/Profile.php';

// Start Session
Session::start();

// Check if user is logged in
if (!Session::isLoggedIn()) {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Verify CSRF token
if (!isset($_POST['csrf_token']) || !Session::verifyCsrfToken($_POST['csrf_token'])) {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
    exit;
}

// Get profile data
$data = [
    'name' => trim($_POST['name'] ?? ''),
    'title' => trim($_POST['title'] ?? ''),
    'bio' => trim($_POST['bio'] ?? ''),
    'phone' => trim($_POST['phone'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'address' => trim($_POST['address'] ?? ''),
    'linkedin' => trim($_POST['linkedin'] ?? ''),
    'github' => trim($_POST['github'] ?? ''),
    'twitter' => trim($_POST['twitter'] ?? '')
];

// Validate required fields
if (empty($data['name']) || empty($data['title']) || empty($data['email'])) {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false, 
        'message' => 'Name, Title, and Email are required'
    ]);
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
        ob_end_clean();
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to upload profile image'
        ]);
        exit;
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
        ob_end_clean();
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to upload resume'
        ]);
        exit;
    }
}

// Update profile
$profileModel = new Profile();
$result = $profileModel->updateProfile($data);

// Clear buffer and send clean JSON response
ob_end_clean();
header('Content-Type: application/json');

if ($result) {
    echo json_encode([
        'success' => true,
        'message' => 'Profile updated successfully! ✓',
        'reload' => true,
        'data' => $data
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to update profile in database'
    ]);
}
exit;
