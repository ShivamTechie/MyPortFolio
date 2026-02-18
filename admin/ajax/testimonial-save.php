<?php
/**
 * AJAX Testimonial Save Endpoint
 */

ob_start();
require_once dirname(__DIR__, 2) . '/config/config.php';
require_once APP_PATH . '/core/Database.php';
require_once APP_PATH . '/core/Model.php';
require_once APP_PATH . '/core/Session.php';
require_once APP_PATH . '/models/Testimonial.php';

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
    'client_name' => trim($_POST['client_name'] ?? ''),
    'client_position' => trim($_POST['client_position'] ?? ''),
    'testimonial' => trim($_POST['testimonial'] ?? ''),
    'rating' => intval($_POST['rating'] ?? 5),
    'display_order' => intval($_POST['display_order'] ?? 0)
];

if (empty($data['client_name']) || empty($data['testimonial'])) {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Client Name and Testimonial are required']);
    exit;
}

$model = new Testimonial();
$id = intval($_POST['id'] ?? 0);

if ($id > 0) {
    $result = $model->update($id, $data);
    $message = 'Testimonial updated successfully!';
} else {
    $result = $model->insert($data);
    $message = 'Testimonial added successfully!';
}

ob_end_clean();
header('Content-Type: application/json');

if ($result) {
    echo json_encode([
        'success' => true,
        'message' => $message,
        'redirect' => ADMIN_URL . '?page=testimonials'
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save testimonial']);
}
exit;
