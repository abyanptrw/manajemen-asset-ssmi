<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1', 'root', 'root');
    $db = $pdo->query("SHOW DATABASES LIKE 'manajemen_aset'")->fetchColumn();
    if ($db) {
        $pdo->exec("USE manajemen_aset");
        $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
        echo 'Connected! Database exists. Tables: ' . implode(', ', $tables);
    } else {
        echo 'Connected to MySQL! But database "manajemen_aset" DOES NOT EXIST.';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
