<?php
/**
 * Configuration File
 * Portfolio Website Configuration
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'u943540838_Shivam_port');
define('DB_USER', 'u943540838_shivam');
define('DB_PASS', '@#Chippu@#2001');
define('DB_CHARSET', 'utf8mb4');

// Application Configuration
define('APP_NAME', 'Shivam Kumar - Portfolio');
define('APP_ENV', 'production'); // development, production
define('APP_DEBUG', false);

// URL Configuration
define('BASE_URL', 'https://skmwebworks.com');
define('ADMIN_URL', BASE_URL . '/admin');

// Path Configuration
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('UPLOAD_PATH', PUBLIC_PATH . '/uploads');
define('ALLOWED_DOC_TYPES', [
    'application/pdf',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
]);
define('ADMIN_PATH', ROOT_PATH . '/admin');

// Security Configuration
define('CSRF_TOKEN_NAME', 'csrf_token');
define('SESSION_LIFETIME', 7200); // 2 hours

// Email Configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', ''); // Set your Gmail address
define('SMTP_PASSWORD', ''); // Set your Gmail App Password
define('SMTP_FROM_EMAIL', 'shivamkk2001@gmail.com');
define('SMTP_FROM_NAME', 'Shivam Kumar');
define('ADMIN_EMAIL', 'shivamkk2001@gmail.com');

// Upload Configuration
define('MAX_FILE_SIZE', 5242880); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);


// Timezone
date_default_timezone_set('Asia/Kolkata');

// Error Reporting
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', APP_ENV === 'production' ? 1 : 0);
