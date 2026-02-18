<?php
// Test Profile Update Directly
require_once '../config/config.php';
require_once APP_PATH . '/core/Database.php';
require_once APP_PATH . '/core/Model.php';
require_once APP_PATH . '/models/Profile.php';

header('Content-Type: application/json');

$profileModel = new Profile();

// Get current profile
$current = $profileModel->getProfile();
echo "Current Profile:\n";
print_r($current);
echo "\n\n";

// Test data
$testData = [
    'name' => 'Shivam',
    'title' => 'Software Developer & WordPress Specialist',
    'bio' => 'Test bio update',
    'phone' => '+91 7037535354',
    'email' => 'shivamkk2001@gmail.com',
    'address' => 'Haridwar, Uttarakhand, India'
];

echo "Attempting to update with data:\n";
print_r($testData);
echo "\n\n";

// Try to update
$result = $profileModel->updateProfile($testData);

echo "Update Result: " . ($result ? "SUCCESS" : "FAILED") . "\n\n";

// Get profile again
$updated = $profileModel->getProfile();
echo "Updated Profile:\n";
print_r($updated);
