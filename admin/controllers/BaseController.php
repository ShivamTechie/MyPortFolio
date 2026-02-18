<?php
/**
 * Base Controller for Admin Panel
 * Provides common functionality for all admin controllers
 */

class BaseController {
    /**
     * Check if request is AJAX
     */
    protected function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * Send JSON response
     */
    protected function jsonResponse($success, $message, $data = []) {
        header('Content-Type: application/json');
        echo json_encode(array_merge([
            'success' => $success,
            'message' => $message
        ], $data));
        exit;
    }

    /**
     * Handle response (JSON for AJAX, redirect for normal)
     */
    protected function handleResponse($success, $message, $redirectUrl) {
        if ($this->isAjax()) {
            $this->jsonResponse($success, $message, ['reload' => true]);
        }
        
        Session::flash($success ? 'success' : 'error', $message, $success ? 'success' : 'error');
        header('Location: ' . $redirectUrl);
        exit;
    }

    /**
     * Validate CSRF Token
     */
    protected function validateCsrf() {
        if (!isset($_POST['csrf_token']) || !Session::verifyCsrfToken($_POST['csrf_token'])) {
            $this->handleResponse(false, 'Invalid request. Please refresh and try again.', $_SERVER['HTTP_REFERER'] ?? ADMIN_URL);
        }
    }

    /**
     * Validate required fields
     */
    protected function validateRequired($fields, $data) {
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get input data from POST
     */
    protected function getInput($fields) {
        $data = [];
        foreach ($fields as $field) {
            $data[$field] = $_POST[$field] ?? '';
        }
        return $data;
    }
}
