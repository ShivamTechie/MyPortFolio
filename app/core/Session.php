<?php
/**
 * Session Class
 * Handle Session Management
 */

class Session {
    /**
     * Start Session
     */
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set Session Variable
     */
    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Get Session Variable
     */
    public static function get($key, $default = null) {
        self::start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    /**
     * Check if Session Variable Exists
     */
    public static function has($key) {
        self::start();
        return isset($_SESSION[$key]);
    }

    /**
     * Delete Session Variable
     */
    public static function delete($key) {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destroy Session
     */
    public static function destroy() {
        self::start();
        session_unset();
        session_destroy();
    }

    /**
     * Regenerate Session ID
     */
    public static function regenerate() {
        self::start();
        session_regenerate_id(true);
    }

    /**
     * Set Flash Message
     */
    public static function flash($key, $message = null, $type = 'info') {
        self::start();
        if ($message !== null) {
            $_SESSION['flash'][$key] = [
                'message' => $message,
                'type' => $type
            ];
        } else {
            if (isset($_SESSION['flash'][$key])) {
                $flash = $_SESSION['flash'][$key];
                unset($_SESSION['flash'][$key]);
                return $flash;
            }
        }
        return null;
    }

    /**
     * Check if User is Logged In
     */
    public static function isLoggedIn() {
        return self::has('user_id');
    }

    /**
     * Get Logged In User ID
     */
    public static function getUserId() {
        return self::get('user_id');
    }

    /**
     * Set User Session
     */
    public static function setUser($userId, $username) {
        self::set('user_id', $userId);
        self::set('username', $username);
        self::regenerate();
    }

    /**
     * Logout User
     */
    public static function logout() {
        self::destroy();
    }

    /**
     * Generate CSRF Token
     */
    public static function generateCsrfToken() {
        self::start();
        if (!self::has(CSRF_TOKEN_NAME)) {
            self::set(CSRF_TOKEN_NAME, bin2hex(random_bytes(32)));
        }
        return self::get(CSRF_TOKEN_NAME);
    }

    /**
     * Verify CSRF Token
     */
    public static function verifyCsrfToken($token) {
        return hash_equals(self::get(CSRF_TOKEN_NAME, ''), $token);
    }
}
