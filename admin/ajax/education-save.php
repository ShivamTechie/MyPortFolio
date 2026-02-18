<?php
/**
 * AJAX Education Save Endpoint
 */

ob_start();
require_once dirname(__DIR__, 2) . '/config/config.php';
require_once APP_PATH . '/core/Database.php';
require_once APP_PATH . '/core/Model.php';
require_once APP_PATH . '/core/Session.php';
require_once APP_PATH . '/models/Education.php';

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
    'institution' => trim($_POST['institution'] ?? ''),
    'degree' => trim($_POST['degree'] ?? ''),
    'field_of_study' => trim($_POST['field_of_study'] ?? ''),
    'start_date' => $_POST['start_date'] ?? '',
    'end_date' => $_POST['end_date'] ?? null,
    'cgpa' => trim($_POST['cgpa'] ?? ''),
    'description' => trim($_POST['description'] ?? ''),
    'display_order' => intval($_POST['display_order'] ?? 0)
];

if (empty($data['institution']) || empty($data['degree'])) {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Institution and Degree are required']);
    exit;
}

$model = new Education();
$id = intval($_POST['id'] ?? 0);

if ($id > 0) {
    $result = $model->update($id, $data);
    $message = 'Education updated successfully!';
} else {
    $result = $model->insert($data);
    $message = 'Education added successfully!';
}

ob_end_clean();
header('Content-Type: application/json');

if ($result) {
    echo json_encode([
        'success' => true,
        'message' => $message,
        'redirect' => ADMIN_URL . '?page=education'
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save education']);
}
exit;
