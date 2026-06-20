<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = file_get_contents('../manajemen_aset.sql');
    $pdo->exec($sql);
    
    echo "Database imported successfully!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
