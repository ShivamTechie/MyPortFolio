<?php
// Debug Profile Update
require_once '../config/config.php';
require_once APP_PATH . '/core/Database.php';
require_once APP_PATH . '/core/Session.php';

Session::start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode([
        'post_data' => $_POST,
        'files' => array_keys($_FILES),
        'is_ajax' => isset($_SERVER['HTTP_X_REQUESTED_WITH']),
        'request_method' => $_SERVER['REQUEST_METHOD']
    ]);
} else {
    // Check current profile data
    $db = Database::getInstance();
    $result = $db->query("SELECT * FROM profile LIMIT 1")->fetch();
    echo json_encode([
        'current_profile' => $result,
        'table_exists' => $result !== false
    ]);
}
