<?php
$dbPath = __DIR__ . '/backend/runtime/manajemen_aset.db';

if (file_exists($dbPath)) {
    unlink($dbPath);
}

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $queries = [
        "CREATE TABLE asset_category (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          name VARCHAR(100) NOT NULL
        )",
        
        "INSERT INTO asset_category (id, name) VALUES
        (1, 'Elektronik'),
        (2, 'Kendaraan'),
        (3, 'Mesin')",
        
        "CREATE TABLE asset (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          name VARCHAR(100) NOT NULL,
          category_id INTEGER NOT NULL,
          location VARCHAR(100),
          status VARCHAR(50) NOT NULL DEFAULT 'available',
          qr_code VARCHAR(255),
          created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
          purchase_date DATE,
          last_used_date DATE,
          user VARCHAR(100),
          economic_life INTEGER DEFAULT 5,
          FOREIGN KEY (category_id) REFERENCES asset_category (id) ON DELETE CASCADE ON UPDATE CASCADE
        )",
        
        "INSERT INTO asset (id, name, category_id, location, status, created_at, updated_at) VALUES
        (20, 'Forklift A', 2, 'Gudang 1', 'available', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
        (30, 'Genset Cadangan', 3, 'Gudang 2', 'available', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
        (110, 'Komputer Kantor', 1, 'Ruang IT', 'maintenance', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)",
        
        "CREATE TABLE maintenance_schedule (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          asset_id INTEGER NOT NULL,
          asset_name VARCHAR(255),
          date DATE NOT NULL,
          description TEXT,
          status VARCHAR(50) DEFAULT 'pending',
          created_at DATETIME,
          updated_at DATETIME,
          FOREIGN KEY (asset_id) REFERENCES asset (id) ON DELETE CASCADE ON UPDATE CASCADE
        )",
        
        "INSERT INTO maintenance_schedule (id, asset_id, asset_name, date, description, status, created_at, updated_at) VALUES
        (1, 110, 'Komputer Kantor', '2025-06-12', 'Update komputer', 'pending', '2025-06-11 21:41:26', '2025-06-11 21:41:26'),
        (2, 20, 'Forklift A', '2025-06-12', 'Pemeriksaan berkala alat berat', 'pending', '2025-06-11 21:41:26', '2025-06-11 21:41:26'),
        (3, 30, 'Genset Cadangan', '2025-06-13', 'Ganti oli mesin cadangan', 'done', '2025-06-11 21:41:26', '2025-06-11 21:41:26')",
        
        "CREATE TRIGGER trg_before_insert_maintenance_schedule
        AFTER INSERT ON maintenance_schedule
        FOR EACH ROW
        BEGIN
            UPDATE maintenance_schedule SET asset_name = (SELECT name FROM asset WHERE id = NEW.asset_id) WHERE id = NEW.id;
        END",
        
        "CREATE TRIGGER trg_before_update_maintenance_schedule
        AFTER UPDATE ON maintenance_schedule
        FOR EACH ROW
        BEGIN
            UPDATE maintenance_schedule SET asset_name = (SELECT name FROM asset WHERE id = NEW.asset_id) WHERE id = NEW.id;
        END",
        
        "CREATE TABLE asset_usage (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          asset_id INTEGER NOT NULL,
          usage_date DATE NOT NULL,
          usage_hours INTEGER,
          FOREIGN KEY (asset_id) REFERENCES asset (id) ON DELETE CASCADE ON UPDATE CASCADE
        )",
        
        "INSERT INTO asset_usage (id, asset_id, usage_date, usage_hours) VALUES
        (1, 20, '2025-06-10', 5),
        (2, 30, '2025-06-11', 3),
        (3, 110, '2025-06-09', 2)"
    ];
    
    foreach ($queries as $q) {
        $pdo->exec($q);
    }
    
    echo "SQLite Database initialized successfully!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
