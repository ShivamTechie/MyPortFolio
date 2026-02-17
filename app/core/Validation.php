<?php
/**
 * Validation Class
 * Form Validation Helper
 */

class Validation {
    private $errors = [];

    /**
     * Required Field
     */
    public function required($value, $field) {
        if (empty(trim($value))) {
            $this->errors[$field] = ucfirst($field) . " is required.";
            return false;
        }
        return true;
    }

    /**
     * Email Validation
     */
    public function email($value, $field) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "Invalid email format.";
            return false;
        }
        return true;
    }

    /**
     * Minimum Length
     */
    public function minLength($value, $field, $min) {
        if (strlen($value) < $min) {
            $this->errors[$field] = ucfirst($field) . " must be at least {$min} characters.";
            return false;
        }
        return true;
    }

    /**
     * Maximum Length
     */
    public function maxLength($value, $field, $max) {
        if (strlen($value) > $max) {
            $this->errors[$field] = ucfirst($field) . " must not exceed {$max} characters.";
            return false;
        }
        return true;
    }

    /**
     * Match Fields
     */
    public function match($value1, $value2, $field) {
        if ($value1 !== $value2) {
            $this->errors[$field] = "Fields do not match.";
            return false;
        }
        return true;
    }

    /**
     * Numeric Validation
     */
    public function numeric($value, $field) {
        if (!is_numeric($value)) {
            $this->errors[$field] = ucfirst($field) . " must be a number.";
            return false;
        }
        return true;
    }

    /**
     * URL Validation
     */
    public function url($value, $field) {
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_URL)) {
            $this->errors[$field] = "Invalid URL format.";
            return false;
        }
        return true;
    }

    /**
     * Get Errors
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Has Errors
     */
    public function hasErrors() {
        return !empty($this->errors);
    }

    /**
     * Clear Errors
     */
    public function clearErrors() {
        $this->errors = [];
    }

    /**
     * Sanitize String
     */
    public static function sanitize($data) {
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Sanitize Array
     */
    public static function sanitizeArray($data) {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = self::sanitizeArray($value);
            } else {
                $data[$key] = self::sanitize($value);
            }
        }
        return $data;
    }
}
