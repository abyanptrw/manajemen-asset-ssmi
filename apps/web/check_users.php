<?php
require 'vendor/autoload.php';
require 'common/config/bootstrap.php';

try {
    $db = Yii::$app->db;
    
    echo "=== Checking Existing Users ===\n\n";
    
    $users = $db->createCommand('SELECT * FROM user')->queryAll();
    
    if (count($users) > 0) {
        echo "Found " . count($users) . " user(s) in database:\n\n";
        foreach ($users as $user) {
            echo "ID: " . $user['id'] . "\n";
            echo "Username: " . $user['username'] . "\n";
            echo "Email: " . $user['email'] . "\n";
            echo "Status: " . ($user['status'] == 10 ? 'ACTIVE' : ($user['status'] == 9 ? 'INACTIVE' : 'DELETED')) . " ({$user['status']})\n";
            echo "---\n";
        }
    } else {
        echo "No users found in database.\n";
        echo "Need to create a default user for testing.\n";
    }
    
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
    echo 'Trace: ' . $e->getTraceAsString();
}
