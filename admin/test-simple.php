<?php
// Simple test to check if PHP is working
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== SIMPLE TEST ===\n\n";

// Test 1: Basic PHP
echo "✓ PHP is working\n\n";

// Test 2: Config file
require_once dirname(__DIR__) . '/config/config.php';
echo "✓ Config loaded\n";
echo "DB_NAME: " . DB_NAME . "\n\n";

// Test 3: Database connection
try {
    require_once APP_PATH . '/core/Database.php';
    $db = Database::getInstance();
    echo "✓ Database connected\n\n";
} catch (Exception $e) {
    echo "✗ Database error: " . $e->getMessage() . "\n\n";
    exit;
}

// Test 4: Check profile table
$result = $db->query("SELECT * FROM profile LIMIT 1")->fetch();
echo "Profile in database:\n";
echo "ID: " . $result['id'] . "\n";
echo "Name: " . $result['name'] . "\n";
echo "Title: " . $result['title'] . "\n\n";

// Test 5: Try a simple update
$newName = 'Shivam';
$updateSql = "UPDATE profile SET name = :name WHERE id = :id";
$query = $db->query($updateSql);
$query->bind(':name', $newName);
$query->bind(':id', $result['id']);
$updateResult = $query->execute();

echo "Update attempt: " . ($updateResult ? "SUCCESS ✓" : "FAILED ✗") . "\n\n";

// Test 6: Check if it actually updated
$afterUpdate = $db->query("SELECT name FROM profile WHERE id = " . $result['id'])->fetch();
echo "Name after update: " . $afterUpdate['name'] . "\n\n";

if ($afterUpdate['name'] === $newName) {
    echo "✓✓✓ UPDATE WORKED! Name changed to: " . $newName . "\n";
} else {
    echo "✗✗✗ UPDATE FAILED! Name is still: " . $afterUpdate['name'] . "\n";
}
