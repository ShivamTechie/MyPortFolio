<?php
/**
 * AJAX Project Save Endpoint
 * Handles both add and edit operations
 */

// Prevent any output
ob_start();

// Load Configuration
require_once dirname(__DIR__, 2) . '/config/config.php';

// Load Core Classes
require_once APP_PATH . '/core/Database.php';
require_once APP_PATH . '/core/Model.php';
require_once APP_PATH . '/core/Session.php';
require_once APP_PATH . '/models/Project.php';

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

// Get project data
$data = [
    'title' => trim($_POST['title'] ?? ''),
    'description' => trim($_POST['description'] ?? ''),
    'technologies' => trim($_POST['technologies'] ?? ''),
    'project_link' => trim($_POST['project_link'] ?? ''),
    'github_link' => trim($_POST['github_link'] ?? ''),
    'display_order' => intval($_POST['display_order'] ?? 0)
];

// Validate required fields
if (empty($data['title']) || empty($data['description'])) {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false, 
        'message' => 'Title and Description are required'
    ]);
    exit;
}

// Handle image upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    require_once APP_PATH . '/core/Upload.php';
    $upload = new Upload(UPLOAD_PATH . '/projects', ALLOWED_IMAGE_TYPES);
    $imageName = $upload->upload($_FILES['image']);
    
    if ($imageName) {
        $data['image'] = $imageName;
    } else {
        ob_end_clean();
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to upload project image'
        ]);
        exit;
    }
}

// Check if edit or add
$projectModel = new Project();
$id = intval($_POST['id'] ?? 0);

if ($id > 0) {
    // Edit existing project
    $result = $projectModel->update($id, $data);
    $message = 'Project updated successfully!';
} else {
    // Add new project
    $result = $projectModel->insert($data);
    $message = 'Project added successfully!';
}

// Clear buffer and send clean JSON response
ob_end_clean();
header('Content-Type: application/json');

if ($result) {
    echo json_encode([
        'success' => true,
        'message' => $message,
        'redirect' => ADMIN_URL . '?page=projects'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to save project in database'
    ]);
}
exit;
