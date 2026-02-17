<?php
/**
 * Upload Class
 * File Upload Handler
 */

class Upload {
    private $errors = [];
    private $uploadPath;
    private $allowedTypes = [];
    private $maxSize;

    public function __construct($uploadPath, $allowedTypes = [], $maxSize = MAX_FILE_SIZE) {
        $this->uploadPath = $uploadPath;
        $this->allowedTypes = $allowedTypes;
        $this->maxSize = $maxSize;

        // Create upload directory if it doesn't exist
        if (!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
    }

    /**
     * Upload File
     */
    public function upload($file, $newName = null) {
        // Check if file was uploaded
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            $this->errors[] = "No file was uploaded.";
            return false;
        }

        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->errors[] = "Upload error: " . $this->getUploadError($file['error']);
            return false;
        }

        // Check file size
        if ($file['size'] > $this->maxSize) {
            $maxMB = $this->maxSize / 1048576;
            $this->errors[] = "File size exceeds maximum allowed size of {$maxMB}MB.";
            return false;
        }

        // Get file info
        $fileInfo = pathinfo($file['name']);
        $extension = strtolower($fileInfo['extension']);

        // Check file type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!empty($this->allowedTypes) && !in_array($mimeType, $this->allowedTypes)) {
            $this->errors[] = "File type not allowed.";
            return false;
        }

        // Generate unique filename
        if ($newName === null) {
            $newName = uniqid() . '_' . time();
        }
        $fileName = $newName . '.' . $extension;
        $destination = $this->uploadPath . '/' . $fileName;

        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $fileName;
        } else {
            $this->errors[] = "Failed to move uploaded file.";
            return false;
        }
    }

    /**
     * Delete File
     */
    public function delete($fileName) {
        $filePath = $this->uploadPath . '/' . $fileName;
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }

    /**
     * Get Upload Errors
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Get Upload Error Message
     */
    private function getUploadError($code) {
        $errors = [
            UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize directive in php.ini',
            UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE directive in HTML form',
            UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'File upload stopped by extension',
        ];
        return isset($errors[$code]) ? $errors[$code] : 'Unknown upload error';
    }

    /**
     * Validate Image Dimensions
     */
    public function validateImageDimensions($file, $minWidth = null, $minHeight = null, $maxWidth = null, $maxHeight = null) {
        $imageInfo = getimagesize($file['tmp_name']);
        if ($imageInfo === false) {
            $this->errors[] = "Invalid image file.";
            return false;
        }

        list($width, $height) = $imageInfo;

        if ($minWidth !== null && $width < $minWidth) {
            $this->errors[] = "Image width must be at least {$minWidth}px.";
            return false;
        }

        if ($minHeight !== null && $height < $minHeight) {
            $this->errors[] = "Image height must be at least {$minHeight}px.";
            return false;
        }

        if ($maxWidth !== null && $width > $maxWidth) {
            $this->errors[] = "Image width must not exceed {$maxWidth}px.";
            return false;
        }

        if ($maxHeight !== null && $height > $maxHeight) {
            $this->errors[] = "Image height must not exceed {$maxHeight}px.";
            return false;
        }

        return true;
    }
}
