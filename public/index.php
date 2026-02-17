<?php
/**
 * Portfolio Website Entry Point
 * Front-end Application Bootstrap
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
require_once APP_PATH . '/core/Router.php';

// Start Session
Session::start();

// Initialize Router
new Router();
