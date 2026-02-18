<?php
/**
 * AJAX Skill Save Endpoint
 */

ob_start();
require_once dirname(__DIR__, 2) . '/config/config.php';
require_once APP_PATH . '/core/Database.php';
require_once APP_PATH . '/core/Model.php';
require_once APP_PATH . '/core/Session.php';
require_once APP_PATH . '/models/Skill.php';

Session::start();

if (!Session::isLoggedIn()) {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (!isset($_POST['csrf_token']) || !Session::verifyCsrfToken($_POST['csrf_token'])) {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
    exit;
}

$data = [
    'name' => trim($_POST['name'] ?? ''),
    'category' => trim($_POST['category'] ?? ''),
    'proficiency' => trim($_POST['proficiency'] ?? ''),
    'display_order' => intval($_POST['display_order'] ?? 0)
];

if (empty($data['name']) || empty($data['category'])) {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Name and Category are required']);
    exit;
}

$model = new Skill();
$id = intval($_POST['id'] ?? 0);

if ($id > 0) {
    $result = $model->update($id, $data);
    $message = 'Skill updated successfully!';
} else {
    $result = $model->insert($data);
    $message = 'Skill added successfully!';
}

ob_end_clean();
header('Content-Type: application/json');

if ($result) {
    echo json_encode([
        'success' => true,
        'message' => $message,
        'redirect' => ADMIN_URL . '?page=skills'
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save skill']);
}
exit;
