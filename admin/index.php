<?php
/**
 * Admin Panel Entry Point
 * Backend Application Bootstrap
 */

// Load Configuration
require_once __DIR__ . '/../config/config.php';

// Load Core Classes
require_once APP_PATH . '/core/Database.php';
require_once APP_PATH . '/core/Controller.php';
require_once APP_PATH . '/core/Model.php';
require_once APP_PATH . '/core/Session.php';
require_once APP_PATH . '/core/Validation.php';
require_once APP_PATH . '/core/Upload.php';

// Start Session
Session::start();

// Parse URL
$request = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$request = filter_var($request, FILTER_SANITIZE_STRING);

// Check if user is logged in (except for login page)
if ($request !== 'login' && $request !== 'authenticate') {
    if (!Session::isLoggedIn()) {
        header('Location: ' . ADMIN_URL . '?page=login');
        exit;
    }
}

// Route to appropriate controller
$controllerFile = ADMIN_PATH . '/controllers/' . ucfirst($request) . 'Controller.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($request) . 'Controller';
    $controller = new $controllerClass();
} else {
    // Default to dashboard
    require_once ADMIN_PATH . '/controllers/DashboardController.php';
    $controller = new DashboardController();
}
