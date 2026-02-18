<?php
/**
 * AJAX Experience Save Endpoint
 */

ob_start();
require_once dirname(__DIR__, 2) . '/config/config.php';
require_once APP_PATH . '/core/Database.php';
require_once APP_PATH . '/core/Model.php';
require_once APP_PATH . '/core/Session.php';
require_once APP_PATH . '/models/Experience.php';

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
    'company' => trim($_POST['company'] ?? ''),
    'position' => trim($_POST['position'] ?? ''),
    'start_date' => $_POST['start_date'] ?? '',
    'end_date' => $_POST['end_date'] ?? null,
    'description' => trim($_POST['description'] ?? ''),
    'display_order' => intval($_POST['display_order'] ?? 0)
];

if (empty($data['company']) || empty($data['position'])) {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Company and Position are required']);
    exit;
}

$model = new Experience();
$id = intval($_POST['id'] ?? 0);

if ($id > 0) {
    $result = $model->update($id, $data);
    $message = 'Experience updated successfully!';
} else {
    $result = $model->insert($data);
    $message = 'Experience added successfully!';
}

ob_end_clean();
header('Content-Type: application/json');

if ($result) {
    echo json_encode([
        'success' => true,
        'message' => $message,
        'redirect' => ADMIN_URL . '?page=experience'
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save experience']);
}
exit;
